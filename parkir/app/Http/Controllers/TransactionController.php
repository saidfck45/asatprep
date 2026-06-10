<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\VehicleType;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    /**
     * Dashboard / Main Transaction View
     */
    public function index()
    {
        $locations = Location::all();
        $vehicleTypes = VehicleType::all();
        // Get only currently parked vehicles for exit selection
        $parkedTransactions = Transaction::where('status', 'parked')
            ->with(['location', 'vehicleType'])
            ->get();
        
        $latestTransaction = Transaction::orderBy('created_at', 'desc')->with(['location', 'vehicleType'])->first();

        // Calculate currently parked stats for summary cards
        $motorParkedCount = Transaction::where('status', 'parked')
            ->whereHas('vehicleType', function ($q) {
                $q->where('name', 'Motor');
            })->count();

        $carParkedCount = Transaction::where('status', 'parked')
            ->whereHas('vehicleType', function ($q) {
                $q->where('name', 'Car');
            })->count();

        $truckParkedCount = Transaction::where('status', 'parked')
            ->whereHas('vehicleType', function ($q) {
                $q->where('name', 'Truck/Bus/Other');
            })->count();

        return view('transactions.index', compact(
            'locations', 
            'vehicleTypes', 
            'parkedTransactions', 
            'latestTransaction',
            'motorParkedCount',
            'carParkedCount',
            'truckParkedCount'
        ));
    }

    /**
     * AJAX to check capacity
     */
    public function checkCapacity(Request $request)
    {
        $locationId = $request->get('location_id');
        $vehicleTypeId = $request->get('vehicle_type_id');

        if (!$locationId || !$vehicleTypeId) {
            return response()->json(['capacity' => 0]);
        }

        $location = Location::find($locationId);
        $vehicleType = VehicleType::find($vehicleTypeId);

        if (!$location || !$vehicleType) {
            return response()->json(['capacity' => 0]);
        }

        $remaining = $location->getRemainingCapacity($vehicleType->name);

        return response()->json(['remaining' => $remaining]);
    }

    /**
     * AJAX to get ticket details for exit form
     */
    public function getTicketDetails($id)
    {
        $transaction = Transaction::with(['location', 'vehicleType'])->find($id);
        if (!$transaction) {
            return response()->json(['error' => 'Ticket not found'], 404);
        }

        return response()->json([
            'location' => $transaction->location->name,
            'vehicle_type' => $transaction->vehicleType->name,
            'entry_time' => $transaction->entry_time->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Handle Entry of Vehicle
     */
    public function storeEntry(Request $request)
    {
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
        ]);

        $location = Location::findOrFail($request->location_id);
        $vehicleType = VehicleType::findOrFail($request->vehicle_type_id);

        // Check if there is capacity
        $remaining = $location->getRemainingCapacity($vehicleType->name);
        if ($remaining <= 0) {
            return redirect()->back()->with('error', 'Kapasitas parkir penuh untuk jenis kendaraan ini di lokasi tersebut!');
        }

        // Generate Ticket Number (format: TKT-YYYYMMDD-XXXX where XXXX is random code)
        $ticketNumber = 'TKT-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(2)));

        // Create transaction
        $transaction = Transaction::create([
            'ticket_number' => $ticketNumber,
            'location_id' => $location->id,
            'vehicle_type_id' => $vehicleType->id,
            'entry_time' => Carbon::now(),
            'status' => 'parked',
        ]);

        // Generate PDF Ticket
        $this->generateTicketPdf($transaction);

        return redirect()->route('transactions.index')->with([
            'success' => 'Kendaraan berhasil masuk! Tiket ' . $ticketNumber . ' telah dicetak.',
            'ticket_url' => asset('storage/tickets/' . $ticketNumber . '.pdf'),
            'ticket_number' => $ticketNumber
        ]);
    }

    /**
     * Handle Exit of Vehicle
     */
    public function storeExit(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'plate_number' => 'required|string|max:50',
        ]);

        $transaction = Transaction::findOrFail($request->transaction_id);

        if ($transaction->status !== 'parked') {
            return redirect()->back()->with('error', 'Kendaraan ini sudah keluar sebelumnya!');
        }

        $exitTime = Carbon::now();
        $feeDetails = $transaction->calculateFee($exitTime);

        $transaction->update([
            'plate_number' => strtoupper($request->plate_number),
            'exit_time' => $exitTime,
            'duration_hours' => $feeDetails['duration_hours'],
            'total_fee' => $feeDetails['total_fee'],
            'status' => 'exited',
        ]);

        // Refresh model so PDF gets complete data including exit info
        $transaction->refresh();

        // Regenerate PDF with complete exit details (overwrite entry-only PDF)
        $this->generateTicketPdf($transaction);

        return redirect()->route('transactions.index')->with([
            'exit_success' => true,
            'total_fee' => number_format($feeDetails['total_fee'], 0, ',', '.'),
            'duration' => $feeDetails['duration_hours'],
            'ticket_number' => $transaction->ticket_number,
            'ticket_url' => route('transactions.download-ticket', $transaction->ticket_number),
        ]);
    }

    /**
     * View All Transactions
     */
    public function viewAll()
    {
        $transactions = Transaction::with(['location', 'vehicleType'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('transactions.view-all', compact('transactions'));
    }

    /**
     * Download / Stream Ticket PDF — always accessible from history
     * Regenerates if file is missing (e.g. storage was cleared)
     */
    public function downloadTicket($ticketNumber)
    {
        $transaction = Transaction::with(['location', 'vehicleType'])
            ->where('ticket_number', $ticketNumber)
            ->firstOrFail();

        $path = 'tickets/' . $ticketNumber . '.pdf';

        // If file doesn't exist, regenerate it on-the-fly
        if (!Storage::disk('public')->exists($path)) {
            $this->generateTicketPdf($transaction);
        }

        $fullPath = Storage::disk('public')->path($path);

        return response()->file($fullPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $ticketNumber . '.pdf"',
        ]);
    }

    /**
     * Generate / Regenerate Ticket PDF using Barryvdh\DomPDF
     * Public so it can be called for on-demand regeneration.
     */
    public function generateTicketPdf(Transaction $transaction)
    {
        $pdf = Pdf::loadView('transactions.ticket-pdf', compact('transaction'));
        
        // Ensure folder exists
        if (!Storage::disk('public')->exists('tickets')) {
            Storage::disk('public')->makeDirectory('tickets');
        }

        // Save file to storage/app/public/tickets/TKT-...pdf
        $path = 'tickets/' . $transaction->ticket_number . '.pdf';
        Storage::disk('public')->put($path, $pdf->output());
    }
}

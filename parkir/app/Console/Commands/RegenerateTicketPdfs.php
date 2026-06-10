<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class RegenerateTicketPdfs extends Command
{
    protected $signature   = 'tickets:regenerate {--only-missing : Only regenerate missing PDFs}';
    protected $description = 'Regenerate all ticket PDFs from existing transactions';

    public function handle(): int
    {
        $this->info('=== Ticket PDF Regeneration ===');

        $transactions = Transaction::with(['location', 'vehicleType'])->get();

        if ($transactions->isEmpty()) {
            $this->warn('No transactions found in the database.');
            return 0;
        }

        // Ensure tickets folder exists
        if (!Storage::disk('public')->exists('tickets')) {
            Storage::disk('public')->makeDirectory('tickets');
            $this->line('Created tickets storage directory.');
        }

        $onlyMissing = $this->option('only-missing');
        $done = 0;
        $skipped = 0;
        $errors = 0;

        $bar = $this->output->createProgressBar($transactions->count());
        $bar->start();

        foreach ($transactions as $tx) {
            $path = 'tickets/' . $tx->ticket_number . '.pdf';

            if ($onlyMissing && Storage::disk('public')->exists($path)) {
                $skipped++;
                $bar->advance();
                continue;
            }

            try {
                $pdf = Pdf::loadView('transactions.ticket-pdf', ['transaction' => $tx]);
                Storage::disk('public')->put($path, $pdf->output());
                $done++;
            } catch (\Exception $e) {
                $errors++;
                $this->newLine();
                $this->error('Error on ' . $tx->ticket_number . ': ' . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("✓ Regenerated : {$done}");
        if ($skipped > 0) $this->line("  Skipped      : {$skipped} (already exist)");
        if ($errors  > 0) $this->error("✗ Errors       : {$errors}");
        $this->line('Storage path : ' . Storage::disk('public')->path('tickets'));

        return 0;
    }
}

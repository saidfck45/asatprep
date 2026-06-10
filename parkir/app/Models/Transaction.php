<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Transaction extends Model
{
    protected $fillable = [
        'ticket_number',
        'location_id',
        'vehicle_type_id',
        'plate_number',
        'entry_time',
        'exit_time',
        'duration_hours',
        'total_fee',
        'status',
    ];

    protected $casts = [
        'entry_time' => 'datetime',
        'exit_time' => 'datetime',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    /**
     * Calculate parking duration and total fee based on rules.
     */
    public function calculateFee(Carbon $exitTime): array
    {
        $entry = Carbon::parse($this->entry_time);
        
        // Calculate difference in seconds
        $diffInSeconds = $entry->diffInSeconds($exitTime);
        
        // "Buat Perjamnya sama dengan menit. Jadi jika sudah parkir 1 menit sama dengan parkir 1 jam."
        // Meaning 1 minute in real-time is treated as 1 hour in system.
        // We calculate ceiling of minutes to get duration in hours.
        $durationHours = (int) ceil($diffInSeconds / 60);
        if ($durationHours < 1) {
            $durationHours = 1;
        }

        $vt = $this->vehicleType;
        $totalFee = 0;

        if ($durationHours <= 24) {
            // Jika parkir selama 0 s.d. 24 maka perhitungannya:
            // Total Bayar = perjam_pertama + perjam_berikutnya * (jumlah jam parkir - 1)
            $fee = $vt->perjam_pertama + ($vt->perjam_berikutnya * ($durationHours - 1));
            
            // Jika Total Biaya melebihi max_perhari maka Total Bayar sama dengan nilai max_perhari
            $totalFee = min($fee, $vt->max_perhari);
        } else {
            // Jika lama parkir melebihi 24 jam maka Total Bayar dihitung jumlah hari * 60% dari max_perharinya.
            // Misalnya motor parkir selama 75 jam -> 75 / 24 = 3 hari (bulatkan ke bawah)
            $days = (int) floor($durationHours / 24);
            $dailyRate = $vt->max_perhari * 0.60;
            $totalFee = $days * $dailyRate;
        }

        return [
            'duration_hours' => $durationHours,
            'total_fee' => (int) $totalFee,
        ];
    }
}

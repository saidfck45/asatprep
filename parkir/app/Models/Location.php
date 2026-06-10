<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'name',
        'capacity_motor',
        'capacity_car',
        'capacity_truck',
    ];

    /**
     * Get all transactions for this location.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get remaining capacity for a specific vehicle type.
     */
    public function getRemainingCapacity(string $vehicleTypeName): int
    {
        $capacityField = match (strtolower($vehicleTypeName)) {
            'motor' => 'capacity_motor',
            'car' => 'capacity_car',
            default => 'capacity_truck',
        };

        $totalCapacity = $this->{$capacityField};

        $parkedCount = $this->transactions()
            ->where('status', 'parked')
            ->whereHas('vehicleType', function ($query) use ($vehicleTypeName) {
                $query->where('name', $vehicleTypeName);
            })
            ->count();

        return $totalCapacity - $parkedCount;
    }
}

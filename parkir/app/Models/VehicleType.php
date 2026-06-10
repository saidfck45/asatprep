<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VehicleType extends Model
{
    protected $fillable = [
        'name',
        'perjam_pertama',
        'perjam_berikutnya',
        'max_perhari',
    ];

    /**
     * Get all transactions for this vehicle type.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}

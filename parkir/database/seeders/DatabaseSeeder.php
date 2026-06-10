<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Location;
use App\Models\VehicleType;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // 1. Create Default Locations
        Location::create([
            'name' => 'Gedung A',
            'capacity_motor' => 3,
            'capacity_car' => 3,
            'capacity_truck' => 3,
        ]);

        Location::create([
            'name' => 'Gedung B',
            'capacity_motor' => 3,
            'capacity_car' => 3,
            'capacity_truck' => 3,
        ]);

        Location::create([
            'name' => 'Gedung C',
            'capacity_motor' => 3,
            'capacity_car' => 3,
            'capacity_truck' => 3,
        ]);

        // 2. Create Default Vehicle Types with Pricing (based on page 7-12 rules)
        VehicleType::create([
            'name' => 'Motor',
            'perjam_pertama' => 2000,
            'perjam_berikutnya' => 1000,
            'max_perhari' => 10000,
        ]);

        VehicleType::create([
            'name' => 'Car',
            'perjam_pertama' => 3000,
            'perjam_berikutnya' => 2000,
            'max_perhari' => 20000,
        ]);

        VehicleType::create([
            'name' => 'Truck/Bus/Other',
            'perjam_pertama' => 5000,
            'perjam_berikutnya' => 3000,
            'max_perhari' => 30000,
        ]);
    }
}

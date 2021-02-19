<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DisrictSeeder::class);
        $this->call(HospitalSeeder::class);
        $this->call(HealthOfficerSeeder::class);
        $this->call(PatientSeeder::class);
    }
}

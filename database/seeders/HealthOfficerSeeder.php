<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HealthOfficer;
use Faker\Factory as Faker;

class HealthOfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HealthOfficer::factory()->count(300)->create(); 
        
    }
}

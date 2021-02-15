<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hospital;
use Faker\Factory as Faker;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Hospital::factory()->count(1)->create(); 
        //factory(App\Models\Hospital::class, 3)->create();
    }
}

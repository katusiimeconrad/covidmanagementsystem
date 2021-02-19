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
     *///$this->faker->randomElement(['General', 'Regional Referral', 'National Referral'])
    public function run()
    {
        Hospital::create([
            'hospitalName'  =>  'Mengo',
            'hospitalType'  =>  'General',
            'district_id'   =>  1,
            'officerNumber' =>  0,
        ]);

        Hospital::create([
            'hospitalName'  =>  'Mbuya',
            'hospitalType'  =>  'General',
            'district_id'   =>  1,
            'officerNumber' =>  0,
        ]);

        Hospital::create([
            'hospitalName'  =>  'Makerere',
            'hospitalType'  =>  'General',
            'district_id'   =>  1,
            'officerNumber' =>  0,
        ]);

        Hospital::create([
            'hospitalName'  =>  'Ruharo',
            'hospitalType'  =>  'Regional Referral',
            'district_id'   =>  3,
            'officerNumber' =>  0,
        ]);

        Hospital::create([
            'hospitalName'  =>  'Ngoma',
            'hospitalType'  =>  'Regional Referral',
            'district_id'   =>  5,
            'officerNumber' =>  0,
        ]);

        Hospital::create([
            'hospitalName'  =>  'Bufumbo',
            'hospitalType'  =>  'Regional Referral',
            'district_id'   =>  2,
            'officerNumber' =>  0,
        ]);

        Hospital::create([
            'hospitalName'  =>  'Mulago',
            'hospitalType'  =>  'National Referral',
            'district_id'   =>  1,
            'officerNumber' =>  0,
        ]);

        Hospital::create([
            'hospitalName'  =>  'Kiruddu',
            'hospitalType'  =>  'National Referral',
            'district_id'   =>  1,
            'officerNumber' =>  0,
        ]);

        
        //Hospital::factory()->count(200)->create(); 
        //factory(App\Models\Hospital::class, 3)->create();
    }
}

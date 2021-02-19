<?php

namespace Database\Seeders;

use App\Models\District;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DisrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        District::create([
            'districtName'      =>  'Kampala',
            'region'     =>  'Central',
        ]);

        District::create([
            'districtName'      =>  'Mbale',
            'region'     =>  'East',
        ]);

        District::create([
            'districtName'      =>  'Mbarara',
            'region'     =>  'West',
        ]);

        District::create([
            'districtName'      =>  'Arua',
            'region'     =>  'North',
        ]);

        District::create([
            'districtName'      =>  'Kabale',
            'region'     =>  'South',
        ]);

        //District::factory()->count(20)->create();

    }

}
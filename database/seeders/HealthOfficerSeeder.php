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
        HealthOfficer::create([
            'firstName'     =>  'Ssembatya',
            'lastName'      =>  'Isaac',
            'genderName'    =>  'Male',
            'title'         =>  'Head healthOfficer',
            'hospital_id'   =>  1, //general hospital id
            'noOfPatients'  =>  98,
            'admin_id'      => 1,
        ]);

        HealthOfficer::create([
            'firstName'     =>  'Katusiime',
            'lastName'      =>  'Conrad',
            'genderName'    =>  'Male',
            'title'         =>  'Head healthOfficer',
            'hospital_id'   =>  2, //general hospital id
            'noOfPatients'  =>  98,
            'admin_id'      => 1,
        ]);

        HealthOfficer::create([
            'firstName'     =>  'Kigula',
            'lastName'      =>  'Jesse',
            'genderName'    =>  'Male',
            'title'         =>  'Head healthOfficer',
            'hospital_id'   =>  3, //general hospital id
            'noOfPatients'  =>  98,
            'admin_id'      => 1,
        ]);

        HealthOfficer::create([
            'firstName'     =>  'Namayanja',
            'lastName'      =>  'Zahara',
            'genderName'    =>  'Female',
            'title'         =>  'healthOfficer',
            'hospital_id'   =>  1, //general hospital id
            'noOfPatients'  =>  98,
            'admin_id'      => 1,
        ]);

        HealthOfficer::create([
            'firstName'     =>  'Tumuhairwe',
            'lastName'      =>  'Bruno',
            'genderName'    =>  'Male',
            'title'         =>  'healthOfficer',
            'hospital_id'   =>  2, //general hospital id
            'noOfPatients'  =>  98,
            'admin_id'      => 1,
        ]);

        
        //HealthOfficer::factory()->count(300)->create(); 
        
    }
}

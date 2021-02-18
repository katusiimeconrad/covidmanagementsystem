<?php

namespace Database\Factories;

use App\Models\HealthOfficer;
use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;

class HealthOfficerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HealthOfficer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstName'     =>  $this->faker->firstName,
            'lastName'      =>  $this->faker->lastName,
            'genderName'    =>  $this->faker->randomElement(['Female', 'Male']),
            'title'         =>  'healthOfficer',
            'hospital_id'   =>  rand(1,200), //general hospital id
            'noOfPatients'  =>  98,
            'admin_id'      => 1,
        ];
    }
}

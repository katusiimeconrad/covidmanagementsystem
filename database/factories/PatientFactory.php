<?php

namespace Database\Factories;

use App\Models\HealthOfficer;
use App\Models\Hospital;
use Carbon\Carbon;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstName'     =>  $this->faker->firstname,
            'lastName'      =>  $this->faker->lastname,
            'genderName'    =>  $this->faker->randomElement(['Female', 'Male']),
            'hospital_id'   =>  rand(1,3),//rand(1, 300), //general hospital id
            'health_officer_id'   =>  rand(1,5),//rand(1,300),
            'category'      => $this->faker->randomElement(['yes', 'no']),
            'submission'    => Carbon::now()->subDays(rand(0, 365))->format('Y-m-d'),
        ];
    }
}
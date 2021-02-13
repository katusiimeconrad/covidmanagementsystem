<?php

namespace Database\Factories;

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
            'firstName'     =>  $this->faker->name,
            'lastName'      =>  $this->faker->name,
            'genderName'    =>  'Female',
            'health_officer_id'   =>  1, //general hospital id
            'hospital_id'   =>  34,
            'category'      => 'yes',
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;

class HospitalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     * 
     * 
     */

    protected $model = \App\Models\Hospital::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hospitalName'  =>  $this->faker->name,
            'hospitalType'  =>  'National Referral',
            'district_id'   =>  4,
            'officerNumber' =>  0,
        ];
    }
}

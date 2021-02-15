<?php

namespace Database\Factories;

use App\Models\District;
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
            'hospitalName'  =>  $this->faker->streetName,
            'hospitalType'  =>  $this->faker->randomElement(['General', 'Regional Referral', 'National Referral']),
            'district_id'   =>  District::factory()->create()->id,
            'officerNumber' =>  0,
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\District;
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
        District::factory()->count(20)->create();
    }
}

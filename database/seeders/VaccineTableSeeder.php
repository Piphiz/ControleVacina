<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VaccineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Vaccine::factory(10)->create();
    }
}

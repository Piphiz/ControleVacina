<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VaccineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'manufacturer' => $this->faker->name(),
            'lot' => Str::random(14),
            'expiration_date' =>  $this->faker->dateTimeBetween('+1 years','+5 years'),
            'doses' => '2',
            'interval_doses' => '60',
        ];
    }
}

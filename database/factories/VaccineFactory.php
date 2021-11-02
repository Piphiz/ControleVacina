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
            'lot' => strtoupper(Str::random(10)),
            'expiration_date' =>  $this->faker->dateTimeBetween('+1 years','+5 years'),
            'doses' => rand(1,3),
            'interval_doses' => $this->faker->randomElement($array = array ('30', '60', '90')),
        ];
    }
}

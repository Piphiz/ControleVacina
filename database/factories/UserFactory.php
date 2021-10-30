<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'cpf' => Str::random(14),
            'phone' => $this->faker->tollFreePhoneNumber(),
            'address' =>$this->faker->address(),
            'birth_date' => $this->faker->dateTimeBetween('-60 years','-30 years'),
        ];
    }
}

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
            'cpf' => $this->faker->unique()->cpf(),
            'RG' => $this->faker->unique()->rg(),
            'phone' => $this->faker->cellphoneNumber(),
            'address' =>$this->faker->address(),
            'birth_date' => $this->faker->dateTimeBetween('-60 years','-30 years'),
        ];
    }
}

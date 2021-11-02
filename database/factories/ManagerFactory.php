<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ManagerFactory extends Factory
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
            'email' => 'admin@admin.com.br',
            'email_verified_at' => now(),
            'password' => Hash::make('asdfasdf'),
            'remember_token' => Str::random(10),
        ];
    }
}

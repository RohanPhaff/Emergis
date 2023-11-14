<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\users>
 */
class UsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'role' => 'Guest',
            'email' => $this->faker->unique->safeEmail,
            'password' => $this->faker->word,
            'phone_number' => $this->faker->unique->word,
        ];
    }
}

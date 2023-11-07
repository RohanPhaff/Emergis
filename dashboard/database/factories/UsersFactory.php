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
            'user_id' => $this->faker->unique()->word,
            'name' => $this->faker->word,
            'role' => $this->faker->word,
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->word,
            'phone_number' => $this->faker->word,
        ];
    }
}

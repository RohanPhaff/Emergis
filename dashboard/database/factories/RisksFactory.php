<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\risks>
 */
class RisksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'risk_id' => $this->faker->unique()->word,
            'name' => $this->faker->word,
            'description' => $this->faker->word,
            'risk_level' => $this->faker->randomNumber(1, 5),
            'status' => $this->faker->word,

            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
        ];
    }
}

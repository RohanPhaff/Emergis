<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\tasks>
 */
class TasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_id' => $this->faker->unique()->word,
            'name' => $this->faker->word,
            'description' => $this->faker->word,
            'user' => $this->faker->optional()->word,
            'status' => $this->faker->word,

            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
        ];
    }
}

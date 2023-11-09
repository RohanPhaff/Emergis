<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => $this->faker->unique()->word,
            'name' => $this->faker->word,
            'code' => $this->faker->unique()->word,
            'description' => $this->faker->word,
            'man_hours' => $this->faker->randomNumber(),
            'budget' => $this->faker->randomNumber(),
            'expected_costs' => $this->faker->randomNumber(),

            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,

            'alt_projectleader' => $this->faker->word,
            'initiator' => $this->faker->word,
            'actor' => $this->faker->word,
            'portfolio_holder' => $this->faker->word,

            'reasoning' => $this->faker->sentence,
            'uploaded_document_start' => $this->faker->optional()->text, // Assuming binary data is stored as text
            'uploaded_document_planning' => $this->faker->optional()->text, // Assuming binary data is stored as text
            'program' => $this->faker->word,
            'community_link' => $this->faker->url,
            'project_status' => $this->faker->word,
            'progress' => $this->faker->randomNumber(1, 100),
            'check_discussion_RvB' => $this->faker->boolean,

            'risk_ids' => implode(";", $this->faker->words($this->faker->numberBetween(1, 5), false))

        ];
    }
}

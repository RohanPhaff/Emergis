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
            'name' => $this->faker->word,
            'code' => $this->faker->bothify('##??#?'),
            'description' => $this->faker->realText($maxNbChars = 255),
            'man_hours' => $this->faker->numberBetween($min = 100, $max = 500),
            'budget' => $this->faker->numberBetween($min = 8000, $max = 20000),
            'expected_costs' => $this->faker->numberBetween($min = 1000, $max = 7999),

            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,

            'projectleader' => $this->faker->name,
            'alt_projectleader' => $this->faker->name,
            'initiator' => $this->faker->name,
            'actor' => $this->faker->name,
            'portfolio_holder' => $this->faker->name,

            'reasoning' => $this->faker->realText($maxNbChars = 100),
            'uploaded_document_start' => $this->faker->optional()->text, // Assuming binary data is stored as text
            'uploaded_document_planning' => $this->faker->optional()->text, // Assuming binary data is stored as text
            'program' => $this->faker->word,
            'community_link' => $this->faker->url,
            'project_status' => $this->faker->randomElement($array = array ('Op schema','Vertraagd','Afgelast')),
            'progress' => $this->faker->numberBetween($min = 20, $max = 100),
            'check_discussion_RvB' => $this->faker->boolean,
        ];
    }
}


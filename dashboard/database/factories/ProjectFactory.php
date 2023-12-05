<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\users;
use App\Models\Program;
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
        $departments = \App\Models\Department::all();
        $randomIndex = $this->faker->numberBetween(0, $departments->count() - 1);
        $finalManHours = "";
        for ($i = 0; $i < $randomIndex; $i++) { 
            $department = \App\Models\Department::all()->random()->name;
            $manHours = $this->faker->numberBetween(40, 1000);

            if (strlen($finalManHours) > 0) {
                $finalManHours .= ";";
            }

            $finalManHours .= ($department . ':' . $manHours);
        }

        return [
            'name' => $this->faker->word,
            'code' => $this->faker->bothify('##??#?'),
            'description' => $this->faker->realText($maxNbChars = 255),
            'department' => \App\Models\Department::all()->random()->name,
            'man_hours' => $finalManHours,
            'budget' => $this->faker->numberBetween($min = 8000, $max = 20000),
            'spent_costs' => $this->faker->numberBetween($min = 1000, $max = 7999),

            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,

            'projectleader' => users::all()->random()->name,
            'second_projectleader' => users::all()->random()->name,
            'initiator' => users::all()->random()->name,
            'actor' => users::all()->random()->name,

            'reasoning' => $this->faker->realText($maxNbChars = 100),
            'uploaded_document_start' => $this->faker->optional()->text, // Assuming binary data is stored as text
            'uploaded_document_planning' => $this->faker->optional()->text, // Assuming binary data is stored as text
            'program' => Program::all()->random()->name,
            'community_link' => $this->faker->url,
            'project_status' => $this->faker->randomElement($array = array ('Op schema','Vertraagd','Afgewezen')),
            'progress' => $this->faker->numberBetween($min = 20, $max = 100),
            'check_discussion_RvB' => $this->faker->boolean,
        ];
    }
}


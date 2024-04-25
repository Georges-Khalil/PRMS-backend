<?php

namespace Database\Factories;

use App\Models\Projects;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reports>
 */
class ReportsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'report_title' => $this->faker->sentence,
            'report_description' => $this->faker->text(255),
            'start_date' => $this->faker->date,
            'project_id' => Projects::inRandomOrder()->first()->project_id,
            'completion_percentage' => $this->faker->numberBetween(0, 100),
        ];
    }
}

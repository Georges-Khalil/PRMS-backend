<?php

namespace Database\Factories;

use App\Models\Companies;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projects>
 */
class ProjectsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_title' => $this->faker->sentence,
            'project_description' => $this->faker->text(255),
            'start_date' => $this->faker->date,
            'company_code' => Companies::inRandomOrder()->first()->company_code,
            'completion_percentage' => $this->faker->numberBetween(0, 100),
        ];
    }
}

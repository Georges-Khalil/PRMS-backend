<?php

namespace Database\Factories;

use App\Models\Reports;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tasks>
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
        $totalCount = $this->faker->numberBetween(1, 7);
        $currentCount = $this->faker->numberBetween(0, $totalCount);
        return [
            'task_name' => $this->faker->sentence,
            'total_count' => $totalCount,
            'current_count' => $currentCount,
            'report_id' => Reports::inRandomOrder()->first()->report_id,
        ];
    }
}

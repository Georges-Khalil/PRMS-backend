<?php

namespace Database\Factories;

use App\Models\Projects;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectMembers>
 */
class ProjectMembersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $project = Projects::inRandomOrder()->first();
        $user = Users::inRandomOrder()->first();
        
        return [
            'project_id' => $project->project_id,
            'user_id' => $user->user_id,
        ];
    }
}

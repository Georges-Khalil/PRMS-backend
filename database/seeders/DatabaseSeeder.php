<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Attachments;
use App\Models\Companies;
use App\Models\ProjectMembers;
use App\Models\Projects;
use App\Models\Reports;
use App\Models\Tasks;
use App\Models\Users;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Companies::factory(2)->create();
        Users::factory(20)->create();
        Projects::factory(6)->create();
        ProjectMembers::factory(30)->make()->each(function ($projectMember) {
            // Check if a ProjectMember with the same project_id and user_id already exists
            if (!ProjectMembers::where('project_id', $projectMember->project_id)->where('user_id', $projectMember->user_id)->exists()) {
                // If it doesn't exist, save the ProjectMember
                $projectMember->save();
            }
        });
        Reports::factory(12)->create();
        Tasks::factory(60)->create();
        Attachments::factory(10)->create();
    }
}

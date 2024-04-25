<?php

namespace Database\Factories;

use App\Models\Tasks;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attachments>
 */
class AttachmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_id' => Tasks::inRandomOrder()->first()->task_id,
            'file_name' => $this->faker->word . '.' . $this->faker->fileExtension,
            'file_data' => $this->faker->randomAscii,
            'file_type' => $this->faker->mimeType,
            'file_size' => $this->faker->randomNumber(),
            'uploaded_by_user_id' => Users::inRandomOrder()->first()->user_id,
            'upload_date' => $this->faker->dateTime,
        ];
    }
}

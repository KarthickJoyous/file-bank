<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'folder_id' => rand(0, 1) ? rand(1, 10) : NULL,
            'name' => fake()->name(),
            'file_type' => 'jpg',
            'size' => fake()->randomFloat(1, 0, 5),
            'url' => "https://picsum.photos/" . rand(1, 500) . '/300'
        ];
    }
}

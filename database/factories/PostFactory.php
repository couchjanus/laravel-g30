<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\PostStatus;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = \DB::table('users')->pluck('id');
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'status' => PostStatus::getRandomValue(),
            'user_id' => $this->faker->randomElement($users),
            'cover' => $this->faker->imageUrl(400, 300, 'animals', true),
        ];
    }
}

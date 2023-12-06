<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->unique()->jobTitle(),
            'description'=>$this->faker->catchPhrase(),
            'status'=>$this->faker->randomElement([true, false]),
            'cover'=>$this->faker->imageUrl(400, 300, 'animals', true)
        ];
    }
}

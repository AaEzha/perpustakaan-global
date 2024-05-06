<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'isbn' => fake()->isbn13(),
            'title' => fake()->sentence(),
            'author' => fake()->name(),
            'publisher' => fake()->company(),
            'cover' => fake()->imageUrl(),
            'year_published' => fake()->year(),
            'description' => fake()->paragraph(),
            'total_owned' => fake()->numberBetween(3, 10),
        ];
    }
}

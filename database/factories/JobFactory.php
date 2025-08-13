<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employer;
use App\Models\Tag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'employer_id' => Employer::factory(),
            'description' => fake()->paragraphs(3, true),
            'salary' => '$' . fake()->numberBetween(150000, 300000) . ' USD',
            'location' => fake()->city() . ', ' . fake()->state(),
            'employment_type' => fake()->randomElement(['Full time', 'Part time', 'Contract', 'Internship']),
            'featured' => fake()->boolean(20), // 20% chance of being featured
        ];
    }
}

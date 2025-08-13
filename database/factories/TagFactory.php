<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tags = [
            'PHP', 'Laravel', 'JavaScript', 'React', 'Vue.js', 'Node.js', 'Python', 'Django', 'Flask',
            'Java', 'Spring Boot', 'C#', '.NET', 'Ruby', 'Rails', 'Go', 'Rust', 'Swift', 'Kotlin',
            'MySQL', 'PostgreSQL', 'MongoDB', 'Redis', 'AWS', 'Azure', 'Docker', 'Kubernetes',
            'Git', 'CI/CD', 'REST API', 'GraphQL', 'Microservices', 'Agile', 'Scrum', 'DevOps',
            'Frontend', 'Backend', 'Full Stack', 'Mobile', 'iOS', 'Android', 'UI/UX', 'Design',
            'Machine Learning', 'AI', 'Data Science', 'Analytics', 'Security', 'Testing', 'QA'
        ];

        return [
            'title' => fake()->unique()->randomElement($tags),
        ];
    }
}

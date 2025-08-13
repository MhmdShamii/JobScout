<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'PHP', 'Laravel', 'JavaScript', 'React', 'Vue.js', 'Node.js', 'Python', 'Django', 'Flask',
            'Java', 'Spring Boot', 'C#', '.NET', 'Ruby', 'Rails', 'Go', 'Rust', 'Swift', 'Kotlin',
            'MySQL', 'PostgreSQL', 'MongoDB', 'Redis', 'AWS', 'Azure', 'Docker', 'Kubernetes',
            'Git', 'CI/CD', 'REST API', 'GraphQL', 'Microservices', 'Agile', 'Scrum', 'DevOps',
            'Frontend', 'Backend', 'Full Stack', 'Mobile', 'iOS', 'Android', 'UI/UX', 'Design',
            'Machine Learning', 'AI', 'Data Science', 'Analytics', 'Security', 'Testing', 'QA'
        ];

        foreach ($tags as $tag) {
            Tag::create(['title' => $tag]);
        }
    }
}

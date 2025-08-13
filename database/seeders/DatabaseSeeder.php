<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed in order to maintain relationships
        $this->call([
            TagSeeder::class,        // Create tags first
            SampleDataSeeder::class, // Create sample companies and jobs
            EmployerSeeder::class,   // Create additional employers (and users)
            JobSeeder::class,        // Create additional jobs with relationships
        ]);
    }
}

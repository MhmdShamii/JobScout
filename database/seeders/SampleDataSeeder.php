<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Employer;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample companies and their employers
        $companies = [];

        foreach ($companies as $companyData) {
            // Create user for the company
            $user = User::factory()->create([
                'name' => $companyData['name'] . ' Admin',
                'email' => strtolower(str_replace(' ', '', $companyData['name'])) . '@example.com',
            ]);

            // Create employer
            $employer = Employer::create([
                'user_id' => $user->id,
                'name' => $companyData['name'],
                'logo' => $companyData['logo'],
            ]);

            // Create jobs for this employer
            foreach ($companyData['jobs'] as $jobData) {
                $job = Job::create([
                    'employer_id' => $employer->id,
                    'title' => $jobData['title'],
                    'description' => $jobData['description'],
                    'salary' => $jobData['salary'],
                    'location' => $jobData['location'],
                    'employment_type' => $jobData['employment_type'],
                    'featured' => $jobData['featured'],
                ]);

                // Attach tags to the job
                $tags = Tag::whereIn('title', $jobData['tags'])->get();
                $job->tags()->attach($tags);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Employer;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all tags for random assignment
        $tags = Tag::all();
        
        // Create jobs for each employer
        Employer::all()->each(function ($employer) use ($tags) {
            // Create 2-5 jobs per employer
            $jobCount = rand(2, 5);
            
            for ($i = 0; $i < $jobCount; $i++) {
                $job = Job::factory()->create([
                    'employer_id' => $employer->id,
                ]);
                
                // Attach 2-4 random tags to each job
                $randomTags = $tags->random(rand(1, 3));
                $job->tags()->attach($randomTags);
            }
        });
    }
}

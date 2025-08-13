<?php

namespace App\Console\Commands;

use App\Models\Job;
use App\Models\Employer;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Console\Command;

class SeedDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:seed-all {--fresh : Run fresh migrations first}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with all data and verify relationships';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('fresh')) {
            $this->info('Running fresh migrations...');
            $this->call('migrate:fresh');
        }

        $this->info('Seeding database...');
        $this->call('db:seed');

        $this->info('Verifying relationships...');
        $this->verifyRelationships();

        $this->info('Database seeded successfully!');
    }

    private function verifyRelationships()
    {
        $userCount = User::count();
        $employerCount = Employer::count();
        $jobCount = Job::count();
        $tagCount = Tag::count();

        $this->table(
            ['Model', 'Count'],
            [
                ['Users', $userCount],
                ['Employers', $employerCount],
                ['Jobs', $jobCount],
                ['Tags', $tagCount],
            ]
        );

        // Check relationships
        $jobsWithEmployers = Job::whereNotNull('employer_id')->count();
        $jobsWithTags = Job::whereHas('tags')->count();
        $employersWithUsers = Employer::whereNotNull('user_id')->count();

        $this->info("\nRelationship Verification:");
        $this->info("Jobs with employers: {$jobsWithEmployers}/{$jobCount}");
        $this->info("Jobs with tags: {$jobsWithTags}/{$jobCount}");
        $this->info("Employers with users: {$employersWithUsers}/{$employerCount}");

        if ($jobsWithEmployers === $jobCount && $jobsWithTags === $jobCount && $employersWithUsers === $employerCount) {
            $this->info('✅ All relationships are properly established!');
        } else {
            $this->warn('⚠️  Some relationships may be missing.');
        }
    }
}

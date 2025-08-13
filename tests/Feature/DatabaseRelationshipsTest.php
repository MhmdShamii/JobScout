<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\Employer;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseRelationshipsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_employer_relationship()
    {
        $user = User::factory()->create();
        $employer = Employer::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $employer->user->id);
        $this->assertEquals($employer->id, $user->employer->id);
    }

    public function test_employer_jobs_relationship()
    {
        $employer = Employer::factory()->create();
        $jobs = Job::factory()->count(3)->create(['employer_id' => $employer->id]);

        $this->assertCount(3, $employer->jobs);
        $this->assertEquals($employer->id, $jobs->first()->employer->id);
    }

    public function test_job_tags_relationship()
    {
        $job = Job::factory()->create();
        $tags = Tag::factory()->count(3)->create();
        
        $job->tags()->attach($tags);

        $this->assertCount(3, $job->tags);
        $this->assertCount(1, $tags->first()->jobs);
    }

    public function test_user_jobs_through_employer()
    {
        $user = User::factory()->create();
        $employer = Employer::factory()->create(['user_id' => $user->id]);
        $jobs = Job::factory()->count(2)->create(['employer_id' => $employer->id]);

        $this->assertCount(2, $user->jobs);
    }

    public function test_seeder_creates_proper_relationships()
    {
        $this->seed();

        // Check that tags were created
        $this->assertGreaterThan(0, Tag::count());

        // Check that employers were created
        $this->assertGreaterThan(0, Employer::count());

        // Check that jobs were created
        $this->assertGreaterThan(0, Job::count());

        // Check that jobs have employers
        $job = Job::first();
        $this->assertNotNull($job->employer);

        // Check that jobs have tags
        $this->assertGreaterThan(0, $job->tags->count());

        // Check that employers have users
        $employer = Employer::first();
        $this->assertNotNull($employer->user);
    }
}

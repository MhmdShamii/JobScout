<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with(['employer:id,name', 'tags:id,title'])
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view("jobs.index", [
            "jobs" => $jobs
        ]);
    }
    function show(Job $job)
    {
        $job->load(['employer.user', 'tags:id,title']);

        return view('jobs.show', [
            'job' => $job
        ]);
    }
    function apply(Job $job)
    {
        $user = Auth::user();

        if ($job->applicants()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('info', 'You have already applied to this job.');
        }

        $job->applicants()->attach($user->id);

        return redirect()->back()->with('success', 'Application submitted successfully.');
    }
}

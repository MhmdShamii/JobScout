<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with(['employer:id,name', 'tags:id,title'])
            ->latest()
            ->paginate(16)
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

    public function create()
    {
        $tags = Tag::select('id', 'title')->orderBy('title')->get();
        return view('jobs.create', compact('tags'));
    }

    function store(Request $request)
    {
        $user = Auth::user();

        // Validate inputs
        $data = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'salary'           => ['required', 'string', 'max:255'],
            'salary_type'      => ['required', 'in:usd,lbp'],
            'location'         => ['required', 'string', 'max:255'],
            'employment_type'  => ['required', 'in:Full time,Part time,Internship,Contract'],
            'featured'         => ['nullable'],
            'tags'             => ['nullable', 'array'],
            'tags.*'           => ['integer', 'exists:tags,id'],
        ]);
        // Format salary into one column
        $data['salary'] = ($data['salary_type'] === 'usd' ? '$ ' : 'LBP ') . $data['salary'] . ($data['salary_type'] === 'usd' ? ' USD' : '');

        unset($data['salary_type']);

        $data['employer_id'] = $user->employer->id;

        $data['featured']    = $request->boolean('featured');

        $job = Job::create($data);

        // attach tags if any
        if (!empty($data['tags'])) {
            $job->tags()->sync($data['tags']);
        }

        return redirect("/jobs/{$job->id}")->with('success', 'Job created successfully.');
    }

    public function viewJobApplicants(Job $job)
    {

        $applicants = $job->applicants()
            ->with('tags')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('jobs.applications', compact('job', 'applicants'));
    }
    public function edit(Job $job)
    {
        $tags = Tag::select('id', 'title')
            ->orderBy('title')
            ->get();

        // IDs of tags currently on this job
        $selectedTagIds = $job->tags()->pluck('tags.id');

        return view('jobs.edit', [
            'job'             => $job,
            'tags'            => $tags,
            'selectedTagIds'  => $selectedTagIds,
        ]);
    }
    public function update(Request $request, Job $job)
    {
        // (Policy/middleware already ensures the user can update this job)

        // Validate inputs (same rules as store)
        $data = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'salary'           => ['required', 'string', 'max:255'],
            'salary_type'      => ['required', 'in:usd,lbp'],
            'location'         => ['required', 'string', 'max:255'],
            'employment_type'  => ['required', 'in:Full time,Part time,Internship,Contract'],
            'featured'         => ['nullable'],
            'tags'             => ['nullable', 'array'],
            'tags.*'           => ['integer', 'exists:tags,id'],
        ]);

        // Format salary into one column (same format as store)
        $data['salary'] = ($data['salary_type'] === 'usd' ? '$ ' : 'LBP ')
            . $data['salary']
            . ($data['salary_type'] === 'usd' ? ' USD' : '');

        // Normalize featured checkbox to boolean
        $data['featured'] = $request->boolean('featured');

        // Don't allow employer_id or salary_type to be mass-assigned
        $payload = Arr::except($data, ['tags', 'salary_type']);

        // Update job fields
        $job->update($payload);

        // Sync tags (clears if none selected)
        $job->tags()->sync($request->input('tags', []));

        return redirect("/jobs/{$job->id}")
            ->with('success', 'Job updated successfully.');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect('/jobs')->with('success', 'Job deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Tag;

class SearchController extends Controller
{
    public function get()
    {
        $query = request('q');

        $base = Job::with('employer:id,name', 'tags:id,title')
            ->where('title', 'like', "%{$query}%")
            ->orWhereHas('tags', fn($q) => $q->where('title', 'like', "%{$query}%"));

        $featuredJobs = $base->clone()
            ->where('featured', true)
            ->latest()
            ->take(6)
            ->get();

        $allJobs = $base->clone()
            ->inRandomOrder()
            ->take(8)
            ->get();

        $tags = Tag::take(20)->get();

        return view('home', [
            'featuredJobs' => $featuredJobs,
            'allJobs' => $allJobs,
            'tags' => $tags,
            'query' => $query
        ]);
    }

    public function getJobs(Request $request)
    {
        $q = $request->string('q')->toString();

        $jobs = Job::with(['employer:id,name', 'tags:id,title'])
            ->when($q !== '', function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                    ->orWhereHas('tags', fn($t) => $t->where('title', 'like', "%{$q}%"));
            })
            ->latest()
            ->paginate(10)               // <-- paginate, not get
            ->withQueryString();



        return view('jobs.index', [
            'jobs' => $jobs,
            'query' => $q
        ]);
    }
}

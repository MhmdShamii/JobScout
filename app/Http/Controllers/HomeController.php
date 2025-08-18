<?php

namespace App\Http\Controllers;

use app\Models\Job;
use app\Models\Tag;


class HomeController extends Controller
{
    public function index()
    {
        $featuredJobs = Job::with('employer:id,name', 'tags:id,title')
            ->where('featured', true)
            ->take(6)
            ->get();

        $allJobs = Job::with(['employer:id,name', 'tags:id,title'])
            ->inRandomOrder()
            ->take(6)
            ->get();

        $tags = Tag::take(20)->get();

        return view('home', [
            'featuredJobs' => $featuredJobs,
            'allJobs'      => $allJobs,
            'tags'         => $tags,
        ]);
    }
}

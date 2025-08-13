<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Tag;

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
}

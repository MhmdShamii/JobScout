<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Tag;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with(['employer:id,name', 'tags:id,title']) // optional: avoids N+1
            ->latest()                                          // orders by created_at desc
            ->paginate(10)                                      // <— no get() here
            ->withQueryString();

        return view("jobs.index", [
            "jobs" => $jobs
        ]);
    }
}

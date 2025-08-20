<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use App\Models\Request;
use App\Models\Tag;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id')->get();
        $usersCount = User::where('role', 'user')->count();
        $companiesCount = User::where('role', 'company')->count();
        $adminsCount = User::where('role', 'admin')->count();
        $pendingRequestsCount = Request::where('status', 'pending')->count();
        $deniedRequestsCount = Request::where('status', 'denial')->count();
        $tagsCount = Tag::count();
        $applications = Application::count();
        $jobsCount = Job::count();

        return view('admin.index', [
            'users' => $users,
            'usersCount' => $usersCount,
            'companiesCount' => $companiesCount,
            'adminsCount' => $adminsCount,
            'pendingRequestsCount' => $pendingRequestsCount,
            'deniedRequestsCount' => $deniedRequestsCount,
            'tagsCount' => $tagsCount,
            'jobsCount' => $jobsCount,
            'applications' => $applications,
        ]);
    }
}

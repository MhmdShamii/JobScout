<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $jobs = $user->applications()
            ->with(['employer:id,name', 'tags:id,title'])
            ->latest()
            ->take(6)
            ->get();

        $tags = $user->tags()->get();

        return view('profile', compact('jobs', 'tags'));
    }
}

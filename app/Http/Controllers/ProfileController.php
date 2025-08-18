<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tag;

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

        $userTags   = $user->tags()->select('id', 'title')->get();
        $allTags    = Tag::select('id', 'title')->orderBy('title')->get();
        $userTagIds = $userTags->pluck('id')->values();

        return view('profile', compact('jobs', 'userTags', 'allTags', 'userTagIds', 'user'));
    }

    public function update()
    {
        $user = Auth::user();

        $data = request()->validate([
            'name'         => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:255'],
            'location'     => ['nullable', 'string', 'max:255'],
            'bio'          => ['nullable', 'string'],
        ]);

        $user->update($data);

        return back()->with('success', 'Profile updated.');
    }

    public function updateTags()
    {
        $user = Auth::user();

        $data = request()->validate([
            'tags'   => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ]);

        $user->tags()->sync($data['tags'] ?? []);

        return back()->with('success', 'Tags updated.');
    }
}

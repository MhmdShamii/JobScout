<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'max:20', 'unique:tags,title'],
        ]);

        Tag::create($data);

        return back()->with('success', 'Tag created.');
    }

    public function show(Tag $tag)
    {
        //
    }

    public function destroy(Tag $tag)
    {
        //
    }
}

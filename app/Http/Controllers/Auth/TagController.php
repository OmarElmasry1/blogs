<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tag;


class TagController extends Controller
{
    public function TagPage()
    {
        $tags = Tag::all();

        return view('tags.index', compact('tags'));

    }
}

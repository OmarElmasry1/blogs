<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class blogController extends Controller
{
    public function index () {

   $blogs = Post::all();

   return view('site.index', compact('blogs'));

    }


    public function singleBlog($id) {

        $blog = Post::find($id);

        if(!$blog) {

            abort(404);
        }


        $comments = Comment::where('post_id', $blog->id)->get();
        $latestPosts = Post::where('id', '!=', $blog->id)->latest()->limit(3)->get();

        $tags = $blog->tags;

   return view('site.single', compact('blog', 'comments','latestPosts', 'tags'));
    }
}

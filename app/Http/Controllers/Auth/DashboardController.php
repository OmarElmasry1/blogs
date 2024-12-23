<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $postCount = Post::count();
        $userCount = User::count();
        $categoryCount = Category::count();
        $tagCount = Tag::count();

        return view('auth.dashboard', compact('postCount', 'userCount', 'categoryCount', 'tagCount'));
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function CategoryPage()
    {
      $categories = Category::all();

      return view('categories.index', compact('categories'));

    }
}

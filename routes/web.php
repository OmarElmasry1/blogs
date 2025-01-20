<?php

use App\Http\Controllers\Auth\CategoryController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\TagController;
use App\Http\Controllers\site\blogController;
use App\Http\Controllers\site\CommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/logout', function () {
    auth()->logout();

});



Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::resource('auth/posts', PostController::class);

Route::get('auth/categories', [CategoryController::class, 'CategoryPage'])->name('auth.categories');
Route::get('auth/tags', [TagController::class, 'TagPage'])->name('auth.tags');


Route::get('/', [blogController::class, 'index'])->name('home');
Route::get('singleBlog/{id}', [blogController::class, 'singleBlog'])->name('singleBlog');

Route::post('post/comment/{postId}', [CommentController::class, 'commentPost'])->name('post.comment')->middleware('auth');
Route::post('comment/reply/{commentId}', [CommentController::class, 'replyPost'])->name('comment.reply');


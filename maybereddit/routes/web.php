<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

Route::get('/test', [\App\Http\Controllers\TestController::class, 'index'])->name('test.index');
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/myposts', [PostController::class, 'seeMyPosts'])->name('posts.myposts');
Route::post('upvote/{post}', [PostController::class, 'upvote'])->name('posts.upvote');
Route::post('downvote/{post}', [PostController::class, 'downvote'])->name('posts.downvote');

Route::get('posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('can:view,post');
Route::patch('posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('can:view,post');
Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('can:delete,post');

Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('reply.store');

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/admin/table1', [PostController::class, 'getLivewire'])->name('admin.posts');
Route::get('/admin/table2', [PostController::class, 'getHandsOnTable'])->name('admin.posts2');

Route::get('/admin/users', [UserController::class, 'admin'])->name('admin.users');
Route::get('admin/ajaxLoading', [PostController::class, 'ajaxLoading'])->name('admin.ajax');
Route::post('/admin/something', [PostController::class, 'something'])->name('admin.something');
Route::post('/admin/update-via-ajax', [PostController::class, 'updateViaAjax'])->name('posts.update-via-ajax');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
//    Route::get('/', [PostController::class, 'index'])->name('posts.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


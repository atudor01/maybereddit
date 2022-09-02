<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;




Route::get('/test', [TestController::class, 'index'])->name('test.index');

Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/myposts', [PostController::class, 'seeMyPosts'])->name('posts.myposts');
Route::post('upvote/{post}', [PostController::class, 'upvote'])->name('posts.upvote');
Route::post('downvote/{post}', [PostController::class, 'downvote'])->name('posts.downvote');
Route::get('/admin/table1', [PostController::class, 'getLivewire'])->name('admin.table1');
Route::get('/admin/table2', [PostController::class, 'getHandsOnTable'])->name('admin.table2');
Route::post('/admin/update-via-ajax', [PostController::class, 'updateViaAjax'])->name('posts.update-via-ajax');

Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('reply.store');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/admin/users', [UserController::class, 'admin'])->name('admin.users');

Route::middleware([
    'auth'
])->group(function(){
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
});

Route::middleware([
    'can:view,post'
])->group(function(){
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::patch('posts/{post}', [PostController::class, 'update'])->name('posts.update');
});

Route::middleware([
    'can:delete,post'
])->group(function(){
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
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


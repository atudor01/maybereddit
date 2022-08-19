<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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


Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/myposts', [PostController::class, 'myposts'])->name('posts.myposts');



Route::get('posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('can:view,post');
Route::patch('posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('can:view,post');
Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('can:delete,post');

Route::post('comments', [CommentController::class, 'store'])->name('comments.store');


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


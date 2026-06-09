<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $post = [];

    if (Auth::check()) {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $post = $user->post()->latest()->get();
    }

    return view('home', ['posts' => $post]);
});

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::post('/register', [UserController::class, 'register'])->name('register')
    ->middleware('throttle:3,10');
Route::post('/login', [UserController::class, 'login'])->name('login')
    ->middleware('throttle:5,1');

// Blog post related routes
Route::post('/create-post', [PostController::class, 'createPost'])->name('create-post')
    ->middleware('auth') // does this auth means that a user has to only be login first to have access to the /create-post link?
    ->middleware('throttle:5,1');
Route::get('/edit-post/{post}', [PostController::class, 'editPost'])->name('edit-post')
    ->middleware('auth');
Route::put('/edit-post/{post}', [PostController::class, 'updatePost'])
    ->middleware('auth');
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost'])->name('delete-post')
    ->middleware('auth');

// Youtube video: Laravel Tutorial Beginners (Simple User CRUD App)
// Youtube channel: LearnWebCode
// Edit & Delete post
// 1:11:18

// Additional content to learn about: Cookies, Seesions, JSON, Web Tokens (JWT) and More
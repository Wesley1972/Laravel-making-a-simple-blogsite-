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

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/login', [UserController::class, 'login'])->name('login');

// Blog post related routes
Route::post('/create-post', [PostController::class, 'createPost'])->name('create-post');
Route::get('/edit-post/{post}', [PostController::class, 'editPost'])->name('edit-post');
Route::put('/edit-post/{post}', [PostController::class, 'updatePost']);
Route::delete('/delete-post{post}', [PostController::class, 'deletePost'])->name('delete-post');

// Youtube video: Laravel Tutorial Beginners (Simple User CRUD App)
// Youtube channel: LearnWebCode
// Edit & Delete post
// 1:11:18

// Additional content to learn about: Cookies, Seesions, JSON, Web Tokens (JWT) and More
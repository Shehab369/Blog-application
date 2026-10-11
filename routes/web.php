<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\EnsureAuthenticated;

Route::get('/', function () {
    return view('welcome');
})->name('homepage');;/////////



Route::get('/register', [UserController::class, 'showRegister'])->name('register.show');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');

Route::get('/login', [UserController::class, 'showLogin'])->name('login.show');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard')->middleware(EnsureAuthenticated::class);




  
// All CRUD operations
Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware(EnsureAuthenticated::class);
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware(EnsureAuthenticated::class);
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware(EnsureAuthenticated::class);
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware(EnsureAuthenticated::class);
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware(EnsureAuthenticated::class);
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware(EnsureAuthenticated::class);
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware(EnsureAuthenticated::class);
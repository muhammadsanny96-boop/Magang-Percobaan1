<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

Route::get('/', [PostController::class, 'index'])->name('feed');

Route::get('/posts/create', [PostController::class, 'create'])
    ->middleware('auth')
    ->name('posts.create');

Route::post('/posts', [PostController::class, 'store'])
    ->middleware('auth')
    ->name('posts.store');

Route::get('/posts/{post}', [PostController::class, 'show'])
    ->name('posts.show');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('posts.comments.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

// Profile routes (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

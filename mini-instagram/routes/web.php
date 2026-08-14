<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Rute utama setelah login adalah dashboard.
Route::get('/dashboard', [PostController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Arahkan root (/) ke dashboard jika sudah login.
Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Daftarkan resource route untuk posts, kecuali 'index' yang sudah ditangani oleh 'dashboard'.
    Route::resource('posts', PostController::class)->except(['index']);

    // Route untuk menyimpan komentar
    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
    // Route untuk menghapus komentar
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::fallback(function () {
    return redirect()->route('home');
});

require __DIR__.'/auth.php';

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * Show the comment wall with all comments.
     */
    public function index(): View
    {
        // Mengambil komentar terbaru, dan juga data 'user' yang berelasi
        // untuk menghindari N+1 problem (Eager Loading).
        $comments = Comment::with('user')->latest()->get();

        return view('comments.index', compact('comments'));
    }

    public function myComments(): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Mengambil komentar milik user yang sedang login
        $comments = $user->comments()->latest()->get();

        return view('comments.mine', compact('comments'));
    }

    /**
     * Store a newly created comment.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Menyimpan komentar dengan relasi ke user yang sedang login
        $user->comments()->create([
            'body' => $validated['body'],
            'author' => $user->name,
        ]);

        return redirect()->route('comments.index')->with('success', 'Komentar berhasil dikirim!');
    }
}

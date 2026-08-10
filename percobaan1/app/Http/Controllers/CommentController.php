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
        $comments = Comment::latest()->get();

        return view('comments.index', compact('comments'));
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

        Comment::create([
            'author' => $user ? $user->name : 'Anonim',
            'body' => trim($validated['body']),
        ]);

        return redirect()->route('comments.index')->with('success', 'Komentar berhasil dikirim!');
    }
}

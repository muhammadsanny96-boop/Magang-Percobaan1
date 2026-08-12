<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Show the form for creating a new post.
     */
    public function create(): View
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi data yang dikirim dari form
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('images', 'public');

        $request->user()->posts()->create(array_merge($validated, ['image' => $path]));

        // 3. Redirect ke halaman utama dengan pesan sukses
        return redirect()->route('comments.index')
            ->with('success', 'Postingan baru berhasil dibuat!');
    }
}

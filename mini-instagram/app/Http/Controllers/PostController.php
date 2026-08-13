<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    /**
     * Display a listing of the resource (Dashboard/Feed).
     */
    use AuthorizesRequests;

    public function index()
    {
        // Menggunakan withCount untuk efisiensi query jumlah komentar
        $posts = Post::with('user')
            ->withCount('comments')
            ->latest()->paginate(10);
        return view('dashboard', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'required|string|max:1000',
        ]);

        if ($request->hasFile('image')) {
            // Cara yang lebih efisien dan aman untuk menyimpan file
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $request->user()->posts()->create($validated);

        return redirect()->route('dashboard')->with('success', 'Post berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('user', 'comments.user')->loadCount('comments');
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'required|string|max:1000',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            // Cara yang lebih efisien dan aman untuk menyimpan file
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);

        return redirect()->route('posts.show', $post)->with('success', 'Post berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        // Delete image
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post berhasil dihapus!');
    }
}

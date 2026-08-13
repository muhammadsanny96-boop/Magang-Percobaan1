<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }

    public function index()
    {
        $posts = Post::with(['user','comments.user'])->latest()->paginate(10);
        $recent = Post::with('user')->latest()->limit(5)->get();
        return view('feed.index', compact('posts','recent'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:5120',
            'caption' => 'nullable|string|max:1000',
        ]);

        $path = $request->file('image')->store('posts', 'public');

        $post = Post::create([
            'user_id' => Auth::id(),
            'image' => $path,
            'caption' => $request->caption,
        ]);

        return redirect()->route('posts.show', $post)->with('success','Post created.');
    }

    public function show(Post $post)
    {
        $post->load(['user','comments.user']);
        return view('posts.show', compact('post'));
    }
}

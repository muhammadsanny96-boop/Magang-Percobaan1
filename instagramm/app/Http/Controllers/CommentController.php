<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return back()->with('success','Comment added.');
    }
}

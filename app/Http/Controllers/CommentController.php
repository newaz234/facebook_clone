<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // 🔹 Fetch comments for a post (AJAX)
    public function fetch(Post $post)
    {
        $user=auth()->user();
        $post->load('user', 'comments.user', 'comments.replies.user');
        return view('partials.comment-list', compact('post','user'));
    }

    // 🔹 Store a new comment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $validated['post_id'],
            'parent_id' => $validated['parent_id'] ?? null,
            'content' => $validated['content'],
        ]);

        $comment->load('user');

        return response()->json([
            'success' => true,
            'comment' => [
                'author' => $comment->user->first_name.' '.$comment->user->surname,
                'content' => $comment->content,
                'created_at' => $comment->created_at->diffForHumans(),
            ]
        ]);
    }
    public function getComments($postId)
{
    $user=auth()->user();
    $post = Post::with('user', 'comments.user')->findOrFail($postId);
    return view('comment', compact('post','user'));
}

}

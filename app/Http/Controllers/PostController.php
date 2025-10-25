<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user','likes')->latest()->get();
        $user = Auth::user();
        $pendingRequests = Auth::user()->pendingFriendRequests()->with('sender')->get();
        $user = Auth::user();
        $sentFriends = $user->sentFriends()->get();
        $receivedFriends = $user->receivedFriends()->get();

        // merge করে duplicate বাদ দাও (id অনুযায়ী)
        $friends = $sentFriends->merge($receivedFriends)->unique('id')->values();
        return view('hompage', compact('posts','user','friends'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
        ]);

        try {
            $postData = [
                'user_id' => Auth::id(),
                'content' => $request->content,
                'privacy' => 'public', // You can make this dynamic later
            ];

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('posts', 'public');
                $postData['image'] = $imagePath;
            }

            $post = Post::create($postData);

            return response()->json([
                'success' => true,
                'message' => 'Post created successfully',
                'post' => $post->load('user')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create post: ' . $e->getMessage()
            ], 500);
        }
    }
    public function destroy(Post $post)
    {
        // Check if user owns the post
        if ($post->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        // Delete image if exists
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->back()->with('success', 'Profile picture updated!');
    }
    public function toggleLike(Post $post)
{
    $user = auth()->user();

    // Check if already liked
    $like = $post->likes()->where('user_id', $user->id)->first();

    if ($like) {
        $like->delete(); // Unlike
        $status = 'unliked';
    } else {
        $post->likes()->create(['user_id' => $user->id]);
        $status = 'liked';
    }

    // Return JSON response for AJAX
    return response()->json([
        'status' => $status,
        'likes_count' => $post->likes()->count(),
    ]);
}


}

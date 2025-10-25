<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $user=auth::user();
        $query = $request->input('query');

        // Search People
        $people = User::where('first_name', 'like', "%{$query}%")
                        ->orWhere('surname', 'like', "%{$query}%")
                        ->get();

        // Search Posts
        $posts = Post::where('content', 'like', "%{$query}%")
                     ->with('user', 'likes', 'comments')
                     ->latest()
                     ->get();

        return view('search-result', compact('people', 'posts', 'query','user'));
    }
}

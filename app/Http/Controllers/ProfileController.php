<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {

    $user = Auth::user();
    $sentFriends = $user->sentFriends()->get();
    $receivedFriends = $user->receivedFriends()->get();

    // merge করে duplicate বাদ দাও (id অনুযায়ী)
    $friends = $sentFriends->merge($receivedFriends)->unique('id')->values();
    $posts = Post::where('user_id', $user->id)
            ->with(['user','likes'])
            ->latest()
            ->get();
        return view('profile', compact('user','friends','posts'));
    }
}
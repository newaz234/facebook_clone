<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\FriendRequest;

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
    public function show($id)
{
    $user = User::findOrFail($id);
    $posts = $user->posts()->latest()->get();
    $friends = $user->friends;

    $authUser = auth()->user();

    $isFriend = $authUser->sentFriends->contains($id);
    if(!$isFriend)
    {
        $isFriend = $authUser->receivedFriends->contains($id);
    }
    $requestSent = FriendRequest::where('sender_id', $authUser->id)
                                ->where('receiver_id', $user->id)
                                ->first();
    $requestReceived = FriendRequest::where('sender_id', $user->id)
                                    ->where('receiver_id', $authUser->id)
                                    ->first();

    return view('otherprofile', compact('user', 'posts', 'friends', 'isFriend', 'requestSent', 'requestReceived'));
}

}
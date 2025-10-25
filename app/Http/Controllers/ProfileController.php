<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\Storage;
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
public function updateImage(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $user = auth()->user();

    // Delete old image if exists
    if ($user->image && \Storage::exists('public/' . $user->image)) {
        \Storage::delete('public/' . $user->image);
    }

    // Store new one
    $path = $request->file('image')->store('profile_images', 'public');

    $user->update(['image' => $path]);

    return redirect()->back()->with('success', 'Profile picture updated!');
}

public function updateCoverPhoto(Request $request)
{
    $request->validate([
        'cover_photo' => 'required|image|mimes:jpg,jpeg,png|max:4096',
    ]);

    $user = auth()->user();

    // পুরনো cover photo delete করো
    if ($user->cover_photo) {
        Storage::delete('public/' . $user->cover_photo);
    }

    $path = $request->file('cover_photo')->store('covers', 'public');
    $user->cover_photo = $path;
    $user->save();

    return back()->with('success', 'Cover photo updated successfully.');
}
}
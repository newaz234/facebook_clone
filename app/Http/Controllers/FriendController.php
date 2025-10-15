<?php
// app/Http/Controllers/FriendController.php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function index()
    {
        $pendingRequests = Auth::user()->pendingFriendRequests()->with('sender')->get();
        $user=auth::user();
        return view('friends', compact('pendingRequests','user'));
    }

    public function sendRequest(Request $request, $userId)
    {
        $receiver = User::findOrFail($userId);

        // Check if request already exists
        $existingRequest = FriendRequest::where(function ($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', Auth::id());
        })->first();

        if ($existingRequest) {
            return back()->with('error', 'Friend request already exists.');
        }

        FriendRequest::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $userId,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Friend request sent!');
    }

    public function acceptRequest($requestId)
    {
        $friendRequest = FriendRequest::where('receiver_id', Auth::id())
                                    ->where('id', $requestId)
                                    ->firstOrFail();

        $friendRequest->update(['status' => 'accepted']);

        return back()->with('success', 'Friend request accepted!');
    }

    public function rejectRequest($requestId)
    {
        $friendRequest = FriendRequest::where('receiver_id', Auth::id())
                                    ->where('id', $requestId)
                                    ->firstOrFail();

        $friendRequest->delete();

        return back()->with('success', 'Friend request rejected.');
    }

    public function cancelRequest($requestId)
    {
        $friendRequest = FriendRequest::where('sender_id', Auth::id())
                                    ->where('id', $requestId)
                                    ->firstOrFail();

        $friendRequest->delete();

        return back()->with('success', 'Friend request cancelled.');
    }

    public function removeFriend($friendId)
    {
        $friendship = FriendRequest::where(function ($query) use ($friendId) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $friendId);
        })->orWhere(function ($query) use ($friendId) {
            $query->where('sender_id', $friendId)
                  ->where('receiver_id', Auth::id());
        })->where('status', 'accepted')->firstOrFail();

        $friendship->delete();

        return back()->with('success', 'Friend removed.');
    }

    public function getSuggestions()
    {
        // Get users who are not friends and haven't received/sent requests
        $suggestions = User::where('id', '!=', Auth::id())
            ->whereDoesntHave('receivedFriendRequests', function ($query) {
                $query->where('sender_id', Auth::id());
            })
            ->whereDoesntHave('sentFriendRequests', function ($query) {
                $query->where('receiver_id', Auth::id());
            })
            ->inRandomOrder()
            ->limit(10)
            ->get();
            $pendingRequests = Auth::user()->pendingFriendRequests()->with('sender')->get();
        $user=auth::user();
        return view('suggestion', compact('suggestions','user','pendingRequests'));
    }
    public function allFriends()
    {
        $pendingRequests = Auth::user()->pendingFriendRequests()->with('sender')->get();
        $user = Auth::user();
        $sentFriends = $user->sentFriends()->get();
    $receivedFriends = $user->receivedFriends()->get();

    // merge করে duplicate বাদ দাও (id অনুযায়ী)
    $friends = $sentFriends->merge($receivedFriends)->unique('id')->values();

        $user=auth::user();
        return view('allfriends', compact('pendingRequests', 'friends','user'));
    }
}
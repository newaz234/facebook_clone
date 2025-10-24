<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Get user's conversations
    public function index()
    {
        $user = Auth::user();
        
        $conversations = $user->conversations()
            ->with(['latestMessage', 'users' => function($query) use ($user) {
                $query->where('users.id', '!=', $user->id);
            }])
            ->withCount(['messages as unread_count' => function($query) use ($user) {
                $query->where('user_id', '!=', $user->id)
                      ->where('is_read', false);
            }])
            ->orderByDesc(
                Message::select('created_at')
                    ->whereColumn('conversation_id', 'conversations.id')
                    ->latest()
                    ->limit(1)
            )
            ->get();

        return view('messages.index', compact('conversations','user'));
    }

    // Show conversation
    public function show(Conversation $conversation)
    {
        if (!$conversation->isParticipant(Auth::id())) {
            abort(403);
        }
    
        $messages = $conversation->messages()
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get();
    
        $conversation->markAsRead(Auth::id());
    
        $otherUsers = $conversation->users()->where('users.id', '!=', Auth::id())->get();
    
        // Get all user's conversations for the sidebar
        $conversations = Auth::user()->conversations()
            ->with(['latestMessage', 'users' => function($query) {
                $query->where('users.id', '!=', Auth::id());
            }])
            ->withCount(['messages as unread_count' => function($query) {
                $query->where('user_id', '!=', Auth::id())
                      ->where('is_read', false);
            }])
            ->orderByDesc(
                Message::select('created_at')
                    ->whereColumn('conversation_id', 'conversations.id')
                    ->latest()
                    ->limit(1)
            )
            ->get();
    $user=auth::user();
        return view('messages.conversation', compact('conversation', 'messages', 'otherUsers', 'conversations','user'));
    }

    // Start new conversation
    public function create($userId)
    {
        $user = User::findOrFail($userId);
        $currentUser = Auth::user();

        // Check if conversation already exists
        $conversation = $currentUser->conversations()
            ->whereHas('users', function($query) use ($userId) {
                $query->where('users.id', $userId);
            })
            ->where('is_group', false)
            ->first();

        if (!$conversation) {
            $conversation = Conversation::create(['is_group' => false]);
            $conversation->users()->attach([$currentUser->id, $userId]);
        }

        return redirect()->route('messages.show', $conversation);
    }

    // Send message
    public function store(Request $request, Conversation $conversation)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // Check if user is participant
        if (!$conversation->isParticipant(Auth::id())) {
            abort(403);
        }

        $message = $conversation->messages()->create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        // Mark other messages as unread for participants
        $conversation->participants()
            ->where('user_id', '!=', Auth::id())
            ->update(['last_read' => null]);

        $conversation->messages()
            ->where('user_id', '!=', Auth::id())
            ->update(['is_read' => false]);

        if ($request->ajax()) {
            return response()->json([
                'message' => $message->load('user'),
                'success' => true
            ]);
        }

        return back();
    }

    // Get users for new conversation
    public function getUsers()
    {
        $users = User::where('id', '!=', Auth::id())
            ->select('id','first_name','surname','email','image') // Add profile_picture if you have it
            ->get();

        return response()->json($users);
    }
}
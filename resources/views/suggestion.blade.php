{{-- resources/views/friends/suggestions.blade.php --}}
@extends('layout.app')

@section('title', 'Friend Suggestions')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/friends.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="sidebar">
        <!-- Same sidebar as friends index -->
        <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="{{ route('friends.index') }}" class="menu-link">
                        <div class="icon">👥</div>
                        <span class="menu-text">Home</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('friends.index') }}#requests" class="menu-link">
                        <div class="icon">👤</div>
                        <span class="menu-text">Friend Requests</span>
                        @if($pendingRequests->count() > 0)
                        <span class="badge">{{ $pendingRequests->count() }}</span>
                        @endif
                    </a>
                </li>
                <li class="menu-item active">
                    <a href="{{ route('friends.suggestions') }}" class="menu-link ">
                        <div class="icon">👥</div>
                        <span class="menu-text">Suggestions</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div class="icon">👥</div>
                        <span class="menu-text">All friends</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div class="icon">🎁</div>
                        <span class="menu-text">Birthdays</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div class="icon">📋</div>
                        <span class="menu-text">Custom Lists</span>
                    </a>
                </li>
            </ul>
    </div>

    <div class="main-content">
        <div class="content-header">
            <h2>People You May Know</h2>
        </div>

        @if($suggestions->count() > 0)
        <div class="requests-grid">
            @foreach($suggestions as $user)
            <div class="request-card">
                <div class="card-image">
                    <img src=" {{ asset('storage/' . $user->image) ?? 'https://randomuser.me/api/portraits/men/'.rand(1,100).'.jpg' }}" alt="Profile">
                </div>
                <div class="card-content">
                    <div class="card-name">{{ $user->first_name }} {{ $user->surname }}</div>
                    <div class="mutual-friends">
                        {{ Auth::user()->mutualFriendsCount($user) }} mutual friends
                    </div>
                    <form action="{{ route('friends.send-request', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="confirm-btn">Add Friend</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="no-suggestions">
            <p>No friend suggestions at the moment</p>
        </div>
        @endif
    </div>
</div>
@endsection
@extends('layout.app')

@section('title', 'All Friends')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/friends.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="sidebar">
        <div class="sidebar-header">
            <h1>Friends</h1>
            <button class="settings-btn">⚙</button>
        </div>
        
        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="{{ route('friends.index') }}" class="menu-link">
                    <div class="icon">👥</div>
                    <span class="menu-text">Home</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('friends.index') }}" class="menu-link">
                    <div class="icon">👤</div>
                    <span class="menu-text">Friend Requests</span>
                    @if($pendingRequests->count() > 0)
                    <span class="badge">{{ $pendingRequests->count() }}</span>
                    @endif
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('friends.suggestions') }}" class="menu-link">
                    <div class="icon">👥</div>
                    <span class="menu-text">Suggestions</span>
                </a>
            </li>
            <li class="menu-item active">
                <a href="{{ route('friends.all') }}" class="menu-link">
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
            <h2>All Friends</h2>
            <span class="total-friends">{{ $friends->count() }} friends</span>
        </div>

        @if($friends->count() > 0)
        <div class="friends-grid">
            @foreach($friends as $friend)
            <div class="friend-card">
                <div class="friend-image">
                    <img src="{{ asset('storage/' . $friend->image) ?? 'https://randomuser.me/api/portraits/men/'.rand(1,100).'.jpg' }}" alt="Profile">
                </div>
                <div class="friend-content">
                    <div class="friend-name" onclick="window.location.href='{{ route('profile.show', $friend->id) }}'">{{ $friend->first_name }} {{ $friend->surname }}</div>
                    <div class="mutual-friends">
                        <div class="mutual-avatars">
                            <div class="mutual-avatar"></div>
                            <div class="mutual-avatar"></div>
                            <div class="mutual-avatar"></div>
                        </div>
                        {{ Auth::user()->mutualFriendsCount($friend) }} mutual friends
                    </div>
                    <button class="message-btn" onclick="window.location.href='{{ route('messages.create', $friend->id) }}'">Message</button>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="no-friends">
            <p>No friends yet</p>
        </div>
        @endif
    </div>
</div>

<script>
   

    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
@endsection
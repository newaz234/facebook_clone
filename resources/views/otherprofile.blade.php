@extends('layout.app')

@section('title', $user->first_name . ' ' . $user->surname)

@section('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/post.css') }}">
<link rel="stylesheet" href="{{ asset('css/comment.css') }}">
@endsection

@section('content')
<!-- Profile Header -->
<div class="profile-header">
    <div class="cover-photo">
        <img src="{{ asset('storage/' . $user->image) }}" alt="Profile">
    </div>
    <div class="profile-picture">
        <img src="{{ asset('storage/' . $user->image) }}" alt="Profile">
    </div>

    <div class="profile-info">
        <div class="profile-stats">
            <h1 class="profile-name">{{ $user->first_name }} {{ $user->surname }}</h1>
            <span>{{ $friends->count() }} friends</span>
        </div>

        <div class="profile-actions">
            @if($user->id === auth()->user()->id)
                <a class="btn btn-primary">Edit Profile</a>
            @else
            {{-- Friend Request Logic --}}
            {{-- Variables passed from controller: $isFriend, $requestSent, $requestReceived --}}
            {{-- If logged-in user already friends --}}
            @if($isFriend)
                <form action="{{ route('friends.remove-friend', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-secondary">Unfriend</button>
                </form>
            {{-- If friend request already sent --}}
            @elseif($requestSent)
                <button class="btn btn-secondary" disabled>Request Sent</button>

            {{-- If received a friend request --}}
            @elseif($requestReceived)
                <form action="{{ route('friends.accept-request', $requestReceived->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-primary">Accept Request</button>
                </form>
                <form action="{{ route('friends.reject-request',  $requestReceived->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-secondary">Decline</button>
                </form>

            {{-- Not friends yet --}}
            @else
                <form action="{{ route('friends.send-request', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-primary">Add Friend</button>
                </form>
            @endif
            <a href="{{ route('messages.create', $user->id) }}" class="btn btn-primary">Message</a>
            @endif
        </div>
    </div>

    <div class="profile-nav">
        <div class="nav-tabs">
            <div class="tab active">Posts</div>
            <div class="tab">About</div>
            <div class="tab" >Friends</div>
            <div class="tab">Photos</div>
            <div class="tab">Videos</div>
            <div class="tab">Reels</div>
            <div class="tab">More ...</div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container">
    <!-- Left Sidebar -->
    <div class="sidebar">
        <h2 class="sidebar-title">Intro</h2>
        <div class="sidebar-item">
            <p>No details to show</p>
        </div>

        <h2 class="sidebar-title">Photos</h2>
        <div class="sidebar-item">
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 4px;">
                @php
                    $photoPosts = $posts->whereNotNull('image')->take(8);
                @endphp

                @forelse($photoPosts as $post)
                    <div style="aspect-ratio: 1/1; border-radius: 8px; overflow:hidden;">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                             style="width:100%; height:100%; object-fit:cover;">
                    </div>
                @empty
                    <div style="grid-column: span 3; text-align:center; padding:10px; color:#65676b;">
                        No photos to show
                    </div>
                @endforelse
            </div>

            <button class="btn btn-secondary" style="width: 100%; margin-top: 10px;">See All Photos</button>
        </div>

        <h2 class="sidebar-title">Friends</h2>
        <div class="sidebar-item">
            <p>{{ $friends->count() }} friends</p>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 4px; margin-top: 8px;">
                @foreach($friends->take(9) as $friend)
                    <div>
                        <div style="background-color: #e4e6eb; aspect-ratio: 1/1; border-radius: 8px;">
                            <img src="{{ $friend->image ? asset('storage/' . $friend->image) : 'https://randomuser.me/api/portraits/men/2.jpg' }}"
                                 style="width:100%; height:100%; object-fit:cover;">
                        </div>
                        <p style="font-size: 12px; margin-top: 4px;">{{ $friend->first_name }} {{ $friend->surname }}</p>
                    </div>
                @endforeach
            </div>
            <button class="btn btn-secondary" style="width: 100%; margin-top: 10px;">See All Friends</button>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Show all user posts -->
        @foreach($posts as $post)
            @include('partials.post', ['post' => $post])
        @endforeach
    </div>
</div>

<script>
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
<script src="{{ asset('js/like.js') }}"></script>
<script src="{{ asset('js/comment.js') }}"></script>
@endsection

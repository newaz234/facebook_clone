@extends('layout.app')
@section('title', 'profile')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/post.css') }}">
<link rel="stylesheet" href="{{ asset('css/create_post.css') }}">
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
            <h1 class="profile-name">{{$user->first_name}} {{$user->surname}}</h1>
                <span>{{ $friends->count() }} friends</span>
            </div>
           
            <div class="profile-actions">
                <button class="btn btn-primary">Add to Story</button>
                <button class="btn btn-secondary">Edit Profile</button>
            </div>
        </div>
        <div class="profile-nav">
            <div class="nav-tabs">
                <div class="tab active">Posts</div>
                <div class="tab">About</div>
                <div class="tab" onclick="window.location.href='{{ route('friends.index') }}'">Friends</div>
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
                <button class="btn btn-secondary" style="width: 100%; margin-top: 10px;">Edit Details</button>
            </div>
            
            <h2 class="sidebar-title">Photos</h2>
<div class="sidebar-item">
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 4px;">

        {{-- Profile picture --}}
        @if($user->image)
            <div style="aspect-ratio: 1/1; border-radius: 8px; overflow:hidden;">
                <img src="{{ asset('storage/' . $user->image) }}" 
                     alt="Profile Photo" 
                     style="width:100%; height:100%; object-fit:cover;">
            </div>
        @endif

        {{-- Post images --}}
        @php
            $photoPosts = $posts->whereNotNull('image')->take(8); // take first 8 post images
        @endphp

        @forelse($photoPosts as $post)
            <div style="aspect-ratio: 1/1; border-radius: 8px; overflow:hidden;">
                <img src="{{ asset('storage/' . $post->image) }}" 
                     alt="Post Image" 
                     style="width:100%; height:100%; object-fit:cover;">
            </div>
        @empty
            <div style="grid-column: span 3; text-align:center; padding:10px; color:#65676b;">
                No photos to show
            </div>
        @endforelse
    </div>

    <button class="btn btn-secondary" style="width: 100%; margin-top: 10px;">
        See All Photos
    </button>
</div>

            
            <h2 class="sidebar-title">Friends</h2>
            <div class="sidebar-item">
                <p>{{ $friends->count() }} friends</p>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 4px; margin-top: 8px;">
                @foreach($friends->take(9) as $friend)
                    <div>
                        <div style="background-color: #e4e6eb;  aspect-ratio: 1/1; ; border-radius: 8px;">
                        <img src="{{ $friend->image ? asset('storage/' . $friend->image) : 'https://randomuser.me/api/portraits/men/2.jpg' }}" style="width:100%; height:100%; object-fit:cover;">
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
            <!-- Create Post -->
            <div class="create-post">
            @include('create_post')
                <div class="post-input">
                    <img src="{{ asset('storage/' . $user->image) }}" alt="Profile">
                    <input type="text" placeholder="What's on your mind, {{$user->first_name}}?" onclick="openpostModal()">
                </div>
                <div class="post-actions">
                    <div class="post-action live-video">
                        <i class="fas fa-video"></i>
                        <span>Live video</span>
                    </div>
                    <div class="post-action photo-video">
                        <i class="fas fa-images"></i>
                        <span>Photo/video</span>
                    </div>
                    <div class="post-action feeling-activity">
                        <i class="fas fa-smile"></i>
                        <span>Feeling/activity</span>
                    </div>
                </div>
            </div>
            @foreach($posts as $post)
                @include('partials.post', ['post' => $post])
            @endforeach
        </div>
       
    </div>
    <script src="{{ asset('js/post_create.js') }}"></script>
    <script src="{{ asset('js/like.js') }}"></script>
    <script src="{{ asset('js/comment.js') }}"></script>
    <script>
        // Simple tab functionality
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
       
    </script>
@endsection
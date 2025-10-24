@extends('layout.app')

@section('title', 'Homepage')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/comment.css') }}">
<link rel="stylesheet" href="{{ asset('css/create_post.css') }}">
<link rel="stylesheet" href="{{ asset('css/post.css') }}">
@endsection
@section('content')
<div class="content">
    @if (session('success'))
      <div class="success-message">{{ session('success') }}</div>
    @endif
</div>
    <h2 class="welcome">Welcome to Facebook!</h2>
    <!-- Main Content -->
    <div class="container" id="main">
        <!-- Left Sidebar -->
        <div class="left-sidebar">
            <a href="#" class="sidebar-link">
                <img src="{{ asset('storage/' . $user->image) }}" alt="Profile">
                <span onclick="window.location.href='{{ route('profile') }}'">{{$user->first_name}} {{$user->surname}}</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-user-friends"></i>
                <span onclick="window.location.href='{{ route('friends.index') }}'">Friends</span>
            </a>
    
        </div>
        
        <!-- Main Content -->
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
            
            <!-- News Feed -->
            @foreach($posts as $post)
                @include('partials.post', ['post' => $post])
            @endforeach
            
        </div>
        
        <!-- Right Sidebar -->
        <div class="right-sidebar">
         
            <div class="divider"></div>
            
            <div class="contacts">
                <div class="sidebar-title">Contacts</div>
                
                @foreach($friends as $friend)
                    <div class="contact">
                        <div class="online-status">
                            <img src="{{ asset('storage/' . $friend->image) }}" alt="{{ $friend->first_name }}">
                        </div>
                        <span>{{ $friend->first_name }} {{ $friend->surname }}</span>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <script src="{{ asset('js/post_create.js') }}"></script>
    <script src="{{ asset('js/like.js') }}"></script>
    <script src="{{ asset('js/comment.js') }}"></script>
   
@endsection
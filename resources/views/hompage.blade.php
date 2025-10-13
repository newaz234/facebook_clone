@extends('layout.app')

@section('title', 'Homepage')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/comment.css') }}">
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
                <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Profile">
                <span>John Doe</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-user-friends"></i>
                <span>Friends</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-users"></i>
                <span>Groups</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-store"></i>
                <span>Marketplace</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-video"></i>
                <span>Watch</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-history"></i>
                <span>Memories</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-bookmark"></i>
                <span>Saved</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-flag"></i>
                <span>Pages</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-calendar"></i>
                <span>Events</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-chevron-down"></i>
                <span>See more</span>
            </a>
            
            <div class="divider"></div>
            
            <div class="sidebar-heading">Your shortcuts</div>
            <a href="#" class="sidebar-link">
                <i class="fas fa-gamepad"></i>
                <span>Gaming</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-heart"></i>
                <span>Dating</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-compass"></i>
                <span>Travel</span>
            </a>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Stories -->
            <div class="stories-container">
                <div class="story">
                    <img src="https://picsum.photos/id/100/112/200" alt="Story">
                    <img class="story-avatar" src="https://randomuser.me/api/portraits/men/1.jpg" alt="Avatar">
                    <div class="story-username">Your Story</div>
                </div>
                <div class="story">
                    <img src="https://picsum.photos/id/101/112/200" alt="Story">
                    <img class="story-avatar" src="https://randomuser.me/api/portraits/women/2.jpg" alt="Avatar">
                    <div class="story-username">Sarah</div>
                </div>
                <div class="story">
                    <img src="https://picsum.photos/id/102/112/200" alt="Story">
                    <img class="story-avatar" src="https://randomuser.me/api/portraits/men/3.jpg" alt="Avatar">
                    <div class="story-username">Mike</div>
                </div>
                <div class="story">
                    <img src="https://picsum.photos/id/103/112/200" alt="Story">
                    <img class="story-avatar" src="https://randomuser.me/api/portraits/women/4.jpg" alt="Avatar">
                    <div class="story-username">Emma</div>
                </div>
                <div class="story">
                    <img src="https://picsum.photos/id/104/112/200" alt="Story">
                    <img class="story-avatar" src="https://randomuser.me/api/portraits/men/5.jpg" alt="Avatar">
                    <div class="story-username">Alex</div>
                </div>
            </div>
            
            <!-- Create Post -->
            <div class="create-post">
                <div class="post-input">
                    <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Profile">
                    <input type="text" placeholder="What's on your mind, John?">
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
            <div class="news-feed">
           
                <div class="post-header">
                    <img src="{{ asset('storage/image/profile_pic.png') }}">
                    <div class="post-info">
                        <h3>{{ $post->user->first_name  }} {{ $post->user->surname}}  </h3>
                        <span>{{ $post->created_at->diffForHumans() }}<i class="fas fa-globe-americas"></i></span>
                    </div>
                </div>
                @include('comment')
                <div class="post-content">
                    <p>{{$post->content}}</p>
                      @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
                      @endif
                </div>
                <div class="post-stats">
                    <div class="likes">
                        <i class="fas fa-thumbs-up"></i> 245
                    </div>
                    <div class="comments-shares">
                        45 comments · 12 shares
                    </div>
                </div>
                <div class="post-buttons">
                    <div class="post-button">
                        <i class="far fa-thumbs-up"></i>
                        <span>Like</span>
                    </div>
                    <div class="post-button">
                        <i class="far fa-comment"></i>
                        <span onclick="openCommentModal()">Comment</span>
                    </div>
                    <div class="post-button">
                        <i class="fas fa-share"></i>
                        <span>Share</span>
                    </div>
                </div>
                
            </div>
            @endforeach
            
        </div>
        
        <!-- Right Sidebar -->
        <div class="right-sidebar">
            <div class="sponsored">
                <div class="sidebar-title">Sponsored</div>
                <div class="sponsored-item">
                    <img src="#" alt="Ad">
                    <div>
                        <div>Summer Collection 2023</div>
                        <div>example.com</div>
                    </div>
                </div>
            </div>
            
            <div class="birthdays">
                <div class="sidebar-title">Birthdays</div>
                <div class="birthday-item">
                    <i class="fas fa-gift"></i>
                    <span><strong>Emma Thompson</strong> and <strong>2 others</strong> have birthdays today.</span>
                </div>
            </div>
            
            <div class="divider"></div>
            
            <div class="contacts">
                <div class="sidebar-title">Contacts</div>
                <div class="contact">
                    <div class="online-status">
                        <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="Contact">
                    </div>
                    <span>Sarah Johnson</span>
                </div>
                <div class="contact">
                    <div class="online-status">
                        <img src="https://randomuser.me/api/portraits/men/3.jpg" alt="Contact">
                    </div>
                    <span>Mike Williams</span>
                </div>
                <div class="contact">
                    <div class="online-status">
                        <img src="https://randomuser.me/api/portraits/women/4.jpg" alt="Contact">
                    </div>
                    <span>Emma Thompson</span>
                </div>
                <div class="contact">
                    <img src="https://randomuser.me/api/portraits/men/5.jpg" alt="Contact">
                    <span>Alex Rodriguez</span>
                </div>
                <div class="contact">
                    <img src="https://randomuser.me/api/portraits/women/6.jpg" alt="Contact">
                    <span>Lisa Brown</span>
                </div>
            </div>
        </div>
    </div>

    <script>
function openCommentModal() {
    document.getElementById('commentModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeCommentModal() {
    document.getElementById('commentModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}
    </script>
@endsection
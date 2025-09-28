@extends('layout.app')
@section('title', 'profile')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
 @endsection


@section('content')
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="cover-photo">
        <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Profile">
        </div>
        <div class="profile-picture">
        <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Profile">
        </div>
        <div class="profile-info">
           
            <div class="profile-stats">
            <h1 class="profile-name">Newaz Mohammad Hamim</h1>
                <span>834 friends</span>
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
                <div class="tab">Friends</div>
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
                    <div style="background-color: #e4e6eb; height: 80px; border-radius: 8px;"></div>
                    <div style="background-color: #e4e6eb; height: 80px; border-radius: 8px;"></div>
                    <div style="background-color: #e4e6eb; height: 80px; border-radius: 8px;"></div>
                    <div style="background-color: #e4e6eb; height: 80px; border-radius: 8px;"></div>
                    <div style="background-color: #e4e6eb; height: 80px; border-radius: 8px;"></div>
                    <div style="background-color: #e4e6eb; height: 80px; border-radius: 8px;"></div>
                </div>
                <button class="btn btn-secondary" style="width: 100%; margin-top: 10px;">See All Photos</button>
            </div>
            
            <h2 class="sidebar-title">Friends</h2>
            <div class="sidebar-item">
                <p>834 friends</p>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 4px; margin-top: 8px;">
                    <div>
                        <div style="background-color: #e4e6eb; height: 80px; border-radius: 8px;"></div>
                        <p style="font-size: 12px; margin-top: 4px;">Friend One</p>
                    </div>
                    <div>
                        <div style="background-color: #e4e6eb; height: 80px; border-radius: 8px;"></div>
                        <p style="font-size: 12px; margin-top: 4px;">Friend Two</p>
                    </div>
                    <div>
                        <div style="background-color: #e4e6eb; height: 80px; border-radius: 8px;"></div>
                        <p style="font-size: 12px; margin-top: 4px;">Friend Three</p>
                    </div>
                </div>
                <button class="btn btn-secondary" style="width: 100%; margin-top: 10px;">See All Friends</button>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Create Post -->
            <div class="create-post">
                <div class="post-input">
                    <div class="avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="post-text">What's on your mind, Newaz?</div>
                </div>
                <div class="post-options">
                    <div class="post-option">
                        <i class="fas fa-video"></i>
                        <span>Live video</span>
                    </div>
                    <div class="post-option">
                        <i class="fas fa-photo-video"></i>
                        <span>Photo/video</span>
                    </div>
                    <div class="post-option">
                        <i class="fas fa-smile"></i>
                        <span>Life event</span>
                    </div>
                </div>
            </div>

            <!-- Post 1 -->
            <div class="post">
                <div class="post-header">
                    <div class="avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <div class="post-author">Newaz Mohammad Hamim</div>
                        <div class="post-time">Yesterday at 3:45 PM · <i class="fas fa-globe-americas"></i></div>
                    </div>
                </div>
                <div class="post-content">
                    <p>Enjoying a beautiful day out with friends! 😊</p>
                </div>
                <div class="post-image"></div>
                <div class="post-stats">
                    <div><i class="fas fa-thumbs-up"></i> 125</div>
                    <div>24 Comments · 5 Shares</div>
                </div>
                <div class="post-actions">
                    <div class="post-action"><i class="far fa-thumbs-up"></i> Like</div>
                    <div class="post-action"><i class="far fa-comment"></i> Comment</div>
                    <div class="post-action"><i class="fas fa-share"></i> Share</div>
                </div>
            </div>

            <!-- Post 2 -->
            <div class="post">
                <div class="post-header">
                    <div class="avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <div class="post-author">Newaz Mohammad Hamim</div>
                        <div class="post-time">3 days ago · <i class="fas fa-globe-americas"></i></div>
                    </div>
                </div>
                <div class="post-content">
                    <p>Just finished reading an amazing book! Highly recommend "The Alchemist" by Paulo Coelho.</p>
                </div>
                <div class="post-stats">
                    <div><i class="fas fa-thumbs-up"></i> 89</div>
                    <div>15 Comments · 2 Shares</div>
                </div>
                <div class="post-actions">
                    <div class="post-action"><i class="far fa-thumbs-up"></i> Like</div>
                    <div class="post-action"><i class="far fa-comment"></i> Comment</div>
                    <div class="post-action"><i class="fas fa-share"></i> Share</div>
                </div>
            </div>
        </div>
       
    </div>

    <script>
        // Simple tab functionality
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Post creation placeholder click
        document.querySelector('.post-text').addEventListener('click', function() {
            alert('Post creation dialog would open here');
        });
    </script>
@endsection
@extends('layout.app')

@section('title', 'Homepage')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/search-result.css') }}">
 @endsection
@section('content')
    <!-- Main Content -->
    <div class="main-container">
        <!-- Sidebar Filters -->
        <div class="sidebar">
            <div class="filter-section">
                <div class="filter-title">Filters</div>
                <div class="filter-item active">
                    <div class="filter-icon">📝</div>
                    <span>All</span>
                </div>
                <div class="filter-item">
                    <div class="filter-icon">👤</div>
                    <span>People</span>
                </div>
                <div class="filter-item">
                    <div class="filter-icon">📄</div>
                    <span>Posts</span>
                </div>
                <div class="filter-item">
                    <div class="filter-icon">📸</div>
                    <span>Photos</span>
                </div>
                <div class="filter-item">
                    <div class="filter-icon">🎬</div>
                    <span>Videos</span>
                </div>
                <div class="filter-item">
                    <div class="filter-icon">🏪</div>
                    <span>Marketplace</span>
                </div>
                <div class="filter-item">
                    <div class="filter-icon">📄</div>
                    <span>Pages</span>
                </div>
                <div class="filter-item">
                    <div class="filter-icon">👥</div>
                    <span>Groups</span>
                </div>
                <div class="filter-item">
                    <div class="filter-icon">📅</div>
                    <span>Events</span>
                </div>
            </div>
        </div>

        <!-- Results Area -->
        <div class="results">
            <!-- Person Result -->
         <div class="result-card">
            <h2>People</h2>
            <div class="person">
                <div class="result-header">
                    <div class="profile-pic">JS</div>
                    <div class="result-info">
                        <div class="result-name">John Smith</div>
                        <div class="result-meta">Web Developer • 847 mutual friends</div>
                        <div class="result-meta">San Francisco, California</div>
                    </div>
                </div>
               
                <div class="action-buttons">
                    <button class="btn btn-primary">Add Friend</button>
                    <button class="btn btn-secondary">Message</button>
                </div>
            </div>
            <div class="person">
                <div class="result-header">
                    <div class="profile-pic" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">MJ</div>
                    <div class="result-info">
                        <div class="result-name">Michael Johnson</div>
                        <div class="result-meta">Senior Web Developer at TechCorp • 523 mutual friends</div>
                        <div class="result-meta">New York, New York</div>
                    </div>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-primary">Add Friend</button>
                    <button class="btn btn-secondary">Message</button>
                </div>
            </div>
        </div>
            <!-- Post Result -->
           
            <div class="result-card">
                <div class="result-header">
                    <div class="profile-pic" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">SD</div>
                    <div class="result-info">
                        <div class="result-name">Sarah Davis</div>
                        <div class="result-meta">2 hours ago • 🌎</div>
                    </div>
                </div>
                <div class="post-content">
                    Just finished my latest web development project! 🚀 Really excited about the new features we implemented using React and TypeScript. The performance improvements are incredible!
                    <div class="post-image"></div>
                </div>
                <div class="post-stats">
                    <span>❤️👍😮 342</span>
                    <span>89 comments • 45 shares</span>
                </div>
                <div class="post-actions">
                    <div class="post-action">👍 Like</div>
                    <div class="post-action">💬 Comment</div>
                    <div class="post-action">↗️ Share</div>
                </div>
            </div>

            <!-- Page Result -->
            <div class="result-card">
                <div class="result-header">
                    <div class="profile-pic" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">WD</div>
                    <div class="result-info">
                        <div class="result-name">Web Development Hub</div>
                        <div class="result-meta">Community • 125K followers</div>
                    </div>
                </div>
                <div class="result-description">
                    A community for web developers to share knowledge, resources, and connect with fellow developers. Latest tutorials, tips, and industry news.
                </div>
                <div class="action-buttons">
                    <button class="btn btn-primary">Like Page</button>
                    <button class="btn btn-secondary">Follow</button>
                </div>
            </div>

            <!-- Group Result -->
            <div class="result-card">
                <div class="result-header">
                    <div class="profile-pic" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">FD</div>
                    <div class="result-info">
                        <div class="result-name">Frontend Developers Community</div>
                        <div class="result-meta">Private Group • 89.5K members</div>
                    </div>
                </div>
                <div class="result-description">
                    Join thousands of frontend developers sharing code, asking questions, and learning together. Daily discussions on React, Vue, Angular, and more.
                </div>
                <div class="action-buttons">
                    <button class="btn btn-primary">Join Group</button>
                </div>
            </div>
        </div>
    </div>
    @endsection
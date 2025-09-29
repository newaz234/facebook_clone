@extends('layout.app')

@section('title', 'Friends')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/friends.css') }}">
 @endsection
@section('content')
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h1>Friends</h1>
                <button class="settings-btn">⚙</button>
            </div>
            
            <ul class="sidebar-menu">
                <li class="menu-item active">
                    <div class="icon">👥</div>
                    <span class="menu-text">Home</span>
                </li>
                <li class="menu-item">
                    <div class="icon">👤</div>
                    <span class="menu-text">Friend Requests</span>
                    <span class="arrow">›</span>
                </li>
                <li class="menu-item">
                    <div class="icon">👥</div>
                    <span class="menu-text">Suggestions</span>
                    <span class="arrow">›</span>
                </li>
                <li class="menu-item">
                    <div class="icon">👥</div>
                    <span class="menu-text">All friends</span>
                    <span class="arrow">›</span>
                </li>
                <li class="menu-item">
                    <div class="icon">🎁</div>
                    <span class="menu-text">Birthdays</span>
                </li>
                <li class="menu-item">
                    <div class="icon">📋</div>
                    <span class="menu-text">Custom Lists</span>
                    <span class="arrow">›</span>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-header">
                <h2>Friend Requests</h2>
                <a href="#" class="see-all">See all</a>
            </div>

            <div class="requests-grid">
                <!-- Friend Request Card 1 -->
                <div class="request-card">
                    <div class="card-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Profile">
                    </div>
                    <div class="card-content">
                        <div class="card-name">Sah Alom</div>
                        <div class="mutual-friends">
                            <div class="mutual-avatars">
                                <div class="mutual-avatar"></div>
                                <div class="mutual-avatar"></div>
                            </div>
                            9 mutual friends
                        </div>
                        <button class="confirm-btn">Confirm</button>
                        <button class="delete-btn">Delete</button>
                    </div>
                </div>

                <!-- Friend Request Card 2 -->
                <div class="request-card">
                    <div class="card-image" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);"></div>
                    <div class="card-content">
                        <div class="card-name">Oliul Rahman</div>
                        <div class="mutual-friends">
                            <div class="mutual-avatars">
                                <div class="mutual-avatar"></div>
                                <div class="mutual-avatar"></div>
                            </div>
                            21 mutual friends
                        </div>
                        <button class="confirm-btn">Confirm</button>
                        <button class="delete-btn">Delete</button>
                    </div>
                </div>

                <!-- Friend Request Card 3 -->
                <div class="request-card">
                    <div class="card-image" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);"></div>
                    <div class="card-content">
                        <div class="card-name">Md Shahriar</div>
                        <div class="mutual-friends">
                            <div class="mutual-avatars">
                                <div class="mutual-avatar"></div>
                                <div class="mutual-avatar"></div>
                            </div>
                            34 mutual friends
                        </div>
                        <button class="confirm-btn">Confirm</button>
                        <button class="delete-btn">Delete</button>
                    </div>
                </div>

                <!-- Friend Request Card 4 -->
                <div class="request-card">
                    <div class="card-image" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);"></div>
                    <div class="card-content">
                        <div class="card-name">চুক্তাকি পাসেল সা...</div>
                        <div class="mutual-friends">
                            <div class="mutual-avatars">
                                <div class="mutual-avatar"></div>
                                <div class="mutual-avatar"></div>
                            </div>
                            81 mutual friends
                        </div>
                        <button class="confirm-btn">Confirm</button>
                        <button class="delete-btn">Delete</button>
                    </div>
                </div>

                <!-- Friend Request Card 5 -->
                <div class="request-card">
                    <div class="card-image" style="background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);"></div>
                    <div class="card-content">
                        <div class="card-name">Sarah Ahmed</div>
                        <div class="mutual-friends">
                            <div class="mutual-avatars">
                                <div class="mutual-avatar"></div>
                                <div class="mutual-avatar"></div>
                            </div>
                            12 mutual friends
                        </div>
                        <button class="confirm-btn">Confirm</button>
                        <button class="delete-btn">Delete</button>
                    </div>
                </div>

                <!-- Friend Request Card 6 -->
                <div class="request-card">
                    <div class="card-image" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);"></div>
                    <div class="card-content">
                        <div class="card-name">Karim Hassan</div>
                        <div class="mutual-friends">
                            <div class="mutual-avatars">
                                <div class="mutual-avatar"></div>
                                <div class="mutual-avatar"></div>
                            </div>
                            28 mutual friends
                        </div>
                        <button class="confirm-btn">Confirm</button>
                        <button class="delete-btn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add interactive functionality
        document.querySelectorAll('.confirm-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.textContent = 'Request Confirmed';
                this.style.background = '#42b72a';
                this.disabled = true;
            });
        });

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const card = this.closest('.request-card');
                card.style.opacity = '0';
                card.style.transform = 'scale(0.9)';
                card.style.transition = 'all 0.3s';
                setTimeout(() => card.remove(), 300);
            });
        });

        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
@endsection
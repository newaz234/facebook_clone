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
                <li class="menu-item">
                    <a href="{{ route('friends.suggestions') }}" class="menu-link">
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

        <!-- Main Content -->
        <div class="main-content">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <div class="content-header">
                <h2>Friend Requests</h2>
                <a href="#" class="see-all">See all</a>
            </div>

            @if($pendingRequests->count() > 0)
            <div class="requests-grid">
                @foreach($pendingRequests as $request)
                <div class="request-card" id="request-{{ $request->id }}">
                    <div class="card-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <img src="{{ asset('storage/' . $request->sender->image) ?? 'https://randomuser.me/api/portraits/men/'.rand(1,100).'.jpg' }}" alt="Profile">
                    </div>
                    <div class="card-content">
                        <div class="card-name">{{ $request->sender->first_name }} {{ $request->sender->surname }}</div>
                        <div class="mutual-friends">
                            <div class="mutual-avatars">
                                <div class="mutual-avatar"></div>
                                <div class="mutual-avatar"></div>
                            </div>
                            {{ Auth::user()->mutualFriendsCount($request->sender) }} mutual friends
                        </div>
                        <form action="{{ route('friends.accept-request', $request->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="confirm-btn">Confirm</button>
                        </form>
                        <form action="{{ route('friends.reject-request', $request->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('POST')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="no-requests">
                <p>No pending friend requests</p>
            </div>
            @endif
        </div>
    </div>

    <script>
        // Add interactive functionality
        document.querySelectorAll('.confirm-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const form = this.closest('form');
                this.textContent = 'Request Confirmed';
                this.style.background = '#42b72a';
                this.disabled = true;
                
                // Optionally submit form via AJAX
                e.preventDefault();
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams(new FormData(form))
                }).then(response => {
                    if (response.ok) {
                        const card = this.closest('.request-card');
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.9)';
                        card.style.transition = 'all 0.3s';
                        setTimeout(() => card.remove(), 300);
                    }
                });
            });
        });

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const form = this.closest('form');
                const card = this.closest('.request-card');
                
                e.preventDefault();
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams(new FormData(form))
                }).then(response => {
                    if (response.ok) {
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.9)';
                        card.style.transition = 'all 0.3s';
                        setTimeout(() => card.remove(), 300);
                    }
                });
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
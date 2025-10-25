@extends('layout.app')

@section('title', 'Search Results')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/search-result.css') }}">
<link rel="stylesheet" href="{{ asset('css/comment.css') }}">
<link rel="stylesheet" href="{{ asset('css/post.css') }}">
@endsection

@section('content')
<div class="main-container">

    <!-- Sidebar Filters -->
    <div class="sidebar">
        <div class="filter-section">
            <div class="filter-title">Filters</div>
            <div class="filter-item active" data-filter="all">
                <div class="filter-icon">📝</div>
                <span>All</span>
            </div>
            <div class="filter-item" data-filter="people">
                <div class="filter-icon">👤</div>
                <span>People</span>
            </div>
            <div class="filter-item" data-filter="posts">
                <div class="filter-icon">📄</div>
                <span>Posts</span>
            </div>
        </div>
    </div>

    <!-- Results Area -->
    <div class="results">

        <!-- People Section -->
        <div class="result-card people-section">
            <h2>People</h2>
            @forelse($people as $person)
                <div class="person">
                    <div class="result-header">
                        <div class="profile-pic">
                            @if($person->image)
                                <img src="{{ asset('storage/' . $person->image) }}" alt="Profile">
                            @else
                                {{ strtoupper(substr($person->first_name,0,1)) }}{{ strtoupper(substr($person->surname,0,1)) }}
                            @endif
                        </div>
                        <div class="result-info">
                            <div class="result-name" onclick="window.location.href='{{ route('profile.show', $person->id) }}'">{{ $person->first_name }} {{ $person->surname }}</div>
                            <div class="result-meta">
                                @if($user->id==$person->id)
                                {{ $person->allfriends()->count() }} friends
                                @else
                                 {{ $person->friends()->count() }} mutual friends
                                 @endif
                            </div>
                         
                        </div>
                    </div>
                    <div class="result-actions">
                        @if($person->id === auth()->user()->id)
                            <!-- No action buttons for self -->
                        @else
                        @if(auth()->user()->isFriendWith($person->id))
                            <form action="{{ route('friends.remove-friend', $person->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-secondary">Unfriend</button>
                            </form>
                        @elseif(auth()->user()->hasSentFriendRequestTo($person->id))
                            <button class="btn btn-secondary" disabled>Request Sent</button>
                        @elseif(auth()->user()->hasReceivedFriendRequestFrom($person->id))
                            <form action="{{ route('friends.accept-request', auth()->user()->receivedFriendRequests()->where('sender_id', $person->id)->first()->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-primary">Accept Request</button>
                            </form>
                            <form action="{{ route('friends.reject-request', auth()->user()->receivedFriendRequests()->where('sender_id', $person->id)->first()->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-secondary">Decline</button>
                            </form>
                        @else
                            <form action="{{ route('friends.send-request', $person->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-primary">Add Friend</button>
                            </form>
                        @endif
                        <a href="{{ route('messages.create', $person->id) }}" class="btn btn-primary">Message</a>
                        @endif
                </div>
            @empty
                <p>No people found.</p>
            @endforelse
        </div>

        <!-- Posts Section -->
        <div class="result-card posts-section">
            <h2>Posts</h2>
            @forelse($posts as $post)
                @include('partials.post', ['post' => $post])
            @empty
                <p>No posts found.</p>
            @endforelse
        </div>

    </div>
</div>
<script src="{{ asset('js/like.js') }}"></script>
<script src="{{ asset('js/comment.js') }}"></script>
<script>
    const filterItems = document.querySelectorAll('.filter-item');
    const peopleSection = document.querySelector('.people-section');
    const postsSection = document.querySelector('.posts-section');

    filterItems.forEach(item => {
        item.addEventListener('click', () => {
            filterItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');

            const filter = item.dataset.filter;
            if(filter === 'people') {
                peopleSection.style.display = 'block';
                postsSection.style.display = 'none';
            } else if(filter === 'posts') {
                peopleSection.style.display = 'none';
                postsSection.style.display = 'block';
            } else { // all
                peopleSection.style.display = 'block';
                postsSection.style.display = 'block';
            }
        });
    });
</script>
@endsection

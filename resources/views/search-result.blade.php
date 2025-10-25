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
                            <div class="result-name">{{ $person->first_name }} {{ $person->surname }}</div>
                            <div class="result-meta">
                                {{ $person->job_title ?? 'No title' }} • {{ $person->friends()->count() }} mutual friends
                            </div>
                            <div class="result-meta">{{ $person->location ?? 'Unknown' }}</div>
                        </div>
                    </div>
                    <div class="action-buttons">
                        <button class="btn btn-primary">Add Friend</button>
                        <button class="btn btn-secondary">Message</button>
                    </div>
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

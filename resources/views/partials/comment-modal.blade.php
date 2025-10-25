
<div class="comment">
    <div class="comment-avatar">
        <img src="{{ asset('storage/' . $cmnt->user->image) }}" alt="Avatar">
    </div>
    <div class="comment-content">
        <div class="comment-bubble">
            <div class="comment-author" onclick="window.location.href='{{ route('profile.show', $cmnt->user->id) }}'" >{{ $cmnt->user->first_name }} {{ $cmnt->user->surname }}</div>
            <div class="comment-text">{{ $cmnt->content }}</div>
        </div>
        <div class="comment-meta">
            <span class="like-action">Like</span>
            <span class="reply-action">Reply</span>
            <span>{{ $cmnt->created_at->diffForHumans() }}</span>
        </div>

        <div class="reply-container">
            @foreach($cmnt->replies as $reply)
                @include('partials.comment-modal', ['cmnt' => $reply])
            @endforeach
        </div>
    </div>
</div>

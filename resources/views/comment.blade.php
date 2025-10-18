
<div class="comment-window" id="commentModal" data-post="">
    <div class="window-content" id="commentModalContent">
        <div class="window-header">
            <div class="header-left">
                <div class="post-owner-avatar">
                <img src="{{ asset('storage/' . $post->user->image) }}" alt="Post Image" >
                </div>
                <div class="post-info">
                <h3>{{ $post->user->first_name }}'s post</h3>
                 <p>Original post · {{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <button onclick="closeCommentModal()">×</button>
        </div>

        <div class="comments-container" id="commentsContainer">
            <!-- Comments loaded dynamically -->
        </div>

        @auth
        <div class="comment-input-section">
            <div class="comment-input-container">
                <div class="post-owner-avatar">
                    <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="Avatar">
                </div>
                <div class="input-wrapper">
                    <textarea id="commentInput" placeholder="Write a comment..."></textarea>
                </div>
            </div>
            <div class="input-actions">
                <button class="post-btn" id="commentBtn" disabled>Post</button>
            </div>
        </div>
        @endauth
    </div>
</div>


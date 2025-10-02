
<div class="comment-window" id="commentModal">
    <div class="window-content">
        <!-- Window Header -->
        <div class="window-header">
            <div class="header-left">
                <div class="post-owner-avatar"></div>
                <div class="post-info">
                    <h3>John Smith's post</h3>
                    <p>Original post · 2 hours ago</p>
                </div>
            </div>
            <button onclick="closeCommentModal()">×</button>
        </div>
        <!-- Comments Container -->
        <div class="comments-container">
            <div class="comment">
                <div class="comment-avatar avatar-2"></div>
                <div class="comment-content">
                    <div class="comment-bubble">
                        <div class="comment-author">Sarah Johnson</div>
                        <div class="comment-text">This looks absolutely beautiful! 😍 Which part of the city is this?</div>
                    </div>
                    <div class="comment-meta">
                        <span class="like-action">Like</span>
                        <span>Reply</span>
                        <span>2h</span>
                    </div>
                </div>
            </div>

            <div class="reply-container">
                <div class="comment">
                    <div class="comment-avatar avatar-1"></div>
                    <div class="comment-content">
                        <div class="comment-bubble">
                            <div class="comment-author">John Smith</div>
                            <div class="comment-text">Downtown near the waterfront! You should visit sometime.</div>
                        </div>
                        <div class="comment-meta">
                            <span class="like-action">Like</span>
                            <span>Reply</span>
                            <span>2h</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="comment">
                <div class="comment-avatar avatar-3"></div>
                <div class="comment-content">
                    <div class="comment-bubble">
                        <div class="comment-author">Mike Chen</div>
                        <div class="comment-text">Great shot! The lighting is perfect 📸</div>
                    </div>
                    <div class="comment-meta">
                        <span class="like-action liked">Like</span>
                        <span>Reply</span>
                        <span>1h</span>
                    </div>
                </div>
            </div>

            <div class="comment">
                <div class="comment-avatar avatar-4"></div>
                <div class="comment-content">
                    <div class="comment-bubble">
                        <div class="comment-author">Emma Davis</div>
                        <div class="comment-text">We should plan a trip there together soon! I've been wanting to explore that area for months now.</div>
                    </div>
                    <div class="comment-meta">
                        <span class="like-action">Like</span>
                        <span>Reply</span>
                        <span>45m</span>
                    </div>
                </div>
            </div>

            <div class="comment">
                <div class="comment-avatar avatar-5"></div>
                <div class="comment-content">
                    <div class="comment-bubble">
                        <div class="comment-author">Alex Rodriguez</div>
                        <div class="comment-text">Amazing vibes! 🌟</div>
                    </div>
                    <div class="comment-meta">
                        <span class="like-action">Like</span>
                        <span>Reply</span>
                        <span>30m</span>
                    </div>
                </div>
            </div>

            <div class="view-replies">↓ View 3 more replies</div>

            <div class="comment">
                <div class="comment-avatar avatar-6"></div>
                <div class="comment-content">
                    <div class="comment-bubble">
                        <div class="comment-author">Lisa Wong</div>
                        <div class="comment-text">The colors in this photo are stunning! What camera did you use?</div>
                    </div>
                    <div class="comment-meta">
                        <span class="like-action">Like</span>
                        <span>Reply</span>
                        <span>15m</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comment Input Section -->
        <div class="comment-input-section">
            <div class="comment-input-container">
                <div class="user-avatar"></div>
                <div class="input-wrapper">
                    <textarea class="comment-input" placeholder="Write a comment..." id="commentInput"></textarea>
                </div>
            </div>
            <div class="input-actions">
                <div class="action-icons">
                    <button class="icon-btn" title="Emoji">😊</button>
                    <button class="icon-btn" title="Camera">📷</button>
                    <button class="icon-btn" title="GIF">🎬</button>
                    <button class="icon-btn" title="Sticker">🎨</button>
                </div>
                <button class="post-btn" id="postBtn" disabled>Post</button>
            </div>
        </div>
    </div> 
</div>
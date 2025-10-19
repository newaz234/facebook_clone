document.querySelectorAll('.comment-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const postId = this.dataset.post;
        const container = document.getElementById('commentContainer');

        fetch(`/post/${postId}/comments`)
        .then(res => res.text())
        .then(html => {
            container.innerHTML = html;
            const modal = document.getElementById('commentModal');
            modal.dataset.post = postId;
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';

            const modalContainer = document.getElementById('commentsContainer');
            fetch(`/posts/${postId}/comments`)
                .then(res => res.text())
                .then(html => {
                    modalContainer.innerHTML = html;
                });

            const commentModal = document.getElementById('commentModal');
            const commentInput = document.getElementById('commentInput');
            const postBtn = document.getElementById('commentBtn');

            // Get values from meta tags
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const storeUrl = document.querySelector('meta[name="store-comment-url"]').getAttribute('content');
            const userImage = document.querySelector('meta[name="user-image"]').getAttribute('content');

            // Enable/disable Post button
            function checkPostContent() {
                const hasText = commentInput.value.trim().length > 0;
                postBtn.disabled = !hasText;
                postBtn.style.background = hasText ? 'blue' : '#e4e6eb';
                postBtn.style.color = hasText ? '#fff' : '#bcc0c4';
                postBtn.style.cursor = hasText ? 'pointer' : 'not-allowed';
            }

            commentInput.addEventListener('input', checkPostContent);

            // Post comment
            postBtn.addEventListener('click', () => {
                const content = commentInput.value.trim();
                if (!content) return;

                const postId = commentModal.dataset.post;

                fetch(storeUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ post_id: postId, content: content })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const div = document.createElement('div');
                        div.classList.add('comment');
                        div.innerHTML = `
                            <div class="comment-avatar">
                                <img src="${userImage}" alt="Avatar">
                            </div>
                            <div class="comment-content">
                                <div class="comment-bubble">
                                    <div class="comment-author">${data.comment.author}</div>
                                    <div class="comment-text">${data.comment.content}</div>
                                </div>
                                <div class="comment-meta">
                                    <span class="like-action">Like</span>
                                    <span class="reply-action">Reply</span>
                                    <span>${data.comment.created_at}</span>
                                </div>
                            </div>
                        `;
                        document.getElementById('commentsContainer').appendChild(div);
                        commentInput.value = '';
                        postBtn.disabled = true;
                        postBtn.style.background='#e4e6eb';
                    }
                });
            });
        }); 
    });
});

function closeCommentModal() {
    const modal = document.getElementById('commentModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

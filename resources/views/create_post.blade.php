<div class="comment-window" id="postModal">
    <div class="window-content">
        <div class="modal-header">
          <div class="title">
                <div class="modal-title">Create post</div>
                <button class="close-btn" onclick="closepostModal()">✕</button>
        </div>
            <div class="user-info">
                    <div class="profile-pic">
                        <img src="{{ asset('storage/' . $user->image) }}">
                    </div>
                    <div class="user-details">
                        <div class="user-name">{{$user->first_name}} {{$user->surname}}</div>
                        <button type="button" class="privacy-btn">
                            🌐 Public ▼
                        </button>
                    </div>
            </div>
        </div>
        
        <form id="createPostForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="input-wrapper">
                    <textarea 
                        class="post-input" 
                        placeholder="What's on your mind, {{$user->first_name}}?"
                        id="postInput"
                        name="content"
                        required
                    ></textarea>
                    <button type="button" class="emoji-btn">😊</button>
                </div>
                
                <!-- Image Preview Area -->
                <div id="imagePreviewContainer" style="display: none; margin: 10px 0;">
                    <div style="position: relative; display: inline-block;">
                        <img id="imagePreview" style="max-width: 100%; max-height: 300px; border-radius: 8px;">
                        <button type="button" id="removeImageBtn" style="position: absolute; top: 5px; right: 5px; background: rgba(0,0,0,0.7); color: white; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer;">✕</button>
                    </div>
                </div>
                
                <button type="button" class="text-format-btn">Aa</button>
            <div class="footer">
                <div class="add-to-post">
                    <span class="add-to-post-text">Add to your post</span>
                    <div class="add-options">
                        <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;">
                        <button type="button" class="option-btn" title="Photo/Video" onclick="document.getElementById('imageInput').click()">🖼️</button>
                        <button type="button" class="option-btn" title="Tag People">👥</button>
                        <button type="button" class="option-btn" title="Feeling/Activity">😊</button>
                        <button type="button" class="option-btn" title="More">⋯</button>
                    </div>
                </div>
                <button type="submit" class="post-btn" id="postBtn">Post</button>
            </div>
                <div id="postError" style="color: red; margin-top: 10px; display: none;"></div>
                <div id="postSuccess" style="color: green; margin-top: 10px; display: none;"></div>
            </div>
        </form>
    </div>
</div>

<script>
    function checkPostContent() {
    const postInput = document.getElementById('postInput');
    const imageInput = document.getElementById('imageInput');
    const postBtn = document.getElementById('postBtn');
    
    const hasText = postInput.value.trim().length > 0;
    const hasImage = imageInput.files.length > 0;
    
    if (hasText || hasImage) {
        postBtn.disabled = false;
        postBtn.style.background = 'blue';
        postBtn.style.cursor = 'pointer';
    } else {
        postBtn.disabled = true;
        postBtn.style.background = '#e4e6eb';
        postBtn.style.color = '#bcc0c4';
        postBtn.style.cursor = 'not-allowed';
    }
}

// Input field e type korle check korbe
document.getElementById('postInput').addEventListener('input', checkPostContent);

// Image Preview Functionality
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('imagePreviewContainer').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
    checkPostContent(); // Image upload hole button enable hobe
});

// Remove Image
document.getElementById('removeImageBtn').addEventListener('click', function() {
    document.getElementById('imageInput').value = '';
    document.getElementById('imagePreviewContainer').style.display = 'none';
    checkPostContent(); // Image remove korle button disable hobe (if no text)
});
document.addEventListener('DOMContentLoaded', function() {
    checkPostContent();
});
// Submit Form
document.getElementById('createPostForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const postBtn = document.getElementById('postBtn');
    const errorDiv = document.getElementById('postError');
    const successDiv = document.getElementById('postSuccess');
    
    // Disable button and show loading
    postBtn.disabled = true;
    postBtn.textContent = 'Posting...';
    errorDiv.style.display = 'none';
    successDiv.style.display = 'none';
    
    fetch('/posts', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            successDiv.textContent = 'Post created successfully!';
            successDiv.style.display = 'block';
            
            // Reset form
            document.getElementById('createPostForm').reset();
            document.getElementById('imagePreviewContainer').style.display = 'none';
            
            // Close modal after 1 second
            setTimeout(() => {
                closepostModal();
                // Optionally reload the page or update the feed
                location.reload();
            }, 1000);
        } else {
            errorDiv.textContent = data.message || 'Failed to create post';
            errorDiv.style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        errorDiv.textContent = 'An error occurred. Please try again.';
        errorDiv.style.display = 'block';
    })
    .finally(() => {
        postBtn.disabled = false;
        postBtn.textContent = 'Post';
    });
});
</script>
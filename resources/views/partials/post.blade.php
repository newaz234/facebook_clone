<div class="news-feed">
                <div class="post-header">
                    <img src="{{ asset('storage/'. $post->user->image) }}">
                    <div class="post-info">
                        <h3 onclick="window.location.href='{{ route('profile.show', $post->user->id) }}'">{{ $post->user->first_name  }} {{ $post->user->surname}}  </h3>
                        <span>{{ $post->created_at->diffForHumans() }}<i class="fas fa-globe-americas"></i></span>
                    </div>
                </div>
              <div id="commentContainer"></div>
                <div class="post-content">
                    <p>{{$post->content}}</p>
                      @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
                      @endif
                </div>
                <div class="post-stats">
                    <div class="likes">
                        <i class="fas fa-thumbs-up"></i> <span class="like-count"id="{{$post->id}}">{{ $post->likes()->count() }}</span> Like
                    </div>
        
                    <div class="comments-shares">
                    {{ $post->comments()->count() }} comments
                    </div>
                </div>
                <div class="post-buttons">
                    <div class="post-button like-button {{ $post->is_liked ? 'liked' : '' }}" data-post="{{ $post->id }}">
                        <i class="far fa-thumbs-up"></i>Like
                    </div>
                    <div class="post-button">
                        <i class="far fa-comment"></i>
                        <span class="comment-btn"data-post="{{ $post->id }}">Comment</span>
                    </div>
                    <div class="post-button">
                        <i class="fas fa-share"></i>
                        <span>Share</span>
                    </div>
                </div> 
            </div>
@foreach($post->comments as $comment)
    @include('partials.comment-modal', ['cmnt' => $comment])
@endforeach

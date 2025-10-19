document.querySelectorAll('.like-button').forEach(button => {
    button.addEventListener('click', function () {
        let postId = this.dataset.post;

        // get token from meta tag
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/posts/${postId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById(postId).innerText = data.likes_count;
            if (data.status === 'liked') {
                this.classList.add('liked');
            } else {
                this.classList.remove('liked');
            }
        });
    });
});

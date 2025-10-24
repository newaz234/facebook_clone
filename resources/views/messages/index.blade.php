@extends('layout.app')

@section('title', 'messages')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/message.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row messages-container mx-auto">
        <!-- Conversation List -->
        <div class="col-md-4 col-lg-3 conversation-list p-0">
            <div class="conversation-header">
                <div class="d-flex align-items-center">
                 
                    <h4 class="mb-0 fw-bold">Messages</h4>
                </div>
                <button class="new-chat-btn mt-3 w-100" onclick="openNewMessageModal()">
                    <i class="fas fa-edit me-2"></i>New Message
                </button>
            </div>

            <input type="text" class="search-box w-100" placeholder="Search messages...">

            <div class="conversation-list-content">
                @forelse($conversations as $conversation)
                    @php
                        $otherUser = $conversation->users->first();
                        $lastMessage = $conversation->latestMessage;
                    @endphp
                    <div class="conversation-item" onclick="openConversation({{ $conversation->id }})">
                        <div class="d-flex align-items-center">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $otherUser->image) }}?name={{ urlencode($otherUser->name) }}&background=var(--primary-color)&color=ffffff&size=128" 
                                     class="user-avatar"
                                     alt="{{ $otherUser->name }}">
                                <div class="online-indicator"></div>
                            </div>
                            <div class="ms-3 flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h6 class="mb-1 fw-semibold">{{ $otherUser->first_name }} {{ $otherUser->surname }}</h6>
                                    @if($lastMessage)
                                        <small class="text-muted">{{ $lastMessage->created_at->format('g:i A') }}</small>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="mb-0 text-muted small text-truncate me-2" style="max-width: 180px;">
                                        @if($lastMessage)
                                            {{ $lastMessage->user_id == Auth::id() ? 'You: ' : '' }}{{ Str::limit($lastMessage->body, 25) }}
                                        @else
                                            Start a conversation
                                        @endif
                                    </p>
                                    @if($conversation->unread_count > 0)
                                        <span class="unread-badge">{{ $conversation->unread_count }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-comments"></i>
                        <h5>No Messages Yet</h5>
                        <p class="text-muted">Start a conversation by sending a message to someone.</p>
                        <button class="new-chat-btn" onclick="openNewMessageModal()">
                            Start Chatting
                        </button>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Message Area -->
        <div class="col-md-8 col-lg-9 message-area p-0 d-none d-md-block">
            <div class="empty-state h-100 d-flex flex-column justify-content-center">
                <i class="fas fa-comment-dots"></i>
                <h4>Your Messages</h4>
                <p class="text-muted mb-4">Select a conversation or start a new one</p>
                <button class="new-chat-btn mx-auto" onclick="openNewMessageModal()">
                    <i class="fas fa-edit me-2"></i>New Message
                </button>
            </div>
        </div>
    </div>
</div>

<!-- New Message Modal -->
<div class="modal fade" id="newMessageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">New Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="p-3 border-bottom">
                    <input type="text" id="userSearch" class="form-control search-box" placeholder="Search users...">
                </div>
                <div id="userList" style="max-height: 400px; overflow-y: auto;"></div>
            </div>
        </div>
    </div>
</div>

<script>
function openConversation(conversationId) {
    window.location.href = `/messages/${conversationId}`;
}

function openNewMessageModal() {
    var myModal = new bootstrap.Modal(document.getElementById('newMessageModal'));
    myModal.show();
    loadUsers();
}

function loadUsers() {
    fetch('{{ route("messages.users") }}')
        .then(response => response.json())
        .then(users => {
            const userList = document.getElementById('userList');
            userList.innerHTML = users.map(user => `
                <div class="user-list-item d-flex align-items-center" onclick="startConversation(${user.id})">
                    <img src="{{ asset('storage/' . $user->image) }}?name=${encodeURIComponent(user.first_name)}&background=007bff&color=ffffff&size=64" 
                         class="modal-user-avatar me-3">
                    <div>
                        <h6 class="mb-0 fw-semibold">${user.first_name}</h6>
                        <small class="text-muted">Click to start conversation</small>
                    </div>
                </div>
            `).join('');
        })
        .catch(err => console.error('Error loading users:', err));
}

function startConversation(userId) {
    window.location.href = `/messages/create/${userId}`;
}

// Search functionality
document.getElementById('userSearch')?.addEventListener('input', (e) => {
    const searchTerm = e.target.value.toLowerCase();
    const userItems = document.querySelectorAll('.user-list-item');
    
    userItems.forEach(item => {
        const userName = item.querySelector('h6').textContent.toLowerCase();
        item.style.display = userName.includes(searchTerm) ? 'flex' : 'none';
    });
});

        // Auto-resize textarea
        function autoResize(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = Math.min(textarea.scrollHeight, 120) + 'px';
        }

        // Scroll to bottom of messages
        function scrollToBottom() {
            const container = document.getElementById('messagesContainer');
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            scrollToBottom();
            
            // Auto-resize message input
            const messageInput = document.querySelector('.message-input');
            if (messageInput) {
                messageInput.addEventListener('input', function() {
                    autoResize(this);
                });
            }
        });
</script>

@endsection
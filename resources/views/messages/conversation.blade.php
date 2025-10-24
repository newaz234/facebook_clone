@extends('layout.app')

@section('title', 'Homepage')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/message.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .messages-container-scroll {
        transition: opacity 0.2s ease-in-out;
    }
    
    .message-wrapper {
        animation: messageSlideIn 0.3s ease-out;
    }
    
    @keyframes messageSlideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .send-button {
        transition: all 0.2s ease;
    }
    
    .send-button:active {
        transform: scale(0.95);
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row messages-container mx-auto" style="max-width: 1200px;">
        <!-- Conversation List (Hidden on mobile when in chat) -->
        <div class="col-md-4 col-lg-3 conversation-list p-0 d-none d-md-block">
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
                @foreach($conversations as $conv)
                    @php
                        $otherUser = $conv->users->first();
                        $isActive = $conv->id == $conversation->id;
                    @endphp
                    <div class="conversation-item {{ $isActive ? 'active' : '' }}" 
                         onclick="openConversation({{ $conv->id }})">
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
                                    @if($conv->latestMessage)
                                        <small class="text-muted">{{ $conv->latestMessage->created_at->format('g:i A') }}</small>
                                    @endif
                                </div>
                                <p class="mb-0 text-muted small text-truncate me-2" style="max-width: 180px;">
                                    @if($conv->latestMessage)
                                        {{ $conv->latestMessage->user_id == Auth::id() ? 'You: ' : '' }}{{ Str::limit($conv->latestMessage->body, 25) }}
                                    @else
                                        Start a conversation
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Message Area -->
        <div class="col-md-8 col-lg-9 message-area p-0">
            <!-- Message Header -->
            <div class="message-header d-flex align-items-center">
                <div>
                <button class="back-button d-md-none me-3"  onclick="window.location.href='{{ route('messages.index') }}'">
                    <i class="fas fa-arrow-left"></i>
                </button>
                </div>
                <div class="d-flex align-items-center">
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $otherUser->first()->image) }}?name={{ urlencode($otherUsers->first()->name) }}&background=var(--primary-color)&color=ffffff&size=128" 
                             class="user-avatar me-3"
                             alt="{{ $otherUsers->first()->first_name }}">
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">{{ $otherUsers->first()->first_name }} {{ $otherUsers->first()->surname }}</h5>
                        <small class="text-success">
                            <i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i>Online
                        </small>
                    </div>
                </div>
            </div>

            <!-- Messages Container -->
            <div class="messages-container-scroll" id="messagesContainer">
                @foreach($messages as $message)
                    <div class="message-wrapper {{ $message->user_id == Auth::id() ? 'text-end' : '' }}">
                        <div class="message-bubble {{ $message->user_id == Auth::id() ? 'message-sent' : 'message-received' }}">
                            {{ $message->body }}
                            <div class="message-time">
                                {{ $message->created_at->format('g:i A') }}
                                @if($message->user_id == Auth::id() && $message->is_read)
                                    <i class="fas fa-check-double ms-1" style="font-size: 0.7rem;"></i>
                                @elseif($message->user_id == Auth::id())
                                    <i class="fas fa-check ms-1" style="font-size: 0.7rem;"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Message Input -->
            <div class="message-input-container">
                <form action="{{ route('messages.store', $conversation) }}" method="POST" id="messageForm" class="d-flex align-items-center gap-2">
                    @csrf
                    <div class="flex-grow-1">
                        <textarea name="body" class="form-control message-input" 
                                  placeholder="Type a message..." 
                                  rows="1"
                                  oninput="autoResize(this)"></textarea>
                    </div>
                    <button type="submit" class="send-button">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
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
                    <img src="{{ asset('storage/') }}/${user.image}?name=${encodeURIComponent(user.first_name)}&background=var(--primary-color)&color=ffffff&size=64" 
                         class="modal-user-avatar me-3">
                    <div>
                        <h6 class="mb-0 fw-semibold">${user.first_name}</h6>
                        <small class="text-muted">Click to start conversation</small>
                    </div>
                </div>
            `).join('');
        });
}

function startConversation(userId) {
    window.location.href = `/messages/create/${userId}`;
}

// Auto-resize textarea
function autoResize(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = Math.min(textarea.scrollHeight, 120) + 'px';
}

// Smooth scroll to bottom
function scrollToBottom(smooth = false) {
    const container = document.getElementById('messagesContainer');
    if (container) {
        if (smooth) {
            container.scrollTo({
                top: container.scrollHeight,
                behavior: 'smooth'
            });
        } else {
            container.scrollTop = container.scrollHeight;
        }
    }
}

// AJAX message sending with optimistic UI
document.getElementById('messageForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const messageInput = this.querySelector('textarea[name="body"]');
    const messageBody = messageInput.value.trim();
    
    if (!messageBody) return;
    
    // Optimistically add message immediately
    const messagesContainer = document.getElementById('messagesContainer');
    const tempId = 'temp-' + Date.now();
    const messageHtml = `
        <div class="message-wrapper text-end" id="${tempId}">
            <div class="message-bubble message-sent">
                ${messageBody}
                <div class="message-time">
                    Sending...
                </div>
            </div>
        </div>
    `;
    
    messagesContainer.insertAdjacentHTML('beforeend', messageHtml);
    messageInput.value = '';
    messageInput.style.height = 'auto';
    scrollToBottom(true);
    
    // Send to server
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update temporary message with real data
            const tempMessage = document.getElementById(tempId);
            if (tempMessage) {
                const timeDiv = tempMessage.querySelector('.message-time');
                timeDiv.innerHTML = `
                    Just now
                    <i class="fas fa-check ms-1" style="font-size: 0.7rem;"></i>
                `;
            }
        }
    })
    .catch(() => {
        // Remove temp message on error
        const tempMessage = document.getElementById(tempId);
        if (tempMessage) {
            tempMessage.remove();
        }
        alert('Failed to send message. Please try again.');
    });
});

// Improved polling with better performance
let lastMessageCount = 0;
let lastHTML = '';
let isUserTyping = false;

function checkForNewMessages() {
    // Don't update if user is typing
    if (isUserTyping) return;
    
    const messagesContainer = document.getElementById('messagesContainer');
    const scrollPos = messagesContainer.scrollTop;
    const isAtBottom = messagesContainer.scrollHeight - messagesContainer.clientHeight <= scrollPos + 50;

    fetch(window.location.href, { 
        cache: 'no-store',
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newMessagesContainer = doc.getElementById('messagesContainer');

            if (newMessagesContainer && newMessagesContainer.innerHTML !== lastHTML) {
                const newMessageCount = newMessagesContainer.children.length;
                const hasNewMessages = newMessageCount > lastMessageCount;
                
                lastHTML = newMessagesContainer.innerHTML;
                lastMessageCount = newMessageCount;

                // Smooth fade transition
                messagesContainer.style.opacity = '0.5';
                
                setTimeout(() => {
                    messagesContainer.innerHTML = newMessagesContainer.innerHTML;
                    messagesContainer.style.opacity = '1';
                    
                    if (isAtBottom || hasNewMessages) {
                        scrollToBottom(true);
                    }
                }, 100);
            }
        })
        .catch(error => {
            console.error('Error checking messages:', error);
        });
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    scrollToBottom();
    
    const messagesContainer = document.getElementById('messagesContainer');
    const messageInput = document.querySelector('.message-input');
    
    lastHTML = messagesContainer.innerHTML;
    lastMessageCount = messagesContainer.children.length;
    
    // Track when user is typing
    messageInput.addEventListener('input', function() {
        isUserTyping = true;
        clearTimeout(window.typingTimeout);
        window.typingTimeout = setTimeout(() => {
            isUserTyping = false;
        }, 1000);
    });
    
    messageInput.addEventListener('blur', function() {
        isUserTyping = false;
    });
    
    // Start polling every 2 seconds
    setInterval(checkForNewMessages, 2000);
    
    // Handle Enter key for sending
    messageInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            document.getElementById('messageForm').dispatchEvent(new Event('submit'));
        }
    });
});

// Search functionality
document.getElementById('userSearch')?.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const userItems = document.querySelectorAll('.user-list-item');
    
    userItems.forEach(item => {
        const userName = item.querySelector('h6').textContent.toLowerCase();
        item.style.display = userName.includes(searchTerm) ? 'flex' : 'none';
    });
});

// Mobile navigation
function toggleConversationList() {
    document.querySelector('.conversation-list').classList.toggle('active');
}
</script>
@endsection

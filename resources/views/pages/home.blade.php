@extends('layouts.app')
@section('title', 'Message Mini Web')
@section('description', 'Săn sale hoàn xu với % khủng cùng Hoàn Xu')
@section('keyword', 'sale, hoàn xu, giảm giá, khuyến mãi, lazada, shopee, tiktok')
@push('styles')
    <style>
        .window-chat {
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
        }
    </style>
@endpush

@section('content')
    @include('components.toast')
@endsection

@section('content-1')
    <div class="chat-list-container px-3">
        @foreach ($conversations as $item)
            <a class="text-decoration-none d-flex justify-content-between conversation-link" data-id="{{ $item->id }}">
                <div class="d-flex align-items-center">
                    <img src="{{ asset($item->is_group == false ? $item->friend->avatar : 'assets/images/logo/logohoanxu.png' ) }}" alt="User" class="rounded-circle me-3" style="object-fit: cover" width="50" height="50">
                    <div class="chat-info">
                        <h5 class="mb-0 text-dark">{{ $item->is_group == false ? $item->friend->name : $item->name }}</h5>
                        <p class="text-muted mb-0">{{ $item->latestMessage->message ?? '' }}</p>
                    </div>
                </div>
                <span class="chat-time text-muted small">{{ isset($item->latestMessage->time_diff) ? $item->latestMessage->time_diff : '' }}</span>
            </a>
        @endforeach
    </div>
@endsection

@section('content-2')
    <div class="window-chat">
        @include('components.window_chat', ['conversation' => $latestConversation])
    </div>
@endsection

@push('scripts')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const conversationLinks = document.querySelectorAll('.conversation-link');

            conversationLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const conversationId = this.getAttribute('data-id');

                    fetchConversationData(conversationId);
                });
            });

            function fetchConversationData(conversationId) {
                fetch(`/conversations/${conversationId}`)
                    .then(response => response.json())
                    .then(data => {
                        updateChatWindow(data);
                    })
                    .catch(error => {
                        console.error('Error fetching conversation data:', error);
                    });
            }

            function updateChatWindow(data) {
                const chatWindow = document.querySelector('.window-chat');
                chatWindow.innerHTML = `
                    @include('components.window_chat')
                `;

                // Update the dynamic content
                document.querySelector('.header-chat h3').textContent = data.is_group ? data.name : data.friend.name;
                document.querySelector('.header-chat p').textContent = data.is_group ? `${data.users.length} thành viên` : 'Tin nhắn đã đọc';

                const messagesContainer = document.querySelector('.box-chat');
                messagesContainer.innerHTML = data.messages.map(message => `
                    <div class="message d-flex mb-3 ${message.sender_id === {{ Auth::id() }} ? 'justify-content-end' : ''}">
                        ${message.sender_id !== {{ Auth::id() }} ? `<img src="${message.sender.avatar}" alt="User" class="rounded-circle me-3" style="object-fit: cover" width="40" height="40">` : ''}
                        <div class="message-content ${message.sender_id === {{ Auth::id() }} ? 'bg-primary text-white' : 'bg-white'} p-2 rounded">
                            <p class="mb-0">${message.message}</p>
                            <span class="message-time text-muted small">${message.time_diff}</span>
                        </div>
                        ${message.sender_id === {{ Auth::id() }} ? `<img src="${message.sender.avatar}" alt="User" class="rounded-circle ms-3" style="object-fit: cover" width="40" height="40">` : ''}
                    </div>
                `).join('');
            }
        });
    </script> --}}
    <script>
        showSavedToast();
    </script>
@endpush

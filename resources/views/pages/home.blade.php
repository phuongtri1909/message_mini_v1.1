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
        @if(isset($latestConversation))
            @include('components.window_chat', ['conversation' => $latestConversation])
        
        @endif
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
   <script>
    
// input gửi tin nhắn
document.addEventListener('DOMContentLoaded', function () {
const folderIcon = document.getElementById('folderIcon');
const imageIcon = document.getElementById('imageIcon');
const fileIcon = document.getElementById('fileIcon');
const folderInput = document.getElementById('folderInput');
const imageInput = document.getElementById('imageInput');
const fileInput = document.getElementById('fileInput');
const previewContainer = document.getElementById('previewContainer');
const previewContent = document.getElementById('previewContent');
const sendIcon = document.getElementById('sendIcon');
const messageInput = document.getElementById('messageInput');

folderIcon.addEventListener('click', function () {
    folderInput.click();
});

imageIcon.addEventListener('click', function () {
    imageInput.click();
});

fileIcon.addEventListener('click', function () {
    fileInput.click();
});

function handleFileSelect(input) {
    const files = input.files;
    previewContent.innerHTML = '';

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function (e) {
            const fileType = file.type.split('/')[0];
            let element;

            if (fileType === 'image') {
                element = document.createElement('img');
                element.src = e.target.result;
                element.style.width = '50px';
                element.style.height = '50px';
                element.style.objectFit = 'cover';
                element.style.marginRight = '5px';
            } else {
                element = document.createElement('div');
                element.textContent = file.name;
                element.style.marginRight = '5px';
            }

            previewContent.appendChild(element);
        };

        reader.readAsDataURL(file);
    }

    previewContainer.style.display = 'block';
    toggleSendIcon();
}

folderInput.addEventListener('change', function () {
    handleFileSelect(this);
});

imageInput.addEventListener('change', function () {
    handleFileSelect(this);
});

fileInput.addEventListener('change', function () {
    handleFileSelect(this);
});

messageInput.addEventListener('input', function () {
    toggleSendIcon();
});

function toggleSendIcon() {
    // Hiển thị nút gửi nếu có tin nhắn hoặc ảnh/tệp đính kèm
    if (messageInput.value.trim() !== '' || previewContent.children.length > 0) {
        sendIcon.style.display = 'block';
        previewContainer.style.display = 'block';
    } else {
        sendIcon.style.display = 'none';
        previewContainer.style.display = 'none';
    }
}
});

// modal thêm thành viên
document.addEventListener('DOMContentLoaded', function () {
// Khởi tạo modal Thêm thành viên
const addMembersModal = new bootstrap.Modal(document.getElementById('addMembersModal'));

// Sự kiện mở modal
document.getElementById('openAddMembersModal').addEventListener('click', function () {
    addMembersModal.show();
});

// Sự kiện thêm thành viên đã chọn
document.getElementById('addSelectedMembers').addEventListener('click', function () {
    const selectedMembers = [];
    document.querySelectorAll('#addMembersModal .form-check-input:checked').forEach(checkbox => {
        selectedMembers.push(checkbox.value);
    });
    console.log("Các thành viên được thêm:", selectedMembers);
    // Đóng modal
    addMembersModal.hide();
});
});

    // Hàm để cuộn xuống dưới
    function scrollToBottom() {
const chatMessages = document.querySelector('.chat-messages');
if (chatMessages) {
    chatMessages.scrollTop = chatMessages.scrollHeight; // Cuộn xuống dưới cùng
}
}

// Gọi hàm cuộn xuống khi trang tải xong
document.addEventListener('DOMContentLoaded', function () {
scrollToBottom();

// Ẩn hiện ảnh đã gửi
const imagesList = document.querySelectorAll('.images-list .view-image');
const viewToggleBtn = document.getElementById('view-toggle-btn');

function hideExtraImages() {
    imagesList.forEach((img, index) => {
        img.classList.toggle('d-none', index >= 6);
    });
    viewToggleBtn.textContent = "Xem tất cả";
}

hideExtraImages();

// Xử lý khi bấm nút "Xem tất cả" hoặc "Ẩn bớt"
viewToggleBtn.addEventListener('click', function () {
    if (viewToggleBtn.textContent === "Xem tất cả") {
        imagesList.forEach(img => img.classList.remove('d-none'));
        viewToggleBtn.textContent = "Ẩn bớt";
    } else {
        hideExtraImages();
    }
});

// Hiển thị ảnh lớn khi bấm vào ảnh nhỏ
imagesList.forEach(image => {
    image.addEventListener('click', function () {
        const modalImage = document.getElementById('modalImage');
        if (modalImage) {
            modalImage.src = this.src;
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        } else {
            console.error("Không tìm thấy phần tử 'modalImage'.");
        }
    });
});
});

// JavaScript để xử lý nút "Xem tất cả" và mở modal ảnh
document.addEventListener('DOMContentLoaded', function () {
const viewAllBtn = document.getElementById('view-all-btn');
const extraImages = document.querySelector('.extra-images');
// Kiểm tra xem cả hai phần tử có tồn tại không
if (viewAllBtn && extraImages) {
    viewAllBtn.addEventListener('click', function () {
        extraImages.classList.toggle('d-none');
        this.innerText = this.innerText === "Xem tất cả" ? "Ẩn bớt" : "Xem tất cả";
    });
}
});

// Xử lý sự kiện khi nhấn vào ảnh để xem lớn
document.addEventListener('DOMContentLoaded', function () {
document.querySelectorAll('.view-image').forEach(image => {
    image.addEventListener('click', function () {
        const modalImage = document.getElementById('modalImage');
        if (modalImage) {
            modalImage.src = this.src;
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        } else {
            console.error("Không tìm thấy phần tử 'modalImage'.");
        }
    });
});
});

// xem tất cả thành viên
document.addEventListener('DOMContentLoaded', function () {
// Lấy các phần tử cần thiết
const viewMembersBtn = document.getElementById('view-all-members-btn');
const membersOffcanvas = document.getElementById('offcanvasMembers');
// Kiểm tra xem cả hai phần tử có tồn tại hay không
if (viewMembersBtn && membersOffcanvas) {
    // Khởi tạo offcanvas Bootstrap cho phần tử 'offcanvasMembers'
    const offcanvasInstance = new bootstrap.Offcanvas(membersOffcanvas);

    // Thêm sự kiện click cho nút để hiển thị offcanvas
    viewMembersBtn.addEventListener('click', function () {
        offcanvasInstance.show();
    });
} else {
    console.error("Không tìm thấy phần tử 'view-all-members-btn' hoặc 'offcanvasMembers'");
}
});

   </script>
@endpush

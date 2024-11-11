@extends('layouts.app')
@section('title', 'Message Mini Web')
@section('description', 'Săn sale hoàn xu với % khủng cùng Hoàn Xu')
@section('keyword', 'sale, hoàn xu, giảm giá, khuyến mãi, lazada, shopee, tiktok')
@push('styles')

@endpush

@section('content')
    @include('components.toast')
@endsection

@section('content-1')
<div class="chat-list-container px-3">
    @foreach ($conversations as $item)
        <a class="text-decoration-none d-flex justify-content-between conversation-link mb-4" data-id="{{ $item->id }}">
            <div class="d-flex align-items-center">
                <img src="{{ $item->is_group ? ($item->avatar ? asset(str_replace('public/', 'storage/', $item->avatar)) : asset('/assets/images/avatar_default_group.jpg')) : ($item->friend->avatar ? asset($item->friend->avatar) : asset('/assets/images/avatar_default.jpg')) }}"
                alt="User" class="rounded-circle me-3" style="object-fit: cover" width="50" height="50">
                <div class="chat-info">
                    <h5 class="mb-0 text-dark">{{ $item->is_group == false ? $item->friend->name : $item->name }}</h5>
                    <p class="text-muted mb-0">
                        @if($item->latestMessage)
                            {{ decryptMessage($item->latestMessage->message); }}
                        @else
                            @php
                                $creator = $item->conversationUsers->firstWhere('user_id', $item->created_by);
                            @endphp
                            @if($item->created_by == Auth::id())
                                Bạn đã tạo nhóm
                            @else
                                {{ $creator->nickname ?? $creator->user->name }} đã tạo nhóm
                            @endif
                        @endif
                    </p>
                </div>
            </div>
            <span class="chat-time text-muted small">
                @if(isset($item->latestMessage->time_diff))
                    {{ $item->latestMessage->time_diff }}
                @else
                    Tạo {{ $item->time_diff }}
                @endif
            </span>
        </a>
    @endforeach
</div>
@endsection

@section('content-2')
    <div class="window-chat">
        @if (isset($latestConversation))
            @include('components.window_chat', ['conversation' => $latestConversation])
        @endif
    </div>
@endsection

@push('scripts')

    {{-- load conversation đã chọn --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.conversation-link').forEach(function(element) {
                element.addEventListener('click', function(event) {
                    event.preventDefault();
                    const conversationId = this.getAttribute('data-id');
                    loadConversation(conversationId);
                });
            });

            function loadConversation(conversationId) {
                fetch(`/conversation/${conversationId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.querySelector('.window-chat').innerHTML = data.html;
                    })
                    .catch(error => showToast(error, 'error'));
            }
        });
    </script>

    <script>
        showSavedToast();
    </script>
    <script>
        // input gửi tin nhắn
        document.addEventListener('DOMContentLoaded', function() {
            const imageIcon = document.getElementById('imageIcon');
            const fileIcon = document.getElementById('fileIcon');
            const imageInput = document.getElementById('imageInput');
            const fileInput = document.getElementById('fileInput');
            const previewContainer = document.getElementById('previewContainer');
            const sendIcon = document.getElementById('sendIcon');
            const messageInput = document.getElementById('messageInput');

            imageIcon.addEventListener('click', function() {
                imageInput.click();
            });

            fileIcon.addEventListener('click', function() {
                fileInput.click();
            });

            imageInput.addEventListener('change', function() {
                handleFileSelect(this.files,'image');
            });

            fileInput.addEventListener('change', function() {
                handleFileSelect(this.files,'file');
            });

            messageInput.addEventListener('input', function() {
                toggleSendIcon();
            });

            function handleFileSelect(files,type) {
                previewContainer.innerHTML = '';

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewElement = document.createElement('div');
                        previewElement.classList.add('preview-element', 'm-2');
                        previewElement.style.width = '100px';
                        previewElement.style.height = '100px';
                        previewElement.style.border = '1px solid #ccc';
                        previewElement.style.display = 'flex';
                        previewElement.style.alignItems = 'center';
                        previewElement.style.justifyContent = 'center';
                        previewElement.style.overflow = 'hidden';

                        if (type === 'image') {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.width = '100%';
                            img.style.height = '100%';
                            img.style.objectFit = 'cover';
                            previewElement.appendChild(img);
                        } else {
                            const fileName = document.createElement('span');
                            fileName.textContent = file.name;
                            fileName.style.fontSize = '12px';
                            fileName.style.textAlign = 'center';
                            previewElement.appendChild(fileName);
                        }

                        previewContainer.appendChild(previewElement);
                    };
                    reader.readAsDataURL(file);
                }
                toggleSendIcon();
            }

        });

        // modal thêm thành viên
        document.addEventListener('DOMContentLoaded', function() {
            // Khởi tạo modal Thêm thành viên
            const addMembersModal = new bootstrap.Modal(document.getElementById('addMembersModal'));

            // Sự kiện mở modal
            document.getElementById('openAddMembersModal').addEventListener('click', function() {
                addMembersModal.show();
            });

            // Sự kiện thêm thành viên đã chọn
            document.getElementById('addSelectedMembers').addEventListener('click', function() {
                const selectedMembers = [];
                document.querySelectorAll('#addMembersModal .form-check-input:checked').forEach(
                checkbox => {
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
        document.addEventListener('DOMContentLoaded', function() {
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
            viewToggleBtn.addEventListener('click', function() {
                if (viewToggleBtn.textContent === "Xem tất cả") {
                    imagesList.forEach(img => img.classList.remove('d-none'));
                    viewToggleBtn.textContent = "Ẩn bớt";
                } else {
                    hideExtraImages();
                }
            });

            // Hiển thị ảnh lớn khi bấm vào ảnh nhỏ
            imagesList.forEach(image => {
                image.addEventListener('click', function() {
                    const modalImage = document.getElementById('modalImage');
                    if (modalImage) {
                        modalImage.src = this.src;
                        const imageModal = new bootstrap.Modal(document.getElementById(
                            'imageModal'));
                        imageModal.show();
                    } else {
                        console.error("Không tìm thấy phần tử 'modalImage'.");
                    }
                });
            });
        });

        // JavaScript để xử lý nút "Xem tất cả" và mở modal ảnh
        document.addEventListener('DOMContentLoaded', function() {
            const viewAllBtn = document.getElementById('view-all-btn');
            const extraImages = document.querySelector('.extra-images');
            // Kiểm tra xem cả hai phần tử có tồn tại không
            if (viewAllBtn && extraImages) {
                viewAllBtn.addEventListener('click', function() {
                    extraImages.classList.toggle('d-none');
                    this.innerText = this.innerText === "Xem tất cả" ? "Ẩn bớt" : "Xem tất cả";
                });
            }
        });

        // Xử lý sự kiện khi nhấn vào ảnh để xem lớn
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.view-image').forEach(image => {
                image.addEventListener('click', function() {
                    const modalImage = document.getElementById('modalImage');
                    if (modalImage) {
                        modalImage.src = this.src;
                        const imageModal = new bootstrap.Modal(document.getElementById(
                            'imageModal'));
                        imageModal.show();
                    } else {
                        console.error("Không tìm thấy phần tử 'modalImage'.");
                    }
                });
            });
        });

        // xem tất cả thành viên
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy các phần tử cần thiết
            const viewMembersBtn = document.getElementById('view-all-members-btn');
            const membersOffcanvas = document.getElementById('offcanvasMembers');
            // Kiểm tra xem cả hai phần tử có tồn tại hay không
            if (viewMembersBtn && membersOffcanvas) {
                // Khởi tạo offcanvas Bootstrap cho phần tử 'offcanvasMembers'
                const offcanvasInstance = new bootstrap.Offcanvas(membersOffcanvas);

                // Thêm sự kiện click cho nút để hiển thị offcanvas
                viewMembersBtn.addEventListener('click', function() {
                    offcanvasInstance.show();
                });
            } else {
                console.error("Không tìm thấy phần tử 'view-all-members-btn' hoặc 'offcanvasMembers'");
            }
        });
    </script>
@endpush

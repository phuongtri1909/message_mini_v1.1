@push('styles')
    <style>
        .header-chat {
            width: 100%;
            z-index: 2;
        }

        .footer-send {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 1;
        }

        .box-chat {
            display: flex;
            flex-direction: column-reverse;
            margin-bottom: 75px;
        }
    </style>
@endpush

<div class="window-chat">
    <div class="header-chat bg-white px-2 py-3 border-bottom">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex">
                {{-- chỗ này nếu avatar null thì lấy ảnh user ghép lại --}}
                <img class="rounded-circle" width="50" height="50px"
                    src="{{ asset($conversation->is_group ? $conversation->avatar : $conversation->friend->avatar) }}"
                    alt="">
                <div class="ms-3">
                    <h5 class="mb-0">
                        @if ($conversation->is_group)
                            {{ $conversation->name }}
                        @else
                            @php
                                $userInfo = $conversation->conversationUserInfo->firstWhere(
                                    'user_id',
                                    $conversation->friend->id,
                                );
                            @endphp
                            {{ $userInfo->nickname ?? $conversation->friend->name }}
                        @endif
                    </h5>
                    <p class="text-muted mb-0">
                        {{ $conversation->is_group ? $conversation->conversationUserInfo->count() : '' }}
                    </p>
                </div>
            </div>
            <div>
                <!-- Nút mở offcanvas để hiển thị thành viên và chọn thêm -->
                <button class="btn btn-primary" id="openAddMembersModal"><i class="fa-solid fa-user-group"></i></button>
                <!-- Button các chức năng của nhóm -->
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="fa-solid fa-layer-group"></i>
                </button>
            </div>
        </div>

        <!-- Offcanvas bên phải -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">Thông tin nhóm</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <!--Gửi file-->
                <div class="group-info mb-4">
                    <h6 class="fw-bold">File đã gửi</h6>
                    <ul class="list-unstyled">
                        <li><a href="path/to/file1.pdf" target="_blank">File 1.pdf</a></li>
                        <li><a href="path/to/file2.docx" target="_blank">File 2.docx</a></li>
                        <!-- Thêm các file khác -->
                    </ul>
                </div>
                <!-- Thông tin nhóm -->
                <div class="group-info mb-4">
                    <h6 class="fw-bold">Ảnh đã gửi</h6>
                    <div class="images-list d-flex flex-wrap">
                        <!-- Thêm hình ảnh mẫu -->
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 1"
                            class="img-thumbnail m-1 view-image " style="object-fit:cover; width: 90px; height: 90px;">
                        <img src="{{ asset('assets/images/logo/uocmo.jpg') }}" alt="Ảnh đã gửi 7"
                            class="img-thumbnail m-1 view-image " style=" object-fit:cover;width: 90px; height: 90px;">
                        <img src="{{ asset('assets/images/logo/uocmo.jpg') }}" alt="Ảnh đã gửi 7"
                            class="img-thumbnail m-1 view-image  " style=" object-fit:cover;width: 90px; height: 90px;">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 4"
                            class="img-thumbnail m-1 view-image " style=" object-fit:cover; width: 90px; height: 90px;">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 5"
                            class="img-thumbnail m-1 view-image " style=" object-fit:cover;width: 90px; height: 90px;">
                        <img src="{{ asset('assets/images/logo/uocmo.jpg') }}" alt="Ảnh đã gửi 7"
                            class="img-thumbnail m-1 view-image " style=" object-fit:cover;width: 90px; height: 90px;">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 7"
                            class="img-thumbnail m-1 view-image " style=" object-fit:cover; width: 90px; height: 90px;">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 8"
                            class="img-thumbnail m-1 view-image " style=" object-fit:cover; width: 90px; height: 90px;">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 1"
                            class="img-thumbnail m-1 view-image " style=" object-fit:cover;width: 90px; height: 90px;">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 2"
                            class="img-thumbnail m-1 view-image " style=" object-fit:cover;width: 90px; height: 90px;">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 3"
                            class="img-thumbnail m-1 view-image " style="object-fit:cover; width: 90px; height: 90px;">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 4"
                            class="img-thumbnail m-1 view-image " style=" object-fit:cover;width: 90px; height: 90px;">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 5"
                            class="img-thumbnail m-1 view-image " style="object-fit:cover; width: 90px; height: 90px;">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 6"
                            class="img-thumbnail m-1 view-image " style=" object-fit:cover;width: 90px; height: 90px;">
                        <img src="{{ asset('assets/images/logo/uocmo.jpg') }}" alt="Ảnh đã gửi 7"
                            class="img-thumbnail m-1 view-image "
                            style=" object-fit:cover;width: 90px; height: 90px;">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 8"
                            class="img-thumbnail m-1 view-image "
                            style=" object-fit:cover; width: 90px; height: 90px;">
                    </div>
                    <!-- Nút "Xem tất cả" -->
                    <button class="btn btn-outline-primary mt-2" id="view-toggle-btn">Xem tất cả</button>
                </div>

                <!-- Chức năng nhóm -->
                <button class="btn btn-outline-primary w-100" id="view-all-members-btn">Xem tất cả thành
                    viên</button>

            </div>
        </div>
        <!-- Offcanvas để hiển thị thành viên -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMembers"
            aria-labelledby="offcanvasMembersLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasMembersLabel">Danh sách thành viên</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="list-unstyled">
                    <li class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Thành viên 1"
                                class="rounded-circle me-2" style="object-fit:cover; width: 40px; height: 40px;">
                            <span>Thành viên 1</span>
                        </div>
                        <button class="btn btn-danger btn-sm ms-2"><i class="fa-solid fa-user-xmark"></i></button>
                    </li>
                    <li class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Thành viên 2"
                                class="rounded-circle me-2" style="object-fit:cover; width: 40px; height: 40px;">
                            <span>Thành viên 2</span>
                        </div>
                        <button class="btn btn-danger btn-sm ms-2"><i class="fa-solid fa-user-xmark"></i></button>
                    </li>
                    <li class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Thành viên 3"
                                class="rounded-circle me-2" style="object-fit:cover; width: 40px; height: 40px;">
                            <span>Thành viên 3</span>
                        </div>
                        <button class="btn btn-danger btn-sm ms-2"><i class="fa-solid fa-user-xmark"></i></button>
                    </li>
                    <li class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Thành viên 4"
                                class="rounded-circle me-2" style="object-fit:cover; width: 40px; height: 40px;">
                            <span>Thành viên 4</span>
                        </div>
                        <button class="btn btn-danger btn-sm ms-2"><i class="fa-solid fa-user-xmark"></i></button>
                    </li>
                    <li class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Thành viên 5"
                                class="rounded-circle me-2" style="object-fit:cover; width: 40px; height: 40px;">
                            <span>Thành viên 5</span>
                        </div>
                        <button class="btn btn-danger btn-sm ms-2"><i class="fa-solid fa-user-xmark"></i></button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

   
    <div class="box-chat chat-messages flex-grow-1 p-3 overflow-auto">
        @foreach ($conversation->messages as $message)
            <div class="message d-flex mb-3 {{ $message->sender_id === Auth::id() ? 'justify-content-end' : '' }}">
                @if ($message->sender_id !== Auth::id())
                    <img src="{{ $conversation->is_group ? asset('/assets/images/avatar_default.jpg') : asset($message->sender->avatar ?? '/assets/images/avatar_default.jpg') }}" alt="User"
                    class="rounded-circle me-3" style="object-fit: cover" width="40" height="40">
                @endif
                <div class="message-content {{ $message->sender_id === Auth::id() ? 'bg-primary text-white' : 'bg-white' }} p-2 rounded">
                    @if($conversation->is_group && $message->sender_id !== Auth::id())
                        <p class="mb-0 text-muted">{{ $message->sender->name }}</p>
                    @endif
                    <p class="mb-0">{{ $message->message }}</p>
                    <span class="message-time text-muted small">{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</span>
                </div>
                @if ($message->sender_id === Auth::id())
                    <img src="{{ $conversation->is_group ? asset('/assets/images/avatar_default.jpg') : asset($message->sender->avatar ?? '/assets/images/avatar_default.jpg') }}" alt="User"
                    class="rounded-circle me-3" style="object-fit: cover" width="40" height="40">
                @endif
            </div>
        @endforeach
    </div>

    <!-- Thêm input để gửi tin nhắn -->

    <form id="send-message-form">
        @csrf
        <div class="footer-send chat-input d-flex align-items-center bg-white p-3 border-top">
            <div class="input-icons ms-3" style="display: flex;">
                <a href="#" id="folderIcon"><i class="fa-solid fa-folder"></i></a>
                <a href="#" id="imageIcon"><i class="fa-solid fa-image"></i></a>
                <a href="#" id="fileIcon"><i class="fa-solid fa-paperclip"></i></a>
            </div>

            <input type="hidden" name="conversation_id" id="conversation_id"
                value="{{ $conversation->id }}">
            <textarea class="form-control rounded-pill" id="messageInput" placeholder="Nhập @, tin nhắn tới ..." rows="1"
                oninput="toggleSendIcon()" style="resize: none; overflow: hidden; width:700px"></textarea>
            <button type="submit" href="#" id="sendIcon" style="display: none;">
                <i class="fa-solid fa-paper-plane" style="font-size: 25px;"></i>
            </button>

            <!-- Các phần tử input file ẩn -->
            <input type="file" id="folderInput" style="display: none;" webkitdirectory>
            <input type="file" id="imageInput" style="display: none;" accept="image/*">
            <input type="file" id="fileInput" style="display: none;">

            <!-- Hiển thị ảnh hoặc tệp đã chọn ngay cạnh nút gửi -->
            <div id="previewContainer"
                style="display: none; position: absolute; bottom: 80px; right: 60px; background: white; border: 1px solid #ccc; padding: 5px; border-radius: 5px;">
                <div id="previewContent"></div>
            </div>
        </div>
    </form>
</div>


<!-- Modal để hiển thị ảnh lớn -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <img id="modalImage" src="" alt="Ảnh lớn" class="img-fluid">
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @vite('resources/js/app.js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const conversationId = document.getElementById('conversation_id').value;
            Echo.private('chat.' + conversationId)
                .listen('MessageSent', (e) => {
                    console.log(e.message);

                    const avatarUrl = e.message.sender.avatar_url;

                    const messageHtml = `
                        <div class="message d-flex mb-3 ${e.message.sender_id === {{ Auth::id() }} ? 'justify-content-end' : ''}">
                            ${e.message.sender_id !== {{ Auth::id() }} ? `
                                <img src="${avatarUrl}" alt="User" class="rounded-circle me-3" style="object-fit: cover" width="40" height="40">
                            ` : ''}
                            <div class="message-content ${e.message.sender_id === {{ Auth::id() }} ? 'bg-primary text-white' : 'bg-white'} p-2 rounded">
                                <p class="mb-0">${e.message.message}</p>
                                <span class="message-time text-muted small">${e.message.created_at}</span>
                            </div>
                            ${e.message.sender_id === {{ Auth::id() }} ? `
                                <img src="${avatarUrl}" alt="User" class="rounded-circle ms-3" style="object-fit: cover" width="40" height="40">
                            ` : ''}
                        </div>
                    `;

                    $('.box-chat').prepend(messageHtml);
                    var chatBox = document.querySelector('.box-chat');
                    chatBox.scrollTop = chatBox.scrollHeight;
                });
        });

        

        document.addEventListener('DOMContentLoaded', function() {
            $(document).on('submit', '#send-message-form', function(e) {
                console.log('submitting message');
                
                e.preventDefault();

                let message = $('#messageInput').val();

                $.ajax({
                    url: '{{ route('send.message') }}',
                    type: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        conversation_id: $('#conversation_id').val(),
                        message: message
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#messageInput').val('');
                        } else {
                            showToastr(response.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Validation error
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = '';
                            for (let key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessage += errors[key][0] + '\n';
                                }
                            }

                            showToastr(errorMessage, 'error');

                        } else {
                            showToastr(xhr.responseJSON.message, 'error');
                        }
                    }
                });
            });
        });
    </script>
@endpush

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

        .header-chat {
            position: fixed;
            top: 0;
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
            flex-grow: 1;
            overflow-y: auto;
            padding-top: 80px;
            padding-bottom: 80px;
        }
    </style>
@endpush

@section('content')
    @include('components.toast')
@endsection

@section('content-1')
    <div class="search-bar mb-4 d-flex align-items-center">
        <input type="text" class="form-control me-2" placeholder="Tìm kiếm">
        <button class="btn" style="border: none; background: none; padding-left: 2px;" data-bs-toggle="modal"
            data-bs-target="#addFriendModal">
            <i class="fa-solid fa-user-plus "></i>
        </button>

        <button type="button" style="border: none; background: none; padding-left: 2px;" data-bs-toggle="modal"
            data-bs-target="#createGroupModal">
            <a href="#"><i class="fa-solid fa-people-group"></i></a>
        </button>

    </div>

    <!-- Thêm div bọc các cuộc hội thoại -->
    <div class="chat-list-container">
        @foreach($friends as $friend)
        <div class="chat-item rounded">
            <div class="d-flex align-items-center">
                <a href="#">
                    <img src="{{ asset($friend->avatar) }}" alt="{{ $friend->name }}" class="rounded-circle me-3" style="object-fit: cover" width="40" height="40">
                </a>
                <div class="chat-info">
                    <h5 class="mb-0">{{ $friend->name }}</h5>
                    <p class="text-muted mb-0">Đoạn tin nhắn gần nhất</p>
                </div>
            </div>
            <span class="chat-time text-muted small">5 phút trước</span>
        </div>
        @endforeach
    </div>
@endsection

@section('content-2')
    <div class="window-chat">
        <div class="header-chat bg-white px-2 py-3 d-flex justify-content-between" style="border-bottom: 0.5px solid rgb(216, 209, 209)">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="mb-0">Tên nhóm/Người dùng</h3>
                    <p class="text-muted mb-0">7 thành viên | Tin nhắn đã đọc</p>
                </div>
                <div>
                    <!-- Nút mở offcanvas để hiển thị thành viên và chọn thêm -->
                    <button class="btn btn-primary ms-5" id="openAddMembersModal"><i class="fa-solid fa-user-group"></i></button>
                    <!-- Button các chức năng của nhóm -->
                    <button class="btn btn-primary ms-5" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                        aria-controls="offcanvasRight">
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
                                class="img-thumbnail m-1 view-image "
                                style=" object-fit:cover; width: 90px; height: 90px;">
                            <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 8"
                                class="img-thumbnail m-1 view-image "
                                style=" object-fit:cover; width: 90px; height: 90px;">
                            <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 1"
                                class="img-thumbnail m-1 view-image "
                                style=" object-fit:cover;width: 90px; height: 90px;">
                            <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 2"
                                class="img-thumbnail m-1 view-image "
                                style=" object-fit:cover;width: 90px; height: 90px;">
                            <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 3"
                                class="img-thumbnail m-1 view-image "
                                style="object-fit:cover; width: 90px; height: 90px;">
                            <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 4"
                                class="img-thumbnail m-1 view-image "
                                style=" object-fit:cover;width: 90px; height: 90px;">
                            <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 5"
                                class="img-thumbnail m-1 view-image "
                                style="object-fit:cover; width: 90px; height: 90px;">
                            <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 6"
                                class="img-thumbnail m-1 view-image "
                                style=" object-fit:cover;width: 90px; height: 90px;">
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
            <!-- Tin nhắn của người khác -->
            <div class="message d-flex mb-3">
                <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3"
                    style="object-fit: cover" width="40" height="40">
                <div class="message-content bg-white p-2 rounded">
                    <p class="mb-0">@All tôi cf ae</p>
                    <span class="message-time text-muted small">15:00</span>
                </div>
            </div>
            <div class="message d-flex mb-3">
                <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3"
                    style="object-fit: cover" width="40" height="40">
                <div class="message-content bg-white p-2 rounded">
                    <p class="mb-0">@All tôi cf
                        aeaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                    <span class="message-time text-muted small">15:00</span>
                </div>
            </div>
            <div class="message d-flex mb-3">
                <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3"
                    style="object-fit: cover" width="40" height="40">
                <div class="message-content bg-white p-2 rounded">
                    <p class="mb-0">@All tôi cf
                        aeaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                    <span class="message-time text-muted small">15:00</span>
                </div>
            </div>
            <div class="message d-flex mb-3">
                <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3"
                    style="object-fit: cover" width="40" height="40">
                <div class="message-content bg-white p-2 rounded">
                    <p class="mb-0"> @All tôi cf
                        aeaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                    <span class="message-time text-muted small">15:00</span>
                </div>
            </div>

            <!-- Tin nhắn của chính mình -->
            <div class="message justify-content-end">
                <div class="message-content bg-primary text-white ">
                    <p>thằng tổng ngu </p>
                    <span class="message-time text-light small">15:02</span>
                </div>
                <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle ms-3"
                    style="object-fit: cover" width="40" height="40">
            </div>
            <div class="message justify-content-end">
                <div class="message-content bg-primary text-white">
                    <p>thằng tổng nguaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                        aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                    <span class="message-time text-light small">15:02</span>
                </div>

                <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle ms-3"
                    style="object-fit: cover" width="40" height="40">
            </div>
            <div class="message justify-content-end">
                <div class="message-content bg-primary text-white">
                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Image Message" class="img-fluid"
                        style="width: 300px; height: 300px; border-radius: 10px;">
                    <span class="message-time text-light small">15:02</span>
                </div>

                <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle ms-3"
                    style="object-fit: cover" width="40" height="40">
            </div>
        </div>
        <!-- Thêm input để gửi tin nhắn -->
        <div class="footer-send chat-input d-flex align-items-center bg-white p-3 border-top">
            <div class="input-icons ms-3" style="display: flex;">
                <a href="#" id="folderIcon"><i class="fa-solid fa-folder"></i></a>
                <a href="#" id="imageIcon"><i class="fa-solid fa-image"></i></a>
                <a href="#" id="fileIcon"><i class="fa-solid fa-paperclip"></i></a>
            </div>
            <textarea class="form-control rounded-pill" id="messageInput" placeholder="Nhập @, tin nhắn tới ..." rows="1"
                oninput="toggleSendIcon()" style="resize: none; overflow: hidden; width:700px"></textarea>
            <a href="#" id="sendIcon" style="display: none;">
                <i class="fa-solid fa-paper-plane" style="font-size: 25px;"></i>
            </a>

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
@endsection

@push('scripts')
    <script>
        showSavedToast();
    </script>
@endpush

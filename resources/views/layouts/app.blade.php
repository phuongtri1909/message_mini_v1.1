@include('layouts.partials.header')

<div class="main-coins ">
    @yield('content')
    <div class="container-fluid hehe">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-12 col-md-1 sidebar">
                <!-- Modal Profile -->
                @include('layouts.profile')
                <div class="profile mb-4">
                    <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Profile Picture"
                            class="rounded-circle" width="50" height="50" data-bs-toggle="modal"
                            data-bs-target="#profileModal" style="cursor: pointer;"></a>
                </div>

                <div class="menu-item mb-5">
                    <a href="#"><i class="fa-solid fa-message text-white" style="font-size: 24px;"></i></a>
                </div>
                <div class="menu-item mb-5">
                    <a href="#"><i class="fa-solid fa-cloud text-white" style="font-size: 24px;"></i></a>
                </div>
                <div class="menu-item mb-5">
                    <a href="{{ route('listfriend')}}"><i class="fa-solid fa-user text-white"
                            style="font-size: 24px;"></i></a>
                </div>
                <div class="menu-item setting dropdown">
                    <a href="#" class="dropdown-toggle" id="settingsDropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-cog text-white" style="font-size: 24px;"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                        <li><a class="dropdown-item" href="#" id="logoutOption">Đăng xuất</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#languageSettingsModal">Cài đặt ngôn ngữ</a></li>
                    </ul>
                </div>
            </div>

            <!-- Chat List -->
            <div class="col-md-3 chat-list p-3">
                <div class="search-bar mb-4 d-flex align-items-center">
                    <input type="text" class="form-control me-2" placeholder="Tìm kiếm">
                    <button class="btn" style="border: none; background: none;" data-bs-toggle="modal"
                        data-bs-target="#addFriendModal">
                        <i class="fa-solid fa-user-plus me-2"></i>
                    </button>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#createGroupModal">
                        <a href="#"><i class="fa-solid fa-people-group"></i></a>
                    </button>

                </div>

                <!-- Thêm div bọc các cuộc hội thoại -->
                <div class="chat-list-container">
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                                    class="rounded-circle me-3" width="40" height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng</h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhất</p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                                    class="rounded-circle me-3" width="40" height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng</h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhất</p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                                    class="rounded-circle me-3" width="40" height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng </h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhấffffffffffffffffffffffffffffffffffffft
                                </p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                                    class="rounded-circle me-3" width="40" height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng </h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhấfffffffffffffffffffffffĐoạn tin nhắn gần
                                    nhấffffffffffffffffffffffffffffffffffffftĐoạn tin nhắn gần
                                    nhấffffffffffffffffffffffffffffffffffffftĐoạn tin nhắn gần
                                    nhấffffffffffffffffffffffffffffffffffffftĐoạn tin nhắn gần
                                    nhấffffffffffffffffffffffffffffffffffffftfffffffffffffft</p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                                    class="rounded-circle me-3" width="40" height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng </h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhấffffffffffffffffffffffffffffffffffffft
                                </p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                                    class="rounded-circle me-3" width="40" height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng </h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhấffffffffffffffffffffffffffffffffffffft
                                </p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                                    class="rounded-circle me-3" width="40" height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng </h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhấffffffffffffffffffffffffffffffffffffft
                                </p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                                    class="rounded-circle me-3" width="40" height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng </h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhấffffffffffffffffffffffffffffffffffffft
                                </p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                                    class="rounded-circle me-3" width="40" height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng </h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhấffffffffffffffffffffffffffffffffffffft
                                </p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>

                    <!-- Thêm các cuộc hội thoại khác tại đây -->

                </div>
            </div>


            <!-- Main Chat Window -->
            <div class="col-12 col-md-8 chat-window">
                <div class="chat-header bg-white p-3 border-bottom d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-0">Tên nhóm/Người dùng</h3>
                        <p class="text-muted mb-0">7 thành viên | Tin nhắn đã đọc</p>
                    </div>
                    <button class="btn btn-primary mb-2" id="openAddMembersModal"><i
                            class="fa-solid fa-user-plus"></i></button>

                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        <i class="fa-solid fa-layer-group"></i>
                    </button>

                    <!-- Offcanvas bên phải -->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                        aria-labelledby="offcanvasRightLabel">
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
                                        class="img-thumbnail m-1 view-image"
                                        style="object-fit:cover; width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/uocmo.jpg') }}" alt="Ảnh đã gửi 7"
                                        class="img-thumbnail m-1 view-image"
                                        style=" object-fit:cover;width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/uocmo.jpg') }}" alt="Ảnh đã gửi 7"
                                        class="img-thumbnail m-1 view-image"
                                        style=" object-fit:cover;width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 4"
                                        class="img-thumbnail m-1 view-image"
                                        style=" object-fit:cover; width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 5"
                                        class="img-thumbnail m-1 view-image"
                                        style=" object-fit:cover;width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/uocmo.jpg') }}" alt="Ảnh đã gửi 7"
                                        class="img-thumbnail m-1 view-image"
                                        style=" object-fit:cover;width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 7"
                                        class="img-thumbnail m-1 view-image"
                                        style=" object-fit:cover; width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 8"
                                        class="img-thumbnail m-1 view-image"
                                        style=" object-fit:cover; width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 1"
                                        class="img-thumbnail m-1 view-image"
                                        style=" object-fit:cover;width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 2"
                                        class="img-thumbnail m-1 view-image"
                                        style=" object-fit:cover;width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 3"
                                        class="img-thumbnail m-1 view-image"
                                        style="object-fit:cover; width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 4"
                                        class="img-thumbnail m-1 view-image"
                                        style=" object-fit:cover;width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 5"
                                        class="img-thumbnail m-1 view-image"
                                        style="object-fit:cover; width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 6"
                                        class="img-thumbnail m-1 view-image"
                                        style=" object-fit:cover;width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/uocmo.jpg') }}" alt="Ảnh đã gửi 7"
                                        class="img-thumbnail m-1 view-image"
                                        style=" object-fit:cover;width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 8"
                                        class="img-thumbnail m-1 view-image"
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
                                <li class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Thành viên 1"
                                        class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                    <span>Thành viên 1</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Thành viên 2"
                                        class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                    <span>Thành viên 2</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Thành viên 3"
                                        class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                    <span>Thành viên 3</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Thành viên 4"
                                        class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                    <span>Thành viên 4</span>
                                </li>
                                <li class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Thành viên 5"
                                        class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                    <span>Thành viên 5</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <!-- Modal Thêm Thành Viên -->
                <div class="modal fade" id="addMembersModal" tabindex="-1" aria-labelledby="addMembersModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addMembersModalLabel">Chọn thành viên để thêm vào nhóm</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Danh sách các thành viên có thể chọn -->
                                <div class="form-check">
                                    <input class="form-check-input" name="member1" type="checkbox" value="Thành viên 1" id="member1">
                                    <label class="form-check-label" for="member1">Thành viên 1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="member2" type="checkbox" value="Thành viên 2" id="member2">
                                    <label class="form-check-label" for="member2">Thành viên 2</label>
                                </div>
                                <!-- Thêm các thành viên khác vào đây -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="addSelectedMembers">Thêm</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal để hiển thị ảnh lớn -->
                <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <img id="modalImage" src="" alt="Ảnh lớn" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>



                <div class="chat-messages flex-grow-1 p-3 bg-light overflow-auto">
                    <!-- Tin nhắn của người khác -->
                    <div class="message d-flex mb-3">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                            class="rounded-circle me-3" width="40" height="40">
                        <div class="message-content bg-white p-2 rounded">
                            <p class="mb-0">@All tôi cf ae</p>
                            <span class="message-time text-muted small">15:00</span>
                        </div>
                    </div>
                    <div class="message d-flex mb-3">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                            class="rounded-circle me-3" width="40" height="40">
                        <div class="message-content bg-white p-2 rounded">
                            <p class="mb-0">@All tôi cf
                                aeaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                            <span class="message-time text-muted small">15:00</span>
                        </div>
                    </div>
                    <div class="message d-flex mb-3">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                            class="rounded-circle me-3" width="40" height="40">
                        <div class="message-content bg-white p-2 rounded">
                            <p class="mb-0">@All tôi cf
                                aeaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                            <span class="message-time text-muted small">15:00</span>
                        </div>
                    </div>
                    <div class="message d-flex mb-3">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                            class="rounded-circle me-3" width="40" height="40">
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
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                            class="rounded-circle ms-3" width="40" height="40">
                    </div>
                    <div class="message justify-content-end">
                        <div class="message-content bg-primary text-white">
                            <p>thằng tổng nguaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                                aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                            <span class="message-time text-light small">15:02</span>
                        </div>

                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                            class="rounded-circle ms-3" width="40" height="40">
                    </div>
                    <div class="message justify-content-end">
                        <div class="message-content bg-primary text-white">
                            <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Image Message"
                                class="img-fluid" style="width: 300px; height: 300px; border-radius: 10px;">
                            <span class="message-time text-light small">15:02</span>
                        </div>

                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                            class="rounded-circle ms-3" width="40" height="40">
                    </div>


                </div>

                <div class="chat-input d-flex align-items-center bg-white p-3 border-top">
                    <div class="input-icons ms-3" style="display: flex;">
                        <a href="#"><i class="fa-solid fa-folder"></i></a>
                        <a href="#"><i class="fa-solid fa-image"></i></a>
                        <a href="#"><i class="fa-solid fa-paperclip"></i></a>
                    </div>
                    <!-- Thay đổi input thành textarea -->
                    <textarea class="form-control rounded-pill" id="messageInput" placeholder="Nhập @, tin nhắn tới ..."
                        rows="1" oninput="toggleSendIcon()" style="resize: none; overflow: hidden;"></textarea>
                    <a href="#" id="sendIcon" style="display: none;">
                        <i class="fa-solid fa-paper-plane" style="font-size: 25px;"></i>
                    </a>
                </div>


            </div>
        </div>
    </div>
    <!--modal thêm bạn-->
    <div class="modal fade" id="addFriendModal" tabindex="-1" aria-labelledby="addFriendModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFriendModalLabel">Thêm Bạn Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="friendName" class="form-label">Nhập Email:</label>
                            <input type="text" class="form-control" id="friendName" placeholder="Nhập Email">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm bạn</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--modal cài đặt ngôn ngữ -->

<div class="modal fade" id="languageSettingsModal" tabindex="-1" aria-labelledby="languageSettingsLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="languageSettingsLabel">Cài đặt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="settings-container">
                    <div class="row">
                        <div class="col-4">
                            <button type="button" class="btn btn-light" id="generalSettingsBtn">
                                <i class="fa-solid fa-gear"></i> Cài đặt chung
                            </button>
                        </div>
                        <div class="col-8">
                            <label for="languageSelect" class="form-label">Thay đổi ngôn ngữ</label>
                            <select class="form-select" id="languageSelect" aria-label="Language select">
                                <option value="en">Tiếng Anh</option>
                                <option value="vi">Tiếng Việt</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="saveSettingsBtn">Đồng ý</button>
            </div>
        </div>
    </div>
</div>

<!--Modal tìm kiếm kết bạn-->
<div class="modal fade" id="friendSearchModal" tabindex="-1" aria-labelledby="friendSearchLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="friendSearchLabel">Thêm bạn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form tìm kiếm -->
                <div class="search-form">
                    <input type="text" class="form-control" id="emailSearch" placeholder="Nhập email bạn bè...">
                </div>

                <!-- Kết quả tìm kiếm -->
                <div class="search-result mt-3" style="display: none;" id="searchResult">
                    <div class="avatar" style="float: left; margin-right: 10px;">
                        <img src="https://via.placeholder.com/50" alt="Avatar" class="rounded-circle">
                    </div>
                    <div class="user-info">
                        <p><strong id="userName">User1</strong></p>
                        <p id="userEmail" style="color: gray;">User1@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="searchButton">Tìm kiếm</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal tạo nhóm-->
<div class="modal fade" id="createGroupModal" tabindex="-1" aria-labelledby="createGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createGroupModalLabel">Tạo Nhóm Mới</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createGroupForm">
                    <div class="form-group d-flex">
                        <div class="group-image-container">
                            <label for="groupImageInput">
                                <div class="group-image-circle">
                                    <i class="fa-solid fa-camera"></i>
                                </div>
                            </label>
                            <input type="file" id="groupImageInput" style="display:none;"
                                onchange="previewImage(event)">
                        </div>
                        <div class="group-name-container w-100 "
                            style="padding-left: 20px;top: 15px;position: relative; padding-left: 20px">
                            <label for="groupName">Tên nhóm</label>
                            <input type="text" class="form-control" id="groupName" placeholder="Nhập tên nhóm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="groupMembers">Thành viên</label>
                        <input type="text" class="form-control" id="groupMembers" placeholder="Nhập tên thành viên">
                    </div>
                    <!-- Danh sách thành viên -->
                    <div class="list-group" id="membersList">
                        <!-- Đây là nơi danh sách thành viên sẽ xuất hiện -->
                        <label>Tất cả thành viên</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="member1">
                            <label class="form-check-label" for="member1">
                                <img src="{{ asset('assets/images/svg/lenovo.jpg') }}" alt="avatar" width="60"
                                    height="60" style="border-radius: 50%"> Tiểu Cường Nè
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="member2">
                            <label class="form-check-label" for="member2">
                                <img src="{{ asset('assets/images/svg/lenovo.jpg') }}" alt="avatar" width="60"
                                    height="60" style="border-radius: 50%"> Tiểu Cường Đây
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="member3">
                            <label class="form-check-label" for="member3">
                                <img src="{{ asset('assets/images/svg/lenovo.jpg') }}" alt="avatar" width="60"
                                    height="60" style="border-radius: 50%"> Tiểu Cường Kia
                            </label>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="submitGroup()">Tạo nhóm</button>
            </div>
        </div>
    </div>
</div>

<script>
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

</script>
@include('layouts.partials.footer')
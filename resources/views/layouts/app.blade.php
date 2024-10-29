@include('layouts.partials.header')

<div class="main-coins ">
    @yield('content')
    {{-- Hiện thông báo cập nhật user --}}
    <div class="notification-container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
    
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="container-fluid hehe">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-12 col-md-1 sidebar">
                <!-- Modal Profile -->
                @include('layouts.profile')
                <div class="profile mb-4">
                    <img src="{{ Storage::url(Auth()->user()->avatar)}}" alt="Profile Picture"
                            class="rounded-circle" width="50" height="50" data-bs-toggle="modal"
                            data-bs-target="#profileModal" style="cursor: pointer;">
                </div>

                <div class="menu-item mb-5">
                    <a href="#"><i class="fa-solid fa-message text-white" style="font-size: 24px;"></i></a>
                </div>
                <div class="menu-item mb-5">
                    <a href="#"><i class="fa-solid fa-cloud text-white" style="font-size: 24px;"></i></a>
                </div>
                <div class="menu-item mb-5">
                    <a href="{{ route('friends.list')}}"><i class="fa-solid fa-user text-white"
                            style="font-size: 24px;"></i></a>
                </div>
                <!-- Nút mở modal danh sách bạn bè -->
                <button type="button" style=" font-size: 24px;" data-bs-toggle="modal"
                    data-bs-target="#friendsListModal">
                    <i class="fa-regular fa-address-book"></i>
                </button>
                <!-- Nút mở modal lời mời kết bạn -->
                <button type="button" id="showFriendRequestsModal" style="font-size: 24px;" data-bs-toggle="modal"
                    data-bs-target="#friendRequestsModal">
                    <i class="fa-solid fa-handshake bg-drak"></i>
                </button>

                <div class="menu-item setting dropdown">
                    <a href="#" class="dropdown-toggle" id="settingsDropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-cog text-white" style="font-size: 24px;"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                        <li><a class="dropdown-item" href="{{route('logout')}}" id="logoutOption">Đăng xuất</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#languageSettingsModal">Cài đặt ngôn ngữ</a></li>
                    </ul>
                </div>
            </div>

            <!-- Chat List -->
            <div class="col-md-3 chat-list p-3">
                <div class="search-bar mb-4 d-flex align-items-center">
                    <input type="text" class="form-control me-2" placeholder="Tìm kiếm">
                    <button class="btn" style="border: none; background: none; padding-left: 2px;"
                        data-bs-toggle="modal" data-bs-target="#addFriendModal">
                        <i class="fa-solid fa-user-plus "></i>
                    </button>

                    <button type="button" style="border: none; background: none; padding-left: 2px;"
                        data-bs-toggle="modal" data-bs-target="#createGroupModal">
                        <a href="#"><i class="fa-solid fa-people-group"></i></a>
                    </button>

                </div>

                <!-- Thêm div bọc các cuộc hội thoại -->
                <div class="chat-list-container">
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                                    class="rounded-circle me-3" style="object-fit: cover" width="40" height="40"></a>
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
                                    class="rounded-circle me-3" style="object-fit: cover" width="40" height="40"></a>
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
                    <!-- Nút mở offcanvas để hiển thị thành viên và chọn thêm -->
                    <button class="btn btn-primary mb-2" id="openAddMembersModal" style="margin-right: 650px"><i
                            class="fa-solid fa-user-group"></i></button>
                    <!-- Button các chức năng của nhóm -->
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
                                        class="img-thumbnail m-1 view-image "
                                        style="object-fit:cover; width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/uocmo.jpg') }}" alt="Ảnh đã gửi 7"
                                        class="img-thumbnail m-1 view-image "
                                        style=" object-fit:cover;width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/uocmo.jpg') }}" alt="Ảnh đã gửi 7"
                                        class="img-thumbnail m-1 view-image  "
                                        style=" object-fit:cover;width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 4"
                                        class="img-thumbnail m-1 view-image "
                                        style=" object-fit:cover; width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Ảnh đã gửi 5"
                                        class="img-thumbnail m-1 view-image "
                                        style=" object-fit:cover;width: 90px; height: 90px;">
                                    <img src="{{ asset('assets/images/logo/uocmo.jpg') }}" alt="Ảnh đã gửi 7"
                                        class="img-thumbnail m-1 view-image "
                                        style=" object-fit:cover;width: 90px; height: 90px;">
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
                                            class="rounded-circle me-2"
                                            style="object-fit:cover; width: 40px; height: 40px;">
                                        <span>Thành viên 1</span>
                                    </div>
                                    <button class="btn btn-danger btn-sm ms-2"><i
                                            class="fa-solid fa-user-xmark"></i></button>
                                </li>
                                <li class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Thành viên 2"
                                            class="rounded-circle me-2"
                                            style="object-fit:cover; width: 40px; height: 40px;">
                                        <span>Thành viên 2</span>
                                    </div>
                                    <button class="btn btn-danger btn-sm ms-2"><i
                                            class="fa-solid fa-user-xmark"></i></button>
                                </li>
                                <li class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Thành viên 3"
                                            class="rounded-circle me-2"
                                            style="object-fit:cover; width: 40px; height: 40px;">
                                        <span>Thành viên 3</span>
                                    </div>
                                    <button class="btn btn-danger btn-sm ms-2"><i
                                            class="fa-solid fa-user-xmark"></i></button>
                                </li>
                                <li class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Thành viên 4"
                                            class="rounded-circle me-2"
                                            style="object-fit:cover; width: 40px; height: 40px;">
                                        <span>Thành viên 4</span>
                                    </div>
                                    <button class="btn btn-danger btn-sm ms-2"><i
                                            class="fa-solid fa-user-xmark"></i></button>
                                </li>
                                <li class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Thành viên 5"
                                            class="rounded-circle me-2"
                                            style="object-fit:cover; width: 40px; height: 40px;">
                                        <span>Thành viên 5</span>
                                    </div>
                                    <button class="btn btn-danger btn-sm ms-2"><i
                                            class="fa-solid fa-user-xmark"></i></button>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>



                <div class="chat-messages flex-grow-1 p-3 bg-light overflow-auto">
                    <!-- Tin nhắn của người khác -->
                    <div class="message d-flex mb-3">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                            class="rounded-circle me-3" style="object-fit: cover" width="40" height="40">
                        <div class="message-content bg-white p-2 rounded">
                            <p class="mb-0">@All tôi cf ae</p>
                            <span class="message-time text-muted small">15:00</span>
                        </div>
                    </div>
                    <div class="message d-flex mb-3">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                            class="rounded-circle me-3" style="object-fit: cover" width="40" height="40">
                        <div class="message-content bg-white p-2 rounded">
                            <p class="mb-0">@All tôi cf
                                aeaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                            <span class="message-time text-muted small">15:00</span>
                        </div>
                    </div>
                    <div class="message d-flex mb-3">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                            class="rounded-circle me-3" style="object-fit: cover" width="40" height="40">
                        <div class="message-content bg-white p-2 rounded">
                            <p class="mb-0">@All tôi cf
                                aeaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                            <span class="message-time text-muted small">15:00</span>
                        </div>
                    </div>
                    <div class="message d-flex mb-3">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                            class="rounded-circle me-3" style="object-fit: cover" width="40" height="40">
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
                            class="rounded-circle ms-3" style="object-fit: cover" width="40" height="40">
                    </div>
                    <div class="message justify-content-end">
                        <div class="message-content bg-primary text-white">
                            <p>thằng tổng nguaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                                aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                            <span class="message-time text-light small">15:02</span>
                        </div>

                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                            class="rounded-circle ms-3" style="object-fit: cover" width="40" height="40">
                    </div>
                    <div class="message justify-content-end">
                        <div class="message-content bg-primary text-white">
                            <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Image Message"
                                class="img-fluid" style="width: 300px; height: 300px; border-radius: 10px;">
                            <span class="message-time text-light small">15:02</span>
                        </div>

                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User"
                            class="rounded-circle ms-3" style="object-fit: cover" width="40" height="40">
                    </div>
                </div>
                <!-- Thêm input để gửi tin nhắn -->
                <div class="chat-input d-flex align-items-center bg-white p-3 border-top">
                    <div class="input-icons ms-3" style="display: flex;">
                        <a href="#" id="folderIcon"><i class="fa-solid fa-folder"></i></a>
                        <a href="#" id="imageIcon"><i class="fa-solid fa-image"></i></a>
                        <a href="#" id="fileIcon"><i class="fa-solid fa-paperclip"></i></a>
                    </div>
                    <textarea class="form-control rounded-pill" id="messageInput" placeholder="Nhập @, tin nhắn tới ..."
                        rows="1" oninput="toggleSendIcon()"
                        style="resize: none; overflow: hidden; width:700px"></textarea>
                    <a href="#" id="sendIcon" style="display: none;">
                        <i class="fa-solid fa-paper-plane" style="font-size: 25px;"></i>
                    </a>
                </div>

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
    </div>

</div>


<!-- Modal Thêm Thành Viên -->
<div class="modal fade" id="addMembersModal" tabindex="-1" aria-labelledby="addMembersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMembersModalLabel">Chọn thành viên để thêm vào nhóm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <img id="modalImage" src="" alt="Ảnh lớn" class="img-fluid">
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
                <div class="mb-3">
                    <label for="friendEmail" class="form-label">Nhập Email:</label>
                    <input type="email" class="form-control" id="friendEmail" placeholder="Nhập Email" required
                        pattern="^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$" title="Vui lòng nhập định dạng email hợp lệ."
                        maxlength="100">
                </div>
                <button type="button" class="btn btn-primary" id="searchButton" disabled>Tìm kiếm</button>

                <!-- Kết quả tìm kiếm -->
                <div class="search-result mt-3" id="searchResult" style="display: none;">
                    <div class="user-info">
                        <div class="avatar" style="float: left; margin-right: 10px;">
                            <img src="{{ asset('assets/images/logo/uocmo.jpg') }}" alt="Avatar" class="rounded-circle"
                                id="resultUserAvatar" style="height: 50px; width:50px;">
                        </div>
                        <div>
                            <p><strong id="resultUserName"></strong></p>
                            <p id="resultUserEmail" style="color: gray;"></p>
                            <p id="resultUserGender" style="color: gray;"></p> <!-- Thêm giới tính -->
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="sendRequestButton" style="display: none;">Gửi yêu
                        cầu kết bạn</button>
                    <button type="button" class="btn btn-danger" id="cancelRequestButton" style="display: none;">Thu hồi
                        yêu cầu</button>
                    <button type="button" class="btn btn-info" id="messageButtonn" style="display: none;">Nhắn
                        tin</button> <!-- Nút nhắn tin -->
                </div>


                <div id="errorMessage" class="mt-3 text-danger" style="display: none;"></div>
                <!-- Thêm phần thông báo lỗi -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>


<!--modal các lời mời-->

<div class="modal fade" id="friendRequestsModal" tabindex="-1" aria-labelledby="friendRequestsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="friendRequestsModalLabel">Danh Sách Lời Mời Kết Bạn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="friendRequestsList">
                    <!-- Danh sách lời mời kết bạn sẽ được chèn ở đây -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal hiển thị danh sách bạn bè -->
<div class="modal fade" id="friendsListModal" tabindex="-1" aria-labelledby="friendsListModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="friendsListModalLabel">Danh Sách Bạn Bè</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="friendsList">
                    <!-- Danh sách bạn bè sẽ được chèn ở đây -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="height:96px; width:96px;">Đóng</button>
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


@include('layouts.partials.footer')

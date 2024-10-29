@include('layouts.partials.header')

<div class="message_mini">
    @yield('content')
    <div class="container-fluid hehe">
        <div class="row">
            <!-- Left Sidebar -->
            <section class="col-1 sidebar">
                @include('pages.modal.profile')
                <div class="d-flex justify-content-center align-items-center">
                    <div>
                        <div class="profile mb-4 mt-1 text-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}"
                                    alt="Profile Picture" class="rounded-circle" width="50" height="50"
                                    data-bs-toggle="modal" data-bs-target="#profileModal" style="cursor: pointer;"></a>
                        </div>
                        <ul class="nav flex-column align-items-center">
                            <li class="nav-item mb-3">
                                <a href="{{ route('home') }}" class="nav-link p-0"><i
                                        class="fa-solid fa-message text-white" style="font-size: 24px;"></i></a>
                            </li>
                            <li class="nav-item mb-3">
                                <a href="#" class="nav-link p-0"><i class="fa-solid fa-cloud text-white"
                                        style="font-size: 24px;"></i></a>
                            </li>
                            <li class="nav-item mb-3">
                                <a href="{{ route('friends.list') }}" class="nav-link p-0"><i
                                        class="fa-solid fa-user text-white" style="font-size: 24px;"></i></a>
                            </li>
                            <li class="nav-item mb-3">
                                <!-- Nút mở modal danh sách bạn bè -->
                                <button type="button" class="btn p-0" style="font-size: 24px;" data-bs-toggle="modal"
                                    data-bs-target="#friendsListModal">
                                    <i class="fa-regular fa-address-book text-white"></i>
                                </button>
                            </li>
                            <li class="nav-item mb-3">
                                <!-- Nút mở modal lời mời kết bạn -->
                                <button type="button" id="showFriendRequestsModal" class="btn p-0"
                                    style="font-size: 24px;" data-bs-toggle="modal"
                                    data-bs-target="#friendRequestsModal">
                                    <i class="fa-solid fa-handshake text-white"></i>
                                </button>
                            </li>
                            <li class="nav-item mb-3">
                                <div class="menu-item setting dropdown">
                                    <a href="#" class="dropdown-toggle" id="settingsDropdown" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-cog text-white" style="font-size: 24px;"></i>
                                    </a>
                                    <ul class="dropdown-menu bg-drak" aria-labelledby="settingsDropdown">
                                        <li><a class="dropdown-item" href="{{ route('logout') }}" id="logoutOption">Đăng
                                                xuất</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#languageSettingsModal">Cài đặt ngôn ngữ</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Chat List -->
            <section class="col-0 col-md-3 bg-white p-3" style="border-right: 0.5px solid rgba(224, 226, 225, 0.874);">
                @yield('content-1')
            </section>

            <!-- Main Chat Window -->
            <section class="col-11 col-md-8 chat-window px-0">
                @yield('content-2')
            </section>
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
                    <button type="button" class="btn btn-success" id="sendRequestButton" style="display: none;">Gửi
                        yêu
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    style="height:96px; width:96px;">Đóng</button>
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
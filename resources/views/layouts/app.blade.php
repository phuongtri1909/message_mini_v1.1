@include('layouts.partials.header')

<div class="main-coins ">
    @yield('content')
    <div class="container-fluid hehe">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-12 col-md-1 sidebar">
                <div class="profile mb-4">
                    <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Profile Picture" class="rounded-circle" width="50"
                            height="50"></a>
                </div>
                <div class="menu-item mb-5">
                    <a href="#"><i class="fa-solid fa-message text-white" style="font-size: 24px;"></i></a>
                </div>
                <div class="menu-item mb-5">
                    <a href="#"><i class="fa-solid fa-cloud text-white" style="font-size: 24px;"></i></a>
                </div>
                <div class="menu-item mb-5">
                    <a href="#"><i class="fa-solid fa-user text-white" style="font-size: 24px;"></i></a>
                </div>
                <div class="menu-item setting dropdown">
                    <a href="#" class="dropdown-toggle" id="settingsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-cog text-white" style="font-size: 24px;"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                        <li><a class="dropdown-item" href="#" id="logoutOption">Đăng xuất</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#languageSettingsModal">Cài đặt ngôn ngữ</a></li>
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
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3" width="40"
                                    height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng</h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhất</p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3" width="40"
                                    height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng</h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhất</p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                     <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3" width="40"
                                    height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng </h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhấffffffffffffffffffffffffffffffffffffft</p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3" width="40"
                                    height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng </h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhấfffffffffffffffffffffffĐoạn tin nhắn gần nhấffffffffffffffffffffffffffffffffffffftĐoạn tin nhắn gần nhấffffffffffffffffffffffffffffffffffffftĐoạn tin nhắn gần nhấffffffffffffffffffffffffffffffffffffftĐoạn tin nhắn gần nhấffffffffffffffffffffffffffffffffffffftfffffffffffffft</p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3" width="40"
                                    height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng </h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhấffffffffffffffffffffffffffffffffffffft</p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3" width="40"
                                    height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng </h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhấffffffffffffffffffffffffffffffffffffft</p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3" width="40"
                                    height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng </h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhấffffffffffffffffffffffffffffffffffffft</p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3" width="40"
                                    height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng </h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhấffffffffffffffffffffffffffffffffffffft</p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                    <div class="chat-item rounded">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3" width="40"
                                    height="40"></a>
                            <div class="chat-info">
                                <h5 class="mb-0">Tên người dùng </h5>
                                <p class="text-muted mb-0">Đoạn tin nhắn gần nhấffffffffffffffffffffffffffffffffffffft</p>
                            </div>
                        </div>
                        <span class="chat-time text-muted small">5 phút trước</span>
                    </div>
                    
                    <!-- Thêm các cuộc hội thoại khác tại đây -->
                    
                </div>
            </div>
            

            <!-- Main Chat Window -->
            <div class="col-12 col-md-8 chat-window">
                <div class="chat-header bg-white p-3 border-bottom">
                    <h3 class="mb-0">Tên nhóm/Người dùng</h3>
                    <p class="text-muted mb-0">7 thành viên | Tin nhắn đã đọc</p>
                </div>
                <div class="chat-messages flex-grow-1 p-3 bg-light overflow-auto">
                    <!-- Tin nhắn của người khác -->
                    <div class="message d-flex mb-3">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3" width="40" height="40">
                        <div class="message-content bg-white p-2 rounded">
                            <p class="mb-0">@All tôi cf ae</p>
                            <span class="message-time text-muted small">15:00</span>
                        </div>
                    </div>
                    <div class="message d-flex mb-3">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3" width="40" height="40">
                        <div class="message-content bg-white p-2 rounded">
                            <p class="mb-0">@All tôi cf
                                aeaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                            <span class="message-time text-muted small">15:00</span>
                        </div>
                    </div>
                    <div class="message d-flex mb-3">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3" width="40" height="40">
                        <div class="message-content bg-white p-2 rounded">
                            <p class="mb-0">@All tôi cf
                                aeaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                            <span class="message-time text-muted small">15:00</span>
                        </div>
                    </div>
                    <div class="message d-flex mb-3">
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle me-3" width="40" height="40">
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
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle ms-3" width="40" height="40">
                    </div>
                    <div class="message justify-content-end">
                        <div class="message-content bg-primary text-white">
                            <p>thằng tổng nguaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                            <span class="message-time text-light small">15:02</span>
                        </div>

                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle ms-3" width="40" height="40">
                    </div>
                    <div class="message justify-content-end">
                        <div class="message-content bg-primary text-white mb-5">
                            <p>thằng tổng nguaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                            <span class="message-time text-light small">15:02</span>
                        </div>

                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="User" class="rounded-circle ms-3" width="40" height="40">
                    </div>
                </div>

                <div class="chat-input d-flex align-items-center bg-white p-3 border-top">
                    <div class="input-icons ms-3" style="display: flex;">
                        <a href="#"><i class="fa-solid fa-folder"></i></a>
                        <a href="#"><i class="fa-solid fa-image"></i></a>
                        <a href="#"><i class="fa-solid fa-paperclip"></i></a>
                    </div>
                    <input type="text" class="form-control rounded-pill" id="messageInput" placeholder="Nhập @, tin nhắn tới ..." oninput="toggleSendIcon()">
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

<div class="modal fade" id="languageSettingsModal" tabindex="-1" aria-labelledby="languageSettingsLabel" aria-hidden="true">
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
                    <input type="file" id="groupImageInput" style="display:none;" onchange="previewImage(event)">
                </div>
                <div class="group-name-container w-100">
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
                <img src="{{ asset('assets/images/svg/lenovo.jpg') }}" alt="avatar" width="60" height="60" style="border-radius: 50%"> Tiểu Cường Nè
              </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="member1">
                <label class="form-check-label" for="member1">
                  <img src="{{ asset('assets/images/svg/lenovo.jpg') }}" alt="avatar" width="60" height="60" style="border-radius: 50%"> Tiểu Cường Đây
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="member1">
                <label class="form-check-label" for="member1">
                  <img src="{{ asset('assets/images/svg/lenovo.jpg') }}" alt="avatar" width="60" height="60" style="border-radius: 50%"> Tiểu Cường Kia
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
@include('layouts.partials.header')

<div class="main-coins ">
    @yield('content')
    <div class="row h-100">
        <!-- Left Sidebar -->
        <div class="col-md-1 pt-3 sidebar">
            <div class="profile mb-4">
                <a href="#"><img src="uocmo.jpg" alt="Profile Picture" class="rounded-circle" width="50" height="50"></a>
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
            <div class="menu-item setting">
              <a href="#"><i class="fa-solid fa-cog text-white" style="font-size: 24px;"></i></a>
            </div>
        </div>

        <!-- Chat List -->
        <div class="col-md-3 chat-list p-3">
          <div class="search-bar mb-4 d-flex align-items-center">
            <input type="text" class="form-control me-2" placeholder="Tìm kiếm">
            <a href="#"><i class="fa-solid fa-user-plus me-2"></i></a>
            <a href="#"><i class="fa-solid fa-people-group"></i></a>
        </div>
            <div class="chat-item rounded">
                <div class="d-flex align-items-center">
                   <a href="#"><img src="uocmo.jpg" alt="User" class="rounded-circle me-3" width="40" height="40"></a>
                    <div class="chat-info">
                        <h5 class="mb-0">Tên người dùng</h5>
                        <p class="text-muted mb-0">Đoạn tin nhắn gần nhất</p>
                    </div>
                </div>
                <span class="chat-time text-muted small">5 phút trước</span>
            </div>
            <div class="chat-item rounded">
              <div class="d-flex align-items-center">
                <a href="#"><img src="uocmo.jpg" alt="User" class="rounded-circle me-3" width="40" height="40"></a>
                  <div class="chat-info">
                      <h5 class="mb-0">Tên người dùng</h5>
                      <p class="text-muted mb-0">Đoạn tin nhắn gần nhất</p>
                  </div>
              </div>
              <span class="chat-time text-muted small">5 phút trước</span>
          </div>
        </div>

        <!-- Main Chat Window -->
        <div class="col-md-8 chat-window">
          <div class="chat-header bg-white p-3 border-bottom">
              <h3 class="mb-0">Tên nhóm/Người dùng</h3>
              <p class="text-muted mb-0">7 thành viên | Tin nhắn đã đọc</p>
          </div>
          <div class="chat-messages flex-grow-1 p-3 bg-light overflow-auto">
              <!-- Tin nhắn của người khác -->
              <div class="message d-flex mb-3">
                  <img src="uocmo.jpg" alt="User" class="rounded-circle me-3" width="40" height="40">
                  <div class="message-content bg-white p-2 rounded">
                      <p class="mb-0">@All tôi cf ae</p>
                      <span class="message-time text-muted small">15:00</span>
                  </div>
              </div>
              <div class="message d-flex mb-3">
                <img src="uocmo.jpg" alt="User" class="rounded-circle me-3" width="40" height="40">
                <div class="message-content bg-white p-2 rounded">
                    <p class="mb-0">@All tôi cf aeaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                    <span class="message-time text-muted small">15:00</span>
                </div>
            </div>
            <div class="message d-flex mb-3">
              <img src="uocmo.jpg" alt="User" class="rounded-circle me-3" width="40" height="40">
              <div class="message-content bg-white p-2 rounded">
                  <p class="mb-0">@All tôi cf aeaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                  <span class="message-time text-muted small">15:00</span>
              </div>
          </div>
          <div class="message d-flex mb-3">
            <img src="uocmo.jpg" alt="User" class="rounded-circle me-3" width="40" height="40">
            <div class="message-content bg-white p-2 rounded">
                <p class="mb-0">@All tôi cf aeaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
                <span class="message-time text-muted small">15:00</span>
            </div>
        </div>
            
          
              <!-- Tin nhắn của chính mình -->
              <div class="message d-flex mb-3 justify-content-end">
                  <div class="message-content bg-primary text-white p-2 rounded">
                      <p class="mb-0">OK, hẹn gặp</p>
                      <span class="message-time text-light small">15:02</span>
                  </div>
                  <img src="uocmo.jpg" alt="User" class="rounded-circle ms-3" width="40" height="40">
              </div>
          </div>
          
          <div class="chat-input d-flex align-items-center bg-white p-3 border-top">
              <input type="text" class="form-control rounded-pill" placeholder="Nhập @, tin nhắn tới ...">
              <div class="input-icons ms-3">
                  <img src="icon-emoji.png" alt="Emoji" width="24" height="24">
                  <img src="icon-file.png" alt="File" width="24" height="24" class="ms-2">
              </div>
          </div>
      </div>
      
    </div>
</div>


@include('layouts.partials.footer')

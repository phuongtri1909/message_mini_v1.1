@include('layouts.partials.header')

<div class="main-coins ">
    @yield('content')
    <div class="row h-100">
      <!-- Left Sidebar -->
      <div class="col-1 col-md-1 pt-3 sidebar">
          <div class="profile mb-4">
              <a href="#"><img src="uocmo.jpg" alt="Profile Picture" class="rounded-circle" width="50"
                      height="50"></a>
          </div>
          <div class="menu-item ">
              <a href="#"><i class="fa-solid fa-message text-white" style="font-size: 24px;"></i></a>
          </div>
          <div class="menu-item ">
              <a href="#"><i class="fa-solid fa-cloud text-white" style="font-size: 24px;"></i></a>
          </div>
          <div class="menu-item ">
              <a href="listFr.html"><i class="fa-solid fa-user text-white" style="font-size: 24px;"></i></a>
          </div>
          <div class="menu-item mt-auto setting">
              <a href="#"><i class="fa-solid fa-cog text-white" style="font-size: 24px;"></i></a>
          </div>
      </div>

      <!-- Friend List -->
      <div class="col-md-3 chat-list p-3">
          <div class="search-bar mb-4 d-flex align-items-center">
              <input type="text" class="form-control me-2" placeholder="Tìm kiếm">
              <a href="#"><i class="fa-solid fa-user-plus me-2" style="font-size: 30px;"></i></a>
              <a href="#"><i class="fa-solid fa-people-group" style="font-size: 30px;"></i></a>
          </div>
          <div class="chat-item rounded">
              <div class="d-flex align-items-center">
                  <i class="fa-solid fa-user-group me-2" style="font-size: 30px;"></i>
                  <div class="chat-info">
                      <h5 class="mb-0">Danh Sách Bạn Bè</h5>
                  </div>
              </div>
          </div>
          <div class="chat-item rounded">
              <div class="d-flex align-items-center">
                  <i class="fa-solid fa-user-plus me-2" style="font-size: 30px;"></i>
                  <div class="chat-info">
                      <h5 class="mb-0">Lời Mời Kết Bạn</h5>
                  </div>
              </div>
          </div>
      </div>

      <!-- Main Chat Window -->
      <div class="col-11 col-md-8 chat-window">
          <div class="chat-header bg-white p-3 border-bottom">
              <i class="fa-solid fa-user-group me-2"></i>
              <h3 class="mb-0">Danh Sách Bạn bè</h3>
          </div>
          <div class="search-bar-main">
              <input type="text" class="form-control" placeholder="Tìm kiếm bạn bè">
              <button type="button" class="btn btn-primary"><i class="fa-solid fa-search"></i></button>
          </div>
          <div class="chat-body bg-white p-3 border-bottom">
              <p class="text-muted mb-0">Bạn bè (3)</p>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 1" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Nguyễn Văn Aaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</span>
                  <a href="#"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 2" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Trần Thị B</span>
                  <a href="#"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
              <div class="friend-item d-flex align-items-center p-2">
                  <img src="uocmo.jpg" alt="Friend 3" class="friend-img rounded-circle me-3" width="40"
                      height="40">
                  <span class="friend-name">Lê Minh C</span>
                  <a href="#" class="ml-auto toggle-menu" tabindex="0"><i class="fa-solid fa-ellipsis-v"></i></a>
              </div>
          </div>
      </div>
  </div>
    
  </div>

@include('layouts.partials.footer')
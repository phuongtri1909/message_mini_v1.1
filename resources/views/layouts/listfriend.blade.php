@include('layouts.partials.header')

<div class="main-coins">
    @yield('content')
    <div class="container-fluid hehe">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-12 col-md-1 sidebar">
                <div class="profile mb-4">
                    <a href="#"><img src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="Profile Picture" class="rounded-circle" width="50" height="50"></a>
                </div>
                <div class="menu-item mb-5">
                    <a href="{{route('home')}}"><i class="fa-solid fa-message text-white" style="font-size: 24px;"></i></a>
                </div>
                <div class="menu-item mb-5">
                    <a href="#"><i class="fa-solid fa-cloud text-white" style="font-size: 24px;"></i></a>
                </div>
                <div class="menu-item mb-5">
                    <a href="{{ route('friends.list')}}"><i class="fa-solid fa-user text-white" style="font-size: 24px;"></i></a>
                </div>
                <div class="menu-item setting dropdown">
                    <a href="#" class="dropdown-toggle" id="settingsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-cog text-white" style="font-size: 24px;"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                        <li><a class="dropdown-item" href="{{route('logout')}}" id="logoutOption">Đăng xuất</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#languageSettingsModal">Cài đặt ngôn ngữ</a></li>
                    </ul>
                </div>
            </div>
            <!-- Friend List -->
            <div class="col-md-3 chat-list p-3">
                <div class="search-bar mb-4 d-flex align-items-center">
                    <input type="text" class="form-control me-2" placeholder="Tìm kiếm">
                    <button class="btn" style="border: none; background: none;" data-bs-toggle="modal" data-bs-target="#addFriendModal">
                        <i class="fa-solid fa-user-plus me-2"></i>
                    </button>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#createGroupModal">
                        <a href="{{route('friends.list')}}"><i class="fa-solid fa-people-group"></i></a>
                    </button>
                </div>
                <div class="listfr-item rounded">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-user-group me-2"></i>
                        <div class="listfr-info">
                            <h5 class="mb-0">Danh Sách Bạn Bè</h5>
                        </div>
                    </div>
                </div>
                <div class="listfr-item rounded" id="friendRequests">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-user-plus me-2" id="showFriendRequestsModal" style="cursor: pointer;"></i>
                        <div class="listfr-info">
                            <h5 class="mb-0">Lời Mời Kết Bạn</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main List Window -->
            <div class="col-11 col-md-8">
                <div class="listfr-header bg-white p-3 border-bottom d-flex align-items-center">
                    <i class="fa-solid fa-user-group me-2"></i>
                    <h3 class="mb-0">Danh Sách Bạn bè ({{ $friends->total() }})</h3>
                </div>
                @if (session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mt-3">{{ session('error') }}</div>
            @endif
                
                <div class="search-bar-main d-flex p-3 bg-light">
                    <form action="{{ route('friends.search') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="query" class="form-control me-2" placeholder="Tìm kiếm bạn bè" value="{{ request('query') }}">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-search"></i></button>
                    </form>
                </div>
                
                <div class="listfr-body bg-white p-3">
                    @if ($message)
                    <div class="alert alert-warning">{{ $message }}</div>
                @else
                        @foreach ($friends as $friend)
                            <div class="friend-item d-flex align-items-center p-2 border-bottom" style="position: relative;">
                                <img src="{{ asset($friend->avatar) }}" alt="{{ $friend->name }}" class="friend-img rounded-circle me-3" style="width: 40px; height: 40px;">
                                <span class="friend-name">{{ $friend->name }}</span>
                                <a href="#" class="ms-auto toggle-menu" data-dropdown-id="dropdown-menu-{{ $friend->id }}" tabindex="0" style="color: #333;">
                                    <i class="fa-solid fa-ellipsis-v"></i>
                                </a>
                                
                                <div id="dropdown-menu-{{ $friend->id }}" class="dropdown-menu-custom" style="display: none; position: absolute; top: 100%; right: 0; background: #fff; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); z-index: 10;">
                                    <a href="#" class="dropdown-item" style="padding: 8px 15px; color: #333; text-decoration: none; display: block;">Xem thông tin</a>
                                    <a href="#" class="dropdown-item" style="padding: 8px 15px; color: #333; text-decoration: none; display: block;">Gửi tin nhắn</a>
                                    <form action="{{ route('unfriend') }}" method="POST" style="margin: 0;">
                                        @csrf
                                        <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                                        <button type="submit" class="dropdown-item" style="padding: 8px 15px; color: #333; text-decoration: none; background: none; border: none; cursor: pointer;">Xóa bạn</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-center mt-3">
                            {{ $friends->links('pagination::bootstrap-5') }}
                        </div>
                    @endif

                   
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.partials.footer')
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
                        <li><a class="dropdown-item" href="#" id="logoutOption">Đăng xuất</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#languageSettingsModal">Cài đặt ngôn ngữ</a></li>
                    </ul>
                </div>
            </div>
            <!-- Friend List -->
            <div class="col-md-3 chat-list p-3">
                <div class="search-bar mb-4 d-flex align-items-center">
                    <input type="text" class="form-control me-2" placeholder="Tìm kiếm">
                    <button class="btn" style="border: none; background: none;" data-bs-toggle="modal"
                        data-bs-target="#addFriendModal">
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
                <div class="listfr-header bg-white p-3 border-bottom">
                    <i class="fa-solid fa-user-group me-2"></i>
                    <h3 class="mb-0">Danh Sách Bạn bè</h3>
                </div>
                <div class="search-bar-main">
                    <input type="text" class="form-control" placeholder="Tìm kiếm bạn bè">
                    <button type="button" class="btn btn-primary"><i class="fa-solid fa-search"></i></button>
                </div>
                <div class="listfr-body bg-white p-3 border-bottom">
                    {{-- <p class="text-muted mb-0">Bạn bè ({{ count($friends) }})</p> --}}

                    @foreach ($friends as $friend)
                        <div class="friend-item d-flex align-items-center p-2">
                            <img src="{{ $friend->avatar }}" alt="{{ $friend->name }}" class="friend-img rounded-circle me-3" width="40" height="40">
                            <span class="friend-name">{{ $friend->name }}</span>
                            <a href="#" class="ml-auto toggle-menu" data-dropdown-id="dropdown-menu-{{ $friend->id }}" tabindex="0">
                                <i class="fa-solid fa-ellipsis-v"></i>
                            </a>
                        </div>
                        <div id="global-dropdown-menu" class="dropdown-menu-custom">
                            <a href="#" class="dropdown-item">Xem thông tin</a>
                            <a href="#" class="dropdown-item">Gửi tin nhắn</a>
                            <form action="{{ route('unfriend') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                                <button type="submit" class="dropdown-item btn btn-link p-0 m-0 align-baseline">Xóa bạn</button>
                            </form>
                        </div>
                </div>
                @endforeach
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            </div>
        </div>
    </div>
</div>

@include('layouts.partials.footer')
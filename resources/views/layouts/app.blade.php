@include('layouts.partials.header')

<div class="message_mini">
    @yield('content')
    <div class="container-fluid hehe">
        <div class="row h-100">
            <!-- Left Sidebar -->
            <section class="col-2 col-md-1 sidebar">
                @include('pages.modal.profile')
                <div class="d-flex justify-content-center align-items-center">
                    <div>
                        <div class="profile mb-4 mt-1 text-center">
                            <a href="#"><img src="{{ asset(Auth::user()->avatar) }}"
                                    alt="Profile Picture" class="rounded-circle" width="50" height="50"
                                    data-bs-toggle="modal" data-bs-target="#profileModal" style="cursor: pointer;"></a>
                        </div>
                        <ul class="nav flex-column align-items-center">
                            <li class="nav-item mb-3">
                                <a href="{{ route('home') }}" class="nav-link p-0">
                                    <i class="fa-solid fa-message text-white {{ Route::currentRouteNamed('home') ? 'active' : '' }}" style="font-size: 24px;"></i>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a href="{{ route('posts.index') }}" class="nav-link p-0">
                                    <i class="fa-solid fa-globe text-white {{ Route::currentRouteNamed('posts.*') ? 'active' : '' }}" style="font-size: 24px;"></i>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a href="{{ route('friends.list') }}" class="nav-link p-0">
                                    <i class="fa-solid fa-user text-white {{ Route::currentRouteNamed('friends.list') ? 'active' : '' }}" style="font-size: 24px;"></i>
                                </a>
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
                                        <li><a class="dropdown-item" href="{{ route('logout') }}" id="logoutOption">{{ __('messages.logout')}}</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#languageSettingsModal">{{ __('messages.settingLanguage')}}</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#themeSettingsModal">{{ __('messages.settingThemes')}}</a></li>
               
                                    </ul>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Chat List -->
            <section class="chat-list d-none d-md-block col-md-3 col-xs-3 bg-white px-0" style="border-right: 0.5px solid rgba(224, 226, 225, 0.874);">
                <div class="search-bar mb-4 d-flex align-items-center border-bottom px-3">
                    <input type="text" class="form-control me-2" placeholder="{{ __('messages.search')}}" id="searchMessages" oninput="searchMessages()">
                    <button class="btn" style="border: none; background: none; padding-left: 2px;" data-bs-toggle="modal" data-bs-target="#addFriendModal">
                        <i class="fa-solid fa-user-plus"></i>
                    </button>
                    <button type="button" style="border: none; background: none; padding-left: 2px;" data-bs-toggle="modal" data-bs-target="#createGroupModal">
                        <a href="#"><i class="fa-solid fa-people-group"></i></a>
                    </button>
                </div>
                
                <div id="searchResults" class="mt-2" style="display: none;">
                    <ul class="list-group" id="searchResultsList"></ul>
                </div>
                
                @yield('content-1')
            </section>
            <!-- Main Chat Window -->
            <section class="col-10 col-md-8 chat-window px-0">
                @yield('content-2')
            </section>
        </div>
    </div>

</div>




<!--modal thêm bạn-->
<div class="modal fade" id="addFriendModal" tabindex="-1" aria-labelledby="addFriendModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFriendModalLabel">{{ __('messages.addNewFriend')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 row">

                    <label for="friendEmail" class="form-label">{{ __('messages.enterEmail')}}:</label>
                    <div class=" col-10">
                        <input type="email" class="form-control" id="friendEmail" placeholder="{{ __('messages.enterEmail')}}" required
                            pattern="^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$"
                            title="Vui lòng nhập định dạng email hợp lệ." maxlength="100">
                    </div>

                    <div class="col-2">
                        <button type="button" class="btn btn-primary" id="searchButton" disabled><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>

                <!-- Kết quả tìm kiếm -->
                <div class="search-result mt-3" id="searchResult" style="display: none;">
                    <div class="user-info">
                        <div class="avatar" style="float: left; margin-right: 10px;">
                            <img src="{{ asset('assets/images/logo/uocmo.jpg') }}" alt="Avatar" class="rounded-circle"
                                id="resultUserAvatar" style="height: 50px; width:50px;">
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex">
                                <p class="mb-0 me-2"><strong id="resultUserName"></strong></p> |
                                <p class="mb-0 ms-2" id="resultUserGender" style="color: gray;"></p>
                                <!-- Thêm giới tính -->
                            </div>
                            <p class="mb-0" id="resultUserEmail" style="color: gray;"></p>

                        </div>
                    </div>
                    <div class="d-flex mt-3">
                        <button type="button" class="btn btn-success" id="sendRequestButton" style="display: none;">{{ __('messages.sendFriendRequest')}}</button>
                        <button type="button" class="btn btn-danger" id="cancelRequestButton" style="display: none;">{{ __('messages.revokeRequest')}}</button>
                        <button type="button" class="btn btn-info" id="messageButtonn" style="display: none;">{{ __('messages.sendaMessage')}}</button> <!-- Nút nhắn tin -->
                        <button type="button" class="btn btn-success" id="acceptRequestButton"
                            style="display: none; margin-right: 5px; ">{{ __('messages.accept')}}</button>
                        <button type="button" class="btn btn-danger" id="declineRequestButton" style="display: none;">{{ __('messages.refuse')}}</button>
                    </div>
                </div>


                <div id="errorMessage" class="mt-3 text-danger" style="display: none;"></div>
                <!-- Thêm phần thông báo lỗi -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close')}}</button>
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
                <h5 class="modal-title" id="friendRequestsModalLabel">{{ __('messages.friendRequestList')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="friendRequestsList">
                    <!-- Danh sách lời mời kết bạn sẽ được chèn ở đây -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close')}}</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal hiển thị danh sách bạn bè -->
<div class="modal fade" id="friendsListModal" tabindex="-1" aria-labelledby="friendsListModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="friendsListModalLabel">{{ __('messages.friendList')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="friendsList">
                    <!-- Danh sách bạn bè sẽ được chèn ở đây -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    style="height:96px; width:96px;">{{ __('messages.close') }}</button>
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
                <!-- Thay đổi văn bản "Cài đặt" bằng khóa 'settings' từ tệp ngôn ngữ -->
                <h5 class="modal-title" id="languageSettingsLabel">{{ __('messages.settings') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="settings-container">
                    <div class="row">
                        <div class="col-4">
                            <!-- Thay đổi văn bản "Cài đặt chung" bằng khóa 'general_settings' -->
                            <button type="button" class="btn btn-light" id="generalSettingsBtn">
                                <i class="fa-solid fa-gear"></i> {{ __('messages.general_settings') }}
                            </button>
                        </div>
                        <div class="col-8">
                            <!-- Thay đổi văn bản "Thay đổi ngôn ngữ" bằng khóa 'change_language' -->
                            <label for="languageSelect" class="form-label">{{ __('messages.change_language') }}</label>
                            <select class="form-select" id="languageSelect" aria-label="Language select">
                                <option value="en">{{ __('messages.en')}}</option>
                                <option value="vi">{{ __('messages.vi')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Thay đổi văn bản "Hủy" bằng khóa 'cancel' -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                <!-- Thay đổi văn bản "Đồng ý" bằng khóa 'confirm' -->
                <button type="button" class="btn btn-primary" id="saveSettingsBtn">{{ __('messages.confirm') }}</button>
            </div>
        </div>
    </div>
</div>
<!--modal cài đặt chủ đề -->
<div class="modal fade" id="themeSettingsModal" tabindex="-1" aria-labelledby="themeSettingsLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Thay đổi văn bản "Cài đặt" bằng khóa 'settings' từ tệp ngôn ngữ -->
                <h5 class="modal-title" id="themeSettingsLabel">{{ __('messages.settings') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="settings-container">
                    <div class="row">
                        <div class="col-4">
                            <!-- Thay đổi văn bản "Cài đặt chung" bằng khóa 'general_settings' -->
                            <button type="button" class="btn btn-light" id="generalSettingsBtn">
                                <i class="fa-solid fa-gear"></i> {{ __('messages.general_settings') }}
                            </button>
                        </div>
                        <div class="col-8">
                            <!-- Thay đổi văn bản "Thay đổi ngôn ngữ" bằng khóa 'change_language' -->
                            <label for="themeSelect" class="form-label">{{ __('messages.changeThemes') }}</label>
                            <select class="form-select" id="themeSelect" aria-label="Language select">
                                <option value="light">{{ __('messages.light')}}</option>
                                <option value="dark">{{ __('messages.dark')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Thay đổi văn bản "Hủy" bằng khóa 'cancel' -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                <!-- Thay đổi văn bản "Đồng ý" bằng khóa 'confirm' -->
                <button type="button" class="btn btn-primary" id="saveSettingsBtnTheme">{{ __('messages.confirm') }}</button>
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

<!-- Modal tạo nhóm -->
<div class="modal fade" id="createGroupModal" tabindex="-1" aria-labelledby="createGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createGroupModalLabel">{{ __('messages.createaNewGroup')}}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createGroupForm" method="POST" action="{{ route('groups.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group d-flex">
                        <div class="group-image-container">
                            <label for="groupImageInput">
                                <div class="group-image-circle">
                                    <i class="fa-solid fa-camera"></i>
                                </div>
                            </label>
                            <input type="file" id="groupImageInput" name="avatar" style="display:none;" onchange="previewImageGroup(event)">
                            <img id="groupImagePreview" src="" alt="Image Preview" style="display: none;">
                        </div>
                        <div class="group-name-container w-100" style="padding-left: 20px; top: 15px; position: relative;">
                            <label for="groupName"> {{ __('messages.nameGroup')}}</label>
                            <input type="text" class="form-control" id="groupName" name="name" placeholder="{{ __('messages.inputGroupName')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="groupMembers">{{ __('messages.nameMember')}}</label>
                        <input type="text" class="form-control" id="groupMembers" placeholder="{{ __('messages.enterName')}}" oninput="filterMembers()">
                    </div>
                    <!-- Danh sách thành viên -->
                    <div class="list-group" id="membersList">
                        <label>{{ __('messages.checkboxMember')}}</label>
                        <div id="friendsListContent">
                            <!-- Danh sách bạn bè sẽ được load vào đây -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close')}}</button>
                <button type="button" class="btn btn-primary" onclick="submitGroup()">{{ __('messages.createGR')}}</button>
            </div>
        </div>
    </div>
</div>



@include('layouts.partials.footer')
<script>
    function searchMessages() {
    let query = document.getElementById('searchMessages').value;

    if (query.trim() === '') {
        document.getElementById('searchResults').style.display = 'none';
        return;
    }

    fetch(`/search-messages?q=${encodeURIComponent(query)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Mã lỗi: ' + response.status); // Kiểm tra lỗi phản hồi từ máy chủ
            }
            return response.json();
        })
        .then(data => {
            let searchResultsList = document.getElementById('searchResultsList');
            searchResultsList.innerHTML = '';

            if (data.status === 'success' && data.results.length > 0) {
                data.results.forEach(item => {
                    let listItem = document.createElement('li');
                    listItem.classList.add('list-group-item');

                    listItem.innerHTML = `
                        <div class="d-flex align-items-center">
                            <img src="${item.avatar_url}" alt="Avatar" class="rounded-circle me-2" width="40" height="40">
                            <div>
                                <strong>${item.sender_name} - ${item.conversation_name}</strong>
                                <p class="mb-0">${item.message}</p>
                                <small class="text-muted">${item.created_at}</small>
                            </div>
                        </div>
                        <a data-conversation-id="${item.conversation_id}" class="dropdown-item open-conversation-search" style="padding: 8px 15px; color: #333; text-decoration: none; display: block;">
                            Xem tin nhắn
                        </a>
                    `;
                    searchResultsList.appendChild(listItem);
                });
                document.getElementById('searchResults').style.display = 'block';
            } else {
                searchResultsList.innerHTML = '<li class="list-group-item text-muted">Không tìm thấy tin nhắn phù hợp</li>';
                document.getElementById('searchResults').style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi tìm kiếm tin nhắn.');
        });
}



</script>

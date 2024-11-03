@extends('pages.friend.app')
@section('title', 'Message Mini Web')
@push('styles')
@endpush

@push('scripts')
<script>
    showSavedToast();
</script>

<script>
    
    //Hàm chỉnh cài đặt danh sách bạn bè 3 chấm
document.addEventListener('DOMContentLoaded', function () {
    const toggleMenus = document.querySelectorAll('.toggle-menu');

    toggleMenus.forEach(toggleMenu => {
        toggleMenu.addEventListener('click', function (event) {
            event.preventDefault();
            const dropdownId = this.getAttribute('data-dropdown-id');
            const dropdownMenu = document.getElementById(dropdownId);

            // Ẩn tất cả các menu dropdown khác
            document.querySelectorAll('.dropdown-menu-custom').forEach(menu => {
                if (menu !== dropdownMenu) {
                    menu.style.display = 'none';
                }
            });

            // Hiển thị hoặc ẩn menu dropdown hiện tại
            if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
                dropdownMenu.style.display = 'block';
            } else {
                dropdownMenu.style.display = 'none';
            }
        });
    });

    // Ẩn menu dropdown khi nhấp ra ngoài
    document.addEventListener('click', function (event) {
        if (!event.target.closest('.friend-item')) {
            document.querySelectorAll('.dropdown-menu-custom').forEach(menu => {
                menu.style.display = 'none';
            });
        }
    });
});


    // Hàm xử lý hỏi trước khi xóa bạn
    document.addEventListener('DOMContentLoaded', function () {
    const deleteFriendButtons = document.querySelectorAll('.delete-friend-button');
    const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    const confirmDeleteButton = document.getElementById('confirmDeleteButton');
    const friendIdToDelete = document.getElementById('friendIdToDelete');
    const deleteFriendForm = document.getElementById('deleteFriendForm');

    deleteFriendButtons.forEach(button => {
        button.addEventListener('click', function () {
            const friendId = this.closest('form').querySelector('input[name="friend_id"]').value;
            friendIdToDelete.value = friendId;
            confirmDeleteModal.show();
        });
    });

    confirmDeleteButton.addEventListener('click', function () {
        deleteFriendForm.submit();
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const messageAlert = document.getElementById('messageAlert');

    if (messageAlert) {
        const message = messageAlert.getAttribute('data-message');
        const status = messageAlert.getAttribute('data-status');
        showToast(message, status);
    }
});
</script>
@endpush

@section('content')
@include('components.toast')
@endsection

@section('content-2-1')
    <div>
        <div class="listfr-header bg-white p-3 border-bottom d-flex align-items-center">
            <i class="fa-solid fa-user-group me-2"></i>
            <h3 class="mb-0">{{ __('messages.friendList') }} ({{ $friends->total() }})</h3>
        </div>

        <div class="search-bar-main d-flex mx-3 my-4">
            <form action="{{ route('friends.search') }}" method="GET" class="d-flex w-100">
                <input type="text" name="query" class="form-control me-2" placeholder="{{ __('messages.searchFriend') }}"
                    value="{{ request('query') }}">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-search"></i></button>
            </form>
        </div>

        <div class="listfr-body bg-white p-3">
            @if ($message)
                <div class="alert alert-warning">{{ $message }}</div>
            @else
                @foreach ($friends as $friend)
                    <div class="friend-item d-flex align-items-center p-2 border-bottom" style="position: relative;">
                        <img src="{{ asset($friend->avatar) }}" alt="{{ $friend->name }}"
                            class="friend-img rounded-circle me-3" style="width: 40px; height: 40px;">
                        <div>
                            <span class="friend-name">{{ $friend->name }}</span>
                            <p style="margin: 0; color: #888;" class="d-flex">{{ __('messages.friendAlready') }}:
                                {{ \Carbon\Carbon::parse($friend->friendship_start)->diffForHumans() }}</p>
                        </div>
                        <a href="#" class="ms-auto toggle-menu" data-dropdown-id="dropdown-menu-{{ $friend->id }}"
                            tabindex="0" style="color: #333;">
                            <i class="fa-solid fa-ellipsis-v"></i>
                        </a>

                        <div id="dropdown-menu-{{ $friend->id }}" class="dropdown-menu-custom"
                            style="display: none; position: absolute; top: 100%; right: 0; background: #fff; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); z-index: 10;">
                            <a href="#" class="dropdown-item"
                                style="padding: 8px 15px; color: #333; text-decoration: none; display: block;">{{ __('messages.viewInformation') }}</a>
                            <a href="#" class="dropdown-item"
                                style="padding: 8px 15px; color: #333; text-decoration: none; display: block;">{{ __('messages.sendMessage') }}</a>
                            <form action="{{ route('unfriend') }}" method="POST" style="margin: 0;">
                                @csrf
                                <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                                <button type="submit" class="dropdown-item"
                                    style="padding: 8px 15px; color: #333; text-decoration: none; background: none; border: none; cursor: pointer;">{{ __('messages.deleteFriend') }}</button>
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

    <div class="search-bar-main d-flex mx-3 my-4">
        <form action="{{ route('friends.search') }}" method="GET" class="d-flex w-100">
            <input type="text" name="query" class="form-control me-2" placeholder="Tìm kiếm bạn bè"
                value="{{ request('query') }}">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-search"></i></button>
        </form>
    </div>

    <div class="listfr-body bg-white p-3">
        @if ($message)
        <div id="messageAlert" data-message="{{ $message }}" data-status="error">{{ $message }}</div>
        @else
        @foreach ($friends as $friend)
        <div class="friend-item d-flex align-items-center p-2 border-bottom" style="position: relative;">
            <img src="{{ asset($friend->avatar) }}" alt="{{ $friend->name }}" class="friend-img rounded-circle me-3"
                style="width: 40px; height: 40px;">
            <div>
                <span class="friend-name">{{ $friend->name }}</span>
                <p style="margin: 0; color: #888;" class="d-flex">Đã là bạn:
                    {{ \Carbon\Carbon::parse($friend->friendship_start)->diffForHumans() }}</p>
            </div>
            <a href="#" class="ms-auto toggle-menu" data-dropdown-id="dropdown-menu-{{ $friend->id }}" tabindex="0"
                style="color: #333;">
                <i class="fa-solid fa-ellipsis-v"></i>
            </a>

            <div id="dropdown-menu-{{ $friend->id }}" class="dropdown-menu-custom"
                style="display: none; position: absolute; top: 100%; right: 0; background: #fff; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); z-index: 10;">
                <a href="#" class="dropdown-item"
                    style="padding: 8px 15px; color: #333; text-decoration: none; display: block;">Xem
                    thông tin</a>
                <a href="#" class="dropdown-item"
                    style="padding: 8px 15px; color: #333; text-decoration: none; display: block;">Gửi
                    tin nhắn</a>
                <form action="{{ route('unfriend') }}" method="POST" style="margin: 0;" id="deleteFriendForm">
                    @csrf
                    <input type="hidden" name="friend_id" id="friendIdToDelete" value="{{ $friend->id }}">
                    <button type="button" class="dropdown-item delete-friend-button"
                        style="padding: 8px 15px; color: #333; text-decoration: none; background: none; border: none; cursor: pointer;">Xóa
                        bạn</button>
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
<!-- Modal xác nhận xóa bạn -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận xóa bạn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn hủy kết bạn với người này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Đồng ý</button>
            </div>
        </div>
    </div>
</div>

@endsection
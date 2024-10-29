@extends('pages.friend.app')
@section('title', 'Message Mini Web')
@push('styles')
@endpush

@push('scripts')
    <script>
        showSavedToast();
    </script>
@endpush

@section('content')
    @include('components.toast')
@endsection

@section('content-2-1')
    <div>
        <div class="listfr-header bg-white p-3 border-bottom d-flex align-items-center">
            <i class="fa-solid fa-user-group me-2"></i>
            <h3 class="mb-0">Danh Sách Bạn bè ({{ $friends->total() }})</h3>
        </div>

        <div class="search-bar-main d-flex p-3 bg-light">
            <form action="{{ route('friends.search') }}" method="GET" class="d-flex w-100">
                <input type="text" name="query" class="form-control me-2" placeholder="Tìm kiếm bạn bè"
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
                        <span class="friend-name">{{ $friend->name }}</span>
                        <a href="#" class="ms-auto toggle-menu" data-dropdown-id="dropdown-menu-{{ $friend->id }}"
                            tabindex="0" style="color: #333;">
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
                            <form action="{{ route('unfriend') }}" method="POST" style="margin: 0;">
                                @csrf
                                <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                                <button type="submit" class="dropdown-item"
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

@endsection

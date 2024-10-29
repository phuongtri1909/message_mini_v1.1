@extends('layouts.app')
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

@section('content-1')
    <div class="search-bar mb-4 d-flex align-items-center">
        <input type="text" class="form-control me-2" placeholder="Tìm kiếm">
        <button class="btn" style="border: none; background: none;" data-bs-toggle="modal" data-bs-target="#addFriendModal">
            <i class="fa-solid fa-user-plus me-2"></i>
        </button>
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#createGroupModal">
            <a href="{{ route('friends.list') }}"><i class="fa-solid fa-people-group"></i></a>
        </button>
    </div>
    <div class="listfr-item rounded">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-user-group me-2"></i>
            <div class="listfr-info">
                <a href="{{ route('friends.list') }}" class="mb-0">Danh Sách Bạn Bè</a>
            </div>
        </div>
    </div>
    <div class="listfr-item rounded" id="friendRequests">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-user-plus me-2" id="showFriendRequestsModal" style="cursor: pointer;"></i>
            <div class="listfr-info">
                <a href="{{ route('loimoi') }}" class="mb-0">Lời Mời Kết Bạn</a>
            </div>
        </div>
    </div>
@endsection

@section('content-2')
    
    @yield('content-2-1')
    
@endsection

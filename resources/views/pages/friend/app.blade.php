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
    <div class="listfr-item rounded">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-user-group me-2"></i>
            <div class="listfr-info">
                <a href="{{ route('friends.list') }}" class="mb-0">{{ __('messages.friendList') }}</a>
            </div>
        </div>
    </div>
    <div class="listfr-item rounded" id="friendRequests">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-user-plus me-2" id="showFriendRequestsModal" style="cursor: pointer;"></i>
            <div class="listfr-info">
                <a href="{{ route('friend.requests') }}" class="mb-0">{{ __('messages.friendInvitation') }}</a>
            </div>
        </div>
    </div>
@endsection

@section('content-2')
    
    @yield('content-2-1')
    
@endsection

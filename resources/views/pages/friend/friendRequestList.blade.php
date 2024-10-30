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
<div class="listfr-header bg-white p-3 border-bottom d-flex align-items-center">
    <i class="fa-solid fa-user-group me-2"></i>
    <h3 class="mb-0">Danh sách lời mời kết bạn</h3>
</div>
<div class="container">
    <h3>Lời Mời Kết Bạn({{ $friendRequests->total() }})</h3>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="list-group">
        @forelse ($friendRequests as $request)
            <div class="list-group-item d-flex align-items-center">
                <img src="{{ asset($request->sender->avatar) }}" alt="{{ $request->sender->name }}" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                <span class="friend-name">{{ $request->sender->name }}</span>
                <div class="ms-auto">
                    <form action="{{ route('friend.requests.accept.page') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="request_id" value="{{ $request->id }}">
                        <button type="submit" class="btn btn-success btn-sm">Chấp nhận</button>
                    </form>
                    <form action="{{ route('friend.requests.decline.page') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="request_id" value="{{ $request->id }}">
                        <button type="submit" class="btn btn-danger btn-sm">Từ chối</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="list-group-item">
                Không có lời mời kết bạn nào.
            </div>
        @endforelse
    </div>

    <!-- Hiển thị phân trang -->
    <div class="d-flex justify-content-center mt-3">
        {{ $friendRequests->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection

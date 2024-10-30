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
    <h3 class="mb-0">Trang lời mời</h3>
</div>

@endsection

@extends('layouts.app')
@section('title', 'Message Mini Web')
@section('description', 'Săn sale hoàn xu với % khủng cùng Hoàn Xu')
@section('keyword', 'sale, hoàn xu, giảm giá, khuyến mãi, lazada, shopee, tiktok')
@push('styles')
 
@endpush

@section('content')
    @include('components.toast')
    
@endsection

@push('scripts')
    <script>
       showSavedToast();
    </script>
@endpush

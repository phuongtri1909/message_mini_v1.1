@extends('layouts.main')

@push('styles')
@endpush

@section('content-main')
    @include('components.toast')
    <section class=" p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xxl-11">
                    <div class="border-light shadow-sm rounded">
                        <div class="g-0">
                            <div class="col-12 d-flex align-items-center justify-content-center rounded">
                                <div class="col-12 col-lg-11 col-xl-10">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-5">
                                                    <div class="text-center mb-4">
                                                        <a href="{{ route('home') }}">
                                                            <img class="logohoanxu"
                                                                src="{{ asset('assets/images/logo/logohoanxu.png') }}"
                                                                alt="logohoanxu">
                                                        </a>
                                                    </div>
                                                    <h4 class="text-center color-coins-refund">Chào mừng bạn đã trở lại</h4>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <a href="{{ url('auth/google') }}" class="btn btn-primary">
                                            <i class="fab fa-google"></i> Đăng nhập bằng Google
                                        </a>

                                        <form action="{{ route('login') }}" method="post">
                                            @csrf
                                            <div class="row gy-3 overflow-hidden">
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                                            id="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                                                        <label for="email" class="form-label">Nhập email của bạn</label>
                                                        @error('email')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3 position-relative">
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="" placeholder="Password" required>
                                                        <label for="password" class="form-label">Mật khẩu</label>
                                                        <i class="fa fa-eye position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer" id="togglePassword"></i>
                                                        @error('password')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <a href="{{ route('forgot-password') }}" class="link-secondary text-decoration-none color-coins-refund">Quên mật khẩu</a>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-lg border-coins-refund-2 color-coins-refund" type="submit">Đăng nhập</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-12">
                                                <div
                                                    class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-5">
                                                    <span>Bạn chưa có tài khoản? <a href="{{ route('register') }}" class="link-secondary text-decoration-none color-coins-refund">Đăng ký</a></span>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts-main')
<script>
    $(document).ready(function() {
        @if (session('success'))
            showToast('{{ session('success') }}', 'success');
        @elseif (session('error'))
            showToast('{{ session('error') }}', 'error');
        @endif
    });
</script>
@endpush
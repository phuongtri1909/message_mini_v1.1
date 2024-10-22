<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.ico') }}" type="image/x-icon">
    @stack('meta')

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->

    {{-- styles --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    @stack('styles')

    {{-- end styles --}}
</head>

<body>
    <header class="">
        <nav class="sticky-header navbar navbar-expand-lg bg-white py-3 shadow-sm ">
            <div class="custom-container d-flex justify-content-between align-items-center px-5">
                <a href="{{ route('home') }}">
                    <img class="logohoanxu" src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="logohoanxu">
                </a>

                @if (!auth()->check())
                    <a href="{{ route('login') }}" class="btn btn-dark btn-sm btn-rd-05rem">Đăng nhập</a>
                @else
                    <div class="d-flex align-items-center">
                        
                        <div class="dropdown me-2">
                            <i class="fa-regular fa-bell fa-xl " data-bs-toggle="dropdown" aria-expanded="false"></i>
                           
                            <ul class="dropdown-menu end-0" style="left:auto">
                              <li><a class="dropdown-item" href="#">Action</a></li>
                              <li><a class="dropdown-item" href="#">Another action</a></li>
                              <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
        
                        <i class="fa-solid fa-bars fa-xl" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                            aria-controls="offcanvasExample"></i>
                    </div>
                @endif
            </div>
        </nav>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <a href="{{ route('home') }}">
                    <img class="logohoanxu" src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="logohoanxu">
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="mb-2">
                    @if (auth()->check() && auth()->user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="fw-semibold fs-5 underline-none text-dark d-flex align-items-center"><div class="rounded-circle bg-info icon-menu d-flex align-items-center justify-content-center me-2"><i class="fa-solid fa-gauge"></i></div>Trang quản trị</a>
                    @else
                        <a href="{{ route('user-profile') }}" class="fw-semibold fs-5 underline-none text-dark d-flex align-items-center"><div class="rounded-circle bg-info icon-menu d-flex align-items-center justify-content-center me-2"><i class="fa-regular fa-user"></i></div>Tài khoản của tôi</a>
                    @endif
                </div>
                <div class="mb-2">
                    <div class="d-flex align-items-baseline">
                        
                        <a href="#" class="fw-semibold fs-5 underline-none text-dark d-flex align-items-center" data-bs-toggle="collapse"
                            data-bs-target="#submenu" aria-expanded="false" aria-controls="submenu"><div class="rounded-circle bg-info icon-menu d-flex align-items-center justify-content-center me-2"><i class="fa-solid fa-circle-dollar-to-slot"></i></div>Mua sắm hoàn
                            tiền
                            <i class="fa-solid fa-chevron-down fa-lg fw-bold ms-2" data-bs-toggle="collapse"
                            data-bs-target="#submenu" aria-expanded="false" aria-controls="submenu"></i>
                        </a>
                        
                    </div>
                    <div class="collapse " id="submenu">
                        <ul class="list-unstyled ms-5">
                            <li><a href="{{ route('shopee') }}" class="text-dark fs-5 underline-none">Shopee</a></li>
                            <li><a href="#" class="text-dark fs-5 underline-none">Tiktok</a></li>
                            <li><a href="#" class="text-dark fs-5 underline-none">Lazada</a></li>
                        </ul>
                    </div>
                </div>
                <div class=""> 
                    <a href="{{ route('logout') }}" class="fw-semibold fs-5 underline-none text-dark d-flex align-items-center"><div class="rounded-circle bg-info icon-menu d-flex align-items-center justify-content-center me-2"><i class="fa-solid fa-arrow-right-from-bracket"></i></div> Đăng xuất</a>
                </div>
            </div>
        </div>
    </header>

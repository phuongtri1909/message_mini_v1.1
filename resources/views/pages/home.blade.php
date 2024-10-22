@extends('layouts.app')
@section('title', 'Săn sale cùng Hoàn Xu')
@section('description', 'Săn sale hoàn xu với % khủng cùng Hoàn Xu')
@section('keyword', 'sale, hoàn xu, giảm giá, khuyến mãi, lazada, shopee, tiktok')
@push('styles')
    <style>
        .responsive-text {
            font-size: 20px;
        }

        .custom-card {
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .custom-card:hover {

            transform: scale(1.05);
        }

        #buy-coin-refund .card-shopee {
            background: linear-gradient(135deg, #fd6b64, #ff8243);
            color: white;
        }

        #buy-coin-refund .card-tiktok {
            background: linear-gradient(135deg, #ff3e64, #361f1f);
            color: white;
        }

        #buy-coin-refund .card-lazada {
            background: linear-gradient(135deg, #0dccff, #4760ff);
            color: white;
        }

        #buy-coin-refund .percentage {
            font-size: 24px;
            font-weight: bold;
        }

        #buy-coin-refund .arrow-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 24px;
            font-weight: bold;
            color: white;
        }

        /* blog */
        .blog-slide {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .blog-slide img {
            max-width: 100%;
            border-radius: 10px;
        }

        .blog-slide h3 {
            font-size: 18px;
            margin-top: 10px;
        }

        .blog-slide p {
            font-size: 14px;
            color: #777;
            margin-top: 10px;
        }

        .btn-xem-them {
            background-color: #ff5722;
            color: white;
        }

        .swiper {
            width: 100%;
            height: auto;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
        }

        /* end blog */

        /* login */
        .avatar {
            width: 100px;
            height: 100px;
            background: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @media (min-width: 576px) {
            .avatar {
                width: 120px;
                height: 120px;
            }
        }

        @media (min-width: 768px) {
            .avatar {
                width: 140px;
                height: 140px;
            }
        }

        @media (min-width: 992px) {
            .avatar {
                width: 160px;
                height: 160px;
            }
        }

        @media (min-width: 1200px) {
            .avatar {
                width: 180px;
                height: 180px;
            }
        }

        /* end login */
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
@endpush

@section('content')
    @include('components.toast')
    <section id="banner-infomation" class="bg-coins-refund rounded-bottom">
        <div class="container">

            @if (auth()->check())
                <div class="row py-3">
                    <div class="col-4 col-md-3">
                        <div class="rounded-circle border border-5 avatar border-secondary">
                            @if (auth()->check() && !empty(auth()->user()->avatar))
                                <img id="avatarImage" class="rounded-circle" src="{{ asset(auth()->user()->avatar) }}" alt="Avatar"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <i class="fa-solid fa-user"></i>
                            @endif
                        </div>
                    </div>

                    <div class="col-8 col-md-9">
                        <div>
                            <span class="text-white">Tổng số dư <i class="fa-solid fa-circle-question"></i></span>
                            <div class="text-white">
                                <span class="responsive-text-large">1000</span>
                                <span>VNĐ</span>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-4">
                                <a href="" class="btn btn-primary"><i class="fa-solid fa-hand-holding-dollar"></i>
                                    Hoàn tiền</a>
                            </div>
                            <div class="col-4">
                                <a href="" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i> Đơn
                                    hàng</a>
                            </div>
                            <div class="col-4">
                                <a href="" class="btn btn-primary"><i class="fa-solid fa-circle-question"></i> Trợ
                                    giúp</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-7 col-md-6 p-2 d-flex flex-column align-items-end justify-content-center text-center">
                        <div>
                            <div>
                                <span class="fw-bold text-white responsive-text">SĂN SALE CỰC ĐỈNH</span>
                                <p class="text-white fw-semibold responsive-text">HOÀN TIỀN CỰC ĐÃ</p>
                            </div>
                            <div>
                                <a class="px-4 py-2 text-white btn btn-secondary btn-rd-05rem" href="/login">ĐĂNG NHẬP</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 col-md-6 p-4">
                        <img class="img-fluid" src="{{ asset('assets/images/xu.png') }}" alt="xu" width="312"
                            height="312">
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section id="buy-coin-refund" class="mt-2">
        <div class="bg-white pb-2 box-shadow">

            @include('components.title_layout', [
                'title' => 'MUA SẮM HOÀN TIỀN',
                'svg' =>
                    '<svg height="25" viewBox="0 0 32 32" width="25" xmlns="http://www.w3.org/2000/svg" fill="white"><g id="Layer_2" data-name="Layer 2"><path d="m16 17.82a6 6 0 0 1 -5.89-4.82 1 1 0 0 1 1-1.15 1 1 0 0 1 1 .83 4 4 0 0 0 7.83 0 1 1 0 0 1 1-.83 1 1 0 0 1 1 1.15 6 6 0 0 1 -5.94 4.82z"></path><path d="m24.9 31h-17.8a3 3 0 0 1 -3-3.15l.81-17.24a3 3 0 0 1 3-2.87h16.18a3 3 0 0 1 3 2.87l.81 17.24a3 3 0 0 1 -3 3.15zm-16.99-21.25a1 1 0 0 0 -1 1l-.81 17.2a1 1 0 0 0 1 1.05h17.8a1 1 0 0 0 1-1.05l-.81-17.24a1 1 0 0 0 -1-1z"></path><path d="m22 8.75h-2v-1.75a4 4 0 0 0 -8 0v1.75h-2v-1.75a6 6 0 0 1 12 0z"></path></g></svg>',
                'span' => 'HOT',
            ])

            <div class="mt-3 container">
                <div class="text-center">
                    <div class="row g-2">
                        <div class="col-4">
                            <a href="{{ route('shopee') }}" class="underline-none">
                                <div class="custom-card card-shopee">
                                    <div class="p-3 pt-1 pb-0">
                                        <svg class="px-3 px-md-5" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                            viewBox="0 0 48 48">
                                            <path fill="#f4511e"
                                                d="M36.683,43H11.317c-2.136,0-3.896-1.679-3.996-3.813l-1.272-27.14C6.022,11.477,6.477,11,7.048,11 h33.904c0.571,0,1.026,0.477,0.999,1.047l-1.272,27.14C40.579,41.321,38.819,43,36.683,43z">
                                            </path>
                                            <path fill="#f4511e"
                                                d="M32.5,11.5h-2C30.5,7.364,27.584,4,24,4s-6.5,3.364-6.5,7.5h-2C15.5,6.262,19.313,2,24,2 S32.5,6.262,32.5,11.5z">
                                            </path>
                                            <path fill="#fafafa"
                                                d="M24.248,25.688c-2.741-1.002-4.405-1.743-4.405-3.577c0-1.851,1.776-3.195,4.224-3.195 c1.685,0,3.159,0.66,3.888,1.052c0.124,0.067,0.474,0.277,0.672,0.41l0.13,0.087l0.958-1.558l-0.157-0.103 c-0.772-0.521-2.854-1.733-5.49-1.733c-3.459,0-6.067,2.166-6.067,5.039c0,3.257,2.983,4.347,5.615,5.309 c3.07,1.122,4.934,1.975,4.934,4.349c0,1.828-2.067,3.314-4.609,3.314c-2.864,0-5.326-2.105-5.349-2.125l-0.128-0.118l-1.046,1.542 l0.106,0.087c0.712,0.577,3.276,2.458,6.416,2.458c3.619,0,6.454-2.266,6.454-5.158C30.393,27.933,27.128,26.741,24.248,25.688z">
                                            </path>
                                        </svg>
                                        <h5 class="responsive-text-medium">Shopee</h5>
                                    </div>
                                    <div class="ps-2 pb-1 line-height-16 pt-md-3 pt-ld-5 lh-lg-none">
                                        <p class="m-0 text-start responsive-text-small">Hoàn đến</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="m-0 responsive-text-medium">30.28%</p>
                                            <i class="fa-solid fa-chevron-right me-2"></i>
                                        </div>
                                    </div>
                                </div>

                            </a>
                        </div>
                        <div class="col-4">
                            <div class="custom-card card-tiktok">
                                <div class="p-3 pt-1 pb-0">
                                    <svg width="100%" height="100%" class="px-3 px-md-5"
                                        xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 30 30">
                                        <path
                                            d="M24,4H6C4.895,4,4,4.895,4,6v18c0,1.105,0.895,2,2,2h18c1.105,0,2-0.895,2-2V6C26,4.895,25.104,4,24,4z M22.689,13.474 c-0.13,0.012-0.261,0.02-0.393,0.02c-1.495,0-2.809-0.768-3.574-1.931c0,3.049,0,6.519,0,6.577c0,2.685-2.177,4.861-4.861,4.861 C11.177,23,9,20.823,9,18.139c0-2.685,2.177-4.861,4.861-4.861c0.102,0,0.201,0.009,0.3,0.015v2.396c-0.1-0.012-0.197-0.03-0.3-0.03 c-1.37,0-2.481,1.111-2.481,2.481s1.11,2.481,2.481,2.481c1.371,0,2.581-1.08,2.581-2.45c0-0.055,0.024-11.17,0.024-11.17h2.289 c0.215,2.047,1.868,3.663,3.934,3.811V13.474z">
                                        </path>
                                    </svg>
                                    <h5 class="responsive-text-medium">TikTok</h5>
                                </div>

                                <div class="ps-2 pb-1 line-height-16 pt-md-3 pt-ld-5 lh-lg-none">
                                    <p class="m-0 text-start responsive-text-small">Hoàn đến</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="m-0 responsive-text-medium">30.28%</p>
                                        <i class="fa-solid fa-chevron-right me-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="custom-card card-lazada">
                                <div class="p-3 pt-1 pb-0">
                                    <svg class="px-3 px-md-5"data-name="logosandtypes com"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 150 150"fill="white">
                                        <defs>
                                            <style>
                                                .cls-1 {
                                                    fill: none;
                                                }

                                                .cls-2 {
                                                    fill: url(#linear-gradient);
                                                }

                                                .cls-3 {
                                                    fill: #f624a0;
                                                }

                                                .cls-4 {
                                                    fill: #f58000;
                                                    isolation: isolate;
                                                    opacity: 0.41;
                                                }
                                            </style>
                                            <linearGradient id="linear-gradient" x1="-857.82" y1="596.4"
                                                x2="-853.73" y2="596.4"
                                                gradientTransform="matrix(34.01, 0, 0, -27.62, 29180.03, 16548.43)"
                                                gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#ff9200"></stop>
                                                <stop offset="0.29" stop-color="#f36d00"></stop>
                                                <stop offset="0.32" stop-color="#f4680b"></stop>
                                                <stop offset="0.57" stop-color="#f83c72"></stop>
                                                <stop offset="0.78" stop-color="#fc1cbe"></stop>
                                                <stop offset="0.93" stop-color="#fe08ed"></stop>
                                                <stop offset="1" stop-color="#f0f"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="Layer_3" data-name="Layer 3">
                                            <path class="cls-1" id="Layer_3-2" data-name="Layer 3" d="M0,.2H150v150H0Z"
                                                transform="translate(0 -0.2)"></path>
                                        </g>
                                        <path class="cls-2" id="Path"
                                            d="M75.73,133.75a5.61,5.61,0,0,1-2.81-.73c-7.35-4.25-61.75-38.36-63.8-39.4A5,5,0,0,1,6.3,89.68V41.84a5.19,5.19,0,0,1,2.34-4.45L9,37.17c5.27-3.27,22.88-14,25.67-15.56A4.15,4.15,0,0,1,36.81,21a4.36,4.36,0,0,1,2,.5S63.46,37.59,67.23,39a19.51,19.51,0,0,0,8.44,1.77,18.94,18.94,0,0,0,9.46-2.31c3.69-1.94,27.24-16.88,27.49-16.88a3.73,3.73,0,0,1,2-.54,4.19,4.19,0,0,1,2.11.59c3.21,1.78,25,15.14,26,15.73h0a5.11,5.11,0,0,1,2.45,4.39V89.62a4.89,4.89,0,0,1-2.82,3.94C140.26,94.69,86,128.8,78.54,133A5.57,5.57,0,0,1,75.73,133.75Z"
                                            transform="translate(0 -0.2)"></path>
                                        <path class="cls-3" id="Path-2" data-name="Path"
                                            d="M75.45,133.75h.28a5.61,5.61,0,0,0,2.81-.73c7.35-4.25,61.72-38.36,63.77-39.4a4.89,4.89,0,0,0,2.82-3.94V41.84a5.15,5.15,0,0,0-.54-2.34l-69.14,38Z"
                                            transform="translate(0 -0.2)"></path>
                                        <path class="cls-4" id="Path-3" data-name="Path"
                                            d="M6.22,89.6a5,5,0,0,0,3,3.94c2.05,1.12,56.45,35.23,63.79,39.39a5.59,5.59,0,0,0,2.48.74V77.38L6.53,40a5.64,5.64,0,0,0-.31,1.78Z"
                                            transform="translate(0 -0.2)"></path>
                                    </svg>
                                    <h5 class="responsive-text-medium">Lazada</h5>
                                </div>
                                <div class="ps-2 pb-1 line-height-16 pt-md-3 pt-ld-5 lh-lg-none">
                                    <p class="m-0 text-start responsive-text-small">Hoàn đến</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="m-0 responsive-text-medium">30.28%</p>
                                        <i class="fa-solid fa-chevron-right me-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="category-utilities" class="mt-2">
        <div class="bg-white pb-2 box-shadow">

            @include('components.title_layout', [
                'title' => 'DANH MỤC TIỆN ÍCH',
                'svg' =>
                    ' <svg  width="25" height="25" clip-rule="evenodd" fill-rule="evenodd" height="auto" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 32 32" width="auto" xmlns="http://www.w3.org/2000/svg" fill="white"><g transform="translate(-240 -336)"><path d="m255 356c0-.796-.316-1.559-.879-2.121-.562-.563-1.325-.879-2.121-.879-1.986 0-5.014 0-7 0-.796 0-1.559.316-2.121.879-.563.562-.879 1.325-.879 2.121v7c0 .796.316 1.559.879 2.121.562.563 1.325.879 2.121.879h7c.796 0 1.559-.316 2.121-.879.563-.562.879-1.325.879-2.121zm15 0c0-.796-.316-1.559-.879-2.121-.562-.563-1.325-.879-2.121-.879-1.986 0-5.014 0-7 0-.796 0-1.559.316-2.121.879-.563.562-.879 1.325-.879 2.121v7c0 .796.316 1.559.879 2.121.562.563 1.325.879 2.121.879h7c.796 0 1.559-.316 2.121-.879.563-.562.879-1.325.879-2.121zm-17 0v7c0 .265-.105.52-.293.707-.187.188-.442.293-.707.293h-7c-.265 0-.52-.105-.707-.293-.188-.187-.293-.442-.293-.707v-7c0-.265.105-.52.293-.707.187-.188.442-.293.707-.293h7c.265 0 .52.105.707.293.188.187.293.442.293.707zm15 0v7c0 .265-.105.52-.293.707-.187.188-.442.293-.707.293h-7c-.265 0-.52-.105-.707-.293-.188-.187-.293-.442-.293-.707v-7c0-.265.105-.52.293-.707.187-.188.442-.293.707-.293h7c.265 0 .52.105.707.293.188.187.293.442.293.707zm-2.379-5.207 4.172-4.172c1.171-1.171 1.171-3.071 0-4.242l-4.172-4.172c-1.171-1.171-3.071-1.171-4.242 0l-4.172 4.172c-1.171 1.171-1.171 3.071 0 4.242l4.172 4.172c1.171 1.171 3.071 1.171 4.242 0zm-10.621-9.793c0-.796-.316-1.559-.879-2.121-.562-.563-1.325-.879-2.121-.879-1.986 0-5.014 0-7 0-.796 0-1.559.316-2.121.879-.563.562-.879 1.325-.879 2.121v7c0 .796.316 1.559.879 2.121.562.563 1.325.879 2.121.879h7c.796 0 1.559-.316 2.121-.879.563-.562.879-1.325.879-2.121zm13.379 4.207-4.172 4.172c-.39.39-1.024.39-1.414 0 0 0-4.172-4.172-4.172-4.172-.39-.39-.39-1.024 0-1.414 0 0 4.172-4.172 4.172-4.172.39-.39 1.024-.39 1.414 0 0 0 4.172 4.172 4.172 4.172.39.39.39 1.024 0 1.414zm-15.379-4.207v7c0 .265-.105.52-.293.707-.187.188-.442.293-.707.293h-7c-.265 0-.52-.105-.707-.293-.188-.187-.293-.442-.293-.707v-7c0-.265.105-.52.293-.707.187-.188.442-.293.707-.293h7c.265 0 .52.105.707.293.188.187.293.442.293.707z"></path></g></svg>',
            ])
            <div class="container text-center mt-3 pb-4">
                <div class="row row-cols-4 g-3 g-lg-5">
                    <div class="col">
                        <div class="p-3 custom-card bg-coins-refund">
                            <img src="{{ asset('assets/images/svg/ranking.svg') }}" alt="">
                        </div>
                        <p class="fw-bold responsive-text-small mb-0">Top hoàn tiền trong tháng</p>
                    </div>
                    <div class="col">
                        <div class="p-3 custom-card bg-coins-refund">
                            <img src="{{ asset('assets/images/svg/ranking.svg') }}" alt="">
                        </div>
                        <p class="fw-bold responsive-text-small mb-0">Top hoàn tiền trong tháng</p>
                    </div>
                    <div class="col">
                        <div class="p-3 custom-card bg-coins-refund">
                            <img src="{{ asset('assets/images/svg/ranking.svg') }}" alt="">
                        </div>
                        <p class="fw-bold responsive-text-small mb-0">Top hoàn tiền trong tháng</p>
                    </div>
                    <div class="col">
                        <div class="p-3 custom-card bg-coins-refund">
                            <img src="{{ asset('assets/images/svg/ranking.svg') }}" alt="">
                        </div>
                        <p class="fw-bold responsive-text-small mb-0">Top hoàn tiền trong tháng</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="channel" class="mt-2">
        <div class="bg-white pb-2 box-shadow">
            @include('components.title_layout', [
                'title' => 'CÁC KÊNH SĂN MÃ',
                'svg' =>
                    '<svg height="25" viewBox="0 0 32 32" width="25" xmlns="http://www.w3.org/2000/svg" fill="white"><g id="Layer_2" data-name="Layer 2"><path d="m16 17.82a6 6 0 0 1 -5.89-4.82 1 1 0 0 1 1-1.15 1 1 0 0 1 1 .83 4 4 0 0 0 7.83 0 1 1 0 0 1 1-.83 1 1 0 0 1 1 1.15 6 6 0 0 1 -5.94 4.82z"></path><path d="m24.9 31h-17.8a3 3 0 0 1 -3-3.15l.81-17.24a3 3 0 0 1 3-2.87h16.18a3 3 0 0 1 3 2.87l.81 17.24a3 3 0 0 1 -3 3.15zm-16.99-21.25a1 1 0 0 0 -1 1l-.81 17.2a1 1 0 0 0 1 1.05h17.8a1 1 0 0 0 1-1.05l-.81-17.24a1 1 0 0 0 -1-1z"></path><path d="m22 8.75h-2v-1.75a4 4 0 0 0 -8 0v1.75h-2v-1.75a6 6 0 0 1 12 0z"></path></g></svg>',
            ])

            <div class="container text-center mt-3 pb-4">
                <div class="row row-cols-3 g-3">
                    @foreach ($socials as $social)
                        @if ($social->key !== 'facebook')
                            <div class="col">
                                <div class="custom-card bg-e2e8f0">
                                    <div class="p-3 p-md-2 d-flex flex-column align-items-center">
                                        <img src="{{ asset($social->icon) }}" alt="icon {{ $social->name }}">
                                        <h5 class="responsive-text-small mb-0">{{ $social->name }}</h5>
                                        <span class="badge responsive-text-xs text-bg-light fw-semibold white-space-no-wrap-none"> 
                                            {{ $social->sub }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
    </section>

    <section class="mt-2">

        @include('components.title_layout', [
            'title' => 'MẸO SĂN SALE',
            'svg' => '<i class="fa-regular fa-pen-to-square fa-lg"></i>',
            'span' => 'BLOG',
        ])

        <div class="swiper mySwiper mt-2">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href="" class="underline-none">
                        <div class="blog-slide">
                            <img src="{{ asset('assets/images/slide 3-01_1723999689.png') }}" alt="Blog Image 1" />
                            <h3 class="text-dark">TẤT TẦN TẬT VỀ MUA HÀNG HOÀN TIỀN</h3>
                            <p>Hướng dẫn người mới hiểu rõ về cơ chế mua hàng hoàn tiền</p>
                            <a href="#" class="btn-xem-them btn btn-sm">Xem thêm</a>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="" class="underline-none">
                        <div class="blog-slide">
                            <img src="{{ asset('assets/images/slide 4-01_1724000191.png') }}" alt="Blog Image 1" />
                            <h3 class="text-dark">TẤT TẦN TẬT VỀ MUA HÀNG HOÀN TIỀN</h3>
                            <p>Hướng dẫn người mới hiểu rõ về cơ chế mua hàng hoàn tiền</p>
                            <a href="#" class="btn-xem-them btn btn-sm">Xem thêm</a>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="" class="underline-none">
                        <div class="blog-slide">
                            <img src="{{ asset('assets/images/slide 3-01_1723999689.png') }}" alt="Blog Image 1" />
                            <h3 class="text-dark">TẤT TẦN TẬT VỀ MUA HÀNG HOÀN TIỀN</h3>
                            <p>Hướng dẫn người mới hiểu rõ về cơ chế mua hàng hoàn tiền</p>
                            <a href="#" class="btn-xem-them btn btn-sm">Xem thêm</a>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="" class="underline-none">
                        <div class="blog-slide">
                            <img src="{{ asset('assets/images/slide 4-01_1724000191.png') }}" alt="Blog Image 1" />
                            <h3 class="text-dark">TẤT TẦN TẬT VỀ MUA HÀNG HOÀN TIỀN</h3>
                            <p>Hướng dẫn người mới hiểu rõ về cơ chế mua hàng hoàn tiền</p>
                            <a href="#" class="btn-xem-them btn btn-sm">Xem thêm</a>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.mySwiper', {

            spaceBetween: 30,
            loop: true,

            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
            },
        });
    </script>

    <script>
       showSavedToast();
    </script>
@endpush

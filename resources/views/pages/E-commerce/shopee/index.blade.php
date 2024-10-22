@extends('layouts.app')
@section('title', 'Săn sale cùng Hoàn Xu')
@section('description', 'Săn sale hoàn xu với % khủng cùng Hoàn Xu')
@section('keyword', 'sale, hoàn xu, giảm giá, khuyến mãi, lazada, shopee, tiktok')
@push('styles')
    <style>
        .btn-shopee {
            background-color: white;
            color: #ee4d2d;
            border-color: #ee4d2d;
        }

        .btn-shopee:hover {
            background-color: #ee4d2d;
            color: white;
        }


        /* Slide */
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

        /* end slide */


        /*  */
        .sketchy {
            display: inline-block;
            border: 3px solid #333333;
            border-radius: 2% 6% 5% 4% / 1% 1% 2% 4%;
            background: #ffffff;
            position: relative;
        }

        .sketchy::before {
            content: '';
            border: 2px solid #353535;
            display: block;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate3d(-50%, -50%, 0) scale(1.015) rotate(0.5deg);
            border-radius: 1% 1% 2% 4% / 2% 6% 5% 4%;
        }

        /*  */


        .blog-comment::before,
        .blog-comment::after,
        .blog-comment-form::before,
        .blog-comment-form::after {
            content: "";
            display: table;
            clear: both;
        }

        .blog-comment ul {
            list-style-type: none;
            padding: 0;
        }

        .blog-comment img {
            opacity: 1;
            filter: Alpha(opacity=100);
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -o-border-radius: 4px;
            border-radius: 4px;
        }

        .blog-comment img.avatar {
            position: relative;
            float: left;
            margin-left: 0;
            margin-top: 0;
            width: 45px;
            height: 45px;
        }

        .blog-comment .post-comments {
            border: 1px solid #eee;
            margin-bottom: 20px;
            margin-left: 50px;
            margin-right: 0px;
            position: relative;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            -o-border-radius: 4px;
            border-radius: 4px;
            background: #fff;
            color: #6b6e80;
            position: relative;
        }

        .blog-comment .meta {
            font-size: 13px;
            color: #aaaaaa;
            padding-bottom: 8px;
            margin-bottom: 10px !important;
            border-bottom: 1px solid #eee;
        }

        .blog-comment ul.comments ul {
            list-style-type: none;
            padding: 0;
            margin-left: 50px;
        }

        .blog-comment-form {
            padding-left: 15%;
            padding-right: 15%;
            padding-top: 40px;
        }

        .blog-comment h3,
        .blog-comment-form h3 {
            margin-bottom: 40px;
            font-size: 26px;
            line-height: 30px;
            font-weight: 800;
        }

        .submit-comment{
            position: relative;
        }

        .btn-send-comment{
            position: absolute;
            right: 12px;
            bottom: 0;
        }

        .no-resize {
            resize: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
@endpush

@section('content')
    <section>
        <div class="pb-3 bg-white box-shadow">
            <div class="text-center pt-3 px-5">
                <svg width="210" height="75" fill="#ee4d2d" class="banner__logo-svg" enable-background="0 0 889 281"
                    viewBox="0 0 889 281">
                    <path
                        d="M162.9159,199.1383 C165.4579,178.3093 152.0399,165.0233 116.6229,153.7203 C99.4679,147.8673 91.3869,140.2033 91.5759,129.6373 C92.2919,117.9403 103.1909,109.4093 117.6449,109.1243 C127.6629,109.3243 138.7909,111.7713 149.6119,118.9903 C150.8979,119.8003 151.8029,119.6733 152.5339,118.5673 C153.5359,116.9553 156.0219,113.0863 156.8579,111.6993 C157.4239,110.7933 157.5339,109.6233 156.1009,108.5793 C154.0499,107.0573 148.2969,103.9763 145.2089,102.6843 C136.8169,99.1713 127.3989,96.9593 117.3559,96.9793 C96.1979,97.0683 79.5249,110.4533 78.1339,128.3153 C77.2239,141.2043 83.6049,151.6743 97.3059,159.6563 C100.2089,161.3483 115.9269,167.5993 122.1779,169.5453 C141.8439,175.6683 152.0549,186.6443 149.6519,199.4413 C147.4709,211.0523 135.2549,218.5503 118.4169,218.7783 C105.0659,218.2693 93.0519,212.8273 83.7359,205.5813 C83.4999,205.4053 82.3299,204.4983 82.1709,204.3763 C81.0189,203.4743 79.7619,203.5333 78.9969,204.7003 C78.4299,205.5583 74.8299,210.7583 73.9209,212.1233 C73.0669,213.3253 73.5239,213.9863 74.4109,214.7233 C78.3039,217.9683 83.4679,221.5173 86.9899,223.3133 C96.6659,228.2463 107.1689,230.9503 118.3429,231.3743 C125.5279,231.8613 134.5919,230.3173 141.3539,227.4473 C153.5019,222.2913 161.3469,211.9923 162.9159,199.1383 Z M119.2109,15.5363 C96.2859,15.5363 77.5989,37.1433 76.7239,64.1893 L161.6979,64.1893 C160.8229,37.1433 142.1359,15.5363 119.2109,15.5363 Z M206.2459,266.0383 L205.3689,266.0453 L30.3869,266.0193 L30.3829,266.0193 C18.4809,265.5743 9.7289,255.9273 8.5349,243.9503 L8.4179,241.7923 L0.5939,69.6693 L0.5949,69.6683 C0.5839,69.5383 0.5799,69.4073 0.5799,69.2743 C0.5799,66.4973 2.8059,64.2403 5.5709,64.1903 L5.5709,64.1893 L60.7269,64.1893 C62.0789,28.4773 87.7459,0.0013 119.2109,0.0013 C150.6759,0.0013 176.3429,28.4773 177.6949,64.1893 L232.6929,64.1893 L232.7709,64.1893 C235.5809,64.1893 237.8569,66.4653 237.8569,69.2743 C237.8569,69.3623 237.8549,69.4493 237.8509,69.5363 L237.8509,69.5393 L229.2779,242.3403 L229.1999,243.8033 C228.1639,255.9293 218.3549,265.7103 206.2459,266.0383 Z M332.3783,151.3829 C370.0613,162.6609 384.8853,176.7679 382.5153,199.4149 C381.0553,213.3669 372.7123,224.7019 359.6363,230.5089 C352.4283,233.7099 342.7733,235.5289 335.0703,235.1429 C323.2133,234.9009 312.0043,232.2319 301.6283,227.1789 C297.8793,225.3549 292.3553,221.7299 288.0573,218.2819 L288.0423,218.2679 C286.0333,216.5779 285.7943,215.4789 287.1683,213.4409 C287.5243,212.8879 288.1743,211.9019 289.6783,209.6339 C290.9693,207.6879 292.2573,205.7309 292.3203,205.6349 C293.9283,203.2079 295.6273,203.2079 297.9713,204.8189 C297.9873,204.8309 298.1993,204.9879 298.8023,205.4359 C299.2813,205.7909 299.5763,206.0099 299.6303,206.0489 C310.2993,214.0319 322.6203,218.5309 334.9013,218.7849 C351.7083,218.2659 363.5593,210.7209 365.4653,199.5239 C367.5613,187.2079 357.3853,176.6499 337.5093,170.8539 C330.5543,168.8259 315.3603,163.1299 311.1193,160.9009 C296.2103,152.5789 289.0223,141.2679 289.7703,127.1949 C290.9493,107.7119 308.8043,92.9199 331.6063,92.4269 C341.6273,92.2329 351.6563,94.1189 361.3183,97.9569 C364.8013,99.3409 370.9023,102.4969 373.1033,104.0659 C375.6603,105.8719 375.6603,107.1179 374.4143,109.4519 C374.2383,109.7559 373.5743,110.7169 371.8523,113.1789 L371.8463,113.1869 C370.0293,115.7849 369.4843,116.5699 369.3243,116.8359 C367.8293,118.7729 366.5753,119.3709 364.0163,117.8259 C353.9543,111.3789 343.7523,108.3369 332.2193,108.3079 C318.0053,108.8359 307.5653,117.2619 307.0643,128.4369 C307.0683,138.5059 315.0483,145.8189 332.3783,151.3829 Z M438.08,145.7359 C461.069,145.7359 480.053,164.2959 480.139,187.0379 L480.139,231.4649 C480.139,234.0289 479.481,234.6329 476.964,234.6329 L466.402,234.6329 C463.86,234.6329 463.227,234.0289 463.227,231.4649 L463.227,187.1699 C463.17,173.4559 451.93,162.3609 438.08,162.3609 C424.264,162.3609 413.039,173.4039 412.932,187.0729 L412.932,231.4649 C412.932,233.6719 412.064,234.6339 409.758,234.6339 L399.171,234.6339 C396.654,234.6339 395.997,233.7019 395.997,231.4649 L395.997,95.5449 C395.997,93.2119 396.654,92.3769 399.171,92.3769 L409.758,92.3769 C412.027,92.3769 412.932,93.2569 412.932,95.5449 L412.932,154.0389 C420.164,148.6909 428.936,145.7359 438.08,145.7359 Z M539.0868,218.6231 C555.0018,218.6231 567.8978,205.9861 567.8978,190.4041 C567.8978,174.8221 555.0008,162.1851 539.0868,162.1851 C523.1708,162.1851 510.2748,174.8221 510.2748,190.4041 C510.2748,205.9861 523.1708,218.6231 539.0868,218.6231 Z M539.0958,145.8281 C564.2228,145.8281 584.5958,165.7911 584.5958,190.4261 C584.5958,215.0601 564.2228,235.0241 539.0958,235.0241 C513.9688,235.0241 493.5938,215.0601 493.5938,190.4261 C493.5938,165.7911 513.9678,145.8281 539.0958,145.8281 Z M820.2079,180.0728 L870.6129,180.0728 C866.9879,169.7868 856.4429,162.0988 845.1869,162.0988 C833.5149,162.0988 823.5149,169.2838 820.2079,180.0728 Z M883.1149,196.4258 C883.0399,196.4258 882.9649,196.4238 882.9139,196.4218 L819.1719,196.4218 C820.7889,204.6078 826.4109,211.5788 834.1869,215.4788 C836.1999,216.4408 838.3939,217.2398 840.7349,217.8688 C852.1229,220.2518 865.1949,218.5158 875.1579,209.6658 C875.3009,209.5088 875.5709,209.3388 875.8629,209.0818 C877.5319,207.6088 878.7069,207.9818 880.0159,209.6158 C880.0159,209.6158 881.8869,212.2158 885.2289,217.5348 C886.6679,219.7778 886.5619,220.8558 884.1499,223.3418 C884.0509,223.4418 883.8619,223.6188 883.5839,223.8638 C883.1259,224.2658 882.5789,224.7128 881.9429,225.1938 C880.1309,226.5588 877.9629,227.9238 875.4379,229.1948 C866.1049,233.8958 854.6019,236.1088 840.9299,234.4628 C840.4759,234.3938 840.1139,234.3368 839.7629,234.2778 L839.7629,234.3018 L838.9849,234.1568 C828.9919,232.2948 820.0159,227.3148 813.4119,220.0458 C813.3759,220.0088 813.3739,220.0068 813.3649,219.9948 C807.4399,213.4648 803.6289,205.3378 802.4359,196.4218 L802.4259,196.4218 L802.3559,195.8418 C802.1429,194.0268 802.0339,192.1968 802.0339,190.3568 C802.0339,165.7308 821.3439,145.7588 845.1739,145.7588 C869.0059,145.7588 888.3139,165.7298 888.3139,190.3568 C888.3139,190.5468 888.3129,190.6338 888.3119,190.6858 C888.3199,190.8038 888.3239,190.9258 888.3239,191.0608 C888.3239,193.9288 886.1299,196.2948 883.3479,196.4208 C883.2669,196.4238 883.1909,196.4258 883.1149,196.4258 Z M643.3036,218.3922 C658.9296,218.3922 671.5976,205.7582 671.5976,190.1732 C671.5976,174.5892 658.9296,161.9542 643.3036,161.9542 C627.9436,161.9542 615.3986,174.1772 615.0176,189.4412 L615.0176,190.8962 C615.4026,206.1742 627.9466,218.3922 643.3036,218.3922 Z M643.3116,145.5972 C668.0056,145.5972 688.0256,165.5642 688.0256,190.1952 C688.0256,214.8272 668.0056,234.7952 643.3116,234.7952 C632.8436,234.7952 622.9336,231.1922 615.0176,224.7302 L615.0176,277.0922 C615.0176,279.4422 614.3606,280.2592 611.8426,280.2592 L601.7726,280.2592 C599.2546,280.2592 598.5976,279.4232 598.5976,277.0922 L598.5976,148.7642 C598.5976,146.3022 599.2546,145.5972 601.7726,145.5972 L611.8426,145.5972 C614.3606,145.5972 615.0176,146.3662 615.0176,148.7642 L615.0176,155.6602 C622.9336,149.1992 632.8436,145.5972 643.3116,145.5972 Z M720.33,180.0728 L770.735,180.0728 C767.111,169.7868 756.566,162.0988 745.309,162.0988 C733.638,162.0988 723.638,169.2838 720.33,180.0728 Z M788.436,190.3568 C788.436,190.5468 788.436,190.6338 788.434,190.6858 C788.443,190.8038 788.446,190.9258 788.446,191.0608 C788.446,193.9288 786.252,196.2948 783.471,196.4208 C783.39,196.4238 783.314,196.4258 783.237,196.4258 C783.162,196.4258 783.087,196.4238 783.036,196.4218 L719.294,196.4218 C720.911,204.6078 726.534,211.5788 734.309,215.4788 C736.323,216.4408 738.517,217.2398 740.858,217.8688 C752.246,220.2518 765.317,218.5158 775.28,209.6658 C775.423,209.5088 775.693,209.3388 775.985,209.0818 C777.654,207.6088 778.83,207.9818 780.139,209.6158 C780.139,209.6158 782.01,212.2158 785.351,217.5348 C786.79,219.7778 786.684,220.8558 784.273,223.3418 C784.174,223.4418 783.985,223.6188 783.707,223.8638 C783.249,224.2658 782.701,224.7128 782.065,225.1938 C780.254,226.5588 778.086,227.9238 775.56,229.1948 C766.228,233.8958 754.725,236.1088 741.053,234.4628 C740.599,234.3938 740.236,234.3368 739.886,234.2778 L739.886,234.3018 L739.108,234.1568 C729.115,232.2948 720.138,227.3148 713.534,220.0458 C713.499,220.0088 713.497,220.0068 713.487,219.9948 C707.563,213.4648 703.751,205.3378 702.559,196.4218 L702.548,196.4218 L702.479,195.8418 C702.265,194.0268 702.156,192.1968 702.156,190.3568 C702.156,165.7308 721.467,145.7588 745.297,145.7588 C769.128,145.7588 788.436,165.7298 788.436,190.3568 Z">
                    </path>
                </svg>
                <p class="m-0 fw-bold color-coins-refund">Hoàn tiền đến 30%</p>
            </div>
            <div class="input-group mt-3 px-3">
                <span class="input-group-text border-cl-shopee border-end-" id="inputGroup-sizing-lg"><i
                        class="fa-solid fa-link"></i></span>
                <input type="text" class="form-control medium-input border-cl-shopee border-start-0"
                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="Link sản phẩm">
                <button class="btn btn-shopee medium-input">Dán link</button>

            </div>
        </div>
    </section>

    <section class="mt-2">
        <div class="pb-3 bg-white box-shadow">
            <div class="text-center pt-3 px-5">
                <img class="img-fluid" src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="logohoanxu"
                    width="210" height="75">
                <p class="m-0">Nhập link Shopee để Hoàn xu tìm sản phẩm và hoàn tiền cho nhen!</p>
            </div>
        </div>
    </section>

    <section class="mt-2">
        <div class="py-3 bg-white box-shadow">
            <div class="d-flex bg-shopee mx-2 rounded-4 align-items-center justify-content-between px-3 py-1">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="35" height="35"
                        viewBox="0 0 48 48">
                        <linearGradient id="SVGID_1__h5AAf8mGeyde_gr1" x1="39.751" x2="8.249" y1="11.537"
                            y2="43.039" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-color="#fea460"></stop>
                            <stop offset=".033" stop-color="#feaa6a"></stop>
                            <stop offset=".197" stop-color="#fec497"></stop>
                            <stop offset=".362" stop-color="#ffd9bd"></stop>
                            <stop offset=".525" stop-color="#ffeada"></stop>
                            <stop offset=".687" stop-color="#fff5ee"></stop>
                            <stop offset=".846" stop-color="#fffdfb"></stop>
                            <stop offset="1" stop-color="#fff"></stop>
                        </linearGradient>
                        <path fill="url(#SVGID_1__h5AAf8mGeyde_gr1)"
                            d="M9.769,43.5c-1.322,0-2.418-0.998-2.496-2.274l-1.62-26.628c-0.035-0.574,0.438-1.059,1.033-1.059h34.627	c0.595,0,1.068,0.484,1.033,1.059l-1.621,26.628c-0.078,1.275-1.174,2.274-2.496,2.274H9.769z">
                        </path>
                        <path fill="none" stroke="#fe7c12" stroke-linecap="round" stroke-linejoin="round"
                            stroke-miterlimit="10" stroke-width="3"
                            d="M40.904,38.094l-0.18,3.053c-0.078,1.319-1.174,2.353-2.496,2.353H9.771c-1.322,0-2.418-1.033-2.496-2.353	l-0.911-15.49">
                        </path>
                        <path fill="none" stroke="#fe7c12" stroke-linecap="round" stroke-linejoin="round"
                            stroke-miterlimit="10" stroke-width="3"
                            d="M6.011,19.651l-0.358-6.093C5.619,12.984,6.076,12.5,6.652,12.5h34.697c0.575,0,1.032,0.484,0.998,1.059	l-1.072,18.227">
                        </path>
                        <path fill="none" stroke="#fe7c12" stroke-miterlimit="10" stroke-width="3"
                            d="M16,12.5c0-5.523,3.582-10,8-10s8,4.477,8,10"></path>
                        <path fill="#fe7c12"
                            d="M24.44,26.145c-2.941-1.075-4.327-1.752-4.327-3.309c0-1.666,1.666-2.875,3.962-2.875	c1.669,0,3.141,0.659,3.87,1.052c0.117,0.063,0.47,0.275,0.669,0.409l0.137,0.092c0.083,0.056,0.18,0.084,0.278,0.084	c0.036,0,0.071-0.004,0.107-0.011c0.133-0.029,0.248-0.111,0.319-0.227l1.012-1.646c0.142-0.23,0.074-0.532-0.152-0.68l-0.166-0.109	c-0.849-0.572-3.151-1.913-6.074-1.913c-3.939,0-6.91,2.503-6.91,5.823c0,3.79,3.471,5.058,6.259,6.078	c3.321,1.214,4.885,2.016,4.885,4.126c0,1.655-1.96,3.002-4.37,3.002c-2.826,0-5.298-2.102-5.323-2.123l-0.125-0.115	c-0.093-0.085-0.214-0.132-0.339-0.132c-0.019,0-0.038,0.001-0.058,0.003c-0.144,0.017-0.275,0.096-0.356,0.216l-1.105,1.629	c-0.145,0.214-0.103,0.504,0.098,0.668l0.112,0.092c0.786,0.637,3.615,2.71,7.095,2.71c4.104,0,7.319-2.613,7.319-5.95	C31.259,28.637,27.478,27.255,24.44,26.145z">
                        </path>
                    </svg>
                    <span class="fw-bold">TÌM ĐƠN VIDEO SHOPEE</span>
                </div>
                <button class="btn btn-dark btn-sm rounded-4">TÌM ĐƠN</button>
            </div>
        </div>
    </section>

    <section class="mt-2">
        <div class="bg-white box-shadow">
            @include('components.title_layout1', [
                'title' => 'MUA SẮM HOÀN TIỀN',
                'svg' => '<i class="fa-solid fa-shoe-prints"></i>',
                'sub_title' => '4 bước',
            ])

            <div class="swiper mySwiper mt-2">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="" class="underline-none">
                            <div class="blog-slide">
                                <img src="{{ asset('assets/images/slide 3-01_1723999689.png') }}" alt="Blog Image 1" />
                                <p class="text-start fw-bold m-0">Bước</p>
                                <p class="text-start m-0">Hướng dẫn người mới hiểu rõ về cơ chế mua hàng hoàn tiền</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="" class="underline-none">
                            <div class="blog-slide">
                                <img src="{{ asset('assets/images/slide 4-01_1724000191.png') }}" alt="Blog Image 1" />
                                <p class="text-start fw-bold m-0">Bước</p>
                                <p class="text-start m-0">Hướng dẫn người mới hiểu rõ về cơ chế mua hàng hoàn tiền</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="" class="underline-none">
                            <div class="blog-slide">
                                <img src="{{ asset('assets/images/slide 3-01_1723999689.png') }}" alt="Blog Image 1" />
                                <p class="text-start fw-bold m-0">Bước</p>
                                <p class="text-start m-0">Hướng dẫn người mới hiểu rõ về cơ chế mua hàng hoàn tiền</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="" class="underline-none">
                            <div class="blog-slide">
                                <img src="{{ asset('assets/images/slide 4-01_1724000191.png') }}" alt="Blog Image 1" />
                                <p class="text-start fw-bold m-0">Bước</p>
                                <p class="text-start m-0">Hướng dẫn người mới hiểu rõ về cơ chế mua hàng hoàn tiền</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-2">
        <div class="bg-white box-shadow">
            @include('components.title_layout1', [
                'title' => 'ĐIỀU KHOẢN HOÀN TIỀN',
                'svg' => '<i class="fa-solid fa-rotate-right"></i>',
                'sub_title' => 'Tham khảo',
            ])

            <div class="mx-4 mt-2 mb-5">
                <h6 class="color-coins-refund">Thời gian hoàn tiền</h6>

                <div class="sketchy">
                    <div class="d-flex py-md-3 border-bottom border-dark border-1">
                        <i class="fa-regular fa-clock px-3 px-md-4 d-flex align-items-center"></i>
                        <p class="mb-0 responsive-text-small none-lg">Thời gian cập nhật đơn hàng là 24 - 48H kể từ khi đặt
                            hàng thành công. Nếu sau 48H không thấy
                            hiển thị đơn tức là đơn không được ghi nhận trên app.</p>
                    </div>

                    <div class="d-flex py-md-3 border-bottom border-dark border-1">
                        <i class="fa-regular fa-clock px-3 px-md-4 d-flex align-items-center"></i>
                        <p class="mb-0 responsive-text-small none-lg">Thời gian cập nhật đơn hàng là 24 - 48H kể từ khi đặt
                            hàng thành công. Nếu sau 48H không thấy
                            hiển thị đơn tức là đơn không được ghi nhận trên app.</p>
                    </div>

                    <div class="d-flex py-md-3">
                        <i class="fa-regular fa-clock px-3 px-md-4 d-flex align-items-center"></i>
                        <p class="mb-0 responsive-text-small none-lg">Thời gian cập nhật đơn hàng là 24 - 48H kể từ khi đặt
                            hàng thành công. Nếu sau 48H không thấy
                            hiển thị đơn tức là đơn không được ghi nhận trên app.</p>
                    </div>
                </div>

            </div>

            <div class="mx-4 mt-2 mb-5">
                <h6 class="color-coins-refund">Thời gian hoàn tiền</h6>

                <div class="sketchy">
                    <div class="d-flex py-md-3 border-bottom border-dark border-1">
                        <i class="fa-regular fa-clock px-3 px-md-4 d-flex align-items-center"></i>
                        <p class="mb-0 responsive-text-small none-lg">Thời gian cập nhật đơn hàng là 24 - 48H kể từ khi đặt
                            hàng thành công. Nếu sau 48H không thấy
                            hiển thị đơn tức là đơn không được ghi nhận trên app.</p>
                    </div>

                    <div class="d-flex py-md-3 border-bottom border-dark border-1">
                        <i class="fa-regular fa-clock px-3 px-md-4 d-flex align-items-center"></i>
                        <p class="mb-0 responsive-text-small none-lg">Thời gian cập nhật đơn hàng là 24 - 48H kể từ khi đặt
                            hàng thành công. Nếu sau 48H không thấy
                            hiển thị đơn tức là đơn không được ghi nhận trên app.</p>
                    </div>

                    <div class="d-flex py-md-3">
                        <i class="fa-regular fa-clock px-3 px-md-4 d-flex align-items-center"></i>
                        <p class="mb-0 responsive-text-small none-lg">Thời gian cập nhật đơn hàng là 24 - 48H kể từ khi đặt
                            hàng thành công. Nếu sau 48H không thấy
                            hiển thị đơn tức là đơn không được ghi nhận trên app.</p>
                    </div>
                </div>

            </div>

            <div class="mx-4 mt-2 pb-3">
                <h6 class="color-coins-refund">Thời gian hoàn tiền</h6>

                <div class="sketchy">
                    <div class="d-flex py-md-3 border-bottom border-dark border-1">
                        <i class="fa-regular fa-clock px-3 px-md-4 d-flex align-items-center"></i>
                        <p class="mb-0 responsive-text-small none-lg">Thời gian cập nhật đơn hàng là 24 - 48H kể từ khi đặt
                            hàng thành công. Nếu sau 48H không thấy
                            hiển thị đơn tức là đơn không được ghi nhận trên app.</p>
                    </div>

                    <div class="d-flex py-md-3 border-bottom border-dark border-1">
                        <i class="fa-regular fa-clock px-3 px-md-4 d-flex align-items-center"></i>
                        <p class="mb-0 responsive-text-small none-lg">Thời gian cập nhật đơn hàng là 24 - 48H kể từ khi đặt
                            hàng thành công. Nếu sau 48H không thấy
                            hiển thị đơn tức là đơn không được ghi nhận trên app.</p>
                    </div>

                    <div class="d-flex py-md-3">
                        <i class="fa-regular fa-clock px-3 px-md-4 d-flex align-items-center"></i>
                        <p class="mb-0 responsive-text-small none-lg">Thời gian cập nhật đơn hàng là 24 - 48H kể từ khi đặt
                            hàng thành công. Nếu sau 48H không thấy
                            hiển thị đơn tức là đơn không được ghi nhận trên app.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="mt-2">
        <div class="bg-white box-shadow">
            @include('components.title_layout1', [
                'title' => 'HỎI ĐÁP',
                'svg' => '<i class="fa-regular fa-comments"></i>',
            ])


            <div class="container bootstrap snippets bootdey mt-2 px-3">
                <div class="row">
                    <div class="form-floating submit-comment">
                        <textarea class="form-control no-resize" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" maxlength="700"></textarea>
                        <label for="floatingTextarea2" class="px-5">Comments</label>
                        <button class="btn btn-sm btn-outline-info btn-send-comment"><i class="fa-regular fa-paper-plane"></i></button>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="blog-comment">
                            <ul class="comments mb-0">
                                <li class="clearfix">
                                    <img src="https://bootdey.com/img/Content/user_1.jpg" class="avatar" alt="">
                                    <div class="post-comments p-3">
                                        <p class="meta">Dec 18, 2014 <a href="#">JohnDoe</a> says : <i
                                                class="pull-right"><a href="#"><small>Reply</small></a></i></p>
                                        <p class="mb-0">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Etiam a sapien odio, sit amet
                                        </p>
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <img src="https://bootdey.com/img/Content/user_2.jpg" class="avatar" alt="">
                                    <div class="post-comments p-3">
                                        <p class="meta">Dec 19, 2014 <a href="#">JohnDoe</a> says : <i
                                                class="pull-right"><a href="#"><small>Reply</small></a></i></p>
                                        <p class="mb-0">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Etiam a sapien odio, sit amet
                                        </p>
                                    </div>

                                    <ul class="comments">
                                        <li class="clearfix">
                                            <img src="https://bootdey.com/img/Content/user_3.jpg" class="avatar"
                                                alt="">
                                            <div class="post-comments p-3">
                                                <p class="meta">Dec 20, 2014 <a href="#">JohnDoe</a> says : <i
                                                        class="pull-right"><a href="#"><small>Reply</small></a></i>
                                                </p>
                                                <p class="mb-0">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                    Etiam a sapien odio, sit amet
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="#" class="text-dark underline-none mb-3">Xem thêm bình luận...</a>
                </div>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.mySwiper', {
            spaceBetween: 5,
            loop: true,

            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,

                },
            },
        });
    </script>
@endpush

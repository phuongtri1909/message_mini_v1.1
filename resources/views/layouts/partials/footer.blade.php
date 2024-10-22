<footer class=" mt-5 {{ Route::currentRouteNamed('shopee') ? '' : 'custom-container' }} ">
    <div class="container-fluid">

        <div class="container-fluid pb-3 bg-white  box-shadow-top rounded-top">
            <div class="col-12 px-1 px-md-5">
                <div class="d-flex justify-content-around bg-coins-refund rounded-bottom py-1">
                    @foreach ($socials as $social)
                        <a href="{{ $social->url }}" class="text-white fw-bold underline-none hover d-flex align-items-center responsive-text-xs"><span class="rounded-circle bg-white text-dark icon-footer me-1 me-md-2"><img src="{{ asset($social->icon) }}" alt="icon" width="20" height="20"></span>{{ $social->sub }}</a>
                        
                    @endforeach
                </div>
            </div>
            <div class="col-12 text-center mt-4 px-5">
                <img class="img-fluid" src="{{ asset('assets/images/logo/logohoanxu.png') }}" alt="logohoanxu" width="210" height="75">
                <p class="m-0 fw-bold color-coins-refund">Mua sắm tiện lợi, hoàn xu như ý</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
@stack('scripts')
</body>
</html>

@include('clientui.components.client-navbar')
@include('clientui.components.client-footer')

@yield('navbar')
<style>
    #add-cart:hover {
        color: white !important;
    }
</style>
<main class="main">
    <div class="container mb-30">
        <div class="row flex-row-reverse">
            <div class="">
                    <section id="slider-banner" class="home-slider position-relative mb-30">
                        <div class="home-slide-cover mt-30">
                            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                                <div class="single-hero-slider single-animation-wrap"
                                    style="background-image: url(client/assets/imgs/slider/slider-1.png)">
                                    <div class="slider-content">
                                        <h1 class="display-2 mb-40">
                                            Discover the perfect<br />
                                            spectacles for your style
                                        </h1>
                                        <p class="mb-65">Shop Exclusive deals now ...</p>

                                    </div>
                                </div>
                                <div class="single-hero-slider single-animation-wrap"
                                style="background-image: url(client/assets/imgs/slider/slider-2.png)">
                                <div class="slider-content">
                                    <h1 class="display-2 mb-40">
                                        Fashion spectacles<br />
                                        for every occasion
                                    </h1>
                                    <p class="mb-65">Shop Exclusive deals now ...</p>

                                </div>
                            </div>
                            <div class="single-hero-slider single-animation-wrap"
                            style="background-image: url(client/assets/imgs/slider/slider-3.png)">
                            <div class="slider-content">
                                <h1 class="display-2 mb-40">
                                    Choose from a wide<br />
                                    range of sunglasses
                                </h1>
                                <p class="mb-65">Shop Exclusive deals now ...</p>

                            </div>
                        </div>
                            </div>

                        </div>
                    </section>

                <!--End hero-->
                <section class="product-tabs section-padding position-relative">
                    <div class="section-title style-2">
                        <h3 id="search-title">
                           Shop for Products
                        </h3>

                    </div>
                    <!--End nav-tabs-->
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div id="all-products" class="row product-grid-4">

                            @if (isset($products))
                                <!--start product card-->
                                @if (count($products) == 0)
                                    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                                        <div class="product-cart-wrap mb-30">
                                            <div class="product-content-wrap">
                                                <h2><a href="">No Products in store</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @foreach ($products as $product)
                                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 " >
                                            <div class="product-cart-wrap mb-30">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="{{route('product-details',['id'=>$product->id])}}">
                                                            <img class="default-img" src="data:image/png;base64,{{$product->url}}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1">

                                                    </div>
                                                    <div
                                                        class="product-badges product-badges-position product-badges-mrg">
                                                        <span class="sale">Sale</span>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">

                                                    <h2><a
                                                            href="#">{{ $product->title }}</a>
                                                    </h2>
                                                    <div class="product-rate-cover">

                                                    </div>
                                                    <div>
                                                        <span class="font-small text-muted">By <a
                                                                href="#">Admin</a></span>
                                                    </div>
                                                    <div class="product-card-bottom">
                                                        <div class="product-price">
                                                            <span>Kshs {{$product->price}}</span>

                                                        </div>
                                                        <div class="add-cart">
                                                            {{-- <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a> --}}
                                                            <button onclick="addtocart({{$product->id}})" id="add-cart" style="color: #3BB77E; border:none;"  class="add"><i class="fi-rs-shopping-cart mr-5"></i>Add </button>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @else

                            @endif
                            <!--end product card-->

                        </div>
                        <!--End product-grid-4-->
                    </div>

                </section>
                <!--Products Tabs-->

            </div>

        </div>
    </div>

</main>
<input type="hidden" id="loginId" @if (Auth::check())
    value="true" @endif>

@yield('footer')

<script>
    // jquery document on ready
    function updateCart(){
    $.ajax({
            type: "GET",
            url: "{{route('cartcount')}}",
            success: function (response) {

                $('.pro-count').each(function(){
                    $(this).html(response.count);
                });
            }
        });
    }
    function addtocart(id) {
        // get value input id loginId
        var loginId = document.getElementById('loginId').value;
        // if not null redirect to login page
        if (loginId !== 'true') {
            window.location.href = "{{ route('login') }}";
        }


        $.ajax({
            url: "{{ route('addtocart') }}",
            type: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                updateCart()

                if (response.redirect) {
                    window.location.href = response.redirect;
                } else if (response.error) {

                    toastr["error"](response.error);

                } else {
                    toastr["success"](response.success);
                }
            },

            error: function(response) {
                console.log(response.error);

            },
        });
    }


</script>

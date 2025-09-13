@extends('layouts.layout2')
@section('title')
    @lang('site.app_name')
@endsection
@section('style')

@endsection

@section('content')
    @if(count($sliders))
        <div class="slider-wrapper">
            <div class="slider slider-main">
                @foreach($sliders as $slider)
                    <div>
                        {{--<a href="#--}}{{--{{$slider -> in_app==0?$slider ->link :($slider ->type == 'product'?route("product",$slider->link):route("vendor",$slider->link))}}--}}{{--"
                          >
                            <img src="{{ asset('assets/images/sliders/' . $slider->img) }}"
                                 onerror="this.src='{{asset('new_design/images/not-found.jpg')}}'" alt="Slide 1">
                        </a>--}}

                        <a href="{{
                        $slider->slider_reference
                            ? (
                                $slider->slider_for === 'out_link'
                                    ? $slider->slider_reference
                                    : (
                                        $slider->slider_for === 'product_id'
                                            ? route('product', $slider->slider_reference)
                                            : (
                                                $slider->slider_for === 'brand_id'
                                                    ? route('brand', $slider->slider_reference)
                                                    : (
                                                        $slider->slider_for === 'category_id'
                                                            ? route('vendor', $slider->slider_reference)
                                                            : '#'
                                                    )
                                            )
                                    )
                            )
                            : '#'
                    }}">
                            <img src="{{ asset('assets/images/sliders/' . $slider->img) }}"
                                 onerror="this.src='{{ asset('new_design/images/not-found.jpg') }}'"
                                 alt="{{ $slider->title ?? 'Slider Image' }}">
                        </a>
                    </div>
               @endforeach
            </div>
        </div>
    @endif

    @if(count($ads_1) > 0)
    <!-- _____  _____ -->
    <section class="py-3">
        <div class="container">
            <div class="row">
                @foreach($ads_1 as $one)
                <div class="col-md-4 col-6 mb-3">
                    <div  @if($one->in_app==1)onclick="window.location.href='{{route("product",$one->link)}}'"
                          @else onclick="window.location.href='{{$one->link}}'" @endif
                        class="product-inner text-center position-relative overflow-hidden ad_div pointer"
                    >
{{--                        <a href="{{$one -> in_app==0?$one ->link :($one ->type == 'product'?route("product",$one->link):route("vendor",$one->link))}}">--}}
                            <img src="{{ asset('assets/images/ads/'.$one->img) }}" class="img-fluid" alt=""/>

{{--                        </a>--}}
                    </div>
                </div>
                    @endforeach
            </div>
        </div>
    </section>
    <!-- ./ -->
    @endif

    <!-- _____  _____ -->
    @if(count($trends) > 0)
        <section class="mb-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 py-3">
                        <div
                            class="sec-title d-flex justify-content-between align-items-center"
                        >
                            <h2>@lang('site.famous')</h2>
                            <a href="{{ route('brands', ['type' => 2]) }}" class="btn btn-gray">@lang('site.show_all')</a>
                        </div>
                    </div>
                </div>
                @if(count($trends)>4)
                <div class="text-center  owl-carousel owl-theme owl-trends">
                    @foreach($trends as $key=>$one)
                        <div class="ad_div  ">
                            <a  class="trend_img_link" href="{{ route('brand', $one->id) }}"
                            ><img
                                    src="{{ asset('assets/images/student/' . $one->img) }}"
                                    onerror="this.src='{{asset('new_design/images/not-found.png')}}'"
                                    alt="l1"
                                    class="img-fluid"
                                />
                            </a>
                            <div class="trend_name">
                                <a href="{{ route('brand', $one->id) }}">
                                    {{$one->name}}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                <div class="row">
                    @foreach($trends as $one)
                        <div class="col-md-3 col-6 mb-3">
                            <div
                                class="product-inner text-center position-relative overflow-hidden ad_div"
                            >
                                <a  class="trend_img_link" href="{{ route('brand', $one->id) }}"
                                ><img
                                        src="{{ asset('assets/images/student/' . $one->img) }}"
                                        onerror="this.src='{{asset('new_design/images/not-found.png')}}'"
                                        alt="l1"
                                        class="img-fluid"
                                    />
                                </a>
                                <div class="trend_name">
                                    <a href="{{ route('brand', $one->id) }}">
                                        {{$one->name}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </section>
    @endif
    <!-- ./ -->

    <!-- _____  _____ -->
    @if(count($Brands) > 0)
         <section class="mb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 py-3">
                    <div
                        class="sec-title d-flex justify-content-between align-items-center"
                    >
                        <h2>@lang('site.brands')</h2>
                        <a href="{{ route('brands', ['type' => 3]) }}" class="btn btn-gray">@lang('site.show_all')</a>
                    </div>
                </div>
            </div>
            <div class="text-center brands owl-carousel owl-theme owl-brands">
                @foreach($Brands as $key=>$one)
                    <div class="brand_div  ">
                    <a href="{{ route('brand', $one->id) }}"
                    ><img
                            src="{{ asset('assets/images/student/' . $one->img) }}"
                            onerror="this.src='{{asset('new_design/images/not-found.png')}}'"
                            alt="l1"
                            class="img-fluid"
                        /></a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- ./ -->



    <!-- _____  _____ -->
    @if(count($offers) > 0)
    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-12 py-3">
                    <div
                        class="sec-title d-flex justify-content-between align-items-center"
                    >
                        <h2>@lang('site.trendat_picks')</h2>
                        <a href="{{ route('productByType', 'trendat_picks') }}" class="btn btn-gray">@lang('site.show_all')</a>

                    </div>
                </div>
            </div>
            <div class="text-center brands owl-carousel owl-theme owl-new-products">
                @foreach($offers as $key=>$one)
                    <div class=" mx-3">
                        <div class="brand-card new_product">
                            <div class="overflow-hidden image-wrapper position-relative">




                                <a href="{{route("product",$one->id)}}">
                                    <img src="{{asset('assets/images/products/min/'.$one->img)}}"
                                         onerror="this.src='{{asset('new_design/images/not-found.png')}}'"

                                         class="img-fluid " alt=""></a>

                               @if($one->checkQuantity()==0)
                                    <div class="soldout-overlay">@lang('site.sold_out')</div>
                                @endif

                            </div>
                            <div class="py-3">
                                <a class="product_title text-start" href="{{route("product",$one->id)}}">{{$one->name}}</a>
                                @if($one->final_sale_price!=0&&$one->final_sale_price < $one->final_regular_price)
                                    <?php
                                    $sale=$one->final_sale_price;
                                    $regular=$one->final_regular_price;
                                    $discount=100 - round(($sale/$regular)*100,0);
                                    ?>
                                    <div class="mt-1 product_price">
                                        <div
                                            class="d-flex justify-content-between  sale_price"
                                        >
                                            <p class="discount">{{get_price_helper($one->final_regular_price,true)}}</p>
                                            <span >{{$discount}}%</span>
                                        </div>
                                        <p >{{ get_price_helper($one->final_sale_price,true) }}</p>
                                    </div>
                                @else


                                    <p class="mt-1 product_price price ">{{get_price_helper($one->final_regular_price,true)}}</p>
                                @endif
                                <div class="d-flex align-items-center justify-content-between mt-4 product_actions">
                                    <a class="btn btn-black" href="{{route("product",$one->id)}}">@lang('site.buy_now')</a>

                                    @php
                                        if(auth('web')->check()){

                                            $wishlists=auth('web')->user()->wishlist()->latest()->get();
                                            $exists = $wishlists->contains('id', $one->id);

                                        }
                                        else{
                                             $exists=false;
                                        }
                                    @endphp
                                    <a class="addToWishlist" data-product-id = "{{$one->id}}">
                                        @if ($exists)
                                              <svg class="favProd" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ff0000" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                                <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1"/>
                                            </svg>
                                            
                                        @else
                                            <svg class="unFavProd" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000" class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                                            </svg>
                                        @endif
                                      
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>

                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- ./ -->

    @if(count($ads_2) > 0)
        <div class="slider-wrapper">
            <div class="slider slider-ad">
                @foreach($ads_2 as $one)
                    <div>
                        <a href="{{$one -> in_app==0?$one ->link :($one ->type == 'product'?route("product",$one->link):route("vendor",$one->link))}}"
                        >
                            <img src="{{asset('assets/images/ads/'.$one->img)}}"
                                 onerror="this.src='{{asset('new_design/images/not-found.jpg')}}'"
                                 alt="Slide 1">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- _____  _____ -->
    @if(count($recommendedProducts) > 0)
        <section class="py-5">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-md-12 py-3">
                        <div
                            class="sec-title d-flex justify-content-between align-items-center"
                        >
                            <h2>@lang('site.recommended_products')</h2>
                            <a href="{{ route('productByType', 'recommendedProducts') }}" class="btn btn-gray">@lang('site.show_all')</a>

                        </div>
                    </div>
                </div>
                <div class="text-center brands owl-carousel owl-theme owl-recommended-products">
                    @foreach($recommendedProducts as $key=>$one)
                        <div>
                            <div class="brand-card new_product mx-3">
                                <div class="overflow-hidden image-wrapper position-relative">




                                    <a href="{{route("product",$one->id)}}">
                                        <img src="{{asset('assets/images/products/min/'.$one->img)}}"
                                             onerror="this.src='{{asset('new_design/images/not-found.png')}}'"

                                             class="img-fluid " alt=""></a>

                                    @if($one->checkQuantity()==0)
                                        <div class="soldout-overlay">@lang('site.sold_out')</div>
                                    @endif

                                </div>
                                <div class="py-3">
                                    <a class="product_title text-start" href="{{route("product",$one->id)}}">{{$one->name}}</a>
                                    @if($one->final_sale_price!=0&&$one->final_sale_price < $one->final_regular_price)
                                        <?php
                                        $sale=$one->final_sale_price;
                                        $regular=$one->final_regular_price;
                                        $discount=100 - round(($sale/$regular)*100,0);
                                        ?>
                                            <div class="mt-1 product_price">
                                                <div
                                                    class="d-flex justify-content-between  sale_price"
                                                >
                                                    <p class="discount">{{get_price_helper($one->final_regular_price,true)}}</p>
                                                    <span >{{$discount}}%</span>
                                                </div>
                                                <p >{{ get_price_helper($one->final_sale_price,true) }}</p>
                                            </div>

                                    @else


                                        <p class="mt-1 product_price price ">{{get_price_helper($one->final_regular_price,true)}}</p>
                                    @endif
                                    <div class="d-flex align-items-center justify-content-between mt-4 product_actions">
                                        <a class="btn btn-black" href="{{route("product",$one->id)}}">@lang('site.buy_now')</a>
                                        @php
                                            if(auth('web')->check()){

                                                $wishlists=auth('web')->user()->wishlist()->latest()->get();
                                                $exists = $wishlists->contains('id', $one->id);

                                            }
                                            else{
                                                 $exists=false;
                                            }
                                        @endphp
                                       <a class="addToWishlist" data-product-id = "{{$one->id}}">
                                        @if ($exists)
                                              <svg class="favProd" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ff0000" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                                <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1"/>
                                            </svg>
                                            
                                        @else
                                            <svg class="unFavProd" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000" class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                                            </svg>
                                        @endif
                                      
                                    </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- ./ -->

    @if(count($ads_3) > 0)
        <div class="slider-wrapper mb-2">
            <div class="slider slider-ad3">
                @foreach($ads_3 as $one)
                    <div>
                        <a href="{{$one -> in_app==0?$one ->link :($one ->type == 'product'?route("product",$one->link):route("vendor",$one->link))}}"
                        >
                            <img src="{{asset('assets/images/ads/'.$one->img)}}"
                                 onerror="this.src='{{asset('new_design/images/not-found.jpg')}}'"
                                 alt="Slide 1">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if(count($ads_4) > 0)
        <div class="slider-wrapper mb-2">
            <div class="slider slider-ad4">
                @foreach($ads_4 as $one)
                    <div>
                        <a href="{{$one -> in_app==0?$one ->link :($one ->type == 'product'?route("product",$one->link):route("vendor",$one->link))}}"
                        >
                            <img src="{{asset('assets/images/ads/'.$one->img)}}"
                                 onerror="this.src='{{asset('new_design/images/not-found.jpg')}}'"
                                 alt="Slide 1">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if(count($ads_5) > 0)
        <div class="slider-wrapper mb-2">
            <div class="slider slider-ad5">
                @foreach($ads_5 as $one)
                    <div>
                        <a href="{{$one -> in_app==0?$one ->link :($one ->type == 'product'?route("product",$one->link):route("vendor",$one->link))}}"
                        >
                            <img src="{{asset('assets/images/ads/'.$one->img)}}"
                                 onerror="this.src='{{asset('new_design/images/not-found.jpg')}}'"
                                 alt="Slide 1">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if(count($ads_6) > 0)
        <div class="slider-wrapper mb-2">
            <div class="slider slider-ad6">
                @foreach($ads_6 as $one)
                    <div>
                        <a href="{{$one -> in_app==0?$one ->link :($one ->type == 'product'?route("product",$one->link):route("vendor",$one->link))}}"
                        >
                            <img src="{{asset('assets/images/ads/'.$one->img)}}"
                                 onerror="this.src='{{asset('new_design/images/not-found.jpg')}}'"
                                 alt="Slide 1">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if(count($ads_7) > 0)
        <div class="slider-wrapper mb-2">
            <div class="slider slider-ad7">
                @foreach($ads_7 as $one)
                    <div>
                        <a href="{{$one -> in_app==0?$one ->link :($one ->type == 'product'?route("product",$one->link):route("vendor",$one->link))}}"
                        >
                            <img src="{{asset('assets/images/ads/'.$one->img)}}"
                                 onerror="this.src='{{asset('new_design/images/not-found.jpg')}}'"
                                 alt="Slide 1">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if(count($ads_8) > 0)
        <div class="slider-wrapper mb-2">
            <div class="slider slider-ad8">
                @foreach($ads_8 as $one)
                    <div>
                        <a href="{{$one -> in_app==0?$one ->link :($one ->type == 'product'?route("product",$one->link):route("vendor",$one->link))}}"
                        >
                            <img src="{{asset('assets/images/ads/'.$one->img)}}"
                                 onerror="this.src='{{asset('new_design/images/not-found.jpg')}}'"
                                 alt="Slide 1">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if(count($ads_9) > 0)
        <div class="slider-wrapper mb-2">
            <div class="slider slider-ad9">
                @foreach($ads_9 as $one)
                    <div>
                        <a href="{{$one -> in_app==0?$one ->link :($one ->type == 'product'?route("product",$one->link):route("vendor",$one->link))}}"
                        >
                            <img src="{{asset('assets/images/ads/'.$one->img)}}"
                                 onerror="this.src='{{asset('new_design/images/not-found.jpg')}}'"
                                 alt="Slide 1">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if(count($ads_10) > 0)
        <div class="slider-wrapper">
            <div class="slider slider-ad10">
                @foreach($ads_10 as $one)
                    <div>
                        <a href="{{$one -> in_app==0?$one ->link :($one ->type == 'product'?route("product",$one->link):route("vendor",$one->link))}}"
                        >
                            <img src="{{asset('assets/images/ads/'.$one->img)}}"
                                 onerror="this.src='{{asset('new_design/images/not-found.jpg')}}'"
                                 alt="Slide 1">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


@endsection

@section('js')
    <script>
    window.addEventListener('load', function () {
      $('.slider').slick({
        dots: true,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000
      });
    });
      window.addEventListener('load', function () {
      $('.slider-ad').slick({
        dots: true,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000
      });
    });
     window.addEventListener('load', function () {
      $('.slider-ad3').slick({
        dots: true,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000
      });
    });
     window.addEventListener('load', function () {
      $('.slider-ad4').slick({
        dots: true,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000
      });
    });
     window.addEventListener('load', function () {
      $('.slider-ad5').slick({
        dots: true,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000
      });
    });
     window.addEventListener('load', function () {
      $('.slider-ad6').slick({
        dots: true,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000
      });
    });
     window.addEventListener('load', function () {
      $('.slider-ad7').slick({
        dots: true,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000
      });
    });
     window.addEventListener('load', function () {
      $('.slider-ad8').slick({
        dots: true,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000
      });
    });
     window.addEventListener('load', function () {
      $('.slider-ad9').slick({
        dots: true,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000
      });
    });
     window.addEventListener('load', function () {
      $('.slider-ad10').slick({
        dots: true,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000
      });
    });

  </script>
@endsection

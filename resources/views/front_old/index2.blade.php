@extends('layouts.layout')
@section('title')
    @lang('site.app_name')
@endsection


@section('content')
    <main id="content">
        @if(count($sliders))
            <section style="direction: rtl" class="mx-0 pt-3 pb-5 pb-md-10 slick-slider dots-inner-center slider"
                 data-slick-options='{"slidesToShow": 1,"infinite":true,"autoplay":true,"dots":true,"arrows":false,"fade":true,"cssEase":"ease-in-out","speed":600}'>
            @foreach($sliders as $slider)
            <div class="box px-0">
                <div class="">
                    <div class="bg-img-cover-center pt-12 pb-13 pb-lg-16 pt-lg-15 pl-3 pl-lg-13 slider_div"
                         style="background-image: url({{ asset('assets/images/sliders/' . $slider->img) }});">
                        <div class="pt-4 mb-6" data-animate="fadeInDown">
                            <!-- <h1 class="mb-3 fs-46 fs-md-56 lh-128">
                              أفضل المنتجات المتنوعة
                                </h1> -->
                        </div>
                        <div class="mb-1 offer-content"  >
                            <!-- <p class="fs-20 font-weight-600 text-secondary mb-4">بداية من $7.99 </p> -->
                            <a href="{{$slider -> in_app==0?$slider ->link :($slider ->type == 'product'?route("product",$slider->link):route("vendor",$slider->link))}}"
                               class="btn btn-secondary rounded bg-hover-primary border-0">@lang('site.browse_now')</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </section>
        @endif
            @if(count($Brands) > 0)
                <section class="my-lg-7 prods prodss stors fams categ">
                    <div class="container container-xl">
                        <div class="d-flex align-items-center justify-content-between mb-md-2">
                            <div class="">
                                <h2 class="fs-34 text-dark"  > @lang('site.famous') </h2>
                            </div>
                            <div class="text-md-right bg-primary-color white-text more-btn">
                                <a href="{{ route('brands') }}" class="btn btn-link p-0 white-text">@lang('site.show_all') </a>
                            </div>
                        </div>

                        <div class="slick-slider mx-n2"

                             data-slick-options='{"slidesToShow": 4,"dots":false,"arrows":true,"responsive":[{"breakpoint": 1368,"settings": {"arrows":false,"dots":true}},{"breakpoint": 1200,"settings": {"slidesToShow":3,"arrows":false,"dots":true}},{"breakpoint": 992,"settings": {"slidesToShow":3,"arrows":false,"dots":true}},{"breakpoint": 768,"settings": {"slidesToShow": 3,"arrows":false,"dots":false}},{"breakpoint": 576,"settings": {"slidesToShow": 3,"arrows":false,"dots":false}}]}'>

                            @foreach($femaleBrands as $one)
                                <div class="box brandImage">
                                    <a href="{{ route('brand', $one->id) }}">
                                        <div class="card border-0 product"  >
                                            <div class="position-relative hover-zoom-in">
                                                <img class="imageSize brand_img" src="{{ asset('assets/images/student/' . $one->img) }}">
                                            </div>
                                            <div class="card-body text-center px-0" style="padding-bottom: 1rem !important;">

                                                <h2 class="card-title fs-15 font-weight-500"><a href="{{ route('brand', $one->id) }}">  {{$one->name}} </a></h2>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach



                        </div>
                        <div class="slick-slider mx-n2"
                             data-slick-options='{"slidesToShow": 4,"dots":false,"arrows":true,"responsive":[{"breakpoint": 1368,"settings": {"arrows":false,"dots":true}},{"breakpoint": 1200,"settings": {"slidesToShow":3,"arrows":false,"dots":true}},{"breakpoint": 992,"settings": {"slidesToShow":3,"arrows":false,"dots":true}},{"breakpoint": 768,"settings": {"slidesToShow": 3,"arrows":false,"dots":false}},{"breakpoint": 576,"settings": {"slidesToShow": 3,"arrows":false,"dots":false}}]}'>

                            @foreach($maleBrands as $one)
                                <div class="box brandImage">
                                    <div class="card border-0 product"  >
                                        <a href="{{ route('brand', $one->id) }}">
                                            <div class="position-relative">
                                                <img class="imageSize brand_img"
                                                     src="{{ asset('assets/images/student/' . $one->img) }}">
                                            </div>
                                        </a>
                                        <div class="card-body pt-4 text-center m-auto m-md-1 d-block  justify-content-between align-items-center">
                                            <h2 class="card-title fs-15 font-weight-500 "><a href="{{ route('brand', $one->id) }}">{{\Illuminate\Support\Str::limit($one->name, 19, '..')}}</a></h2>
                                        </div>
                                    </div>
                                </div>

{{--                                <div class="box">--}}
{{--                                    <a href="{{ route('brand', $one->id) }}">--}}
{{--                                        <div class="card border-0 product"  >--}}
{{--                                            <div class="position-relative hover-zoom-in">--}}
{{--                                                <img class="imageSize" src="{{ asset('assets/images/student/' . $one->img) }}">--}}
{{--                                            </div>--}}
{{--                                            <div class="card-body text-center px-0" style="padding-bottom: 1rem !important;">--}}

{{--                                                <h2 class="card-title fs-15 font-weight-500"><a href="{{ route('brand', $one->id) }}">  {{$one->name}} </a></h2>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                            @endforeach



                        </div>

                    </div>
                </section>
            @endif

{{--            @if(count($maleBrands) > 0)--}}
{{--                <section class="my-lg-7 prods prodss  stors fams categ">--}}
{{--                    <div class="container container-xl">--}}
{{--                        <div class="d-flex align-items-center justify-content-between mb-md-2">--}}
{{--                            <div class="">--}}
{{--                                <h2 class="fs-34"  > المشاهير رجال</h2>--}}
{{--                            </div>--}}
{{--                            <div class="text-md-right">--}}
{{--                                <a href="{{ route('brands', ['type' => 1]) }}" class="btn btn-link p-0">عرض الكل <i class="far fa-arrow-right pl-2 fs-13"></i></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="slick-slider mx-n2"--}}
{{--                             data-slick-options='{"slidesToShow": 4,"dots":false,"arrows":true,"responsive":[{"breakpoint": 1368,"settings": {"arrows":false,"dots":true}},{"breakpoint": 1200,"settings": {"slidesToShow":3,"arrows":false,"dots":true}},{"breakpoint": 992,"settings": {"slidesToShow":2,"arrows":false,"dots":true}},{"breakpoint": 768,"settings": {"slidesToShow": 2,"arrows":false,"dots":false}},{"breakpoint": 576,"settings": {"slidesToShow": 2,"arrows":false,"dots":false}}]}'>--}}

{{--                            @foreach($maleBrands as $one)--}}
{{--                                <div class="box">--}}
{{--                                    <a href="{{ route('brand', $one->id) }}">--}}
{{--                                        <div class="card border-0 product"  >--}}
{{--                                            <div class="position-relative hover-zoom-in">--}}
{{--                                                <img src="{{ asset('assets/images/student/' . $one->img) }}">--}}
{{--                                            </div>--}}
{{--                                            <div class="card-body text-center px-0">--}}

{{--                                                <h2 class="card-title fs-15 font-weight-500"><a href="{{ route('brand', $one->id) }}">  {{$one->name}} </a></h2>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}



{{--                        </div>--}}
{{--                    </div>--}}
{{--                </section>--}}
{{--            @endif--}}

{{--            <section class="categ">--}}
{{--            <div class="container container-xl">--}}
{{--                <div class="row mb-md-6 mb-lg-0">--}}
{{--                    <div class="col-md-12 d-flex align-items-center justify-content-between">--}}
{{--                        <h2 class="fs-34 dsply-mob mb-5"  >  تسوق حسب الفئات</h2>--}}
{{--                        <!-- <a href="all-prods.html" class="btn dsply-mob btn-link p-0 mt-2">عرض الكل <i class="far fa-arrow-right pl-2 fs-13"></i></a> -->--}}
{{--                    </div>--}}
{{--                    <div class="col-12 col-md-6 text-md-right">--}}
{{--                        <div class="d-flex justify-content-between align-items-center d-md-none d-lg-none">--}}
{{--                            <span style="display: block; width: 25%; height: 3px; background: var(--cyan);"></span>--}}
{{--                            <a href="#" class="btn btn-link p-0 mt-2">تصفح جميع المنتجات</a>--}}
{{--                            <span style="display: block; width: 25%; height: 3px; background: var(--cyan);"></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="slick-slider mx-n2"--}}
{{--                     data-slick-options='{"slidesToShow": 6,"dots":true,"arrows":true,"responsive":[{"breakpoint": 1368,"settings": {"arrows":false,"dots":true}},{"breakpoint": 1200,"settings": {"slidesToShow":3,"arrows":false,"dots":true}},{"breakpoint": 992,"settings": {"slidesToShow":2,"arrows":false,"dots":true}},{"breakpoint": 768,"settings": {"slidesToShow": 4,"arrows":false,"dots":false}},{"breakpoint": 576,"settings": {"slidesToShow": 4,"arrows":false,"dots":false}}]}'>--}}
{{--                    @foreach ($vendors as $k => $one)--}}
{{--                    <div class="box">--}}
{{--                        <div class="card border-0 text-center mb-lg-0">--}}
{{--                            <div class="mw-160 mx-auto hover-zoom-in rounded-circle">--}}
{{--                                <a href="{{ route('vendor', $one->id) }}">--}}
{{--                                    <img class="imageSize2" src="{{asset('assets/images/categories/' . $one->img) }}" alt="{{$one->name}}">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="card-body px-0 pb-0">--}}
{{--                                <h4 class="fs-20"><a href="{{ route('vendor', $one->id) }}" class="text-decoration-none">{{$one->name}}</a>--}}
{{--                                </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @endforeach--}}

{{--                </div>--}}
{{--                <div class="row mb-md-6 d-lg-none">--}}
{{--                    <div class="col-md-6">--}}
{{--                        <h2 class="fs-34 dsply-mobb"  >  تسوق حسب الفئات</h2>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6 text-md-right">--}}
{{--                        <a href="#" class="btn dsply-mobb btn-link p-0 mt-2">تصفح جميع المنتجات<i class="far fa-arrow-right pl-2 fs-13"></i></a>--}}
{{--                        <div class="d-flex justify-content-between align-items-center d-md-none">--}}
{{--                            <span class="my-5" style="display: block; width: 100%; height: 3px; background: var(--cyan);"></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

        <!-- <section class="pb-md-7 pb-10 pb-lg-14">
          <div class="container container-xl">
            <div class="row">
              <div class="col-12 col-md-7 col-lg-8 mb-6 mb-lg-0">
                <div class="card border-0 banner banner-01 hover-zoom-in hover-shine"   >
                  <div class="card-img bg-img-cover-center"
                           style="background-image: url('images/images/170360376198315.jpeg');"></div>
                  <div class="card-img-overlay d-inline-flex flex-column p-6 p-md-8">
                    <h6 class="card-subtitle mb-2 text-secondary letter-spacing-01" style="color: #fff !important;">مجموعة جديدة</h6>
                    <h3 class="card-title fs-34 lh-129" style="max-width: 310px">اكتشف منتجنا </h3>
                    <div class="mt-4">
                      <a href="shop-page-02.html"
                                 class="fs-16 font-weight-600 btn text-secondary hover-white bg-white bg-hover-secondary shadow-1">اكتشف عرض الكل </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-5 col-lg-4">
                <div class="card border-0 banner banner-01 hover-zoom-in hover-shine"  >
                  <div class="card-img bg-img-cover-center"
                           style="background-image: url('images/images/170360571439820.jpeg');"></div>
                  <div class="card-img-overlay d-inline-flex flex-column p-6 p-md-8">
                    <h3 class="card-title fs-34 lh-129 mb-2">25% خصم لجميع المنتجات</h3>
                    <p class="card-text text-secondary font-weight-500" style="max-width: 236px; color: #fff !important;">
                         أحدث المنتجات
                    </p>
                    <div class="mt-2">
                      <a href="shop-page-02.html"
                                 class="fs-16 font-weight-600 btn text-secondary hover-white bg-white bg-hover-secondary shadow-1">اذهب للخصم</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section> -->

            @if(count($newProducts) > 0)
                <section class="my-3 my-lg-3 prods">
                    <div class="container container-xl">
                        <div class="d-flex align-items-center justify-content-between mb-md-6">
                            <div class="">
                                <h2 class="fs-34 text-dark"  >@lang('site.latest_products')</h2>
                            </div>
                            <div class="text-md-right more-btn">
                                <a href="{{ route('productByType', 'newProducts') }}" class="btn btn-link p-0 white-text ">@lang('site.show_all')</a>
                            </div>
                        </div>
                        <div class="slick-slider mx-n2"
                             data-slick-options='{"slidesToShow": 5,"dots":false,"arrows":true,"responsive":[{"breakpoint": 1368,"settings": {"slidesToShow":4,"arrows":false,"dots":true}},{"breakpoint": 1200,"settings": {"slidesToShow":3,"arrows":false,"dots":false}},{"breakpoint": 992,"settings": {"slidesToShow":2,"arrows":false,"dots":false}},{"breakpoint": 768,"settings": {"slidesToShow": 2,"arrows":false,"dots":false}},{"breakpoint": 576,"settings": {"slidesToShow": 2,"arrows":false,"dots":false}}]}'>
                            @foreach($newProducts as $one)
                                <div class="box">
                                    <div class="card border-0 product"  >
                                        <a href="{{route("product",$one->id)}}">
                                            <div class="position-relative">
                                                <img class="imageSize"
                                                     src="{{asset('assets/images/products/min/'.$one->img)}}">
                                                <div class="card-img-overlay d-flex p-3">
                                                    @if($one->if_sale)
                                                        <?php
                                                        $sale=$one->sale_price;
                                                        $regular=$one->regular_price;
                                                        $discount=100 - round(($sale/$regular)*100,1);
                                                        ?>
                                                        <div>
                                                            <span class="badge badge-primary">   {{ get_price_helper($discount) }}</span>
                                                        </div>
                                                    @endif
                                                        <div class="my-auto w-100 content-change-vertical">
                                                            @if($one->quantity==0)
                                                                <span class="ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-100 h-48px mb-2">sold out</span>
                                                            @endif
                                                        </div>
{{--                                                    <div class="my-auto w-100 content-change-vertical">--}}
                                                        {{--                                            <a href="{{ route('product',$one->id) }}" data-toggle="tooltip" data-placement="bottom" title="عرض المنتج"--}}
                                                        {{--                                               class="add-to-cart ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2">--}}
                                                        {{--                                                <svg class="icon icon-shopping-bag-open-light fs-24">--}}
                                                        {{--                                                    <use xlink:href="#icon-shopping-bag-open-light"></use>--}}
                                                        {{--                                                </svg>--}}
                                                        {{--                                            </a>--}}
                                                        {{--<a href="#" data-toggle="tooltip" data-placement="top" title="عرض سريع"
                                                           class="preview ml-auto d-md-flex align-items-center justify-content-center cursor-pointer text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2 d-none">
                                <span data-toggle="modal" data-target="#quick-view">
                                  <svg class="icon icon-eye-light fs-24">
                                    <use xlink:href="#icon-eye-light"></use>
                                  </svg>
                                </span>
                                                        </a>--}}
                                                        {{--                                            <a href="#" data-toggle="tooltip" data-placement="top" title="اضافة الى المفضلة"--}}
                                                        {{--                                               class="add-to-wishlist ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2">--}}
                                                        {{--                                                <svg class="icon icon-star-light fs-24">--}}
                                                        {{--                                                    <use xlink:href="#icon-star-light"></use>--}}
                                                        {{--                                                </svg>--}}
                                                        {{--                                            </a>--}}

{{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </a>
                                        <div class="card-body pt-4 text-center m-auto m-md-1 d-block  justify-content-between align-items-center">
                                            <h2 style="height: 50px" class="card-title fs-15 font-weight-500 "><a href="{{route("product",$one->id)}}">
                                                    {{$one->name}}
                                                </a></h2>                                            @if($one->if_sale)
                                                <?php
                                                $sale=$one->sale_price;
                                                $regular=$one->regular_price;
                                                $discount=100 - round(($sale/$regular)*100,1);
                                                ?>
                                                <p class="card-text font-weight-bold fs-price mb-1 text-decoration-through text-danger">{{get_price_helper($one->regular_price,true)}}</p>
                                                <p class="card-text font-weight-bold fs-price mb-1 text-secondary">{{ get_price_helper($one->sale_price,true) }}</p>
                                            @else
                                                <p class="card-text font-weight-bold fs-price mb-1 text-white">{{get_price_helper($one->regular_price,true)}}</p>

                                                <p class="card-text font-weight-bold fs-price mb-1 text-secondary">{{get_price_helper($one->regular_price,true)}}</p>
                                            @endif
                                            <p class="d-flex w-100">
                                                <a href="#" data-toggle="tooltip" data-placement="top"  data-product-id = "{{$one->id}}" title="اضافة الى المفضلة"
                                                   class="w-25 addToWishlist add-to-wishlist ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2">
                                                    <svg class="icon icon-star-light fs-24">
                                                        <use xlink:href="#icon-star-light"></use>
                                                    </svg>
                                                </a>
                                                <a href="{{route("product",$one->id)}}" class="fs-20 w-75 ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary  mb-2  rounded-top rounded-bottom">
                                                    <span class="fs-20 mx-2">@lang('site.buy_now')</span>
                                                    <svg class="icon icon-shopping-bag-open-light fs-22">
                                                        <use xlink:href="#icon-shopping-bag-open-light"></use>
                                                    </svg>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </section>
            @endif

            @if(count($ads_1) > 0)
                <section class="my-3 my-lg-3 prods">
                    <div class="container container-xl">
                        <div class="row mb-3">
                                @foreach($ads_1 as $one)
                                    <div class="col-6 mb-3 mobile_pad"     >
                                        <a href="{{$one -> in_app==0?$one ->link :($one ->type == 'product'?route("product",$one->link):route("vendor",$one->link))}}">
                                            <div class="card border-0 product"    >

                                                <div class="position-relative hover-zoom-in">
                                                    <img class="ad_img" src="{{ asset('assets/images/ads/'.$one->img) }}">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                </section>
            @endif

           @if(count($offers) > 0)
            <section class="my-lg-7 prods">
                <div class="container container-xl">
                    <div class="d-flex align-items-center justify-content-between mb-md-6">
                        <div class="#">
                            <h2 class="fs-34 text-dark"  >@lang('site.trendat_picks')</h2>
                        </div>

                        <div class="text-md-right more-btn">
                            <a href="{{ route('productByType', 'offers') }}" class="btn btn-link p-0 white-text">@lang('site.show_all')</a>
                        </div>
                    </div>
                    <div class="slick-slider mx-n2"
                         data-slick-options='{"slidesToShow": 5,"dots":false,"arrows":true,"responsive":[{"breakpoint": 1368,"settings": {"slidesToShow":4,"arrows":false,"dots":true}},{"breakpoint": 1200,"settings": {"slidesToShow":3,"arrows":false,"dots":false}},{"breakpoint": 992,"settings": {"slidesToShow":2,"arrows":false,"dots":false}},{"breakpoint": 768,"settings": {"slidesToShow": 2,"arrows":false,"dots":false}},{"breakpoint": 576,"settings": {"slidesToShow": 2,"arrows":false,"dots":false}}]}'>
                        @foreach($offers as $one)
                            <div class="box">
                            <div class="card border-0 product">
                                <a href="{{route("product",$one->id)}}">

                                    <div class="position-relative">

                                            <img class="imageSize"
                                                 src="{{asset('assets/images/products/min/'.$one->img)}}">

                                        <div class="card-img-overlay d-flex p-3">
                                            @if($one->if_sale)
                                                <?php
                                                $sale=$one->sale_price;
                                                $regular=$one->regular_price;
                                                $discount=100 - round(($sale/$regular)*100,1);
                                                ?>
                                                    <div class="badge-product-sale">
                                                        <span class="new">{{$discount}}</span>
                                                    </div>
                                            @endif
                                                <div class="my-auto w-100 content-change-vertical">
                                                    @if($one->quantity==0)
                                                        <span class="ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-100 h-48px mb-2">sold out</span>
                                                    @endif
                                                </div>
    {{--                                        <div class="my-auto w-100 content-change-vertical">--}}
    {{--                                            <a href="{{route("product",$one->id)}}" data-toggle="tooltip" data-placement="bottom" title="عرض المنتج"--}}
    {{--                                               class="add-to-cart ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2">--}}
    {{--                                                <svg class="icon icon-shopping-bag-open-light fs-24">--}}
    {{--                                                    <use xlink:href="#icon-shopping-bag-open-light"></use>--}}
    {{--                                                </svg>--}}
    {{--                                            </a>--}}
    {{--                                            --}}{{--<a href="#" data-toggle="tooltip" data-placement="top" title="عرض سريع"--}}
    {{--                                               class="preview ml-auto d-md-flex align-items-center justify-content-center cursor-pointer text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2 d-none">--}}
    {{--                                            <span data-toggle="modal" data-target="#quick-view">--}}
    {{--                                              <svg class="icon icon-eye-light fs-24">--}}
    {{--                                                <use xlink:href="#icon-eye-light"></use>--}}
    {{--                                              </svg>--}}
    {{--                                            </span>--}}
    {{--                                            </a>--}}
    {{--                                            <a href="#" data-toggle="tooltip" data-placement="top"  data-product-id = "{{$one->id}}" title="اضافة الى المفضلة"--}}
    {{--                                               class="addToWishlist add-to-wishlist ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2">--}}
    {{--                                                <svg class="icon icon-star-light fs-24">--}}
    {{--                                                    <use xlink:href="#icon-star-light"></use>--}}
    {{--                                                </svg>--}}
    {{--                                            </a>--}}

    {{--                                        </div>--}}
                                        </div>
                                    </div>
                                </a>
                                <div class="card-body pt-4 text-center m-auto m-md-1 d-block  justify-content-between align-items-center">
                                    <h2 style="height: 50px" class="card-title fs-15 font-weight-500 "><a href="{{route("product",$one->id)}}">
                                            {{$one->name}}
                                        </a></h2>
                                    @if($one->if_sale)
                                        <?php
                                        $sale=$one->sale_price;
                                        $regular=$one->regular_price;
                                        $discount=100 - round(($sale/$regular)*100,1);
                                        ?>
                                        <p class="card-text font-weight-bold fs-price mb-1 text-decoration-through text-danger">{{get_price_helper($one->regular_price,true)}}</p>
                                        <p class="card-text font-weight-bold fs-price mb-1 text-secondary">{{ get_price_helper($one->sale_price,true) }}</p>
                                    @else
                                        <p class="card-text font-weight-bold fs-price mb-1 text-white">{{get_price_helper($one->regular_price,true)}}</p>

                                        <p class="card-text font-weight-bold fs-price mb-1 text-secondary">{{get_price_helper($one->regular_price,true)}}</p>
                                    @endif
                                    <p class="d-flex w-100">
                                        <a href="#" data-toggle="tooltip" data-placement="top"  data-product-id = "{{$one->id}}" title="اضافة الى المفضلة"
                                           class="w-25 addToWishlist add-to-wishlist ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2">
                                            <svg class="icon icon-star-light fs-24">
                                                <use xlink:href="#icon-star-light"></use>
                                            </svg>
                                        </a>
                                        <a href="{{route("product",$one->id)}}" class="fs-20 w-75 ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary  mb-2  rounded-top rounded-bottom">
                                            <span class="fs-20 mx-2">@lang('site.buy_now')</span>
                                            <svg class="icon icon-shopping-bag-open-light fs-22">
                                                <use xlink:href="#icon-shopping-bag-open-light"></use>
                                            </svg>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif


            @if(count($ads_2) > 0)
                <section  style="direction: rtl" class="mx-0 pt-3 pb-5 pb-md-10 slick-slider dots-inner-center slider d-block d-lg-none"
                         data-slick-options='{"slidesToShow": 1,"infinite":true,"autoplay":true,"dots":true,"arrows":false,"fade":true,"cssEase":"ease-in-out","speed":600}'>
                    @foreach($ads_2 as $one)
                        <div class="box px-0">
                            <div class="">
                                <div class="bg-img-cover-center pt-12 pb-13 pb-lg-16 pt-lg-15 pl-3 pl-lg-13"
                                     style="background-image: url('{{asset('assets/images/ads/'.$one->img)}}');">
                                    <div class="pt-4 mb-6" data-animate="fadeInDown">
                                        <!-- <h1 class="mb-3 fs-46 fs-md-56 lh-128">
                                          أفضل المنتجات المتنوعة
                                            </h1> -->
                                    </div>
                                    <div class="mb-1 offer-content"  >
                                        <!-- <p class="fs-20 font-weight-600 text-secondary mb-4">بداية من $7.99 </p> -->
                                        <a href="{{$one -> in_app==0?$one ->link :($one ->type == 'product'?route("product",$one->link):route("vendor",$one->link))}}"
                                           class="btn btn-secondary rounded bg-hover-primary border-0">@lang('site.browse_now')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </section>
            @endif


            @if(count($ads_2) > 0)
                <section  style="direction: rtl" class="mx-0 mt-lg-9 pt-3 pb-5 pb-md-10 slick-slider dots-inner-center slider d-none d-lg-block"
                         data-slick-options='{"slidesToShow": 1,"infinite":true,"autoplay":true,"dots":true,"arrows":false,"fade":true,"cssEase":"ease-in-out","speed":600}'>
                    @foreach($ads_2 as $one)
                        <div class="box px-0">
                            <div class="">
                                <div class="bg-img-cover-center pt-12 pb-13 pb-lg-16 pt-lg-15 pl-3 pl-lg-13"
                                     style="background-image: url('{{asset('assets/images/ads/'.$one->img)}}');">
                                    <div class="pt-4 mb-6" data-animate="fadeInDown">
                                        <!-- <h1 class="mb-3 fs-46 fs-md-56 lh-128">
                                          أفضل المنتجات المتنوعة
                                            </h1> -->
                                    </div>
                                    <div class="mb-1 offer-content"  >
                                        <!-- <p class="fs-20 font-weight-600 text-secondary mb-4">بداية من $7.99 </p> -->
                                        <a href="{{$one -> in_app==0?$one ->link :($one ->type == 'product'?route("product",$one->link):route("vendor",$one->link))}}"
                                           class="btn btn-secondary rounded bg-hover-primary border-0">@lang('site.browse_now')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </section>

            @endif

           @if(count($recommendedProducts) > 0)
                <section class="mt-lg-3 mb-15 mb-lg-10 prods">
            <div class="container container-xl">
                <div class="d-flex align-items-center justify-content-between mb-md-6">
                    <div class="">
                        <h2 class="fs-34 text-dark"  >@lang('site.recommended_products')</h2>
                    </div>
                    <div class="text-md-right more-btn">
                        <a href="{{ route('productByType', 'recommendedProducts') }}" class="btn btn-link p-0 white-text">@lang('site.show_all')</a>
                    </div>
                </div>

                <div class="slick-slider mx-n2"
                     data-slick-options='{"slidesToShow": 5,"dots":false,"arrows":true,"responsive":[{"breakpoint": 1368,"settings": {"slidesToShow":4,"arrows":false,"dots":true}},{"breakpoint": 1200,"settings": {"slidesToShow":3,"arrows":false,"dots":true}},{"breakpoint": 992,"settings": {"slidesToShow":2,"arrows":false,"dots":true}},{"breakpoint": 768,"settings": {"slidesToShow": 2,"arrows":false,"dots":false}},{"breakpoint": 576,"settings": {"slidesToShow": 2,"arrows":false,"dots":false}}]}'>
                    @foreach($recommendedProducts as $one)
                    <div class="box">
                        <div class="card border-0 product"  >
                            <a href="{{route("product",$one->id)}}">
                                <div class="position-relative">
                                <img class="imageSize"
           src="{{asset('assets/images/products/min/'.$one->img)}}">
                                <div class="card-img-overlay d-flex p-3">
                                    @if($one->if_sale)
                                        <?php
                                        $sale=$one->sale_price;
                                        $regular=$one->regular_price;
                                        $discount=100 - round(($sale/$regular)*100,1);
                                        ?>
                                        <div>
                                            <span class="badge badge-primary">  {{ get_price_helper($discount) }}</span>
                                        </div>
                                    @endif
                                    <div class="my-auto w-100 content-change-vertical">
                                        @if($one->quantity==0)
                                       <span class="ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-100 h-48px mb-2">sold out</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            </a>
                            <div class="card-body pt-4 text-center m-auto m-md-1 d-block  justify-content-between align-items-center">
                                <h2 class="card-title fs-15 font-weight-500 "><a href="{{route("product",$one->id)}}">{{\Illuminate\Support\Str::limit($one->name, 19, '..')}}</a></h2>
                                @if($one->if_sale)
                                    <?php
                                    $sale=$one->sale_price;
                                    $regular=$one->regular_price;
                                    $discount=100 - round(($sale/$regular)*100,1);
                                    ?>
                                    <p class="card-text font-weight-bold fs-price mb-1 text-decoration-through text-danger">{{get_price_helper($one->regular_price,true)}}</p>
                                    <p class="card-text font-weight-bold fs-price mb-1 text-secondary">{{ get_price_helper($one->sale_price,true) }}</p>
                                @else
                                    <p class="card-text font-weight-bold fs-price mb-1 text-white">{{get_price_helper($one->regular_price,true)}}</p>

                                    <p class="card-text font-weight-bold fs-price mb-1 text-secondary">{{get_price_helper($one->regular_price,true)}}</p>
                                @endif
                                <p class="d-flex w-100">
                                    <a href="#" data-toggle="tooltip" data-placement="top"  data-product-id = "{{$one->id}}" title="اضافة الى المفضلة"
                                       class="w-25 addToWishlist add-to-wishlist ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2">
                                        <svg class="icon icon-star-light fs-24">
                                            <use xlink:href="#icon-star-light"></use>
                                        </svg>
                                    </a>
                                    <a href="{{route("product",$one->id)}}" class="fs-20 w-75 ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary  mb-2  rounded-top rounded-bottom">
                                        <span class="fs-20 mx-2">@lang('site.buy_now')</span>
                                        <svg class="icon icon-shopping-bag-open-light fs-22">
                                            <use xlink:href="#icon-shopping-bag-open-light"></use>
                                        </svg>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>
            @endif

    </main>

@endsection

@section('js')

@endsection

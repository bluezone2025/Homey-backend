@extends('layouts.front')
@section('title')
@lang('site.home')
@endsection
@section('meta')
<meta name="description"
    content="{{ app()->getlocale() =='ar' ? $my_setting->site_name_ar :  $my_setting->site_name_en }} | {{ __('site.home') }}">
<meta name="keywords"
    content="{{ app()->getlocale() =='ar' ? $my_setting->site_name_ar :  $my_setting->site_name_en }} | {{ __('site.home') }}">

<meta property="og:title"
    content="{{ app()->getlocale() =='ar' ? $my_setting->site_name_ar :  $my_setting->site_name_en }} | {{ __('site.home') }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{url('/')}}">
<meta property="og:image" content="{{ asset('/storage/' . $my_setting->logo) }}">
<meta property="og:site_name"
    content="{{ app()->getlocale() =='ar' ? $my_setting->site_name_ar :  $my_setting->site_name_en }} | {{__('site.home') }}">
<meta property="og:description" content="{{ __('site.home')}}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="{{url('/')}}">
<meta name="twitter:title"
    content="{{ app()->getlocale() =='ar' ? $my_setting->site_name_ar :  $my_setting->site_name_en }} | {{ __('site.home') }}">
<meta name="twitter:description"
    content="{{ app()->getlocale() =='ar' ? $my_setting->site_name_ar :  $my_setting->site_name_en }} | {{ __('site.home') }}">
<meta name="twitter:image" content="{{ asset('/storage/' . $my_setting->logo) }}">

@endsection

@section('content')

<style>
@media (min-width: 0px) and (max-width: 425px) {
    .h {
        /* height: 30vh !important; */
        object-fit: contain;
        margin-top: 0;
    }

    .carousel-inner {
        /* height: 30%; */
    }

    .carousel {
        margin-top: 20px;
    }

    .new1 {
        margin-bottom: -75px;
        /* margin-top: 3px; */
    }
}

@media (min-width: 425px) and (max-width: 600px) {
    .h {
        /* height: 40vh !important; */
        object-fit: contain;
        margin-top: 0 !important;
    }

    .carousel-inner {
        height: auto;
    }

    .carousel {
        margin-top: -20px;
    }
}

@media (min-width: 425px) and (max-width: 571px) {
    .h {
        /* height: 35vh !important; */
        object-fit: contain;
        margin-top: unset !important;
    }

    .carousel-inner {
        /* height: 48%; */
    }

    .carousel {
        margin-top: -20px;
    }
}

@media (min-width: 601px) and (max-width: 820px) {
    .h {
        /* height: 40vh !important; */
        object-fit: contain;
    }

    .carousel-indicators {
        bottom: -17px !important;
    }

    .new1 {
        padding-top: 6vh;
    }

    .carousel-inner {
        height: auto;
    }
}
</style>
<?php use App\User; ?>
{{-- {{ dd(Auth::user()->country->name_ar)}} --}}

@if (session()->get('order'))
<?php $invoice = session()->get('order'); ?>
{{-- <h1>The name of fatorah is {{session()->get( 'order' )->name}}</h1> --}}
<div class="  col-md-5 d-md-block" style="margin: 20px auto !important">
    <div class="table_block table-responsive dir-rtl">
        <table class="table table-bordered">
            <thead class="btn-dark">

                <tr>
                    <th colspan="2" class="text-center">@lang('site.order_summary')</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <tr>
                    <th scope="row" class="btn-dark">@lang('site.invoice_id')</th>
                    <td>{{ $invoice->invoice_id?? $invoice->id }}</td>

                </tr>
                <tr>
                    <th scope="row" class="btn-dark">@lang('site.total_price')</th>
                    <td>{{ $invoice->total_price }} @lang('site.kwd')</td>

                </tr>
                <th scope="row" class="btn-dark">@lang('site.email')</th>
                <td>{{ $invoice->email }}</td>

                </tr>
                <tr>
                    <th scope="row" class="btn-dark">@lang('site.phone')</th>
                    <td>{{ $invoice->phone }}</td>

                </tr>
                <tr>
                    <th scope="row" class="btn-dark">@lang('site.address1')</th>
                    <td>{{ $invoice->address1 }}</td>

                </tr>

                <tr>
                    <th scope="row" class="btn-dark">@lang('site.name')</th>
                    <td>{{ $invoice->name }}</td>

                </tr>
                <tr>
                    <th scope="row" class="btn-dark">@lang('site.total_quantity')</th>
                    <td>{{ $invoice->total_quantity }}</td>

                </tr>
                <tr>
                    <th scope="row" class="btn-dark">@lang('site.order_status')</th>
                    <td>{{ __("site.status_$invoice->status") }}</td>
                </tr>

                <tr>
                    <th scope="row" class="btn-dark">@lang('site.date_of_order')</th>
                    <td>{{ $invoice->created_at }}</td>

                </tr>

            </tbody>
        </table>
    </div>
</div>








{{ Session::forget('order') }}

{{-- @dd( "The name of fatorah is ".session()->get( 'order' )->name) --}}
{{-- @dd( "The name of fatorah is ".session()->get( 'order' )->name) --}}

@endif


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    <ul>
        <li>{{ session('error') }}</li>
    </ul>
</div>
@endif
<div class="text-dir new1 "
    style="background-size:auto; background-image:url({{ asset('/storage/' . $my_setting->ad_image) }})">

    <h1 class="c-w">

    </h1>
    <p class="c-w ">

    </p>

</div>

<!-----start carousel --->
<div id="carouselExampleIndicators" class="carousel slide relative" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
        <?php
            $i = 0;
            ?>
        @foreach ($sliders as $one)
        <div class="carousel-item  @if ($i == 0) active @endif ">
            <img class=" w-100 h " src="{{ asset('storage/' . $one->img) }}" alt="1 slide" style="height: 70vh">
            @if (app()->getLocale() == 'en')
            <div class="abs w-100">
                <p class="c-w mr-0"></p>
                <h1 class=""> </h1>
                {{-- <button class=" btn btn-danger">@lang('site.shop_now') <i class="far fa-heart"></i></button> --}}
            </div> @else
            <div class="abs w-100">
                <p class="c-w mr-0"></p>
                <h1 class=""> </h1>
                {{-- <button class=" btn btn-danger">@lang('site.shop_now') <i class="far fa-heart"></i></button> --}}
            </div>
            @endif


        </div>
        <?php
                $i++;
                ?>
        @endforeach


    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon " aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!--- end head --->

<!-- basic categories -->
<div class="container ">

    <h2 class="text-center mt-5 d-flex justify-content-center">

        <div class="text-center m-auto gq gr gs dg ck dh di cn gt c1 gu gv cq p cr gw gx gy">
            <a href="{{ route('offer') }}" class="">
                <div class="text-center text-light">عرض المزيد</div>
            </a>
        </div>
        <b></b>

        <span>
            @lang('site.basic_categories')
        </span>

    </h2>


    <div class="row">



        <div class="blog-slides owl-carousel owl-one owl-theme owl-loaded owl-drag">


            <div class="owl-stage-outer">
                <div class="owl-stage"
                    style="transform: translate3d(-2280px, 0px, 0px); transition: all 0.25s ease 0s; width: 3000px;">
                    @if ($system_basic_categories->count() > 0)

                    @foreach ($system_basic_categories as $b)
                    <div class="owl-item active" style="width:200px; margin-right: 30px;">
                        <div class="single-blog-post " style="width: 250px">
                            <div class="post-image">
                                <a href="{{ route('category', [1, $b->id]) }}" class="d-block">
                                    <img src="{{ asset('/storage/' . $b->image_url) }}" alt="image">
                                </a>

                                <!-- <div class="tag">
                                        <a href="#">Management</a>
                                    </div> -->
                            </div>

                            <div class="post-content text-center">

                                <h3><a href="single-blog.html" class="d-inline-block">
                                        @if (app()->getLocale() == 'en')
                                        {{ $b->name_en }}
                                        @else
                                        {{ $b->name_ar }}
                                        @endif
                                    </a></h3>
                                {{-- <h6><a href="single-blog.html" class="d-inline-block">How to enhance education </a></h6> --}}
                                {{-- <h3><a href="single-blog.html" class="d-inline-block">120 KWD</a></h3> --}}
                                <!-- <a href="single-blog.html" class="read-more-btn">Read More <i class='bx bx-right-arrow-alt'></i></a> -->
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @endif


                </div>
            </div>
            <div class="owl-nav"><button type="button" role="presentation" class="owl-prev">
                    <span aria-label="Previous">‹</span></button><button type="button" role="presentation"
                    class="owl-next"><span aria-label="Next">›</span></button></div>

            <br>

            <br>

            <div class="owl-dots disabled"></div>
        </div>
    </div>


</div>
<!-- end basic categories -->









<!-- new arrival -->
<div class="container mt-5">

    <br>
    <h2 class="text-center  d-flex justify-content-between my-3">
        <div class="text-center m-auto gq gr gs dg ck dh di cn gt c1 gu gv cq p cr gw gx gy">
            <a href="{{ route('new') }}" class="">
                <div class="text-center text-light">@lang('site.new_in')</div>
            </a>
        </div>

        <b></b>
        <span class="">@lang('site.new_arrival')
        </span>
    </h2>

    {{-- <br class="d-none d-md-block">
        <br class="d-none d-md-block"> --}}

    {{-- <div class="col-lg-9 col-md-8 pad-0 "> --}}
    <div class="row text-center dir-rtl">
        @foreach ($new_arrive as $p)

        <div class="col-6 col-md-4 col-lg-3">
            <div class=" product relative text-dir">
                @if($p->quantity < 1 ) <div class="end-quantity">
                    @lang('site.end_quantity')
            </div>
            @endif
            <a href="{{ route('product', $p->id) }}" class="image-hover ">
                <div style="position: relative">
                    <img src="{{ asset('/storage/' . $p->img) }}"
                        onerror="this.onerror=null;this.src='{{ asset('front/img/3.jpg') }}'" width="100%"
                        class="show-img image">
                    <div class="middle">
                        <div class="btn btn-danger">@lang('site.add_to_cart')</div>
                    </div>
                    @if ($img = App\ProdImg::where('product_id', $p->id)->first())
                    <img src="{{ asset($img->img) }}" width="100%" class="hide-img image">
                    <div class="middle">
                        <div class="btn btn-danger">@lang('site.add_to_cart')</div>
                    </div>
                    @else
                    <img src="{{ asset('/storage/' . $p->img) }}" width="100%" class="hide-img image">
                    <div class="middle">
                        <div class="btn btn-danger">@lang('site.add_to_cart')</div>
                    </div>
                    @endif
                </div>
            </a>
            <p class="mr-0">
                <a href="{{ route('product', $p->id) }}">
                    @if (Lang::locale() == 'ar')
                    {{ $p->title_ar }}

                    @else

                    {{ $p->title_en }}

                    @endif


                </a>
            </p>
            <h6><a href="{{ route('product', $p->id) }}">

                    {{-- 

                    @if (Lang::locale() == 'ar')
                     {{$p->basic_category->name_ar}}
                    -
                    {{$p->category->name_ar}}
                    <?php $pieces = explode(' ', $p->description_ar);
                                    $first_part = implode(' ', array_splice($pieces, 0, 4)); ?>
                    {{ $first_part }}
                    @else

                    {{$p->basic_category->name_en}}
                    -
                    {{$p->category->name_en}}
                    <?php $pieces = explode(' ', $p->description_en);
                                    $first_part = implode(' ', array_splice($pieces, 0, 4)); ?>
                    {{ $first_part }}
                    @endif


                    --}}
                </a></h6>

            <div class="d-flex flex-column align-items-start mb-4">
                <h6 class="p-0 m-0" style="text-decoration: line-through; color: red; font-size: 0.9rem;">
                    @auth
                    {{ Auth::user()->getPrice($p->before_price) }}
                    {{ Auth::user()->country->currency->code }}
                    @endauth
                    @guest
                    @if (Cookie::get('name'))
                    {{ number_format($p->before_price / App\Country::find(Cookie::get('name'))->currency->rate, 2) }}
                    {{ App\Country::find(Cookie::get('name'))->currency->code }}
                    @else
                    {{ $p->before_price }}
                    @lang('site.kwd')
                    @endif
                    @endguest
                </h6>

                <h5 class="p-0 mt-1 mb-0">
                    @auth
                    {{ Auth::user()->getPrice($p->price) }}
                    {{ Auth::user()->country->currency->code }}
                    @endauth
                    @guest
                    @if (Cookie::get('name'))
                    {{ number_format($p->price / App\Country::find(Cookie::get('name'))->currency->rate, 2) }}
                    {{ App\Country::find(Cookie::get('name'))->currency->code }}
                    @else
                    {{ $p->price }}
                    @lang('site.kwd')
                    @endif
                    @endguest
                </h5>
            </div>
        </div>

    </div>
    @endforeach


    {{-- @else
                    <h5 style="text-align: center;margin: auto">
                        @lang('site.no_data')
                    </h5> --}}
    {{-- @endif --}}

</div>
<br>
<br>


<!-- </div> -->
<!--end new arrival -->


<!-- best selling -->
<div class="container-fluid">

    <h2 class="text-center  d-flex justify-content-between">
        <div class="text-center m-auto gq gr gs dg ck dh di cn gt c1 gu gv cq p cr gw gx gy">
            <a href="{{ route('offer') }}" class="">
                <div class="text-center text-light">عرض المزيد</div>
            </a>
        </div>

        <b></b>
        <span class="">@lang('site.best_selling')

        </span>
    </h2>

    <div class="owl-carousel owl-two owl-theme" id="one">
        @if ($best_sell->count()>0)
        @foreach ($best_sell as $b)
        <div class="item best-sell">
            <div class="row dir-rtl res-silder" style="height:45vh">
                @if($b->quantity < 1 ) <div class="end-quantity">
                    @lang('site.end_quantity')
            </div>
            @endif
            <div class="col-6 p-0 res-wid">
                <a href="{{ route('product', $b->id) }}">
                    <img src="{{ asset('/storage/' . $b->img) }}" style="width: 100%;height:100%">
                </a>
            </div>
            <div class=" col-6 p-2 text-dir m-auto">
                <h5 class="font-weight-bold ">
                    <a href="{{ route('product', $b->id) }}">
                        @if (Lang::locale() == 'ar')
                        {{ $b->title_ar }}

                        @else
                        {{ $b->title_en }}


                        @endif
                    </a>
                </h5>
                <p><a href="{{ route('product', $b->id) }}">


                        @if (Lang::locale() == 'ar')
                        {{-- {{$p->basic_category->name_ar}}
                        -
                        {{$p->category->name_ar}} --}}
                        <?php $pieces = explode(' ', $b->description_ar);
                                    $first_part = implode(' ', array_splice($pieces, 0, 4)); ?>
                        {{ $first_part }}
                        @else

                        {{-- {{$p->basic_category->name_en}}
                        -
                        {{$p->category->name_en}} --}}
                        <?php $pieces = explode(' ', $b->description_en);
                                    $first_part = implode(' ', array_splice($pieces, 0, 4)); ?>
                        {{ $first_part }}
                        @endif


                    </a></p>
                <div class="d-flex justify-content-start">
                    @if ($b->has_offer == 1)
                    <h6 class="" class="font-weight-bold  " style="text-decoration: line-through; color: red">
                        @auth()
                        {{ Auth::user()->getPrice($b->before_price) }}
                        {{ Auth::user()->country->currency->code }}
                        @endauth
                        @guest()
                        @if (Cookie::get('name'))
                        {{ number_format($b->before_price / App\Country::find(Cookie::get('name'))->currency->rate, 2) }}
                        {{ App\Country::find(Cookie::get('name'))->currency->code }}
                        <!--@lang('site.kwd')-->
                        @else
                        {{ $b->before_price }}
                        @lang('site.kwd')
                        @endif
                        @endguest
                    </h6>
                    &nbsp;
                    @endif
                    <h5 class="font-weight-bold  ">
                        @auth()
                        {{ Auth::user()->getPrice($b->price) }}
                        {{ Auth::user()->country->currency->code }}
                        @endauth
                        @guest()
                        @if (Cookie::get('name'))
                        {{ number_format($b->price / App\Country::find(Cookie::get('name'))->currency->rate, 2) }}
                        {{ App\Country::find(Cookie::get('name'))->currency->code }}
                        <!--@lang('site.kwd')-->
                        @else
                        {{ $b->price }} @lang('site.kwd')

                        @endif
                        @endguest
                    </h5>


                </div>
                <a href="{{ route('product', $b->id) }}" class="btn btn-dark text-light font-weight-bold"
                    style="background: #212529;border:none; color:white !important">
                    @lang('site.add_to_cart')
                </a>
            </div>

        </div>
    </div>
    @endforeach
    @endif


</div>
<br>

</div>

<!--end best selling -->





<!-- offers -->
@if ($offers->count() > 0)

<div class="container ">


    <h2 class="text-center  d-flex justify-content-between my-3">
        <div class="text-center m-auto gq gr gs dg ck dh di cn gt c1 gu gv cq p cr gw gx gy">
            <a href="{{ route('offer') }}" class="">
                <div class="text-center text-light">@lang('site.more')</div>
            </a>
        </div>

        <b></b>
        <span class="">@lang('site.offer')

        </span>
    </h2>


    {{-- <br class="d-none d-md-block">
        <br class="d-none d-md-block"> --}}

    {{-- <div class="col-lg-9 col-md-8 "> --}}
    <div class="row text-center dir-rtl">
        @foreach ($offers as $p)

        <div class="col-6 col-md-4 col-lg-3">
            <div class=" product relative text-dir">
                @if($p->quantity < 1 ) <div class="end-quantity">
                    @lang('site.end_quantity')
            </div>
            @endif
            {{-- <div class="  heart ">
                                    <a href="#" class="addToWishList text-white" data-product-id="{{$p->id}}">
            <i class="far fa-heart "></i>
            </a>

        </div> --}}

        <a href="{{ route('product', $p->id) }}" class="image-hover ">
            <div style="position: relative">
                <img src="{{ asset('/storage/' . $p->img) }}"
                    onerror="this.onerror=null;this.src='{{ asset('front/img/3.jpg') }}'" width="100%"
                    class="show-img image">
                <div class="middle">
                    <div class="btn btn-danger">@lang('site.add_to_cart')</div>
                </div>
                @if ($img = App\ProdImg::where('product_id', $p->id)->first())
                <img src="{{ asset($img->img) }}" width="100%" class="hide-img image">
                <div class="middle">
                    <div class="btn btn-danger">@lang('site.add_to_cart')</div>
                </div>
                @else
                <img src="{{ asset('/storage/' . $p->img) }}" width="100%" class="hide-img image">
                <div class="middle">
                    <div class="btn btn-danger">@lang('site.add_to_cart')</div>
                </div>
                @endif
            </div>
        </a>
        <p class="mr-0">
            <a href="{{ route('product', $p->id) }}">
                @if (Lang::locale() == 'ar')
                {{ $p->title_ar }}

                @else

                {{ $p->title_en }}

                @endif


            </a>
        </p>
        <h6><a href="{{ route('product', $p->id) }}">


                {{-- 

                @if (Lang::locale() == 'ar')
                 {{$p->basic_category->name_ar}}
                -
                {{$p->category->name_ar}}
                <?php $pieces = explode(' ', $p->description_ar);
                                        $first_part = implode(' ', array_splice($pieces, 0, 4)); ?>
                {{ $first_part }}
                @else

                {{$p->basic_category->name_en}}
                -
                {{$p->category->name_en}}
                <?php $pieces = explode(' ', $p->description_en);
                                        $first_part = implode(' ', array_splice($pieces, 0, 4)); ?>
                {{ $first_part }}
                @endif

                --}}
            </a></h6>
        <div class="d-flex flex-column align-items-start">
            <h6 class="p-0 m-0" style="text-decoration: line-through; color: red; font-size: 0.9rem;">


                @auth()
                {{ Auth::user()->getPrice($p->before_price) }}
                {{ Auth::user()->country->currency->code }}
                @endauth
                @guest()
                @if (Cookie::get('name'))
                {{ number_format($p->before_price / App\Country::find(Cookie::get('name'))->currency->rate, 2) }}
                {{ App\Country::find(Cookie::get('name'))->currency->code }}
                <!--@lang('site.kwd')-->
                @else
                {{ $p->before_price }}
                @lang('site.kwd')
                @endif
                @endguest

            </h6>
            <h5 class="p-0 mt-1 mb-0">


                @auth()
                {{ Auth::user()->getPrice($p->price) }}
                {{ Auth::user()->country->currency->code }}
                @endauth
                @guest()
                @if (Cookie::get('name'))
                {{ number_format($p->price / App\Country::find(Cookie::get('name'))->currency->rate, 2) }}
                {{ App\Country::find(Cookie::get('name'))->currency->code }}
                <!--@lang('site.kwd')-->
                @else
                {{ $p->price }}
                @lang('site.kwd')
                @endif
                @endguest

            </h5>

        </div>
    </div>

</div>
@endforeach


{{-- @else
            <h5 style="text-align: center;margin: auto">
                @lang('site.no_data')
            </h5> --}}
{{-- @endif --}}

</div>
<br>
<br>

{{-- </div> --}}

</div>

@endif

<!--end offers -->



<div class="container d-md-none">
    <h2 class="text-center  d-flex justify-content-between">
        <b></b>
        <span>@lang('site.fashion_world')

        </span>
        <b></b>
    </h2>

</div>
<div class="owl-carousel owl-three owl-theme">
    @foreach ($posts as $post)
    <div class="item">
        <div class=" dir-rtl max-width" style="max-width: 700px">

            <div class="row">

                <div class="col-md-12  order-md-2 align-self-end">
                    <a href="{{ route('post', $post->id) }}"><img src="{{ asset('/storage/' . $post->img1) }}"
                            alt="Image" class="img-fluid" data-pagespeed-url-hash="799042288"
                            onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                </div>
                <div class="col-md-12 ml-auto order-1 align-self-center">
                    <div class="site-block-cover-content text-center mt-2">
                        <!-- <h2 class="sub-title">#The world talk about fasion</h2> -->
                        <a href="{{ route('post', $post->id) }}">
                            @if (app()->getLocale() == 'en')
                            <h1>{{ $post->title_en }}</h1>
                            @else
                            <h1>{{ $post->title_ar }}</h1>
                            @endif
                        </a>

                        <a href="{{ route('post', $post->id) }}"
                            class="btn bg-main mt-1 mb-2">@lang('site.read_more')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @endforeach

</div>
<br>
{{-- 
<div class="text-center m-auto gq gr gs dg ck dh di cn gt c1 gu gv cq p cr gw gx gy">
    <a href="{{ route('offer') }}" class="">
<div class="text-center text-light">عرض المزيد</div>
</a>
</div>
--}}
<br>








<!-----start  --->


{{--
    <div class="country ">

        <div class="relative">

            <video class="h-100 w-100 " autoplay controls muted>
                <source src="{{asset('front/img/video.mp4')}}" type="video/mp4">
</video>
<div class="abs-shop text-center">
    <button class=" btn btn-danger close-country  ">@lang('site.shop_now') <i class="far fa-heart"></i></button>
</div>

<br>
</div>
</div> --}}














<script>
$(document).on('click', '.addToWishList', function(e) {

    e.preventDefault();
    @guest()
    // $('.not-loggedin-modal').css('display','block');
    // console.log('You are guest'

    {
        {
            --{
                {
                    \
                    RealRashid\ SweetAlert\ Facades\ Alert::error('error', 'Please Login first!')
                }
            }--
        }
    }
    Swal.fire({

        icon: '?',
        title: 'Login first!',
        //confirmButtonColor: '#212529',
        showConfirmButton: false,
        position: 'bottom-start',
        showCloseButton: true,
    })
    @endguest
    @auth
    $.ajax({
        type: 'get',
        url: "{{ route('wishlist.store') }}",
        data: {
            'productId': $(this).attr('data-product-id'),
        },
        success: function(data) {
            if (data.message) {
                Swal.fire({
                    icon: '?',
                    //confirmButtonColor: '#212529',
                    position: 'bottom-start',
                    showCloseButton: true,
                    title: 'Added successfully!',
                    showConfirmButton: false,
                    timer: 1500
                }) {
                    {
                        --{
                            {
                                \
                                RealRashid\ SweetAlert\ Facades\ Alert::error('ok', 'ok!')
                            }
                        }--
                    }
                }

            } else {
                // alert('This product already in you wishlist');
                Swal.fire({
                    icon: '?',
                    //confirmButtonColor: '#212529',
                    position: 'bottom-start',
                    showCloseButton: true,
                    title: 'This product already in you wishlist',
                    showConfirmButton: false,
                    timer: 1500
                })

                {
                    {
                        --{
                            {
                                \
                                RealRashid\ SweetAlert\ Facades\ Alert::error('no',
                                    'this product added already!')
                            }
                        }--
                    }
                }

            }
        }
    });
    @endauth


});
</script>
@endsection
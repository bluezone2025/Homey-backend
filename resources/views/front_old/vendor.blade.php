@extends('layouts.layout2')
@section('title', $records->name)

@section('style')


    <style>
        h1.title-section {
            width: 300px;
            border-bottom: 1px solid #000000;
            padding: 10px;
            margin: 10px;
        }
        .card .abs {
            position: absolute;
            right: 220px ;
            top: 212px ;
            height: 25px !important;
            width: 55px;
            font-size: small !important;
            padding: 6px;
            color: #fff
        }


    </style>
@endsection
@section('content')


    <main id="content">
        <section class="py-2 bg-gray-2">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                        <li class="breadcrumb-item"><a class="text-decoration-none text-body"
                                                       href="{{ route('home') }}">@lang('site.index')</a>
                        </li>
                        <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">{{ $records->name }}
                        </li>
                    </ol>
                </nav>
            </div>
        </section>


        <section>
            <div class="container container-xl">
                <h4 class="mt-3 mt-lg-4 mb-lg-4">@lang('site.products')</h4>
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <p class="fs-18 font-weight-500 my-lg-0 my-2" style="color: #696969;"><strong
                                class="font-weight-bold text-secondary">{{ $populars->total() }}</strong>
                        @lang('site.product')
                    </p>
                    <div class="d-flex align-items-center">
                        <div class="dropdown show lh-1 rounded ml-lg-5 ml-0" style="background-color:#f5f5f5">
                            <a href="#"
                               class="dropdown-toggle custom-dropdown-toggle text-decoration-none text-secondary p-3 mw-210 position-relative d-block"
                               id="dropdownMenuButton" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                @lang('site.Basic arrangement')
                            </a>
                            <div class="dropdown-menu custom-dropdown-item" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">@lang('site.Highest price then lowest')</a>
                                <a class="dropdown-item" href="#">@lang('site.Lowest price then highest')</a>
                                <a class="dropdown-item" href="#">@lang('site.mixed')</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="mt-2 mt-md-7 prods">
            <div class="container container-xl">
                <div class="row mb-3">
                    @if ($populars->count() >= 1)
                        @foreach ($populars as $one)
                            <div class="col-lg-3 col-xl-3 col-md-4 col-6 mb-3  mobile_pad"   >

                                <div class="card border-0 product">
                                    <a href="{{route("product",$one->id)}}">
                                        <div class="position-relative">
                                        <img src="{{asset('assets/images/products/min/'.$one->img)}}" class="imageSize"
          >
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
                                        </div>
                                    </div>
                                    </a>
                                    <div class="card-body pt-4 text-center m-auto m-md-1 d-block  justify-content-between align-items-center">
                                        <h2 style="height: 50px" class="card-title fs-15 font-weight-500 "><a href="{{route("product",$one->id)}}">{{$one->name}}</a></h2>
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
                                                <span class="fs-20 mx-2">@lang('buy_now')</span>
                                                <svg class="icon icon-shopping-bag-open-light fs-22">
                                                    <use xlink:href="#icon-shopping-bag-open-light"></use>
                                                </svg>
                                            </a>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </section>
{{--        <section class="pb-lg-14 pb-11">--}}
{{--            <nav class="pt-2">--}}
{{--                <ul class="pagination justify-content-center align-items-center mb-0 fs-16 font-weight-600">--}}
{{--                    {{ $populars->appends(request()->query())->links() }}--}}
{{--                </ul>--}}
{{--            </nav>--}}
{{--        </section>--}}
    </main>

    {{--
    <div class=" container d-md-flex d-none subcats">
        @if (count($subCategories_header) > 0)
            @foreach ($subCategories_header as $sub)
                <div class="item @if ($id == $sub->id) bg-brown @endif">
                    <a href="{{ route('vendor', $sub->id) }}">{!! $sub['name_' . app()->getlocale()] !!}</a>
                </div>
            @endforeach
        @endif



    </div>
    <header class="container  border-main">
        <ul class="nav product">
            <li class="nav-item  "> <a class="nav-link  " href="{{ url('/') }}"> {{ __('site.index') }} </a>
            </li>
            <li class="nav-item  "> <a class="nav-link  "> <i class="fas fa-arrow-left "
                                                              style="font-size: 20px"></i></a>
            </li>
            @if ($records->parent_id != 0)
                <li class="nav-item "> <a class="nav-link   " href="{{ route('vendor', $ParentCategory->id) }}">
                        {{ $ParentCategory['name_' . app()->getlocale()] }} </a>
                </li>
                <li class="nav-item  "> <a class="nav-link  "> <i class="fas fa-arrow-left "
                                                                  style="font-size: 20px"></i></a>
                </li>
            @endif

            <li class="nav-item "> <a class="nav-link   " href=""> {{ $records->name }} </a>
            </li>
        </ul>

    </header>

    <div class="container  ">
        <div class="row  ">
            <div class="col-md-12 col-12">
                <div class="row  ">
                    <br>
                    <div class="col-12" style="padding: 10px;
                        ">
                        <h1 class=" title-section">@lang('site.all products') </h1>
                    </div>
                    @if ($populars->count() >= 1)
                        @foreach ($populars as $one)
                            <div class=" col-6 col-md-4 col-lg-3 mb-5 ">
                                <div class="card" >
                                    {!! $one->if_sale ? '<h6 class="bg-main abs">' . round($one->discount_percentage, 1, PHP_ROUND_HALF_DOWN) . '%</h6>' : '' !!}
                                    <a href="{{ route('product', ['id' => $one->id, 'sub' => $id]) }}">
                                        <div class="h-resp" style="height:38vh;overflow:hidden">
                                            <img style="width: 100%;
                                                  display: block;
                                                    margin-left: auto;
                                                    margin-right: auto;"
                                                 src="{{ asset('assets/images/products/min/' . $one->img) }}"
                                                 class="card-img-top  " alt="...">
                                        </div>

                                    </a>
                                    <div class="card-body text-center">
                                        <a href="{{ route('product', ['id' => $one->id, 'sub' => $id]) }}"
                                           class="card-text ">{{ \Illuminate\Support\Str::limit($one->name, 14, '...') }}</a>
                                        <p class="card-title" href="">
                                            @if ($one->if_sale)
                                                <b>{{ get_price_helper($one->sale_price,true) }}</b>
                                                <span class="regular_price">{{ get_price_helper($one->regular_price,true) }}
                                                </span>
                                            @else
                                                <b>{{ get_price_helper($one->regular_price,true) }}</b>
                                            @endif


                                        </p>

                                    </div>
                                    <div class="row mr-0">
                                        <a href="{{ route('add.cart', [$one->id, 1]) }}"
                                           class="btn btn-dark border col-9">@lang('site.add to cart')</a>
                                        <div class="btn btn-light border col-3 heart text-center">
                                            <i class="far fa-heart  heart-block"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-light w-100 text-center" role="alert">
                            <h4>{{ __('site.notproducthere') }}</h4>
                        </div>
                    @endif
                </div>
                <br>
                {{ $populars->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    --}}

@stop


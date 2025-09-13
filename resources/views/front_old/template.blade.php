@extends('layouts.layout')
@section('title', $name)
@section('pixel')
    snaptr('track', PAGE_VIEW, {'item_ids': ['INSERT_ITEM_ID_1', 'INSERT_ITEM_ID_2'], 'item_category': 'INSERT_ITEM_CATEGORY', 'uuid_c1': 'INSERT_UUID_C1', 'user_email': 'INSERT_USER_EMAIL', 'user_phone_number': 'INSERT_USER_PHONE_NUMBER', 'user_hashed_email': 'INSERT_USER_HASHED_EMAIL', 'user_hashed_phone_number': 'INSERT_USER_HASHED_PHONE_NUMBER'})
@endsection
@section('content')


    <section class="py-2 bg-gray-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                    <li class="breadcrumb-item"><a class="text-decoration-none text-body"
                                                   href="{{ route('home') }}">@lang('site.index')</a>
                    </li>
                    <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">{{ $name }}
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="container  border-main">

                    <br>
                    <section class="mt-2 mt-md-7 prods">
                        <div class="container container-xl">
                            <div class="row mb-3">
                    @if ($populars->count() >= 1)
                        @foreach ($populars as $one)
                            <div class="col-lg-3 col-xl-3 col-md-4 col-6 mb-3 mobile_pad"   >

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

                    @else
                        <div class="alert alert-light w-100 text-center" role="alert">
                            <h4>{{ __('site.notproducthere') }}</h4>
                        </div>
                    @endif
                            </div>
                        </div>
                    </section>

{{--                {{ $populars->appends(request()->query())->links() }}--}}
            </div>


@stop
@section('js')
@endsection

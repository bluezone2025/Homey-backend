<!doctype html>
<html lang="ar">
<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@lang('site.Checkout_t')</title>
    <!-- Favicons -->
    <!-- <link rel="icon" href="images/favicon.jpg"> -->
    <link rel="icon" type="image/png" href="{{asset('assets/design')}}/images/favicon.ico">

    <!-- Css files -->
    <link rel="stylesheet" href="{{asset('new_design')}}/css/libs/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="{{asset('new_design')}}/css/libs/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{asset('new_design')}}/css/libs/owl.theme.default.min.css" />
    <link rel="stylesheet" href="{{asset('new_design')}}/css/libs/all.min.css" />

    @if(app()->getLocale()=="ar")
        <link rel="stylesheet" href="{{asset('new_design')}}/css/ar/style.css" />
    @else
        <link rel="stylesheet" href="{{asset('new_design')}}/css/en/style.css" />

    @endif
    <link rel="stylesheet" href="{{asset('new_design')}}/css/main.css" />


    <style>
        @font-face  {
            font-family:  "Font Awesome 6 Brands";
            font-style:  normal;
            font-weight:  400;
            font-display:  block;
            src:  url( '{{asset('new_design/webfonts/fa-brands-400.woff2')}}' ) format("woff2")
            ,  url('{{asset('new_design/webfonts/fa-brands-400.ttf')}}') format("truetype")
        }


        :host,  :root  {
            --fa-font-regular:  normal 400 1em/1 "Font Awesome 6 Free" }
        @font-face  {
            font-family:  "Font Awesome 6 Free";
            font-style:  normal;
            font-weight:  400;
            font-display:  block;
            src:  url( '{{asset('new_design/webfonts/fa-regular-400.woff2')}}' ) format("woff2")
            ,  url('{{asset('new_design/webfonts/fa-regular-400.ttf')}}') format("truetype")
        }
        .fa-regular,  .far  {
            font-weight:  400 }
        :host,  :root  {
            --fa-style-family-classic:  "Font Awesome 6 Free";
            --fa-font-solid:  normal 900 1em/1 "Font Awesome 6 Free" }
        @font-face {
            font-family: "Font Awesome 6 Free";
            font-style: normal;
            font-weight: 900;
            font-display: block;
            src: url('{{asset('new_design/webfonts/fa-solid-900.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-solid-900.ttf')}}') format("truetype")
        }
        .fa-solid,  .fas  {
            font-weight:  900 }
        @font-face  {
            font-family:  "Font Awesome 5 Brands";
            font-display:  block;
            font-weight:  400;
            src: url('{{asset('new_design/webfonts/fa-brands-400.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-brands-400.ttf')}}') format("truetype")
        }

        @font-face  {
            font-family:  "Font Awesome 5 Free";
            font-display:  block;
            font-weight:  900;
            src: url('{{asset('new_design/webfonts/fa-solid-900.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-solid-900.ttf')}}') format("truetype")
        }
        @font-face  {
            font-family:  "Font Awesome 5 Free";
            font-display:  block;
            font-weight:  400;
            src: url('{{asset('new_design/webfonts/fa-regular-400.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-regular-400.ttf')}}') format("truetype")
        }
        @font-face  {
            font-family:  "FontAwesome";
            font-display:  block;
            src: url('{{asset('new_design/webfonts/fa-solid-900.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-solid-900.ttf')}}') format("truetype")
        }
        @font-face  {
            font-family:  "FontAwesome";
            font-display:  block;
            src: url('{{asset('new_design/webfonts/fa-brands-400.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-brands-400.ttf')}}') format("truetype")
        }
        @font-face  {
            font-family:  "FontAwesome";
            font-display:  block;
            src: url('{{asset('new_design/webfonts/fa-regular-400.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-regular-400.ttf')}}') format("truetype");
            unicode-range:  u+f003,  u+f006,  u+f014,  u+f016-f017,  u+f01a-f01b,  u+f01d,  u+f022,  u+f03e,  u+f044,  u+f046,  u+f05c-f05d,  u+f06e,  u+f070,  u+f087-f088,  u+f08a,  u+f094,  u+f096-f097,  u+f09d,  u+f0a0,  u+f0a2,  u+f0a4-f0a7,  u+f0c5,  u+f0c7,  u+f0e5-f0e6,  u+f0eb,  u+f0f6-f0f8,  u+f10c,  u+f114-f115,  u+f118-f11a,  u+f11c-f11d,  u+f133,  u+f147,  u+f14e,  u+f150-f152,  u+f185-f186,  u+f18e,  u+f190-f192,  u+f196,  u+f1c1-f1c9,  u+f1d9,  u+f1db,  u+f1e3,  u+f1ea,  u+f1f7,  u+f1f9,  u+f20a,  u+f247-f248,  u+f24a,  u+f24d,  u+f255-f25b,  u+f25d,  u+f271-f274,  u+f278,  u+f27b,  u+f28c,  u+f28e,  u+f29c,  u+f2b5,  u+f2b7,  u+f2ba,  u+f2bc,  u+f2be,  u+f2c0-f2c1,  u+f2c3,  u+f2d0,  u+f2d2,  u+f2d4,  u+f2dc

        }
        @font-face  {
            font-family:  "FontAwesome";
            font-display:  block;
            src: url('{{asset('new_design/webfonts/fa-v4compatibility.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-v4compatibility.ttf')}}') format("truetype");
            unicode-range:  u+f041,  u+f047,  u+f065-f066,  u+f07d-f07e,  u+f080,  u+f08b,  u+f08e,  u+f090,  u+f09a,  u+f0ac,  u+f0ae,  u+f0b2,  u+f0d0,  u+f0d6,  u+f0e4,  u+f0ec,  u+f10a-f10b,  u+f123,  u+f13e,  u+f148-f149,  u+f14c,  u+f156,  u+f15e,  u+f160-f161,  u+f163,  u+f175-f178,  u+f195,  u+f1f8,  u+f219,  u+f27a
        }


        @font-face { font-family: ArbFONTS; src: url('{{asset('new_design/ArbFonts.com/ArbFONTS-Somar-Regular.otf')}}'); }
        @font-face { font-family: ArbFONTS-B; font-weight: bold; src: url('{{asset('new_design/ArbFonts.com/ArbFONTS-Somar-Bold.otf')}}');}

        label{
            text-transform: capitalize;
        }
    </style>

    @if(app()->getLocale()=="ar")
        <style>
            label,option,select{
                font-size: 1.4rem;
            }
            input::placeholder,select::placeholder{
                font-size: 1.2rem;
            }
            .price-number{
                font-size:1.6rem ;
            }
        </style>
    @endif

</head>
<body>

<header>
    <div class="container-fluid">
        <div class="row justify-content-between text-center">
            <div class="col-12 pb-3">
                <div class="d-flex align-items-center justify-content-center">
                    <a href="{{route('home')}}" class="logo">
                        <img src="{{asset('new_design')}}/images/logo.png" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<main id="content" >
    <section class="sec-title1">
        <div class="container">
            <div class="col-md-8 d-flex">
          <span
          ><a href="{{ route('home') }}">@lang('site.index')</a></span
          >
                <span class="mx-2"><b>/</b></span>
                <b><span>@lang('site.Checkout_t')</span></b>
            </div>
        </div>
    </section>
    <section class="my-5 checkout">
        <div class="container">
            <form  class="my-4" method="post" name="checkout" action="{{route("checkout.store")}}" id="main-form">
                @csrf
                <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                @if(Auth::guard('web')->check())

                                @else
                                    <h4 class="d-flex text-center">
                                        @lang('site.Repeat customer?')
                                        <a href="{{route('login/client')}}" class="ms-2" style="color: #a88e31;">  @lang('site.Click here to log in')</a>
                                    </h4>
                                @endauth

                            </div>
                            <div class="d-flex btn-head mb-3">
                                <button type="button" id="by-address-tab" class="btn tabs-checkout active" data-tab="one">@lang('site.Delivery to the address')</button>
                                <button type="button" id="by-phone-tab" class="btn tabs-checkout ms-3 btn-outline-primary" data-tab="two">@lang('site.Phone Delivery')</button>
                            </div>

                                @csrf
                                @if(session('error'))
                                    <div class="alert alert-danger text-center" style="width: 60%; margin-left: 15%;">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (Session::has('success-add'))
                                    <div class="alert alert-success text-center">
                                        <ul>
                                            <li>{!! \Session::get('success-add') !!}</li>
                                        </ul>
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger" style="width:100%">
                                        <ul>
                                            @foreach ($errors->all() as $key=>$error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="tab-hidden active" id="one">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="delivered_by" value="address" class="by-address-field">

                                            <label for="user">{{__('site.full name')}}<span style="color: #f00;">*</span></label>
                                            <input type="text" name="username" class="by-address-field"
                                                   placeholder="{{__('site.full name')}}" required="required">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="user">{{__('site.Phone')}}<span style="color: #f00;">*</span></label>
                                            <input type="text" name="phone2" class="by-address-field"
                                                   placeholder="{{__('site.Phone')}}" required="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="user">{{__('site.Email address')}}<span style="color: #f00;">*</span></label>
                                            <input type="email" name="email" class="by-address-field"
                                                   placeholder="{{__('site.Email address')}}" required="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="user">{{__('site.country')}}<span style="color: #f00;">*</span></label>

                                            <select  style="margin-bottom: 3px !important;"
                                                name="country"  id="Orders_city_id" required class="by-address-field">
                                                @foreach(\App\Models\Country::get() as $country)
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="region">{{__('site.city')}}<span style="color: #f00;">*</span></label>

                                            <select style="margin-bottom: 3px !important;"
                                                name="city"  id="test"  required class="by-address-field">
                                                <option value="">{{__('site.city')}}</option>
                                            </select>
                                            <div style="color: red !important; font-size: 12px !important;" id="test1"></div>

                                        </div>
                                        <div class="col-md-6">
                                            <label for="region">{{__('site.region')}}<span style="color: #f00;">*</span></label>
                                            <input type="text" id="region" class="by-address-field"
                                                   placeholder="{{__('site.region')}}" name="region" required="">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="piece">{{__('site.piece')}}<span style="color: #f00;">*</span></label>
                                            <input type="text" id="piece" class="by-address-field"
                                                   placeholder="{{__('site.piece')}}" name="piece" required="required">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="street">{{__('site.street')}}<span style="color: #f00;">*</span></label>
                                            <input class="by-address-field" type="text" placeholder="{{__('site.street')}}" name="street" required="">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="avenue">{{__('site.avenue')}}<span style="color: #f00;">*</span></label>
                                            <input class="by-address-field" type="text" placeholder="{{__('site.avenue')}}" name="avenue" required="" id="avenue">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="home">{{__('site.flat_number')}}<span style="color: #f00;">*</span></label>
                                            <input class="by-address-field" type="text" placeholder="{{__('site.flat_number')}}" name="flat_number" required="" id="home">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="floor">{{__('site.house_number')}}<span style="color: #f00;">*</span></label>
                                            <input class="by-address-field" type="text" placeholder="{{__('site.house_number')}}" name="house_number" required="" id="floor">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="flat">{{__('site.floor')}}<span style="color: #f00;">*</span></label>
                                            <input class="by-address-field" type="text" placeholder="{{__('site.floor')}}" name="floor" required="" id="flat">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="street-address">{{__('site.address')}}<span style="color: #f00;">*</span></label>
                                            <input class="by-address-field" type="text" id="street-address" placeholder="{{__('site.address')}}"
                                                   name="address" required="">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="notice">
                                                {{__('site.Order notes (optional)')}}
                                            </label>
                                            <input type="text" id="notice" placeholder=" {{__('site.Order notes (optional)')}}"
                                                   name="notes">
                                        </div>
    {{--                                    <div class="col-md-12 d-flex btns">--}}
    {{--                                        <button class="btn btn-black me-3">{{__('site.save')}}</button>--}}
    {{--                                        <button class="btn btn-white">Cancel</button>--}}
    {{--                                    </div>--}}
                                    </div>
                                </div>
                                <div class="tab-hidden" id="two">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="delivered_by" value="phone" class="by-phone-field">

                                            <label for="first-name">{{__('site.full name')}}<span style="color: #f00;">*</span></label>
                                            <input type="text" id="first-name" name="username" class="by-phone-field"
                                                   placeholder="{{__('site.full name')}}" required="required">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="user">{{__('site.Phone')}} <span style="color: #f00;">*</span></label>
                                            <input type="text"  name="phone1" class="by-phone-field"
                                                   placeholder="{{__('site.Phone')}} ">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="user">{{__('site.country')}}<span style="color: #f00;">*</span></label>
                                            <select style="margin-bottom: 3px !important;"
                                                name="country" id="Orders_city_id2" required class="by-phone-field">
                                                @foreach(\App\Models\Country::get() as $country)
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="region">{{__('site.city')}}<span style="color: #f00;">*</span></label>
                                            <select  style="margin-bottom: 3px !important;" id="test2"  required class="by-phone-field" name="city" >
                                                <option value="">{{__('site.city')}}</option>
                                            </select>
                                            <div style="color: red !important; font-size: 12px !important;" id="test11"></div>

                                        </div>
                                        <div class="col-md-12">
                                            <label for="notice">
                                                {{__('site.Order notes (optional)')}}
                                            </label>
                                            <input type="text" id="notice" placeholder=" {{__('site.Order notes (optional)')}}"
                                                   name="notes">
                                        </div>
    {{--                                    <div class="col-md-12 d-flex btns">--}}
    {{--                                        <button class="btn btn-black me-3">Save</button>--}}
    {{--                                        <button class="btn btn-white">Cancel</button>--}}
    {{--                                    </div>--}}
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-5 me-auto">
                            <div class="checkout-left">

                                <h3>@lang('site.Order details')
                                    {{' ('.count( session('cart') ).' '.trans('site.products') .' )'}}
                                </h3>

                                <div class="checkout-inner">
                                    <?php $total=0 ; $order_is_order = 0;?>
                                    @if(session('cart'))
                                        @foreach(session('cart') as $key => $details)
                                                @php
                                                    $product = \App\Models\Product::find($details['id']);
                                                    $variant = isset($details['variant_id']) ? \App\Models\ProductVariant::find($details['variant_id']) : null;


                                                    // Get the correct price
                                                    if ($product->has_paid_variant){

                                                        $price = $variant ? ($variant->discount_price ?: $variant->price) : ($product->if_sale ? $product->final_sale_price : $product->final_regular_price);

                                                    }else{
                                                           $price = $product->sale_price ? $product->final_sale_price : $product->final_regular_price;
                                                    }
                                                    $total += $price * $details['quantity'];


                                                    $prices[] = $price;

                                                    if($order_is_order != 1 && $product->is_order == 1) {
                                                        $order_is_order = 1;
                                                    }
                                                @endphp

                                                <input type="hidden" name="product_ids[]" value="{{$product->id}}">
                                                @if($variant)
                                                    <input type="hidden" name="variant_ids[]" value="{{$variant->id}}">
                                                @endif
                                                <input type="hidden" name="quantities[]" value="{{$details['quantity']}}">

                                                @if($order_is_order != 1 && $product -> is_order ==1)
                                                    <?php $order_is_order = 1;?>
                                                @endif

                                                    <div class="checkout-items d-flex justify-content-between align-items-center">
                                                        <input type="hidden" name ="product_ids[]" value="{{$product->id}}">

                                                        <div class="d-flex align-items-center">
                                                            <img src="{{asset('assets/images/products/min/'.$product->img)}}" alt="product_01">
                                                            <a href="{{route("product",$product->id)}}">
                                                                {!!\Illuminate\Support\Str::limit($product->name, 30, '..')!!}
{{--                                                                {{$product->name}}--}}
                                                            </a>
{{--                                                            <p class="fs-14 text-secondary mb-0 mt-1">QTY:<span--}}
{{--                                                                    class="text-body"> {{$details['quantity']}}</span></p>                              --}}

                                                            @if(isset($details['attributes']))
                                                                <span class="variant-attributes">
                                                                    @foreach($details['attributes'] as $attrId => $optId)
                                                                        <?php
                                                                        $attribute = \App\Models\Attribute::find($attrId);
                                                                        $option = \App\Models\Option::find($optId);
                                                                        ?>
                                                                        @if($attribute && $option)
                                                                                @if($loop->first)
                                                                                    <span class="mx-1">-</span>
                                                                                @endif
                                                                                <span class="variant-attribute" >
                                                                                      {{ $option->name_ar }}
                                                                                </span>
                                                                                @if(!$loop->last)
                                                                                    <span class="mx-1">-</span>
                                                                                @endif

                                                                        @endif
                                                                    @endforeach
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="text-left">
                                                            <p class="price price-number" >
                                                                <span style="color: #a88e31; font-weight: bold">
                                                                    {{$details['quantity']}}
                                                                </span>
                                                                <span>x</span>
                                                                <span>
                                                                    {{get_price_helper($price,true)}}
                                                                </span>
                                                                @php
                                                                    //dd($details['price'], $details['quantity']);
                                                                      $sum = $details['price'] * $details['quantity'];
                                                                    //dd($sum);

                                                                @endphp
{{--                                                                {{get_price_helper($sum,true)}}--}}
                                                            </p>
                                                        </div>
                                                    </div>
                                        @endforeach
                                    @endif
                                </div>
                                <!-- Add this inside your checkout-left section, after the order details -->
                                <div class="cupon py-4">
                                    <label for="cupon">{{__('site.apply_coupon')}}</label>
                                    <div class="d-flex mt-2 align-items-center justify-content-between">
                                        <input type="text" name="coupon_code" id="coupon_code" class="form-control" style="margin-bottom: 0!important;"
                                               placeholder="@lang('site.Discount Code*')">
                                        <button type="button" id="apply_coupon" class="btn btn-black ms-3">{{__('site.apply')}}</button>
                                    </div>
                                    <div id="coupon_message" class="mt-2" style="font-size: 14px;"></div>
                                </div>

                                <div class="price-number d-flex justify-content-between align-items-center py-3 mb-4" style="border-top: 1px solid #f1f1f1;border-bottom: 1px solid #f1f1f1;">
                                    <span>{{__('site.SUBTOTAL')}}:</span>

                                    <span id="subtotal">{{get_price_helper($total,true)}}</span>
                                </div>
                                <!-- Add discount row -->
                                <div id="discount_row" class="price-number d-flex justify-content-between align-items-center my-2" style="display: none !important;">
                                    <span>{{__('site.Discount')}}:</span>
                                    <span id="discount_amount" style="color: #a88e31;">-{{get_price_helper(0,true)}}</span>
                                </div>

                                {{--                                <div class="d-flex justify-content-between align-items-center">--}}
{{--                                    <span style="color: #a88e31;">Discount</span>--}}
{{--                                    <span style="color: #a88e31;">-15.37 KWD</span>--}}
{{--                                </div>--}}
                                <div class="price-number d-flex justify-content-between align-items-center my-2">
                                    <span>{{__('site.Shipping')}} :</span>
                                    <span id="test3">{{get_price_helper(0)}}</span>
                                </div>
                                <div class="price-number d-flex justify-content-between align-items-center">
                                    <span>{{__('site.ORDER TOTAL')}}:</span>
                                    <span id="total_show">{{get_price_helper(round($total,1),true)}}</span>
                                </div>
                                <div id="TabbyPromo"></div>
                                <input type="hidden" name ="price" id="total" value = {{get_price_helper2($total,true)}}>
                                <!-- Add hidden fields for coupon data -->
                                <input type="hidden" name="applied_coupon" id="applied_coupon" value="">
                                <input type="hidden" name="discount_value" id="discount_value" value="0">
                                @if(\Auth::guard("web"))
                                    <input type="hidden" name ="user_id" value = '{{\Auth::guard("web")->user()->id??""}}' >
                                @else
                                    <input type="hidden" name ="user_id" value ="0" >
                                @endif
                                <h4 class="text-center my-5 pb-3">{{__('site.Choose Your Payment Method')}}</h4>
                                <div class="d-flex">
                                    <div>
                                        <input type="radio" name="type" value="cash" checked="checked" id="pay1">
                                        <label for="pay1"> @lang('site.Cash on delivery')</label>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div>
                                        <input type="radio" name="type" value="knet" checked="checked" id="pay2">
                                        <label for="pay2">@lang('site.Payment by Visa/Master')</label>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div>
                                        <input type="radio" name="type" value="pay_with_tabby" id="pay3">
                                        <label for="pay3">
                                            <img style="width: 40px" src="{{asset('assets/design')}}/images/tabby.png"/>

                                            @lang('site.Divide it by 4. No interest, no fees.')
                                        </label>
                                    </div>
                                </div>
                                @if(auth('web')->check())
                                    @php

                                        $userWithWallets = \App\Models\User::where('id', auth('web')->id()) // Filter to get only user with ID 1
                                            ->whereHas('wallets') // Ensure user has wallets
                                            ->with(['wallets' => function ($query) {
                                                $query->select('user_id',
                                                               DB::raw("SUM(CASE WHEN wallet_type = 'deposit' THEN amount ELSE 0 END) as total_deposit"),
                                                              DB::raw("SUM(CASE WHEN wallet_type = 'withdraw' THEN amount ELSE 0 END) as total_withdraw"))
                                                      ->groupBy('user_id');
                                            }])
                                            ->first(); // Retrieve the single result for user 1

                                        // Accessing the total deposit and withdraw values
                                         if ($userWithWallets){

$totalDeposit = $userWithWallets->wallets->first()->total_deposit ?? 0;
$totalWithdraw = $userWithWallets->wallets->first()->total_withdraw ?? 0;
}else{

$totalDeposit = 0;
$totalWithdraw = 0;
}
                                    @endphp
                                    <div class="d-flex">
                                       <div>
                                           <input type="radio" id="buy-13" name="type" value="pay_with_wallet">
                                           <label  for="buy-13">


                                               {{__('site.Pay from Wallet')}}


                                               (
                                               {{ $totalDeposit - $totalWithdraw }})

                                           </label>
                                       </div>
                                    </div>
                                @else
                                    <div class="d-flex">
                                       <div>
                                           <input type="radio" id="buy-13" name="type" value="pay_with_wallet" c>
                                           <label  for="buy-13">
                                               {{__('site.Pay from Wallet')}}
                                           </label>
                                       </div>
                                    </div>
                                @endif

                                <div class="d-flex mt-4">
                                    <div>
                                        <input type="radio" name="saved" id="pay4" checked> <label for="pay4" style="color: #a88e31;">
                                            {{__('site.Agree to Terms and Conditions')}}
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-black">@lang('site.Fulfill the request')</button>
                            </div>
                        </div>
                </div>
            </form>

        </div>
    </section>
</main>




<div class="py-3" style="background-color: #f1f1f1">
    <div class="container">
        <div class="row text-center">
            <div class=" col-12">
                <p>2025 &copy; Trendat</p>
            </div>
        </div>
    </div>
</div>

<!-- Js files -->
<script src="{{asset('new_design')}}/js/libs/jquery-3.7.1.min.js"></script>
<script src="{{asset('new_design')}}/js/checkout.js"></script>

    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>
    @if (session('error'))

        <script>
       const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })
                    Toast.fire({
                        icon: 'error',
                        title: "{{ session()->get('error') }}",


                    })
    </script>
    @endif
    @if (session('success'))

        <script>
       const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })
                    Toast.fire({
                        icon: 'success',
                        title: "{{ session()->get('success') }}",


                    })
    </script>
    @endif
    @if(session('cart'))
        <?php
        $total = get_price_helper2($total??0,true);
        $currency_en = "KWD";
        ?>
    @else
        <?php
        $total = 0;
        $currency_en = "KWD";

        ?>
    @endif

    <script src="https://checkout.tabby.ai/tabby-promo.js"></script>
    <script>
        new TabbyPromo({
            selector: '#TabbyPromo', // required, content of tabby Promo Snippet will be placed in element with that selector.
            currency: "{{$currency_en}}", // required, currency of your product. AED|SAR|KWD|BHD|QAR only supported, with no spaces or lowercase.
            price: "{{($total)}}", // required, price or the product. 2 decimals max for AED|SAR|QAR and 3 decimals max for KWD|BHD.
            installmentsCount: 4, // Optional, for non-standard plans.
            lang: "{{app()->getLocale()}}", // Optional, language of snippet and popups, if the property is not set, then it is based on the attribute 'lang' of your html tag.
            source: 'product', // Optional, snippet placement; `product` for product page and `cart` for cart page.
            publicKey: 'pk_01900622-e193-bf61-1422-411fc5df05f3', // required, store Public Key which identifies your account when communicating with tabby.
            merchantCode: 'trendatkwt'  // required
        });
    </script>

      <script>

          $(document).ready(function () {



          })



      </script>

<script>
        $(document).ready(function() {
            var activeTab = 'address'; // Default to By Address

            // Handle tab click events
            $('#by-address-tab').on('click', function() {
                activeTab = 'address';
                $('.by-address-field').attr('required', true);

{{--                alert('address');--}}
                $('.by-phone-field').removeAttr('required');
            });

            $('#by-phone-tab').on('click', function() {
                activeTab = 'phone';
                $('.by-phone-field').attr('required', true);

{{--                                alert('phone');--}}

                $('.by-address-field').removeAttr('required');
            });

            $('.by-phone-field').removeAttr('required');

            // Handle form submission
                $('#main-form').on('submit', function(event) {
                    //alert('s');
                    // Prevent default form submission
                    event.preventDefault();

                    // Remove fields that are not relevant to the active tab
                    if (activeTab === 'address') {
                    console.log('address');
                        $('.by-phone-field').remove();
                    } else if (activeTab === 'phone') {
                                        console.log('phone');

                        $('.by-address-field').remove();

                    }

                    // Now submit the form with only the relevant fields
                    this.submit();
                });




    });

        $(document).ready(function() {

            console.log('ok');

            getCity();
            getCity2();


            $('#Orders_city_id').on('change',
                function () {
                    getCity();
                }
            )

            $('#Orders_city_id2').on('change',
                function () {
                    getCity2();
                }
            )
            $('#test').on('change',
                function () {
                    getDelivery();
                }
            )


            $('#test2').on('change',
                function () {
                    getDelivery2();
                }
            )


            function getCity() {
                var city =  $('#Orders_city_id').val() ? $('#Orders_city_id2').val():1;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('get.city') }}",
                    method: 'post',
                    data:{
                        _token: "{{ csrf_token() }}",
                        city : city
                    },
                    success: function(result){

                        // console.log(result);
                        if(!result.success)
                        {
                            Swal.fire({
                                icon: 'error',
                                title: result.msg,
                            });

                        } else {

                            // alert(result.delivery);
                            //                            $('#Orders_city_id').html(result.cities)
                            $('#test').html(result.delivery);
                            getDelivery();
                            //                        $('#test1').html(result.val11)
                        }

                    },
                    error:function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'لم تكتمل العمليه ',
                        })
                    }
                });

            }

            function getCity2() {
                var city =  $('#Orders_city_id2').val() ? $('#Orders_city_id2').val():1;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('get.city') }}",
                    method: 'post',
                    data:{
                        _token: "{{ csrf_token() }}",
                        city : city
                    },
                    success: function(result){

                        // console.log(result);
                        if(!result.success)
                        {
                            Swal.fire({
                                icon: 'error',
                                title: result.msg,
                            });

                        } else {

                            // alert(result.delivery);
                            //                            $('#Orders_city_id').html(result.cities)
                            $('#test2').html(result.delivery);
                            getDelivery2();
                            //                        $('#test1').html(result.val11)
                        }

                    },
                    error:function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'لم تكتمل العمليه ',
                        })
                    }
                });

            }




            function getDelivery() {
                var city =  $('#test').val() ? $('#test').val():1;
                var product_ids  = $("input[name='product_ids[]']")
                    .map(function(){return $(this).val();}).get();
                var total =  $('#total').val() ? $('#total').val():0;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('get.delivery') }}",
                    method: 'post',
                    data:{
                        _token: "{{ csrf_token() }}",
                        city : city,
                        total:total,
                        product_ids : product_ids,
                    },
                    success: function(result){

                        // console.log(result);
                        if(!result.success)
                        {
                            Swal.fire({
                                icon: 'error',
                                title: result.msg,
                            })
                        } else {

                            //   alert(result.order_day);
                            //                            $('#Orders_city_id').html(result.cities)
                            $('#test1').html(result.delivery)
                            $('#test3').html(result.delivery1)
                            $('#total_show').html(result.total1)
                            $('#total').html(result.total1)
                            $('#order_day').html(result.order_day)

                            // 👇 Save shipping cost globally for coupons
                            shippingCost = result.shipping_cost ?? 0;
                            shippingCost = parseFloat(result.shipping_cost ?? 0);

                            // Recalculate total with coupon if applied
                            updatePrices();
                        }

                    },
                    error:function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'لم تكتمل العمليه ',
                        })
                    }
                });

            }

            function getDelivery2() {
                var city =  $('#test2').val() ? $('#test2').val():1;
                var product_ids  = $("input[name='product_ids[]']")
                    .map(function(){return $(this).val();}).get();
                var total =  $('#total').val() ? $('#total').val():0;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('get.delivery') }}",
                    method: 'post',
                    data:{
                        _token: "{{ csrf_token() }}",
                        city : city,
                        total:total,
                        product_ids : product_ids,
                    },
                    success: function(result){

                        // console.log(result);
                        if(!result.success)
                        {
                            Swal.fire({
                                icon: 'error',
                                title: result.msg,
                            })
                        } else {

                            //   alert(result.order_day);
                            //                            $('#Orders_city_id').html(result.cities)
                            $('#test11').html(result.delivery)
                            $('#test3').html(result.delivery1)
                            $('#total_show').html(result.total1)
                            $('#total').html(result.total1)
                            $('#order_day').html(result.order_day)

                            // 👇 Save shipping cost globally for coupons
                            shippingCost = result.shipping_cost ?? 0;
                            shippingCost = parseFloat(result.shipping_cost ?? 0);
                            // Recalculate total with coupon if applied
                            updatePrices();
                        }

                    },
                    error:function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'لم تكتمل العمليه ',
                        })
                    }
                });

            }

            // Variables to store prices
            let subtotal = {{ $total }};
            let shippingCost = 0;
            let discountAmount = 0;
            let appliedCoupon = null;


            // Apply coupon button click handler
            $('#apply_coupon').on('click', function() {
                //getDelivery();
                const couponCode = $('#coupon_code').val().trim();

                if (!couponCode) {
                    showCouponMessage('@lang("site.Please enter a coupon code")', 'error');
                    return;
                }

                validateCoupon(couponCode);
            });

            // Function to validate coupon via AJAX
            function validateCoupon(couponCode) {
                $.ajax({
                    url: '{{ route("validate.coupon") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        coupon_code: couponCode,
                        subtotal: subtotal,
                        user_id: '{{ Auth::guard("web")->id() ?? 0 }}'
                    },
                    beforeSend: function() {
                        $('#apply_coupon').prop('disabled', true).text('@lang("site.Validating")...');
                        $('#coupon_message').html('').removeClass('text-success text-danger');
                    },
                    success: function(response) {
                        if (response.success) {
                            appliedCoupon = response.coupon;
                            discountAmount = calculateDiscount(response.coupon, subtotal);

                            // Update UI
                            showCouponMessage(response.message, 'success');
                            updatePrices();

                            // Set hidden fields
                            $('#applied_coupon').val(couponCode);
                            $('#discount_value').val(discountAmount);
                        } else {
                            showCouponMessage(response.message, 'error');
                            removeCoupon();
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = '@lang("site.An error occurred while validating the coupon")';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        showCouponMessage(errorMessage, 'error');
                        removeCoupon();
                    },
                    complete: function() {
                        $('#apply_coupon').prop('disabled', false).text('@lang("site.apply")');
                    }
                });
            }

            // Function to calculate discount based on coupon type
            function calculateDiscount(coupon, amount) {
                if (coupon.type_discount === 'percentage') {
                    //alert(coupon.discount);
                    return (amount * coupon.discount) / 100;
                } else {
                    return coupon.discount;
                }
            }

            // Function to update all prices in the UI
            function updatePrices() {
                const finalTotal = Math.max(0, subtotal - discountAmount + shippingCost);

                //alert(finalTotal);
                // Update displayed prices with currency code
                $('#subtotal').text(subtotal.toFixed(3) + " {{ trans('site.KWD') }}");
                $('#test3').text(shippingCost.toFixed(3) + " {{ trans('site.KWD') }}"); // 👈 optional row for shipping
                $('#discount_amount').text('-' + discountAmount.toFixed(3) + " {{ trans('site.KWD') }}");
                $('#total_show').text(finalTotal.toFixed(3) + " {{ trans('site.KWD') }}");
                $('#total').val(finalTotal);

                // Show discount row
                $('#discount_row').show();


                // Update Tabby promo if exists
                if (typeof window.updateTabbyPromo === 'function') {
                    window.updateTabbyPromo(finalTotal);
                }
            }

            // Function to remove coupon
            function removeCoupon() {
                appliedCoupon = null;
                discountAmount = 0;

                // Update UI
                $('#applied_coupon').val('');
                $('#discount_value').val(0);
                $('#discount_row').hide();
                updatePrices();
            }


            // Function to show coupon message
            function showCouponMessage(message, type) {
                $('#coupon_message').html(message)
                    .removeClass('text-success text-danger')
                    .addClass(type === 'success' ? 'text-success' : 'text-danger');
            }

            // Allow pressing Enter to apply coupon
            $('#coupon_code').on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    $('#apply_coupon').click();
                }
            });
            // Initialize Tabby promo update function
            window.updateTabbyPromo = function(newPrice) {
                if (typeof TabbyPromo !== 'undefined' && window.tabbyPromoInstance) {
                    // You might need to destroy and recreate the TabbyPromo instance
                    window.tabbyPromoInstance = new TabbyPromo({
                        selector: '#TabbyPromo',
                        currency: "{{$currency_en}}",
                        price: newPrice,
                        installmentsCount: 4,
                        lang: "{{app()->getLocale()}}",
                        source: 'product',
                        publicKey: 'pk_01900622-e193-bf61-1422-411fc5df05f3',
                        merchantCode: 'trendatkwt'
                    });
                }
            };

        });


</script>


</body>
</html>

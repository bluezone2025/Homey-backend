<!doctype html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@lang('site.Checkout_t')</title>
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
        /* Font face definitions (same as before) */
        @font-face {
            font-family: "Font Awesome 6 Brands";
            font-style: normal;
            font-weight: 400;
            font-display: block;
            src: url('{{asset('new_design/webfonts/fa-brands-400.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-brands-400.ttf')}}') format("truetype");
        }

        /* Other font face definitions (same as before) */

        label {
            text-transform: capitalize;
        }

        .variant-attributes {
            margin-top: 5px;
        }

        .variant-attribute {
            display: block;
            font-size: 0.9em;
            color: #666;
        }

        @if(app()->getLocale()=="ar")
            label, option, select {
            font-size: 1.4rem;
        }

        input::placeholder, select::placeholder {
            font-size: 1.2rem;
        }

        .price-number {
            font-size: 1.6rem;
        }
        @endif
    </style>
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

<main id="content">
    <section class="sec-title1">
        <div class="container">
            <div class="col-md-8 d-flex">
                <span><a href="{{ route('home') }}">@lang('site.index')</a></span>
                <span class="mx-2"><b>/</b></span>
                <b><span>@lang('site.Checkout_t')</span></b>
            </div>
        </div>
    </section>

    <section class="my-5 checkout">
        <div class="container">
            <form class="my-4" method="post" name="checkout" action="{{route("checkout.store")}}" id="main-form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            @if(!Auth::guard('web')->check())
                                <h4 class="d-flex text-center">
                                    @lang('site.Repeat customer?')
                                    <a href="{{route('login/client')}}" class="ms-2" style="color: #a88e31;">@lang('site.Click here to log in')</a>
                                </h4>
                            @endif
                        </div>

                        <div class="d-flex btn-head">
                            <button type="button" id="by-address-tab" class="btn tabs-checkout active" data-tab="one">@lang('site.Delivery to the address')</button>
                            <button type="button" id="by-phone-tab" class="btn tabs-checkout ms-3 btn-outline-primary" data-tab="two">@lang('site.Phone Delivery')</button>
                        </div>

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

                        @if ($errors->any()))
                        <div class="alert alert-danger" style="width:100%">
                            <ul>
                                @foreach ($errors->all() as $error)
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
                                    <input type="text" name="username" class="by-address-field" placeholder="{{__('site.full name')}}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="user">{{__('site.Phone')}}<span style="color: #f00;">*</span></label>
                                    <input type="text" name="phone2" class="by-address-field" placeholder="{{__('site.Phone')}}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="user">{{__('site.Email address')}}<span style="color: #f00;">*</span></label>
                                    <input type="email" name="email" class="by-address-field" placeholder="{{__('site.Email address')}}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="user">{{__('site.country')}}<span style="color: #f00;">*</span></label>
                                    <select name="country" id="Orders_city_id" required class="by-address-field">
                                        @foreach(\App\Models\Country::get() as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="region">{{__('site.city')}}<span style="color: #f00;">*</span></label>
                                    <select name="city" id="test" required class="by-address-field">
                                        <option value="">{{__('site.city')}}</option>
                                    </select>
                                    <div style="color: red !important; font-size: 12px !important;" id="test1"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="region">{{__('site.region')}}<span style="color: #f00;">*</span></label>
                                    <input type="text" id="region" class="by-address-field" placeholder="{{__('site.region')}}" name="region" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="piece">{{__('site.piece')}}<span style="color: #f00;">*</span></label>
                                    <input type="text" id="piece" class="by-address-field" placeholder="{{__('site.piece')}}" name="piece" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="street">{{__('site.street')}}<span style="color: #f00;">*</span></label>
                                    <input class="by-address-field" type="text" placeholder="{{__('site.street')}}" name="street" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="avenue">{{__('site.avenue')}}<span style="color: #f00;">*</span></label>
                                    <input class="by-address-field" type="text" placeholder="{{__('site.avenue')}}" name="avenue" required id="avenue">
                                </div>
                                <div class="col-md-12">
                                    <label for="home">{{__('site.flat_number')}}<span style="color: #f00;">*</span></label>
                                    <input class="by-address-field" type="text" placeholder="{{__('site.flat_number')}}" name="flat_number" required id="home">
                                </div>
                                <div class="col-md-12">
                                    <label for="floor">{{__('site.house_number')}}<span style="color: #f00;">*</span></label>
                                    <input class="by-address-field" type="text" placeholder="{{__('site.house_number')}}" name="house_number" required id="floor">
                                </div>
                                <div class="col-md-12">
                                    <label for="flat">{{__('site.floor')}}<span style="color: #f00;">*</span></label>
                                    <input class="by-address-field" type="text" placeholder="{{__('site.floor')}}" name="floor" required id="flat">
                                </div>
                                <div class="col-md-12">
                                    <label for="street-address">{{__('site.address')}}<span style="color: #f00;">*</span></label>
                                    <input class="by-address-field" type="text" id="street-address" placeholder="{{__('site.address')}}" name="address" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="notice">{{__('site.Order notes (optional)')}}</label>
                                    <input type="text" id="notice" placeholder="{{__('site.Order notes (optional)')}}" name="notes">
                                </div>
                            </div>
                        </div>

                        <div class="tab-hidden" id="two">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="delivered_by" value="phone" class="by-phone-field">
                                    <label for="first-name">{{__('site.full name')}}<span style="color: #f00;">*</span></label>
                                    <input type="text" id="first-name" name="username" class="by-phone-field" placeholder="{{__('site.full name')}}" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="user">{{__('site.Phone')}} <span style="color: #f00;">*</span></label>
                                    <input type="text" name="phone1" class="by-phone-field" placeholder="{{__('site.Phone')}}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="user">{{__('site.country')}}<span style="color: #f00;">*</span></label>
                                    <select name="country" id="Orders_city_id2" required class="by-phone-field">
                                        @foreach(\App\Models\Country::get() as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="region">{{__('site.city')}}<span style="color: #f00;">*</span></label>
                                    <select id="test2" required class="by-phone-field" name="city">
                                        <option value="">{{__('site.city')}}</option>
                                    </select>
                                    <div style="color: red !important; font-size: 12px !important;" id="test11"></div>
                                </div>
                                <div class="col-md-12">
                                    <label for="notice">{{__('site.Order notes (optional)')}}</label>
                                    <input type="text" id="notice" placeholder="{{__('site.Order notes (optional)')}}" name="notes">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 me-auto">
                        <div class="checkout-left">
                            <h3>@lang('site.Order details') ({{ count(session('cart')) ?? 0 }} @lang('site.products'))</h3>

                            <div class="checkout-inner">
                                <?php $total = 0; $order_is_order = 0; ?>
                                @if(session('cart'))
                                    @foreach(session('cart') as $key => $details)
                                            @php
                                                $product = \App\Models\Product::find($details['id']);
                                                $variant = isset($details['variant_id']) ? \App\Models\ProductVariant::find($details['variant_id']) : null;

                                                // Get the correct price
                                                $price = $variant ? ($variant->discount_price ?: $variant->price) : ($product->if_sale ? $product->sale_price : $product->regular_price);
                                                $total += $price * $details['quantity'];

                                                if($order_is_order != 1 && $product->is_order == 1) {
                                                    $order_is_order = 1;
                                                }
                                            @endphp

                                            <div class="checkout-items d-flex justify-content-between align-items-center">
                                                <input type="hidden" name="product_ids[]" value="{{$product->id}}">
                                                @if($variant)
                                                    <input type="hidden" name="variant_ids[]" value="{{$variant->id}}">
                                                @endif
                                                <input type="hidden" name="quantities[]" value="{{$details['quantity']}}">

                                                <div class="d-flex align-items-center">
                                                    <img src="{{asset('assets/images/products/min/'.$product->img)}}" alt="product_01">
                                                    <a href="{{route("product",$product->id)}}">
                                                        {!! \Illuminate\Support\Str::limit($product->name, 30, '..') !!}
                                                    </a>
                                                    @if(isset($details['attributes']))
                                                        <div class="variant-attributes">
                                                            @foreach($details['attributes'] as $attrId => $optId)
                                                                <?php
                                                                $attribute = \App\Models\Attribute::find($attrId);
                                                                $option = \App\Models\Option::find($optId);
                                                                ?>
                                                                @if($attribute && $option)
                                                                    <div class="variant-attribute">
                                                                        <strong>{{ $attribute->name_ar }}:</strong> {{ $option->name_ar }}
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="text-left">
                                                    <p class="price price-number">
                                                        <span style="color: #a88e31; font-weight: bold">{{$details['quantity']}}</span>
                                                        <span>x</span>
                                                        <span>{{ get_price_helper($price, true) }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="cupon py-4">
                                <label for="cupon">{{__('site.apply_coupon')}}</label>
                                <div class="d-flex mt-2 align-items-center justify-content-between">
                                    <input type="text" name="coupon_code" class="form-control" style="margin-bottom: 0!important;" placeholder="@lang('site.Discount Code*')">
                                    <button class="btn btn-black ms-3">{{__('site.apply')}}</button>
                                </div>
                            </div>

                            <div class="price-number d-flex justify-content-between align-items-center py-3 mb-4" style="border-top: 1px solid #f1f1f1;border-bottom: 1px solid #f1f1f1;">
                                <span>{{__('site.SUBTOTAL')}}:</span>
                                <span>{{ get_price_helper($total, true) }}</span>
                            </div>

                            <div class="price-number d-flex justify-content-between align-items-center my-2">
                                <span>{{__('site.Shipping')}}:</span>
                                <span id="test3">{{ get_price_helper(0) }}</span>
                            </div>

                            <div class="price-number d-flex justify-content-between align-items-center">
                                <span>{{__('site.ORDER TOTAL')}}:</span>
                                <span id="total_show">{{ get_price_helper($total, true) }}</span>
                            </div>

                            <input type="hidden" name="price" id="total" value="{{ get_price_helper2($total, true) }}">

                            @if(\Auth::guard("web"))
                                <input type="hidden" name="user_id" value="{{ \Auth::guard("web")->user()->id ?? "" }}">
                            @else
                                <input type="hidden" name="user_id" value="0">
                            @endif

                            <h4 class="text-center my-5 pb-3">{{__('site.Choose Your Payment Method')}}</h4>

                            <div class="d-flex">
                                <div>
                                    <input type="radio" name="type" value="cash" checked="checked" id="pay1">
                                    <label for="pay1">@lang('site.Cash on delivery')</label>
                                </div>
                            </div>

                            <div class="d-flex">
                                <div>
                                    <input type="radio" name="type" value="knet" id="pay2">
                                    <label for="pay2">{{__('site.Pay Online')}}</label>
                                </div>
                            </div>

                            @if(auth('web')->check())
                                <div class="d-flex">
                                    <input type="radio" id="buy-13" name="type" value="pay_with_wallet">
                                    <label for="buy-13">
                                        <span>
                                            @php
                                                $userWithWallets = \App\Models\User::where('id', auth('web')->id())
                                                    ->whereHas('wallets')
                                                    ->with(['wallets' => function ($query) {
                                                        $query->select('user_id',
                                                            DB::raw("SUM(CASE WHEN wallet_type = 'deposit' THEN amount ELSE 0 END) as total_deposit"),
                                                            DB::raw("SUM(CASE WHEN wallet_type = 'withdraw' THEN amount ELSE 0 END) as total_withdraw"))
                                                            ->groupBy('user_id');
                                                    }])
                                                    ->first();

                                                if ($userWithWallets) {
                                                    $totalDeposit = $userWithWallets->wallets->first()->total_deposit ?? 0;
                                                    $totalWithdraw = $userWithWallets->wallets->first()->total_withdraw ?? 0;
                                                } else {
                                                    $totalDeposit = 0;
                                                    $totalWithdraw = 0;
                                                }
                                            @endphp
                                            {{__('site.Pay from Wallet')}}<br>
                                            ({{ $totalDeposit - $totalWithdraw }})
                                        </span>
                                    </label>
                                </div>
                            @else
                                <div class="d-flex">
                                    <input type="radio" id="buy-13" name="type" value="pay_with_wallet" class="custom-control-input">
                                    <label for="buy-13">
                                        <span>{{__('site.Pay from Wallet')}}</span>
                                    </label>
                                </div>
                            @endif

                            <div class="d-flex mt-4">
                                <div>
                                    <input type="radio" name="saved" id="pay4" required>
                                    <label for="pay4" style="color: #a88e31;">
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
            <div class="col-12">
                <p>2025 &copy; Trendat</p>
            </div>
        </div>
    </div>
</div>

<!-- Js files -->
<script src="{{ asset('new_design') }}/js/libs/jquery-3.7.1.min.js"></script>
<script src="{{ asset('new_design') }}/js/checkout.js"></script>

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
            toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
        });
        Toast.fire({
            icon: 'error',
            title: "{{ session()->get('error') }}"
        });
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
            toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
        });
        Toast.fire({
            icon: 'success',
            title: "{{ session()->get('success') }}"
        });
    </script>
@endif

<?php
$total = session('cart') ? get_price_helper2($total, true) : 0;
$currency_en = "KWD";
?>

<script src="https://checkout.tabby.ai/tabby-promo.js"></script>
<script>
    new TabbyPromo({
        selector: '#TabbyPromo',
        currency: "{{ $currency_en }}",
        price: "{{ $total }}",
        installmentsCount: 4,
        lang: "{{ app()->getLocale() }}",
        source: 'product',
        publicKey: 'pk_01900622-e193-bf61-1422-411fc5df05f3',
        merchantCode: 'trendatkwt'
    });
</script>

<script>
    $(document).ready(function() {
        // Initialize tabs
        var activeTab = 'one';

        // Handle tab switching
        $('.tabs-checkout').click(function() {
            var tabId = $(this).data('tab');

            // Update active tab
            $('.tabs-checkout').removeClass('active').addClass('btn-outline-primary');
            $(this).addClass('active').removeClass('btn-outline-primary');
            activeTab = tabId;

            // Show/hide tab content
            $('.tab-hidden').removeClass('active');
            $('#' + tabId).addClass('active');

            // Update required fields
            if (tabId === 'one') {
                $('.by-phone-field').removeAttr('required');
                $('.by-address-field').attr('required', 'required');
            } else {
                $('.by-address-field').removeAttr('required');
                $('.by-phone-field').attr('required', 'required');
            }
        });

        // Handle form submission
        $('#main-form').on('submit', function(event) {
            // Make sure terms are accepted
            if (!$('#pay4').is(':checked')) {
                event.preventDefault();
                alert('{{ __("site.Please agree to the terms and conditions") }}');
                return false;
            }

            // Remove fields from inactive tab before submission
            if (activeTab === 'one') {
                $('.by-phone-field').remove();
            } else {
                $('.by-address-field').remove();
            }
        });

        // Initialize city dropdowns
        getCity();
        getCity2();

        // Event handlers for city dropdowns
        $('#Orders_city_id').on('change', getCity);
        $('#Orders_city_id2').on('change', getCity2);
        $('#test').on('change', getDelivery);
        $('#test2').on('change', getDelivery2);

        // AJAX functions
        function getCity() {
            var city = $('#Orders_city_id').val() ? $('#Orders_city_id').val() : 1;

            $.ajax({
                url: "{{ route('get.city') }}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    city: city
                },
                success: function(result) {
                    if (!result.success) {
                        Swal.fire({
                            icon: 'error',
                            title: result.msg,
                        });
                    } else {
                        $('#test').html(result.delivery);
                        getDelivery();
                    }
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.The process is not complete") }}',
                    });
                }
            });
        }

        function getCity2() {
            var city = $('#Orders_city_id2').val() ? $('#Orders_city_id2').val() : 1;

            $.ajax({
                url: "{{ route('get.city') }}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    city: city
                },
                success: function(result) {
                    if (!result.success) {
                        Swal.fire({
                            icon: 'error',
                            title: result.msg,
                        });
                    } else {
                        $('#test2').html(result.delivery);
                        getDelivery2();
                    }
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.The process is not complete") }}',
                    });
                }
            });
        }

        function getDelivery() {
            var city = $('#test').val() ? $('#test').val() : 1;
            var product_ids = $("input[name='product_ids[]']").map(function() {
                return $(this).val();
            }).get();
            var total = $('#total').val() ? $('#total').val() : 0;

            $.ajax({
                url: "{{ route('get.delivery') }}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    city: city,
                    total: total,
                    product_ids: product_ids,
                },
                success: function(result) {
                    if (!result.success) {
                        Swal.fire({
                            icon: 'error',
                            title: result.msg,
                        });
                    } else {
                        $('#test1').html(result.delivery);
                        $('#test3').html(result.delivery1);
                        $('#total_show').html(result.total1);
                        $('#order_day').html(result.order_day);
                    }
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.The process is not complete") }}',
                    });
                }
            });
        }

        function getDelivery2() {
            var city = $('#test2').val() ? $('#test2').val() : 1;
            var product_ids = $("input[name='product_ids[]']").map(function() {
                return $(this).val();
            }).get();
            var total = $('#total').val() ? $('#total').val() : 0;

            $.ajax({
                url: "{{ route('get.delivery') }}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    city: city,
                    total: total,
                    product_ids: product_ids,
                },
                success: function(result) {
                    if (!result.success) {
                        Swal.fire({
                            icon: 'error',
                            title: result.msg,
                        });
                    } else {
                        $('#test11').html(result.delivery);
                        $('#test3').html(result.delivery1);
                        $('#total_show').html(result.total1);
                        $('#order_day').html(result.order_day);
                    }
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.The process is not complete") }}',
                    });
                }
            });
        }
    });
</script>
</body>
</html>
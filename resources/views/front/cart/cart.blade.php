<!doctype html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@lang('site.cart')</title>
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
        @font-face {
            font-family: "Font Awesome 6 Brands";
            font-style: normal;
            font-weight: 400;
            font-display: block;
            src: url('{{asset('new_design/webfonts/fa-brands-400.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-brands-400.ttf')}}') format("truetype")
        }

        :host, :root {
            --fa-font-regular: normal 400 1em/1 "Font Awesome 6 Free"
        }

        @font-face {
            font-family: "Font Awesome 6 Free";
            font-style: normal;
            font-weight: 400;
            font-display: block;
            src: url('{{asset('new_design/webfonts/fa-regular-400.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-regular-400.ttf')}}') format("truetype")
        }

        .fa-regular, .far {
            font-weight: 400
        }

        :host, :root {
            --fa-style-family-classic: "Font Awesome 6 Free";
            --fa-font-solid: normal 900 1em/1 "Font Awesome 6 Free"
        }

        @font-face {
            font-family: "Font Awesome 6 Free";
            font-style: normal;
            font-weight: 900;
            font-display: block;
            src: url('{{asset('new_design/webfonts/fa-solid-900.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-solid-900.ttf')}}') format("truetype")
        }

        .fa-solid, .fas {
            font-weight: 900
        }

        @font-face {
            font-family: "Font Awesome 5 Brands";
            font-display: block;
            font-weight: 400;
            src: url('{{asset('new_design/webfonts/fa-brands-400.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-brands-400.ttf')}}') format("truetype")
        }

        @font-face {
            font-family: "Font Awesome 5 Free";
            font-display: block;
            font-weight: 900;
            src: url('{{asset('new_design/webfonts/fa-solid-900.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-solid-900.ttf')}}') format("truetype")
        }

        @font-face {
            font-family: "Font Awesome 5 Free";
            font-display: block;
            font-weight: 400;
            src: url('{{asset('new_design/webfonts/fa-regular-400.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-regular-400.ttf')}}') format("truetype")
        }

        @font-face {
            font-family: "FontAwesome";
            font-display: block;
            src: url('{{asset('new_design/webfonts/fa-solid-900.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-solid-900.ttf')}}') format("truetype")
        }

        @font-face {
            font-family: "FontAwesome";
            font-display: block;
            src: url('{{asset('new_design/webfonts/fa-brands-400.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-brands-400.ttf')}}') format("truetype")
        }

        @font-face {
            font-family: "FontAwesome";
            font-display: block;
            src: url('{{asset('new_design/webfonts/fa-regular-400.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-regular-400.ttf')}}') format("truetype");
            unicode-range: u+f003, u+f006, u+f014, u+f016-f017, u+f01a-f01b, u+f01d, u+f022, u+f03e, u+f044, u+f046, u+f05c-f05d, u+f06e, u+f070, u+f087-f088, u+f08a, u+f094, u+f096-f097, u+f09d, u+f0a0, u+f0a2, u+f0a4-f0a7, u+f0c5, u+f0c7, u+f0e5-f0e6, u+f0eb, u+f0f6-f0f8, u+f10c, u+f114-f115, u+f118-f11a, u+f11c-f11d, u+f133, u+f147, u+f14e, u+f150-f152, u+f185-f186, u+f18e, u+f190-f192, u+f196, u+f1c1-f1c9, u+f1d9, u+f1db, u+f1e3, u+f1ea, u+f1f7, u+f1f9, u+f20a, u+f247-f248, u+f24a, u+f24d, u+f255-f25b, u+f25d, u+f271-f274, u+f278, u+f27b, u+f28c, u+f28e, u+f29c, u+f2b5, u+f2b7, u+f2ba, u+f2bc, u+f2be, u+f2c0-f2c1, u+f2c3, u+f2d0, u+f2d2, u+f2d4, u+f2dc
        }

        @font-face {
            font-family: "FontAwesome";
            font-display: block;
            src: url('{{asset('new_design/webfonts/fa-v4compatibility.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-v4compatibility.ttf')}}') format("truetype");
            unicode-range: u+f041, u+f047, u+f065-f066, u+f07d-f07e, u+f080, u+f08b, u+f08e, u+f090, u+f09a, u+f0ac, u+f0ae, u+f0b2, u+f0d0, u+f0d6, u+f0e4, u+f0ec, u+f10a-f10b, u+f123, u+f13e, u+f148-f149, u+f14c, u+f156, u+f15e, u+f160-f161, u+f163, u+f175-f178, u+f195, u+f1f8, u+f219, u+f27a
        }

        @font-face {
            font-family: ArbFONTS;
            src: url('{{asset('new_design/ArbFonts.com/ArbFONTS-Somar-Regular.otf')}}');
        }

        @font-face {
            font-family: ArbFONTS-B;
            font-weight: bold;
            src: url('{{asset('new_design/ArbFonts.com/ArbFONTS-Somar-Bold.otf')}}');
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }

        .btn-black-container {
            display: flex;
            justify-content: center;
        }

        .btn-black {
            width: fit-content;
        }

        a {
            cursor: pointer;
        }

        table {
            width: 100%;
            max-width: 100%;
            overflow: auto;
        }

        thead, tbody {
            width: 100%;
            max-width: 100%;
            overflow: auto;
        }

        *, *::before, *::after {
            overflow: auto;
        }

        tr, tr::after, tr::before {
            overflow: auto;
        }

        .quantity-td {
            margin-top: 12%;
        }

        .variant-attributes {
            margin-top: 5px;
        }

        .variant-attribute {
            display: block;
            font-size: 0.9em;
            color: #666;
        }

        @media screen and (max-width: 576px) {
            .cart-parent table tbody td {
                padding: 5px !important;
            }

            .quantity-td {
                margin-top: 45%;
            }
        }
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
                <b><span>@lang('site.cart')</span></b>
            </div>
        </div>
    </section>

    <section class="cart-parent my-5">
        <div class="container">
            @if(session('cart'))
                <div class="row">
                    <div class="col-md-12 col-12">
                        <table class="table-cart">
                            <thead>
                            <tr>
                                <th></th>
                                <th>{{__('site.Product name')}}</th>
                                <th>{{__('site.QUANTITY')}}</th>
                                <th>{{__('site.Price')}}</th>
                                <th>{{__('site.SUBTOTAL')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total = 0; ?>
                            @foreach(session('cart') as $key => $details)
                                    <?php
                                    $product = \App\Models\Product::find($details['id']);
                                    $variant = isset($details['variant_id']) ? \App\Models\ProductVariant::find($details['variant_id']) : null;

                                    // Get the correct price
                                    if ($product->has_paid_variant){

                                        $price = $variant ? ($variant->discount_price ?: $variant->price) : ($product->if_sale ? $product->final_sale_price : $product->final_regular_price);

                                    }else{
                                           $price = $product->sale_price ? $product->final_sale_price : $product->final_regular_price;
                                    }
                                    $total += $price * $details['quantity'];
                                    ?>

                                    <tr>
                                        <td>
                                            <form action="{{ route('cart.remove') }}" method="get">
                                                <input type="hidden" name="id" value="{{ $details['id'] }}">
                                                <input type="hidden" name="variant_id" value="{{ $variant->id ?? '' }}">
                                                <input type="hidden" name="key" value="{{ $key }}">
                                                <button type="submit" title="delete" style="cursor: pointer; background: none; padding: 11px 0px;">
                                                    <span class="close">×</span>
                                                </button>
                                            </form>
                                        </td>

                                        <td>
                                            <div class="product-thumbnails">
                                                <img src="{{ asset('assets/images/products/min/'.$product->img) }}" loading="lazy" class="un" />
                                            </div>

                                           <div class="d-flex text-center justify-content-center">
                                               <a href="{{ route('product', $product->id) }}">{{ $product->name }}</a>

                                               @if(isset($details['attributes']))
                                                   @foreach($details['attributes'] as $attrId => $optId)
                                                       <?php
                                                       $attribute = \App\Models\Attribute::find($attrId);
                                                       $option = \App\Models\Option::find($optId);
                                                       ?>
                                                       @if($attribute && $option)
                                                               @if($loop->first)
                                                                   <span class="mx-1">-</span>
                                                               @endif
                                                               <span>{{ $option->name_ar }}</span>
                                                               @if(!$loop->last)
                                                                   <span class="mx-1">-</span>
                                                               @endif
                                                       @endif
                                                   @endforeach
                                               @endif
                                           </div>
                                        </td>

                                        <td class="d-flex quantity-td">
                                            <a id="a_mun_{{ $details['id'] }}_{{ $key }}"
                                               onclick="updateCart('{{ $details['id'] }}', 'minus', '{{ $key }}', '{{ $variant->id ?? '' }}')"
                                               class="quantity-action mx-1 down position-absolute pos-fixed-left-center pl-2 z-index-2 {{ $details['quantity'] > 1 ? 'btn-minus' : 'btn-minus-des' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                                                </svg>
                                            </a>

                                            <input name="quantity"
                                                   id="qty_{{ $details['id'] }}_{{ $key }}"
                                                   value="{{ $details['quantity'] }}"
                                                   type="number"
                                                   class="form-control form-control-sm px-6 fs-16 text-center input-quality border-0 h-35px"
                                                   min="1"
                                                   required>

                                            <a onclick="updateCart('{{ $details['id'] }}', 'plus', '{{ $key }}', '{{ $variant->id ?? '' }}')"
                                               class="quantity-action mx-1 up position-absolute pos-fixed-right-center pr-2 z-index-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                                </svg>
                                            </a>
                                        </td>

                                        <td data-title="price">
                                        <span class="woocommerce-price-amount float-end">
                                            {{ get_price_helper($price, true) }}
                                        </span>
                                        </td>

                                        <td data-title="subtotal" class="update">
                                        <span class="woocommerce-price-amount amount float-end" id="subtotal_{{ $details['id'] }}_{{ $key }}">
                                            {{ get_price_helper($price * $details['quantity'], true) }}
                                        </span>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-5 col-12 mt-4">
                        <div class="summary-box">

                            <div>
                                <span>{{__('site.Cart Subtotal')}}:</span>
                                <span class="total-all" id="cart_subtotal">{{ get_price_helper($total, true) }}</span>
                            </div>
                            <div>
                                <span>{{__('site.Shipping')}}:</span>
                                <span class="note">{{__('site.Depend on city')}}</span>
                            </div>

                            <div id="TabbyPromo"></div>

                            <hr />
                            <div class="total-label">
                                <span>{{__('site.ORDER TOTAL')}}:</span>
                                <span class="total-all" id="order_total">{{ get_price_helper($total, true) }}</span>
                            </div>

                            <a href="{{ route('checkout') }}">{{__('site.Checkout')}}</a>
                            <a href="{{ route('home') }}">{{__('site.Continue Shopping')}}</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 justify-content-center">
                        <h4 class="text-black text-center">
                            @lang('site.Your shopping bag is empty')
                        </h4>
                        <h6 class="text-black text-center">
                            @lang('site.Add a new product')
                        </h6>
                        <div class="btn-black-container">
                            <a href="{{ route('home') }}" class="btn btn-black mt-5">@lang('site.Continue shopping')</a>
                        </div>
                    </div>
                </div>
            @endif
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
@include('sweetalert::alert')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>
<script src="https://checkout.tabby.ai/tabby-promo.js"></script>
<script>
    // Calculate header height for padding
    let calcHeader = document.querySelector("header");
    document.body.style.paddingTop = calcHeader.clientHeight + "px";
    window.onresize = function() {
        document.body.style.paddingTop = calcHeader.clientHeight + "px";
    };

    // Tabby promo initialization
    <?php
    $total = session('cart') ? get_price_helper2($total, true) : 0;
    $currency_en = "KWD";
    ?>

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

    // Update cart quantity function
    function updateCart(productId, action, key, variantId = null) {
        //alert('s');
        const inputElement = $(`#qty_${productId}_${key}`);
        let newQuantity = parseInt(inputElement.val());

        if (action === 'minus') {
            newQuantity = Math.max(1, newQuantity - 1);
        } else if (action === 'plus') {
            newQuantity = newQuantity + 1;
        }

        $.ajax({
            url: "{{ route('cart.update2') }}",
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                id: productId,
                variant_id: variantId,
                quantity: newQuantity,
                key: key
            },
            success: function(response) {
                if (response.success) {
                    // Update quantity input
                    inputElement.val(newQuantity);

                    // Update minus button state
                    const minusBtn = $(`#a_mun_${productId}_${key}`);
                    if (newQuantity <= 1) {
                        minusBtn.removeClass('btn-minus').addClass('btn-minus-des');
                    } else {
                        minusBtn.addClass('btn-minus').removeClass('btn-minus-des');
                    }
                  console.log(response.cart);


                    // Update subtotal for this item
                    const price = response.item_price;
                    $(`#subtotal_${productId}_${key}`).text(response.formatted_subtotal);

                    // Update cart totals
                    $('#cart_subtotal').text(response.formatted_total);
                    $('#order_total').text(response.formatted_total);

                    // Update Tabby promo if needed
                    if (typeof TabbyPromo !== 'undefined') {
                        new TabbyPromo({
                            selector: '#TabbyPromo',
                            currency: "{{ $currency_en }}",
                            price: response.total,
                            installmentsCount: 4,
                            lang: "{{ app()->getLocale() }}",
                            source: 'product',
                            publicKey: 'pk_01900622-e193-bf61-1422-411fc5df05f3',
                            merchantCode: 'trendatkwt'
                        });
                    }



                    // Show success message
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
                        title: response.message
                    });

{{--                    location.reload();--}}

                }
                else{
                 // Show success message
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
                        title: response.message
                    });
                }
            },
            error: function(xhr) {
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
                    title: xhr.responseJSON?.message || "{{ trans('site.The process is not complete') }}"
            });
            }
        });
    }

    // Show success/error messages from session
            @if (session('error'))
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
            @endif

            @if (session('success'))
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
    @endif
</script>
</body>
</html>

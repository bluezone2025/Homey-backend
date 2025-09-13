@extends('layouts.layout2')
@section('title', $result->name)
@section('style')
    <style>
        .number-input {
            display: flex;
            align-items: center;
            gap: 5px;
            height: 52px;
            font-size: 2rem;
            border: 2px solid #eaeaea;
            outline: none;
            padding: 2px;
            width: 150px;
            text-align: center;
            color: inherit;
        }

        .number-input input {
            width: 60px;
            text-align: center;
            border: none !important;

        }
        input[type="number"] {
            border: none; /* يخفي الحدود */
            outline: none; /* يخفي التحديد الأزرق عند التركيز */
            -moz-appearance: textfield; /* يخفي الأسهم في Firefox */
        }

        /* يخفي الأسهم في Chrome, Safari, Edge */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .input-number-btns{
            width: fit-content;
            background: none;
        }
        .color-radio:checked+.color-label {
            border-width: 3px !important;
            transform: scale(1.1);
            transition: all 0.2s ease-in-out;
            border-style: solid;
            border-color: black !important;
        }

        .color-radio {
            position: absolute;
            opacity: 0;
        }
        input[type="radio"] {
            display: none;
        }

        label {
            position: relative;
            color: #212529;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.8em;
            border: 1px solid #EEEEEE !important;
            /*padding: 0.5em 1em;*/
        }

        label:before {
            /*content: "";*/
            /*height: 1em;*/
            /*width: 1em;*/
            /*border: 3px solid var(--bs-primary-color);*/
            /*border-radius: 50%;*/
        }

        input[type="radio"]:checked+label:before {
            /*height: 0.5em;*/
            /*width: 0.5em;*/
            /*border: 0.65em solid #ffffff;*/
            background-color: var(--bs-primary-color);

        }

        input[type="radio"]:checked+label {
            background-color: #000000;
            color: #ffffff;
            /*border: 3px solid #000000;*/

        }
        .size-options{
            flex-wrap: wrap;
        }

        .buy-now-container {
            position: relative;
           /*  min-height: 50px; */
        }

        #waiting-message {
            background-color: #cccccc;
            border-color: #cccccc;
            opacity: 0.8;
        }

        .spinner-border {
            vertical-align: middle;
        }
         .description-body {
        max-height: fit-content; /* adjust based on content */
        overflow: auto;
        transition: max-height 0.5s ease;
    }

    .description-body.closed {
        max-height: 0;
    }
        .unavailable-option {
            opacity: 0.5;
            position: relative;
            cursor: not-allowed;
        }

        .unavailable-option::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 5%;
            right: 5%;
            height: 0;
            border-top: 2px dashed #999;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .unavailable-option.selected {
            background-color: #f8f8f8;
        }

         .attributes-options{
            flex-wrap: wrap;
        }
        .product-description {
            max-width: 100%;
        }
    </style>
@endsection
@section('content')

    <section class="sec-title1">
        <div class="container">
            <span><a href="{{ route('home') }}">@lang('site.index')</a></span>
            @if($result->categories->first())
                <span class="mx-2"><b>/</b></span>
                <span>{{$result->categories->first()->{"name_".app()->getLocale()} }}</span>

            @else
                <span class="mx-2"><b>/</b></span>
                <span>
                    {{($result->students->first())?$result->students->first()->{"name_".app()->getLocale()}:"" }}
                    </span>

            @endif


            <span class="mx-2"><b>/</b></span>
            <b><span>{{ $result->name }}</span></b>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">

                    <div class="text-center brands owl-carousel owl-theme owl-product-images">
                        <div class="card product-img">
                            <img
                                src="{{ asset('assets/images/products/min/' . $result->img) }}"

                                onerror="this.src='{{asset('new_design/images/not-found.png')}}'"
                                class="img-fluid"
                                alt=""
                            />
                        </div>
                        @foreach($result->images as $key=>$img)
                            <div class="card product-img">
                                <img
                                    src="{{ asset('assets/images/products/gallery/' . $img->src) }}"

                                    onerror="this.src='{{asset('new_design/images/not-found.png')}}'"

                                    class="img-fluid"
                                    alt=""
                                />
                            </div>

                        @endforeach
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="details-top">
                        <h3>{{$result->name}}</h3>
                        @if($result->final_sale_price !=0 && $result->final_sale_price < $result->final_regular_price)
                            <?php
                            $sale=$result->final_sale_price;
                            $regular=$result->final_regular_price;
                            $discount=100 - round(($sale/$regular)*100,0);
                            ?>
                            <div class="justify-content-between d-flex">
                                <div>
                                      <span class="text-line-through text-danger prod-price">
                                        {{ get_price_helper($result->final_regular_price,true) }}
                                    </span>
                                    <span class="prod-price mx-2">
                                        {{ get_price_helper($result->final_sale_price,true) }}
                                    </span>
                                </div>
                                <span class="badge badge-danger">{{ $discount }} %</span>
                            </div>

                        @else
                            <div>
                                <span class="prod-price">{{ get_price_helper($result->final_regular_price,true) }}</span>
                            </div>
                        @endif
                        <form method="post" id="cart-form" name="cart_form" action="{{ route('add.cart.post') }}">
                            @csrf
                           {{-- <div class="mt-4">
                                <span class="text-secondary font-weight-bold d-block mb-3">@lang('site.color')</span>
                                <div class="d-flex buttons-section align-items-center ">
                                    <input type="radio" name="selectedColor" value="" id="color_1"
                                           form="cart-form" class="color-radio" --}}{{--onclick="getColorImage(this.value)"--}}{{-->
                                    <label class=" border mx-1 color-label"
                                           style="width: 40px; height: 40px; background-color:#b4058f; border-color: black; cursor: pointer;"
                                           for="color_1">
                                    </label>
                                    <input type="radio" name="selectedColor" value="" id="color_2"
                                           form="cart-form" class="color-radio" --}}{{--onclick="getColorImage(this.value)"--}}{{-->
                                    <label class=" border mx-1 color-label"
                                           style="width: 40px; height: 40px; background-color:#064f8e; border-color: black; cursor: pointer;"
                                           for="color_2">
                                    </label>
                                    <input type="radio" name="selectedColor" value="" id="color_3"
                                           form="cart-form" class="color-radio" --}}{{--onclick="getColorImage(this.value)"--}}{{-->
                                    <label class=" border mx-1 color-label"
                                           style="width: 40px; height: 40px; background-color:#04ade0; border-color: black; cursor: pointer;"
                                           for="color_3">
                                    </label>
                                </div>

                            </div>
                            <div class="selection-display mt-4">
                                <span class="text-secondary font-weight-bold d-block mb-3">@lang('site.size')</span>

                                <div class="size-options d-flex buttons-section align-items-center mb-4">

                                    <input  type="radio" name="size"
                                            value="" id="size_4"
                                             /> <!-- Added 'required' here -->
                                    <label class="mx-1 px-3 py-1 mb-2"
                                           for="size_4">41</label>

                                    <input  type="radio" name="size"
                                            value="" id="size_5"
                                             /> <!-- Added 'required' here -->
                                    <label class="mx-1 px-3 py-1 mb-2"
                                           for="size_5">42</label>

                                    <input  type="radio" name="size"
                                            value="" id="size_6"
                                             /> <!-- Added 'required' here -->
                                    <label class="mx-1 px-3 py-1 mb-2"
                                           for="size_6">43</label>
                                </div>
                            </div>--}}

                            @foreach($result->getVariantAttributes() as $attribute)
                                <div class="selection-display mt-4">
                                    <span class="text-secondary font-weight-bold d-block mb-3">{{ $attribute['name'] }}</span>
                                    <div class="d-flex buttons-section align-items-center mb-4 attributes-options">
                                        @foreach($attribute['options'] as $option)
                                            @php
                                                $quantity = null;

                                                // Determine quantity for multi-attribute products
                                                if (!empty($option['combinations'])) {
                                                    foreach ($option['combinations'] as $otherAttrId => $otherValues) {
                                                        foreach ($otherValues as $optId => $qty) {
                                                            if ($quantity === null || $qty < $quantity) {
                                                                $quantity = $qty;
                                                            }
                                                        }
                                                    }
                                                }

                                                // If single-attribute product, fallback to option's main quantity
                                                if (empty($option['combinations']) && isset($option['quantity'])) {
                                                    $quantity = $option['quantity'];
                                                }

                                                // Ensure quantity is 0 if still null
                                                $quantity = $quantity ?? 0;
                                            @endphp

                                            <input type="radio"
                                                   name="attribute[{{ $attribute['id'] }}]"
                                                   value="{{ $option['id'] }}"
                                                   id="attr_{{ $attribute['id'] }}_{{ $option['id'] }}"
                                                   class="variant-select"
                                                   data-combinations='@json($option["combinations"] ?? [])'
                                                   data-quantity="{{ $quantity }}"
                                                   @if($quantity === 0) disabled @endif
                                            >

                                            <label class="mx-1 px-3 py-1 mb-2 @if($quantity === 0) unavailable-option @endif"
                                                   for="attr_{{ $attribute['id'] }}_{{ $option['id'] }}">
                                                @if($quantity === 0)
                                                    {{ $option['name'] }}
                                                @else
                                                    {{ $option['name'] }}
                                                @endif
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach




                            <div class="mt-4">
                            <input type="hidden" name="item_id" value="{{ $result->id }}" />

                            <input type="hidden" name="variant_id" value="" id="variant_id">
{{--                            <input name="qut" type="number"--}}
{{--                                   id="qty_{{ $result->id }}" min="1" value="1" class="mb-5" />--}}

                            <div class="number-input mb-5">
                                <button type="button" class="input-number-btns" onclick="this.parentNode.querySelector('input').stepDown()">-</button>
                                <input name="qut" type="number" id="qty_{{ $result->id }}" min="1" value="1" class="">
                                <button type="button" class="input-number-btns" onclick="this.parentNode.querySelector('input').stepUp()">+</button>
                            </div>
                            <div class="d-flex  justify-content-between">
                                <div class="buy-now-container">
                                  @if($result->checkQuantity()==0)
                                        <button type="button" class="btn sold_out me-5" style="width: fit-content; display: none;" >
                                            @lang('site.sold_out')
                                        </button>
                                  @else
                                    <button type="submit" class="btn btn-black me-5" style=" display: none;" id="add_cart">
                                        @lang('site.buy_now')
                                    </button>
                                  @endif
                                    <div class="btn btn-black me-5" style="width: fit-content; cursor: not-allowed;" id="waiting-message">
                                        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                        @lang('site.loading_variant')
                                    </div>
                                </div>
                                 @php
                                        if(auth('web')->check()){

                                            $wishlists=auth('web')->user()->wishlist()->latest()->get();
                                            $exists = $wishlists->contains('id', $result->id);

                                        }
                                        else{
                                             $exists=false;
                                        }
                                    @endphp
                               <div class="d-flex fav-share-container">
                                 <a data-product-id="{{ $result->id }}"
                                   class="addToWishlist2 d-flex align-items-center "
                                    style="cursor: pointer"
                                >
                                        @if ($exists)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#ff0000" class="bi bi-suit-heart-fill favProd  pointer" viewBox="0 0 16 16">
                                              <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1"/>
                                            </svg>
                                            
                                        @else
                                            <svg  xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000" class="bi bi-suit-heart unFavProd  pointer" viewBox="0 0 16 16">
                                                <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                                            </svg>
                                        @endif
                                    <span class="mx-1"> @lang('site.add_fav')</span>
                               </a>

                                <a class="d-flex align-items-center ms-4 share-btn" onclick="sharePage()"
                                   style="cursor: pointer">
                                    <i class="fa-solid fa-share-nodes me-2"></i>
                                <span class="mx-1">
                                    @lang('site.share')
                                </span>
                                </a>
                               </div>
                            </div>
                            <div class="product-description mt-5">
                                <h2 class="d-flex justify-content-between align-items-center">
                                    @lang("site.product_desc")
                                    <i class="toggle-description-icon fa-solid fa-minus" style="cursor: pointer;"></i>
                                </h2>
                                <div class="description-body open">
                                    <p class="mt-3" style="color: #000000 !important;">
                                        {!! $result['description_' . app()->getlocale()] !!}
                                    </p>
                                </div>
                            </div>


                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ -->

    @if(count($list) > 0)
     <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <h3 class="text-center">@lang("site.You may also like")</h3>
                </div>
            </div>
            <div class="row brand-parent mt-5">
                @foreach($list as $key=>$one)
                <div class="col-md-3 col-6 mt-4">
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

@stop

@if($result->if_sale)
    <?php
    $sale=$result->final_sale_price;
    $regular=$result->final_regular_price;
    $total = get_price_helper2($result->final_sale_price,true)
    ?>
@else
   <?php $total = get_price_helper2($result->final_regular_price,true) ?>
@endif


<?php
    $currency_en = "KWD";



?>


@section('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>
    <script>
    function sharePage() {
        const dummy = document.createElement("input");
        document.body.appendChild(dummy);
        dummy.value = window.location.href;
        dummy.select();
        document.execCommand("copy");
        document.body.removeChild(dummy);
{{--        alert("Link copied to clipboard!");--}}
        const Toast = Swal.mixin({
                       toast: true,
                       position: 'top-end',
                       showConfirmButton: false,
                       timer: 30000,
                       timerProgressBar: true,
                       didOpen: (toast) => {
                       toast.addEventListener('mouseenter', Swal.stopTimer)
                   toast.addEventListener('mouseleave', Swal.resumeTimer)
               }
               })
                   Toast.fire({
                       icon: 'success',
                       title: '{{trans('site.Link copied successfully!')}}',


                   })
   }
</script>
    <script>

        $('#select_size').on('change', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            let product_id = {{ $id }};
            var valueSelected = this.value;
            console.log(valueSelected);
            $.ajax({
                url: "{{ route('getColorForSizeProduct') }}",
                method: 'post',
                data: {
                    product_id: product_id,
                    _token: "{{ csrf_token() }}",
                    size_id: valueSelected,

                },
                success: function(result) {
                    if (result.status == 1) {

                        $('#select_color')
                            .find('option')
                            .remove()
                            .end();
                        $("#select_color").append(
                            " <option  <option style='color: black' disabled selected >" +
                            "{{ __('site.color') }}" + "</option>");
                        jQuery.each(result.data, function(i, val) {
                            $("#select_color").append(" <option  value='" + val.id + "'>" + val
                                .name_ar + "</option>");
                        });
                        $("#select_color").removeClass('d-none');
                    } else if (result.status == 0) {
                        $('#select_color')
                            .find('option')
                            .remove()
                            .end();
                        $("#select_color").addClass('d-none');
                        Swal.fire({
                            title: __('site.not have color'),
                            icon: '?',
                            confirmButtonColor: '#d76797',
                            position: 'bottom-start',
                            showCloseButton: true,
                        })
                    }




                },
                error: function(error) {


                    // console.log(error);
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
                        title: "{{trans('site.The process is not complete')}}",


                    })

                }
            });

        });
    
{{--        let shareData = {--}}
{{--            url: window.location.href,--}}
{{--        }--}}

{{--        document.querySelector('#bn-share').addEventListener('click', () => {--}}
{{--            navigator.share(shareData);--}}
{{--        });--}}
{{--        changeStuff($('.first-elm'));--}}
{{--        var swiper = new Swiper(".mySwiper1", {--}}
{{--            autoplay: {--}}
{{--                delay: 2500,--}}
{{--                disableOnInteraction: false,--}}
{{--            },--}}
{{--            breakpoints: {--}}
{{--                freeMode: true,--}}
{{--            }--}}
{{--        });--}}
       

    </script>
       <script>

        $('#add_cart').on('click', function(event) {
            event.preventDefault();
            addToCart($(this));
        });

function addToCart(button) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    let form = button.closest('form');

    if (form.length === 0) {
        console.error("Form not found");
        return;
    }

    let qut = form.find("input[name=qut]").val();
    let item_id = form.find("input[name=item_id]").val();
    let variant_id = form.find("input[name=variant_id]").val();
    let attribute = {};

    form.find('input[type="radio"]:checked[name^="attribute["]').each(function () {
        let name = $(this).attr('name'); // مثل attribute[6]
        let match = name.match(/\[(\d+)\]/); // استخراج الرقم من داخل القوس
        if (match) {
            attribute[match[1]] = $(this).val(); // مثال: attribute[6] = 1
        }
    });

    console.log('Attributes:', attribute);

    console.log('qut : ' + qut + '  item_id: ' + item_id + '  variant_id: ' + variant_id + '  attribute: ' + attribute);

    let formData = new FormData(form[0]);

    for (let key in attribute) {
        formData.append(`attribute[${key}]`, attribute[key]);
    }

    $.ajax({
        url: "{{ route('add.cart.post') }}",
        method: 'post',
        data: formData,
        processData: false,      // ✅ مهم
        contentType: false,      // ✅ مهم
        success: function(result) {
            if (result.status === 'success') {
                console.log(result);

                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: result.data,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });

                        $('#cart-count').text(result.count);
                         sessionStorage.setItem('cartUpdated', '1');
                         window.location.reload();



            } else if (result.status === 'error') {
                Swal.fire({
                    toast: true,
                    icon: 'error',
                    title: result.data,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
                        $('#cart-count').text(result.count);

            }
        },
        error: function(error) {
            Swal.fire({
                toast: true,
                icon: 'error',
                title: "{{ trans('site.The process is not complete') }}",
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
            console.error(error);
        }
    });
}

    </script>

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
            const buyNowBtn = $('#add_cart');
            const waitingMessage = $('#waiting-message');
            const hasVariants = {{ count($attributes) > 0 ? 'true' : 'false' }};

            waitingMessage.hide();
            buyNowBtn.hide();

            if (hasVariants) {
                autoSelectFirstAvailable();
                updateAvailableCombinations();
                updateProductPrice(false);
            } else {
                buyNowBtn.show();
            }

            $('.variant-select').change(function () {
                $(this).closest('.buttons-section').find('label').removeClass('selected');
                $(this).next('label').addClass('selected');

                waitingMessage.show();
                buyNowBtn.hide();

                updateAvailableCombinations();
                updateProductPrice(true);
            });

            function autoSelectFirstAvailable() {
                $('.selection-display').each(function () {
                    const firstEnabled = $(this).find('input.variant-select:enabled').first();
                    if (firstEnabled.length) {
                        firstEnabled.prop('checked', true);
                        firstEnabled.next('label').addClass('selected');
                    }
                });
            }

            function updateAvailableCombinations() {
                const selectedAttributes = {};
                $('.variant-select:checked').each(function () {
                    const attrId = $(this).attr('name').match(/\d+/)[0];
                    selectedAttributes[attrId] = $(this).val();
                });

                const isSingleAttribute = $('.selection-display').length === 1;

                $('.selection-display').each(function () {
                    $(this).find('input.variant-select').each(function () {
                        const $input = $(this);
                        const $label = $input.next('label');

                        let qty = null;
                        const combinations = $input.data('combinations') || {};

                        // For multi-attribute, check combinations
                        for (const [otherAttrId, otherValues] of Object.entries(combinations)) {
                            if (selectedAttributes[otherAttrId]) {
                                qty = otherValues[selectedAttributes[otherAttrId]];
                                break;
                            }
                        }

                        // For single-attribute, fallback to original input quantity
                        if (isSingleAttribute) {
                            qty = $input.data('quantity') ?? 0;
                        }

                        if (qty === 0) {
                            $input.prop('disabled', true);
                            $label.addClass('unavailable-option');
                        } else {
                            $input.prop('disabled', false);
                            $label.removeClass('unavailable-option');
                        }
                    });
                });
            }

            function updateProductPrice(showWait = true) {
                const productId = {{ $result->id }};
                const selectedAttributes = {};

                $('.variant-select:checked').each(function () {
                    const attrId = $(this).attr('name').match(/\d+/)[0];
                    selectedAttributes[attrId] = $(this).val();
                });

                if (Object.keys(selectedAttributes).length === $('.selection-display').length) {
                    fetchVariantDetails(productId, selectedAttributes);
                } else if (showWait) {
                    waitingMessage.show();
                    buyNowBtn.hide();
                }
            }

            function fetchVariantDetails(productId, attributes) {
                $.ajax({
                    url: "{{ route('get.variant.details') }}",
                    method: 'POST',
                    data: {
                        product_id: productId,
                        attributes: attributes,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if (response.success) {
                            if (response.discount_price) {
                                $('.prod-price').text(response.formatted_price);
                                $('.text-line-through').text(response.formatted_regular_price).removeClass('d-none');
                                $('.badge-danger').text(response.discount_percent + '%').removeClass('d-none');
                            } else {
                                $('.prod-price').text(response.formatted_price);
                                $('.text-line-through').addClass('d-none');
                                $('.badge-danger').addClass('d-none');
                            }

                            $('#variant_id').val(response.variant_id);
                            waitingMessage.hide();
                            buyNowBtn.show();
                            $('#qty_{{ $result->id }}').attr('max', response.quantity);
                            updateTabbyPromo(response.price);
                        } else {
                            waitingMessage.show();
                            buyNowBtn.hide();
                        }
                    },
                    error: function () {
                        waitingMessage.show();
                        buyNowBtn.hide();
                    }
                });
            }

            function updateTabbyPromo(price) {
                if (typeof TabbyPromo !== 'undefined') {
                    new TabbyPromo({
                        selector: '#TabbyPromo',
                        currency: "{{$currency_en}}",
                        price: price,
                        installmentsCount: 4,
                        lang: "{{app()->getLocale()}}",
                        source: 'product',
                        publicKey: 'pk_01900622-e193-bf61-1422-411fc5df05f3',
                        merchantCode: 'trendatkwt'
                    });
                }
            }
        });
    </script>



    <script>
document.addEventListener('click', function (e) {
    const wishlistLink = e.target.closest('.addToWishlist2');
    if (!wishlistLink) return;

    e.preventDefault();

    const productId = wishlistLink.getAttribute('data-product-id');
    const svg = wishlistLink.querySelector('svg');
    if (!svg) return;

    console.log('Sending productId:', productId);

    $.ajax({
        type: 'get',
        url: "{{ route('wishlist.store') }}",
        data: {
            'productId': productId
        },
        success: function (data) {
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

            if (data.status == 'success') {
                Toast.fire({
                    icon: 'success',
                    title: data.message,
                });

                $('a[data-product-id="' + productId + '"]').html(`
                    <svg  xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#ff0000" class="bi bi-suit-heart-fill favProd" viewBox="0 0 16 16">
                        <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1"/>
                    </svg>
                    <span class="mx-1"> @lang('site.add_fav')</span>
                `);
            } else {
                Toast.fire({
                    icon: 'error',
                    title: data.message,
                });
            }
        }
    });
});

</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleIcon = document.querySelector('.toggle-description-icon');
        const descriptionBody = document.querySelector('.description-body');

        toggleIcon.addEventListener('click', function () {
            const isOpen = descriptionBody.classList.contains('open');

            descriptionBody.classList.toggle('closed', isOpen);
            descriptionBody.classList.toggle('open', !isOpen);

            toggleIcon.classList.toggle('fa-minus', !isOpen);
            toggleIcon.classList.toggle('fa-plus', isOpen);
        });
    });
</script>


@endsection


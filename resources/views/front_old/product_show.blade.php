@extends('layouts.layout')
@section('title', $result->name)
@section('content')

    <main id="content">
        <section class="py-2 bg-gray-2 product_seo">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                        <li class="breadcrumb-item"><a class="text-decoration-none active"
                                                       href="{{route('home')}}">@lang('site.index')</a>
                        </li>
                        <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">
                            @if($result->categories->first())
                            {{$result->categories->first()->{"name_".app()->getLocale()} }}
                            @else
                                {{($result->students->first())?$result->students->first()->{"name_".app()->getLocale()}:"" }}

                            @endif
                        </li>
                        <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">
                            {{ $result->name }}
                        </li>
                    </ol>
                </nav>
            </div>
        </section>
        <section class="pt-5 pb-9 pb-lg-13 product-details-layout-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 pr-xl-9 mb-8 mb-md-0 primary-gallery summary-sticky" id="summary-sticky">
                        <div class="primary-summary-inner">
                            <div class="galleries-product galleries-product-02">
                                <div class="slick-slider slider-for custom-dots-01 mx-0"
                                     data-slick-options='{"slidesToShow": 1, "autoplay":false,"dots":true,"arrows":false}'>
                                    <div class="box px-0">
                                        <div class="card p-0 rounded-0 border-0">
                                            <a href="{{ asset('assets/images/products/min/' . $result->img) }}" class="card-img" data-gtf-mfp="true"
                                               data-gallery-id="02">
                                                <img src="{{ asset('assets/images/products/min/' . $result->img) }}" alt="product gallery" class="w-100">
                                            </a>
                                        </div>
                                    </div>
                                    @if ($result->images->count() > 0)
                                        @foreach ($result->images as $img)
                                            <div class="box px-0">
                                                <div class="card p-0 rounded-0 border-0">
                                                    <a href="{{ asset('assets/images/products/gallery/' . $img->src) }}" class="card-img" data-gtf-mfp="true"
                                                       data-gallery-id="02">
                                                        <img src="{{ asset('assets/images/products/gallery/' . $img->src) }}" alt="product gallery" class="w-100">
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="fs-24 mb-3 text-black">{{$result->name}}
                        </h2>
                        <h4 class="mb-2 row mb-5">
                            <span class="d-block col-4 text-black font-weight-600 fs-24">{{ __('site.brand') .": "}}</span>
                            <span class="d-block col-8 text-black font-weight-600 fs-24">{!! app()->getLocale() == 'ar' ? $result->about_brand_ar : $result->about_brand_en !!}</span>
                        </h4>

                        <p class="d-flex align-items-center mb-5 ">
                            @if($result->if_sale)
                                <?php
                                $sale=$result->sale_price;
                                $regular=$result->regular_price;
                                $discount=100 - round(($sale/$regular)*100,1);
                                ?>
                                    <span class="badge badge-primary fs-18 font-weight-600 px-3 mx-1">{{ $discount }} %</span>

                                    <span class="text-line-through text-danger">{{ get_price_helper($result->regular_price,true) }}</span>
                                <span class="fs-24 text-secondary font-weight-bold ml-3">{{ get_price_helper($result->sale_price,true) }}</span>


                            @else
                                <span class="fs-24 text-secondary font-weight-bold ml-3">{{ get_price_helper($result->regular_price,true) }}</span>
                            @endif


                        </p>
                        <form method="post" id="cart-form" name="cart_form" action="{{ route('add.cart.post') }}">
                            @csrf

                            <div class="row align-items-end no-gutters mx-n2">
                                @if ($result->is_clothes == 1)
                                    <div class="col-sm-12 form-group px-2 mb-5 d-flex align-items-center justify-content-start">
                                        <label class="text-secondary font-weight-600 " for="select_size">مقاس : </label>
                                        <select name='attributes[6]' class="form-control w-50 mx-3 " id="select_size">
                                            <option value="0" selected>{{ __('site.size') }}</option>
                                            @foreach ($result->attributesClothes as $item_attr)
                                                @isset($item_attr->size)
                                                    <option value='{{ $item_attr->size->id }}'>
                                                        {{ $item_attr->size->name_ar }}
                                                    </option>
                                                @endisset
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 form-group px-2 mb-5 d-flex align-items-center justify-content-start">
                                        <label class="text-secondary font-weight-600 " for="select_size">اللون : </label>
                                        <select class="d-none form-control w-50 mx-3" id="select_color" name='attributes[7]' style="">

                                        </select>
                                    </div>
                                @else
                                    @foreach ($result->attributes as $item)
                                        <select class="form-control w-50 mx-3" name='attributes[{{ $item->id }}]'>

                                            <option style="color: black" value="0" selected>
                                                {{ $item->{'name_'.app()->getLocale()} }}
                                            </option>

                                            @foreach ($result->options as $opt)
                                                @if (($opt->option != null ? ($opt->option->attribute != null ? $opt->option->attribute->id : null) : null) == $item->id)
                                                    <option value='{{ $opt->id }}'>
                                                        {{ $opt->option->{'name_'.app()->getLocale()} }}
                                                    </option>
                                                @endif
                                            @endforeach

                                        </select>
                                    @endforeach
                                @endif

                                <div class="col-sm-12 form-group px-2 mb-5 d-flex align-items-center justify-content-start product_space">
                                    <label class="text-black font-weight-600  " for="qut">@lang('site.quantity')</label>
                                    <div class="input-group position-relative w-50 mx-4">
                                        <a href="#" class="down position-absolute pos-fixed-left-center px-4 z-index-2"><i class="far fa-minus black_text"></i></a>
                                        <input name="qut" type="number"
                                               id="qty_{{ $result->id }}" value="1"
                                               class="form-control w-100 px-6 text-center input-quality text-secondary h-60 fs-18 font-weight-bold " required="">
                                        <a href="#" class="up position-absolute pos-fixed-right-center px-4 z-index-2"><i class="far fa-plus black_text "></i>
                                        </a>
                                    </div>
                                </div>

                                    <input type="hidden" name="item_id" value="{{ $result->id }}" />
                                <div class="col-12 px-2 mb-5">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="w-40">
                                            <button type="submit"
                                                    class="btn btn-lg fs-18 btn-secondary btn-block h-60 bg-hover-primary border-hover-primary">

                                                @lang('site.buy_now')
                                            </button>
                                        </div>
                                        <div class="w-30">

                                            <a href="#"

                                               data-product-id="{{ $result->id }}"
                                               class="addToWishlist text-decoration-none font-weight-bold fs-16 d-flex align-items-center justify-content-center">
                                                <svg class="icon icon-star-light fs-20">
                                                    <use xlink:href="#icon-star-light"></use>
                                                </svg>
                                                <span class="ml-2">@lang('site.add_fav')</span>
                                            </a>
                                        </div>

                                        <div class="w-30">
                                            <a href="#" class="text-decoration-none font-weight-bold fs-16 d-flex align-items-center justify-content-center justify-content-md-start">
                                                <svg class="icon icon-ShareNetwork fs-20">
                                                    <use xlink:href="#icon-ShareNetwork"></use>
                                                </svg>
                                                <span class="ml-2">@lang('site.share')</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <div id="accordion-style" class="accordion mt-2">
                            <div class="card border-0 mb-4">
                                <div class="card-header border-0 p-0 bg-transparent bg-transparent"
                                     id="headingProductDetail">
                                    <h5 class="mb-0 fs-24 w-100">
                                        <a href="#"
                                           class="d-flex align-items-center border-bottom pb-2 text-decoration-none"
                                           data-toggle="collapse"
                                           data-target="#product-detail"
                                           aria-expanded="true" aria-controls="product-detail">
                                            <span>@lang("site.product_desc")</span>
                                            <span class="icon d-inline-block ml-auto"></span>
                                        </a>
                                    </h5>
                                </div>
                                <div id="product-detail" class="collapse show" aria-labelledby="headingProductDetail"
                                     data-parent="#accordion-style">
                                    <div class="card-body pt-5 pb-1 px-0 description_details">
                                        {!! $result['description_' . app()->getlocale()] !!}
                                    </div>
                                </div>
                            </div>
                            {{--
                            <div class="card border-0">
                                <div class="card-header border-0 p-0 bg-transparent bg-transparent" id="headingIngredients">
                                    <h5 class="mb-0 fs-24 w-100">
                                        <a href="#"
                                           class="d-flex align-items-center border-bottom pb-2 text-decoration-none collapsed"
                                           data-toggle="collapse"
                                           data-target="#ingredients"
                                           aria-expanded="true" aria-controls="ingredients">
                                            <span>عن الماركه التجارية</span>
                                            <span class="icon d-inline-block ml-auto"></span>
                                        </a>
                                    </h5>
                                </div>
                                <div id="ingredients" class="collapse" aria-labelledby="headingIngredients"
                                     data-parent="#accordion-style">
                                    <div class="card-body pt-5 pb-1 px-0">
                                        <div class="table-responsive mb-5">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                <tr>
                                                    <td class="pl-0 text-secondary">الكود</td>
                                                    <td class="text-right pr-0">92128-82-0, 9057-02-7</td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0 text-secondary">المكونات</td>
                                                    <td class="text-right pr-0">
                                                        المعلومات , تكتب هنا
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0 text-secondary">الكثافة</td>
                                                    <td class="text-right pr-0">
                                                        المعلومات , تكتب هنا
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0 text-secondary">المظهر</td>
                                                    <td class="text-right pr-0">
                                                        المعلومات , تكتب هنا
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0 text-secondary">المتانة</td>
                                                    <td class="text-right pr-0">
                                                        المعلومات , تكتب هنا
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pl-0 text-secondary">المساحة</td>
                                                    <td class="text-right pr-0">
                                                        المعلومات , تكتب هنا
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <p>
                                            تمكّنك التكنولوجيا المبتكرة من القلي والخبز والتحميص والشوي باستخدام كمية قليلة من الزيت أو بدونه،

                                            مزودة بتحكم قابل للتعديل في درجة الحرارة يسمح بالضبط المسبق لأفضل درجة حرارة للطهي،

                                            وتتميز بتصميم متطور للحصول على نتائج طهي لذيذة ومنخفضة الدهون

                                            تقلل 80 درجة مئوية سلة استهلاك ووعاء بطبقة غير لاصقة 80 درجة مئوية -200 درجة مئوية

                                            درجة حرارة طهي قابلة للتعديل سلة ووعاء بطبقة غير لاصقة

                                            عنصر تسخين من الفولاذ المقاوم للصدأ 0-30 دقيقة درجة حرارة طهي قابلة للتعديل
                                        </p>
                                    </div>
                                </div>
                            </div>
                            --}}
                        </div>

                        <h4 class="mb-3 row">
                            <span class="d-block col-4  text-black font-weight-600 fs-24">{{ __('site.sku') .": "}}</span>
                            <span class="d-block col-8 text-black font-weight-600 fs-24">{{$result->barcode}}</span>
                        </h4>

                        <div id="TabbyPromo"></div>



                    </div>
                </div>
            </div>
        </section>
        @if(count($list) > 0)
        <section class="pt-10 pt-lg-12 pb-15 pb-lg-11 border-top prods">
            <div class="container container-xl">
                <h3 class="text-center fs-34 mb-8">@lang("site.You may also like")</h3>
                <div class="slick-slider mx-n2"
                     data-slick-options='{"slidesToShow": 4,"dots":false,"arrows":false,"responsive":[{"breakpoint": 1368,"settings": {"arrows":false,"dots":true}},{"breakpoint": 1200,"settings": {"slidesToShow":3,"arrows":false,"dots":true}},{"breakpoint": 992,"settings": {"slidesToShow":2,"arrows":false,"dots":true}},{"breakpoint": 768,"settings": {"slidesToShow": 2,"arrows":false,"dots":true}},{"breakpoint": 576,"settings": {"slidesToShow": 2,"arrows":false,"dots":true}}]}'>
                    @foreach($list as $one)
                        <div class="box">
                            <div class="card border-0 product">
                                <a href="{{route("product",$one->id)}}">
                                    <div class="position-relative">
                                        <img class="imageSize"
               src="{{asset('assets/images/products/min/'.$one->img)}}">
                                        <div class="card-img-overlay d-flex p-3">
                                            <div class="badge-product-sale">
                                                <span class="new"></span>
                                            </div>
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


                </div>
            </div>
        </section>
        @endif

    </main>

@stop

@if($result->if_sale)
    <?php
    $sale=$result->sale_price;
    $regular=$result->regular_price;
    $total = get_price_helper2($result->sale_price,true)
    ?>
@else
   <?php $total = get_price_helper2($result->regular_price,true) ?>
@endif


<?php
    $currency_en = "KWD";
?>
@section('js')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        $('#add_cart').on('click', function(event) {
            event.preventDefault();
            addToCart();
        });

        function addToCart() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            let data = $('form').serializeArray();
            // let qut = $("input[name=qut]").val();
            // let attributes = $('select[name="attributes[]"]');
            // console.log(attributes);
            // let item_id = $("input[name=item_id]").val();

            $.ajax({
                url: "{{ route('add.cart.post') }}",
                method: 'post',
                data: data,
                success: function(result) {
                    if (result.status == 'success') {


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
                        title: result.data,


                    })
                        location.reload();
                    } else if (result.status == 'error') {
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
                        title: result.data,


                    })
                    }




                },
                error: function(error) {

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
                    // console.log(error);

                }
            });
        }
        let shareData = {
            url: window.location.href,
        }

        document.querySelector('#bn-share').addEventListener('click', () => {
            navigator.share(shareData);
        });
        changeStuff($('.first-elm'));
        var swiper = new Swiper(".mySwiper1", {
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            breakpoints: {
                freeMode: true,
            }
        });
        $(document).on('click', '.addToWishlist', function(e) {

            e.preventDefault();


            $.ajax({
                type: 'get',
                url: "{{ route('wishlist.store') }}",
                data: {
                    'productId': $(this).attr('data-product-id'),
                },
                success: function(data) {
                    if (data.status == 'success') {

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
                        title: data.message,


                    })

                    } else {
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
                        title: data.message,


                    })
                    }

                }
            });


        });

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

@endsection


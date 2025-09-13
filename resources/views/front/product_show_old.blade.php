@extends('layouts.front')
@section('title', $result->name)
@section('style')
    <link rel="stylesheet" href="{{ asset('front/product/css/main.css') }}">
    <style>
        .dropdownSection h2 {
            border-bottom: none;
            box-shadow: none;
        }

        .textDropdown {
            margin-top: 10px;
            border-color: #f2f2f2 !important;
            border-style: solid;
            border-width: 10px;
            border-top-width: 1px;
            border-radius: 10px;
            background-color: #ffffff;
        }

        .svg-inline--fa.fa-w-14 {
            color: var(--bs-primary-green);
        }

        @media (min-width: 571px) and (max-width: 768px) {
            .ads_header{
                display: none
            }
        }
        #design-product-data .is_order {
            width: 100%;
            /*text-align: center;*/
        }

        span.span-more {
            display: none;
        }
        #design-product-data .is_order  label.t_brand_name {
            color:var(--bs-primary-green);
        }
        .select-att {
            border: 2px solid var(--bs-primary-green); !important;
        }
        .card .abs{
            right: 178px !important;
            top: 237px !important;
        }
    </style>
@endsection
@section('content')

    <div id="product-data-div">

        <a class="product-path" href="{{ route('home') }}">
            @lang('site.index')
        </a>
        @if (!is_null($mainCategory))
            <a class="product-path">
                <i class="product-path fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} " style="font-size: 20px"></i>
            </a>

            <a class="product-path" href="{{ route('vendor', $mainCategory->id) }}">
                {{ $mainCategory['name_' . app()->getLocale()] }}
            </a>
        @endif

        @if (!is_null($subCategory))
            <a class="product-path">
                <i class="product-path fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} " style="font-size: 20px"></i>
            </a>

            <a class="product-path" href="{{ route('vendor', $subCategory->id) }}">
                {{ $subCategory['name_' . app()->getLocale()] }}
            </a>
        @endif

        <a class="product-path">
            <i class="product-path fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} " style="font-size: 20px"></i>
        </a>

        <a class="product-path">
            {{ $result->name }}
        </a>

    </div>


    <section id="design-parent">

        <div id="design-images-slider" class="row">
            {{-- <ol class=" position-relative navbar col-2"
      style="display: inline-block;/* width:100%; */margin-top:10px;z-index: 7;list-style: none;justify-content:center;">
      <br>



      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="">
          <img src=" {{asset('assets/images/products/min/' . $result->img) }}" class="img">
      </li><br>

      @if ($result->images->count() > 0)
          @foreach ($result->images as $img)

              <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index + 1 }}"
                  class="">
                  <img src="{{asset('assets/images/products/gallery/'.$img->src)}}" class="img">

              </li><br>

          @endforeach



      @endif
  </ol> --}}
            <div id="carouselExampleIndicators" class="carousel slide carousel1 col-12" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">

                        <img data-enlargeable src="{{ asset('assets/images/products/min/' . $result->img) }}"
                             class="d-block w-100 h-img" alt="..." data-toggle="modal" data-target="#staticBackdrop">
                    </div>


                    @if ($result->images->count() > 0)
                        @foreach ($result->images as $img)
                            <div class="carousel-item">
                                <img data-enlargeable src="{{ asset('assets/images/products/gallery/' . $img->src) }}"
                                     class="d-block w-100 h-img" alt="..." data-toggle="modal" data-target="#staticBackdrop">
                                {{-- <div class="  zoom "><a href="" data-toggle="modal" data-target="#zoom3"><i
                                  class="fas fa-expand-alt"></i></a></div> --}}

                            </div>
                        @endforeach
                    @endif


                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"
                   style="bottom: 25%!important ;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"
                          style="color:#000;background-color: #00000073;border-radius: 50%;padding: 11px;"></span>
                    <span class="sr-only">@lang('site.previous')</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"
                   style="bottom: 25%!important ; ">
                    <span class="carousel-control-next-icon" aria-hidden="true"
                          style=" color:#000;background-color: #00000073;border-radius: 50%;padding: 11px;"></span>
                    <span class="sr-only">@lang('site.next')</span>
                </a>
            </div>



        </div>
        <!-- Container for the image gallery -->


        <div class="pad-0" id="design-product-data" style="font-family: bein">
            <div class="d-flex justify-content-between">
                <h5>
                    {{ $result->name }}
                </h5>
                <span id="bn-share"> <i class="fas fa-share-square"></i></span>


            </div>
{{--            <div class="d-flex justify-content-between">--}}
{{--                <h6 style="height: 4vh;overflow:hidden">{!!\Illuminate\Support\Str::limit($result['description_' . app()->getlocale()], 50, '..')!!}</h6>--}}

{{--            </div>--}}

            <div class="d-flex justify-content-between">

                <div class="prod-price">
                    <div class="row">

                        @if ($result->if_sale)
                            <div class="col-6">
                                <span class="regular_price">{{ get_price_helper($result->regular_price,true) }} </span>
                            </div>
                            <div class="col-6">
                                <b>{{ get_price_helper($result->sale_price,true) }}</b>

                            </div>
                        @else
                            <div class="col-6">
                                <b>{{ get_price_helper($result->regular_price,true) }}</b>
                            </div>
                        @endif
                    </div>

                </div>

            </div>




            <div class=" justify-content-between">
                @if ($result->brand_name)
                    <span class="brand_name"><label class=" t_brand_name"> {{ __('site.brand_name') }} :
                            </label>
                            {{ $result->brand_name }}</span>
                @endif
                @if ($result->seller_name)
                    <span class="brand_name"> <label class=" t_brand_name"> {{ __('site.seller_name') }} :
                            </label> {{ $result->seller_name }}</span>
                @endif
                @if($result->is_order)
                    <div class="is_order" style="font-family: 'bein';">

                        {{ __('site.front_is_order_day')  }}  <label class=" t_brand_name"> {{ $result->day_order }} </label>  {{__('site.day') }}
                    </div>
                @endif
            </div>

            {{--                    @if ($result->seller_name)--}}
            {{--                <div class=" justify-content-between">--}}
            {{--                        <span class="brand_name"> <label class=" t_brand_name"> {{ __('site.seller_name') }} :--}}
            {{--                            </label> {{ $result->seller_name }}</span>--}}
            {{--                </div>--}}
            {{--                    @endif--}}
            {{--            @if($result->is_order)--}}
            {{--                <div class="is_order" style="font-family: 'bein';">--}}

            {{--                    {{ __('site.front_is_order_day')  }}  <label class=" t_brand_name"> {{ $result->day_order }} </label>  {{__('site.day') }}--}}
            {{--                </div>--}}
            {{--            @endif--}}
            <hr>


            <form method="post" id="cart-form" name="cart_form" action="{{ route('add.cart.post') }}">
                @csrf


                <div class="row w-100 align-items-center justify-content-between">
                    @if ($result->is_clothes == 1)
                        <select class="col-4 select-att" id="select_size" name='attributes[6]'>

                            <option style="color: black" value="0" selected>
                                {{ __('site.size') }}
                            </option>
                            @foreach ($result->attributesClothes as $item_attr)
                                @isset($item_attr->size)
                                    <option value='{{ $item_attr->size->id }}'>
                                        {{ $item_attr->size->name_ar }}
                                    </option>
                                @endisset
                            @endforeach


                        </select>
                        <select class="col-4 d-none select-att" id="select_color" name='attributes[7]' style="">

                        </select>
                    @else
                        @foreach ($result->attributes as $item)
                            <select class="col-4 select-att" name='attributes[{{ $item->id }}]'>

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
                    <hr>

                    <div class="col-3 product-count ">
                        <a rel="nofollow" class="btn btn-default btn-plus " href="" title="Add" style="position: relative;border-bottom-right-radius: 50%;
                                                border-top-right-radius: 50%;">
                            <span style="position: absolute;
                                                            top: 0%;
                                                            left: 30%;
                                                            font-size: 25px;">
                                +
                            </span></a>

                        <input type="number" style="text-align: center;padding: 3px;  width: 35px;border: 0 !important;"
                               name="qut" id="qty_{{ $result->id }}" value="1"
                               class="cart_quantity_input form-control grey count quantity" min='1' />
                        <a rel="nofollow" class="btn btn-default btn-minus " href="" title="Subtract" style="position: relative;border-bottom-left-radius: 50%;
                                                    border-top-left-radius: 50%;">
                            <span style="position: absolute;
                                                            top: 0%;
                                                            left: 30%;
                                                            font-size: 25px;">
                                &ndash;
                            </span>
                        </a>
                    </div>
                </div>
                <input type="hidden" name="item_id" value="{{ $result->id }}" />
                <hr>

                <div class="d-flex justify-content-between mt-3">
                    <button type="submit" id="add_cart" style="background-color: var(--bs-primary-green);cursor: pointer;
                                    color: white;width:75%;border-radius: 30px;
                                    border:0;
                                     border-color:var(--bs-primary-green);
                                    text-align: center;font-size: 15px;
                                    padding: 10px">

                        {{-- <i class="fa fa-shopping-cart" aria-hidden="true"></i> --}}
                        <img src="{{ asset('assets/images/icons/Group 1297.png') }}" style="width: 22px" alt="">
                        &nbsp;
                        &nbsp;
                        {{ __('site.add to cart') }}

                    </button>
                    @if (!Auth::guard('web')->check())
                        <a class="addToWishlist " href="{{ route('login/client') }}"
                           data-product-id="{{ $result->id }}">
                            <img src="{{ asset('assets/images/icons/Ellipse 37.png') }}" style="width: 45px" alt="">

                        </a>
                    @else
                        <a class="addToWishlist " href="" data-product-id="{{ $result->id }}">
                            <img src="{{ asset('assets/images/icons/Ellipse 37.png') }}" style="width: 45px" alt="">



                        </a>
                    @endif
                </div>

            </form>
            <hr>

            <div class="textDropdown row">
                <div class="col-md-6 col-12">
                    <div class="dropdownSection">
                        <h2 class="first-elm" onclick="changeStuff(this);" n-index='1'>{{ __('site.description') }}
                            <i class="fas fa-chevron-down "></i>
                        </h2>
                        <div class="textSection textSection1">
                            <p> {!! $result['description_' . app()->getlocale()] !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">

                    <div class="dropdownSection">
                        <h2 onclick="changeStuff(this);" n-index='2'>{{ __('site.about_brand') }} <i
                                class="fas fa-chevron-down"></i></h2>
                        <div class="textSection textSection2">
                            <p>{!! app()->getLocale() == 'ar' ? $result->about_brand_ar : $result->about_brand_en !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">

                    <div class="dropdownSection">
                        <h2 onclick="changeStuff(this);" n-index='4'>{{ __('site.exchange_policy') }} <i
                                class="fas fa-chevron-down"></i></h2>
                        <div class="textSection textSection4">
                            <p>{!! app()->getLocale() == 'ar' ? $result->exchange_policy_ar : $result->exchange_policy_en !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">

                    <div class="dropdownSection">
                        <h2 onclick="changeStuff(this);" n-index='5'>{{ __('site.shipping_policy') }} <i
                                class="fas fa-chevron-down"></i></h2>
                        <div class="textSection textSection5">
                            <p>{!! app()->getLocale() == 'ar' ? $result->shipping_policy_ar : $result->shipping_policy_en !!}</p>
                        </div>
                    </div>
                </div>



            </div>
        </div>

        </div>

    </section>
    <br>
    <br>
    <br>
    <section>
        <!--        USE BOOTSTRAP-->
        <div class="container" id="titles" style="display: flex;flex-direction: column">


            @include('front.includes.list_pro3', [
                'title' => __('site.product_rel'),
                'data' => $list,
            ])

        </div>
    </section>
    <div class="show_div">
        <div class="overlay"></div>
        <div class="img-show"><span>X</span><img src=""></div>
    </div>
@stop
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
         function changeStuff(elm) {
            var num = $(elm).attr('n-index');
            let elm_text = $(".textSection" + num);
            let elm_i = $(elm).children();
             console.log(num);
            if (elm_text.css('display') == "none") {
                $(".textSection").css('display', "none");
                elm_text.css('display', "block");
                $('.dropdownSection .fa-chevron-up').addClass('fa-chevron-down').removeClass('fa-chevron-up');

                elm_i.addClass('fa-chevron-up').removeClass('fa-chevron-down');
            } else {
                $(".textSection").css('display', "none");
                elm_i.addClass('fa-chevron-down').removeClass('fa-chevron-up');
                $('.dropdownSection .fa-chevron-up').addClass('fa-chevron-down').removeClass('fa-chevron-up');
            }
        }
    </script>
    <script>
        $('select#select_size').on('change', function(e) {
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
                    Swal.fire({
                        title: 'لم تكتمل العمليه ',
                        icon: '?',
                        confirmButtonColor: '#d76797',
                        position: 'bottom-start',
                        showCloseButton: true,
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
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: result.data,
                            animation: false,
                            position: 'bottom-start',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                        location.reload();
                    } else if (result.status == 'error') {
                        Swal.fire({
                            title: result.data,
                            icon: '?',
                            font-size:5px,
                            confirmButtonColor: '#00CECE',
                            position: 'bottom-start',
                            showCloseButton: true,
                        })
                    }




                },
                error: function(error) {


                    // console.log(error);
                    Swal.fire({
                        title: 'لم تكتمل العمليه ',
                        icon: '?',
                        confirmButtonColor: '#d76797',
                        position: 'bottom-start',
                        showCloseButton: true,
                    })

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
                        Swal.fire({
                            icon: 'success',
                            title: 'Done',
                            text: data.message,
                            confirmButtonText: 'okay'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message,
                            confirmButtonText: 'okay'
                        });
                    }

                }
            });


        });

{{--        function changeStuff(elm) {--}}
{{--            var num = $(elm).attr('n-index');--}}
{{--            let elm_text = $(".textSection" + num);--}}
{{--            let elm_i = $(elm).children();--}}
{{--            // console.log(num);--}}
{{--            if (elm_text.css('display') == "none") {--}}
{{--                $(".textSection").css('display', "none");--}}
{{--                elm_text.css('display', "block");--}}
{{--                $('.dropdownSection .fa-chevron-up').addClass('fa-chevron-down').removeClass('fa-chevron-up');--}}

{{--                elm_i.addClass('fa-chevron-up').removeClass('fa-chevron-down');--}}
{{--            } else {--}}
{{--                $(".textSection").css('display', "none");--}}
{{--                elm_i.addClass('fa-chevron-down').removeClass('fa-chevron-up');--}}
{{--                $('.dropdownSection .fa-chevron-up').addClass('fa-chevron-down').removeClass('fa-chevron-up');--}}
{{--            }--}}
{{--        }--}}

        $(".carousel-item img").click(function() {
            var $src = $(this).attr("src");
            $(".img-show img").attr("src", $src);

            $(".show_div").fadeIn();
        });

        $("span, .overlay").click(function() {
            $(".show_div").fadeOut();
        });
    </script>
@endsection


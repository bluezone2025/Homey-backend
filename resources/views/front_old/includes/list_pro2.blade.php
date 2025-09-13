<!-- start homepage-collections -->


<section class="my-lg-7 prods">
    <div class="container container-xl">
        <div class="d-flex align-items-center justify-content-between mb-md-6">
            <div class="">
                <h2 class="fs-34"  >{{$title}}</h2>
            </div>
            <div class="text-md-right">
                <a href="{{$url}}" class="btn btn-link p-0">{{__('site.more')}} <i class="far fa-arrow-right pl-2 fs-13"></i></a>
            </div>
        </div>
        <div class="slick-slider mx-n2"
             data-slick-options='{"slidesToShow": 5,"dots":false,"arrows":true,"responsive":[{"breakpoint": 1368,"settings": {"slidesToShow":4,"arrows":false,"dots":true}},{"breakpoint": 1200,"settings": {"slidesToShow":3,"arrows":false,"dots":true}},{"breakpoint": 992,"settings": {"slidesToShow":2,"arrows":false,"dots":true}},{"breakpoint": 768,"settings": {"slidesToShow": 2,"arrows":false,"dots":false}},{"breakpoint": 576,"settings": {"slidesToShow": 2,"arrows":false,"dots":false}}]}'>
            @foreach($data as $kvalue => $one)
                <div class="box">
                <div class="card border-0 product">
                    <div class="position-relative">
                        <img src="{{asset('assets/images/products/min/'.$one->img)}}">
                        <div class="card-img-overlay d-flex p-3">
                            <div class="badge-product-sale">
                                <span class="new"></span>
                            </div>
                            <div class="my-auto w-100 content-change-vertical">
                                <a href="{{route("product",$one->id)}}"
                                   data-toggle="tooltip" data-placement="bottom" title="عرض المنتج"
                                   class="add-to-cart ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2">
                                    <svg class="icon icon-shopping-bag-open-light fs-24">
                                        <use xlink:href="#icon-shopping-bag-open-light"></use>
                                    </svg>
                                </a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="عرض سريع"
                                   class="preview ml-auto d-md-flex align-items-center justify-content-center cursor-pointer text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2 d-none">
                                    <span data-toggle="modal" data-target="#quick-view{{$one->id}}">
                                      <svg class="icon icon-eye-light fs-24">
                                        <use xlink:href="#icon-eye-light"></use>
                                      </svg>
                                    </span>
                                </a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="اضافة الى المفضلة"
                                   class="add-to-wishlist ml-auto d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mb-2">
                                    <svg class="icon icon-star-light fs-24">
                                        <use xlink:href="#icon-star-light"></use>
                                    </svg>
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-4 text-center m-auto m-md-1 d-block d-md-flex justify-content-between align-items-center">
                        <p class="card-text font-weight-bold fs-16 mb-1 text-secondary">
                            <span class="fs-13 font-weight-500 text-decoration-through text-body pr-1">$39.00</span>
                            <span>$29.00</span>
                        </p>
                        <h2 class="card-title fs-15 font-weight-500 "><a href="product-detail-01.html"> طقم 6 اكواب</a></h2>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>


<section class="homepage-collections slide-container swiper">
    <div class="container-fluid slide-content-offers">

        <div class="box_container_title">
            <h1>{{$title}}</h1>
            <a href="{{$url}}">{{__('site.more')}}</a>
        </div>

        <div class="box-container card-wrapper swiper-wrapper">
            @foreach($data as $kvalue => $one)
                <div class="box swiper-slide">
                    <div class="img">
                        @if(!Auth::guard('web')->check())
                            <a href="{{route('login/client')}}" class="icon_heart">
                                <i class='bx bx-heart'></i>
                            </a>
                        @elseif(Auth::guard('web')->check())
                            <a  class="icon_heart addToWishlist" data-product-id = "{{$one->id}}">
                                <i class='bx bx-heart'></i>
                            </a>
                        @endif
                        <a href="{{route("product",$one->id)}}" title="{{$title}}">
                            <img class="home-collection-img lozad" data-src="" src="{{asset('assets/images/products/min/'.$one->img)}}"
                                 data-loaded="true">
                        </a>
                        <a href="{{route('add.cart',[$one->id,1])}}" class="icon_shopping">
                            <i class='bx bx-shopping-bag' ></i>
                        </a>
                    </div>
                    <div class="title">
                        <a href="{{route("product",$one->id)}}" title="{{\Illuminate\Support\Str::limit($one->name, 14, '..')}}">
                            {{\Illuminate\Support\Str::limit($one->name, 14, '..')}}
                        </a>
                    </div>
                    <div class="discount-container">
                        <div class="price mr-3 ml-3">
                            @if($one->if_sale)
                                <h6 class="old_price">{{get_price_helper($one->regular_price,true)}} </h6>
                                <h6 class="new_price">{{get_price_helper($one->sale_price,true)}}</h6>

                            @else
                                <h6 class="new_price">{{get_price_helper($one->regular_price,true)}} </h6>
                            @endif
                        </div>
                        @if($one->if_sale)
                            <?php
                            $sale=$one->sale_price;
                            $regular=$one->regular_price;
                            $discount=100 - round(($sale/$regular)*100,1);
                            ?>
                        <div class="discount-percentage mr-3 ml-3">
                           {{$discount .'%'}}
                        </div>
                        @endif
                    </div>

                </div>
            @endforeach


        </div>
    </div>
</section>
<!-- end homepage-collections -->
{{--<section class="homepage-collections-sale slide-container swiper">--}}
{{--    <div class="container slide-content-sale_one">--}}

{{--        <div class="box_container_title">--}}
{{--            <h1>{{$title}}</h1>--}}
{{--            <a href="{{$url}}">{{__('site.more')}}</a>--}}
{{--        </div>--}}

{{--        <div class="box-container card-wrapper swiper-wrapper">--}}
{{--            @foreach($data as $kvalue => $one)--}}
{{--            <div class="box swiper-slide">--}}
{{--                <div class="img">--}}
{{--                    @if(!Auth::guard('web')->check())--}}
{{--                    <a href="{{route('login/client')}}" class="icon_heart">--}}
{{--                        <i class='bx bx-heart'></i>--}}
{{--                    </a>--}}
{{--                    @elseif(Auth::guard('web')->check())--}}
{{--                        <a  class="icon_heart addToWishlist" data-product-id = "{{$one->id}}">--}}
{{--                            <i class='bx bx-heart'></i>--}}
{{--                        </a>--}}
{{--                    @endif--}}
{{--                    <a href="{{route("product",$one->id)}}" title="{{$title}}">--}}
{{--                        <img class="home-collection-img lozad" data-src="" src="{{asset('assets/images/products/min/'.$one->img)}}"--}}
{{--                             data-loaded="true">--}}
{{--                    </a>--}}
{{--                    <a href="{{route('add.cart',[$one->id,1])}}" class="icon_shopping">--}}
{{--                        <i class='bx bx-shopping-bag' ></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="title">--}}
{{--                    <a href="{{route("product",$one->id)}}" title="{{\Illuminate\Support\Str::limit($one->name, 14, '..')}}">--}}
{{--                        {{\Illuminate\Support\Str::limit($one->name, 14, '..')}}--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="price">--}}
{{--                    @if($one->if_sale)--}}
{{--                        <h6 class="old_price">{{get_price_helper($one->regular_price)}} </h6>--}}
{{--                        <h6 class="new_price">{{get_price_helper($one->sale_price)}}</h6>--}}

{{--                    @else--}}
{{--                        <h6 class="new_price">{{get_price_helper($one->regular_price)}} </h6>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endforeach--}}

{{--        </div>--}}

{{--        <div class="swiper-button-next swiper-navBtn sale_one"></div>--}}
{{--        <div class="swiper-button-prev swiper-navBtn sale_one"></div>--}}
{{--        <div class="swiper-pagination sale_one"></div>--}}
{{--    </div>--}}
{{--</section>--}}


{{--<div class="container border-main pt-4 shop-section" >--}}

{{--    <div class="row  row5 text-center ">--}}
{{--        <div class="col-8 text-right">--}}
{{--            <h1 class="head-h1"> {{$title}}</h1>--}}
{{--        </div>--}}
{{--        <div class="col-4 text-left align-self-center" >--}}
{{--            <span class="span-more "> <a class="a-more" href="{{$url}}">{{__('site.more')}}</a></span>--}}
{{--        </div>--}}
{{--         <div  class="swiper-container-1 col-12 text-center" >--}}
{{--            <div class="swiper mySwiper2 text-center row w-100 mx-auto custom-h" >--}}
{{--               <div class="swiper-wrapper">--}}
{{--               @foreach($data as $kvalue => $one)--}}
{{--               <div class=" swiper-slide"  >--}}
{{--                   <br>--}}
{{--                   <div class="card" >--}}
{{--                     {!! $one->if_sale? '<h6 class="bg-main abs">'.round($one->discount_percentage,1,PHP_ROUND_HALF_DOWN) .'%</h6>':''!!}--}}
{{--                     {!! $one->is_order? '<h6 class="bg-main is_order">'. __('site.front_is_order') .'</h6>':''!!}--}}

{{--                     <a href="{{route("product",$one->id)}}" style="padding: 5px 5px 0;">--}}
{{--                        <div class="h-resp" style="height:41vh;overflow:hidden">--}}
{{--                        <img class="" style="--}}
{{--                         width: auto;display: block;--}}
{{--                         margin-left: auto;--}}
{{--                         margin-right: auto;    width: 100%; height: 265px;" src="{{asset('assets/images/products/min/'.$one->img)}}" class="card-img-top  " alt="{{$one->name}}" >--}}

{{--                        </div>--}}
{{--                     </a>--}}
{{--                     <div class="card-body">--}}
{{--                         <a href="{{route("product",$one->id)}}" class="card-text ">{{\Illuminate\Support\Str::limit($one->name, 14, '..')}}</a>--}}
{{--                         <p class="card-title" href="">--}}
{{--                           @if($one->if_sale)--}}
{{--                             <b>{{get_price_helper($one->sale_price)}}</b>--}}
{{--                             <span class="regular_price">{{get_price_helper($one->regular_price)}} </span>--}}
{{--                           @else--}}
{{--                             <b>{{get_price_helper($one->regular_price)}}</b>--}}
{{--                           @endif--}}


{{--                         </p>--}}
{{--                     </div>--}}
{{--                     <div class="row mr-0 btn-item-product add_to_cart">--}}
{{--                       <a href="{{route('add.cart',[$one->id,1])}}" class="btn btn-dark border col-9 add-to-cart-btn">{{__('site.add to cart')}}</a>--}}
{{--                       @if(!Auth::guard('web')->check())--}}
{{--                         <div class="btn btn-light border col-3 heart text-center">--}}
{{--                            <a class="addToWishlist" href="{{route('login/client')}}">--}}

{{--                              <i class="far fa-heart  heart-block"></i>--}}
{{--                            </a>--}}

{{--                         </div>--}}
{{--                           @elseif(Auth::guard('web')->check())--}}
{{--                               <div class="addToWishlist btn btn-light border col-3 heart text-center" data-product-id = "{{$one->id}}">--}}

{{--                                 <i class=" far fa-heart  heart-block" ></i>--}}
{{--                               </div>--}}

{{--                           @endif--}}
{{--                     </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              @endforeach--}}

{{--            </div>--}}
{{--            <!-- Add Pagination -->--}}
{{--            <div class="swiper-pagination"></div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{-- </div>--}}

{{--</div>--}}

@section('modal')
@foreach($data as $key => $two)
    <div class="modal fade quick-view{{$one->id}}" id="quick-view{{$one->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 py-0">
                    <button type="button" class="close fs-32" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <div class="row">
                        <div class="col-md-6 pr-xl-5 mb-8 mb-md-0 pl-xl-8">
                            <div class="galleries-product product galleries-product-02 position-relative">
                                <div class="position-absolute pos-fixed-top-right z-index-2">
                                    <div class="content-change-vertical">
                                        <a href="#" data-toggle="tooltip" data-placement="left" title="اضافة للمفضلة"
                                           class="add-to-wishlist d-flex align-items-center justify-content-center text-secondary bg-white hover-white bg-hover-secondary w-48px h-48px rounded-circle mt-3 mr-3">
                                            <svg class="icon icon-star-light fs-24">
                                                <use xlink:href="#icon-star-light"></use>
                                            </svg>
                                        </a>

                                    </div>
                                </div>
                                <div class="view-slider-for mx-0">

                                    <div class="box px-0" >
                                        <div class="card p-0 rounded-0 border-0">
                                            <a href="{{asset('assets/images/products/min/'.$one->img)}}" class="card-img">
                                                <img src="{{asset('assets/images/products/min/'.$one->img)}}" alt="product gallery">
                                            </a>
                                        </div>
                                    </div>
                                    @if(count($one->images) > 0)
                                    @foreach($one->images as $photo)
                                        <div class="box px-0" >
                                            <div class="card p-0 rounded-0 border-0">
                                                <a href="{{asset($photo->img)}}" class="card-img">
                                                    <img src="{{ asset($photo->img) }}" alt="product gallery">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif
                                </div>
                                <div class="view-slider-nav mx-n1">

                                    <div class="box py-4 px-1 cursor-pointer">
                                        <img src="{{asset('assets/images/products/min/'.$one->img)}}" alt="product gallery">
                                    </div>
                                    @if(count($one->images) > 0)
                                    @foreach($one->images as $photo)
                                        <div class="box py-4 px-1 cursor-pointer">
                                            <img src="{{$photo->img}}" alt="product gallery">
                                        </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pl-xl-6 pr-xl-8">
                            <p class="d-flex align-items-center mb-3">
                                @if($one->if_sale)

                                    <?php
                                    $sale=$one->sale_price;
                                    $regular=$one->regular_price;
                                    $discount=100 - round(($sale/$regular)*100,1);
                                    ?>
                                    <span class="text-line-through">{{get_price_helper($one->regular_price,true)}}</span>
                                    <span class="fs-18 text-secondary font-weight-bold ml-3">{{get_price_helper($one->sale_price,true)}}</span>
                                    <span class="badge badge-primary fs-16 ml-4 font-weight-600 px-3">{{$discount}}</span>
                                @else

                                    <span class="fs-18 text-secondary font-weight-bold ml-3">{{get_price_helper($one->regular_price,true)}}</span>
                                @endif
                            </p>
                            <h2 class="fs-24 mb-2">{{\Illuminate\Support\Str::limit($one->name, 14, '..')}}</h2>
                            {{--<div class="d-flex align-items-center flex-wrap mb-3 lh-12">
                                <p class="mb-0 font-weight-600 text-secondary">4.86</p>
                                <ul class="list-inline d-flex mb-0 px-3 rating-result">
                                    <li class="list-inline-item mr-0">
                                        <span class="text-primary fs-12 lh-2"><i class="fas fa-star"></i></span>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <span class="text-primary fs-12 lh-2"><i class="fas fa-star"></i></span>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <span class="text-primary fs-12 lh-2"><i class="fas fa-star"></i></span>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <span class="text-primary fs-12 lh-2"><i class="fas fa-star"></i></span>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <span class="text-primary fs-12 lh-2"><i class="fas fa-star"></i></span>
                                    </li>
                                </ul>
                                <a href="#" class="pl-3 border-left border-gray-2 text-body">اقرا 2947 تقييم</a>
                            </div>--}}
                            <p class="mb-4 mr-xl-6">{{\Illuminate\Support\Str::limit($one->name, 100, '..')}}</p>
                            <p class="mb-2">
                            <form method="post" id="cart{{ $one->id}}" name="cart_form" class="col-md-6 col-12" action="{{ route('add.cart.post') }}">

                                <div class="form-group shop-swatch mb-4 d-flex align-items-center">
                                    <span class="font-weight-600 text-secondary mr-4">الحجم :</span>
                                    <ul class="list-inline d-flex justify-content-start mb-0">
                                        <li class="list-inline-item mr-2 selected font-weight-600">
                                            <a href="#"
                                               class="fs-14 p-2 lh-13 d-block swatches-item rounded text-decoration-none border"
                                               data-var="full size">الحجم الكبير</a>
                                        </li>
                                        <li class="list-inline-item font-weight-600">
                                            <a href="#"
                                               class="fs-14 p-2 lh-13 d-block swatches-item rounded text-decoration-none border"
                                               data-var="mini size">الحجم الصغير</a>
                                        </li>
                                    </ul>
                                    <select name="swatches" class="form-select swatches-select d-none"
                                            aria-label="Default select example">
                                        <option selected value="full size">الحجم الكبير</option>
                                        <option value="mini size">الحجم الصغير</option>
                                    </select>
                                </div>
                                <div class="row align-items-end no-gutters mx-n2">
                                    <div class="col-sm-4 form-group px-2 mb-6">
                                        <label class="text-secondary font-weight-600 mb-3"
                                               for="quickview-number">الكمية :</label>
                                        <div class="input-group position-relative w-100">
                                            <a href="#" onClick="update_cart({{$one->id}},{{$one->price}},'minus',{{$one->id}});"
                                               rel="nofollow" data-id="{{$one->id}}" class="down position-absolute pos-fixed-left-center pl-4 z-index-2"><i
                                                        class="far fa-minus"></i></a>
                                            <input name="qut" id="qty_{{$one->id}}" type="number"
                                                   class="form-control w-100 px-6 text-center input-quality text-secondary h-60 fs-18 font-weight-bold border-0"
                                                   value="<?=(isset((\Session::get('cart'))[$one->id]['quantity'])) ? (\Session::get('cart'))[$one->id]['quantity'] : 1 ?>" required>
                                            <a href="#"
                                               onClick="update_cart({{$one->id}},{{$one->price}},'plus',{{$one->id}});"
                                               rel="nofollow"
                                               class="up position-absolute pos-fixed-right-center pr-4 z-index-2"><i
                                                        class="far fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 mb-6 w-100 px-2">
                                        <button type="submit"
                                                class="btn btn-lg fs-18 btn-secondary btn-block h-60 bg-hover-primary">اضف للسلة
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="d-flex align-items-center flex-wrap">
                                <a href="#" class="text-decoration-none font-weight-bold fs-16 mr-6 d-flex align-items-center">
                                    <svg class="icon icon-star-light fs-20">
                                        <use xlink:href="#icon-star-light"></use>
                                    </svg>
                                    <span class="ml-2">اضافة للمفضلة</span>
                                </a>
                                <a href="#" class="text-decoration-none font-weight-bold fs-16 d-flex align-items-center">
                                    <svg class="icon icon-ShareNetwork">
                                        <use xlink:href="#icon-ShareNetwork"></use>
                                    </svg>
                                    <span class="ml-2">مشاركة</span>
                                </a>
                            </div>
                            <ul class="list-unstyled border-top pt-5 mt-5">
                                <li class="row mb-2">
                                    <span class="d-block col-3 col-lg-3 text-secondary font-weight-600 fs-14">Sku:</span>
                                    <span class="d-block col-9 col-lg-9 fs-14">SF09281</span>
                                </li>
                                <li class="row mb-2">
                                    <span class="d-block col-3 col-lg-3 text-secondary font-weight-600 fs-14">التصنيف :</span>
                                    <span class="d-block col-9 col-lg-9 fs-14">منتجات العسل</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection
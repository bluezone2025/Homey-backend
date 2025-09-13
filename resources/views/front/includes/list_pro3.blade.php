
<section class="homepage-collections-sale slide-container swiper">
    <div class="container-fluid  slide-content-sale_one mr-2 max_height">

        <div class="box_container_title">
            <h1>{{$title}}</h1>
        </div>

        <div class="box-container card-wrapper swiper-wrapper max_height">
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
                    <div class="price">
                        @if($one->if_sale)
                            <h6 class="old_price">{{get_price_helper($one->regular_price,true)}} </h6>
                            <h6 class="new_price">{{get_price_helper($one->sale_price,true)}}</h6>

                        @else
                            <h6 class="new_price">{{get_price_helper($one->regular_price,true)}} </h6>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>

        <div class="swiper-button-next swiper-navBtn sale_one"></div>
        <div class="swiper-button-prev swiper-navBtn sale_one"></div>
        <div class="swiper-pagination sale_one"></div>
    </div>
</section>
{{--<section>--}}
{{--    <div class="products_preview">--}}
{{--        <div class="preview" data-target="">--}}
{{--            <i class="bx bx-x"></i>--}}
{{--            <img src="img/collections-sale/1.png" alt="">--}}
{{--            <h3 class="title">--}}
{{--                مارادو جهاز طبخ الأرز سعة 2.2 لتر--}}
{{--            </h3>--}}
{{--            <p>--}}
{{--                Lorem ipsum dolor sit amet consectetur adipisicing elit.--}}
{{--                Ipsam dolores, reiciendis quae cumque beatae nam voluptatibus a facere--}}
{{--                odio sunt architecto fuga dolore praesentium illum iste nisi. Id, tenetur rem.--}}
{{--            </p>--}}
{{--            <div class="price">--}}
{{--                <h6 class="old_price">38.00 K.D</h6>--}}
{{--                <h6 class="new_price">28.00 K.D</h6>--}}
{{--            </div>--}}
{{--            <div class="btn">--}}
{{--                <a href="#">اضف الي السلة</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}


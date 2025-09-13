
{{--<div class=" container main-ad2">--}}
{{--<div class="swiper mySwiper1" style="height:auto;">--}}
{{--  <div class="swiper-wrapper"style="height:auto;">--}}
{{--    @foreach($items as $one)--}}
{{--      <div class="swiper-slide @if($loop->first) active @endif" >--}}
{{--      <a class="w-100" href="{{$one -> in_app==0?$one ->link :($one ->type == 'product'?route("product",$one->link):route("vendor",$one->link))}}" target="_blank">--}}
{{--        <img class="d-block img-ads" style="--}}
{{--          width: 100%;display: block;--}}
{{--          margin-left: auto;--}}
{{--          height: 300px !important;--}}
{{--          margin-right: auto;" data-aos="fade-right"--}}

{{--          src="{{asset('assets/images/ads/'.$one->img)}}" alt="">--}}
{{--        </a>--}}
{{--      </div>--}}
{{--    @endforeach--}}
{{--  </div>--}}
{{--</div>--}}
{{--</div>--}}

<section>
    <div class="slide-container swiper">
        <div class="slide-content-one">
            <div class="card-wrapper swiper-wrapper">
                @foreach($items as $one)
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <div class="card-image2">
                                <a class="text-decoration-none" href="{{$one -> in_app==0?$one ->link :($one ->type == 'product'?route("product",$one->link):route("vendor",$one->link))}}" target="_blank">
                                    <img  src="{{asset('assets/images/ads/'.$one->img)}}" alt="" class="card-img">
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="swiper-button-next swiper-navBtn one"></div>
        <div class="swiper-button-prev swiper-navBtn one"></div>
        <div class="swiper-pagination one"></div>
    </div>
</section>

<a href="{{route("cart.show")}}" class="icon_shopping text-decoration-none mr-5"  >
    <span> {{ (session('cart')  !== null )? count(session('cart')): 0  }} </span>
    <i class='bx bx-shopping-bag' ></i>
</a>

<div id="cart_body" class=" li2 pad-0"  >

    <div class="row border-bottom mr-0">
        <div class="col-9">there is ({{ (session('cart')  !== null )? count(session('cart')): 0  }}) item</div>
        <div class="col-3 price_cart_total"> {{get_price_helper(0)}} </div>

    </div>

    <br>
    <?php $price_c=0; ?>
    @if(session('cart'))

        @foreach(session('cart') as $id => $details)
            @foreach($details as  $detail)
                <?php
                $product = \App\Models\Product::where('id', $detail['id'])->first();
                $price_pr_c=$detail['price']*$detail['quantity'];
                $price_c=$price_c+$price_pr_c;

                ?>

                <div class="row  mr-0 border-bottom">
                    <div class="col-3  ">
                        <a href="{{route("product",$product->id)}} ">
                            <img alt="{{$product->name_en}}" src="{{asset('assets/images/products/min/'.$product->img)}}"  class="w-100">
                        </a>
                    </div>
                    <div class="col-9 ">
                        <a href=" {{route("product",$product->id)}} " class="active "><h6>{{$product->name}}</h6></a>
                        <h6 class="">@lang('site.category') : {{$product->categories->first() !=null ? $product->categories->first()->name:''}} </h6>
                        <h6 class="">
                            @if($product->if_sale)
                                <b>{{get_price_helper($product->sale_price,true)}}</b>
                                <span class="regular_price">{{get_price_helper($product->regular_price,true)}} </span>
                            @else
                                <b>{{get_price_helper($product->regular_price)}}</b>
                            @endif
                        </h6>
                    </div>
                </div>
            @endforeach
        @endforeach
        <script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
        <script>
  $('.price_cart_total').text("{{get_price_helper($price_c,true)}}");
</script>
    @else
        <h6 class="text-center" style="color:#41479b"> @lang('site.There are no items in the cart')  </h6>
    @endif
    <br>
    @if(session('cart'))
        <div class="row  mr-0">
            <!--
            <p  class="col-6  ">cart subtotal</p>
            <p  class="col-6  text-right"> $800.00</p>
            -->
            <div class="col-6  ">
                <a  href="{{route("checkout")}}" class="btn w-100 bg-main ">@lang('site.Checkout') </a>
            </div>
            <div class="col-6  ">
                <a  href="{{route("cart.show")}}" class="btn w-100 btn-light border">@lang('site.View bag') </a>
            </div>
        </div>
    @endif
    <br>

</div>

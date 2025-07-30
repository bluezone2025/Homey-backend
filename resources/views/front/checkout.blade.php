@extends('layouts.front')
@section('title')
    @lang('site.home')

@endsection
@section('content')
    <!-----start  --->
    {{-- @if (Session::has('coupon'))
    {{ dd(session()->get('coupon')) }}
    @endif --}}
    @if (Session::has('cart'))

        <div class="container-fluid ">
            <br><br>
            <div class="row pad  dir-rtl">
                <div class="col-12 col-lg-8 ">
                    <div class=" border text-dir ">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{{ session('error') }}</li>
                                    </ul>
                                </div>
                            @endif
                        <div class="bg-b row mr-0" style="padding-top: 8px">
                            <h3 class=" col-12">@lang('site.shipping_details')</h3>
                        </div>
                        <br>
                        <div class="row mr-0">
                            <form class="form-vertical col-md-12 col-xs-12 " id="orders-form"
                                action="{{ route('order.store') }}" method="post">

                                @csrf
                                <!--<div class="alert alert-success" style="margin-top: -45px;text-align:center"></div>
                                       -->
                                <h6>@lang('site.mandatory')</h6>

                                @guest()
                                    <input value="0" name="user_id" id="Orders_user_id" type="hidden">

                                    <div class="form-group">
                                        <label for="Orders_address_line1" class="required font-weight-bold" style="color:red">
                                            @lang('site.full_name')
                                            <span class="required">*</span></label>
                                        <input class="form-control" placeholder="User Name" name="name" id="Orders_full_name"
                                            value="{{ old('name') }}" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="Orders_address_line1" class="required font-weight-bold" style="color:red">
                                            @lang('site.email') <span class="required">*</span></label>
                                        <input class="form-control" placeholder="E-mail" required="required" name="email"
                                            id="Orders_email" type="email">
                                    </div>


                                    <div class="form-group">
                                        <label for="Orders_address_line1" class="required font-weight-bold"
                                            style="color:red">@lang('site.phone')
                                            <span class="required">*</span>
                                        </label>
                                        <br>
                                        <input id="phone_code" class="form-control" required="required" name="phone"
                                            value="{{ old('phone') }}" type="number" maxlength="11">
                                    </div>
                                    <div class="row">
                                            <div class="col-md-3">
                                               <div class="form-group">
                                                    <label for="Orders_country_id" class="required font-weight-bold"
                                                        style="color:red">@lang('site.country') <span
                                                            class="required">*</span></label>
                                                    <select style="height: 45px;    ;" class="form-control" name="country_id"
                                                        value="{{ old('country_id') }}" id="Orders_country_id">
            
                                                        @foreach (\App\Country::all() as $country)
            
                                                            <option value="{{ $country->id }}">
                                                                @if (Lang::locale() == 'ar')
                                                                    {{ $country->name_ar }}
            
                                                                @else
                                                                    {{ $country->name_en }}
            
            
                                                                @endif
            
            
                                                            </option>
            
                                                        @endforeach
            
            
                                                    </select>
            
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                  <div class="form-group">
                                                        <label for="Orders_city_id" class="required font-weight-bold" style="color:red">
                                                            @lang('site.city') <span class="required">*</span></label>
                                                        <select style="height: 45px; " class="form-control" name="city_id"
                                                            id="Orders_city_id">
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="col-md-3">
                                                  <div class="form-group">
                                                        <label for="region" class="required font-weight-bold" style="color:red">
                                                            @lang('site.region') <span class="required">*</span></label>
                                                        <input class="form-control" placeholder="" name="region" id="region"
                                                        value="{{ old('region') }}" type="text" maxlength="150">
                                                    </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="the_plot" class="required font-weight-bold"
                                                        style="color:red"><span class="required">*</span>@lang('site.the_plot')</label>
                                                    <input class="form-control" placeholder="" name="the_plot" id="the_plot"
                                                        value="{{ old('the_plot') }}" type="text" maxlength="150">
                                                </div>
                                            </div>
                                    </div>
                                    
                                  



                                    {{-- <div  id="test"> --}}
                                    {{-- </div> --}}



                                @else

                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                    <input type="hidden" id="Orders_country_id" name="country_id"
                                        value="{{ Auth::user()->country_id }}">
                                    <input type="hidden" name="phone" value="{{ Auth::user()->phone }}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Orders_city_id" class="required font-weight-bold" style="color:red">
                                                    @lang('site.city') <span class="required">*</span></label>
                                                <select style="height: 45px;   " class="form-control" name="city_id"
                                                    id="Orders_city_id">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="region" class="required font-weight-bold" style="color:red">
                                                    @lang('site.region') <span class="required">*</span></label>
                                                <input class="form-control" placeholder="" name="region" id="region"
                                                value="{{ old('region') }}" type="text" maxlength="150">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="the_plot" class="required font-weight-bold"
                                                    style="color:red"><span class="required">*</span>@lang('site.the_plot')</label>
                                                <input class="form-control" placeholder="" name="the_plot" id="the_plot"
                                                    value="{{ old('the_plot') }}" type="text" maxlength="150">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="test">
                                    </div>




                                @endguest

                               
                                <input class="form-control" placeholder="" name="postal_code" id="Orders_postal_code"
                                    value="0" type="hidden">

                             
                                <div class="row">
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="the_avenue" class=" font-weight-bold">@lang('site.the_avenue')</label>
                                            <input class="form-control" placeholder="" name="the_avenue" id="the_avenue"
                                                value="{{ old('the_avenue') }}" type="text" maxlength="20">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="the_street" class="required font-weight-bold"
                                                style="color:red"><span class="required">*</span>@lang('site.the_street')</label>
                                            <input class="form-control" placeholder="" name="the_street" id="the_street"
                                                value="{{ old('the_street') }}" type="text" maxlength="150">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="building_number" class="required font-weight-bold"
                                                style="color:red"><span class="required">*</span>@lang('site.building_number')</label>
                                            <input class="form-control" placeholder="" name="building_number" id="building_number"
                                                value="{{ old('building_number') }}" type="text" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="floor" class=" font-weight-bold">@lang('site.floor')</label>
                                            <input class="form-control" placeholder="" name="floor" id="floor"
                                                value="{{ old('floor') }}" type="text" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="apartment_number" class=" font-weight-bold">@lang('site.apartment_number')</label>
                                            <input class="form-control" placeholder="" name="apartment_number" id="apartment_number"
                                                value="{{ old('apartment_number') }}" type="text" maxlength="10">
                                        </div>
                                    </div>
                                </div>
                                
                               


                                <input type="hidden" name="total_price">
                                <input type="hidden" name="total_quantity">

                                <br>
                                {{-- <input value="2021-01-20 03:16:46" name="Orders[created_at]" id="Orders_created_at" --}}
                                {{-- type="hidden"> --}}
                                        {{--<div id="TabbyPromo"></div>--}}
                                    <br>
                                <div class="form-actions">

                                    <div class="form-check list-group-item" style="margin: 5px 0px">
                                        <input class="" type="radio" name="paymentType" value="visa_master"
                                               id="flexRadioDefault1" checked>
                                        <label class="form-check-label" for="flexRadioDefault1" style="margin: 0px 20px">
                                            {{ __('site.DebitCreditCard') }}
                                            <span><img style="width: 50px; margin: 0px 20px" src="{{asset('visa.png')}}"></span>
                                        </label>
                                    </div>
                                    {{--<div class="form-check list-group-item" style="margin: 5px 0px">
                                        <input class="" type="radio" name="paymentType" value="tabby"
                                               id="flexRadioDefault2" >
                                        <label class="form-check-label" for="flexRadioDefault2" style="margin: 0px 20px">
                                            {{ __('site.tabby_pay') }}
                                            <span><img style="width: 50px; margin: 0px 20px" src="{{asset('tabby.png')}}"></span>
                                        </label>
                                    </div>--}}

                                    <div class="form-check list-group-item" style="margin: 5px 0px">
                                        <input class="" type="radio" name="paymentType" value="cash" id="flexRadioDefault3" >
                                        <label class="form-check-label" for="flexRadioDefault3" style="margin: 0px 20px">
                                            Cash
                                            <span><img style="width: 50px; margin: 0px 20px" src="{{asset('cash.png')}}"></span>
                                        </label>
                                    </div>


                                    <button class="btn btn-third-col bg-b"
                                        type="submit">@lang('site.complete_order')</button>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                @if (count(Session::get('cart')) < 1)
                    <div class="col-12 col-lg-4 ">
                        <div class=" border text-dir">
                            <div class="bg-b row mr-0">
                                <h3 class=" col-12 "
                                    style="text-align: center;width: 100%;font-size: 18px;font-weight: bold">
                                    @lang('site.bin_empty')
                                </h3>
                            </div>
                            <br>
                        </div>
                    @else
                        <div class="col-12 col-lg-4 ">
                            <div class=" border text-dir" style="text-align: left">
                                <div class="bg-b row mr-0" style="padding-top: 8px">
                                    <h3 class=" col-12 " style="text-align: center"> @lang('site.order_summary')</h3>
                                </div>
                                <br>
                                @foreach (Session::get('cart') as $cart_parent)
                                    @foreach ($cart_parent as $key => $cart_child)
                                        <div class="row border-bottom mr-0 p-3">
                                            <a href="{{ route('product', $cart_child['product_id']) }}"
                                                class=" col-3 pad-0">
                                                <img alt=" T-shirts"
                                                    src="{{ asset('storage/' . \App\Product::find($cart_child['product_id'])['img']) }}"
                                                    class="w-100">
                                            </a>
                                            <div class="col-9">
                                                <a href="{{ route('product', $cart_child['product_id']) }}">
                                                    {{ \App\Product::find($cart_child['product_id'])['title_en'] }}

                                                </a>
                                                <p class="font-weight-bold">
                                                    @lang('site.price'):


                                                    @auth()
                                                        {{ Auth::user()->getPrice(\App\Product::find($cart_child['product_id'])['price']) }}
                                                        {{ Auth::user()->country->currency->code }}
                                                    @endauth
                                                    @guest()
                                                        @if (Cookie::get('name'))
                                                            {{ number_format(\App\Product::find($cart_child['product_id'])['price'] / App\Country::find(Cookie::get('name'))->currency->rate, 2) }}
                                                             {{ App\Country::find(Cookie::get('name'))->currency->code }} 
                                                            <!--@lang('site.kwd')-->
                                                        @else
                                                            {{ \App\Product::find($cart_child['product_id'])['price'] }}
                                                            @lang('site.kwd')
                                                        @endif
                                                    @endguest

                                                    <?php
                                                    $product = \App\Product::find($cart_child['product_id']);
                                                    ?>
                                                    @if($product->has_offer == 1 && $product->price < $product->before_price)
                                                        <span class="font-small" style="margin:0px 10px;text-decoration: line-through;font-size: 13px !important; color: red; font-weight: bolder;">
                                            @auth()
                                                {{ Auth::user()->getPrice($product->before_price) }}
                                                {{ Auth::user()->country->currency->code }}
                                            @endauth
                                            @guest()
                                                @if (Cookie::get('name'))
                                                    {{ number_format($product->before_price / App\Country::find(Cookie::get('name'))->currency->rate, 2) }}
                                                    {{ App\Country::find(Cookie::get('name'))->currency->code }}
                                                    <!--@lang('site.kwd')-->
                                                    @else
                                                        {{ $product->before_price }}
                                                        @lang('site.kwd')
                                                    @endif
                                                @endguest

                                        </span>
                                                    @endif

                                                    <br>
                                                    @lang('site.quantity')
                                                    : {{ $cart_child['quantity'] }}
                                                    <br>
                                                    <?php $id = (\App\Product::find($cart_child['product_id'])['basic_category_id']);
                                                    $category=\App\BasicCategory::find($id)->type;
                                             ?>
                                             {{-- {{dd($category)}} --}}
                                                @if ($category !=1)

                                                    @lang('site.size'):
                                                    {{ \App\ProdSize::find($cart_child['product_size_id'])->size['name'] }}
                                                    <br>
                                                    @lang('site.code'): {{ $cart_child['product_id'] }} <br>
                                                @endif
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                                <div class="row  dir-rtl">
                                    <div class="col-12 mt-3" style="text-align: left">
                                        @if (Session::has('cart_details'))
                                            <p style="display:flex;justify-content: space-between">


                                                <span class="font-weight-bold">
                                                    @lang('site.total_quantity')
                                                    :
                                                </span>
                                                <span> {{ Session::get('cart_details')['totalQty'] }}</span>
                                            </p>


                                            <p style="display:flex;justify-content: space-between">

                                                <span class="font-weight-bold">
                                                    @lang('site.total_price'):
                                                </span>
                                                {{-- <input type="hidden" value="{{Session::get('cart_details')['totalPrice']}}" id="total_value"> --}}
                                                <span>
                                                    {{-- {{Session::get('cart_details')['totalPrice']}} @lang('site.kwd') --}}
                                                    @auth()
                                                        {{ Auth::user()->getPrice(Session::get('cart_details')['totalPrice']) }}
                                                        {{ Auth::user()->country->currency->code }}
                                                    @endauth
                                                    @guest()
                                                        @if (Cookie::get('name'))
                                                            {{ number_format(Session::get('cart_details')['totalPrice'] / App\Country::find(Cookie::get('name'))->currency->rate, 2) }}
                                                             {{ App\Country::find(Cookie::get('name'))->currency->code }} 
                                                            <!--@lang('site.kwd')-->
                                                        @else
                                                            {{ Session::get('cart_details')['totalPrice'] }}
                                                            @lang('site.kwd')
                                                        @endif
                                                    @endguest
                                                </span>

                                            </p>


                                            @if (Session::has('coupon'))
                                            <p>
                                            <div class="d-flex justify-content-between">
                                                <div><span class="font-weight-bold">
                                                        @lang('site.coupon'):
                                                    </span>
                                                    <span>
                                                        <form action="{{ route('coupon.destroy') }}" method="POST"
                                                            style="display: inline">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            <button type="submit"
                                                                class="btn btn-link text-danger font-weight-bold">@lang('site.delete')</button>
                                                        </form>
                                                    </span>

                                                </div>
                                                <div><span style="color: red">
                                                        {{-- {{Session::get('cart_details')['totalPrice']}} @lang('site.kwd') --}}
                                                        -
                                                        @auth()
                                                            {{ Auth::user()->getPrice(Session::get('coupon')['discount']) }}
                                                            {{ Auth::user()->country->currency->code }}
                                                        @endauth
                                                        @guest()
                                                            @if (Cookie::get('name'))
                                                                {{ number_format(Session::get('coupon')['discount'] / App\Country::find(Cookie::get('name'))->currency->rate, 2) }}
                                                                 {{ App\Country::find(Cookie::get('name'))->currency->code }} 
                                                                <!--@lang('site.kwd')-->
                                                            @else
                                                                {{ Session::get('coupon')['discount'] }} @lang('site.kwd')
                                                            @endif
                                                        @endguest
                                                    </span></div>
                                            </div>
                                            </p>
                                            @endif


                                            <p style="display:flex;justify-content: space-between">
                                                <span class="font-weight-bold">
                                                    @lang('site.shipping'):

                                                </span>

                                                <span id="test1"></span>
                                            </p>

                                            <p style="display:flex;justify-content: space-between">
                                                <span class="font-weight-bold">
                                                    @lang('site.ship_period')
                                                    :
                                                </span>
                                                <span id="delivery"></span>
                                            </p>


                                            <p style="display:flex;justify-content: space-between">

                                                <span class="font-weight-bold">
                                                    @lang('site.total_price'):
                                                </span>
                                                <input type="hidden"
                                                    value="{{ Session::get('coupon') != null ? number_format(Session::get('cart_details')['totalPrice'] - Session::get('coupon')['discount'], 2): number_format(Session::get('cart_details')['totalPrice'] , 2)}}"
                                                    id="total_value">
                                                <span id="total">
                                                    {{-- {{Session::get('cart_details')['totalPrice']}} @lang('site.kwd') --}}
                                                </span>
                                            </p>


                                        @endif
                                        <br>
                                    </div>
                                </div>
                            </div>
                            @if (!Session::has('coupon'))

                            <div class="text-dir m-2">
                                <form action="{{ route('coupon.store') }}">
                                    @csrf
                                    <label class="font-weight-bold">@lang('site.have_coupon')</label>
                                    <input id="coupon" type="text"
                                        class="form-control @error('coupon') is-invalid @enderror" name="coupon"
                                        autocomplete="coupon">
                                    <p style="color: red">@lang('site.coupon_notice')</p>
                                    @if ($errors->any())
                                        {{-- @dd('ok') --}}

                                        {!! implode('', $errors->all('<div class="alert alert-danger"> :message</div>')) !!}
                                    @endif
                                    @if (session()->has('success_message'))
                                        <div class="alert alert-success">
                                            {{ session()->get('success_message') }}
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-third-col bg-b">@lang('site.apply')</button>

                                </form>

                            </div>
                @endif

                        </div>



                @endif


            </div><br><br>
        </div>

    @else
        <div class="col-sm-12 ">
            <div class=" border text-dir">
                <div class=" row mr-0 mt-3">

                    <h3 class=" col-12 "
                        style="text-align: center;width: 100%;font-size: 18px;font-weight: bold;padding: 20px">
                        السله فارغه</h3>
                </div>
            </div>
    @endif
    <!--- end  --->

@endsection
            <?php
            if (Session::get('cart_details')){

                if(Cookie::get('name') ){
                    $currency_en = App\Country::find(Cookie::get('name'))->currency->code;
                    $rate  = App\Country::find(Cookie::get('name'))->currency->rate;

                    $total2 = number_format(Session::get('cart_details')['totalPrice']  /  App\Country::find(Cookie::get('name'))->currency->rate,2);

                    //dd($total2);
                }else{
                    $currency_en = "KWD";
                    $rate = 1;
                    $total2 = number_format(Session::get('cart_details')['totalPrice'] / 1 ,2);
                }

            }
            ?>

@section('script')

                <script src="https://checkout.tabby.ai/tabby-promo.js"></script>
                <script>
                    new TabbyPromo({
                        selector: '#TabbyPromo', // required, content of tabby Promo Snippet will be placed in element with that selector.
                        currency: "{{@$currency_en}}", // required, currency of your product. AED|SAR|KWD|BHD|QAR only supported, with no spaces or lowercase.
                        price: "{{(@$total2)}}", // required, price or the product. 2 decimals max for AED|SAR|QAR and 3 decimals max for KWD|BHD.
                        installmentsCount: 4, // Optional, for non-standard plans.
                        lang: "{{app()->getLocale()}}", // Optional, language of snippet and popups, if the property is not set, then it is based on the attribute 'lang' of your html tag.
                        source: 'product', // Optional, snippet placement; `product` for product page and `cart` for cart page.
                        publicKey: 'pk_96b383b9-0536-4149-a109-c4b3ce9284f1', // required, store Public Key which identifies your account when communicating with tabby.
                        merchantCode: 'rayanstorekwt'  // required
                    });
                </script>
    <script>
        $(document).ready(function() {



            getCities();

            $('#Orders_country_id').on('change',
                function() {
                    getCities();
                }
            )


            function getCities() {
                var country = $('#Orders_country_id').val() ? $('#Orders_country_id').val() : 1;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('get.cities') }}",
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        country: country
                    },
                    success: function(result) {
                        // console.log(result);

                        if (!result.success) {
                            Swal.fire({
                                icon: '?',
                                //confirmButtonColor: '#212529',
                                showConfirmButton: false,
                                position: 'bottom-start',
                                showCloseButton: true,
                                title: result.msg,
                            })
                        } else {

                            $('#Orders_city_id').html(result.cities)


                            getDelivery();

                        }

                    },
                    error: function(error) {
                        Swal.fire({
                            title: 'لم تكتمل العمليه ',
                            icon: '?',
                            showConfirmButton: false,
                            //confirmButtonColor: '#212529',
                            position: 'bottom-start',
                            showCloseButton: true,
                        })
                    }
                });

            }


            getDelivery();

            $('#Orders_city_id').on('change',
                function() {
                    getDelivery();
                }
            )


            function getDelivery() {
                var city = $('#Orders_city_id').val() ? $('#Orders_city_id').val() : 1;
                var total_value = $('#total_value').val() ? $('#total_value').val() : 1;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('get.delivery') }}",
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        city: city,
                        total_value: total_value
                    },
                    success: function(result) {

                        // console.log(result);
                        if (!result.success) {
                            Swal.fire({
                                icon: '?',
                                //confirmButtonColor: '#212529',
                                showConfirmButton: false,
                                position: 'bottom-start',
                                showCloseButton: true,
                                title: result.msg,
                            })
                        } else {

                            // alert(result.delivery);
                            //                            $('#Orders_city_id').html(result.cities)
                            $('#delivery').html(result.delivery)
                            $('#test1').html(result.ship)
                            $('#total').html(result.total_value)
                            //                            console.log(result.total_value)
                        }

                    },
                    error: function(error) {
                        Swal.fire({
                            title: 'لم تكتمل العمليه ',
                            icon: '?',
                            confirmButtonColor: '#212529',
                            showConfirmButton: false,
                            position: 'bottom-start',
                            showCloseButton: true,
                        })
                    }
                });

            }
        })
    </script>


@endsection

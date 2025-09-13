@extends('layouts.front')
@section('title', __('site.Checkout_t'))

@section('style')

    <style>

      label.form-check-label {
          padding: 0 20px;
      }
      .styl-item-r {
            float: right;
        }
        .div-order-day {
            text-align: center;
            font-size: 15px;
            font-weight: 700;
        }
        span#order_day {
            color: #b98737;
        }
    </style>
    @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
    <style>
        .styl-item-r {
              float: left;
          }

    </style>

    @endif
@endsection



@section('content')


<!--- --->
  <div class="container " >  <br><br>
      <form method="post" name="checkout" action="{{route("checkout.store")}}">
        @csrf
        <div class="row pad  ">
          <div class="col-md-8 ">
            <h4 class="main-color "> {{__('site.Shipping Details')}}</h4>
            <br>
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
            @if ($errors->any())
              <div class="alert alert-danger" style="width:100%">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <div class="form-group">
              <input type="text" class="form-control " name="username" placeholder="{{__('site.full name')}}" required>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" class="form-control " name="phone"  placeholder="{{__('site.Phone')}}  " required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="email" class="form-control " name="email" placeholder="{{__('site.Email address')}}   " >
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <select name="country"  class="form-control" style="height: 55px;" id="Orders_city_id" required>
                    @foreach(\App\Models\Country::get() as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <select name="city"  class="form-control" id="test" style="height: 55px;" required>
                      <option value="">{{__('site.city')}}</option>

                  </select>
                  <div id="test1"></div>
                </div>
              </div>
            </div><br>

              <div class="form-group">
                  <input type="text" class="form-control " name="region"  placeholder="{{__('site.region')}}" required>
              </div><br>

              <div class="form-group">
                  <input type="text" class="form-control " name="piece"  placeholder="{{__('site.piece')}}" required>
              </div><br>

              <div class="form-group">
                  <input type="text" class="form-control " name="avenue"  placeholder="{{__('site.avenue')}}">
              </div><br>

              <div class="form-group">
                  <input type="text" class="form-control " name="street"  placeholder="{{__('site.street')}}" required>
              </div><br>


              <div class="form-group">
                  <input type="text" class="form-control " name="flat_number"  placeholder="{{__('site.flat_number')}}" required>
              </div><br>

              <div class="form-group">
                  <input type="text" class="form-control " name="floor"  placeholder="{{__('site.floor')}}" required>
              </div><br>

            <div class="form-group">
              <input type="text" class="form-control " name="address"  placeholder="{{__('site.address')}}" required>
            </div><br>
            <div class="form-group">
              <input type="hidden" class="form-control " name="postcode" vule="0" >
            </div>

            <div class="form-group">
              <textarea class="col-12" name="note"  placeholder="{{__('site.Order notes (optional)')}}" rows="6"></textarea>
            </div>
            <br><br>
            <br><br>
        </div>
        <div class="col-md-4 ">
          <div class="col-12 border">
            <div class="btn-dark row">
              <h4 class=" col-12 mr-0">   {{__('site.Order Summary')}}</h4>
              
              
            </div><br>
            <?php $total=0 ; $order_is_order = 0;?>
            @if(session('cart'))
              @foreach(session('cart') as $id => $items)
                @foreach($items as $key1 => $details)

                  @php
                    $total += $details['price'] * $details['quantity'] ;
                    $product = \App\Models\Product::where('id', $details['id'])->first();
                  @endphp
                  
                    @if($order_is_order != 1 && $product -> is_order ==1)
                        <?php $order_is_order = 1;?>
                    @endif
                    
                  <div class="row ">
                    <a href="{{route("product",$product->id)}}" class=" col-3">
                      <img alt="{{$product->name}}" src="{{asset('assets/images/products/min/'.$product->img)}}" width="80px;">
                    </a>
                    <input type="hidden" name ="product_ids[]" value="{{$product->id}}">
                    <div class="col-6">
                      <a href="{{route("product",$product->id)}}" >{{$product->name}}</a>
                      <p class="mr-0">Qty : {{$details['quantity']}}</p>
                    </div>
                    @php
                    //dd($details['price'], $details['quantity']);
                      $sum = $details['price'] * $details['quantity'];
                    //dd($sum);

                    @endphp
                    <p class="col-3"> {{get_price_helper($sum,true)}} </p>
                  </div>
                  <hr>
              @endforeach
            @endforeach
          @endif
            <div class="div-order-day {{ $order_is_order != 1 ?  'd-none' : '' }}">
                 {{ __('site.front_is_order_day')  }} <span id="order_day"></span> {{ __('site.day')  }}
            </div>
          <p > {{__('site.SUBTOTAL')}} :<b class="styl-item-r main-color">{{get_price_helper($total,true)}}</b></p>
          <p >{{__('site.Shipping')}} :<b class="styl-item-r main-color" > <span id="test3">{{get_price_helper(0)}}</span></b></p> <hr>
          <p >{{__('site.ORDER TOTAL')}} : <b class="styl-item-r main-color" id="total_show">{{get_price_helper($total,true)}}</b></p> <hr>
          <input type="hidden" name ="shipping" value = {{0}} >
          <input type="hidden" name ="price" id="total" value = {{get_price_helper2($total,true)}}  >
          @if(\Auth::guard("web"))
            <input type="hidden" name ="user_id" value = '{{\Auth::guard("web")->user()->id??""}}' >
          @else
            <input type="hidden" name ="user_id" value ="0" >
          @endif
          <h4 class="main-color">{{__('site.Coupon Discount')}}</h4>
          <input type="text" class="form-control "  name="coupon_code" placeholder="Coupon code" > <br>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="type" id="exampleRadios1" value="cash" checked>
            <label class="form-check-label" for="exampleRadios1">
              {{__('site.Cash on delivery')}}
              <br>{{__('site.(Pay with cash upon delivery.)')}}

            </label>
          </div><br>
          <div class="form-check">
            <input class="form-check-input mt-3" type="radio" name="type" id="exampleRadios2" value="knet">
            <label class="form-check-label" for="exampleRadios2">
              <img src="{{asset('front/img/cash.png')}}" class="w-100">
            </label>
          </div><hr><br>
          <p>{{__('site.Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our')}} <a href="{{route('front.info','PrivacyPolicy')}}" target="_blank" class="main-color">{{__('site.PrivacyPolicy2')}}</a>

          </p>
          <hr><br>
          <div class="form-check">
            <input id="confirm" name="" class="form-check-input" type="checkbox" checked  >
            <label class="form-check-label" for="confirm">
              {{__('site.I want to receive updates about products and promotions.')}}
            </label>
          </div><br>
          <button id="btn_form" type="submit"   class="btn w-100 bg-main " onClick="if (!  document.checkout.confirm.checked) {alert('{{__('site.Please accept the terms and conditions!')}}') ; return false; }">
            {{__('site.place order')}}
          </button><br><br><br>
          </div>
        </div>
      </div>
    </form>
    <br><br>
  </div>
  @endsection
  @section('js')


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      <script>

          $(document).ready(function () {
              console.log('ok');

              getCity();


              $('#Orders_city_id').on('change',
                  function () {
                      getCity();
                  }
              )
              $('#test').on('change',
                  function () {
                      getDelivery();
                  }
              )


              function getCity() {
                  var city =  $('#Orders_city_id').val() ? $('#Orders_city_id').val():1;

                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                      }
                  });

                  $.ajax({
                      url: "{{ route('get.city') }}",
                      method: 'post',
                      data:{
                          _token: "{{ csrf_token() }}",
                          city : city
                      },
                      success: function(result){

                          // console.log(result);
                          if(!result.success)
                          {
                              Swal.fire({
                                  icon: 'error',
                                  title: result.msg,
                              });

                          } else {

                              // alert(result.delivery);
      //                            $('#Orders_city_id').html(result.cities)
                              $('#test').html(result.delivery);
                              getDelivery();
      //                        $('#test1').html(result.val11)
                          }

                      },
                      error:function (error) {
                          Swal.fire({
                              icon: 'error',
                              title: 'لم تكتمل العمليه ',
                          })
                      }
                  });

              }




              function getDelivery() {
                  var city =  $('#test').val() ? $('#test').val():1;
                  var product_ids  = $("input[name='product_ids[]']")
              .map(function(){return $(this).val();}).get();
                  var total =  $('#total').val() ? $('#total').val():0;

                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                      }
                  });

                  $.ajax({
                      url: "{{ route('get.delivery') }}",
                      method: 'post',
                      data:{
                          _token: "{{ csrf_token() }}",
                          city : city,
                          total:total,
                          product_ids : product_ids,
                      },
                      success: function(result){

                          // console.log(result);
                          if(!result.success)
                          {
                              Swal.fire({
                                  icon: 'error',
                                  title: result.msg,
                              })
                          } else {

                            //   alert(result.order_day);
      //                            $('#Orders_city_id').html(result.cities)
                              $('#test1').html(result.delivery)
                              $('#test3').html(result.delivery1)
                              $('#total_show').html(result.total1)
                              $('#order_day').html(result.order_day)
                          }

                      },
                      error:function (error) {
                          Swal.fire({
                              icon: 'error',
                              title: 'لم تكتمل العمليه ',
                          })
                      }
                  });

              }


          })



      </script>
    @stop

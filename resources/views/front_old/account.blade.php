@extends('layouts.layout')
@section('title',__('site.My Account'))
@section('content')

    {{--<div class="container account" >
        <div class="row pad  ">

            <h1  class="col-12  text-center">{{__('site.My Account')}}<br></h1>
            <br>
            <div class="  col-12 justify-content-center border">
                <a href="{{route('account.orders',Auth::guard('web')->user()->id)}}" class="btn bg-main mr-10 float-right">{{__('site.My orders')}}</a>
                <a href=" {{route('wishlist.products.index')}}" class="btn bg-main mr-10  float-right">{{__('site.wishlist')}} </a>
                {{--    <a href="{{route('address.index',Auth::guard('web')->user()->id)}}" class="btn bg-main mr-10  float-right"> {{__('site.address book')}}</a>
                <a href="{{route('account.edit',Auth::guard('web')->user()->id)}}" class="btn bg-main mr-10  float-right"> {{__('site.Edit account')}}</a>
            </div>
            <form class=" col-12  border">

                <div class="row border-bottom pad-10">
                    <label class="col-md-3 col-12  "><b> {{__('site.full name')}} :</b></label>
                    <p class="  col-9 pad-0 ">{{Auth::guard('web')->user()->name}}</p><br>
                </div>
                <div class="row border-bottom pad-10">
                    <label class="col-md-3 col-12 "> <b>{{__('site.email')}}</b></label>
                    <p class="  col-9 pad-0 ">{{Auth::guard('web')->user()->email}}</p><br>
                </div>

                <div class="row border-bottom pad-10">
                    <label class="col-md-3 col-12  "><b> {{__('site.Phone')}}</b></label>
                    <p class="  col-9 pad-0 ">{{Auth::guard('web')->user()->phone}}</p><br>
                </div>

                <div class="row border-bottom pad-10">
                    <label class="col-md-3 col-12  "><b> {{__('site.country')}}</b></label>
                    <p class="  col-9 pad-0 ">{{Auth::guard('web')->user()->country != null ?Auth::guard('web')->user()->country->name : null  }}</p><br>
                </div>


            </form>
        </div></div>

    --}}
    <main id="content">
        <section class="py-2 bg-gray-2">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                        <li class="breadcrumb-item"><a class="text-decoration-none text-body"
                                                       href="{{route('home')}}">{{__('site.index')}}</a>
                        </li>
                        <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page"> {{__('site.My Account')}}
                        </li>
                    </ol>
                </nav>
            </div>
        </section>
        <section class="pt-lg-5 pb-0 pb-lg-6 d-block d-lg-block">
            <div class="container">
                <h4 class="mt-4">{{ __('site.My Account') }}

                    <label class="text-left" style="display: block; " dir="ltr">
                                                          <span class="text-body">
                                                              @php

                                                                  $userWithWallets = \App\Models\User::where('id', auth('web')->id()) // Filter to get only user with ID 1
                                                                      ->whereHas('wallets') // Ensure user has wallets
                                                                      ->with(['wallets' => function ($query) {
                                                                          $query->select('user_id',
                                                                                         DB::raw("SUM(CASE WHEN wallet_type = 'deposit' THEN amount ELSE 0 END) as total_deposit"),
                                                                                         DB::raw("SUM(CASE WHEN wallet_type = 'withdraw' THEN amount ELSE 0 END) as total_withdraw"))
                                                                                ->groupBy('user_id');
                                                                      }])
                                                                      ->first(); // Retrieve the single result for user 1

                                                                  // Accessing the total deposit and withdraw values
                                                                   if ($userWithWallets){

            $totalDeposit = $userWithWallets->wallets->first()->total_deposit ?? 0;
            $totalWithdraw = $userWithWallets->wallets->first()->total_withdraw ?? 0;
        }else{

            $totalDeposit = 0;
            $totalWithdraw = 0;
        }
                                                              @endphp


                                                              رصيد محفظتك({{ $totalDeposit - $totalWithdraw }})

                                                          </span>
                    </label>


                </h4>

                <div class="row">

                    <div class="col-md-12 mt-4 mt-md-0 mb-7">
                        <div id="accordion-style-01" class="accordion">
                            <div class="card border-0 mb-4">
                                <div class="card-header border-0 p-0 bg-transparent bg-transparent" id="headingOne">
                                    <h5 class="mb-0 fs-18 w-100">
                                        <a href="#" class="d-flex align-items-center border-bottom pb-2 text-decoration-none" data-toggle="collapse"
                                           data-target="#collapseOne"
                                           aria-expanded="true" aria-controls="collapseOne">
                                        <span>
                                          <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                              <span><i class="fas fa-user"></i></span>
                                            </div>
                                            <div class="mx-2">
                                              <span>|</span>
                                            </div>
                                            <div>
                                              <span> {{ __('site.my_account') }}</span>
                                            </div>
                                           </div>
                                        </span>
                                            <span class="icon d-inline-block ml-auto"></span>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                     data-parent="#accordion-style-01">
                                    <div class="card-body pt-4 pb-1 px-0">
                                        <div>
                                            <form method="POST" action="{{route('account.update',$account->id)}}" aria-label="{{ __('site.Edit') }}">
                                                @csrf
                                                @method('put')
                                                @if (Session::has('success-reg'))
                                                    <div class="alert alert-success">
                                                        <ul>
                                                            <li>{!! \Session::get('success-reg') !!}</li>
                                                        </ul>
                                                    </div>
                                                @endif
                                                @if ($errors->any() && (Session::has('test') || !empty(Session::get('fail-reg')) ))
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    <div class="col-lg-12 form-control-01">

                                                        <div class="mt-3">
                                                            <div class="row">
                                                                <div class="col-md-12 mb-md-0 mb-4">
                                                                    <label for="street-address"
                                                                           class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">
                                                                        {{__('site.full name')}}
                                                                    </label>
                                                                    <input type="text" class="form-control "
                                                                           name="name"
                                                                           value="{{Auth::guard('web')->user()->name}}"
                                                                           placeholder="{{__('site.full name')}} "
                                                                           required="">
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="mt-3">
                                                            <div class="row">
                                                                <div class="col-md-12 mb-md-0 mb-4">
                                                                    <label for="street-address"
                                                                           class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">
                                                                        {{__('site.country')}}
                                                                    </label>

                                                                    <select name="country" id="country" class="w-100 " >
                                                                        <option value="" disabled selected>{{__('site.country')}}</option>
                                                                        @foreach($countries as $country)
                                                                            <option value="{{$country->id}}" @if($country->id==Auth::guard('web')->user()->country_id){{'selected'}}@endif>{{$country->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="">
                                                            <label class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">info</label>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-md-0 mb-4">
                                                                    <input type="email" class="form-control " id="email" name="email"
                                                                           placeholder="{{__('site.email')}}" required="" value="{{ Auth::guard('web')->user()->email }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="number" class="form-control " value="{{ Auth::guard('web')->user()->phone }}" id="phone" name="phone"
                                                                           placeholder=" {{__('site.Phone')}}" required="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <label for="city" class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">
                                                                change password :
                                                            </label>
                                                            <div class="row">
                                                                <div class="col-md-12 mb-md-0 mb-4">
                                                                    <input type="password" name="password"  class="form-control" placeholder="@lang('site.password')" minlength="6">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="custom-control custom-checkbox mt-6 mb-5">
                                                          <input type="checkbox" class="custom-control-input" name="customCheck6" checked=""
                                                                       id="customCheck5">
                                                          <label class="custom-control-label custom-control-label-secondary text-secondary"
                                                                       for="customCheck5">
                                                            <span class="text-body">ادخل العموان كما في الشحن</span>
                                                          </label>
                                                        </div> -->
                                                        <button type="submit" class="btn btn-secondary bg-hover-primary border-hover-primary px-7 mt-3">Submit </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 mb-4">
                                <div class="card-header border-0 p-0 bg-transparent bg-transparent" id="headingTwo">
                                    <h5 class="mb-0 fs-18 w-100">
                                        <a href="#" class="d-flex align-items-center border-bottom pb-2 text-decoration-none collapsed" data-toggle="collapse"
                                           data-target="#collapseTwo"
                                           aria-expanded="true" aria-controls="collapseTwo">
                                                <span>
                                                  <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                      <span><i class="far fa-heart"></i></span>
                                                    </div>
                                                    <div class="mx-2">
                                                      <span>|</span>
                                                    </div>
                                                    <div>
                                                      <span>@lang('site.wishlist')</span>
                                                    </div>
                                                   </div>
                                                </span>
                                            <span class="icon d-inline-block ml-auto"></span>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion-style-01">
                                    <div class="card-body pt-4 pb-1 px-0">
                                        <form class="table-responsive-md pb-8 pb-lg-10">
                                            <table class="table border text-center justify-content-center align-items-center">
                                                <thead style="background-color: #F5F5F5">
                                                <tr class="fs-15 font-weight-600 text-uppercase text-secondary">
                                                    <th scope="col" class="border-1x">المنتجات</th>
                                                    <th  class="border-1x">السعر</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($wishlists as $item)
                                                    <tr class="position-relative">
                                                    <td scope="row" class="py-4">
                                                        <div class="media align-items-center justify-content-around">
                                                            <div>
                                                                <div class="d-flex justify-content-around align-items-center">
                                                                    <p class="mb-0 text-secondary font-weight-bold"><a class="remove-from-wish" href="#" data-id="{{ $item->id }}"><i
                                                                                    class="fal fa-times text-body"></i></a></p>
                                                                </div>
                                                            </div>
                                                            <div class="">
                                                                <img src="{{asset('assets/images/products/min/'.$item->img)}}"
                                                                     class="mw-75px">
                                                            </div>
                                                            <div class="">
                                                                <p class="font-weight-500 mb-1 text-secondary">{{$item->name}}</p>

                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="align-middle">
                                                        <div class="d-flex justify-content-around align-items-center">
                                                            @if($item->if_sale)
                                                                <p class="mb-0 text-secondary font-weight-bold">{{get_price_helper($item->sale_price,true)}}</p>
                                                                <p class="mb-0 text-secondary font-weight-bold text-decoration-through" style="color: red !important;">{{get_price_helper($item->regular_price,true)}}</p>
                                                            @else
                                                                <p class="mb-0 text-secondary font-weight-bold">{{get_price_helper($item->regular_price,true)}}</p>
                                                            @endif

                                                        </div>
                                                    </td>

                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 mb-4">
                                <div class="card-header border-0 p-0 bg-transparent bg-transparent" id="headingThree">
                                    <h5 class="mb-0 fs-18 w-100">
                                        <a href="#" class="d-flex align-items-center border-bottom pb-2 text-decoration-none collapsed" data-toggle="collapse"
                                           data-target="#collapseThree"
                                                               aria-expanded="true" aria-controls="collapseThree">
                                            <span>
                                              <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                  <span>
                                                   <i class="fas fa-shopping-cart"></i>
                                                  </span>
                                                </div>
                                                <div class="mx-2">
                                                  <span>|</span>
                                                </div>
                                                <div>
                                                  <span>{{ __('site.my_orders') }}</span>
                                                </div>
                                               </div>
                                            </span>
                                            <span class="icon d-inline-block ml-auto"></span>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                     data-parent="#accordion-style-01">
                                    <div class="card-body pt-4 pb-1 px-0">
                                        <div id="my-orders-form" class="table-responsive-md pb-8 pb-lg-10">
                                            <table class="profile-table table border text-center justify-content-center align-items-center">
                                                <thead style="background-color: #F5F5F5">
                                                <tr class="fs-15 font-weight-600 text-uppercase text-secondary">
                                                    <th>#</th>
                                                    <th  class="border-1x">{{ __('site.code')}}</th>
                                                    <th  class="border-1x">{{ __('site.ORDER TOTAL')}}</th>
                                                    <th  class="border-1x">{{ __('site.Phone')}}</th>
                                                    <th  class="border-1x">{{ __('site.country')}}</th>
                                                    <th  class="border-1x">{{ __('site.city')}}</th>
                                                    <th  class="border-1x">{{ __('site.address')}}</th>
                                                    <th  class="border-1x">{{ __('site.order_date')}}</th>
                                                    <th  class="border-1x">{{ __('site.payment_way')}}</th>
                                                    <th  class="border-1x">{{ __('site.status')}}</th>
                                                    <th  class="border-1x">{{ __('site.order Details')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($orders as $order)
                                                    <tr class="position-relative">
                                                        <td class="align-middle">
                                                            <p class="card-text font-weight-bold fs-14  text-secondary">
                                                                <span>{{$loop->iteration}}</span>
                                                            </p>
                                                        </td>

                                                        <td class="align-middle">
                                                            <p class="card-text font-weight-bold fs-14  text-secondary">
                                                                <span>{{$order->id}}</span>
                                                            </p>
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="d-flex justify-content-around align-items-center">
                                                                <p class="mb-0 text-secondary font-weight-bold">{{get_price_helper($order->total_price)}} </p>

                                                            </div>
                                                        </td>
                                                        <td class="align-middle">
                                                            <p class="card-text font-weight-bold fs-14  text-secondary">
                                                                <span>{{$order->shipping_address!= null ?$order->shipping_address->phone : null }}</span>
                                                            </p>
                                                        </td>

                                                        <td class="align-middle">
                                                            <p class="card-text font-weight-bold fs-14  text-secondary">
                                                                <span>{{$order->shipping_address!= null ? ($order->shipping_address->area != null ? ($order->shipping_address->area->country != null ? $order->shipping_address->area->country->name:null ): null ): null }}</span>
                                                            </p>
                                                        </td>

                                                        <td class="align-middle">
                                                            <p class="card-text font-weight-bold fs-14  text-secondary">
                                                                <span>{{$order->shipping_address!= null ? ($order->shipping_address->area != null ? $order->shipping_address->area->name:null): null }}</span>
                                                            </p>
                                                        </td>




                                                        <td class="align-middle">
                                                            <p class="card-text font-weight-bold fs-14  text-secondary">
                                                                <span>{{$order->shipping_address!= null ?$order->shipping_address->address : null }}</span>
                                                            </p>
                                                        </td>


                                                        <td class="align-middle">
                                                            <p class="card-text font-weight-bold fs-14  text-secondary">
                                                                <span>{{$order->created_at}}</span>
                                                            </p>
                                                        </td>


                                                        <td class="align-middle">
                                                            <p class="card-text font-weight-bold fs-14  text-secondary">
                                                                <span>{{__('site.'.$order->payment_method)}}</span>
                                                            </p>
                                                        </td>


                                                        <td class="align-middle">
                                                            <p class="card-text font-weight-bold fs-14  text-secondary">
                                                                <span>{{__('site.'.$order->status)}}</span>
                                                            </p>
                                                        </td>

                                                        <td class="align-middle">
                                                            <p class="card-text font-weight-bold fs-14  text-secondary">
                                                                <span>
                                                                    <a href="{{url(route("order.view",$order->id)) }}" class="btn btn-dark btn-sm"><i class="fa fa-eye" style="color: white"></i> @lang('')</a>
                                                                </span>
                                                            </p>
                                                        </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 mb-4">
                                <div class="card-header border-0 p-0 bg-transparent bg-transparent" id="headingFour">
                                    <h5 class="mb-0 fs-18 w-100">
                                        <a href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="d-flex align-items-center border-bottom pb-2 text-decoration-none collapsed">
                                            <span>
                                              <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                  <span>
                                                   <i class="fas fa-sign-out-alt"></i>
                                                  </span>
                                                </div>
                                                <div class="mx-2">
                                                  <span>|</span>
                                                </div>
                                                <div>
                                                  <span>{{ __('site.logout') }}</span>
                                                </div>
                                               </div>
                                            </span>
                                            <!-- <span class="icon d-inline-block ml-auto"></span> -->
                                        </a>
                                        <form id="logout-form" action="{{ route('logout.client') }}" method="get" class="d-none">
                                            @csrf
                                        </form>
                                    </h5>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion-style-01">
                                    <div class="card-body pt-4 pb-1 px-0">
                                        <div class="">
                                            <h2 class="text-center ">اعلاناتي </h2>
                                            <form class="table-responsive-md pb-8 pb-lg-10">
                                                <table class="table border text-center justify-content-center align-items-center">
                                                    <thead style="background-color: #F5F5F5">
                                                    <tr class="fs-15 font-weight-600 text-uppercase text-secondary">
                                                        <th scope="col" class="border-1x">الاعلانات</th>
                                                        <th  class="border-1x">السعر</th>
                                                        <th  class="border-1x">حذف</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <tr class="position-relative">
                                                        <th scope="row" class="py-4">
                                                            <div class="media align-items-center justify-content-around">

                                                                <div class="">
                                                                    <img src="images/1704127616530.jpg"
                                                                         class="mw-75px">
                                                                </div>
                                                                <div class="">
                                                                    <p class="font-weight-500 mb-1 text-secondary"> شركة وليد السعدي</p>
                                                                    <p class="card-text font-weight-bold fs-14 mb-1 text-secondary">
                                                                        <span class="fs-13 font-weight-500 text-decoration-through text-body">$39.00</span>
                                                                        <span>$29.00</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </th>

                                                        <td class="align-middle">
                                                            <div class="d-flex justify-content-around align-items-center">
                                                                <p class="mb-0 text-secondary font-weight-bold">$48.00</p>

                                                            </div>
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="d-flex justify-content-around align-items-center">
                                                                <p class="mb-0 text-secondary font-weight-bold"><a href="#"><i
                                                                                class="fal fa-times text-body"></i></a></p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="position-relative opacity-5">
                                                        <th scope="row" class="py-4">
                                                            <div class="media align-items-center justify-content-around">

                                                                <div class="">
                                                                    <img src="images/1704127616530.jpg"
                                                                         class="mw-75px">
                                                                </div>
                                                                <div class="">
                                                                    <p class="font-weight-500 mb-1 text-secondary"> شركة وليد السعدي</p>
                                                                    <p class="card-text font-weight-bold fs-14 mb-1 text-secondary">
                                                                        <span class="fs-13 font-weight-500 text-decoration-through text-body">$39.00</span>
                                                                        <span>$29.00</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="pos-fix-top-left position-absolute py-1 px-3 bg-muted text-white">
                                                                <span class="badge text-uppercase fs-14 letter-spacing-01 p-0">out of stock</span>
                                                            </div>
                                                        </th>

                                                        <td class="align-middle">
                                                            <div class="d-flex justify-content-around align-items-center">
                                                                <p class="mb-0 text-secondary font-weight-bold">$48.00</p>

                                                            </div>
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="d-flex justify-content-around align-items-center">
                                                                <p class="mb-0 text-secondary font-weight-bold"><a href="#"><i
                                                                                class="fal fa-times text-body"></i></a></p>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="position-relative">
                                                        <th scope="row" class="py-4">
                                                            <div class="media align-items-center justify-content-around">

                                                                <div class="">
                                                                    <img src="images/1704127616530.jpg"
                                                                         class="mw-75px">
                                                                </div>
                                                                <div class="">
                                                                    <p class="font-weight-500 mb-1 text-secondary"> شركة وليد السعدي</p>
                                                                    <p class="card-text font-weight-bold fs-14 mb-1 text-secondary">
                                                                        <span class="fs-13 font-weight-500 text-decoration-through text-body">$39.00</span>
                                                                        <span>$29.00</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </th>

                                                        <td class="align-middle">
                                                            <div class="d-flex justify-content-around align-items-center">
                                                                <p class="mb-0 text-secondary font-weight-bold">$48.00</p>

                                                            </div>
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="d-flex justify-content-around align-items-center">
                                                                <p class="mb-0 text-secondary font-weight-bold"><a href="#"><i
                                                                                class="fal fa-times text-body"></i></a></p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="position-relative">
                                                        <th scope="row" class="py-4">
                                                            <div class="media align-items-center justify-content-around">

                                                                <div class="">
                                                                    <img src="images/1704127616530.jpg"
                                                                         class="mw-75px">
                                                                </div>
                                                                <div class="">
                                                                    <p class="font-weight-500 mb-1 text-secondary"> شركة وليد السعدي</p>
                                                                    <p class="card-text font-weight-bold fs-14 mb-1 text-secondary">
                                                                        <span class="fs-13 font-weight-500 text-decoration-through text-body">$39.00</span>
                                                                        <span>$29.00</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </th>

                                                        <td class="align-middle">
                                                            <div class="d-flex justify-content-around align-items-center">
                                                                <p class="mb-0 text-secondary font-weight-bold">$48.00</p>

                                                            </div>
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="d-flex justify-content-around align-items-center">
                                                                <p class="mb-0 text-secondary font-weight-bold"><a href="#"><i
                                                                                class="fal fa-times text-body"></i></a></p>
                                                            </div>
                                                        </td>
                                                    </tr>


                                                    </tbody>
                                                </table>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{--
        <section class="pb-0 pb-lg-6 d-none d-lg-block">
            <div class="container">
                <h4 class="my-5">Profile </h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="nav nav-tabs flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-home-tab" data-toggle="pill" data-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">

                                <div class="d-flex align-items-center justify-content-between">

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <span><i class="fas fa-user"></i></span>
                                        </div>
                                        <div class="mx-2">
                                            <span>|</span>
                                        </div>
                                        <div>
                                            <span> My Profile</span>
                                        </div>
                                    </div>

                                    <div>
                                        <span><i class="fas fa-arrow-right"></i></span>
                                    </div>
                                </div>

                            </button>
                            <button class="nav-link" id="v-pills-messages-tab" data-toggle="pill" data-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                <div class="d-flex align-items-center justify-content-between">

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <span><i class="far fa-heart"></i></span>
                                        </div>
                                        <div class="mx-2">
                                            <span>|</span>
                                        </div>
                                        <div>
                                            <span>  My WishList</span>
                                        </div>
                                    </div>

                                    <div>
                                        <span><i class="fas fa-arrow-right"></i></span>
                                    </div>
                                </div>
                            </button>
                            <button class="nav-link" id="v-pills-settings-tab" data-toggle="pill" data-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                <div class="d-flex align-items-center justify-content-between">

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                       <span>
                        <i class="fas fa-shopping-cart"></i>
                       </span>
                                        </div>
                                        <div class="mx-2">
                                            <span>|</span>
                                        </div>
                                        <div>
                                            <span>  My Orders</span>
                                        </div>
                                    </div>

                                    <div>
                                        <span><i class="fas fa-arrow-right"></i></span>
                                    </div>
                                </div>

                            </button>
                            <button class="nav-link" id="v-pills-lang-tab" data-toggle="pill" data-target="" type="button" role="tab" aria-controls="" aria-selected="false">
                                <div class="d-flex align-items-center justify-content-between">

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                           <span>
                            <i class="fas fa-sign-out-alt"></i>
                           </span>
                                        </div>
                                        <div class="mx-2">
                                            <span>|</span>
                                        </div>
                                        <div>
                                            <span> Log Out</span>
                                        </div>
                                    </div>

                                    <div>
                                        <span><i class="fas fa-arrow-right"></i></span>
                                    </div>
                                </div>

                            </button>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div>
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-12 form-control-01">

                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-md-0 mb-4">
                                                            <label for="street-address"
                                                                   class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">
                                                                full name
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                   name="streetaddress" required="">
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-md-0 mb-4">
                                                            <label for="city" class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">المدينة</label>
                                                            <input type="text" class="form-control" id="city" name="city" required="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">info</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <input type="email" class="form-control" id="email" name="email"
                                                                   placeholder="البريد الالكتروني" required="">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <input type="number" class="form-control" id="phone" name="phone"
                                                                   placeholder="رقم الهاتف" required="">
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="mb-3">
                                                    <label for="city" class="mb-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">
                                                        change password :
                                                    </label>
                                                    <div class="row">
                                                        <div class="col-md-12  mb-4">
                                                            <input type="password" class="form-control" placeholder="Old-password" required="">

                                                        </div>
                                                        <div class="col-md-12  mb-4">
                                                            <input type="password" class="form-control" placeholder="New-password" required="">

                                                        </div>
                                                        <div class="col-md-12">

                                                            <input type="password" class="form-control" placeholder="Confirm-password" required="">

                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- <div class="custom-control custom-checkbox mt-6 mb-5">
                                                  <input type="checkbox" class="custom-control-input" name="customCheck6" checked=""
                                                               id="customCheck5">
                                                  <label class="custom-control-label custom-control-label-secondary text-secondary"
                                                               for="customCheck5">
                                                    <span class="text-body">ادخل العموان كما في الشحن</span>
                                                  </label>
                                                </div> -->
                                                <button type="submit" class="btn btn-secondary bg-hover-primary border-hover-primary px-7 mt-3">Submit </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                            </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

                                <form class="table-responsive-md pb-8 pb-lg-10">
                                    <table class="table border text-center justify-content-center align-items-center">
                                        <thead style="background-color: #F5F5F5">
                                        <tr class="fs-15 font-weight-600 text-uppercase text-secondary">
                                            <th scope="col" class="border-1x">المنتجات</th>
                                            <th  class="border-1x">السعر</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="position-relative">
                                            <th scope="row" class="py-4">
                                                <div class="media align-items-center justify-content-around">
                                                    <div>
                                                        <div class="d-flex justify-content-around align-items-center">
                                                            <p class="mb-0 text-secondary font-weight-bold"><a href="#"><i
                                                                            class="fal fa-times text-body"></i></a></p>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <img src="images/0007382_atzen-oily-skin-and-acne-treatment-group-b_200.jpeg"
                                                             class="mw-75px">
                                                    </div>
                                                    <div class="">
                                                        <p class="font-weight-500 mb-1 text-secondary"> ATZEN - Oily skin and acne treatment group B</p>

                                                    </div>
                                                </div>
                                            </th>

                                            <td class="align-middle">
                                                <div class="d-flex justify-content-around align-items-center">
                                                    <p class="mb-0 text-secondary font-weight-bold">$48.00</p>

                                                </div>
                                            </td>

                                        </tr>
                                        <tr class="position-relative">
                                            <th scope="row" class="py-4">
                                                <div class="media align-items-center justify-content-around">
                                                    <div>
                                                        <div class="d-flex justify-content-around align-items-center">
                                                            <p class="mb-0 text-secondary font-weight-bold"><a href="#"><i
                                                                            class="fal fa-times text-body"></i></a></p>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <img src="images/0007382_atzen-oily-skin-and-acne-treatment-group-b_200.jpeg"
                                                             class="mw-75px">
                                                    </div>
                                                    <div class="">
                                                        <p class="font-weight-500 mb-1 text-secondary"> ATZEN - Oily skin and acne treatment group B</p>

                                                    </div>
                                                </div>
                                            </th>

                                            <td class="align-middle">
                                                <div class="d-flex justify-content-around align-items-center">
                                                    <p class="mb-0 text-secondary font-weight-bold">$48.00</p>

                                                </div>
                                            </td>

                                        </tr>
                                        <tr class="position-relative">
                                            <th scope="row" class="py-4">
                                                <div class="media align-items-center justify-content-around">
                                                    <div>
                                                        <div class="d-flex justify-content-around align-items-center">
                                                            <p class="mb-0 text-secondary font-weight-bold"><a href="#"><i
                                                                            class="fal fa-times text-body"></i></a></p>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <img src="images/0007382_atzen-oily-skin-and-acne-treatment-group-b_200.jpeg"
                                                             class="mw-75px">
                                                    </div>
                                                    <div class="">
                                                        <p class="font-weight-500 mb-1 text-secondary"> ATZEN - Oily skin and acne treatment group B</p>

                                                    </div>
                                                </div>
                                            </th>

                                            <td class="align-middle">
                                                <div class="d-flex justify-content-around align-items-center">
                                                    <p class="mb-0 text-secondary font-weight-bold">$48.00</p>

                                                </div>
                                            </td>

                                        </tr>


                                        </tbody>
                                    </table>
                                </form>


                            </div>
                            <div class="tab-pane fade edit-details" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                <form class="table-responsive-md pb-8 pb-lg-10">
                                    <table class="table border text-center justify-content-center align-items-center">
                                        <thead style="background-color: #F5F5F5">
                                        <tr class="fs-15 font-weight-600 text-uppercase text-secondary">
                                            <th scope="col" class="border-1x">المنتجات</th>
                                            <th  class="border-1x">الكمية</th>
                                            <th  class="border-1x">السعر</th>
                                            <th  class="border-1x">التاريخ</th>
                                            <th  class="border-1x">الحالة</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="position-relative">
                                            <th scope="row" class="py-4">
                                                <div class="media align-items-center justify-content-around">
                                                    <div>
                                                        <div class="d-flex justify-content-around align-items-center">
                                                            <p class="mb-0 text-secondary font-weight-bold"><a href="#"><i
                                                                            class="fal fa-times text-body"></i></a></p>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <img src="images/0007382_atzen-oily-skin-and-acne-treatment-group-b_200.jpeg"
                                                             class="mw-75px">
                                                    </div>
                                                    <div class="">
                                                        <p class="font-weight-500 mb-1 text-secondary"> ATZEN - Oily skin and acne treatment group B</p>

                                                    </div>
                                                </div>
                                            </th>
                                            <td class="align-middle">
                                                <p class="card-text font-weight-bold fs-14  text-secondary">
                                                    <span>2</span>
                                                </p>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-around align-items-center">
                                                    <p class="mb-0 text-secondary font-weight-bold">$48.00</p>

                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <p class="card-text font-weight-bold fs-14  text-secondary">
                                                    <span>10-10-2023</span>
                                                </p>
                                            </td>
                                            <td class="align-middle">
                                                <p class="card-text font-weight-bold fs-14  text-secondary">
                                                    <span>مكتمل</span>
                                                </p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        --}}
    </main>




@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).on('click','.remove-from-wish',function (e) {

            e.preventDefault();
            $.ajax({
                type: 'delete',
                url:"{{route('wishlist.destroy')}}",
                data:{
                    "_token": "{{ csrf_token() }}",
                    'productId':$(this).attr('data-id'),
                },
                success:function (data) {
                    if (data.message){
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })
                        Toast.fire({
                            icon: 'error',
                            title: data.message,
                            width: 600,
                            padding: '3em',

                        })
                        location.reload();
                    }
                }
            });


        });
    </script>
@endsection

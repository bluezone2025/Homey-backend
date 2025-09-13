@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.orders.index')}}">@lang('layout.orders')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.show')</span></li>
@endsection

@section('content')

    <div class="container">
        <article class="card">
            @include('admin.includes.alert_success')
            <header class="card-header">
                @lang('form.label.order place') <br> <sapn class="print-hide">
                    @foreach($order->studentIds() as $studentId )
                        @if($studentId != 0)
                         @php $student = \App\Models\Student::find($studentId);
                              if ($student){
                                $studentValue = $student->name;
                              }else{
                                $studentValue = "";
                              }
                         @endphp
                            {{ $studentValue }}
                        @else
                            {{  "تيرندات" }}
                        @endif
                        |
                    @endforeach
                    </sapn>
                <button onclick="printContainer()" class="btn btn-primary float-right print-hide ">Print</button>

            </header>
            <div class="card-body">
                <h6></h6>
                <article class="card">
                    <div class="card-body row">
                        <div class="col-md-4 col-6"> <strong>@lang('form.label.order date'):</strong> <br>{{$order->created_at}}</div>
                        <div class="col-md-4 col-6"> <strong>@lang('form.label.count products')</strong> <br> {{$order->products_count}} @lang('form.label.product') </div>
                        <div class="col-md-4 col-6"> <strong>@lang('form.label.order number'):</strong> <br> KE{{date('Y')}}-{{$order->id}} </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-3 col-6"> <strong>@lang('form.label.order price'):</strong> <br>{{$order->order_price}} @lang('form.label.default currency') </div>
                        <div class="col-md-3 col-6"> <strong>@lang('form.label.shipping price'):</strong> <br>{{$order->shipping_price}} @lang('form.label.default currency') </div>
                        <div class="col-md-3 col-6"> <strong>@lang('form.label.discount'):</strong> <br>{{$order->discount??0}} @lang('form.label.default currency') </div>
                        <div class="col-md-3 col-6"> <strong>@lang('form.label.total order'):</strong> <br>{{$order->total_price}} @lang('form.label.default currency') </div>
                        <div class="col-md-3 col-6"> <strong>@lang('site.payment type'):</strong> <br>
                            @if($order->payment_method == "wallet") {{ __('site.wallet') }} @elseif($order->payment_method == "knet") {{ __('aliases.payment_method.knet') }} @elseif($order->payment_method == "tabby") {{ __('site.tabby') }} @else {{ __('site.cash') }} @endif
                            </div>
                    </div>

                    <div class="card-body row">
                        <div class="col print-only "> <strong>@lang('form.label.status'):</strong> <br> {{ __('aliases.status.' . $order->status)}}</div>
                    </div>
                </article>

                @php($status = ['reject' => 0, 'pending' => 1, 'accept' => 2, 'shipping' => 3 , 'done' => 4])

                @if ($order->status === 'reject')
                    <div class="alert alert-danger mt-5"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">@lang('aliases.status.reject')</span> </div>
                @endif


                <div class="print-hide">
                    <div class="track">
                        <div class="step {{$status[$order->status] >= 1 ? 'active' : ''}}"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">@lang('aliases.status.pending')</span> </div>
                        <div class="step {{$status[$order->status] >= 2 ? 'active' : ''}}"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">@lang('aliases.status.accept')</span> </div>
                        <div class="step {{$status[$order->status] >= 3 ? 'active' : ''}}"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">@lang('aliases.status.shipping')</span> </div>
                        <div class="step {{$status[$order->status] >= 4 ? 'active' : ''}}"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">@lang('aliases.status.done')</span> </div>
                    </div>
                </div>
                <hr>
                <ul class="row">

                    <?php $i =0; $quantity_data=1?>
                    @foreach($order->productItems as $productItem)

                        <?php
                                $product = $productItem->product;
                            //$quantity = $product->pivot->quantity;
                            /*$attributes = json_decode($product->pivot->attributes, true) ?? [];*/
                            $attributes = $productItem->attributes;


                            ?>
                        @if($product)
                         <li class="col-md-4">
                                <figure class="itemside mb-3">
                                    <div class="aside"><img src="{{asset("assets/images/products/min/$product->img")}}" class="img-sm border"></div>
                                    <figcaption class="info align-self-center">
                                        <p class="title">{{$productItem->product_name}}</p>
                                        <p class="title">
                                            @if($attributes)
                                            @foreach($attributes as $attr)
                                                @if($attr['attribute'] && $attr['option'])
                                                    <span >
                                                        {{ $attr['option']['value_ar'] }}
                                                    </span>
                                                @endif

                                            @endforeach
                                            @endif
                                        <p class="title">{{__('form.label.barcode')}} : {{$product->barcode}}</p>
                                        <p>@lang('form.label.price') :
                                            @if($productItem->sale_price > 0 )
                                                {{ $productItem->sale_price }}

                                            @else
                                                {{$productItem->regular_price  }}
                                            @endif


                                        <p>@lang('form.label.quantity') :{{$productItem->quantity}}</p>


                                        @if (count($product->students) > 0)
                                                <p>{{ $product->students->first()->name }}</p>
                                        @else
                                            <p> تريندات</p>
                                        @endif
                                        @if($product->brand_name)
                                            <p>{{ __('site.brand_name') }} : {{ $product->brand_name }}</p>
                                        @endif
                                        @if($productItem->color_id)
                                            <?php $image = \App\Models\ProductColor::find($productItem->color_id)->image; ?>
                                            <p>{{ __('site.color') }} :

                                                <img src="{{asset('assets/images/products/min/'. $image)}}" style="width: 50px; height: 50px; border-radius: 50%" >


                                            </p>
                                        @endif

                                        @if($order->status !="reject")
                                            <a style=""
                                               onclick="return confirmRefund()"
                                               href="{{route('admin.orders.remove_item',$productItem->id)}}" class="btn btn-small"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </figcaption>
                                </figure>

                                <?php
                                ?>


                            <?php $i = 1?>



                        </li>
                        @endif    
                       
                    @endforeach

                </ul>
            </div>
        </article>

        <article class="card">
            <div class="card-body row">
                <div class="col-md-4 col-6"> <strong>@lang('form.label.name'):</strong> <br>{{$order->shipping_address->name}}</div>
                <div class="col-md-4 col-6"> <strong>@lang('form.label.phone'):</strong> <br>{{$order->shipping_address->phone . ' '}} {{$order->shipping_address->phone2  ?? ''}}</div>
                <div class="col-md-4 col-6"> <strong>@lang('form.label.delivered_by'):</strong> <br>{{$order->shipping_address->delivered_by == "address"? __('form.label.address_full') : __('form.label.phone_full')}}</div>
            </div>

            <div class="card-body">
                @if($order->shipping_address->delivered_by == "phone")
                    <div class="row" style="padding: 15px 0px">

                        <div class="col-md-4 col-6">
                            <strong>@lang('form.label.name'):</strong> <br>{{$order->shipping_address->name}}</div>

                        <div class="col-md-4 col-6">
                            <strong>@lang('site.area')</strong>
                            @if($order->shipping_address->area)
                                <br> {{  $order->shipping_address->area["name_$lang"] ?? "-"}}
                            @else <br> - @endif

                        </div>

                        <div class="col-md-4 col-6">
                            <strong>@lang('site.phone')</strong>
                            <br>
                            {{ $order->shipping_address->phone?? "-"  }}
                        </div>

                        <div class="col-md-4 col-6"> <strong>@lang('form.label.note'):</strong> <br>{{$order->shipping_address->note}}</div>
                    </div>
                @else
                    <div class="row" style="padding: 15px 0px">

                        <div class="col-md-4 col-6">
                            <strong>@lang('form.label.address'):</strong> <br>{{$order->shipping_address->address}}</div>

                        <div class="col-md-4 col-6">
                            <strong>@lang('site.area')</strong>
                            @if($order->shipping_address->area)
                                <br> {{  $order->shipping_address->area["name_$lang"] ?? "-"}}
                            @else <br> - @endif

                        </div>

                        <div class="col-md-4 col-6">
                            <strong>@lang('site.region')</strong>
                            <br>
                            {{ $order->shipping_address->region?? "-"  }}

                        </div>

                        <div class="col-md-4 col-6">
                            <strong>@lang('site.piece')</strong>
                            <br>
                            {{ $order->shipping_address->piece?? "-"  }}

                        </div>
                    </div>
                    <div class="row" style="padding: 15px 0px">
                        <div class="col-md-4 col-6">
                            <strong>@lang('site.avenue')</strong>

                            <br> {{  $order->shipping_address->avenue ?? "-"}}

                        </div>

                        <div class="col-md-4 col-6">
                            <strong>@lang('site.street')</strong>

                            <br> {{  $order->shipping_address->street ?? "-"}}

                        </div>


                        <div class="col-md-4 col-6">
                            <strong>@lang('site.house_number')</strong>

                            <br> {{  $order->shipping_address->house_number ?? "-"}}

                        </div>

                        <div class="col-md-4 col-6">
                            <strong>@lang('site.flat_number')</strong>

                            <br> {{  $order->shipping_address->flat_number ?? "-"}}

                        </div>

                        <div class="col-md-4 col-6">
                            <strong>@lang('site.floor')</strong>

                            <br> {{  $order->shipping_address->floor ?? "-"}}

                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-4 col-6"> <strong>@lang('form.label.note'):</strong> <br>{{$order->note}}</div>
                </div>



            </div>


            <div class="card-body row print-only ">
                <div class="col text-center">
                    {{ __('form.label.thanks',['name'=>$order->shipping_address->name ]) }}
                </div>
            </div>

        </article>
    </div>


@endsection

@section('css')

    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

        body {
            background-color: #eeeeee;
            font-family: 'Open Sans', serif
        }

        .container {
            margin-top: 50px;
            margin-bottom: 50px
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.10rem
        }

        .card-header:first-child {
            border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1)
        }

        .track {
            position: relative;
            background-color: #ddd;
            height: 7px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 60px;
            margin-top: 50px
        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;
            margin-top: -18px;
            text-align: center;
            position: relative
        }

        .track .step.active:before {
            background: #FF5722
        }

        .track .step::before {
            height: 7px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px
        }

        .track .step.active .icon {
            background: #ee5435;
            color: #fff
        }

        .track .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            position: relative;
            border-radius: 100%;
            background: #ddd
        }

        .track .step.active .text {
            font-weight: 400;
            color: #000
        }

        .track .text {
            display: block;
            margin-top: 7px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .itemside .aside {
            position: relative;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .img-sm {
            width: 80px;
            height: 80px;
            padding: 7px
        }

        ul.row,
        ul.row-sm {
            list-style: none;
            padding: 0
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .itemside .title {
            display: block;
            margin-bottom: 5px;
            color: #212529
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        .btn-warning {
            color: #ffffff;
            background-color: #ee5435;
            border-color: #ee5435;
            border-radius: 1px
        }

        .btn-warning:hover {
            color: #ffffff;
            background-color: #ff2b00;
            border-color: #ff2b00;
            border-radius: 1px
        }
    </style>

    <style>
        @media print {
            .print-hide {
                display: none;
            }
        }

        @media print {
            .print-only {
                display: block !important;
            }
        }

        @media screen {
            .print-only {
                display: none !important;
            }
        }
    </style>

@endsection

@section('js')

    <script>
        function printContainer() {
            window.print();
        }

        function confirmRefund() {
            return confirm("هل أنت متأكد أنك تريد إزالة هذا العنصر واسترداد المبلغ؟");
        }
    </script>



@endsection

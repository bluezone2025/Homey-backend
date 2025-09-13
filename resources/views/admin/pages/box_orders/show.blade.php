@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.box_orders.index')}}">@lang('layout.orders')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.show')</span></li>
@endsection

@section('content')

    <div class="container">
        <article class="card">
            <header class="card-header">@lang('form.label.order details')</header>
            <div class="card-body">
                <h6></h6>
                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>@lang('form.label.order date'):</strong> <br>{{$order->created_at}}</div>
                        <div class="col"> <strong>@lang('form.label.order number'):</strong> <br> KE{{date('Y')}}-{{$order->id}} </div>
                    </div>
                    <div class="card-body row">
                        <div class="col"> <strong>@lang('form.label.total order'):</strong> <br>{{$order->total_price}} @lang('form.label.default currency') </div>
                    </div>
                </article>
                <hr>
                <ul class="row">

                    {{--box content  here--}}

                </ul>
            </div>
        </article>

        <article class="card">
            <div class="card-body row">
                <div class="col"> <strong>@lang('form.label.name'):</strong> <br>{{$order->shipping_address->name ?? $order->user->name??""}}</div>
                <div class="col"> <strong>@lang('form.label.phone'):</strong> <br>{{$order->shipping_address->phone ?? $order->user->phone ?? "". ' '}} {{$order->shipping_address->phone2  ?? ''}}</div>
                <div class="col"> <strong>@lang('form.label.email'):</strong> <br>{{$order->shipping_address->email ?? $order->user->email?? ""}}</div>
            </div>

            <div class="card-body row">
                <div class="col"> <strong>@lang('form.label.address'):</strong> <br>{{$order->shipping_address->address ?? NULL}}</div>
                @if($order->shipping_address->area ?? NULL)
                    <div class="col"> <strong>@lang('form.label.country') - @lang('form.label.area'):</strong> <br>{{$order->shipping_address->area->country["name_$lang"] ?? NULL . ' - ' .$order->shipping_address->area["name_$lang"] ?? NULL}}</div>
                @endif
                <div class="col"> <strong>@lang('form.label.note'):</strong> <br>{{$order->note}}</div>


                <div class="col-12">
                    <hr>
                    <h6 class="text-center">الصور</h6>

                    <div class="row">
                        <li class="col-md-4">
                            <?php $image = $order->box->default_image;?>
                            <figure class="itemside mb-3">
                                <div class="aside"><img src="{{asset("assets/images/boxes/min/$image")}}" class="img-sm border"></div>
                            </figure>
                        </li>
                        @foreach($order->box->galleries as $gallery)
                            <li class="col-md-4">
                                <figure class="itemside mb-3">
                                    <div class="aside"><img src="{{asset("assets/images/boxes/gallery/$gallery->image")}}" class="img-sm border"></div>
                                </figure>
                            </li>
                        @endforeach
                    </div>
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

@endsection

@section('js')


@endsection

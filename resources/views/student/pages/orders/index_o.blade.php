@extends('student.master')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.products in orders')</span></li>
@endsection

@section('content')

    <div class="container">
        <div id="pricingWrapper" class="row">
            @if ($products->count() > 0)
                @foreach($products as $product)

                <div class="col-md-6 col-lg-4">
                    <div class="card stacked mt-5">
                        <div class="card-header pt-0 align-self-center">
                            <span class="card-price" style="overflow: hidden">
                                @if($product->product)
                                    <img width="80" src="{{asset("assets/images/products/min/small_".$product->product->img)}}" alt="">
                                @endif
                            </span>
                            <p>{{$product->product_name}}</p>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-minimal mb-3 align-items-end" >
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                     @lang('form.label.price'){{$product->end_price}}
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    @lang('form.label.quantity') {{$product->quantity}}
                                </li>
                                <!--<li class="list-group-item d-flex justify-content-between align-items-center">-->
                                <!--    @lang('form.label.points') {{$product->points}}-->
                                <!--</li>-->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    @lang('form.label.created_at') {{$product->created_at}}
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
            @else
                <div class="alert alert-info col-12">@lang('form.label.not any info')</div>
            @endif
        </div>
        {!! $products->links() !!}

    </div>

@endsection

@section('css')
    <link href="{{asset('assets/plugins/pricing-table/css/component.css')}}" rel="stylesheet" type="text/css" />
@endsection

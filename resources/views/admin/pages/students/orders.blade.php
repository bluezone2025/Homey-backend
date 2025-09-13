@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.student.index')}}">@lang('layout.students')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.products in orders')</span></li>
@endsection

@section('content')

    <div class="container">
        <div id="pricingWrapper" class="row">
            @if ($products->count() > 0)
                @foreach($products as $product)
                <div class="col-md-6 col-lg-4">
                    <div class="card stacked mt-5">
                        <div class="card-header pt-0">
                            <span class="card-price">
                                <img width="80" src="{{asset("assets/images/products/min/small_".$product->products()->first()->img?? "")}}" alt="">
                            </span>

                                <p style="min-height: 40px">
                                @foreach($product->products()->get() as $item )

                                    <span>{{$item->name_ar}}</span>
                                    -
                                @endforeach
                                </p>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-minimal mb-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                     @lang('form.label.order price') {{$product->order_price}}
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    @lang('form.label.quantity') {{$product->products_count}}
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    @lang('form.label.order date') {{$product->created_at}}
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
            @else
                <div class="alert alert-info col-12">@lang('form.label.not any product from this student')</div>
            @endif
        </div>
        {!! $products->links() !!}

    </div>

@endsection

@section('css')
    <link href="{{asset('assets/plugins/pricing-table/css/component.css')}}" rel="stylesheet" type="text/css" />
@endsection

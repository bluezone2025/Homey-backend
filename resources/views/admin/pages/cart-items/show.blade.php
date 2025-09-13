@extends('admin.master')

@section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.cart-items.index')}}">@lang('layout.cart-items')</a></li>
        <li class="breadcrumb-item"><a href="#">@lang('layout.cart-items.show')</a></li>

@endsection

@section('content')

    <div class="table-responsive">
        <table class="table table-bordered table-active table-striped">
            <thead>
            <tr>
                <th>@lang('form.label.id')</th>
                <th>@lang('form.label.name')</th>
                <th>@lang('form.label.phone')</th>
                <th>@lang('form.label.product')</th>
                <th>@lang('form.label.quantity')</th>
                <th>@lang('form.label.price')</th>
                <th>@lang('form.label.created_at')</th>
            </tr>
            </thead>
            <tbody>
            @php $i = 0;@endphp
            @forelse($cart_items as $cart_item)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $cart_item->username?? "Not found" }}</td>
                    <td>{{ $cart_item->phone?? "Not Found" }}</td>
                    <td>{{ @$cart_item->product->{'name_'.app()->getLocale()} }}</td>
                    <td>{{ $cart_item->quantity }}</td>
                    <td>{{ $cart_item->price * $cart_item->quantity}}</td>
                    <td>{{ $cart_item->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">@lang('layout.no_records_found')</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center" style="margin: 40px auto">

    </div>


@endsection

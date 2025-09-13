@extends('admin.master')

@section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{route('admin.cart-items.index')}}">@lang('layout.cart-items')</a></li>

@endsection

@section('content')

    <div class="d-flex justify-content-between mb-3" style="margin: 10px">
        <form action="{{ route('admin.cart-items.index') }}" method="GET" class="form-inline">
            <input type="text" name="search" class="form-control mr-sm-2" placeholder="@lang('form.label.search')" value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary">@lang('form.label.search')</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-active table-striped">
            <thead>
            <tr>
                <th>@lang('form.label.id')</th>
                <th>@lang('form.label.name')</th>
                <th>@lang('form.label.phone')</th>
                <th>@lang('form.label.total')</th>
                <th>@lang('form.label.updated_at')</th>
                <th>@lang('form.label.operation')</th>

                {{--
                <th>@lang('form.label.product')</th>
                <th>@lang('form.label.quantity')</th>
                <th>@lang('form.label.price')</th>
                <th>@lang('form.label.created_at')</th>--}}
            </tr>
            </thead>
            <tbody>
            @php $i = 0;@endphp
            @forelse($cart_items as $cart_item)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $cart_item->username?? "Not found" }}</td>
                    <td>{{ $cart_item->phone?? "Not Found" }}</td>
                    {{--<td>{{ @$cart_item->product->{'name_'.app()->getLocale()} }}</td>
                    <td>{{ $cart_item->quantity }}</td>
                    <td>{{ $cart_item->price * $cart_item->quantity}}</td>--}}
                    <td>{{ $cart_item->total_price }}</td>
                    <td>{{ $cart_item->last_updated_at }}</td>
                    <td><a href="{{route('admin.cart-items.show',['ip_address'=>$cart_item->ip_address,'username'=>$cart_item->username?? "no","phone"=>$cart_item->phone??"no"])}}"><i class="fa fa-eye"></i></a></td>
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

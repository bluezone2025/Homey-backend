@extends('admin.master')

@section('breadcrumb')
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.orders')</span></li>

@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button() !!}



    {!! myDataTable_table([
        "id"              => 'id',
        "user.name"       => __('form.label.user name'),
        "user.phone"      => __('form.label.phone'),
        "products_count"  => __('form.label.count products'),
        "total_price"     => __('form.label.total order'),
        "status"          => __('form.label.status'),
        "imaget"          => __('form.label.image'),
    ]) !!}

@endsection

@section('css')

    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
    <style>

        img.img-item-one {
            width: 80px;
            padding: 5px;
        }
    </style>
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>


        let status = '@json(__('aliases.status'))'

        myDataTableColumns({
            name   :  ['id',  'shipping_address.name', 'shipping_address.phone', 'products_count', 'total_price','status','imaget'],
            class  : {'updated_at': 'notEdit' , 'created_at': 'notEdit', 'products_count': 'notEdit', 'order_price': 'notEdit' , 'discount': 'notEdit', 'shipping_price': 'notEdit', 'total_price': 'notEdit','image_t':'notEdit'},
            alias  : {status},
            select : {status},
            btn    :  {

                @can('role' , 'order.update')
                'edit'         : '{{route('admin.orders.update' , '')}}'+'/{id}',
                @endcan

                @can('role' , 'order.show')
                'show'         : '{{route('admin.orders.show' , '')}}'+'/{id}',
                @endcan
                'print'        : '#',

            }
        });
        
        $('#a-orders').attr('data-active',"true");
        $('#orders').addClass('show');
        $('#li-cach-orders').addClass('active');
    </script>
@endsection

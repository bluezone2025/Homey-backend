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
        "user.address"      => __('form.label.address'),
        "products_count"  => __('form.label.count products'),
        "total_price"     => __('form.label.total order'),
        "status"          => __('form.label.status'),
        "payment_method"  => __('form.label.payment_method'),
        "box_id"          => __('form.label.box_id'),
        "box_order_id"          => __('form.label.box_order_id'),
        //"imaget"          => __('form.label.image'),
        //"producttitles"          => __('form.label.product_titles'),
    ]) !!}

@endsection

@section('css')

    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
    <style>

        .table > thead > tr > th{
            max-width: 200px;
        }

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
        let payment_method = '@json(__('aliases.payment_method'))'

        myDataTableColumns({
            name   :  ['id',  'shipping_address.name', 'shipping_address.phone','shipping_address.address',
                'products_count', 'total_price','status','payment_method','box_id','box_order_id'/*'imaget','producttitles'*/],
            class  : {'updated_at': 'notEdit' , 'created_at': 'notEdit', 'products_count': 'notEdit',
                'order_price': 'notEdit' , 'discount': 'notEdit', 'shipping_price': 'notEdit',
                'total_price': 'notEdit',/*'image_t':'notEdit','product_titles':'notEdit'*/},
            alias  : {status,payment_method},
            select : {status,payment_method},
            btn    :  {

                @can('role' , 'order.update')
                'edit'         : '{{route('admin.orders.update' , '')}}'+'/{id}',
                @endcan

                'delete'       : '{{route('admin.orders.destroy' , '')}}'+'/{id}',

                @can('role' , 'order.show')
                'show'         : '{{route('admin.orders.show' , '')}}'+'/{id}',
                @endcan
                'print'        : '#',

            }
        })
    </script>
@endsection

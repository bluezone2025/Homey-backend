@extends('student.master')

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
        "total_price2"     => __('form.label.total order'),
        "status"          => __('form.label.status'),
        "imaget2"          => __('form.label.image'),
    ]) !!}

@endsection

@section('css')

    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
    <style>
        th.theOrderColumn.th-created_at,th.theOrderColumn.th-total_price,th.theOrderColumn.th-products_count {
            max-width: 100px !important;
            overflow-x: scroll;

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

        myDataTableColumns({
            name   :  ['id',  'shipping_address.name', 'shipping_address.phone', 'products_count2', 'total_price2','status','imaget2'],
            class  : {'shipping_address.name': 'notEdit','shipping_address.phone': 'notEdit','updated_at': 'notEdit' , 'created_at': 'notEdit', 'products_count': 'notEdit', 'order_price': 'notEdit' , 'discount': 'notEdit', 'shipping_price': 'notEdit', 'total_price2': 'notEdit','image_t2':'notEdit'},
            alias  : {status},
            select : {status},
            btn    :  {


                'show'         : '{{route('student.orders.show' , '')}}'+'/{id}',
                'print'        : '#',

            }
            /*btn    :  {

                'edit'         : '{{route('student.orders.update' , '')}}'+'/{id}',

                'show'         : '{{route('student.orders.show' , '')}}'+'/{id}',
                'print'        : '#',

            }*/
        })
    </script>
@endsection

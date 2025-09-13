@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.coupons')</span></li>
@endsection

@section('content')

    @include('admin.includes.modalBtnAction' , ['big' => true])

    {!! myDataTable_button([
        __('layout.add coupon') => route('admin.coupons.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"           => 'id',
        "name"         => __('form.label.name'),
        "code"         => __('form.label.code'),
        "is_active"    => __('form.label.status'),
        "end_date"     => __('form.label.end date'),
        "type_discount"=> __('form.label.type discount'),
        "discount"     => __('form.label.discount value'),
        "min_price"    => __('form.label.min price order'),
        "limit_use"        => __('form.label.limit'),
        "use"          => __('form.label.use'),
        "updated_at"   => __('form.label.updated_at'),
        "created_at"   => __('form.label.created_at'),
    ]) !!}

@endsection


@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>

        colLg = 6 ;


        let is_active = '@json([ '0' => 'غير متاحة للاستخدام' , '1' => 'متاحة للاستخدام'  ])';
        let type_discount   = '@json([ 'price' => 'خصم مالي ' , 'percentage' => ' نسبة مئوية'  ])';

        myDataTableColumns({
            name:  ['id', 'name', 'code', 'is_active', 'end_date',  'type_discount', 'discount', 'min_price', 'limit_use', 'use', 'updated_at', 'created_at'],
            class: {'updated_at': 'notEdit' , 'created_at': 'notEdit' , 'serial':'notEdit' , 'use':'notEdit'},
            select: {is_active , type_discount},
            alias: {is_active , type_discount},
            date:{'end_date':'date'},
            btn   :  {

                @can('role' , 'coupon.update')
                'edit': '{{route('admin.coupons.update' , '')}}'+'/{id}',
                @endcan

                @can('role' , 'coupon.update')
                'delete': '{{route('admin.coupons.destroy' , '')}}'+'/{id}',
                @endcan

                'print': '#',
            }
        })
    </script>
@endsection

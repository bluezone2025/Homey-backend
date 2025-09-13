@extends('admin.master')

@section('breadcrumb')
    @if(!$is_trash)
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.users')</span></li>
    @else
        <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">@lang('layout.users')</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.trash')</span></li>
    @endif
@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button([
        __('layout.add user') => route('admin.users.create'),
      ]) !!}



    {!! myDataTable_table([
        "id"           => 'id',
        "name"         => __('form.label.name'),
        "email"        => __('form.label.email'),
        "phone"        => __('form.label.phone'),
        "total_wallet"   => __('form.label.total_wallet'),
        "total_orders"   => __('form.label.user_total_orders'),
        "count_orders"   => __('form.label.user_count_orders'),
        "created_at"   => __('form.label.created_at'),
    ]) !!}

@endsection

@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>



        myDataTableColumns({
            name   :  ['id', 'name', 'email', 'phone', 'total_wallet','total_orders','count_orders', 'created_at'],
            class  : {'total_wallet': 'notEdit' , 'total_orders': 'notEdit','count_orders': 'notEdit','created_at': 'notEdit', 'password':'d-none'},
            btn    :  {

                {{--'edit'         : '{{route('admin.users.update' , '')}}'+'/{id}',--}}
                @if(!$is_trash)

                    @can('role' , 'user.destroy')
                        'delete'       : '{{route('admin.users.destroy' , '')}}'+'/{id}',
                    @endcan

                @else

                    @can('role' , 'user.restore')
                    'restore'      : '{{route('admin.users.restore' , '')}}'+'/{id}',
                    @endcan

                    @can('role' , 'user.finalDelete')
                        'delete'       : '{{route('admin.users.finalDelete' , '')}}'+'/{id}',
                    @endcan

                @endif

                    {{--'orders'       : ['{{route('admin.users.orders' , '')}}'+'/{id}' , '@lang('layout.show orders')'],--}}
                'print'        : '#',

            }
        })
    </script>
@endsection

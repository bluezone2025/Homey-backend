@extends('admin.master')

@section('breadcrumb')
    @if(!$is_trash)
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.admins')</span></li>
    @else
        <li class="breadcrumb-item"><a href="{{route('admin.admins.index')}}">@lang('layout.admins')</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.trash')</span></li>
    @endif
@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button([
        __('layout.add admin') => route('admin.admins.create'),
      ]) !!}



    {!! myDataTable_table([
        "id"           => 'id',
        "name"         => __('form.label.name'),
        "email"        => __('form.label.email'),
        "phone"        => __('form.label.password'),
        "role_id"      => __('form.label.role'),
        "password"     => [__('form.label.password') , false, false , 'all', 'd-none'],
        "updated_at"   => __('form.label.lastUpdate'),
        "created_at"   => __('form.label.created_at'),
    ]) !!}

@endsection

@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>

        let role_id = '@json($roles)';


        myDataTableColumns({
            name   :  ['id', 'name', 'email', 'phone', 'role_id', 'password',  'updated_at', 'created_at'],
            class  : {'updated_at': 'notEdit' , 'created_at': 'notEdit', 'password':'d-none'},
            alias  : {role_id},
            select : {role_id},
            btn    :  {

                @can('role' , 'admin.update')
                'edit'         : '{{route('admin.admins.update' , '')}}'+'/{id}',
                @endcan

                @if(!$is_trash)

                    @can('role' , 'admin.destroy')
                    'delete'       : '{{route('admin.admins.destroy' , '')}}'+'/{id}',
                    @endcan

                @else

                    @can('role' , 'admin.restore')
                    'restore'      : '{{route('admin.admins.restore' , '')}}'+'/{id}',
                    @endcan
                    @can('role' , 'admin.finalDelete')
                    'delete'       : '{{route('admin.admins.finalDelete' , '')}}'+'/{id}',
                    @endcan

                @endif

                'print'        : '#',

            }
        })
    </script>
@endsection

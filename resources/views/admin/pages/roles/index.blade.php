@extends('admin.master')

@section('breadcrumb')
    @if(!$is_trash)
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.roles')</span></li>
    @else
        <li class="breadcrumb-item"><a href="{{route('admin.roles.index')}}">@lang('layout.roles')</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.trash')</span></li>
    @endif
@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button([
        __('layout.add role') => route('admin.roles.create'),
      ]) !!}



    {!! myDataTable_table([
        "id"          => 'id',
        "name"        => __('form.label.name'),
        "description" => __('form.label.description'),
        "updated_at"  => __('form.label.updated_at'),
        "created_at"  => __('form.label.created_at'),
    ]) !!}

@endsection

@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>



        myDataTableColumns({
            name   :  ['id', 'name' , 'description',  'updated_at', 'created_at'],
            class  : {'updated_at': 'notEdit' , 'created_at': 'notEdit'},
            btn    :  {

                @can('role' , 'role.update')
                'edit': '{{route('admin.roles.update' , '')}}'+'/{id}',
                @endcan

                @if(!$is_trash)

                    @can('role' , 'role.destroy')
                    'delete': '{{route('admin.roles.destroy' , '')}}'+'/{id}',
                    @endcan

                    @can('role' , 'role.permission')
                    'permission':['{{route('admin.permission.index' , '')}}'+'/{id}' ,'@lang('form.label.permission')'],
                    @endcan

                @else

                    @can('role' , 'role.restore')
                    'restore': '{{route('admin.roles.restore' , '')}}'+'/{id}',
                    @endcan

                    @can('role' , 'role.finalDelete')
                    'delete': '{{route('admin.roles.finalDelete' , '')}}'+'/{id}',
                    @endcan

                @endif

                'print': '#',

            }
        })
    </script>
@endsection

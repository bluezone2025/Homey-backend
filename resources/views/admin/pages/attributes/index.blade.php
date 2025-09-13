@extends('admin.master')

@section('breadcrumb')
    @if(!$is_trash)
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.attributes')</span></li>
    @else
        <li class="breadcrumb-item"><a href="{{route('admin.attributes.index')}}">@lang('layout.attributes')</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.trash')</span></li>
    @endif
@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button([
        __('layout.add attribute') => route('admin.attributes.create'),
      ]) !!}



    {!! myDataTable_table([
        "id"         => 'id',
        "name_ar"    => __('form.label.name ar'),
        "name_en"    => __('form.label.name en'),
        "is_free"    => __('form.label.is free'),
        "updated_at" => __('form.label.updated_at'),
        "created_at" => __('form.label.created_at'),
    ]) !!}

@endsection

@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>



        myDataTableColumns({
            name   :  ['id', 'name_ar', 'name_en','is_free', 'updated_at', 'created_at'],
            class  : {'updated_at': 'notEdit' , 'created_at': 'notEdit' },
            btn    :  {

                @can('role' , 'attribute.update')
                'edit'         : '{{route('admin.attributes.update' , '')}}'+'/{id}',
                @endcan

                @if(!$is_trash)

                    @can('role' , 'attribute.destroy')
                    'delete'       : '{{route('admin.attributes.destroy' , '')}}'+'/{id}',
                    @endcan

                @else

                    @can('role' , 'attribute.restore')
                    'restore'      : '{{route('admin.attributes.restore' , '')}}'+'/{id}',
                    @endcan

                    @can('role' , 'attribute.finalDelete')
                    'delete'       : '{{route('admin.attributes.finalDelete' , '')}}'+'/{id}',
                    @endcan

                @endif
                    @can('role' , 'attribute.show')
                    'options'      : ['{{route('admin.attributes.show','')}}'+'/{id}', '@lang('layout.options')'],
                    @endcan
                'print'        : '#',

            }
        })
    </script>
@endsection

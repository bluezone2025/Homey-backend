@extends('admin.master')

@section('breadcrumb')
    @if(!$is_trash)
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.sizes')</span></li>
    @else
        <li class="breadcrumb-item"><a href="{{route('admin.sizes.index')}}">@lang('layout.sizes')</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.trash')</span></li>
    @endif
@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button([
        __('layout.add size') => route('admin.sizes.create'),
      ]) !!}



    {!! myDataTable_table([
        "id"           => 'id',
        "name_ar"      => __('form.label.name ar'),
        "name_en"      => __('form.label.name en'),
        "attribute_id" => __('form.label.attribute'),
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

        let attribute_id = '@json($attributes)';


        myDataTableColumns({
            name   :  ['id', 'name_ar', 'name_en',  'attribute_id',  'updated_at', 'created_at'],
            class  : {'updated_at': 'notEdit' , 'created_at': 'notEdit'},
            alias  : {attribute_id},
            select : {attribute_id},
            btn    :  {

                @can('role' , 'option.update')
                'edit'         : '{{route('admin.sizes.update' , '')}}'+'/{id}',
                @endcan

                @if(!$is_trash)

                    @can('role' , 'option.destroy')
                    'delete'       : '{{route('admin.sizes.destroy' , '')}}'+'/{id}',
                    @endcan

                @else

                    @can('role' , 'option.restore')
                    'restore'      : '{{route('admin.sizes.restore' , '')}}'+'/{id}',
                    @endcan

                    @can('role' , 'option.finalDelete')
                    'delete'       : '{{route('admin.sizes.finalDelete' , '')}}'+'/{id}',
                    @endcan

                @endif
                'print'        : '#',

            }
        })
    </script>
@endsection

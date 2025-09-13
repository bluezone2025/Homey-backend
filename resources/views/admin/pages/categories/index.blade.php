@extends('admin.master')

@section('breadcrumb')
    @if(!$is_trash)
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.categories')</span></li>
    @else
        <li class="breadcrumb-item"><a href="{{route('admin.categories.index')}}">@lang('layout.categories')</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.trash')</span></li>
    @endif
@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button([
        __('layout.add category') => route('admin.categories.create'),
      ]) !!}



    {!! myDataTable_table([
        "id"         => 'id',
        "name_ar"    => __('form.label.name ar'),
        "name_en"    => __('form.label.name en'),
        "products_count" => [__('form.label.products count'), true , false],
        "parent_id"  => __('form.label.section'),
        "img"        => __('form.label.img'),
        "updated_at" => __('form.label.updated_at'),
    ]) !!}

@endsection

@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>

        let parent_id = '@json($sections)';


        myDataTableColumns({
            name   :  ['id', 'name_ar', 'name_en',   'products_count', 'parent_id', 'img',  'updated_at'],
            class  : {'updated_at': 'notEdit' , 'created_at': 'notEdit', 'products_count':'notEdit' },
            file   : {'img':'{{asset('assets/images/categories/{img}')}}'},
            alias  : {parent_id},
            select : {parent_id},
            btn    :  {

                @can('role' , 'category.update')
                'edit'         : '{{route('admin.categories.update' , '')}}'+'/{id}',
                @endcan

                @if(!$is_trash)

                    @can('role' , 'category.destroy')
                    'delete'       : '{{route('admin.categories.destroy' , '')}}'+'/{id}',
                    @endcan

                @else

                    @can('role' , 'category.restore')
                    'restore'      : '{{route('admin.categories.restore' , '')}}'+'/{id}',
                    @endcan

                    @can('role' , 'category.finalDelete')
                    'delete'       : '{{route('admin.categories.finalDelete' , '')}}'+'/{id}',
                    @endcan

                @endif
                'print'        : '#',

            }
        })
    </script>
@endsection

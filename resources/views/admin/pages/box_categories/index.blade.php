@extends('admin.master')

@section('breadcrumb')
    @if(!$is_trash)
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.categories')</span></li>
    @else
        <li class="breadcrumb-item"><a href="{{route('admin.categories.index')}}">@lang('layout.box categories')</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.trash')</span></li>
    @endif
@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button([
        __('layout.add box category') => route('admin.box-categories.create'),
      ]) !!}



    {!! myDataTable_table([
        "id"         => 'id',
        "title_ar"    => __('form.label.name ar'),
        "title_en"    => __('form.label.name en'),
        "canbm"    => __('form.label.can by multiple'),
        "updated_at" => __('form.label.updated_at'),
    ]) !!}

@endsection

@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>



        myDataTableColumns({
            name   :  ['id', 'title_ar', 'title_en', 'canbm', 'updated_at'],
            class  : {'updated_at': 'notEdit' , 'created_at': 'notEdit'},
            btn    :  {

                @can('role' , 'box_category.update')
                'edit'         : '{{route('admin.box-categories.update' , '')}}'+'/{id}',
                @endcan

                @if(!$is_trash)

                    @can('role' , 'category.destroy')
                    'delete'       : '{{route('admin.box-categories.destroy' , '')}}'+'/{id}',
                    @endcan

                @else

                    @can('role' , 'category.restore')
                    'restore'      : '{{route('admin.box-categories.restore' , '')}}'+'/{id}',
                    @endcan

                    @can('role' , 'category.finalDelete')
                    'delete'       : '{{route('admin.box-categories.finalDelete' , '')}}'+'/{id}',
                    @endcan

                @endif
                'print'        : '#',

            }
        })
    </script>
@endsection

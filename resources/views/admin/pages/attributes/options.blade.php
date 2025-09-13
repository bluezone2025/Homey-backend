@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.attributes.index')}}">@lang('layout.attributes')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.options')</span></li>
@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button([
        __('layout.add option') => route('admin.options.create'),
      ]) !!}



    {!! myDataTable_table([
        "id"           => 'id',
        "name_ar"      => __('form.label.name ar'),
        "name_en"      => __('form.label.name en'),
        "updated_at"   =>  __('form.label.updated_at'),
        "created_at"   =>  __('form.label.created_at'),
    ]) !!}

@endsection

@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>



        myDataTableColumns({
            name   :  ['id', 'name_ar', 'name_en',  'updated_at', 'created_at'],
            class  : {'updated_at': 'notEdit' , 'created_at': 'notEdit',},
            btn    :  {

                'edit'         : '{{route('admin.options.update' , '')}}'+'/{id}',
                'delete'       : '{{route('admin.options.destroy' , '')}}'+'/{id}',
                'print'        : '#',

            }
        })
    </script>
@endsection

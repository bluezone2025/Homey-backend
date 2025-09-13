@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.icons')</span></li>
@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button([
        __('layout.add icon') => route('admin.icons.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"         => 'id',
        "title"      => __('form.label.title'),
        "img"        => __('form.label.img'),
        "link"       => __('form.label.link'),
        "type"       => __('form.label.type'),
    ]) !!}

@endsection


@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>

        let type = {'icon':'@lang('form.label.type icon')', 'information':'@lang('form.label.type information')'}

        myDataTableColumns({
            name  :  ['id', 'title', 'img', 'link' , 'type'],
            class : {'updated_at': 'notEdit' , 'created_at': 'notEdit'},
            file  : {'img':'{{asset('assets/images/icons/{img}')}}'},
            alias  : {type},
            select : {type},
            btn   :  {

                @can('role' , 'icon.update')
                'edit'         : '{{route('admin.icons.update' , '')}}'+'/{id}',
                @endcan

                @can('role' , 'icon.destroy')
                'delete'       : '{{route('admin.icons.destroy' , '')}}'+'/{id}',
                @endcan

                'print'        : '#',
            }
        })
    </script>
@endsection

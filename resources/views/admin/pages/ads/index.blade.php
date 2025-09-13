@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.ads')</span></li>
@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button([
        __('layout.add ad') => route('admin.ads.create'),
      ]) !!}

    {!! myDataTable_table([
        "id"          => 'id',
        "img"         => __('form.label.img'),
        "link"        =>  __('form.label.link'),
        "in_app"      =>  __('form.label.ad src'),
        "position"    =>  __('form.label.number ad'),
    ]) !!}

@endsection


@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>

        let in_app = {'0':'@lang('form.label.out_app')', '1':'@lang('form.label.in_app')'}

        myDataTableColumns({
            name   :  ['id', 'img', 'link', 'in_app' , 'position'],
            class  : {'updated_at': 'notEdit' , 'created_at': 'notEdit'},
            input  : {'position':'number'},
            file   : {'img':'{{asset('assets/images/ads/{img}')}}'},
            alias  : {in_app},
            select : {in_app},
            btn    :  {

                @can('role' , 'ad.update')
                'edit'         : '{{route('admin.ads.update' , '')}}'+'/{id}',
                @endcan
                @can('role' , 'ad.destroy')
                'delete'       : '{{route('admin.ads.destroy' , '')}}'+'/{id}',
                @endcan
                'print'        : '#',
            }
        })
    </script>
@endsection

@extends('admin.master')


@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.settings')</span></li>
@endsection

@section('content')

    @include('admin.includes.modalBtnAction')

    {!! myDataTable_button() !!}

    {!! myDataTable_table([
        "id"          => 'id',
        "description" => __('form.label.description'),
        "value"       => __('form.label.value'),
        "updated_at"  => __('form.label.updated_at'),
    ]) !!}

@endsection


@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>

        myDataTableColumns({
            name  :  ['id', 'description', 'value', 'updated_at'],
            class : {'updated_at': 'notEdit' },
            btn   :  {

                @can('role' , 'setting.update')
                'edit' : '{{route('admin.settings.update' , '')}}'+'/{id}',
                @endcan
            }
        })
    </script>
@endsection

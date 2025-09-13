@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.roles.index')}}">@lang('form.label.role')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('form.label.distribution permissions')</span></li>
@endsection

@section('content')

    @include('admin.includes.alert_success')

    <a class="btn btn-info btnChecked selectAll mb-2 bg-dark mt-5">@lang('form.label.select all')</a>
    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title bg-danger p-2">@lang('form.label.distribution permissions of role')<span class="text-white"> ({{$role['name']}}) </span></h6>
                <div class="table-responsive">
                    @include('admin.pages.permission.form')
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(function (){

            $('.btnChecked').on('click' , function (){

                if ($(this).hasClass('selectAll')) {
                    $('input').each(function () {

                        $(this).prop('checked', true)
                    })

                    $(this).removeClass('selectAll').addClass('deSelectAll').text('@lang('form.label.deselect all')')

                }else {

                    if ($(this).hasClass('deSelectAll')) {

                        $('input').each(function () {

                            $(this).prop('checked', false)
                        })
                        $(this).addClass('selectAll').removeClass('deSelectAll').text('@lang('form.label.select all')')

                    }
                }
            })
        });


    </script>
@endsection

@section('css')
    <style>
        table .title {
            font-size: 20px;
            font-weight: bold;
            padding: 26px 0;
            background-color: #782c47;
            text-align: center;
            color: white !important;

        }

        .switch.s-outline-danger input:checked + .slider:before{

            top: 0 !important;
            right: 0 !important;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">

@endsection


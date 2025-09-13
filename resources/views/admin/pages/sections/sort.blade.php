@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.sections.index')}}">@lang('layout.sections')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.sort sections')</span></li>
@endsection

@section('content')

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                        @include('admin.includes.alert_success')

                        <div class="widget-content widget-content-area">
                            @include('admin.pages.sections.form_sort')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <link href="{{asset('assets/plugins/drag-and-drop/dragula/dragula.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/drag-and-drop/dragula/example.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('js')

    <script>
        countSections = 1
    </script>
    <script src="{{asset('assets/plugins/drag-and-drop/dragula/dragula.min.js')}}"></script>
    <script src="{{asset('assets/plugins/drag-and-drop/dragula/custom-dragula.js')}}"></script>

    <script>
    </script>
@endsection

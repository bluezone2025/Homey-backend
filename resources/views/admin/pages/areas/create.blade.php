@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.areas.index')}}">@lang('layout.areas')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.add area')</span></li>
@endsection

@section('content')
    <div class="container">

        @include('admin.includes.alert_success')

        <div class="row">
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>@lang('layout.add area')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('admin.pages.areas.form_create')
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

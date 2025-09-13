@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.countries.index')}}">@lang('layout.countries')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.add country')</span></li>
@endsection

@section('content')

        @include('admin.includes.alert_success')

        <div class="row">
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>@lang('layout.add country')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('admin.pages.countries.form_create')
                    </div>
                </div>
            </div>
        </div>
@endsection


@section('js')

    <script src="{{asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.js')}}"></script>

    <script>
        $('input').maxlength({
            threshold: 40,
        });
    </script>
@endsection

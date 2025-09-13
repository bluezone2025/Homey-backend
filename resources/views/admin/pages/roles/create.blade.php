@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.roles.index')}}">@lang('layout.roles')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.add role')</span></li>
@endsection

@section('content')

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                        @include('admin.includes.alert_success')

                        <div class="widget-content widget-content-area">
                            @include('admin.pages.roles.form_create')
                        </div>
                    </div>
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

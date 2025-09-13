@extends('student.master')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single,
        .select2-container .select2-selection--multiple {
            height: 40px;
            padding: -0.75rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered,
        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            line-height: 1.5;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(2.25rem + 2px);
            top: 50%;
            transform: translateY(-50%);
        }

        .select2-container .select2-dropdown {
            max-height: 200px !important;
            overflow-y: auto !important;
        }
    </style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.My Profile')</span></li>
@endsection

@section('content')

    <div class="col-12 mt-5">

    @include('student.includes.alert_success')

    @include('student.includes.alert_errors')

        <div class="card  shadow bg-info">
            <div class="card-header  text-black border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0 text-white">@lang('form.label.account info')</h3>
                    </div>
                </div>
            </div>
            <div class="card-body bg-light">
                @include('student.pages.profile.form_update_img')
                @include('student.pages.profile.form_update_info')
                @include('student.pages.profile.form_update_password')
                @include('student.pages.profile.form_update_price')
                @include('student.pages.profile.form_update_price_by_product')
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                allowClear: true
            });
        });
    </script>
@endsection
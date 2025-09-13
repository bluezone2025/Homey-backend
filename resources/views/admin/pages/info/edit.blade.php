@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.edit info')</span></li>
@endsection

@section('content')
    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                        @include('admin.includes.alert_success')

                        <div class="widget-content widget-content-area">
                            @include('admin.pages.info.form_update')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script>

        ClassicEditor
            .create( document.querySelector( '#description_ar' ) )
            .then( editor => {
        } )
        .catch( error => {
        } );

        ClassicEditor
            .create( document.querySelector( '#description_en' ) )
            .then( editor => {
        } )
        .catch( error => {
        } );


    </script>
    <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>

    <script>
        $('input').maxlength({
            threshold: 40,
        });
    </script>
@endsection

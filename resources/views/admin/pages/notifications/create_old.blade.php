@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.notification.index')}}">{{__('site.notifications')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>{{__('site.createnotifications')}}</span></li>
@endsection

@section('content')

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                        @include('admin.includes.alert_success')

                        <div class="widget-content widget-content-area">
                            @include('admin.pages.notifications.form_create')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('css')

    <link href="{{asset('assets/css/pages/admin/product.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">

@endsection
@section('js')
    
    <script src="{{asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.js')}}"></script>
    <script src="{{asset('assets/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
    <script src='https://cdn.tiny.cloud/1/jj3v8hawt3vfkwkos9o6imcflmz0n20feztjejosztf38fco/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>

    <script>
        lang_not_follow_option = '@lang('form.label.not follow option')'
        lang_remove_attribute = '@lang('form.label.remove attribute')'
        lang_name_option_ar = '@lang('form.label.name_option_ar')'
        lang_name_option_ar = '@lang('form.label.name_option_en')'
        lang_min_one_option = '@lang('form.label.min_one_option')'
        lang_min_one_category = '@lang('form.label.min_one_category')'
        required_value_sale = '@lang('form.label.required_value_sale')'
        required_one_option = '@lang('form.label.required_one_option')'
        required_value_attr = '@lang('form.label.required_value_attr')'
        sale_bigger_price = '@lang('form.label.sale_bigger_price')'
    </script>

    <script src="{{asset('assets/js/pages/admin/product.js')}}"></script>
   

@endsection
  
@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">المنتجات</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>اضافة منتج</span></li>
@endsection

@section('content')

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                        @include('admin.includes.alert_success')

                        <div class="widget-content widget-content-area">

                            <form method="post" action="{{route('admin.products.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row mb-4">
                                    @include('admin.pages.products.form_attribute.form')
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">اضافة منتج جديد</button>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')

    <link href="{{asset('assets/css/pages/admin/product.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('js')

    <script src="{{asset('assets/js/pages/admin/attributes.js')}}"></script>

@endsection

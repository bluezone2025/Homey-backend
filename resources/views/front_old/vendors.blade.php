@extends('layouts.layout')
@section('title', 'الفئات')
@section('content')
    <main id="content">
        <section class="py-2 bg-gray-2">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                        <li class="breadcrumb-item"><a class="text-decoration-none text-body"
                                                       href="{{ route('home') }}">@lang('site.index')</a>
                        </li>
                        <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">
                            <a class="text-decoration-none text-body"
                               href="{{ route('vendors') }}">@lang('site.categories')</a>

                        </li>
                    </ol>
                </nav>
            </div>
        </section>
        <section>
            <div class="container container-xl">
                <h4 class="mt-3 mt-lg-4 mb-lg-4">@lang('site.categories')</h4>
            </div>
        </section>
        <section class="mt-2 mt-md-0 prods prods-s fams cats">
            <div class="container container-xl">
                <div class="row mb-3">
                    @if(count($vendors) > 0)
                    @foreach($vendors as $vendor)
                    <div class="col-lg-3 col-xl-3 col-md-4 col-6 mb-3 mobile_pad "     >
                        <a href="{{ route('vendor', $vendor->id) }}">
                            <div class="card border-0 product"  style="border: none !important;"  >
                                <div class="position-relative hover-zoom-in">
                                    <img src="{{ asset('assets/images/categories/' . $vendor->img) }}">
                                </div>
                                <div class="card-body text-center px-0">

                                    <h2 class="card-title fs-15 font-weight-500"><a href="{{ route('vendor', $vendor->id) }}">  {{ $vendor->name }}</a></h2>

                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    @else
                        <div class="alert alert-light w-100 text-center" role="alert">
                            <h4>@lang('site.no_categories') </h4>
                        </div>
                    @endif

                </div>
            </div>
        </section>
    </main>
@endsection

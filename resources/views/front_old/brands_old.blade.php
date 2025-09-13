@extends('layouts.layout')
@php
    if($type==3){
       $title=trans('site.brands');
       $search_placeholder=trans('site.brand_search');
   }
   else{
           $title=trans('site.famous');
           $search_placeholder=trans('site.famous_search');
   }
@endphp
@section('title', $title)

@section('content')
    <main id="content">
        <section class="py-2 bg-gray-2">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                        <li class="breadcrumb-item"><a class="text-decoration-none  active"
                                                       href="{{ route('home') }}">@lang('site.index')</a>
                        </li>
                        <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">
                            <a class="text-decoration-none "
                               href="{{ route('brands') }}">{{$title}}</a>

                        </li>
                    </ol>
                </nav>
            </div>
        </section>
        <section>
            <div class="container container-xl">
                <h4 class="mt-3 mt-lg-4 mb-lg-4">{{$title}}</h4>
            </div>
        </section>
        @if(!isset($type))
            <section>
                <div class="container container-xl">
                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            {{--
                            <div class="dropdown show lh-1 rounded mb-lg-4" style="background-color:#f5f5f5">

                                <a href="#"
                                   class="dropdown-toggle custom-dropdown-toggle text-decoration-none text-secondary p-3 mw-210 position-relative d-block"
                                   id="dropdownMenuButton" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    الترتيب الاساسي
                                </a>
                                <div class="dropdown-menu custom-dropdown-item" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">السعر الاعلى ثم الاقل</a>
                                    <a class="dropdown-item" href="#">السعر الاقل ثم الاعلى</a>
                                    <a class="dropdown-item" href="#">مختلط</a>
                                </div>
                            </div>
                            --}}

                        </div>
                        <div class="w-50">
                            <form method="get" action="{{request()->url()}}" class="d-flex align-items-center">
                                <div class="input-group position-relative mw-270 ml-auto">
                                    <input name="search" value="{{ request()->get('search') }}"
                                           type="text" class="fam-srch form-control form-control bg-transparent border-2x " placeholder="{{$search_placeholder}}">
                                    <div class="input-group-append position-absolute pos-fixed-right-center">
                                        <button class="input-group-text bg-transparent border-0 px-0 fs-28 pr-3" type="submit">
                                            <i class="fal fa-search fs-20 font-weight-normal"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @if(isset($type) && $type==3)
            <section class="mt-2 mt-md-0 prods prods-s fams">
                <div class="container container-xl">
                    <div class="row mb-3">
                        @if(count($students) > 0)
                            @foreach($students as $student)
                                <div class="col-lg-3 col-xl-3 col-md-4 col-6 mb-3 mobile_pad"     >
                                    <a href="{{ route('brand', $student->id) }}">
                                        <div class="card border-0 product"    >

                                            <div class="position-relative hover-zoom-in">
                                                <img src="{{ asset('assets/images/student/' . $student->img) }}">
                                            </div>
                                            <div class="card-body text-center px-0 " style="padding-bottom: 1rem !important;">

                                                <h2 class="card-title fs-15 font-weight-500"><a href="{{ route('brand', $student->id) }}">  {{ $student->name }}</a></h2>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-light w-100 text-center" role="alert">
                                <h4>@lang('site.no_brands')</h4>
                            </div>
                        @endif

                    </div>
                </div>
            </section>
            {{--        <section class="pb-lg-14 pb-11">--}}
            {{--            <nav class="pt-2">--}}
            {{--                <ul class="pagination justify-content-center align-items-center mb-0 fs-16 font-weight-600" style="padding: 0px !important;">--}}
            {{--                    {{ $students->appends(request()->query())->links() }}--}}
            {{--                </ul>--}}
            {{--            </nav>--}}
            {{--        </section>--}}
        @endif
        @if(!isset($type))
            <section class="mt-2 mt-md-0 prods prods-s fams">
                <div class="container container-xl">
                    {{--<nav class="w-100">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link active w-50" id="nav-log-in-tab" data-toggle="tab" href="#nav-female" role="tab" aria-controls="nav-log-in" aria-selected="true">@lang('site.women_famous')</a>
                            <a class="nav-link w-50" id="nav-register-tab" data-toggle="tab" href="#nav-male" role="tab" aria-controls="nav-register" aria-selected="false">@lang('site.men_famous')</a>
                        </div>
                    </nav>--}}
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-female" role="tabpanel" aria-labelledby="nav-log-in-tab">
                            <div class="row mb-3">
                                @if(count($femaleBrands) > 0)
                                    @foreach($femaleBrands as $student)
                                        <div class="col-lg-3 col-xl-3 col-md-4 col-6 mb-3 mobile_pad brandImage"     >
                                            <a href="{{ route('brand', $student->id) }}">
                                                <div class="card border-0 product"    >

                                                    <div class="position-relative hover-zoom-in">
                                                        <img src="{{ asset('assets/images/student/' . $student->img) }}" class="brand_img">
                                                    </div>
                                                    <div class="card-body text-center px-0 " style="padding-bottom: 1rem !important;">

                                                        <h2 class="card-title fs-15 font-weight-500"><a href="{{ route('brand', $student->id) }}">  {{ $student->name }}</a></h2>

                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-light w-100 text-center" role="alert">
                                        <h4>@lang('site.no_famous')</h4>
                                    </div>
                                @endif

                            </div>
                            {{--                            <section class="pb-lg-14 pb-11">--}}
                            {{--                                <nav class="pt-2">--}}
                            {{--                                    <ul class="pagination justify-content-center align-items-center mb-0 fs-16 font-weight-600" style="padding: 0px !important;">--}}
                            {{--                                        {{ $femaleBrands->appends(request()->query())->links() }}--}}
                            {{--                                    </ul>--}}
                            {{--                                </nav>--}}
                            {{--                            </section>--}}
                        </div>

                        <div class="tab-pane fade" id="nav-male" role="tabpanel" aria-labelledby="nav-log-in-tab">
                            <div class="row mb-3">
                                @if(count($maleBrands) > 0)
                                    @foreach($maleBrands as $student)
                                        <div class="col-lg-3 col-xl-3 col-md-4 col-6 mb-3 mobile_pad"     >
                                            <a href="{{ route('brand', $student->id) }}">
                                                <div class="card border-0 product"    >

                                                    <div class="position-relative hover-zoom-in">
                                                        <img src="{{ asset('assets/images/student/' . $student->img) }}">
                                                    </div>
                                                    <div class="card-body text-center px-0" style="padding-bottom: 1rem !important;">

                                                        <h2 class="card-title fs-15 font-weight-500"><a href="{{ route('brand', $student->id) }}">  {{ $student->name }}</a></h2>

                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-light w-100 text-center" role="alert">
                                        <h4>@lang('site.no_famous')</h4>
                                    </div>
                                @endif

                            </div>
                            {{--                            <section class="pb-lg-14 pb-11">--}}
                            {{--                                <nav class="pt-2">--}}
                            {{--                                    <ul class="pagination justify-content-center align-items-center mb-0 fs-16 font-weight-600" style="padding: 0px !important;">--}}
                            {{--                                        {{ $maleBrands->appends(request()->query())->links() }}--}}
                            {{--                                    </ul>--}}
                            {{--                                </nav>--}}
                            {{--                            </section>--}}
                        </div>
                    </div>

                </div>
            </section>
        @endif
    </main>
@endsection

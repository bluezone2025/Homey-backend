@extends('layouts.layout2')
@section('title', 'الفئات')
@section('content')
    <section class="sec-title1">
        <div class="container">
            <div class="col-md-8 d-flex">
          <span
          ><a {{ route('home') }}">@lang('site.index')</a></span
          >
                <span class="mx-2"><b>/</b></span>
                <span><b><a href="{{ route('vendors') }}">@lang('site.categories')</a></b></span>
            </div>
        </div>
    </section>

    <section >
        <div class="container">
            <div class="row justify-content-between align-items-center pt-5">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <h3 class="text-sm-center" style="color: #AF9433;">@lang('site.categories')</h3>
                </div>
            </div>
            <div class="row py-5">
                @if(count($vendors) > 0)
                    @foreach($vendors as $vendor)
                <div class="col-md-3 col-6 mb-3 text-center">
                    <div class="categ-inner">
                        <a class="img_link" href="{{ route('vendor', $vendor->id) }}">
                            <img src="{{ asset('assets/images/categories/' . $vendor->img) }}"
                                 class="img-fluid pb-1" alt="">
                        </a>

                    </div>
                    <a href="{{ route('vendor', $vendor->id) }}">
                        {{ $vendor->name }}
                    </a>
                </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>@endsection

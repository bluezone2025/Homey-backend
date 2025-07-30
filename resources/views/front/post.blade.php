@extends('layouts.front')
@section('title')
    @lang('site.home')

@endsection
@section('content')
    <!-----start  --->
    @if (app()->getLocale() == 'en')
    @else
    @endif
    <div class="container p-0 mt-5">
            <div class="row m-auto">
                <div class="col-lg-12 col-md-12 m-auto">
                    <div class="blog-details-wrapper">
                        <div class="blog-img mb-20 text-center"><img alt="" src="{{ asset('/storage/' . $post->img1) }}">
                            {{-- <div class="blog-date"><span>                                        26                                        <br>                                        JUNE</span></div> --}}
                        </div>
                        <div class="blog-content text-dir">
                            @if (app()->getLocale() == 'en')
                            <h2>{{$post->title_en}}</h2>
                            @else
                            <h2>{{$post->title_ar}}</h2>
                            @endif
                            <div class="blog-date-categori">
                                {{-- <ul>
                                    <li><a href="#"><i class="fa fa-user"></i>Admin </a></li>
                                    <li><a href="#"><i class="ion-heart"></i>likes </a></li>
                                    <li><a href="#"><i class="fa fa-comment"></i>Comments </a></li>
                                </ul> --}}
                            </div>
                            @if (app()->getLocale() == 'en')
                            <p>{{$post->description_en}}</p>
                            @else
                            <p>{{$post->description_ar}}</p>
                            @endif
                            <div class="text-content-img mb-3">
                                <div class="row dir-rtl">
                                    <div class="col-md-8">
                                        <div class="text-single">
                                            @if (app()->getLocale() == 'en')
                                            <p>{{$post->description_en1}}</p>
                                            @else
                                            <p>{{$post->description_ar1}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="content-img"><img alt="" src="{{ asset('/storage/' . $post->img2) }}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    <!--- end  --->
@endsection

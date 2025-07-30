@extends('layouts.front')
@section('title')
    @lang('site.home')

@endsection
@section('content')
    <!-----start  --->
    <div class="container"  style="text-transform: capitalize">


        @if($page)
            @if(app()->getLocale() == 'en')
                <br>
                <h2 style="text-align: left">
                    {{$page->page_title_en}}
                </h2>
                <br>
                <p style="text-align: left">
                    {{$page->page_details_en}}
                </p>


            @else
                <br>
                <h2 style="text-align: right">
                    {{$page->page_title_ar}}
                </h2>
                <br>

                <br>
                <p style="text-align: right">
                    {{$page->page_details_ar}}
                </p>
            @endif
        @else

            <h3>
                No Data Found
            </h3>

        @endif

    </div>



{{--    <!--- end  --->--}}
{{--    <footer class="container-fluid">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-4">--}}
{{--                    <h5>CURRENCY SWITCHER--}}
{{--                    </h5>--}}
{{--                    <div id="accordion1" >--}}
{{--                        <div class=" border-bottom" >--}}
{{--                            <div class="card-header border-bottom pad-0 " id="headingOne" >--}}
{{--                                <h5 class="mb-0">--}}
{{--                                    <button class="btn  w-100 text-right nav-link bg-light" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">--}}
{{--                                        @lang('site.kwd')--}}
{{--                                        <span class="float-left">  <i class="fas fa-chevron-down "></i></span>--}}
{{--                                    </button>--}}
{{--                                </h5>--}}
{{--                            </div>--}}

{{--                            <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion1">--}}
{{--                                <ul class="list-group">--}}
{{--                                    <li class="list-group-item"> <a href="">@lang('site.kwd')</a></li>--}}
{{--                                    <li class="list-group-item"><a href="">@lang('site.kwd')</a></li>--}}

{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <h5>CONTACT US</h5>--}}
{{--                    <p>Whatsapp:   <a href=""> (+965) 96755704</a>--}}
{{--                    </p>--}}
{{--                    <p>Instagram:   <a href=""> abaya</a>--}}
{{--                    </p>--}}
{{--                    <p>Address:   <a href=""> kuwait </a>--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <h5>LOCATION--}}
{{--                    </h5>--}}
{{--                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1781287.9077480363!2d48.65696112404058!3d29.30938918651801!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3fc5363fbeea51a1%3A0x74726bcd92d8edd2!2z2KfZhNmD2YjZitiq4oCO!5e0!3m2!1sar!2seg!4v1585667151145!5m2!1sar!2seg" width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}

@endsection

@extends('layouts.layout2')
@section('title', 'نتائج البحث')
@section('track')
    fbq('track', 'Search');
@endsection
@section('style')
    <style>
        .pagination{
            display: flex !important;
            flex-wrap: wrap;
        }
        .page-item{
            margin: 1rem !important;
        }
    </style>

@endsection
@section('content')


    <section class="sec-title1">
        <div class="container">
            <div class="col-md-8 d-flex">
                <span><a href="{{ route('home') }}">@lang('site.index')</a></span>


                <span class="mx-2"><b>/</b></span>
                <b><span>@lang('site.Search results')</span></b>
            </div>
        </div>
    </section>
    @if(count($students) > 0)
    <section class="py-5">
        <div class="container">
            <h4 class="text-center">@lang('site.brands')</h4>


                <div class="row brand-inner mt-5">

                    @foreach($students as $student)
                        <div class="col-md-3 col-6">
                            <div class="brand position-relative">
                                <img src="{{ asset('assets/images/student/' . $student->img) }}" class="brand-img img-fluid" alt="">
                                <a href="{{ route('brand', $student->id) }}" class="brand-desc btn btn-black">
                                    {{ $student->name }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>


        </div>
    </section>
    @endif


    @if(count($populars) > 0)

        <section class="py-5">
            <div class="container">
                <h4 class="text-center">@lang('site.products')</h4>
               <div class="row brand-parent mt-5" id="post-data">
                   @include('front.partials.products_items', ['populars' => $populars])
                </div>

                <div id="loader" style="display: none; text-align: center">
                    <img src="{{ asset('new_design/images/loader.gif') }}" alt="Loading..." width="60" height="60"/>
                </div>
            </div>
        </section>

    
    @else
        <section class="py-5">
            <div class="container">
                <div class="row  brand-parent mt-5">
                    <div class="col-12 justify-content-center d-flex">
                        <h4 class="text-center">{{ __('site.notproducthere') }}</h4>

                    </div>
                </div>
            </div>
        </section>

    @endif



@stop
@section('js')
<script>
    let page = 2;
    let loading = false;
    let lastPageReached = false;

    function loadMoreData() {
        if (loading || lastPageReached) return;

        loading = true;

       

        $.ajax({
            url: '?page=' + page,
            type: "GET",
            dataType: "json",
            beforeSend: function () {
                $('#loader').show();
            },
            success: function (response) {
                if (!response.html || response.html.trim() === "") {
                    lastPageReached = true;
                    $('#loader').hide();
                    return;
                }

                $('#post-data').append(response.html);
                $('#loader').hide();
                loading = false;

                if (response.current_page >= response.last_page) {
                    lastPageReached = true;
                } else {
                    page++;
                }
            },
            error: function () {
                console.error("Error loading more data");
                $('#loader').hide();
                loading = false;
            }
        });
    }

    // Scroll Trigger
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 200) {
            loadMoreData();
        }
    });
</script>

@endsection


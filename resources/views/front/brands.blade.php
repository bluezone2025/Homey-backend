@extends('layouts.layout2')
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
                <b><span> <a href="{{ route('brands') }}">{{$title}}</a></span></b>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <input type="hidden" name="type" value="{{ request('type') }}">
            <input type="hidden" name="search" value="{{ request('search') }}">

                @if(count($students) > 0)
                     <div class="row brand-inner mt-5" id="post-data">
                        @include('front.partials.brands_items', ['students' => $students])
                    </div>

                    <div id="loader" style="display: none; text-align: center">
                        <img src="{{ asset('new_design/images/loader.gif') }}" alt="Loading..." width="60" height="60"/>
                    </div>

                @endif
        </div>
    </section>
  {{--   <section class="">
        <nav class="pt-2">
            <ul class="pagination justify-content-center align-items-center font-weight-600" style="padding: 0px !important;">
                {{ $students->appends(request()->query())->links() }}
            </ul>
        </nav>
    </section> --}}
@endsection

@section('js')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 --}}
<script>
let page = 2;
let loading = false;
let lastPageReached = false;

function loadMoreData() {
    if (loading || lastPageReached) return;
    loading = true;

    const type = $('input[name="type"]').val(); // أو من select أو من URL
    const search = $('input[name="search"]').val();

    $.ajax({
        url: '?page=' + page + '&type=' + encodeURIComponent(type || '') + '&search=' + encodeURIComponent(search || ''),
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            $('#loader').show();
        },
        success: function (response) {
            console.log(response);

            if (response.html.trim() === "") {
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


$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
        loadMoreData();
    }
});
</script>



@endsection
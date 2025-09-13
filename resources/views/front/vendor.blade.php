@extends('layouts.layout2')
@section('title', $records->name)

@section('style')


@endsection
@section('content')


    <section class="sec-title1">
        <div class="container">
            <div class="col-md-8 d-flex">
          <span
          ><a href="{{ route('home') }}">@lang('site.index')</a></span
          >
                <span class="mx-2"><b>/</b></span>
                <b><span>{{ $records->name }}</span></b>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row justify-content-between align-items-center pt-5">
                <div class="col-sm-6 mb-3 mb-sm-0 col-12">
                    <h3 class="text-sm-center" style="color: #AF9433;">
                        <span>
                              {{ $populars->total() }}
                        </span>
                        <span class="mx-1">
                              @lang('site.product')
                        </span>
                    </h3>
                </div>
                <div class="col-sm-6 text-sm-center text-sm-right ">
                            <input type="hidden" id="currentSort" value="{{ request('sort') }}">

                    <select name="sort_type" id="selectSort">
                        <option value="default"  data-sort="default" disabled @if($sort=='default') selected @endif>{{ __('site.sort_by') }}</option>
                        <option value="oldest"  data-sort="oldest"  @if($sort=='oldest') selected @endif>{{ __('site.oldest') }}</option>
                        <option value="newest"  data-sort="newest"  @if($sort=='newest') selected @endif>{{ __('site.newest') }}</option>
                        <option value="highest_price" data-sort="highest_price"  @if($sort=='highest_price') selected @endif>{{ __('site.Highest price then lowest') }}</option>
                        <option value="lowest_price" data-sort="lowest_price"  @if($sort=='lowest_price') selected @endif>{{ __('site.Lowest price then highest') }}</option>
                    
                    </select>
                </div>
            </div>
             <div class="row brand-parent mt-5" id="post-data">
            @include('front.partials.products_items', ['populars' => $populars])
        </div>

        <div id="loader" style="display: none; text-align: center">
            <img src="{{ asset('new_design/images/loader.gif') }}" alt="Loading..." width="60" height="60"/>
        </div>
        </div>
    </section>

@stop
@section('js')
<script>
    let page = 2;
    let loading = false;
    let lastPageReached = false;

    function loadMoreData() {
        if (loading || lastPageReached) return;

        loading = true;

        const sort = document.getElementById('currentSort').value || '';

        $.ajax({
            url: '?page=' + page + '&sort=' + encodeURIComponent(sort),
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


 <script>
  $(document).ready(function () {
    $('#selectSort').on('change', function (e) {
      e.preventDefault();

      const sortOption = $(this).val();
      const url = new URL(window.location.href);

      // تحديث أو إضافة باراميتر sort
      url.searchParams.set('sort', sortOption);    

      // إعادة التوجيه إلى الرابط الجديد مع الباراميترات الصحيحة
      window.location.href = url.toString();
    });
  });
</script>

@endsection


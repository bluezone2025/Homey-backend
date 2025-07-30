@extends('dashboard.layouts.app')
@section('page_title')    @lang('site.news_edit')

 @endsection

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('news.update.news' , $news->id)}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card-body">

            <div class="form-group">
                <label for="content_ar">

                    @lang('site.news_ar')

                </label>
                <input value="{{ $news->content_ar }}"  type="text" name="content_ar"
                       class="form-control @error('content_ar') is-invalid @enderror" id="content_ar">
            </div>

            <div class="form-group">
                <label for="content_en">

                    @lang('site.news_en')

                </label>
                <input  value="{{ $news->content_en }}"   type="text" name="content_en"
                       class="form-control @error('content_en') is-invalid @enderror" id="content_en">
            </div>


            <div class="form-group ">
                <div class="col-md-6 ">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="appearance" value="1" id="appearance"
                        @if($news->appearance == 1 )  {{ "checked" }} @endif

                        >

                        <label class="form-check-label" for="appearance">
                            @lang('site.appear')
                        </label>
                    </div>
                </div>
            </div>



        </div>

            <button type="submit" class="btn btn-primary">
                @lang('site.save')
            </button>

    </form>
@endsection

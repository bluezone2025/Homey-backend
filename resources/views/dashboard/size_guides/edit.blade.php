@extends('dashboard.layouts.app')

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('size_guides.update.size_guide' , $cat->id)}}"
          method="post" enctype="multipart/form-data">
        @csrf
{{--        {{ csrf_field() }}--}}
{{--        {{ method_field("PUT") }}--}}
{{--        <input type="hidden" name="_method" value="PUT">--}}

        <div class="card-header" style="display: flex;justify-content: space-between;align-items: center">
            <h3 >
               @lang('site.edit_size_guide'):
                {{$cat->name_ar}}  -  {{$cat->name_en}}
            </h3>
        </div>
        <div class="card-body">

            <div class="form-group">
                <label for="name_ar">

                    @lang('site.name_arabic'):

                </label>
                <input value="{{ $cat->name_ar }}"  type="text" name="name_ar"
                       class="form-control @error('name_ar') is-invalid @enderror" id="name_ar">
            </div>

            <div class="form-group">
                <label for="name_en">

                    @lang('site.name_english'):

                </label>
                <input value="{{ $cat->name_en }}"  type="text" name="name_en"
                       class="form-control @error('name_en') is-invalid @enderror" id="name_en">
            </div>


            <div class="form-group">
                <label for="image_url">

                    @lang('site.img'):
                </label>
                <input type="file" name="image_url"
                       class="@error('image_url') is-invalid @enderror form-control" id="image_url">
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                @lang('site.save'):
            </button>

        </div>
    </form>
@endsection

@extends('dashboard.layouts.app')

@section('page_title')  @lang('اضافه بانر')  @endsection


@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('sliders.store')}}" method="post" enctype="multipart/form-data">
        @csrf


        <div class="card-body">

            <div class="form-group">
                <label for="name_ar">

        @lang('site.name_arabic')
                </label>
                <input value="{{ old('name_ar') }}"  type="text" name="name_ar"
                       class="form-control @error('name_ar') is-invalid @enderror" id="name_ar">
            </div>


            <div class="form-group">
                <label for="name_en">

                    @lang('site.name_english')
                </label>
                <input value="{{ old('name_en') }}"  type="text" name="name_en"
                       class="form-control @error('name_en') is-invalid @enderror" id="name_en">
            </div>


            <div class="form-group">
                <label for="name">

                    @lang('site.description_ar')
                </label>
                <textarea name="description_ar" class="form-control @error('description_ar') is-invalid @enderror" id="description_ar">{{ old('description_ar') }}</textarea>
            </div>


            <div class="form-group">
                <label for="name">

                    @lang('site.description_en')
                </label>
                <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" id="description_ar">{{ old('description_en') }}</textarea>

            </div>

            <div class="form-group">
                <label for="photo">

                    @lang('site.img')

                </label>
                <input type="file" name="photo"
                       class="form-control">
            </div>


            <div class="form-group">
                <label for="photo">

                    @lang('site.app_img')

                </label>
                <input type="file" name="app_photo"
                       class="form-control">
            </div>




        </div>

            <button type="submit" class="btn btn-primary">
                @lang('site.save')
            </button>
       
    </form>
@endsection

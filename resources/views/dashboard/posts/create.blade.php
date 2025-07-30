@extends('dashboard.layouts.app')
@section('page_title')  Add Post  @endsection

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card-body">

            <div class="form-group">
                <label for="title_ar">

                    @lang('site.title_ar')

                </label>
                <input value="{{ old('title_ar') }}"  type="text" name="title_ar"
                       class="form-control @error('title_ar') is-invalid @enderror" id="title_ar">
            </div>

            <div class="form-group">
                <label for="title_en">

                    @lang('site.title_en')

                </label>
                <input value="{{ old('title_en') }}"  type="text" name="title_en"
                       class="form-control @error('title_en') is-invalid @enderror" id="title_en">
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
                <label for="name">

                    @lang('site.description_ar1')
                </label>
                <textarea name="description_ar1" class="form-control @error('description_ar1') is-invalid @enderror" id="description_ar1">{{ old('description_ar1') }}</textarea>
            </div>


            <div class="form-group">
                <label for="name">

                    @lang('site.description_en1')
                </label>
                <textarea name="description_en1" class="form-control @error('description_en1') is-invalid @enderror" id="description_ar">{{ old('description_en1') }}</textarea>

            </div>


            <div class="form-group">
                <label for="img1">
                    @lang('site.img')


                </label>
                <input value="{{ old('img1') }}"  type="file" name="img1"
                       class="@error('img1') is-invalid @enderror form-control" id="img1">
            </div>
            <div class="form-group">
                <label for="img2">
                    @lang('site.img')


                </label>
                <input value="{{ old('img2') }}"  type="file" name="img2"
                       class="@error('img2') is-invalid @enderror form-control" id="img2">
            </div>


        </div>

            <button type="submit" class="btn btn-primary">
                @lang('site.save')

            </button>

    </form>
@endsection

@extends('dashboard.layouts.app')

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('categories.update.category' , $category->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-header" style="display: flex;justify-content: space-between;align-items: center">
            <h3 >
                : @lang('site.edit_cat')
                {{$category->name_ar}}  -  {{$category->name_en}}
            </h3>
            {{--            <button class="btn btn-light" >--}}
            {{--                <i class="fas fa-phone-alt"></i>--}}
            {{--                {{Auth::user()->phone}}--}}
            {{--            </button>--}}
        </div>

        <div class="card-body">

            <div class="form-group">
                <label for="name_ar">

                    @lang('site.cat_arabic')
                </label>
                <input value="{{ $category->name_ar }}"  type="text" name="name_ar"
                       class="form-control @error('name_ar') is-invalid @enderror" id="name_ar">
            </div>

            <div class="form-group">
                <label for="name_en">

                    @lang('site.cat_english')

                </label>
                <input  value="{{ $category->name_en }}"   type="text" name="name_en"
                        class="form-control @error('name_en') is-invalid @enderror" id="name_en">
            </div>


            <div class="form-group">
                <label for="currency_id">
                    @lang('site.basic_cat')
</label>

                <select name="basic_category_id"    class="form-control @error('basic_category_id') is-invalid @enderror" id="basic_category_id">
                    @foreach($basic_categories as $basic_category)


                        @if($category->basic_category_id == $basic_category->id)

                            <option value="{{$basic_category->id}}" selected>
                                {{$basic_category->name_en}}&nbsp; - &nbsp; {{$basic_category->name_ar}}
                            </option>

                        @else
                            <option value="{{$basic_category->id}}" >
                                {{$basic_category->name_en}}&nbsp; - &nbsp; {{$basic_category->name_ar}}
                            </option>
                        @endif


                    @endforeach
                </select>
            </div>


        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                @lang('site.savex')

            </button>
        </div>
    </form>
@endsection

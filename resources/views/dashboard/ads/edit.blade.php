@extends('dashboard.layouts.app')
@section('style')
    <style>
        #product,#category,#brand{
            display: none;
        }
    </style>
@endsection

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('ads.update.ad' , $ad->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-header" style="display: flex;justify-content: space-between;align-items: center">
            <h3 >
                : @lang('site.edit_ad')
            </h3>
            {{--            <button class="btn btn-light" >--}}
            {{--                <i class="fas fa-phone-alt"></i>--}}
            {{--                {{Auth::user()->phone}}--}}
            {{--            </button>--}}
        </div>

        <div class="card-body">
             @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group" >
                <label for="type">

                    @lang('site.type')

                </label>
                <select name="type"
                        class="form-control @error('type') is-invalid @enderror" id="type">
                    <option disabled selected>@lang('site.select_type')</option>
                    <option value="brand" {{ old('type', $ad->type) == 'brand' ? 'selected' : '' }}>@lang('site.brand')</option>
                    <option value="product" {{ old('type', $ad->type) == 'product' ? 'selected' : '' }}>@lang('site.product')</option>
                    <option value="category" {{ old('type', $ad->type) == 'category' ? 'selected' : '' }}>@lang('site.category')</option>

                </select>

            </div>


            <div class="form-group" id="category" @if($ad->type=="category") style="display: block" @endif>
                <label for="category_id">

                    @lang('site.category')

                </label>
                <select name="category_id"
                        class="form-control @error('category_id') is-invalid @enderror" id="category_id">
                    @foreach($basic_categories as $basic_category)


                        <option value="{{$basic_category->id}}" {{ old('category_id', $ad->category_id) == $basic_category->id ? 'selected' : '' }}>{{ $basic_category->{'name_'.app()->getLocale()} }}</option>



                    @endforeach
                </select>

            </div>

            <div class="form-group" id="product" @if($ad->type=="product") style="display: block" @endif>
                <label for="product_id">

                    @lang('site.product')

                </label>
                <select name="product_id"
                        class="form-control @error('product_id') is-invalid @enderror" id="product_id">
                    @foreach($products as $product)

                        <option value="{{$product->id}}" {{ old('product_id', $ad->product_id) == $product->id ? 'selected' : '' }}>{{ $product->{'title_'.app()->getLocale()}  }}</option>

                    @endforeach
                </select>

            </div>
            <div class="form-group" id="brand" @if($ad->type=="brand") style="display: block" @endif>
                <label for="brand_id">

                    @lang('site.brand')

                </label>
                <select name="brand_id"
                        class="form-control @error('brand_id') is-invalid @enderror" id="brand_id">
                    @foreach($brands as $brand)


                        <option value="{{$brand->id}}" {{ old('brand_id', $ad->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->{'name_'.app()->getLocale()}  }}</option>



                    @endforeach
                </select>

            </div>
             <div class="form-group" >
                <label for="position">

                    @lang('site.position')

                </label>
                <select name="position"
                        class="form-control @error('position') is-invalid @enderror" id="position">
                    <option value="1" {{ old('type', $ad->position) == '1' ? 'selected' : '' }} >1</option>
                    <option value="2" {{ old('type', $ad->position) == '2' ? 'selected' : '' }}>2</option>
                </select>

            </div>
            <div class="form-group" >
                <label for="sort">

                    @lang('site.Order of appearance')

                </label>
              
                <input value="{{$ad->sort}}" type="number" name="sort"
                        class="form-control @error('sort') is-invalid @enderror" id="sort">
            </div>

            <div class="form-group">
                <label for="image">

                    @lang('site.image')
                </label>
                <input value="{{ old('image') }}"  type="file" name="image"
                       class="@error('image') is-invalid @enderror form-control" id="image">
            </div>




        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                @lang('site.save')

            </button>
        </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
          $('#type').on('change',function () {
          var product=document.getElementById("product");
          var main_category=document.getElementById("category");
          var brand=document.getElementById("brand");

          if($(this).val()=="product")
          {
                main_category.style.display = "none";
                product.style.display = "block";
                product.setAttribute("required", "");
                brand.style.display = "none";
          }
          else if($(this).val()=="category")
          {
                main_category.style.display = "block";
                main_category.setAttribute("required", "");
                product.style.display = "none";
                brand.style.display = "none";
          }
          else
          {
              main_category.style.display = "none";
              product.style.display = "none";
              brand.style.display = "block";
              brand.setAttribute("required", "");

          }
        });
    </script>
@endsection

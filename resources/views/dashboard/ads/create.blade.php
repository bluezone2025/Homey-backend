@extends('dashboard.layouts.app')
@section('style')
    <style>
        #product,#category,#brand{
            display: none;
        }
    </style>
@endsection

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('ads.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-header" style="display: flex;justify-content: space-between;align-items: center">
            <h3 >
                @lang('site.add_ad')
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
                    <option value="brand">@lang('site.brand')</option>
                    <option value="product" >@lang('site.product')</option>
                    <option value="category" >@lang('site.category')</option>
                </select>

            </div>


            <div class="form-group" id="category">
                <label for="category_id">

                    @lang('site.category')

                </label>
                <select name="category_id"
                        class="form-control @error('category_id') is-invalid @enderror" id="category_id">
                    @foreach($basic_categories as $basic_category)


                        <option value="{{$basic_category->id}}">
                            {{$basic_category->{'name_'.app()->getLocale()} }}
                        </option>


                    @endforeach
                </select>

            </div>

            <div class="form-group" id="product">
                <label for="product_id">

                    @lang('site.product')

                </label>
                <select name="product_id"
                        class="form-control @error('product_id') is-invalid @enderror" id="product_id">
                    @foreach($products as $product)


                        <option value="{{$product->id}}">
                            {{$product->{'title_'.app()->getLocale()} }}
                        </option>


                    @endforeach
                </select>

            </div>
            <div class="form-group" id="brand">
                <label for="brand_id">

                    @lang('site.brand')

                </label>
                <select name="brand_id"
                        class="form-control @error('brand_id') is-invalid @enderror" id="brand_id">
                    @foreach($brands as $brand)


                        <option value="{{$brand->id}}">
                            {{$brand->{'name_'.app()->getLocale()} }}
                        </option>


                    @endforeach
                </select>

            </div>

              <div class="form-group" >
                <label for="position">

                    @lang('site.position')

                </label>
                <select name="position" required
                        class="form-control @error('position') is-invalid @enderror" id="position">
                    <option value="1">1</option>
                    <option value="2" >2</option>
                </select>

            </div>
            <div class="form-group" >
                <label for="sort">

                    @lang('site.Order of appearance')

                </label>
              
                <input value="{{ old('sort') }}" type="number" name="sort" required
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

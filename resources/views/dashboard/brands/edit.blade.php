@extends('dashboard.layouts.app')

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('brands.update.brand' , $brand->id)}}"
          method="post" enctype="multipart/form-data">
        @csrf
{{--        {{ csrf_field() }}--}}
{{--        {{ method_field("PUT") }}--}}
{{--        <input type="hidden" name="_method" value="PUT">--}}

        <div class="card-header" style="display: flex;justify-content: space-between;align-items: center">
            <h3 >
               @lang('site.edit_brand'):
                {{$brand->name_ar}}  -  {{$brand->name_en}}
            </h3>
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

            <div class="form-group">
                <label for="name_ar">

                    @lang('site.brand_arabic'):

                </label>
                <input value="{{ $brand->name_ar }}"  type="text" name="name_ar" required
                       class="form-control @error('name_ar') is-invalid @enderror" id="name_ar">
            </div>

            <div class="form-group">
                <label for="name_en">

                    @lang('site.brand_english'):

                </label>
                <input value="{{ $brand->name_en }}"  type="text" name="name_en" required
                       class="form-control @error('name_en') is-invalid @enderror" id="name_en">
            </div>
            <div class="form-group">
                <label for="email">

                    @lang('site.email'):

                </label>
                <input value="{{$brand->email}}"  type="email" name="email" required
                       class="form-control @error('email') is-invalid @enderror" id="email">
            </div>

            <div class="form-group">
                <label for="phone">

                    @lang('site.phone'):

                </label>
                <input value="{{ $brand->phone}}"  type="text" name="phone" required
                       class="form-control @error('phone') is-invalid @enderror" id="phone">
            </div>

            <div class="form-group">
                <label for="arkan_percentage">

                    @lang('site.arkan_percentage'):

                </label>
                <input value="{{ $brand->arkan_percentage }}"  type="text" name="arkan_percentage" required
                       class="form-control @error('arkan_percentage') is-invalid @enderror" id="arkan_percentage">
            </div>

            <div class="form-group">
                <label for="brand_percentage">

                    @lang('site.brand_percentage'):

                </label>
                <input value="{{ $brand->brand_percentage }}"  type="text" name="brand_percentage" required
                       class="form-control @error('brand_percentage') is-invalid @enderror" id="brand_percentage">
            </div>

            <div class="form-group">
                <label for="products_count">

                    @lang('site.products_count'):

                </label>
                <input value="{{ $brand->products_count }}"  type="number" name="products_count" required
                       class="form-control @error('products_count') is-invalid @enderror" id="products_count">
            </div>

            <div class="form-group ">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="has_discount" value="1" id="has_discount"
                    @if ($brand->has_discount == 1)  {{ 'checked' }} @endif>

                    <label class="form-check-label" for="has_discount">
                        @lang('site.has_discount')
                    </label>
                </div>
            </div>

                <div  id="discount_percentage_div">
                     <div class="form-group">

                            <label  for="discount_type">
                                @lang('site.discount_type')
                            </label>
                            <select name="discount_type"
                                class="form-control @error('discount_type') is-invalid @enderror" id="discount_type">
                                <!-----------<option disabled selected>@lang('site.select_discount_type')</option>--->
                                <option value="percentage" @if($brand->discount_type=="percentage")  selected @endif>@lang('site.discount_percentage')</option>
                                <option value="range" @if($brand->discount_type=="range")  selected @endif>@lang('site.discount_range')</option>
                           </select>
                     </div>
                    <div id="percentage_type">
                            <div class="form-group">

                                <label  for="discount_percentage">
                                    @lang('site.discount_percentage')
                                </label>


                                <input value="{{$brand->discount_percentage}}"  type="number" name="discount_percentage"
                                    class="form-control @error('discount_percentage') is-invalid @enderror" id="discount_percentage">


                            </div>
                    </div>
                    <div id="range_type">



                            <div class="form-group">

                                <label  for="start_discount_range">
                                    @lang('site.start_discount_range')
                                </label>


                                <input value="{{$brand->start_discount_range}}"  type="text" name="start_discount_range"
                                    class="form-control @error('start_discount_range') is-invalid @enderror" id="start_discount_range">


                            </div>

                            <div class="form-group">

                                <label  for="end_discount_range">
                                    @lang('site.end_discount_range')
                                </label>


                                <input value="{{$brand->end_discount_range}}"  type="text" name="end_discount_range"
                                    class="form-control @error('end_discount_range') is-invalid @enderror" id="end_discount_range">


                            </div>
                    </div>
                </div>


            <div class="form-group">
                <label for="logo">

                    @lang('site.brand_logo'):
                </label>
                <input type="file" name="logo"
                       class="@error('logo') is-invalid @enderror form-control" id="logo">
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                @lang('site.save'):
            </button>

        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).on('click', '#has_discount', function () {
            console.log('click');
            var discount_type=document.getElementById("discount_type");
            var percentage=document.getElementById("percentage_type");
            var discount_percentage=document.getElementById("discount_percentage");


            if ($(this).is(':checked')) {
                $('#discount_percentage_div').css('display', 'block');
                    discount_type.setAttribute("required", "");
                    discount_type.required = true; // Add
                    percentage.style.display = "block";
                    discount_percentage.setAttribute("required", "");


            } else {
                $('#discount_percentage_div').css('display', 'none');
                    discount_type.removeAttribute("required");
                    percentage.style.display = "none";
                    discount_percentage.removeAttribute("required");

            }
        });


         // when page is ready
        $(document).ready(function() {

            $(function() {
                if ($('#has_discount').is(':checked')) {
                    
                    $('#discount_percentage_div').css('display', 'block');
                } else {
                    $('#discount_percentage_div').css('display', 'none');

                }

            });


              $(function() {
                var percentage=document.getElementById("percentage_type");

          var discount_percentage=document.getElementById("discount_percentage");
          var range=document.getElementById("range_type");
          var end_discount_range=document.getElementById("end_discount_range");
          var start_discount_range=document.getElementById("start_discount_range");

          if($('#discount_type').val()=="percentage")
          {
                range.style.display = "none";
                percentage.style.display = "block";
                discount_percentage.setAttribute("required", "");
                end_discount_range.removeAttribute("required");
                start_discount_range.removeAttribute("required");

          }
        
          else
          {
              percentage.style.display = "none";
              range.style.display = "block";
              end_discount_range.setAttribute("required", "");
              start_discount_range.setAttribute("required", "");
              discount_percentage.removeAttribute("required");
          }

            });
        })

    </script>


 <script>
          $('#discount_type').on('change',function () {
          var percentage=document.getElementById("percentage_type");

          var discount_percentage=document.getElementById("discount_percentage");
          var range=document.getElementById("range_type");
          var end_discount_range=document.getElementById("end_discount_range");
          var start_discount_range=document.getElementById("start_discount_range");

          if($(this).val()=="percentage")
          {
                range.style.display = "none";
                percentage.style.display = "block";
                discount_percentage.setAttribute("required", "");
                end_discount_range.removeAttribute("required");
                start_discount_range.removeAttribute("required");

          }
        
          else
          {
              percentage.style.display = "none";
              range.style.display = "block";
              end_discount_range.setAttribute("required", "");
              start_discount_range.setAttribute("required", "");
              discount_percentage.removeAttribute("required");
          }
        });
    </script>
@endsection

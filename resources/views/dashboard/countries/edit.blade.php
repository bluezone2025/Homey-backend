@extends('dashboard.layouts.app')
@section('page_title')   : @lang('site.country_edit')

{{$country->name_ar}}  -  {{$country->name_en}}  @endsection

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('countries.update.country' , $country->id)}}" method="post" enctype="multipart/form-data">
        @csrf

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

                    @lang('site.country_ar')

                </label>
                <input value="{{ $country->name_ar }}"  type="text" name="name_ar"
                       class="form-control @error('name_ar') is-invalid @enderror" id="name_ar">
            </div>

            <div class="form-group">
                <label for="name_en">

                    @lang('site.country_en')

                </label>
                <input  value="{{ $country->name_en }}"   type="text" name="name_en"
                       class="form-control @error('name_en') is-invalid @enderror" id="name_en">
            </div>


            <div class="form-group">
                <label for="country_code">

                    @lang('site.country_ap_en')

                </label>
                <input  value="{{ $country->country_code }}"   type="text" name="country_code"
                       class="form-control @error('country_code') is-invalid @enderror" id="country_code">
            </div>

            <div class="form-group">
                    <label for="country_code_ar">
                        @lang('site.country_ap_ar')



                    </label>
                    <input value="{{ $country->country_code_ar }}"  type="text" name="country_code_ar"
                           class="form-control @error('country_code_ar') is-invalid @enderror" id="country_code_ar">
                </div>



                <div class="form-group">
                <label for="code">

                    @lang('site.country_code')   [ Like 00965 ]


                </label>
                <input  value="{{ $country->code }}"   type="number" name="code"
                       class="form-control @error('code') is-invalid @enderror" id="code">
            </div>




{{--            <div class="form-group">--}}
{{--                <label for="delivery">--}}
{{--                    @lang('site.ship_cost')--}}
{{--                </label>--}}
{{--                <input  value="{{ $country->delivery }}"  type="number" name="delivery"--}}
{{--                       class="form-control @error('delivery') is-invalid @enderror" id="delivery">--}}
{{--            </div>--}}



            <div class="form-group">
                <label for="currency_id">
                    @lang('site.currency')
                </label>

                <select name="currency_id"    class="form-control @error('currency_id') is-invalid @enderror" id="currency_id">
                    @foreach($currencies as $currency)


                        @if($country->currency_id == $currency->id)

                        <option value="{{$currency->id}}" selected>
                            {{$currency->name}}
                        </option>

                        @else
                            <option value="{{$currency->id}}" >
                                {{$currency->name}}
                            </option>
                        @endif


                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="image_url">

                    @lang('site.flag_img')
                </label>
                <input value="{{ old('image_url') }}"  type="file" name="image_url"
                       class="@error('image_url') is-invalid @enderror form-control" id="image_url">
            </div>



        </div>

            <button type="submit" class="btn btn-primary">
                @lang('site.save')
            </button>

    </form>
@endsection

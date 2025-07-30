@extends('dashboard.layouts.app')
@section('page_title')  @lang('site.city_edit') :

{{$city->name_ar}}  -  {{$city->name_en}} @endsection

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('cities.update.city' , $city->id)}}" method="post" enctype="multipart/form-data">
        @csrf


        <div class="card-body">

            <div class="form-group">
                <label for="name_ar">

                    @lang('site.city_ar')

                </label>
                <input value="{{ $city->name_ar}}"  type="text" name="name_ar"
                       class="form-control @error('name_ar') is-invalid @enderror" id="name_ar">
            </div>

            <div class="form-group">
                <label for="name_en">

                    @lang('site.city_en')

                </label>
                <input value="{{ $city->name_en}}"  type="text" name="name_en"
                       class="form-control @error('name_en') is-invalid @enderror" id="name_en">
            </div>


            <div class="form-group">
                <label for="delivery">
                    @lang('site.delivery_cost')
                </label>
                <input value="{{ $city->delivery}}"   type="number" name="delivery"
                       class="form-control @error('delivery') is-invalid @enderror" id="delivery">
            </div>
            <div class="form-group">
                <label for="delivery_period">
                    @lang('site.delivery_in_days')
                </label>
                <input value="{{ $city->delivery_period}}"   type="number" name="delivery_period"
                       class="form-control @error('delivery_period') is-invalid @enderror" id="delivery_period">
            </div>



            <div class="form-group">
                <label for="country_id">
                    @lang('site.country')
                </label>

                <select name="country_id"    class="form-control @error('country_id') is-invalid @enderror" id="country_id">
                    @foreach($countries as $currency)

                        @if($city->country_id == $currency->id)

                            <option value="{{$currency->id}}" selected>
                                {{$currency->name_ar}}   -        {{$currency->name_en}}
                            </option>
                            @else

                            <option value="{{$currency->id}}">
                                {{$currency->name_ar}}   -        {{$currency->name_en}}
                            </option>
                        @endif



                    @endforeach
                </select>
            </div>


        </div>

            <button type="submit" class="btn btn-primary">
                @lang('site.save')
            </button>

    </form>
@endsection

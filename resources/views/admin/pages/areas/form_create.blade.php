<form method="post" action="{{route('admin.areas.store')}}">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="name_ar">@lang('form.label.name ar')</label>
            <input maxlength="50" name="name_ar" type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" placeholder="@lang('form.placeholder.area name ar')" value="{{old('name_ar')}}" required>
            @error('name_ar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="name_en">@lang('form.label.name en')</label>
            <input maxlength="50" name="name_en" type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en" placeholder="@lang('form.placeholder.area name en')" value="{{old('name_en')}}" required>
            @error('name_en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        {{--  <div class="form-group col-md-6">
              <label for="slug">@lang('form.label.slug')</label>
              <input name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="@lang('form.placeholder.slug')" value="{{old('slug')}}">
              @error('slug')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
          </div>--}}

        <div class="form-group col-md-6">
            <label for="shipping_price">@lang('form.label.shipping area price')</label>
            <input name="shipping_price" type="text" class="form-control @error('shipping_price') is-invalid @enderror" id="shipping_price" placeholder="@lang('form.placeholder.shipping_price')" value="{{old('shipping_price')}}">
            @error('shipping_price')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="shipping_time">@lang('form.label.shipping area time')</label>
            <input name="shipping_time" type="text" class="form-control @error('shipping_time') is-invalid @enderror" id="shipping_time" placeholder="@lang('form.placeholder.shipping_time')" value="{{old('shipping_time')}}">
            @error('shipping_time')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        {{--        <div class="form-group col-md-6">--}}
        {{--            <label for="cache">الدفع عند الاستلام</label>--}}
        {{--            <select name="cache" class="form-control  @error('cache') is-invalid @enderror" id="cache" required>--}}
        {{--                <option value="1">متاح</option>--}}
        {{--                <option value="0">غير متاح</option>--}}
        {{--            </select>--}}
        {{--            @error('cache')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
        {{--        </div>--}}

        <div class="form-group col-md-6">
            <label for="country_id">@lang('form.label.chang country of area')</label>
            <select name="country_id" class="form-control  @error('country_id') is-invalid @enderror" id="country_id" required>
                @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country["name_$lang"]}}</option>
                @endforeach
            </select>
            @error('country_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

    </div>
    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add area')</button>
</form>

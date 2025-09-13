<form method="post" action="{{route('student.countries.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="name_ar">@lang('form.label.name ar')</label>
            <input maxlength="50" name="name_ar" type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" value="{{old('name_ar')}}" required>
            @error('name_ar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="name_en">@lang('form.label.name en')</label>
            <input maxlength="50" name="name_en" type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en"  value="{{old('name_en')}}" required>
            @error('name_en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

      {{--  <div class="form-group col-md-6">
            <label for="slug">@lang('form.label.slug')</label>
            <input maxlength="50" name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="@lang('form.placeholder.slug')" value="{{old('slug')}}">
            @error('slug')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>--}}

       <div class="form-group col-md-6">
            <label for="code_phone">@lang('form.label.code phone')</label>
            <input maxlength="50" name="code_phone" type="text" class="form-control @error('code_phone') is-invalid @enderror" id="code_phone" placeholder="@lang('form.placeholder.code phone country')" value="{{old('code_phone')}}">
            @error('code_phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="count_number_phone">@lang('form.label.count number phone')</label>
            <input maxlength="50" name="count_number_phone" type="number" class="form-control @error('count_number_phone') is-invalid @enderror" id="count_number_phone" placeholder="@lang('form.placeholder.count number phone country')" value="{{old('count_number_phone')}}">
            @error('count_number_phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="flag">@lang('form.label.flag')</label>
            <input maxlength="255" name="flag" type="file" class="form-control @error('flag') is-invalid @enderror" id="flag"  value="{{old('flag')}}">
            @error('flag')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="currency_id">@lang('form.label.chang  currency of country')</label>
            <select name="currency_id" class="form-control  @error('country_id') is-invalid @enderror" id="currency_id" required>
                @foreach($currencies as $currency)
                    <option value="{{$currency->id}}">{{$currency["name"]}}</option>
                @endforeach
            </select>
            @error('currency_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

    </div>
    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add country')</button>
</form>

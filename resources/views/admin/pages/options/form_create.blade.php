<form method="post" action="{{route('admin.options.store')}}" id="form_add_option">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="name_ar">@lang('form.label.name ar')</label>
            <input name="name_ar" type="text" maxlength="50" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" placeholder="@lang('form.label.name ar')" value="{{old('name_ar')}}" required>
            @error('name_ar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="name_en">@lang('form.label.name en')</label>
            <input name="name_en" type="text" maxlength="50" class="form-control @error('name_en') is-invalid @enderror" id="name_en" placeholder="@lang('form.label.name en')" value="{{old('name_en')}}" required>
            @error('name_en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>


        <div class="form-group col-md-6">
            <label for="attribute_id">@lang('form.label.attribute')</label>
            <select name="attribute_id" class="form-control @error('attribute_id') is-invalid @enderror" id="attribute_id">
                @foreach($attributes as $attribute)
                    <option {{old('attribute_id') == $attribute->id ? 'selected' : ''}}
                            value="{{$attribute->id}}">{{$attribute["name_$lang"]}}
                    </option>
                @endforeach
            </select>
            @error('attribute_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

    </div>

    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add option')</button>
</form>

<form method="post" action="{{route("admin.$infoType.store")}}">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-12">
            <label for="name">@lang('form.label.name info')</label>
            <input name="name" type="text" maxlength="50" class="form-control @error('name') is-invalid @enderror" id="name"  value="{{old('name')}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-12">
            <label for="description_ar">@lang('form.label.description info ar')</label>
            <textarea name="description_ar" type="text" class="form-control @error('description_ar') is-invalid @enderror" id="description_ar" required rows="6">{{old('description_ar')}}</textarea>
            @error('description_ar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-12">
            <label for="description_en">@lang('form.label.description info en')</label>
            <textarea name="description_en" type="text" class="form-control @error('description_en') is-invalid @enderror" id="description_en"  required rows="6">{{old('description_en')}}</textarea>
            @error('description_en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

    </div>
    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add info')</button>
</form>

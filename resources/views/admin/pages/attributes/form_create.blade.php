<form method="post" action="{{route('admin.attributes.store')}}">
    @csrf
    <div class="form-row mb-4">

        <div class="col-lg-12 col-md-6 col-sm-6 col-12">
            <span class="label-checkbox">@lang('form.label.is free')</span>

            <!-- Hidden input to send 0 if checkbox is unchecked -->
            <input type="hidden" name="is_free" value="0">

            <label class="switch s-icons s-outline s-outline-primary mb-4 mr-2">
                <input name="is_free" value="1" type="checkbox" {{ old('is_free') ? 'checked' : '' }}>
                <span class="slider"></span>
            </label>
        </div>

        <div class="form-group col-md-6">
            <label for="name_ar">@lang('form.label.name ar')</label>
            <input name="name_ar" type="text" maxlength="50" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" placeholder="@lang('form.placeholder.attribute name ar')" value="{{old('name_ar')}}" required>
            @error('name_ar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="name_en">@lang('form.label.name en')</label>
            <input name="name_en" type="text" maxlength="50" class="form-control @error('name_en') is-invalid @enderror" id="name_en" placeholder="@lang('form.placeholder.attribute name en')" value="{{old('name_en')}}" required>
            @error('name_en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

    </div>

    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add attribute')</button>
</form>

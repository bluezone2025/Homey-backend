<div class="form-group col-12  @error('description_ar') border border-danger @enderror">
    <label for="description_ar">@lang('form.label.box description ar')</label>
    <div class="widget cover-description_ar">
        <textarea id="description_ar" name="description_ar">{{old('description_ar' , $box->description_ar)}}</textarea>
    </div>
    @error('description_ar')<span class="invalid-feedback d-block" role="alert"><strong>{!! $message !!}</strong></span>@enderror
</div>

<div class="form-group col-12  @error('description_en') border border-danger @enderror">
    <label for="description_en">@lang('form.label.box description en')</label>
    <div class="widget cover-description_en">
        <textarea id="description_en" name="description_en">{{old('description_en' , $box->description_en)}}</textarea>
    </div>
    @error('description_en')<span class="invalid-feedback d-block" role="alert"><strong>{!! $message !!}</strong></span>@enderror
</div>

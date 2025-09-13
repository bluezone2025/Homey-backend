<div class="form-group col-12  @error('description_ar') border border-danger @enderror">
    <label for="description_ar" class="req">@lang('form.label.product description ar')</label>
    <div class="widget cover-description_ar">
        <textarea id="description_ar" name="description_ar">{{old('description_ar')}}</textarea>
    </div>
    @error('description_ar')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

<div class="form-group col-12  @error('description_en') border border-danger @enderror">
    <label for="description_en" class="req">@lang('form.label.product description en')</label>
    <div class="widget cover-description_en">
        <textarea id="description_en" name="description_en">{{old('description_en')}}</textarea>
    </div>
    @error('description_en')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

<div class="form-group col-12  @error('about_brand_ar') border border-danger @enderror">
    <label for="about_brand_ar" class="req">@lang('form.label.product brand ar')</label>
    <div class="widget cover-about_brand_ar">
        <textarea id="about_brand_ar" name="about_brand_ar">{{old('about_brand_ar')}}</textarea>
    </div>
    @error('about_brand_ar')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

<div class="form-group col-12  @error('about_brand_en') border border-danger @enderror">
    <label for="about_brand_en" class="req">@lang('form.label.product brand en')</label>
    <div class="widget cover-about_brand_en">
        <textarea id="about_brand_en" name="about_brand_en">{{old('about_brand_en')}}</textarea>
    </div>
    @error('about_brand_en')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

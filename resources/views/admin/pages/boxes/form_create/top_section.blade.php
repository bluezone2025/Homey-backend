<div class="form-group col-md-6">
    <label for="title_ar" class="req"> @lang('form.label.name ar')</label>
    <input name="title_ar" type="text" maxlength="50" class="form-control @error('title_ar') is-invalid @enderror" id="title_ar" placeholder="@lang('form.placeholder.product name ar')" value="{{old('title_ar')}}" required>
    @error('title_ar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

<div class="form-group col-md-6">
    <label for="title_en" class="req">@lang('form.label.name en')</label>
    <input name="title_en" type="text" maxlength="50" class="form-control @error('title_en') is-invalid @enderror" id="title_en" placeholder="@lang('form.placeholder.product name en')" value="{{old('title_en')}}" required>
    @error('title_en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>
<div class="form-group col-md-6">
    <label for="name_ar"> @lang('form.label.name ar')</label>
    <input name="name_ar" type="text" maxlength="50" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" placeholder="@lang('form.placeholder.product name ar')" value="{{old('name_ar')}}" required>
    @error('name_ar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

<div class="form-group col-md-6">
    <label for="name_en">@lang('form.label.name en')</label>
    <input name="name_en" type="text" maxlength="50" class="form-control @error('name_en') is-invalid @enderror" id="name_en" placeholder="@lang('form.placeholder.product name en')" value="{{old('name_en')}}" required>
    @error('name_en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

<div class="form-group col-md-6 d-none">
    <label for="slug">@lang('form.label.slug') @lang('form.label.optional')</label>
    <input name="slug" type="text" maxlength="50" class="form-control @error('slug') is-invalid @enderror" id="slug"  value="{{old('slug')}}">
    @error('slug')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>


<div class="form-group col-md-6">
    <label for="quantity">@lang('form.label.quantity')</label>
    <input name="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity"  value="{{old('quantity')}}" required>
    @error('quantity')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

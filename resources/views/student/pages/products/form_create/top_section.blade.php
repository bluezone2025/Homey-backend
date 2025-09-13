<div class="form-group col-md-12">
    <label for="barcode" class="req"> @lang('form.label.barcode')</label>
    <input name="barcode" type="text" maxlength="255" class="form-control @error('barcode') is-invalid @enderror" id="barcode" placeholder="@lang('form.placeholder.barcode')"
           value="{{old('barcode')}}">
</div>

<div class="form-group col-md-6">
    <label for="name_ar"> @lang('form.label.name ar')</label>
    <input name="name_ar" type="text"  class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" placeholder="@lang('form.placeholder.product name ar')" value="{{old('name_ar')}}" required>
    @error('name_ar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

<div class="form-group col-md-6">
    <label for="name_en">@lang('form.label.name en')</label>
    <input name="name_en" type="text"  class="form-control @error('name_en') is-invalid @enderror" id="name_en" placeholder="@lang('form.placeholder.product name en')" value="{{old('name_en')}}" required>
    @error('name_en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

<div class="form-group col-md-6 d-none">
    <label for="slug">@lang('form.label.slug') @lang('form.label.optional')</label>
    <input name="slug" type="text"  class="form-control @error('slug') is-invalid @enderror" id="slug"  value="{{old('slug')}}">
    @error('slug')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>


<div class="form-group col-md-6" id="main-quantity-wrapper">
    <label for="quantity">@lang('form.label.quantity')</label>
    <input name="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity"  value="{{old('quantity')}}" required>
    @error('quantity')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>
<div class="form-group col-md-6">
    <label for="brand_name" class="req">@lang('form.label.brand_name')</label>
    <input name="brand_name" type="text"  class="form-control @error('brand_name') is-invalid @enderror" id="name_en"  value="{{old('brand_name')}}" >
    @error('brand_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>
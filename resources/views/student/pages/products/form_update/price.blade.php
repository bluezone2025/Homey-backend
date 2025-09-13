{{--@if(!$product->has_paid_variant)
<div class="form-group col-md-6">
    <label for="regular_price">@lang('form.label.price')</label>
    <input name="regular_price" type="number" class="form-control @error('regular_price') is-invalid @enderror" id="regular_price"  value="{{old('regular_price'  , $product->final_regular_price)}}" step="any" required>
    @error('regular_price')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

<div class="form-group col-md-6">
    <label for="sale_price"> @lang('form.label.price discount') @lang('form.label.optional')  --}}{{--<span class=" p-1 cursor-pointer btn-outline-info"  data-toggle="modal" data-target="#fadeinModal">@lang('form.label.schedule sale')</span> --}}{{--</label>
    <input name="sale_price" type="number" class="form-control @error('sale_price') is-invalid @enderror" id="sale_price"  value="{{old('sale_price' , $product->final_sale_price)}}" step="any">
    @error('sale_price')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    @error('start_sale')<span class="invalid-feedback d-block" role="alert"><strong>@lang('form.label.error in schedule sale')</strong></span>@enderror
    @error('end_sale')<span class="invalid-feedback d-block" role="alert"><strong>@lang('form.label.error in schedule sale')</strong></span>@enderror
</div>
@endif--}}



<!-- Price Fields (shown when no paid variants or when removing variations) -->
<div id="simple-price-fields"  style="display: {{ $product->has_paid_variant ? 'none' : 'block' }}; width: 100%">
    <div class="form-group col-md-12">
        <label for="regular_price">@lang('form.label.price')</label>
        <input name="regular_price" type="number" class="form-control @error('regular_price') is-invalid @enderror"
               id="regular_price" value="{{ old('regular_price', $product->final_regular_price) }}" step="any" required>
        @error('regular_price')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>

    <div class="form-group col-md-12">
        <label for="sale_price">@lang('form.label.price discount') @lang('form.label.optional')</label>
        <input name="sale_price" type="number" class="form-control @error('sale_price') is-invalid @enderror"
               id="sale_price" value="{{ old('sale_price', $product->final_sale_price) }}" step="any">
        @error('sale_price')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>
{{--
<hr class="my-4">
<form class="mt-5" action="{{route('student.profile.update-discount-by-product')}}" method="post">
    @csrf
    <h6 class="heading-small text-primary mb-4">@lang('form.label.update-discount')</h6>
    <div class="pl-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group focused">
                    <label class="form-control-label text-black" for="selected_prodyucts">@lang('form.label.selected products')</label>
                    <select multiple name="product_ids[]" class="form-control form-control-alternative select2" >
                        @foreach($auth->products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @error('discount_value')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group focused">
                    <label class="form-control-label text-black" for="discount_value">@lang('form.label.discount value') %</label>
                    <input name="discount_value"
                           type="number" min="1"
                           value="{{ old('discount_value') }}"
                           max="100" id="discount_value" class="form-control form-control-alternative @error('discount_value') is-invalid @enderror" required>
                    @error('discount_value')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block ">@lang('form.label.update discount')</button>
        </div>
    </div>
</form>


--}}

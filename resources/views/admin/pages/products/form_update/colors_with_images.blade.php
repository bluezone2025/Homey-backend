<div class="form-group col-md-12">
    <label for="product_colors">@lang('layout.product colors')</label>
    <div id="colors-container">
        @foreach($product->productColors as $color)
            <div class="color-item d-flex align-items-center mb-2">
                <input type="hidden" name="product_colors[{{ $loop->index }}][id]" value="{{ $color->id }}">

                <input type="color" name="product_colors[{{ $loop->index }}][color]" value="{{ $color->color }}" class="form-control">

                <input type="file" name="product_colors[{{ $loop->index }}][image]" class="form-control">

                <!-- Show existing image -->
                @if($color->image)
                    <img src="{{asset("assets/images/products/min/$color->image")}}" width="50" height="50">
                    <input type="hidden" name="product_colors[{{ $loop->index }}][existing_image]" value="{{ $color->image }}">
                @endif

                <button type="button" class="btn btn-danger remove-color">@lang('layout.remove')</button>
            </div>
        @endforeach
    </div>
    <button type="button" id="addColor" class="btn btn-primary mt-2">@lang('layout.add color')</button>
</div>
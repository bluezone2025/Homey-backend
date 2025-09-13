
<div class="form-group col-md-12">
    <label>@lang('layout.product colors')</label>
    <div id="product-colors-container">
        <div class="color-item d-flex align-items-center mb-2">
            <input type="color" name="product_colors[0][color]" class="form-control color-picker">
            <input type="file" name="product_colors[0][image]" class="form-control ml-2">
            <button type="button" class="btn btn-danger remove-color ml-2">X</button>
        </div>
    </div>
    <button type="button" class="btn btn-success mt-2" id="add-color">@lang('layout.add color')</button>
</div>



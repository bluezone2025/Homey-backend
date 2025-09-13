<form method="post" action="{{route('admin.sliders.store')}}" enctype="multipart/form-data">

    @csrf


    <div class="form-row mb-4">


        <div class="form-group col-md-12">
            <label for="img">@lang('form.label.img')</label>
            <span class="text-danger">@lang('form.label.optimal_size') 1070 × 500 px</span>
            <input maxlength="255" name="img" type="file" class="form-control @error('img') is-invalid @enderror" id="img" value="{{old('img')}}" required>
            @error('img')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>



        <div class="form-group col-md-12">
            <label for="slider_for">@lang('form.slider_for')</label>
            <select id="slider_for" name="slider_for" class="form-control" >
                <option value="">@lang('form.select_slider_for')</option>
                <option value="product_id">@lang('form.product')</option>
                <option value="category_id">@lang('form.category')</option>
                <option value="brand_id">@lang('form.brand')</option>
                <option value="out_link">@lang('form.out_link')</option>
            </select>
        </div>

        <div class="form-group col-md-12" id="slider_reference_group" style="display:none;">
            <label for="slider_reference">@lang('form.slider_reference')<span class="required_star">*</span></label>
            <input type="text" id="slider_reference" class="form-control" name="slider_reference" placeholder="@lang('form.enter_reference')">
        </div>

        <div class="form-group col-md-12" id="select_group" style="display:none;">
            <label for="select_reference">@lang('form.select_reference')<span class="required_star">*</span></label>
            <select id="select_reference" name="slider_reference" class="form-control">
                <!-- Options will be populated dynamically -->
            </select>
        </div>


    </div>

    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add slider')</button>

</form>

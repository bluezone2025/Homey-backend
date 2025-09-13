<div class="form-group col-md-6">
    <label for="price">@lang('form.label.price')</label>
    <input name="price" type="number" class="form-control @error('price') is-invalid @enderror" id="price"  value="{{old('price'  , $box->price)}}" step="any" required>
    @error('price')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

<div class="form-group col-md-6">
    <label for="quantity" class="req"> @lang('form.label.quantity')</label>
    <input name="quantity" type="number" class="form-control @error('price') is-invalid @enderror" id="quantity"
           value="{{old('quantity'  , $box->quantity)}}" step="any" required>
    @error('quantity')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

<div class="form-group col-md-6">
    <label for="box_category_id">@lang('form.label.section')</label>
    <select required="required" name="box_category_id" class="form-control @error('box_category_id') is-invalid @enderror" id="box_category_id">
        @foreach($box_categories as $key => $box_category)
            <option {{$box->box_category_id == $key ? 'selected' : ''}}
                    value="{{$key}}">{{$box_category}}
            </option>
        @endforeach
    </select>
    @error('box_category_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>


<div class="form-group col-md-6 @if(!$box->required_order) d-none @endif" id="required_order_div" >
    <label for="required_order_">@lang('form.label.required_order_min_price')</label>
    <input name="order_min_price" type="number" class="form-control @error('order_min_price') is-invalid @enderror" id="required_order_"
           value="{{$box->order_min_price}}" step="any">
    @error('order_min_price')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

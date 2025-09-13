<form method="post" action="{{route('student.areas.update',$area->id)}}">
    @csrf
    {{method_field('PUT')}}
    <div class="form-row mb-4">


      {{--  <div class="form-group col-md-6">
            <label for="slug">@lang('form.label.slug')</label>
            <input name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="@lang('form.placeholder.slug')" value="{{old('slug')}}">
            @error('slug')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>--}}

        <div class="form-group col-md-6">
            <label for="shipping_price">@lang('form.label.shipping area price')</label>
            <input name="shipping_price" type="text" class="form-control @error('shipping_price') is-invalid @enderror" id="shipping_price" placeholder="@lang('form.placeholder.shipping_price')" value="{{old('shipping_price')}}">
            @error('shipping_price')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="shipping_time">@lang('form.label.shipping area time')</label>
            <input name="shipping_time" type="text" class="form-control @error('shipping_time') is-invalid @enderror" id="shipping_time" placeholder="@lang('form.placeholder.shipping_time')" value="{{old('shipping_time')}}">
            @error('shipping_time')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

{{--        <div class="form-group col-md-6">--}}
{{--            <label for="cache">الدفع عند الاستلام</label>--}}
{{--            <select name="cache" class="form-control  @error('cache') is-invalid @enderror" id="cache" required>--}}
{{--                <option value="1">متاح</option>--}}
{{--                <option value="0">غير متاح</option>--}}
{{--            </select>--}}
{{--            @error('cache')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--        </div>--}}



    </div>
    <button type="submit" class="btn btn-primary mt-3">@lang('layout.edit area')</button>
</form>

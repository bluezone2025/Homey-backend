<form method="post" action="{{route('admin.coupons.store')}}">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="name">@lang('form.label.coupon name')</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="اسم يدل علي القسيمة" value="{{old('name')}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="code">@lang('form.label.code coupon')</label>
            <input name="code" type="text" class="form-control @error('code') is-invalid @enderror" id="code" placeholder="كود الخصم الذي يتم اضافتة من المستخدم" value="{{old('code')}}" required>
            @error('code')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="end_date">@lang('form.label.end date')</label>
            <input name="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" value="{{old('end_date') ? old('end_date') : \Illuminate\Support\Carbon::now()->addMonth()->format('Y-m-d')}}" required >
            @error('end_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="type_discount">@lang('form.label.type discount')</label>
            <select name="type_discount" class="form-control @error('type_discount') is-invalid @enderror" id="type_discount">
                <option value="price" {{old('type_discount') === 'price' ? 'selected' : ''}}>@lang('form.placeholder.price')</option>
                <option value="percentage" {{old('type_discount') === 'percentage' ? 'selected' : ''}}>@lang('form.placeholder.percentage')</option>
            </select>
            @error('type_discount')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="discount">@lang('form.label.discount value')</label>
            <input name="discount" type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" placeholder="المبلغ او النسبة التي يتم خصمها" value="{{old('discount')}}" required>
            @error('discount')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="min_price">@lang('form.label.min price coupon')</label>
            <input name="min_price" type="number" class="form-control @error('min_price') is-invalid @enderror" id="min_price" placeholder="اذا كان يجب ان يتخطي الطلب قيمة مشتريات معينة" value="{{old('min_price') ? old('min_price') : 0}}" required>
            @error('min_price')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        
        <div class="form-group col-md-6">
            <label for="limit_use">@lang('form.label.available count coupon')</label>
            <input name="limit_use" type="number" class="form-control @error('limit_use') is-invalid @enderror" id="limit_use" placeholder="كم مستخدم في الموقع بامكانهم استخدام القسمية" value="{{old('limit_use') ? old('limit_use') : 10000}}" required>
            @error('limit_use')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>




{{--        <div class="form-group col-md-6">--}}
{{--            <label for="limit_user">عدد المرات المتاحة لاستخدام القسيمة لنفس المستخدم</label>--}}
{{--            <input name="limit_user" type="number" class="form-control @error('limit_user') is-invalid @enderror" id="limit_user" placeholder="كم مره يمكن ان يستخدم نفس المستخدم هاذه القسيمة" value="{{old('limit_user') ? old('limit_user') : 1}}" required>--}}
{{--            @error('limit_user')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror--}}
{{--        </div>--}}

    </div>
    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add coupon')</button>
</form>

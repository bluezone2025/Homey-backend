<div class="col-lg-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('form.label.other options')</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area text-center">
            <div class="row">


                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <span class="label-checkbox">@lang('site.required_order')</span>
                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                        <input name="required_order" class="required_order" type="checkbox" @if($box->required_order || old('required_order') ) checked="checked" @endif>
                        <span class="slider"></span>
                    </label>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="form-group col-md-6">
    <label for="title_ar">@lang('form.label.name ar')</label>
    <input name="title_ar" type="text" class="form-control @error('title_ar') is-invalid @enderror"
           id="title_ar" placeholder="@lang('form.placeholder.product name ar')" value="{{old('title_ar' , $box->title_ar)}}" required>
    @error('title_ar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

<div class="form-group col-md-6">
    <label for="title_en">@lang('form.label.name en')</label>
    <input name="title_en" type="text" class="form-control @error('title_en') is-invalid @enderror" id="title_en" placeholder="@lang('form.placeholder.product name en')" value="{{old('title_en' , $box->title_en)}}" required>
    @error('title_en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

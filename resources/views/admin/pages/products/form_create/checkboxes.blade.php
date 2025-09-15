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
                    <span class="label-checkbox">@lang('site.best')</span>
                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                        <input name="is_best" type="checkbox" {{ old('is_best') ? 'checked' : ''}}>
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <span class="label-checkbox">@lang('form.label.recommended Product')</span>
                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                        <input name="is_recommended" type="checkbox" {{ old('is_recommended') ? 'checked' : ''}}>
                        <span class="slider"></span>
                    </label>
                </div>

                {{--<div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <span class="label-checkbox">@lang('form.label.active sale')</span>
                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                        <input name="in_sale" type="checkbox" {{ old('in_sale') ? 'checked' : ''}} >
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-12 d-none">
                    <span class="label-checkbox">@lang('form.label.active options')</span>
                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                        <input name="has_options" type="checkbox" {{ old('has_options') ? 'checked' : ''}} >
                        <span class="slider"></span>
                    </label>
                </div>--}}
                {{--<div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <span class="label-checkbox">@lang('form.label.is_have_attributes')</span>
                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                        <input name="is_clothes" type="checkbox" class="is_clothes" {{ old('is_clothes') ? 'checked' : ''}}>
                        <span class="slider is_clothes"></span>
                    </label>
                </div>--}}
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <span class="label-checkbox">@lang('form.label.is_order')</span>
                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                        <input name="is_order" type="checkbox" class="is_order" {{ old('is_order') ? 'checked' : ''}} onchange="myFunctionIsOrder(0);"  >
                        <span class="slider is_order"></span>
                    </label>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <span class="label-checkbox">@lang('site.send_notifi_pro')</span>
                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                        <input name="send_notifi_pro" type="checkbox" {{ old('send_notifi_pro') ? 'checked' : ''}}>
                        <span class="slider"></span>
                    </label>
                </div>

                 <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <span class="label-checkbox">@lang('site.indoor_decor')</span>
                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                        <input name="indoor" type="checkbox" value="1" {{ old('indoor') ? 'checked' : ''}}>
                        <span class="slider"></span>
                    </label>
                </div>

                  <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <span class="label-checkbox">@lang('site.outdoor_decor')</span>
                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                        <input name="outdoor" type="checkbox" value="1" {{ old('outdoor') ? 'checked' : ''}}>
                        <span class="slider"></span>
                    </label>
                </div>

                 <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <span class="label-checkbox">@lang('site.unique_pieces')</span>
                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                        <input name="unique" type="checkbox" value="1" {{ old('unique') ? 'checked' : ''}}>
                        <span class="slider"></span>
                    </label>
                </div>

                
            </div>

        </div>
    </div>
</div>

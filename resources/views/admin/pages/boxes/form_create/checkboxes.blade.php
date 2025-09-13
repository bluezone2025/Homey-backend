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
                    <span class="label-checkbox">@lang('site.send_notifi_pro')</span>
                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                        <input name="send_notifi_pro" type="checkbox" {{ old('send_notifi_pro') ? 'checked' : ''}}>
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <span class="label-checkbox">@lang('site.required_order')</span>
                    <label class="switch s-icons s-outline  s-outline-primary  mb-4 mr-2">
                        <input name="required_order" class="required_order" type="checkbox" {{ old('required_order') ? 'checked' : ''}}>
                        <span class="slider"></span>
                    </label>
                </div>
            </div>

        </div>
    </div>
</div>

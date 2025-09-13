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
                    <span class="label-checkbox">@lang('form.label.featured Product')</span>
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

                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
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
                </div>


            </div>

        </div>
    </div>
</div>

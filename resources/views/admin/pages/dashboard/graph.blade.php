<div class="col-12  mt-5 bg-info">
<div class="widget-one" style="">
        <div class="widget-content">
            <div class="w-numeric-value">
                <div class="w-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                </div>
                <div class="w-content">
                    <span class="w-value">{{array_sum($orders)}}</span>
                    <span class="w-numeric-title">@lang('form.label.graph admin')</span>
                </div>
            </div>
            <div class="w-chart">
                <div id="total-products"></div>
            </div>
        </div>
    </div>
</div>

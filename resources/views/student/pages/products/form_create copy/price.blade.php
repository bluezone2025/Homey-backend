
<div class="form-group col-md-6">
    <label for="regular_price"> @lang('form.label.price')</label>
    <input name="regular_price" type="number" class="form-control @error('regular_price') is-invalid @enderror" id="regular_price"  value="{{old('regular_price')}}" step="any" required>
    @error('regular_price')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
</div>

<div class="form-group col-md-6">
    <label for="sale_price">  @lang('form.label.price discount')  @lang('form.label.optional')  <span class=" p-1 cursor-pointer btn-outline-info"  data-toggle="modal" data-target="#fadeinModal"> @lang('form.label.schedule sale')</span> </label>
    <input name="sale_price" type="number" class="form-control @error('sale_price') is-invalid @enderror" id="sale_price"  value="{{old('sale_price')}}" step="any">
    @error('sale_price')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    @error('start_sale')<span class="invalid-feedback d-block" role="alert"><strong> @lang('form.label.error in schedule sale')</strong></span>@enderror
    @error('end_sale')<span class="invalid-feedback d-block" role="alert"><strong> @lang('form.label.error in schedule sale')</strong></span>@enderror
</div>

<div id="fadeinModal" class="modal animated fadeInDown" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> @lang('form.label.select start and end sale')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group col-md-12">
                    <label for="start_sale"> @lang('form.label.select start sale')</label>
                    <input name="start_sale" type="date" class="form-control @error('start_sale') is-invalid @enderror" id="start_sale"  value="{{old('start_sale') ? old('start_sale') : date('Y-m-d')}}">
                    @error('start_sale')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
                <div class="form-group col-md-12">
                    <label for="end_sale"> @lang('form.label.select end sale')</label>
                    <input name="end_sale" type="date" class="form-control @error('end_sale') is-invalid @enderror" id="end_sale"  value="{{old('end_sale')}}">
                    <a href="" class="btn btn-light reset_end_sale"> @lang('form.label.clear end date')</a>
                    @error('end_sale')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> @lang('form.label.close')</button>
            </div>
        </div>
    </div>
</div>

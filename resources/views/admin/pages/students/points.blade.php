
<div id="fadeinModal" class="modal animated fadeInDown" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('form.label.edit points in account student')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group col-md-12">
                    <label for="points">@lang('form.label.points')</label>
                    <input name="points" type="number" class="form-control @error('points') is-invalid @enderror" id="points"  value="{{old('points')}}">
                    @error('points')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" data-dismiss="modal" id="update_points"><i class="flaticon-cancel-12"></i>@lang('form.label.update')</button>
                <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i>@lang('form.label.close')</button>
            </div>
        </div>
    </div>
</div>

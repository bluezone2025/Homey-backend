<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('layout.add option')</h5>
            </div>
            <div class="modal-body">

                <form action="{{route('admin.options.store')}}">
                    <input type="hidden" name="attribute_id" id="inp_attribute_id">
                    <span class="invalid-feedback d-block" id="myDataTable-attribute_id" role="alert"><strong></strong></span>
                    <div class="form-group">
                        <label for="name_ar">@lang('form.label.name ar')</label>
                        <input  name="name_ar" type="text" maxlength="50" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" placeholder="" value="{{old('name_ar')}}" required>
                        <span class="invalid-feedback d-block" id="myDataTable-name_ar" role="alert"><strong></strong></span>
                    </div>

                    <div class="form-group">
                        <label for="name_en">@lang('form.label.name en')</label>
                        <input name="name_en" type="text" maxlength="50" class="form-control @error('name_en') is-invalid @enderror" id="name_en" placeholder="" value="{{old('name_en')}}" required>
                        <span class="invalid-feedback d-block" id="myDataTable-name_en" role="alert"><strong></strong></span>
                    </div>
                </form>

                <div class="alert alert-success d-none message-create-option">@lang('form.label.success save')</div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> @lang('form.label.close') </button>
                <button type="button"  class="btn btn-primary new_option">@lang('form.label.create')</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modalAction" id="modalAction" tabindex="-1" role="dialog" aria-labelledby="modalActionLabel" aria-hidden="true">
    <div class="modal-dialog @isset($big) modal-lg @endisset" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalActionLabel">@lang('form.label.edit data')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form enctype="multipart/form-data" class="modal-form row">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">@lang('form.label.close')</button>
                <a href="" class="btn btn-success btnUpdate">@lang('form.label.update data')</a>
            </div>
            <div class="message">

            </div>
        </div>
    </div>
</div>
<button type="button" class="btn btn-primary modalActionBtn d-none" data-toggle="modal" data-target="#modalAction" data-whatever="@getbootstrap">section edit</button>

<hr class="my-4">
<form class="mt-5" action="{{route('student.profile.updatePassword')}}" method="post">
    @csrf
    <h6 class="heading-small text-primary mb-4">@lang('form.label.change password')</h6>
    <div class="pl-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group focused">
                    <label class="form-control-label text-black" for="password">@lang('form.label.old password')</label>
                    <input name="oldPassword" type="password" id="password" class="form-control form-control-alternative @error('oldPassword') is-invalid @enderror" required>
                    @error('oldPassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label text-black" for="newPassword">@lang('form.label.new password')</label>
                    <input name="newPassword" type="password" id="newPassword" class="form-control form-control-alternative @error('oldPassword') is-invalid @enderror" required>
                    @error('newPassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block ">@lang('form.label.update password')</button>
        </div>
    </div>
</form>


<hr class="my-4">
<form class="mt-5" action="{{route('student.profile.updateImg')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="pl-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <h6 class="heading-small text-primary mb-4">@lang('form.label.profile image')</h6>

                <div class="img-fluid mb-3"><img height="100" src="{{asset("assets/images/student/$auth->img")}}" alt=""></div>

                <div class="form-group focused">
                    <label class="form-control-label text-black" for="img">@lang('form.label.add profile image')</label>
                    <input name="img" type="file" id="img" class="form-control form-control-alternative @error('img') is-invalid @enderror" >
                    @error('img')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="col-lg-12">

                <h6 class="heading-small text-primary mb-4 mt-2">@lang('form.label.cover')</h6>

                <div class="img-fluid mb-3"><img height="100" src="{{asset("assets/images/student/$auth->cover")}}" alt=""></div>

                <div class="form-group focused">
                    <label class="form-control-label text-black" for="img">@lang('form.label.add cover')</label>
                    <input name="cover" type="file" id="cover" class="form-control form-control-alternative @error('cover') is-invalid @enderror" >
                    @error('cover')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block ">@lang('form.label.update images')</button>
        </div>
    </div>
</form>

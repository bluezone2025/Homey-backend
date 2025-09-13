<form class="text-left" method="post" action="{{route('student.register')}}" enctype="multipart/form-data">
    @csrf

    <div class="form">

        <div id="name-field" class="field-wrapper input">
            <label for="img">@lang('form.label.profile image')</label>
            <input max="255" id="img" name="img" type="file" value="{{old('img')}}" class=" @error('img') is-invalid @enderror form-control" maxlength="50" required placeholder="Userimg">
            @error('img')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror

        </div>

        <div id="name-field" class="field-wrapper input">
            <label for="name">@lang('form.label.name')</label>
            <input max="50" id="name" name="name" type="text" value="{{old('name')}}" class=" @error('name') is-invalid @enderror form-control" maxlength="50" required placeholder="Username">
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror

        </div>

        <div id="email-field" class="field-wrapper input">
            <label for="email">@lang('form.label.email')</label>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign register"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
            <input max="100" id="email" name="email" type="email" value="{{old('emil')}}" class="@error('email') is-invalid @enderror form-control" maxlength="100" required placeholder="Email">
            @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div id="phone-field" class="field-wrapper input">
            <label for="phone">@lang('form.label.phone')</label>
            <input max="20" id="phone" name="phone" type="tel" value="{{old('phone')}}" class="@error('phone') is-invalid @enderror form-control" maxlength="20" required placeholder="phone">
            @error('phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>



        <div id="password-field" class="field-wrapper input mb-2">
            <div class="d-flex justify-content-between">
                <label for="password">@lang('form.label.password')</label>
                <a href="{{route('student.login')}}" class="forgot-pass-link">@lang('form.label.have account')</a>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            <input id="password" name="password" type="password" class="@error('password') is-invalid @enderror form-control" maxlength="255" required placeholder="Password">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror

        </div>

{{--        <div class="field-wrapper terms_condition">--}}
{{--            <div class="n-chk">--}}
{{--                <label class="new-control new-checkbox checkbox-primary">--}}
{{--                    <input type="checkbox" class="new-control-input">--}}
{{--                    <span class="new-control-indicator"></span><span>I agree to the <a href="javascript:void(0);">  terms and conditions </a></span>--}}
{{--                </label>--}}
{{--            </div>--}}

{{--        </div>--}}

        <div class="d-sm-flex justify-content-between">
            <div class="field-wrapper">
                <button type="submit" class="btn btn-primary" value="">@lang('form.label.register')</button>
            </div>
        </div>


    </div>
</form>

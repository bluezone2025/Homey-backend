<form method="post" action="{{route('admin.users.store')}}" id="form_add_option">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="name">@lang('form.label.name')</label>
            <input name="name" type="text" maxlength="50" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="@lang('form.label.user name')" value="{{old('name')}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="email">@lang('form.label.email')</label>
            <input name="email" type="email" maxlength="100" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="@lang('form.label.email')" value="{{old('email')}}" required>
            @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="phone">@lang('form.label.phone')</label>
            <input name="phone" type="tel" maxlength="20" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="@lang('form.label.phone')" value="{{old('phone')}}" required>
            @error('phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>


        <div class="form-group col-md-12">
            <label for="password" class="d-block">@lang('form.label.password')</label>
            <input name="password" type="text" maxlength="255" class="d-inline-block  form-control @error('password') is-invalid @enderror" id="password" placeholder="@lang('form.placeholder.user password')" value="{{old('password')}}" required>
            <a class="btn btn-outline-light btn-password-generator d-inline-block">@lang('form.label.password generator')</a>
            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

    </div>

    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add user')</button>
</form>

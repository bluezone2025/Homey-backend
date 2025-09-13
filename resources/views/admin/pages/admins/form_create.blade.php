<form method="post" action="{{route('admin.admins.store')}}" id="form_add_option">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="name">@lang('form.label.name')</label>
            <input name="name" type="text"  class="form-control @error('name') is-invalid @enderror" id="name" placeholder="@lang('form.placeholder.admin name')" value="{{old('name')}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="email">@lang('form.label.email')</label>
            <input name="email" type="email" maxlength="100" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="@lang('form.placeholder.admin name')" value="{{old('email')}}" required>
            @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="phone">@lang('form.label.phone') @lang('form.label.optional')</label>
            <input name="phone" type="tel" maxlength="20" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="@lang('form.placeholder.admin phone')" value="{{old('phone')}}">
            @error('phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="role_id">@lang('form.label.role')</label>
            <select name="role_id"  class="form-control @error('role_id') is-invalid @enderror" id="role_id" required>
                @foreach($roles as $role)
                    <option value="{{$role->id}}" {{old('role') == $role->id}}>{{$role->name}}</option>
                @endforeach
            </select>
            @error('role_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>


        <div class="form-group col-md-12">
            <label for="password" class="d-block">@lang('form.label.password')</label>
            <input name="password" type="text" maxlength="255" class="d-inline-block  form-control @error('password') is-invalid @enderror" id="password" placeholder="@lang('form.placeholder.admin password')" value="{{old('password')}}" required>
            <a class="btn btn-outline-light btn-password-generator d-inline-block">@lang('form.label.password generator')</a>
            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

    </div>

    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add admin')</button>
</form>

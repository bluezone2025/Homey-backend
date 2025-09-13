<form method="post" action="{{route('admin.roles.store')}}">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="name">@lang('form.label.name')</label>
            <input name="name" type="text" maxlength="50" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="@lang('form.placeholder.role name')" value="{{old('name')}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="description">@lang('form.label.description') @lang('form.label.optional')</label>
            <input name="description" type="text" maxlength="255" class="form-control @error('description') is-invalid @enderror" id="description"  value="{{old('description')}}">
            @error('description')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

    </div>

    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add role')</button>
</form>

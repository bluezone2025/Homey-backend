<form method="post" action="{{route('admin.icons.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="title">@lang('form.label.title')</label>
            <input maxlength="100" name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="@lang('form.placeholder.title icon')" value="{{old('title')}}" required>
            @error('title')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="img">@lang('form.label.img')</label>
            <input maxlength="255" name="img" type="file" class="form-control @error('img') is-invalid @enderror" id="img"  value="{{old('img')}}">
            @error('img')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="link">@lang('form.label.link')</label>
            <input maxlength="10000" name="link" type="text" class="form-control @error('link') is-invalid @enderror" id="link" placeholder="@lang('form.placeholder.link')" value="{{old('link')}}">
            @error('link')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="type">@lang('form.label.type')</label>
            <select name="type" type="text" class="form-control @error('type') is-invalid @enderror" id="type">
                <option value="icon">@lang('form.label.type icon')</option>
                <option value="information">@lang('form.label.type information')</option>
            </select>
            @error('type')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>


    </div>
    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add icon')</button>
</form>

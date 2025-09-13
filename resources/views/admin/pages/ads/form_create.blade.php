<form method="post" action="{{route('admin.ads.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-4">


        <div class="form-group col-md-12">
            <label for="img">@lang('form.label.img')</label>
            <input maxlength="255" name="img" type="file" class="form-control @error('img') is-invalid @enderror" id="img" value="{{old('img')}}" required>
            @error('img')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-12">
            <label for="in_app">@lang('form.label.type link')</label>
            <select name="in_app" type="text" class="form-control @error('in_app') is-invalid @enderror" id="in_app">
                <option value="0">@lang('form.label.normal link')</option>
                <option value="1">@lang('form.label.app link')</option>
            </select>
            @error('in_app')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>


        <div class="form-group col-md-12">
            <label for="link">@lang('form.label.link')</label>
            <input maxlength="10000" name="link" type="text" class="form-control @error('link') is-invalid @enderror" id="link" placeholder="@lang('form.placeholder.link')" value="{{old('link')}}" required>
            <div id="cover-result"></div>
            @error('link')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            <input type="hidden" name="type" value="">
        </div>
        <div class="form-group col-md-12">
            <label for="position">@lang('form.label.number ad')</label>
            <select name="position" type="text" class="form-control @error('position') is-invalid @enderror" id="position">
              <option value="1"> @lang('form.label.ad1')</option>
              <option value="2"> @lang('form.label.ad2')</option>
              <option value="3"> @lang('form.label.ad3')</option>
              <option value="4"> @lang('form.label.ad4')</option>
              <option value="5"> @lang('form.label.ad5')</option>
              <option value="6"> @lang('form.label.ad6')</option>
              <option value="7"> @lang('form.label.ad7')</option>
              <option value="8"> @lang('form.label.ad3')</option>
              <option value="9"> @lang('form.label.ad9')</option>
              <option value="10"> @lang('form.label.ad10')</option>
            </select>
            @error('position')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>


    </div>
    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add ad')</button>
</form>

<form method="post" action="{{route('admin.countries.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="name">@lang('form.label.name')</label>
            <input maxlength="50" name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>



       <div class="form-group col-md-6">
            <label for="code">@lang('form.label.code_ar')</label>
            <input maxlength="50" name="code_ar" type="text" class="form-control @error('code_ar') is-invalid @enderror" id="code_ar"  value="{{old('code_ar')}}">
            @error('code_ar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
             <label for="code">@lang('form.label.code_en')</label>
             <input name="code_en" type="text" class="form-control @error('code_en') is-invalid @enderror" id="code_en"  value="{{old('code_en')}}">
             @error('code_en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
         </div>
        <div class="form-group col-md-6">
            <label for="rate">@lang('form.label.rate')</label>
            <input name="rate" type="number" class="form-control @error('rate') is-invalid @enderror" id="rate"  value="{{old('rate')}}">
            @error('rate')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>



    </div>
    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add currency')</button>
</form>

<form method="post" action="{{route('admin.box-categories.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="title_ar">@lang('form.label.name ar')</label>
            <input name="title_ar" type="text" maxlength="50" class="form-control @error('title_ar') is-invalid @enderror" id="title_ar" placeholder="اسم التصنيف باللغة العربية" value="{{old('title_ar')}}" required>
            @error('title_ar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="title_en">@lang('form.label.name en')</label>
            <input name="title_en" type="text" maxlength="50" class="form-control @error('title_en') is-invalid @enderror" id="title_en" placeholder="اسم التصنيف باللغة الانجليزية" value="{{old('title_en')}}" required>
            @error('title_en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

      {{--<div class="form-group col-md-6">
            <label for="slug">@lang('form.label.slug') @lang('form.label.optional')</label>
            <input name="slug" type="text" maxlength="50" class="form-control @error('slug') is-invalid @enderror" id="slug"  value="{{old('slug')}}">
            @error('slug')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>--}}

        <div class="form-group col-md-6">
            <label for="can_by_multiple">@lang('form.label.can_by_multiple')</label>
            <select name="can_by_multiple" class="form-control @error('can_by_multiple') is-invalid @enderror" id="can_by_multiple">
                <option {{old('can_by_multiple') == 0 ? 'selected' : ''}}
                        value="0">@lang('form.label.can_by_multiple_no')
                </option>

                <option {{old('can_by_multiple') == 1 ? 'selected' : ''}}
                        value="1">@lang('form.label.can_by_multiple_yes')
                </option>
            </select>
            @error('can_by_multiple')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add box category')</button>
</form>

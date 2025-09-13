<form method="post" action="{{route('admin.student.store')}}" id="form_add_option" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-4">
      <div class="form-group col-md-6">
          <label for="img">@lang('form.label.img') </label>
          <input name="img" type="file" maxlength="255" class="form-control @error('img') is-invalid @enderror" id="img"  value="{{old('img')}}" accept="image">
          @error('img')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
      </div>
        <div class="form-group col-md-6">
            <label for="name_ar">@lang('form.label.name ar')</label>
            <input name="name_ar" type="text" maxlength="50" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar" placeholder="@lang('form.placeholder.student name ar')" value="{{old('name_ar')}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="name_en">@lang('form.label.name en')</label>
            <input name="name_en" type="text" maxlength="50" class="form-control @error('name_en') is-invalid @enderror" id="name_en" placeholder="@lang('form.placeholder.student name en')" value="{{old('name_en')}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="email">@lang('form.label.email')</label>
            <input name="email" type="email" maxlength="100" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="@lang('form.placeholder.student email')" value="{{old('email')}}" required>
            @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="phone">@lang('form.label.phone')</label>
            <input name="phone" type="tel" maxlength="20" class="form-control @error('phone') is-invalid @enderror"
                   id="phone" placeholder="@lang('form.placeholder.student phone')" value="{{old('phone')}}" >
            @error('phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>




        <div class="form-group col-md-6">
            <label for="trendat_percentage">@lang('form.label.trendat_percentage')</label>
            <input name="trendat_percentage" type="text"
                   class="form-control @error('trendat_percentage') is-invalid @enderror" id="trendat_percentage" 
                   placeholder="@lang('form.placeholder.trendat_percentage desc')" value="{{old('trendat_percentage')}}" required>
            @error('trendat_percentage')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="student_percentage">@lang('form.label.student_percentage')</label>
            <input name="student_percentage" type="text"
                   class="form-control @error('student_percentage') is-invalid @enderror" id="student_percentage"
                   placeholder="@lang('form.placeholder.student_percentage desc')" value="{{old('student_percentage')}}" required>
            @error('student_percentage')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="gender">@lang('form.label.gender')</label>
            <select required name="gender" class="form-control @error('gender') is-invalid @enderror" id="gender">
                <option value="">@lang('form.label.gender')</option>
{{--
                <option {{old('gender') == 1 ? 'selected' : ''}} value="1">@lang('form.label.male')</option>
--}}
                <option {{old('gender') == 2 ? 'selected' : ''}} value="2">@lang('form.label.female')</option>
                <option {{old('gender') == 3 ? 'selected' : ''}} value="3">@lang('form.label.market')</option>

            </select>
            @error('gender')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>



        <div class="form-group col-md-12">
            <label for="password" class="d-block">@lang('form.label.password')</label>
            <input name="password" type="text" maxlength="255" class="d-inline-block  form-control @error('password') is-invalid @enderror" id="password" placeholder="@lang('form.placeholder.student password')" value="{{old('password')}}" required>
            <a class="btn btn-outline-light btn-password-generator d-inline-block">@lang('form.label.password generator')</a>
            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

    </div>

    <button type="submit" class="btn btn-primary mt-3">@lang('layout.add student')</button>
</form>

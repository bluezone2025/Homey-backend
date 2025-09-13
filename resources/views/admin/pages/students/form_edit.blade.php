<form method="post" action="{{route('admin.student.update',$student->id)}}" id="form_add_option" enctype="multipart/form-data">
    @csrf
    {{ method_field('PUT') }}
    <div class="form-row mb-4">
      <div class="form-group col-md-6">
          <label for="img">@lang('form.label.img') </label>
          <input name="img" type="file" maxlength="255" class="form-control @error('img') is-invalid @enderror" id="img"  value="{{old('img')}}" accept="image">
          @error('img')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
      </div>
        <div class="form-group col-md-6">
            <label for="name_ar">@lang('form.label.name ar')</label>
            <input name="name_ar" type="text" maxlength="50" class="form-control @error('name_ar') is-invalid @enderror"
                   id="name_ar" placeholder="@lang('form.placeholder.student name ar')" value="{{$student->name_ar}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>


        <div class="form-group col-md-6">
            <label for="name_en">@lang('form.label.name en')</label>
            <input name="name_en" type="text" maxlength="50" class="form-control @error('name_en') is-invalid @enderror"
                   id="name_en" placeholder="@lang('form.placeholder.student name en')" value="{{$student->name_en}}" required>
            @error('name_en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="email">@lang('form.label.email')</label>
            <input name="email" type="email" maxlength="100" class="form-control @error('email') is-invalid @enderror" id="email"
                   placeholder="@lang('form.placeholder.student email')" value="{{$student->email}}" required>
            @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="phone">@lang('form.label.phone')</label>
            <input name="phone" type="tel" maxlength="20" class="form-control @error('phone') is-invalid @enderror"
                   id="phone" placeholder="@lang('form.placeholder.student phone')" value="{{$student->phone}}" >
            @error('phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="row_no">@lang('form.label.row_no')</label>
            <input name="row_no" type="number"  class="form-control @error('row_no') is-invalid @enderror"
                   id="phone" placeholder="@lang('form.placeholder.row_no')" value="{{$student->row_no}}" >
            @error('row_no')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>




        <div class="form-group col-md-6">
            <label for="trendat_percentage">@lang('form.label.trendat_percentage')</label>
            <input name="trendat_percentage" type="text"
                   class="form-control @error('trendat_percentage') is-invalid @enderror" id="trendat_percentage" 
                   placeholder="@lang('form.placeholder.trendat_percentage desc')" value="{{$student->trendat_percentage}}" required>
            @error('trendat_percentage')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="student_percentage">@lang('form.label.student_percentage')</label>
            <input name="student_percentage" type="text"
                   class="form-control @error('student_percentage') is-invalid @enderror" id="student_percentage"
                   placeholder="@lang('form.placeholder.student_percentage desc')" value="{{$student->student_percentage}}" required>
            @error('student_percentage')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>


        <div class="form-group col-md-6">
            <label for="gender">@lang('form.label.gender')</label>
            <select required name="gender" class="form-control @error('gender') is-invalid @enderror" id="gender">
                <option value="">@lang('form.label.gender')</option>
{{--
                <option {{$student->gender == 1 ? 'selected' : ''}} value="1">@lang('form.label.male')</option>
--}}
                <option {{$student->gender == 2 ? 'selected' : ''}} value="2">@lang('form.label.female')</option>
                <option {{$student->gender == 3 ? 'selected' : ''}} value="3">@lang('form.label.market')</option>

            </select>
            @error('gender')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>



    </div>

    <button type="submit" class="btn btn-primary mt-3">@lang('layout.update student')</button>
</form>

<form method="post" action="{{route('admin.users.store')}}" id="form_add_option">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="name">الاسم</label>
            <input name="name" type="text" maxlength="50" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="اسم المستخدم" value="{{old('name')}}" required>
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="email">البريد الالكتروني</label>
            <input name="email" type="email" maxlength="100" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="البريد الخاص بالحساب" value="{{old('email')}}" required>
            @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="phone">رقم الهاتف</label>
            <input name="phone" type="tel" maxlength="20" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="رقم الهاتف" value="{{old('phone')}}" required>
            @error('phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>


        <div class="form-group col-md-12">
            <label for="password" class="d-block">كلمة المرور</label>
            <input name="password" type="text" maxlength="255" class="d-inline-block  form-control @error('password') is-invalid @enderror" id="password" placeholder="كلمة مرور خاصة بحساب الموظف" value="{{old('password')}}" required>
            <a class="btn btn-outline-light btn-password-generator d-inline-block">توليد كلمة مرور عشوائية</a>
            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

    </div>

    <button type="submit" class="btn btn-primary mt-3">اضافة  مستخدم جديد</button>
</form>

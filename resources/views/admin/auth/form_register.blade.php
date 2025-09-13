<form class="text-left" method="post" action="{{route('admin.register')}}">
    @csrf

    <div class="form">

        <div id="name-field" class="field-wrapper input">
            <label for="name">@lang('form.label.name')</label>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            <input id="name" name="name" type="text" value="{{old('name')}}" class=" @error('name') is-invalid @enderror form-control" maxlength="50" required placeholder="Username">
            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror

        </div>

        <div id="email-field" class="field-wrapper input">
            <label for="email">@lang('form.label.email')</label>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign register"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
            <input id="email" name="email" type="email" value="{{old('emil')}}" class="@error('email') is-invalid @enderror form-control" maxlength="100" required placeholder="Email">
            @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>

        <div id="phone-field" class="field-wrapper input">
            <label for="phone">@lang('form.label.phone')</label>
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnN2Z2pzPSJodHRwOi8vc3ZnanMuY29tL3N2Z2pzIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeD0iMCIgeT0iMCIgdmlld0JveD0iMCAwIDM1IDM1IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyIiB4bWw6c3BhY2U9InByZXNlcnZlIiBjbGFzcz0iIj48Zz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KCTxwYXRoIGQ9Ik0yNS4zMDIsMEg5LjY5OGMtMS4zLDAtMi4zNjQsMS4wNjMtMi4zNjQsMi4zNjR2MzAuMjcxQzcuMzM0LDMzLjkzNiw4LjM5OCwzNSw5LjY5OCwzNWgxNS42MDQgICBjMS4zLDAsMi4zNjQtMS4wNjIsMi4zNjQtMi4zNjRWMi4zNjRDMjcuNjY2LDEuMDYzLDI2LjYwMiwwLDI1LjMwMiwweiBNMTUuMDA0LDEuNzA0aDQuOTkyYzAuMTU4LDAsMC4yODYsMC4xMjgsMC4yODYsMC4yODcgICBjMCwwLjE1OC0wLjEyOCwwLjI4Ni0wLjI4NiwwLjI4NmgtNC45OTJjLTAuMTU4LDAtMC4yODYtMC4xMjgtMC4yODYtMC4yODZDMTQuNzE4LDEuODMyLDE0Ljg0NiwxLjcwNCwxNS4wMDQsMS43MDR6IE0xNy41LDMzLjgxOCAgIGMtMC42NTMsMC0xLjE4Mi0wLjUyOS0xLjE4Mi0xLjE4M3MwLjUyOS0xLjE4MiwxLjE4Mi0xLjE4MnMxLjE4MiwwLjUyOCwxLjE4MiwxLjE4MlMxOC4xNTMsMzMuODE4LDE3LjUsMzMuODE4eiBNMjYuMDIxLDMwLjYyNSAgIEg4Ljk3OVYzLjc0OWgxNy4wNDJWMzAuNjI1eiIgZmlsbD0iIzg4OGVhOCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgc3R5bGU9IiIgY2xhc3M9IiI+PC9wYXRoPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjwvZz48L3N2Zz4=" />
            <input id="phone" name="phone" type="tel" value="{{old('phone')}}" class="@error('phone') is-invalid @enderror form-control" maxlength="20" required placeholder="phone">
            @error('phone')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>




        <div id="password-field" class="field-wrapper input mb-2">
            <div class="d-flex justify-content-between">
                <label for="password">@lang('form.label.password')</label>
                <a href="{{route('admin.password.request')}}" class="forgot-pass-link">@lang('form.label.did forget password')</a>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            <input id="password" name="password" type="password" class="@error('password') is-invalid @enderror form-control" maxlength="255" required placeholder="Password">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror

        </div>

{{--        <div class="field-wrapper terms_condition">--}}
{{--            <div class="n-chk">--}}
{{--                <label class="new-control new-checkbox checkbox-primary">--}}
{{--                    <input type="checkbox" class="new-control-input">--}}
{{--                    <span class="new-control-indicator"></span><span>I agree to the <a href="javascript:void(0);">  terms and conditions </a></span>--}}
{{--                </label>--}}
{{--            </div>--}}

{{--        </div>--}}

        <div class="d-sm-flex justify-content-between">
            <div class="field-wrapper">
                <button type="submit" class="btn btn-primary" value="">@lang('form.label.register')</button>
            </div>
        </div>


    </div>
</form>


@extends('layouts.front')
@section('title')
    @lang('site.home')

@endsection
@section('content')
    <!-----start  --->
    <div class="container-fluid pad-0 mt-3">
        <h1 class="title text-center">@lang('site.my_account') </h1>
    </div>

    <!-----  ----->
    <div class="container ">
        <br>
        <div class="row dir-rtl">
{{--            <div class="col-md-6">--}}
{{--                <h2> sign in</h2>--}}
{{--                <form method="POST" action="{{ route('login') }}" class="account " style="text-transform: capitalize">--}}
{{--                    @csrf--}}

{{--                    <div class="form-group row">--}}
{{--                        <label for="email" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('E-Mail Address') }}</label>--}}

{{--                        <div class="col-md-6">--}}
{{--                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                            @error('email')--}}
{{--                            <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <br>--}}
{{--                    <div class="form-group row">--}}
{{--                        <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Password') }}</label>--}}

{{--                        <div class="col-md-6">--}}
{{--                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                            @error('password')--}}
{{--                            <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <br>--}}
{{--                    <div class="form-group row">--}}
{{--                        <div class="col-md-6 offset-md-4">--}}
{{--                            <div class="form-check">--}}
{{--                                <input class="form-check-input" type="checkbox" name="remember"   id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                <label class="form-check-label" for="remember">--}}
{{--                                    {{ __('Remember Me') }}--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <br>--}}
{{--                    <div class="form-group row mb-0">--}}
{{--                        <div class="col-md-8 offset-md-4">--}}

{{--                            <button type="submit" class="btn btn-dark" style="margin: auto;">--}}
{{--                                {{ __('Login') }}--}}
{{--                            </button>--}}


{{--                            --}}{{--                                @if (Route::has('password.request'))--}}
{{--                            --}}{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                            --}}{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                            --}}{{--                                    </a>--}}
{{--                            --}}{{--                                @endif--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--                --}}{{--                <form >--}}
{{--                --}}{{--                    <div class="form-group">--}}
{{--                --}}{{--                        <label for="exampleInputEmail1">user name or email *</label>--}}
{{--                --}}{{--                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">--}}
{{--                --}}{{--                    </div>--}}
{{--                --}}{{--                    <div class="form-group">--}}
{{--                --}}{{--                        <label for="exampleInputPassword1">password *</label>--}}
{{--                --}}{{--                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="">--}}
{{--                --}}{{--                    </div>--}}
{{--                --}}{{--                    <div class="form-check">--}}
{{--                --}}{{--                        <input type="checkbox" class="form-check-input" id="exampleCheck1">--}}
{{--                --}}{{--                        <label class="form-check-label" for="exampleCheck1" style="padding-right: 20px"> Remember me--}}
{{--                --}}{{--                        </label>--}}
{{--                --}}{{--                    </div>--}}
{{--                --}}{{--                    <a class="float-right active" href="" data-target="#password"  data-toggle="modal">Forgot your password?</a>--}}
{{--                --}}{{--                    <br><br>--}}
{{--                --}}{{--                    <button type="submit" class="btn btn-dark">sign in</button>--}}
{{--                --}}{{--                </form>--}}


{{--            </div>--}}
            <div class="col-lg-6 col-md-8" style="margin: auto">
                <div style="display: flex;justify-content: space-between;align-items: center;">
                    <h2> @lang('site.signup')</h2>

                    <a class="text main-color" href="{{route('login')}}" style="font-weight: bold">
                        @lang('site.have_acc')
                    </a>

                </div>

                <form method="POST" action="{{ route('register') }}" class="account " style="background: #e9ecef;">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right font-weight-bold font-weight-bold text-dir">@lang('site.name')</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row" >
                        <label for="email" class="col-md-4 col-form-label text-md-right font-weight-bold text-dir">@lang('site.email')</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"   autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right font-weight-bold text-dir">@lang('site.phone')</label>

                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="name" autofocus>

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <span class="text-center">
                                                    </span>
                    </div>
                    <br>

                    <div class="form-group row">
                        <label for="country" class="col-md-4 col-form-label text-md-right font-weight-bold text-dir">@lang('site.country')</label>

                        <div class="col-md-6">

                            <select class="form-control @error('country') is-invalid @enderror"  name="country" id="country">
                                @foreach(\App\Country::all() as $c)

                                    <option value="{{$c->id}}">
                                        {{$c->name_ar}}  -  {{$c->name_en}}
                                    </option>

                                @endforeach
                            </select>
                            @error('country')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <br>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold text-dir">@lang('site.password')</label>

                        <div class="col-md-6">
                            <input id="pass_log_id" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <i toggle="#password-field" class="far fa-eye pass_icon" id="toggle-password" ></i>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right font-weight-bold text-dir">@lang('site.confirm_password')</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <br>

                    <div class="form-group row mb-0"  style="justify-content: center;">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-danger">
                                @lang('site.signup')
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-----  ----->
    <!--- end  --->

@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>
 $("body").on('click', '#toggle-password', function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $("#pass_log_id");
  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }

});


        </script>

@endsection






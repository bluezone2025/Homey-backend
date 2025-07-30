@extends('layouts.front')
@section('title')
    @lang('site.home')

@endsection
@section('content')
    <!-----start  --->
    <div class="container-fluid pad-0 m-2">
        <h1 class="title text-center"> @lang('site.my_account') </h1>
    </div>

    <!-----  ----->
    <div class="container ">
        <br>
        <div class="row dir-rtl">
            <div class="col-lg-6 col-md-8" style="margin: auto">
                <div style="display: flex;justify-content: space-between;align-items: center;">
                    <h2> @lang('site.signin')</h2>

                    <a class="text main-color" href="{{route('register')}}" style="font-weight: bold">
                        @lang('site.create_acc')
                    </a>

                </div>
                <form method="POST" action="{{ route('login') }}" class="account " style="background: #e9ecef;">
                    @csrf

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right font-weight-bold">@lang('site.phone')</label>

                        <div class="col-md-6">
                            <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">@lang('site.password')</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    {{-- <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember"   id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div> --}}

{{--                    <div class="form-group row">--}}
{{--                        <div class="col-md-6 offset-md-4">--}}
{{--                            <div class="form-check">--}}
{{--                                <label class="form-check-label" for="forget_password">--}}
{{--                                    <a href="{{ route('forget.password.get') }}">@lang('site.forget_password')</a>--}}
{{--                                        </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <br>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">

                            <button type="submit" class="btn btn-danger" style="margin: auto;">
                                @lang('site.signin')
                            </button>


                                                            @if (Route::has('password.request'))
                                                                <a class="btn btn-link" href="{{ route('forget.password.get') }}">
                                                                    @lang('site.forget_password')
                                                                </a>
                                                            @endif

                        </div>
                    </div>
                </form>
{{--                <form >--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleInputEmail1">user name or email *</label>--}}
{{--                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleInputPassword1">password *</label>--}}
{{--                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="">--}}
{{--                    </div>--}}
{{--                    <div class="form-check">--}}
{{--                        <input type="checkbox" class="form-check-input" id="exampleCheck1">--}}
{{--                        <label class="form-check-label" for="exampleCheck1" style="padding-right: 20px"> Remember me--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                    <a class="float-right active" href="" data-target="#password"  data-toggle="modal">Forgot your password?</a>--}}
{{--                    <br><br>--}}
{{--                    <button type="submit" class="btn btn-dark">sign in</button>--}}
{{--                </form>--}}


            </div>
        </div>
    </div>
    <!-----  ----->
    <!--- end  --->

@endsection






{{--@extends('layouts.front')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}

{{--                <div class="card-header" style="text-align: center">{{ __('Login') }}</div>--}}

{{--                <div class="card-body" style="text-align: left;direction: ltr">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--<br>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--<br>--}}
{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember"   id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--<br>--}}
{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}

{{--                                <button type="submit" class="btn btn-primary" style="margin: auto;">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}


{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}

{{--                <div class="card-footer">--}}
{{--                    <a class="btn btn-success" href="{{route('register')}}">--}}
{{--                        Register--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}

@extends('layouts.layout2')
@section('title', 'Login')
@section('style')
    <style>
        select
        {
            border: 1px solid #888;
            color: #888;
            width: 100%;
            display: block;
        }
        .text-danger{
            color: #f00;
        }
        .is-invalid{
            border: 1px solid #f00;
        }
    </style>
@endsection

@section('content')

    <section class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-4 text-center mx-auto">
                    <div class="register-top d-flex justify-content-center">
                        <a href="#" class="linkTop active" data-link="one">@lang('site.log in')</a>
                        <span class="mx-4">|</span>
                        <a href="#" class="linkTop" data-link="two">{{__('site.Creat one')}}</a>
                    </div>
                </div>
                <div class="col-md-6 mx-auto rgister-hidden active" id="one">
                    <div class="regsiter-client">
                        <h3>{{__('site.Registered customers')}}</h3>
                        <p>{{__('site.If you have an account, sign in with your email address')}}</p>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('warning'))
                            <div class="alert alert-warning">
                                {{ session('warning') }}
                            </div>
                        @endif
                        @if (session('fails'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{!! \Session::get('fails') !!}</li>
                                </ul>
                            </div>
                        @endif
                        @isset($url)
                            <form class="mt-4" method="POST" action='{{ url(app()->getLocale()."/login/$url") }}' aria-label="{{ __('Login') }}">
                                @else
                                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                        @endisset
                                        @csrf
                            @if (session('error_login'))

                                <span class="text-danger">{{  session()->get('error_login') }}</span>
                            @endif
                            <input type="text" name="phone" placeholder="@lang('site.phone')" class="mb-4 @if ($errors->has('phone')) is-invalid @endif" value="{{old('phone')}}">

                            <input type="password" name="password" placeholder="@lang('site.password')" class="mb-4 @if ($errors->has('password')) is-invalid @endif">

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('forget.password.get') }}">{{__('site.Forget password?')}}</a>
{{--                                <a href="#">Don't have an account? Create a new one</a>--}}
                            </div>
                            <button type="submit" class="btn btn-primary mt-4" style="width: fit-content; background-color: #a88e31; color: #fff;">@lang('site.log in')</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 mx-auto rgister-hidden" id="two">
                    <div class="regsiter-client">
                        <h3>{{__('site.register')}}</h3>
                        <p>{{__('site.Personal Information')}}</p>
                        @if (Session::has('success-reg'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('success-reg') !!}</li>
                                </ul>
                            </div>
                        @endif
                        @if ($errors->any() && (Session::has('test') || !empty(Session::get('fail-reg')) ))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div id="error_message"></div>
                        @isset($url)
                            <form class="mt-4" method="POST" action='{{ url(app()->getLocale()."/register/$url") }}' aria-label="{{ __('Register') }}">
                                @else
                                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                                        @endisset
                                        @csrf
                                        <input placeholder="{{__('site.full name')}} " name="name" class="mb-4 @if ($errors->has('name')) is-invalid @endif" type="text">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                        <input placeholder="{{__('site.email')}}  " name="email" class="mb-4  @if ($errors->has('email')) is-invalid @endif" type="email">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                        <input placeholder="@lang('site.password') " name="password" class="mb-4 @if ($errors->has('password')) is-invalid @endif" minlength="6" type="password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                        <input placeholder="{{__('site.Phone')}} " name="phone" class="mb-4 @if ($errors->has('phone')) is-invalid @endif" type="text">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                        <select name="country" id="country" class=" @if ($errors->has('country')) is-invalid @endif" >
                                            <option value="" disabled selected>{{__('site.country')}}</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->{'name_'.app()->getLocale()} }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('country'))
                                            <span class="text-danger">{{ $errors->first('country') }}</span>
                                        @endif
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <a href="#">Already have an account? Login!</a>--}}
{{--                                <span style="text-align: right;">By creating an account, you agree to the--}}
{{--            <a href="terms-and-conditions.html">Terms & Conditions</a>--}}
{{--            and--}}
{{--            <a href="terms-and-conditions.html">Privacy Policy</a>--}}
{{--          </span>--}}
{{--                            </div>--}}
                            <button type="submit" class="btn btn-primary mt-4" style="width: fit-content; background-color: #a88e31; color: #fff;">{{__('site.register')}} </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

    @endsection
@section('js')
    <script src="{{asset('new_design')}}/js/register.js"></script>


@endsection

@extends('layouts.layout2')
@section('title', 'Login')
<style>
.form-control  {color:#fff !important}
</style>
@section('content')



<!--- --->
    <br><br>
<div class="sign w-50 text-center shadow pad-10">
  <br>
<h1> @lang('site.log in')</h1>
<h6><b>{{__('site.Registered customers')}}</b></h6>
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
  @if (Session::has('fails'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('fails') !!}</li>
        </ul>
    </div>
@endif
            @isset($url)
                <form method="POST" action='{{ url(app()->getLocale()."/login/$url") }}' aria-label="{{ __('Login') }}">
            @else
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @endisset
                    @csrf


                    <input placeholder="@lang('site.email')"  name="email" class="w-100 " type="email" value="{{old('email')}}">
                    <input placeholder="@lang('site.password') " name="password" class="w-100" minlength="6" type="password">
                    <button type="submit" class="btn w-100 btn-dark bg-main"> @lang('site.log in') </button><br><br>
                    <a href="{{ route('forget.password.get') }}" class="main-color" >{{__('site.Forget password?')}}</a><br><br>
                    <p>{{__('site.Do not have account yet')}} <a href="{{route('register/client')}}" class="main-color">{{__('site.Creat one')}}</a></p>

                </form>
                <br>
            </div>
            <br><br>

    @stop

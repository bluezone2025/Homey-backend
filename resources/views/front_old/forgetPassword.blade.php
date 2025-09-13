@extends('layouts.front')
@section('title', __('site.Forget password?'))
<style>
.form-control  {color:#fff !important}
</style>
@section('content')



<!--- --->
    <br><br>
<div class="sign w-50 text-center shadow pad-10">
  <br>
<h1> {{__('site.Forget password?')}}</h1>
 @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
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
                <form action="{{ route('forget.password.post') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="email_address" class="col-md-4 col-form-label text-md-right">@lang('site.email')</label>
                        <div class="col-md-6">
                            <input type="text" id="email_address" class="form-control text-dark" name="email" value="{{old('email')}}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn w-100 btn-dark bg-main"> @lang('site.Send Password Reset Link') </button>
                    <br><br>
                    <a href="{{route('login/client')}}" class="main-color" >@lang('site.log in')</a><br><br>
                    <p>{{__('site.Do not have account yet')}} <a href="{{route('register/client')}}" class="main-color">{{__('site.Creat one')}}</a></p>

                </form>
                <br>
            </div>
            <br><br>

    @stop

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
                <h1> {{__('site.Reset Password')}}</h1>
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
                <form action="{{ route('reset.password.post') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">{{__('site.email')}}</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control text-dark" name="email" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{__('site.password')}}</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control text-dark" name="password" required autofocus>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{__('site.Confirm Password')}}</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password-confirm" class="form-control text-dark" name="password_confirmation" required autofocus>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-dark bg-main">
                                        {{__('site.Reset Password')}}
                                    </button>
                                </div>

                </form>
                <br>
            </div>
            <br><br>

    @stop

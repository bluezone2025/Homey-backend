@extends('admin.masterAuth')

@section('content')
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">@lang('form.label.create new account')</h1>
                        <p class="signup-link register">@lang('form.label.have account')<a href="{{route('admin.login')}}">@lang('form.label.login')</a></p>

                        @include('admin.auth.form_register')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

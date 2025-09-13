@extends('student.masterAuth')

@section('content')
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">@lang('form.label.create new account')</h1>
                        <p class="signup-link register">@lang('form.label.have account')<a href="{{route('student.login')}}">@lang('form.label.login')</a></p>

                        @include('student.auth.form_register')

                        <div class="division mt-2">
                        </div>
                        <a  class="dropdown-item d-flex" href="{{route('student.lang.change' , 'ar')}}"><img width="25" src="{{asset('assets/images/flags/medium_kuwait.png')}}" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;Arabic</span></a>
                        <a class="dropdown-item d-flex" href="{{route('student.lang.change' , 'en')}}"><img  width="25" src="{{asset('assets/img/ca.png')}}" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;English</span></a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

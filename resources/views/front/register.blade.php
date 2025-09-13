 @extends('layouts.front')
@section('title', 'Register')

@section('style')

<style>

.custom-select.is-invalid:focus, .form-control.is-invalid:focus, .was-validated .custom-select:invalid:focus, .was-validated .form-control:invalid:focus {
    border-color: #dc3545  !important;
    box-shadow: 0 0 0 0.2rem rgb(220 53 69 / 25%)  !important;
}
.custom-select.is-invalid, .form-control.is-invalid, .was-validated .custom-select:invalid, .was-validated .form-control:invalid {
    border-color: #dc3545  !important;
}
</style>
@endsection
@section('content')


<!--- --->
<br><br>

<div class="sign w-50 text-center shadow pad-10">
<br>

<h1>{{__('site.register')}}</h1>
<h6><b>{{__('site.Personal Information')}}</b></h6>
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
    <form method="POST" action='{{ url(app()->getLocale()."/register/$url") }}' aria-label="{{ __('Register') }}">
    @else
    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
    @endisset
    @csrf
    <input placeholder="{{__('site.full name')}} " name="name" class="w-100 form-control @if ($errors->has('name')) is-invalid @endif" type="text">
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    <input placeholder="{{__('site.email')}}  " name="email" class="w-100 form-control  @if ($errors->has('name')) is-invalid @endif" type="email">
    @if ($errors->has('email'))
        <span class="text-danger">{{ $errors->first('email') }}</span>
    @endif
    <input placeholder="@lang('site.password') " name="password" class="w-100 form-control @if ($errors->has('password')) is-invalid @endif" minlength="6" type="password">
    @if ($errors->has('password'))
        <span class="text-danger">{{ $errors->first('password') }}</span>
    @endif
    <input placeholder="{{__('site.Phone')}} " name="phone" class="w-100 form-control @if ($errors->has('phone')) is-invalid @endif" type="text">
    @if ($errors->has('phone'))
        <span class="text-danger">{{ $errors->first('phone') }}</span>
    @endif
     <select name="country" id="country" class="w-100 custom-select @if ($errors->has('country')) is-invalid @endif" >
            <option value="" disabled selected>{{__('site.country')}}</option>
            @foreach($countries as $country)
            <option value="{{$country->id}}">{{$country->name_en}}</option>
                @endforeach
    </select>
    @if ($errors->has('country'))
        <span class="text-danger">{{ $errors->first('country') }}</span>
    @endif
        <br><br>
    <br>

<button type="submit" class="btn w-100 btn-dark bg-main">{{__('site.register')}} </button><br><br>
</form>
<p>{{__('site.Already have an account')}} <a href="{{route('login/client')}}" class="main-color">{{__('site.log in')}}</a></p>


<br>

</div>
<br><br>


 @stop

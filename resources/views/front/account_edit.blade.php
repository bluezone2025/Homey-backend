@extends('layouts.front')
@section('title', 'Edit account')
@section('content')


    <!--- --->
    <br><br>

    <div class="sign w-50 text-center shadow pad-10">
        <br>

        <h1>{{ __('site.Edit account') }}</h1>
        <h6><b>{{ __('site.Personal Information') }}</b></h6>
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


                    <form method="POST" action="{{route('account.update',$account->id)}}" aria-label="{{ __('site.Edit') }}">
                        @csrf
                        @method('put')

                        <input placeholder="{{__('site.full name')}} " name="name" class="w-100 " type="text" value="{{Auth::guard('web')->user()->name}}">
                        <input placeholder="{{__('site.email')}}" name="email" class="w-100 " type="email" value="{{Auth::guard('web')->user()->email}}">
                        <input placeholder="@lang('site.password') " name="password" class="w-100" minlength="6" type="password" >

                        <input placeholder="{{__('site.Phone')}} " name="phone" class="w-100 " type="text" value="{{Auth::guard('web')->user()->phone}}"><br>


                         <select name="country" id="country" class="w-100 " >
                            <option value="" disabled selected>{{__('site.country')}}</option>
                            @foreach($countries as $country)
                              <option value="{{$country->id}}" @if($country->id==Auth::guard('web')->user()->country_id){{'selected'}}@endif>{{$country->name}}</option>
                            @endforeach
                          </select>
                    <br><br>

                        <button type="submit" class="btn w-100 btn-dark bg-main">{{__('site.Edit')}} </button><br><br>
                    </form>


                    <br>

    </div>
    <br><br>


@stop

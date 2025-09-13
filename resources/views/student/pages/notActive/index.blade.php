
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>kocart easyshop</title>
    @include('student.includes.meta')
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/pages/coming-soon/style.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">
</head>
<body class="coming-soon">
@if (auth('student')->user()->is_active)
    <h2>@lang('form.label.products available')</h2>
    <a class="btn btn-danger d-block mt-2" href="{{route('student.home')}}">@lang('form.label.open site')</a>
@endif
<div class="coming-soon-container">
    <div class="coming-soon-cont">
        <div class="coming-soon-wrap">
            <div class="coming-soon-container">
                <div class="coming-soon-content">

                    <h4 class="text-center">@lang('form.label.message pending')</h4>

                    <a class="btn btn-danger d-block mt-2" href="{{route('student.logout')}}">@lang('form.label.logout')</a>

                </div>
            </div>
        </div>
    </div>
    <div class="coming-soon-image">
        <div class="l-image">
            <div class="img-content">
                <img src="{{asset('assets/images/pending.png')}}" alt="coming_soon">
            </div>
        </div>
    </div>
</div>


</body>
</html>

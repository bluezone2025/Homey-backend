<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    {{--<!-- Bootstrap 3.3.7 -->--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/skin-blue.min.css') }}">

    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome-rtl.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminLTE-rtl.min.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap-rtl.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/select2.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/rtl.css') }}">
        <link rel="stylesheet" href=" {{ asset('dashboard_files/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

        <style>
            body, h1, h2, h3, h4, h5, h6 ,label,span {
                font-family: 'Cairo', sans-serif !important;
            }

                .moha{
                    background:#fff;font-weight:bold;font-size:16px;-webkit-box-shadow: -1px 6px 40px -9px rgba(0,0,0,0.75);
-moz-box-shadow: -1px 6px 40px -9px rgba(0,0,0,0.75);
box-shadow: -1px 6px 40px -9px rgba(0,0,0,0.75);

                }
                thead{
                    background: #367FA9
                }
                thead > tr{
                    font-size: 16px;
                    color:#fff;
                }

                .f-16{
                    font-size: 16px;

                }



        </style>
    @else
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome.min.css') }}">
        <link rel="manifest" href="{{ asset('front/js/manifest.json') }}">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminLTE.min.css') }}">
    @endif

    <style>
        .mr-2{
            margin-right: 5px;
        }

        .loader {
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #367FA9;
            width: 60px;
            height: 60px;
            -webkit-animation: spin 1s linear infinite; /* Safari */
            animation: spin 1s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }


        .moha{
                    background:rgb(37, 37, 37);font-weight:bold;font-size:16px;-webkit-box-shadow: -1px 6px 40px -9px rgba(0,0,0,0.75);
-moz-box-shadow: -1px 6px 40px -9px rgba(0,0,0,0.75);
box-shadow: -1px 6px 40px -9px rgba(0,0,0,0.75);

                }
                thead{
                    background: #367FA9
                }
                thead > tr{
                    font-size: 16px;
                    color:#fff;
                }

                .f-16{
                    font-size: 16px;

                }


    </style>

    {{--<!-- jQuery 3 -->--}}
    <script src="{{ asset('dashboard_files/js/jquery.min.js') }}"></script>

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/noty/noty.css') }}">
    <script src="{{ asset('dashboard_files/plugins/noty/noty.min.js') }}"></script>

    {{--morris--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/morris/morris.css') }}">

    {{--<!-- iCheck -->--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/icheck/all.css') }}">


    {{--html in  ie--}}
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

    <header class="main-header">

        {{--<!-- Logo -->--}}
        <a href="" class="logo">
            {{--<!-- mini logo for sidebar mini 50x50 pixels -->--}}
            <span class="logo-mini">admin</span>
            <span class="logo-lg"><span style="font-weight: bold">   @lang("KOCART")
             </span></span>
        </a>

        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li class="dropdown tasks-menu" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag-o"></i></a>
                        <ul class="dropdown-menu">
                            <li  style="background: #000">
                                {{--<!-- inner menu: contains the actual data -->--}}
                                <ul class="menu">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li>
                                            <a style="color: red" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>



 <!-- 
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <i class="fa fa-envelope-o"></i>
      <span class="label label-success">4</span>
    </a>
  
  </li>

  <li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <i class="fa fa-bell-o"></i>
      <span class="label label-warning">۱۰</span>
    </a>
    <ul class="dropdown-menu">
      <li class="header">لديك 10  طلبات جديدة</li>
      <li>
      
      </li>
      <li class="footer "><a href="#"> <button class="btn btn-success">الذهاب الي الطلبات</button> </a></li>
    </ul>
  </li>
-->
<li class="dropdown messages-menu">
 
  <li class="dropdown user user-menu">
    
  <a href="{{ route('user_logout') }}"  >
      @lang('site.logout')
  </a>   
    <ul class="dropdown-menu">
      <!-- User image -->
      <li class="user-header">
        <img src="{{ asset('avatar.png') }}" class="img-circle" alt="User Image">
        <p>
        {{ request()->user()->name }} <br>   {{ request()->user()->email }}
        </p>
      </li>
      
      
      <!-- Menu Body
      <li class="user-body">
        <div class="col-xs-4 text-center">
          <a href="#">Followers</a>
        </div>
        <div class="col-xs-4 text-center">
          <a href="#">Sales</a>
        </div>
        <div class="col-xs-4 text-center">
          <a href="#">Friends</a>
        </div>
      </li>
      <!-- Menu Footer-->

    </ul>
  </li>
 
                </ul>
            </div>
        </nav>

    </header>

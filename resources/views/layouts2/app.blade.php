<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AbatiSakbah') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@include('sweetalert::alert')

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'AbatiSakbah') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    @lang('site.home')
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    @lang('site.managers')

                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    @lang('site.banners')

                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    @lang('site.pages')

                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    @lang('site.basic_categories')

                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    @lang('site.cats')

                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    @lang('site.products')

                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    @lang('site.orders')

                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
العملاء
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
الدول
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    العملات
                                </a>
                            </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('sliders.index')}}">
                                        البانر
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('sliders.index')}}">
                                        المقاسات
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('sliders.index')}}">
                                        الاطوال
                                    </a>
                                </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    الإعدادات
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>


                            <li class="nav-item dropdown">
                                <a id="navbarDropdownLang" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   اللغه
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLang">

                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                                    <a  class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>

                    @endforeach
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

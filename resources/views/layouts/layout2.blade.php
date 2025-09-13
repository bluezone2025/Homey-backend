<!doctype html>
<html lang="ar">
<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
      <meta name="_token" content="{{ csrf_token() }}">


    <title> @yield('title')</title>
    <!-- Favicons -->
    <!-- <link rel="icon" href="images/favicon.jpg"> -->
    <link rel="icon" type="image/png" href="{{asset('assets/design')}}/images/favicon.ico">

    <!-- Css files -->
    <link rel="stylesheet" href="{{asset('new_design')}}/css/libs/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="{{asset('new_design')}}/css/libs/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{asset('new_design')}}/css/libs/owl.theme.default.min.css" />
    <link rel="stylesheet" href="{{asset('new_design')}}/css/libs/all.min.css" />

    @if(app()->getLocale()=="ar")
        <link rel="stylesheet" href="{{asset('new_design')}}/css/ar/style.css" />
    @else
        <link rel="stylesheet" href="{{asset('new_design')}}/css/en/style.css" />

    @endif
    <link rel="stylesheet" href="{{asset('new_design')}}/css/main.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>



    <style>
        @font-face  {
            font-family:  "Font Awesome 6 Brands";
            font-style:  normal;
            font-weight:  400;
            font-display:  block;
            src:  url( '{{asset('new_design/webfonts/fa-brands-400.woff2')}}' ) format("woff2")
            ,  url('{{asset('new_design/webfonts/fa-brands-400.ttf')}}') format("truetype")
        }


        :host,  :root  {
            --fa-font-regular:  normal 400 1em/1 "Font Awesome 6 Free" }
        @font-face  {
            font-family:  "Font Awesome 6 Free";
            font-style:  normal;
            font-weight:  400;
            font-display:  block;
            src:  url( '{{asset('new_design/webfonts/fa-regular-400.woff2')}}' ) format("woff2")
            ,  url('{{asset('new_design/webfonts/fa-regular-400.ttf')}}') format("truetype")
        }
        .fa-regular,  .far  {
            font-weight:  400 }
        :host,  :root  {
            --fa-style-family-classic:  "Font Awesome 6 Free";
            --fa-font-solid:  normal 900 1em/1 "Font Awesome 6 Free" }
        @font-face {
            font-family: "Font Awesome 6 Free";
            font-style: normal;
            font-weight: 900;
            font-display: block;
            src: url('{{asset('new_design/webfonts/fa-solid-900.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-solid-900.ttf')}}') format("truetype")
        }
        .fa-solid,  .fas  {
            font-weight:  900 }
        @font-face  {
            font-family:  "Font Awesome 5 Brands";
            font-display:  block;
            font-weight:  400;
            src: url('{{asset('new_design/webfonts/fa-brands-400.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-brands-400.ttf')}}') format("truetype")
        }

        @font-face  {
            font-family:  "Font Awesome 5 Free";
            font-display:  block;
            font-weight:  900;
            src: url('{{asset('new_design/webfonts/fa-solid-900.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-solid-900.ttf')}}') format("truetype")
        }
        @font-face  {
            font-family:  "Font Awesome 5 Free";
            font-display:  block;
            font-weight:  400;
            src: url('{{asset('new_design/webfonts/fa-regular-400.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-regular-400.ttf')}}') format("truetype")
        }
        @font-face  {
            font-family:  "FontAwesome";
            font-display:  block;
            src: url('{{asset('new_design/webfonts/fa-solid-900.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-solid-900.ttf')}}') format("truetype")
        }
        @font-face  {
            font-family:  "FontAwesome";
            font-display:  block;
            src: url('{{asset('new_design/webfonts/fa-brands-400.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-brands-400.ttf')}}') format("truetype")
        }
        @font-face  {
            font-family:  "FontAwesome";
            font-display:  block;
            src: url('{{asset('new_design/webfonts/fa-regular-400.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-regular-400.ttf')}}') format("truetype");
            unicode-range:  u+f003,  u+f006,  u+f014,  u+f016-f017,  u+f01a-f01b,  u+f01d,  u+f022,  u+f03e,  u+f044,  u+f046,  u+f05c-f05d,  u+f06e,  u+f070,  u+f087-f088,  u+f08a,  u+f094,  u+f096-f097,  u+f09d,  u+f0a0,  u+f0a2,  u+f0a4-f0a7,  u+f0c5,  u+f0c7,  u+f0e5-f0e6,  u+f0eb,  u+f0f6-f0f8,  u+f10c,  u+f114-f115,  u+f118-f11a,  u+f11c-f11d,  u+f133,  u+f147,  u+f14e,  u+f150-f152,  u+f185-f186,  u+f18e,  u+f190-f192,  u+f196,  u+f1c1-f1c9,  u+f1d9,  u+f1db,  u+f1e3,  u+f1ea,  u+f1f7,  u+f1f9,  u+f20a,  u+f247-f248,  u+f24a,  u+f24d,  u+f255-f25b,  u+f25d,  u+f271-f274,  u+f278,  u+f27b,  u+f28c,  u+f28e,  u+f29c,  u+f2b5,  u+f2b7,  u+f2ba,  u+f2bc,  u+f2be,  u+f2c0-f2c1,  u+f2c3,  u+f2d0,  u+f2d2,  u+f2d4,  u+f2dc

        }
        @font-face  {
            font-family:  "FontAwesome";
            font-display:  block;
            src: url('{{asset('new_design/webfonts/fa-v4compatibility.woff2')}}') format("woff2"),
            url('{{asset('new_design/webfonts/fa-v4compatibility.ttf')}}') format("truetype");
            unicode-range:  u+f041,  u+f047,  u+f065-f066,  u+f07d-f07e,  u+f080,  u+f08b,  u+f08e,  u+f090,  u+f09a,  u+f0ac,  u+f0ae,  u+f0b2,  u+f0d0,  u+f0d6,  u+f0e4,  u+f0ec,  u+f10a-f10b,  u+f123,  u+f13e,  u+f148-f149,  u+f14c,  u+f156,  u+f15e,  u+f160-f161,  u+f163,  u+f175-f178,  u+f195,  u+f1f8,  u+f219,  u+f27a
        }


        @font-face { font-family: ArbFONTS; src: url('{{asset('new_design/ArbFonts.com/ArbFONTS-Somar-Regular.otf')}}'); }
        @font-face { font-family: ArbFONTS-B; font-weight: bold; src: url('{{asset('new_design/ArbFonts.com/ArbFONTS-Somar-Bold.otf')}}');}

    </style>


    @yield('style')

</head>
<body>


<header>
    <div class="container-fluid">
        <div class="row justify-content-between text-center">
            <div class="col-lg-6 col-3">
                <div class="d-flex align-items-center">
                    <a href="{{route('home')}}" class="logo">
                        <img src="{{asset('new_design')}}/images/logo.png" alt="" />
                    </a>
                    <ul class="nav d-flex d-none d-md-flex">
                        <li>
                            <a href="{{ route('brands', ['type' => 2]) }}">@lang('site.famous')</a>
                        </li>
                        <li>
                            <a href="{{ route('brands', ['type' => 3]) }}">@lang('site.brands')</a>
                        </li>
                        <li>
                            <a href="{{route('productByType','bestProducts') }}">@lang('site.best')</a>
                        </li>
                        <li>
                            <a href="{{route('productByType','recommendedProducts') }}">@lang('site.recommended')</a>
                        </li>
                        <li>
                            <a href="{{route('productByType','offers') }}">@lang('site.offers')</a>
                        </li>

                        <li class="category-header">
                            <a href="#">@lang('site.categories')</a>

                            <ul class="nav d-flex">
                                @foreach($blue_zone_cats as $k=> $cat)
                                    @if($k==9 )
                                        @break
                                    @endif
                                    <li >
                                        <a
                                            href="{{route('vendor',$cat->id)}}">
                                            {{ $cat->name }}
                                        </a>

                                    </li>
                                @endforeach
                                @if(count($blue_zone_cats) > 9)
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" type="button" id="dropdownCategoryBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                            @lang('site.all_categories')
                                        </a>
                                        <ul id="dropdownCategoryContent"  class="dropdown-menu dropdown-menu-dark dropdown-category" aria-labelledby="dropdownMenuButton2">
                                            @foreach($blue_zone_cats as $k=> $cat)
                                                @if($k >= 9 )
                                                    <li><a class="dropdown-item active" href="{{ route('vendor',$cat->id) }}">{{ $cat->name }}</a></li>

                                                @endif
                                            @endforeach

                                        </ul>
                                    </div>
                                @endif
                            </ul>
                        </li>
                    </ul>
{{--                    <div class="bars d-md-none">--}}
{{--                        <i class="fas fa-stream"></i>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="col-lg-3 col-6 mx-auto form-search" >
                <div class="d-flex">
                    <div class="position-relative">
                        <form action="{{route('searching')}}">
                            <input style="@if(app()->getLocale()=='ar')font-size: 1.1rem @endif"
                                type="text"
                                name="search" class="open-search2"
                                placeholder="@lang('site.Search for products and brands')"
                                autocomplete="off" readonly
                            />
                            <a class="" class="open-search2">
                                <i class="fa-solid fa-magnifying-glass search-ico open-search2 "></i>

                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-7 col-lg-3 col-3">
                <ul class="d-flex justify-content-end icons-cart">

                    <li class="language-item-list d-flex">
                        @if (app()->getLocale() == 'en')
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                @if ($localeCode == 'en')
                                    @continue
                                @endif

                                <a  rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    <img src="{{ asset('front/img/kuwait.png') }}" width="20">
                                </a>
                            @endforeach
                        @else
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                @if ($localeCode == 'ar')
                                    @continue
                                @endif

                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    <img src="{{ asset('front/img/en.png') }}" width="20"> </a>

                            @endforeach
                        @endif
                    </li>

                    <li>
                        @if(Auth::guard('web')->check())
                            <a href="{{route('account.index')}}">
                                <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.98626 12.4586C4.44059 12.4586 1.41376 12.9949 1.41376 15.1417C1.41376 17.2885 4.42134 17.844 7.98626 17.844C11.531 17.844 14.5588 17.3069 14.5588 15.161C14.5588 13.015 11.5503 12.4586 7.98626 12.4586V12.4586Z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.98626 9.39695C8.81952 9.39695 9.63406 9.14986 10.3269 8.68693C11.0197 8.224 11.5597 7.56602 11.8786 6.79619C12.1974 6.02637 12.2809 5.17928 12.1183 4.36203C11.9558 3.54479 11.5545 2.79411 10.9653 2.20491C10.3761 1.61571 9.62542 1.21446 8.80818 1.0519C7.99094 0.889341 7.14384 0.972773 6.37402 1.29164C5.60419 1.61052 4.94621 2.15051 4.48328 2.84333C4.02035 3.53616 3.77326 4.3507 3.77326 5.18395C3.76937 6.29726 4.20783 7.36653 4.99223 8.1566C5.77662 8.94667 6.8427 9.39282 7.95601 9.39695H7.98626Z" stroke="#fff" stroke-width="1.429" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        @else
                            <a href="{{route('login/client')}}">
                                <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.98626 12.4586C4.44059 12.4586 1.41376 12.9949 1.41376 15.1417C1.41376 17.2885 4.42134 17.844 7.98626 17.844C11.531 17.844 14.5588 17.3069 14.5588 15.161C14.5588 13.015 11.5503 12.4586 7.98626 12.4586V12.4586Z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.98626 9.39695C8.81952 9.39695 9.63406 9.14986 10.3269 8.68693C11.0197 8.224 11.5597 7.56602 11.8786 6.79619C12.1974 6.02637 12.2809 5.17928 12.1183 4.36203C11.9558 3.54479 11.5545 2.79411 10.9653 2.20491C10.3761 1.61571 9.62542 1.21446 8.80818 1.0519C7.99094 0.889341 7.14384 0.972773 6.37402 1.29164C5.60419 1.61052 4.94621 2.15051 4.48328 2.84333C4.02035 3.53616 3.77326 4.3507 3.77326 5.18395C3.76937 6.29726 4.20783 7.36653 4.99223 8.1566C5.77662 8.94667 6.8427 9.39282 7.95601 9.39695H7.98626Z" stroke="#fff" stroke-width="1.429" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        @endif
                    </li>
                    <li class="open-search"><svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                            <path d="M10.2793 17.8081C14.3294 17.8081 17.6127 14.5249 17.6127 10.4748C17.6127 6.42472 14.3294 3.14148 10.2793 3.14148C6.22923 3.14148 2.94598 6.42472 2.94598 10.4748C2.94598 14.5249 6.22923 17.8081 10.2793 17.8081Z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19.446 19.6414L15.4585 15.6539" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg></li>
                    <li class="d-none d-md-flex">
                        @if(Auth::guard('web')->check())
                            <a href="{{route('showWishlists',true)}}">
                                <svg width="20" height="19" viewBox="0 0 20 19" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.84141 1.07812C3.99636 1.35026 3.27306 1.77279 2.67149 2.3457C2.06993 2.9043 1.60444 3.55599 1.27501 4.30078C0.945581 5.04557 0.766545 5.85482 0.737899 6.72852C0.69493 7.60221 0.816675 8.47591 1.10313 9.34961C1.38959 10.166 1.76199 10.943 2.22032 11.6807C2.67865 12.4183 3.21576 13.0879 3.83165 13.6895C4.24701 14.1048 4.6767 14.4987 5.12071 14.8711C5.5504 15.2578 5.99441 15.6302 6.45274 15.9883C6.91108 16.3464 7.38373 16.6901 7.87071 17.0195C8.34337 17.349 8.83035 17.6712 9.33165 17.9863L9.54649 18.1152C9.66108 18.1725 9.77924 18.2012 9.90098 18.2012C10.0227 18.2012 10.1409 18.1725 10.2555 18.1152L10.4703 17.9863C10.9573 17.6712 11.4371 17.349 11.9098 17.0195C12.3968 16.6901 12.8694 16.3464 13.3277 15.9883C13.7861 15.6302 14.2301 15.265 14.6598 14.8926C15.1038 14.5059 15.5335 14.112 15.9488 13.7109C16.5647 13.0951 17.1054 12.4219 17.5709 11.6914C18.0364 10.9609 18.4052 10.1803 18.6774 9.34961C18.9638 8.47591 19.0856 7.60221 19.0426 6.72852C19.0139 5.85482 18.8349 5.04557 18.5055 4.30078C18.1761 3.55599 17.7106 2.9043 17.109 2.3457C16.5074 1.77279 15.7841 1.35026 14.9391 1.07812L14.7027 1.01367C13.9293 0.798828 13.1487 0.741537 12.3609 0.841797C11.5732 0.942057 10.8284 1.18555 10.1266 1.57227L9.89024 1.72266L9.65391 1.57227C8.92345 1.1569 8.13927 0.90625 7.30138 0.820312C6.46348 0.734375 5.6435 0.820312 4.84141 1.07812ZM9.31016 2.94727L9.50352 3.07617C9.61811 3.16211 9.74701 3.20508 9.89024 3.20508C10.0335 3.20508 10.1695 3.16211 10.2984 3.07617C10.9 2.61784 11.5768 2.32422 12.3287 2.19531C13.0807 2.06641 13.8147 2.11654 14.5309 2.3457C15.1897 2.56055 15.7483 2.88997 16.2066 3.33398C16.6793 3.778 17.041 4.2972 17.2916 4.8916C17.5423 5.486 17.6819 6.12695 17.7106 6.81445C17.7392 7.51628 17.6389 8.22526 17.4098 8.94141C17.1663 9.65755 16.8404 10.3379 16.4322 10.9824C16.024 11.627 15.555 12.2142 15.025 12.7441L14.5309 13.1953C13.8863 13.8112 13.2096 14.3913 12.5006 14.9355C11.7916 15.4798 11.0647 15.9954 10.3199 16.4824L9.89024 16.7402L10.0191 16.8262C9.07384 16.2533 8.16075 15.623 7.27989 14.9355C6.39903 14.248 5.55756 13.5176 4.75548 12.7441C4.22553 12.2142 3.75645 11.6234 3.34825 10.9717C2.94005 10.32 2.6142 9.63607 2.37071 8.91992C2.14154 8.2181 2.04128 7.51628 2.06993 6.81445C2.09858 6.12695 2.23822 5.486 2.48888 4.8916C2.73953 4.2972 3.10118 3.778 3.57384 3.33398C4.03217 2.88997 4.59076 2.56055 5.24962 2.3457C5.93712 2.13086 6.63894 2.07715 7.35509 2.18457C8.07123 2.29199 8.72293 2.54622 9.31016 2.94727ZM13.4352 4.45117C13.2633 4.39388 13.095 4.4082 12.9303 4.49414C12.7656 4.58008 12.6546 4.70898 12.5973 4.88086C12.54 5.05273 12.5543 5.22103 12.6402 5.38574C12.7262 5.55046 12.8551 5.66146 13.027 5.71875C13.3707 5.83333 13.6572 6.03385 13.8863 6.32031C14.1155 6.60677 14.2444 6.9362 14.2731 7.30859C14.2874 7.49479 14.3662 7.64518 14.5094 7.75977C14.6526 7.87435 14.8173 7.92448 15.0035 7.91016C15.1897 7.89583 15.3437 7.81706 15.4654 7.67383C15.5872 7.5306 15.6337 7.36589 15.6051 7.17969C15.5621 6.54948 15.3401 5.98372 14.9391 5.48242C14.538 4.98112 14.0367 4.63737 13.4352 4.45117Z" fill="#fff"></path>
                                </svg>
                            </a>
                        @else
                            <a href="{{route('login/client')}}">
                                <svg width="20" height="19" viewBox="0 0 20 19" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.84141 1.07812C3.99636 1.35026 3.27306 1.77279 2.67149 2.3457C2.06993 2.9043 1.60444 3.55599 1.27501 4.30078C0.945581 5.04557 0.766545 5.85482 0.737899 6.72852C0.69493 7.60221 0.816675 8.47591 1.10313 9.34961C1.38959 10.166 1.76199 10.943 2.22032 11.6807C2.67865 12.4183 3.21576 13.0879 3.83165 13.6895C4.24701 14.1048 4.6767 14.4987 5.12071 14.8711C5.5504 15.2578 5.99441 15.6302 6.45274 15.9883C6.91108 16.3464 7.38373 16.6901 7.87071 17.0195C8.34337 17.349 8.83035 17.6712 9.33165 17.9863L9.54649 18.1152C9.66108 18.1725 9.77924 18.2012 9.90098 18.2012C10.0227 18.2012 10.1409 18.1725 10.2555 18.1152L10.4703 17.9863C10.9573 17.6712 11.4371 17.349 11.9098 17.0195C12.3968 16.6901 12.8694 16.3464 13.3277 15.9883C13.7861 15.6302 14.2301 15.265 14.6598 14.8926C15.1038 14.5059 15.5335 14.112 15.9488 13.7109C16.5647 13.0951 17.1054 12.4219 17.5709 11.6914C18.0364 10.9609 18.4052 10.1803 18.6774 9.34961C18.9638 8.47591 19.0856 7.60221 19.0426 6.72852C19.0139 5.85482 18.8349 5.04557 18.5055 4.30078C18.1761 3.55599 17.7106 2.9043 17.109 2.3457C16.5074 1.77279 15.7841 1.35026 14.9391 1.07812L14.7027 1.01367C13.9293 0.798828 13.1487 0.741537 12.3609 0.841797C11.5732 0.942057 10.8284 1.18555 10.1266 1.57227L9.89024 1.72266L9.65391 1.57227C8.92345 1.1569 8.13927 0.90625 7.30138 0.820312C6.46348 0.734375 5.6435 0.820312 4.84141 1.07812ZM9.31016 2.94727L9.50352 3.07617C9.61811 3.16211 9.74701 3.20508 9.89024 3.20508C10.0335 3.20508 10.1695 3.16211 10.2984 3.07617C10.9 2.61784 11.5768 2.32422 12.3287 2.19531C13.0807 2.06641 13.8147 2.11654 14.5309 2.3457C15.1897 2.56055 15.7483 2.88997 16.2066 3.33398C16.6793 3.778 17.041 4.2972 17.2916 4.8916C17.5423 5.486 17.6819 6.12695 17.7106 6.81445C17.7392 7.51628 17.6389 8.22526 17.4098 8.94141C17.1663 9.65755 16.8404 10.3379 16.4322 10.9824C16.024 11.627 15.555 12.2142 15.025 12.7441L14.5309 13.1953C13.8863 13.8112 13.2096 14.3913 12.5006 14.9355C11.7916 15.4798 11.0647 15.9954 10.3199 16.4824L9.89024 16.7402L10.0191 16.8262C9.07384 16.2533 8.16075 15.623 7.27989 14.9355C6.39903 14.248 5.55756 13.5176 4.75548 12.7441C4.22553 12.2142 3.75645 11.6234 3.34825 10.9717C2.94005 10.32 2.6142 9.63607 2.37071 8.91992C2.14154 8.2181 2.04128 7.51628 2.06993 6.81445C2.09858 6.12695 2.23822 5.486 2.48888 4.8916C2.73953 4.2972 3.10118 3.778 3.57384 3.33398C4.03217 2.88997 4.59076 2.56055 5.24962 2.3457C5.93712 2.13086 6.63894 2.07715 7.35509 2.18457C8.07123 2.29199 8.72293 2.54622 9.31016 2.94727ZM13.4352 4.45117C13.2633 4.39388 13.095 4.4082 12.9303 4.49414C12.7656 4.58008 12.6546 4.70898 12.5973 4.88086C12.54 5.05273 12.5543 5.22103 12.6402 5.38574C12.7262 5.55046 12.8551 5.66146 13.027 5.71875C13.3707 5.83333 13.6572 6.03385 13.8863 6.32031C14.1155 6.60677 14.2444 6.9362 14.2731 7.30859C14.2874 7.49479 14.3662 7.64518 14.5094 7.75977C14.6526 7.87435 14.8173 7.92448 15.0035 7.91016C15.1897 7.89583 15.3437 7.81706 15.4654 7.67383C15.5872 7.5306 15.6337 7.36589 15.6051 7.17969C15.5621 6.54948 15.3401 5.98372 14.9391 5.48242C14.538 4.98112 14.0367 4.63737 13.4352 4.45117Z" fill="#fff"></path>
                                </svg>
                            </a>
                        @endif
                    </li>
                    <li class="shopping position-relative">
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.2085 4.19336H13.0151V4C12.9722 2.89714 12.5496 1.96615 11.7476 1.20703C10.9455 0.447916 9.993 0.0683594 8.89014 0.0683594C7.7443 0.0683594 6.77035 0.4694 5.96826 1.27148C5.16618 2.07357 4.76514 3.04753 4.76514 4.19336H4.57178C3.94157 4.19336 3.34717 4.30794 2.78857 4.53711C2.22998 4.7806 1.743 5.10645 1.32764 5.51465C0.912272 5.92285 0.590007 6.40625 0.36084 6.96484C0.11735 7.52344 -0.00439453 8.125 -0.00439453 8.76953V13.8184C-0.00439453 14.4486 0.11735 15.043 0.36084 15.6016C0.590007 16.1602 0.912272 16.6471 1.32764 17.0625C1.743 17.4779 2.22998 17.8001 2.78857 18.0293C3.34717 18.2728 3.94157 18.3945 4.57178 18.3945H13.2944C13.939 18.3945 14.5405 18.2728 15.0991 18.0293C15.6434 17.8001 16.1232 17.4779 16.5386 17.0625C16.9539 16.6471 17.2834 16.1602 17.5269 15.6016C17.756 15.043 17.8706 14.4486 17.8706 13.8184V8.76953C17.8706 8.15365 17.7489 7.56641 17.5054 7.00781C17.2619 6.44922 16.9289 5.96224 16.5063 5.54688C16.0838 5.13151 15.5861 4.80208 15.0132 4.55859C14.4403 4.3151 13.8387 4.19336 13.2085 4.19336ZM6.14014 4.08594C6.18311 3.35547 6.46956 2.74675 6.99951 2.25977C7.52946 1.77279 8.15967 1.5293 8.89014 1.5293C9.66357 1.5293 10.3153 1.79069 10.8452 2.31348C11.3752 2.83626 11.6401 3.49154 11.6401 4.2793H6.14014V4.08594ZM16.4956 13.8184C16.4956 14.6777 16.1805 15.4261 15.5503 16.0635C14.9201 16.7008 14.1681 17.0195 13.2944 17.0195H4.57178C3.7124 17.0195 2.96403 16.7008 2.32666 16.0635C1.68929 15.4261 1.37061 14.6777 1.37061 13.8184V8.76953C1.37061 7.89583 1.68929 7.14388 2.32666 6.51367C2.96403 5.88346 3.7124 5.56836 4.57178 5.56836H4.76514V7.11523C4.76514 7.30143 4.83675 7.44108 4.97998 7.53418C5.12321 7.62728 5.26644 7.67383 5.40967 7.67383C5.59587 7.7168 5.76416 7.66667 5.91455 7.52344C6.06494 7.38021 6.14014 7.2155 6.14014 7.0293V5.56836H11.6401V7.11523C11.6401 7.30143 11.7118 7.44108 11.855 7.53418C11.9982 7.62728 12.1414 7.67383 12.2847 7.67383C12.4709 7.67383 12.6392 7.60938 12.7896 7.48047C12.9399 7.35156 13.0151 7.17253 13.0151 6.94336V5.56836H13.2085C14.0679 5.56836 14.8162 5.88346 15.4536 6.51367C16.091 7.14388 16.4097 7.89583 16.4097 8.76953V13.8184H16.4956Z" fill="#fff"></path>
                        </svg>
                        <span class="cart-quantity">{{ (session('cart')  !== null )? count(session('cart')): 0  }}</span>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</header>
<div class="cart-overlay">
    <div class="cart-inner">
        <div class="cart-top">
            <span class="close">×</span>
            <h2>@lang('site.cart')</h2>
        </div>
        <div class="cart-product">
            <?php $price_c = 0; ?>
            @if(session('cart'))
                @foreach(session('cart') as $id => $detail)
                        @php
                            $product = \App\Models\Product::where('id', $detail['id'])->first();
                            $variant = isset($detail['variant_id']) ? \App\Models\ProductVariant::find($detail['variant_id']) : null;

                            // Get the correct price (variant price if exists, otherwise product price)
                            $price = $variant ? ($variant->discount_price ?: $variant->price) : ($product->final_sale_price>0 ? $product->final_sale_price : $product->final_regular_price);
                            $price_pr_c = $price * $detail['quantity'];
                            $price_c += $price_pr_c;

                            // Get variant attributes if exists
                            $variantAttributes = [];
                            if ($variant && isset($detail['attributes'])) {
                                $variantAttributes = $variant->combination;
                            }
                        @endphp

                        <div class="cart-items d-flex py-3">
                            <form action="{{ route('cart.remove') }}" method="get">
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="variant_id" value="{{ $variant->id ?? '' }}">
                                <button type="submit" title="delete" style="border: none;color: #fe3843;padding:0px;background: none; cursor: pointer;" class="btn btn-danger btn-sm">
                                    <span class="close-items" onclick="closeProducts(3,parentElement.parentElement)">×</span>
                                </button>
                            </form>
                            <a href="{{ route('product', $product->id) }}">
                                <img src="{{ asset('assets/images/products/min/'.$product->img) }}" class="me-4" />
                            </a>
                            <div class="cart-title  align-items-center">
                                <div class="cart-price mb-2">
                                    <div class="d-flex mb-2">
                                        <a href="{{ route('product', $product->id) }}" class="">{{ $product->name }}</a>

                                        <!-- Display variant attributes if exists -->
                                        @if($variant && $variantAttributes)
                                            <a class="variant-attributes  d-flex">
                                                    <span class="mx-1">-</span>
                                                @foreach($variantAttributes as $attr)
                                                    <span class="d-flex">
                                                        {{ $attr['opt'] }}
                                                    </span>
                                                    @if(!$loop->last)
                                                        <span class="mx-1">-</span>
                                                    @endif

                                                @endforeach
                                            </a>
                                        @endif
                                    </div>


                                    <p>
                                        <span>{{ get_price_helper($price, true) }}</span>
                                        <span>×</span>
                                        <span>{{ $detail['quantity'] ?? 1 }}</span>
                                    </p>
                                </div>
                                <div class="d-flex quantity-cart">
                                    <a id="{{ 'a_mun_'.$detail['id'].'_'.$id }}"
                                       {{ $detail['quantity'] >= 2 ? "onClick=update_cart(".$detail['id'].",".$price.",'minus',".$detail['id'].",".$id.",".($variant ? $variant->id : 'null').");" : "" }}
                                       data-id="{{ $product->id }}"
                                       class="mx-1 down position-absolute pos-fixed-left-center pl-2 z-index-2 {{ $detail['quantity'] >= 2 ? 'btn-minus' : 'btn-minus-des' }}">
                                        -
                                    </a>
                                    <input name="quantity"
                                           id="qty_{{ $detail['id'] }}_{{ $id }}"
                                           value="{{ $detail['quantity'] ?? 1 }}"
                                           type="number"
                                           class="quantity-input-cart form-control form-control-sm px-6 fs-16 text-center input-quality border-0 h-35px"
                                           min="1"
                                           required>
                                    <a onClick="update_cart('{{ $detail['id'] }}','{{ $price }}','plus','{{ $detail['id'] }}','{{ $id }}','{{ $variant ? $variant->id : '' }}');"
                                       class="mx-1 up position-absolute pos-fixed-right-center pr-2 z-index-2">
                                        +
                                    </a>
                                </div>
                            </div>
                        </div>
                @endforeach
            @else
                @lang('site.no_products')
            @endif
        </div>

        <div class="cart-total mt-3 d-flex justify-content-between">
            <p>@lang('site.total_price')</p>
            <p class="price">{{ get_price_helper($price_c ?? 0, true) }}</p>
        </div>
        <div class="cart-buttons mt-3 d-flex justify-content-between">
            <a href="{{ route('cart.show') }}" class="btn btn-black">@lang('site.cart')</a>
            <a href="{{ route('checkout') }}" class="btn btn-white ms-4">@lang('site.Confirm order')</a>
        </div>
    </div>
</div>

<div class="search-overlay ">
    <div class="search-inner ">
        <span class="close">×</span>
        <form action="{{route('searching')}}" class="position-relative">
            <input id="searchInput"
                type="text"
                name="search"
                placeholder="@lang('site.Search for products and brands')"
            />
            <button class="" type="submit">
                <i class="fa-solid fa-magnifying-glass search-ico"></i>

            </button>
        </form>
        <div class="row mb-4 mt-3" id="searchBrandsResults"></div>

        <div class="row" id="searchProductsResults"></div>
    </div>
</div>

<div class="mobile-footer">
    <div class="d-flex  justify-content-between align-items-center">
        <div class="tab active">
            <a href="{{route('home')}}">
                <i class="fas fa-solid fa-home"></i>
            </a>
            <p>

                <a href="{{route('home')}}">@lang('site.app_name')</a>
            </p>
        </div>

        <div class="tab">
            <a href="{{ route('brands', ['type' => 3]) }}">
                <i class="fas fa-solid fa-store"></i>
            </a>
            <p>
                <a href="{{ route('brands', ['type' => 3]) }}">@lang('site.brands')</a>
            </p>
        </div>

        <div class="tab">
            <a href="{{ route('vendors') }}">
                <i class="fas fa-stream"></i>
            </a>
            <p>
                <a href="{{ route('vendors') }}">@lang('site.categories')</a>
            </p>
        </div>
        @if(auth('web')->check())
            <div class="tab">
                <a href="{{ route('account.index') }}">
                    <i class="fas fa-user"></i>
                </a>
                <p>
                    <a href="{{ route('account.index') }}" >@lang('site.my_account')</a>
                </p>
            </div>
        @else
            <div class="tab">
                <a href="{{ route('login/client') }}">
                    <i class="fas fa-user"></i>
                </a>
                <p>
                    <a href="{{ route('login/client') }}" >@lang('site.my_account')</a>
                </p>
            </div>
        @endif

    </div>
</div>
<main id="content">
    @yield('content')
</main>

<section class="contact">
    <div class="container">
        <div class="row justify-content-center align-items-center py-5">
            <div class="col-md-8 social-links">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <ul class="contact-social d-flex">
                            @if(\App\Models\Icon::where('title','facebook')->first())
                            <li>
                                <a href="{{\App\Models\Icon::where('title','facebook')->first()->link }}"><i class="fa-brands fa-facebook-f"></i></a>
                            </li>
                            @endif
                            @if(\App\Models\Icon::where('title','instagram')->first())
                            <li>
                                <a href="{{\App\Models\Icon::where('title','instagram')->first()->link }}"><i class="fa-brands fa-instagram"></i></a>
                            </li>
                                @endif
                                @if(\App\Models\Icon::where('title','snapchat')->first())

                                <li class="final-contact-social">
                                <a href="{{\App\Models\Icon::where('title','snapchat')->first()->link }}"><i class="fab fa-snapchat"></i></a>
                               </li>
                                @endif
                        </ul>
                    </div>
                    <div class="col-md-6 mb-2">
                        <ul class="footer-payment">
                            <li>
                                <a href="#"
                                ><img
                                        src="https://trendatt.com/assets/design/images/icon-pay.png"
                                        alt=""
                                    /></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<footer style="background-color: #f9f9f1">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-6">
                <h3 class="mb-3 mt-2">@lang('site.our_data')</h3>
                <ul>
                    <li><a href="#">
                            <i class="fas fa-phone"></i>
                            {{\App\Models\Setting::where('name','phone')->first()->description }}
                        </a>
                    </li>
                    <li><a href="#">
                            <i class="fab fa-whatsapp"></i>
                            {{\App\Models\Setting::where('name','phone')->first()->description }}
                        </a>
                    </li>
                    <li><a href="#">
                            <i class="fas fa-envelope"></i>
                            {{\App\Models\Setting::where('name','email')->first()->description }}                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 col-6">
                <h3 class="mb-3 mt-2">@lang('site.pages')</h3>
                <ul>
                    <li ><a href="{{ route('home') }}" >@lang('site.index')</a></li>
                    <li><a href="{{route('front.info','PrivacyPolicy')}}" >@lang('site.privacy_policy')</a></li>
                    <li ><a href="{{route('front.info','TermsAndConditions')}}">@lang('site.terms_and_conditions')</a></li>

                </ul>
            </div>
            <div class="col-md-4 col-12">
                <h3 class="mb-3 mt-2">@lang('site.download_app')</h3>
                <ul class="d-md-block d-none">
                    <li ><a href="{{\App\Models\Setting::where('name','ios_url')->first()->value }}" >
                            <i class="fab fa-app-store-ios fs-20 "></i>
                            App Store
                        </a></li>
                    <li ><a href="{{\App\Models\Setting::where('name','android_url')->first()->value }}" >
                            <i class="fab fa-google-play fs-20"></i>
                            Google Play
                        </a></li>
                </ul>
                <div class="row d-md-none">
                  <div class="col-6">
                        <a href="{{\App\Models\Setting::where('name','ios_url')->first()->value }}" >
                                    <i class="fab fa-app-store-ios fs-20 "></i>
                                    App Store
                        </a>
                  </div>
                   <div class="col-6">
                        <a href="{{\App\Models\Setting::where('name','android_url')->first()->value }}" >
                            <i class="fab fa-google-play fs-20"></i>
                            Google Play
                        </a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="py-3" style="background-color: #f1f1f1">
    <div class="container">
        <div class="row text-center">
            <div class=" col-12">
                <p>2025 &copy; Trendat</p>
            </div>
        </div>
    </div>
</div>
<!-- Js files -->
<script src="{{asset('new_design')}}/js/libs/jquery-3.7.1.min.js"></script>
<script src="{{asset('new_design')}}/js/scripts.js"></script>
<script src="{{asset('new_design')}}/js/libs/owl.carousel.min.js"></script>
<script src="{{asset('new_design')}}/js/main.js"></script>
{{--<script src="{{asset('new_design')}}/js/recommended.js"></script>--}}


<!-- ✅ Wait until all images load -->

@include('sweetalert::alert')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>
@yield('js')
@if(session('keep_cart_open') && session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Immediately open overlay
    const overlay = document.querySelector('.cart-overlay');
    const inner = document.querySelector('.cart-inner');
    if (overlay && inner) {
        overlay.classList.add('active');
        inner.classList.add('active');
    }

    // 2. Wait a bit, then show success alert
    setTimeout(function() {
        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })
                    Toast.fire({
                        icon: 'success',
                        title: "{{ session()->get('success') }}",


                    })
    }, 300); // delay in ms before showing success
});
</script>
@endif


 @if(count($blue_zone_cats) > 9)
<script>
  const btn = document.getElementById('dropdownCategoryBtn');
  const content = document.getElementById('dropdownCategoryContent');

  btn.addEventListener('mouseenter', () => {
    content.style.display = 'block';
  });

  btn.addEventListener('mouseleave', () => {
    // use timeout to prevent flicker when moving to the content
    setTimeout(() => {
      if (!content.matches(':hover')) {
        content.style.display = 'none';
      }
    }, 200);
  });

  content.addEventListener('mouseleave', () => {
    content.style.display = 'none';
  });

  content.addEventListener('mouseenter', () => {
    content.style.display = 'block';
  });
</script>

@endif

<script>

     $(document).on('click', '.addToWishlist', function(e) {

            e.preventDefault();

            const productId=$(this).attr('data-product-id');

            console.log(productId);
            


            $.ajax({
                type: 'get',
                url: "{{ route('wishlist.store') }}",
                data: {
                    'productId': $(this).attr('data-product-id'),
                },
                success: function(data) {
                    if (data.status == 'success') {

                     const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })
                    Toast.fire({
                        icon: 'success',
                        title: data.message,


                    })
                   $('a[data-product-id="' + productId + '"]').html(`
                        <svg class="favProd" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ff0000" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                            <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1"/>
                        </svg>
                    `);


                    //$('a[data-product-id="' + productId + '"] svg path').attr('fill', '#ff0000');

                    

                    } else {
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })
                    Toast.fire({
                        icon: 'error',
                        title: data.message,


                    })
                    }

                }
            });


        });
</script>

@if (session('error_login'))


    <script>

        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })
                    Toast.fire({
                        icon: 'error',
                        title: "{{ session()->get('error_login') }}",


                    })
    </script>
@endif
@if (session('success_login'))


    <script>
        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })
                    Toast.fire({
                        icon: 'success',
                        title: "{{ session()->get('success_login') }}",


                    })
    </script>
@endif
@if (session('error'))

    <script>
       const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })
                    Toast.fire({
                        icon: 'error',
                        title: "{{ session()->get('error') }}",


                    })
    </script>
@endif
@if (!session('keep_cart_open') && session('success'))

    <script>
       const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })
                    Toast.fire({
                        icon: 'success',
                        title: "{{ session()->get('success') }}",


                    })
    </script>
@endif
<script>



    function update_cart(product_id, price, type, id, key, variant_id = null) {
        let quantity = parseInt($('#qty_' + id + '_' + key).val());

        if (type == 'plus') {
            quantity = quantity + 1;
        } else if (type == 'minus') {
            quantity = quantity - 1;
        }

        $.ajax({
            url: "{{ route('cart.update') }}",
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                id: product_id,
                variant_id: variant_id,
                quantity: quantity,
                key: key
            },
            success: function(response) {
                if (response.success == true) {
                    // Update the quantity in the input field
                    $('#qty_' + id + '_' + key).val(quantity);

                    // Update the minus button state
                    if (quantity <= 1) {
                        $('#a_mun_' + id + '_' + key).removeClass('btn-minus').addClass('btn-minus-des');
                        $('#a_mun_' + id + '_' + key).removeAttr('onclick');
                    } else {
                        $('#a_mun_' + id + '_' + key).addClass('btn-minus').removeClass('btn-minus-des');
                        $('#a_mun_' + id + '_' + key).attr('onclick', `update_cart(${product_id},${price},'minus',${id},${key},${variant_id ? variant_id : 'null'})`);
                    }

                    // Update total price
                    $('.cart-total .price').text(response.formatted_total);

                    // Update cart count in header
                    $('.cart-count').text(response.cart_count);
                }else if(response.success == false){
                    //alert('ss')
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })
                        Toast.fire({
                            icon: 'error',
                            title: response.message,
                    })
                }
            }
        });
    }




</script>


<script>
    let isResizeTopAdded = false;
    let isResizeTop2Added = false;
    let isResizeTop3Added = false;

    let debounceTimer;

    const searchInput = document.getElementById('searchInput');
    const products = document.getElementById('searchProductsResults');
    const brands = document.getElementById('searchBrandsResults');

    function adjustSearchTop() {
        const activeBox = $('.search-inner.active');

        if (window.innerWidth >= 1200 && window.innerWidth < 1400) {
            activeBox.css('top', '52%');
        } else if (window.innerWidth >= 1500) {
            activeBox.css('top', '48%');
        } else if (window.innerWidth <= 600) {
            activeBox.css('top', '54%');
        }
    }

    function adjustSearchTop2() {
        const activeBox = $('.search-inner.active');

        if (window.innerWidth >= 1200 && window.innerWidth < 1400) {
            activeBox.css('top', '35%');
        } else if (window.innerWidth >= 1500) {
            activeBox.css('top', '20%');
        } else if (window.innerWidth <= 600) {
            activeBox.css('top', '27%');
        }
    }
     function adjustSearchTop3() {
        const activeBox = $('.search-inner.active');

        if (window.innerWidth >= 1200 && window.innerWidth < 1400) {
            activeBox.css('top', '52%');
        } else if (window.innerWidth >= 1500) {
            activeBox.css('top', '29%');
        } else if (window.innerWidth <= 600) {
            activeBox.css('top', '38%');
        }
    }

    searchInput.addEventListener('input', function () {
        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(function () {
            const val = searchInput.value.trim();

            if (val.length < 1) {
                products.innerHTML = '';
                brands.innerHTML = '';
                adjustSearchTop2();

                if (!isResizeTop2Added) {
                    window.addEventListener('resize', adjustSearchTop2);
                    isResizeTop2Added = true;
                }

                return;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('searchAjax') }}",
                method: 'post',
                data: { search: val },
                success: function (result) {
                    if (result.status === 'success') {
                        console.log('brands:', result.brands.length, 'products:', result.products.length);

                         if(result.brands.length === 0 && result.products.length === 0){
                            adjustSearchTop2();
                            if (!isResizeTop2Added) {
                                window.addEventListener('resize', adjustSearchTop2);
                                isResizeTop2Added = true;
                            }
                        }
                        else if ( (result.brands.length === 0 && result.products.length<7) || (result.products.length === 0 && result.brands.length<7) ) {
                            adjustSearchTop3();
                            if (!isResizeTop3Added) {
                                window.addEventListener('resize', adjustSearchTop3);
                                isResizeTop3Added = true;
                            }
                        }
                        
                         else {
                            adjustSearchTop();
                            if (!isResizeTopAdded) {
                                window.addEventListener('resize', adjustSearchTop);
                                isResizeTopAdded = true;
                            }
                        }

                        // Fill brands
                        brands.innerHTML = `<div class="col-12"><h3 class="text-center mb-3">${result.brands_title}</h3></div>`;
                        result.brands.forEach(brand => {
                            brands.innerHTML += `
                                <div class="col-lg-2 col-6 mb-3">
                                    <a href="${brand.url}" style="width: 95%; margin:auto;">
                                        <img class="search_item_img" src="${brand.image}" alt="${brand.name}">
                                        <div class="text-center mt-2">${brand.name}</div>
                                    </a>
                                </div>
                            `;
                        });

                        // Fill products
                        products.innerHTML = `<div class="col-12"><h3 class="text-center mb-3">${result.products_title}</h3></div>`;
                        result.products.forEach(product => {
                            products.innerHTML += `
                                <div class="col-lg-2 col-6 mb-3">
                                    <a href="${product.url}" style="width: 95%; margin:auto;">
                                        <img class="search_item_img" src="${product.image}" alt="${product.name}">
                                        <div class="text-center mt-2">${product.name}</div>
                                    </a>
                                </div>
                            `;
                        });
                    }
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }, 400);
    });
</script>

<script>
    window.addEventListener('pageshow', function (event) {
    if (event.persisted || window.performance.navigation.type === 2) {
        window.location.reload();
    }
});
if (sessionStorage.getItem('cartUpdated')) {
    window.location.reload();
    sessionStorage.removeItem('cartUpdated');
}

</script>





<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

</body>
</html>

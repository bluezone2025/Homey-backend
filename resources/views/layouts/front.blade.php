<html lang="{{app()->getlocale()}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/main-style.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/media.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/carousel.css')}}">
    <meta name="google-site-verification" content="wLIaeYETirTnl55HvIJ9w9BxTpaE92F3bVbx7q3Xf8I" />
    {{--    <link--}}
    {{--        rel="stylesheet"--}}
    {{--        href="https://unpkg.com/swiper/swiper-bundle.min.css"--}}
    {{--    />--}}
    <link rel="shortcut icon" href="{{asset('new_front/img/logo/logo.png')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet">

    <!--------------   start new front styles ----------------------------->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{asset('new_front/css/swiper-bundle.css')}}">

    <link rel="stylesheet" href="{{asset('new_front/css/style.css')}}">

    <!--------------   end new front styles ----------------------------->

    {{--
    <!-- Global site tag (gtag.js) - Google Ads: 10927707723 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10927707723"></script>
    <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());
              gtag('config', 'AW-10927707723');
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-8B8TEKRBMG">
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-8B8TEKRBMG');
    </script>

    --}}

    <style>
        body{
            font-family: 'ArbFONTS', sans-serif !important;
        }
        .ads_header img.d-block.img-ads {
            height: 110px !important;
        }
        .col-lg-3.col-sm-6.col-6 {
            padding: 0;
        }
        .green-bg{
            background-color: var(--bs-primary-green) !important;
        }
        .white{
            color: white !important;
        }
        .bottom_footer{
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 5px #077174;
            width: 100%;
            padding-top: 15px;
            padding-bottom: 20px;
            padding-left: 10px;
        }
        img.footer-icon{
            border: 1px solid white;
        }
        footer.bg-b {
            color: rgb(0, 0, 0);
            background: linear-gradient(to left, #ffffff 60% , #ffffff) !important;
        }
        footer.bg-b a {
            color: rgb(0, 0, 0) !important;
        }
        footer h5{
            color: #fff
        }
        a.dropdown-item.top-slide {
            color: #141515 !important;
        }
        .row.payment_img {
            width: 100% !important;
        }

        .mzkbtn {
            width: 100%;
            /* -webkit-animation: glowing 1500ms infinite; */
            -moz-animation: glowing 1500ms infinite;
            -o-animation: glowing 1500ms infinite;
            /* animation: glowing 1500ms infinite; */
        }
        .mzkbtn {
            color: #ffffff !important;
            background-color: var(--bs-primary-green);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            text-transform: none;
            font-family: inherit;
            word-spacing: 2px;
            letter-spacing: 1px;
        }
        .mzkbtn{
            /*margin-left: 600px;*/
            /*width:100%;*/
            -webkit-animation: glowing 1500ms infinite;
            -moz-animation: glowing 1500ms infinite;
            -o-animation: glowing 1500ms infinite;
            animation: glowing 1500ms infinite;
        }
        @-webkit-keyframes glowing {
            0% { background-color: var(--bs-primary-green); -webkit-box-shadow: 0 0 3px #B20000; }
            50% { background-color: var(--bs-primary-green); -webkit-box-shadow: 0 0 40px #FF0000; }
            100% { background-color: var(--bs-primary-green); -webkit-box-shadow: 0 0 3px #B20000; }
        }
        @-moz-keyframes glowing {
            0% { background-color:var(--bs-primary-green); -moz-box-shadow: 0 0 3px #B20000; }
            50% { background-color: var(--bs-primary-green); -moz-box-shadow: 0 0 40px #FF0000; }
            100% { background-color: var(--bs-primary-green); -moz-box-shadow: 0 0 3px #B20000; }
        }
        @-o-keyframes glowing {
            0% { background-color: var(--bs-primary-green); box-shadow: 0 0 3px #B20000; }
            50% { background-color: var(--bs-primary-green); box-shadow: 0 0 40px #FF0000; }
            100% { background-color: var(--bs-primary-green); box-shadow: 0 0 3px #B20000; }
        }
        @keyframes glowing {
            0% { background-color: var(--bs-primary-green); box-shadow: 0 0 3px var(--bs-primary-green); }
            50% { background-color:var(--bs-primary-green); box-shadow: 0 0 40px var(--bs-primary-green); }
            100% { background-color: var(--bs-primary-green); box-shadow: 0 0 3px var(--bs-primary-green); }
        }


        .mzkbtn:hover {
            color: var(--bs-primary-green) !important;
            background: #fff !important;
        }

        .icon-mob-down {
            color: #ffffff !important;
            background-color: #000 !important;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            text-transform: none;
            font-family: inherit;
            word-spacing: 2px;
            letter-spacing: 1px;
            border-radius: 50%;
            padding:5px !important;

            font-size:50px !important;
        }
        .icon-mob-down{
            -webkit-animation: glowing2 1500ms infinite;
            -moz-animation: glowing2 1500ms infinite;
            -o-animation: glowing2 1500ms infinite;
            animation: glowing2 1500ms infinite;
        }
        @-webkit-keyframes glowing2 {
            0% { background-color: #000; -webkit-box-shadow: 0 0 3px var(--bs-secondary-red); }
            50% { background-color: #000; -webkit-box-shadow: 0 0 40px var(--bs-primary-red); }
            100% { background-color: #000; -webkit-box-shadow: 0 0 3px var(--bs-secondary-red); }
        }
        @-moz-keyframes glowing2 {
            0% { background-color: #000; -moz-box-shadow: 0 0 3px var(--bs-secondary-red); }
            50% { background-color: #000; -moz-box-shadow: 0 0 40px var(--bs-primary-red); }
            100% { background-color: #000; -moz-box-shadow: 0 0 3px var(--bs-secondary-red); }
        }
        @-o-keyframes glowing2 {
            0% { background-color: #000; box-shadow: 0 0 3px var(--bs-secondary-red); }
            50% { background-color: #000; box-shadow: 0 0 40px var(--bs-primary-red); }
            100% { background-color: #000; box-shadow: 0 0 3px var(--bs-secondary-red); }
        }
        @keyframes glowing2 {
            0% { background-color: #000; box-shadow: 0 0 3px #000; }
            50% { background-color: #000; box-shadow: 0 0 40px #000; }
            100% { background-color: #000; box-shadow: 0 0 3px #000; }
        }

        .icon-mob-down:hover {

            color: #000 !important;
            background: var(--bs-primary-green) !important;
        }
        footer li.nav-item.p-1 {
            background: none !important;
        }



        @media (max-width: 700px){

            .card .is_order {
                left: 0px !important;
                top: 0px !important;
                bottom: 0 !important;
            }

            .card {
                padding-bottom: 26px !important;
            }


        }
        @media (min-width: 351px) and (max-width: 500px){


            .swiper-pagination-bullet{
                display: inline-block !important;
            }
            .brands-div .swiper-container {
                margin-top: 5px;
            }
            .custom-h-brand {
                height: 20vh!important;
            }
            .h-resp {
                height: 100% !important;
                overflow: hidden;
            }
            .h-resp img {
                height: 250px !important;
            }
        }
        @media (min-width: 0px) and (max-width: 350px) {
            .card .is_order{
                font-size: x-small !important;
                padding: 5px !important;
                margin-right: 60px;
            }

        }
        .card .is_order {
            position: absolute;
            left: 0;
            top: 0;
            height: 29px;
            font-size: small !important;
            padding: 7px !important;
            color: #fff;
            background-color: var(--bs-primary-green);
            border-bottom-right-radius: 10px;
        }
        .header-dark {
            background: linear-gradient(to right,#ffffff,#ffffff);
        }
        .nav_div_hed-account {
            margin: 0 -65px;
        }
        .nav_div_hed-cart {
            margin: 0 -65px;
        }

        ul.nav.navbar-nav.w-90.p-0 {
            width: 60%;
            margin: 0 40Px 0 0 !important;

        }
        li.nav-item.w-90.row.li-col {
            background-color: #fff;
        }
        @media (max-width: 768px){
            .li-a-col {
                margin: 2px;
                padding: 0;
                border: none !important;
            }
        }

        #nav_div>div {
            background-color: var(--bs-primary-green);
        }
        .nav_div_hed sup#cart_counter {
            top: -18px;
            left: -25px;
            color: var(--bs-primary-red)!important;
            font-size: 15px !important;
            font-weight: bold;
        }
        .mobile-list{
            list-style-type: none !important;

        }
        .mobile-link{
            color: var(--bs-primary-green) !important;
        }
        .mobile-link:hover{
            color: var(--bs-secondary-red); !important;
        }

        .text-decoration-none{
            text-decoration: none !important;
        }
        .list-item:hover{
            color: var(--bs-primary-green) !important;
            text-decoration: var(--bs-primary-green) !important;
        }
        .nav-link {
            padding: 0.1rem 1rem;
        }
        .mobile-link {
            color: #000 !important;
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10927707723"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-10927707723');
    </script>

    <!-- Event snippet for اضف لسله التسوق conversion page -->
    <script>
        gtag('event', 'conversion', {'send_to': 'AW-11381103511/Rl2nCPj9oYgZEJe397Iq'});
    </script>



    <title>@yield('title')</title>
@yield('style')
<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-230749144-1">
    </script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-230749144-1');
    </script>
    <!-- Meta Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '1179190483014864');
      fbq('track', 'PageView');
    </script>
    <meta name="facebook-domain-verification" content="5fozrxxbmhbdsqm021m0540h3lcdi2" />
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=1179190483014864&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Meta Pixel Code -->

    <meta name="google-site-verification" content="QJn7XLOIm7IFIhstTwPbrI7dXkddegJ5OZs2XIjAOCY" />
</head>
<body id="body-id">
<!-- start header -->
<section style="max-width: 100% !important;">
    <div class="header_desktop">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="start">
                        <div class="select__menu__lang">
                            <div id="google_translate_element"></div>
                        </div>
                    </div>
                    <div class="end">
                        <ul class="p-1" style="display: inline-flex;margin-bottom: 0px !important;"">


                        @if(!Auth::guard('web')->check())
                            <li class="nav-item link-login mr-1 ml-1">
                                <button>
                                    <a href="{{route('login/client')}}" class="text-decoration-none ">
                                        <i class="fas fa-unlock"></i>  @lang('site.log in')
                                    </a>
                                </button>
                                <div class=" login">
                                    <form  role="form" action="{{route('login/client')}}" method ="post">
                                        @csrf
                                        <div class="form-group">

                                            <div class="arrow">
                                                <i class="fas fa-sort-up"></i></div>
                                            <input placeholder="@lang('site.email') " name="email" class="w-100 " type="email">
                                            <input placeholder="@lang('site.password') " name="password" class="w-100" minlength="6" type="password">
                                            <button type="submit" class="btn w-100 btn-dark bg-main"> @lang('site.log in') </button>
                                            <a href="{{ route('forget.password.get') }}" class=""> @lang('site.forget password?')</a><br><br>
                                            <p>@lang('site.do not have account yet') <a href="{{route('register/client')}}" class="main-color"> @lang('site.creat one')</a></p>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="mr-1 ml-1">
                                <button>
                                    <a href="{{route('register/client')}}" class="text-decoration-none" l>
                                        <i class="fas fa-key"></i>  @lang('site.register')
                                    </a>
                                </button>
                            </li>

                        @elseif(Auth::guard('web')->check())
                            <li class="mr-1 ml-1">
                                <button>
                                    <a href="{{route('account.index')}}" class="text-decoration-none">
                                        <i class="fas fa-user"></i>  {{Auth::guard('web')->user()->name}}
                                    </a>
                                </button>
                            </li>


                        @endif
                        @if(Auth::guard('web')->check())
                            <li class="mr-1 ml-1">
                                <button>
                                    <a href="{{route('wishlist.products.index')}}" class="text-decoration-none">
                                        <i class="fas fa-heart"></i> @lang('site.wishlist')
                                    </a>
                                </button>
                            </li>

                        @endif

                        @if(Auth::guard('web')->check())
                            <li class="mr-1 ml-1">
                                <button>
                                    <a href="{{route('logout.client')}}" class="text-decoration-none">
                                        <i class="fas fa-sign-out-alt"></i>  @lang('site.Logout')
                                    </a>
                                </button>
                            </li>

                            @endif
                            </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="header__center">
            <div class="container">
                <div class="row">
                    <div class="start">
                        <div class="img">
                            <a href="{{route('home')}}">
                                <img src="{{asset('new_front/img/logo/logo.png')}}" alt="">
                            </a>

                        </div>
                    </div>

                    <div class="center">
                        <div class="slide-container swiper">
                            <div class="slide-content-banner">
                                <div class="card-wrapper swiper-wrapper">
                                    @foreach($ads_h as $one)
                                        <div class="card swiper-slide @if($loop->first) active @endif">
                                            <div class="image-content">

                                                <div class="card-image">
                                                    <a href="{{$one -> in_app==0?$one ->link :($one ->type == 'product'?route("product",$one->link):route("vendor",$one->link))}}">
                                                        <img src="{{asset('assets/images/ads/'.$one->img)}}" alt="" class="card-img">
                                                    </a>

                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="end">
                        @if(Route::has('brand'))
                        <div class="search">
                            <form class="mr-0 ml-5" action="" method="get">
                                <div class="input-group  ">


                                    <input  type="text" class="form-control " placeholder="{{__('site.search')}}" aria-label="{{__('site.search')}}"
                                           aria-describedby="basic-addon2" name="search" id="search-word2" style="margin-left: 10px;border-top-right-radius: 15px;
                                 border-bottom-right-radius: 15px;">
                                    <div class="input-group-append bg-brown"  style="border-top-left-radius: 15px;
                                             border-bottom-left-radius: 15px;">
                                        <button class="btn btn-outline-secondary mzkbtn "  id="search-submit2">
                                            <i class="fas fa-search" style="font-size: 20px"></i>
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        @else
                            <div class="search">
                                <form class="mr-0 ml-5">
                                    <div class="input-group  ">

                                        <input type="hidden" id="id2" name="id" value="@yield('id')">
                                        <input type="hidden" id="cat_or_sub2" name="cat_or_sub" value="@yield('cat_or_sub')">
                                        <input type="text" class="form-control " placeholder="{{__('site.search')}}" aria-label="{{__('site.search')}}"
                                               aria-describedby="basic-addon2" name="search" id="search-word2" style="margin-left: 10px;border-top-right-radius: 15px;
                                 border-bottom-right-radius: 15px;">
                                        <div class="input-group-append bg-brown"  style="border-top-left-radius: 15px;
                                             border-bottom-left-radius: 15px;">
                                            <button class="btn btn-outline-secondary mzkbtn search-submit2"  id="search-submit2">
                                                <i class="fas fa-search" style="font-size: 20px"></i>
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        @endif
                        <ul>
                            <li class="li1 mt-2">
                                @include('front.includes.header_cart')
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div class="header_bottom">
            <div class="container">
                <ul class="list">
                    <li><a href="{{route('home')}}" class=" active list-item"  id="home-item"> @lang('site.index') </a>
                    </li>
                    @foreach($blue_zone_cats as $k=> $cat)
                        @if($k==6 )
                            @break
                        @endif
                        <li > <a class="active  list-item" href="{{route('vendor' , $cat->id)}}" > {{ $cat->name }}</a>  </li>
                    @endforeach
                    <li >
                        <a class="active  list-item" href="{{route('front.info','TermsAndConditions')}}" id="terms-item" >
                            @lang('site.terms_and_condition')
                        </a>
                    </li>
                    <li >
                        <a class="active  list-item"  href="{{route('front.info','PrivacyPolicy')}}" id="privacy-item">
                            @lang('site.policies')
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="header_mob">

        <div class="header__top" style="width: 100%; margin: 0px !important; padding: 0px !important;">
            <div class="row">
                <div class="start">
                    <div class="select__menu__lang">
                        <div id="google_translate_element_mob" ></div>
                    </div>
                </div>
                <div class="end">
                    <ul style="display: inline-flex; margin-bottom: 0px !important;">


                        @if(!Auth::guard('web')->check())
                            <li class="nav-item link-login mr-1 ml-1">
                                <button>
                                    <a href="{{route('login/client')}}" class="text-decoration-none ">
                                        <i class="fas fa-unlock"></i>  @lang('site.log in')
                                    </a>
                                </button>
                                <div class=" login">
                                    <form  role="form" action="{{route('login/client')}}" method ="post">
                                        @csrf
                                        <div class="form-group">

                                            <div class="arrow">
                                                <i class="fas fa-sort-up"></i></div>
                                            <input placeholder="@lang('site.email') " name="email" class="w-100 " type="email">
                                            <input placeholder="@lang('site.password') " name="password" class="w-100" minlength="6" type="password">
                                            <button type="submit" class="btn w-100 btn-dark bg-main"> @lang('site.log in') </button>
                                            <a href="{{ route('forget.password.get') }}" class=""> @lang('site.forget password?')</a><br><br>
                                            <p>@lang('site.do not have account yet') <a href="{{route('register/client')}}" class="main-color"> @lang('site.creat one')</a></p>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="mr-1 ml-1">
                                <button>
                                    <a href="{{route('register/client')}}" class="text-decoration-none" l>
                                        <i class="fas fa-key"></i>  @lang('site.register')
                                    </a>
                                </button>
                            </li>

                        @elseif(Auth::guard('web')->check())
                            <li class="mr-1 ml-1">
                                <button>
                                    <a href="{{route('account.index')}}" class="text-decoration-none">
                                        <i class="fas fa-user"></i>  {{Auth::guard('web')->user()->name}}
                                    </a>
                                </button>
                            </li>


                        @endif
                        @if(Auth::guard('web')->check())
                            <li class="mr-1 ml-1">
                                <button>
                                    <a href="{{route('wishlist.products.index')}}" class="text-decoration-none">
                                        <i class="fas fa-heart"></i> @lang('site.wishlist')
                                    </a>
                                </button>
                            </li>

                        @endif

                        @if(Auth::guard('web')->check())
                            <li class="mr-1 ml-1">
                                <button>
                                    <a href="{{route('logout.client')}}" class="text-decoration-none">
                                        <i class="fas fa-sign-out-alt"></i>  @lang('site.Logout')
                                    </a>
                                </button>
                            </li>

                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="start">
                <div class="menu__btn">
                    <img src="{{asset('new_front/img/logo/menu-icon.png')}}" alt="">
                </div>
                <div class="menu_mob">
                    <div class="home_head">
                        <a  href="{{route('home')}}"> @lang('site.index') </a>
                    </div>
                    <ul class="list">
                        @foreach($blue_zone_cats as $k=> $cat)
                            @if($cat->subCategories->count() < 1)
                                <li><a class="div-bar-item div-button text-decoration-none  " href="{{route('vendor' , $cat->id)}}" style="color: #000 !important;"> {{ $cat->name }} </a></li>
                            @else
                                <li class="nav-item dropdown mobile-list ">
                                    <a class="nav-link dropdown-toggle div-bar-item div-button mobile-link text-decoration-none"   href="{{route('vendor' , $cat->id)}}" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $cat->name }}</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item top-slide text-decoration-none" href="{{route('vendor' , $cat->id)}}">عرض الكل</a>
                                        <div class="dropdown-divider"></div>
                                        @foreach($cat->subCategories as $sub_cat)
                                            <a class="dropdown-item text-decoration-none"  href="{{route('vendor' , $sub_cat->id)}}">
                                                {{ $sub_cat->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </li>
                            @endif
                        @endforeach
                        <li><a class="div-bar-item div-button text-decoration-none  " href="{{route('front.info','TermsAndConditions')}}"
                               style="color: #000 !important;"> @lang('site.terms_and_condition') </a></li>
                        <li><a class="div-bar-item div-button text-decoration-none  " href="{{route('front.info','PrivacyPolicy')}}"
                               style="color: #000 !important;"> @lang('site.policies') </a></li>

                    </ul>
                </div>
            </div>
            <div class="center">
                <div class="menu__btn__close">
                    <img src="{{asset('new_front//img/logo/icon-close-w.png')}}" alt="">
                </div>
                <div class="logo">
                    <a class="text-decoration-none" href="{{route('home')}}">
                        <img src="{{asset('new_front/img/logo/logo.png')}}" alt="">

                    </a>
                </div>
            </div>
            <div class="end">
                <ul>
                    <li class="li1 mt-3">
                        @include('front.includes.header_cart')
                    </li>
                </ul>
            </div>
        </div>

        <div class="search">
            <form class="" style="width: 100% !important; display: inline-flex;">

                <input type="hidden" id="id2" name="id" value="@yield('id')">
                <input type="hidden" id="cat_or_sub2" name="cat_or_sub" value="@yield('cat_or_sub')">

                <input type="text" class="form-control " placeholder="{{__('site.search')}}" aria-label="{{__('site.search')}}"
                       aria-describedby="basic-addon2" name="search" id="search-word3" style="margin-left: 10px;border-top-right-radius: 15px;
                                 border-bottom-right-radius: 15px;">
                <div class="input-group-append bg-brown"  style="border-top-left-radius: 15px;
                          border-bottom-left-radius: 15px;height: 36px;">
                    <button class="btn btn-outline-secondary mzkbtn search-submit2"  id="">
                        <i class="fas fa-search" style="font-size: 20px"></i>
                    </button>
                </div>

            </form>


        </div>

    </div>

</section>
<!-- end header -->
<div  id="content-container">
    @yield('new_titles')
    @yield('content')

</div>

<footer class="container-fluid  border-top  pt-4 "
        style="background-color: var(--bs-primary-green) !important; color: white !important;">
    <div class="row " style="background-color: var(--bs-primary-green) !important; color: white !important;">

        <div class="col-lg-3 col-sm-6 col-6 pr-5 pl-5">
            <div class="logo__footer">
                <img src="{{asset('new_front/img/logo/logo.png')}}" alt="">
            </div>

            <ul class="navbar-nav  w-100 p-0 justify-content-center" style="flex-direction: row" >
                <li class="nav-item  p-1">
                    <a class="nav-link border-light "  href="{{\App\Models\Icon::where('title','facebook')->first()->link }}" target="_blank"> <img class="icon-img footer-icon" src="{{asset('assets/images/icons/164926746970148.png')}}" alt="">
                    </a>
                </li>
                <li class="nav-item  p-1">
                    <a class="nav-link  "  href="{{\App\Models\Icon::where('title','instagram')->first()->link }}" target="_blank"> <img class="icon-img footer-icon" src="{{asset('assets/images/icons/164920274952956.png')}}" alt="">
                    </a>
                </li>
                <li class="nav-item  p-1">
                    <a class="nav-link  "  href="{{\App\Models\Icon::where('title','snapchat')->first()->link }}" target="_blank"> <img class="icon-img footer-icon" src="{{asset('assets/images/icons/164920269479238.png')}}" alt="">
                    </a>
                </li>

            </ul>
        </div>
        <div class="col-lg-3 col-sm-6 col-6 pr-5 pl-5">
            <h5 class="text-right black-c">@lang('site.Contact us links')</h5>
            <ul class="navbar-nav  w-100 p-0" >
                <li class="nav-item">
                    <a class="nav-link  white"  href="tel:{{\App\Models\Setting::where('name','phone')->first()->description }}" >  @lang('site.Call') : <img class="icon-img footer-icon" src="{{asset('assets/images/icons/164926728115538.png')}}" alt="">
                        <img class="icon-img footer-icon" src="{{asset('assets/images/icons/164926729491308.png')}}" alt="">
                    </a>
                </li>
                {{-- <li class="nav-item  border-bottom">
                    <a class="nav-link  "  href="" >  @lang('site.Email') : {{\App\Models\Setting::where('name','email')->first()->description }}</a>
                </li> --}}
                <li class="nav-item ">
                    <a class="nav-link white "  href="{{route("contact")}}" > @lang('site.contact us')</a>
                </li>

            </ul>
        </div>
        <div class="col-lg-3 col-sm-6 col-6 pr-5 pl-5" >
            <h5  class="text-right ">@lang('site.Company Information')</h5>
            <ul class="navbar-nav  w-100 p-0 pr-2" >
                <li class="nav-item ">
                    <a class="nav-link white " href="{{route('home')}}"> @lang('site.index') </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link  white" href="{{route('front.info','about')}}">
                        @lang('site.About us')
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link white " href="{{route('front.info','TermsAndConditions')}}">
                        @lang('site.terms_and_condition')
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link  white" href="{{route('front.info','PrivacyPolicy')}}">
                        @lang('site.policies')
                    </a>
                </li>


            </ul>
            <br> <br>
        </div>


        <div class="col-lg-3 col-sm-6 col-6 pr-5 pl-5">
            <h5 class="text-center black-c">@lang('site.download_app')</h5>
            <ul class="navbar-nav  w-100 p-0 justify-content-center" style="flex-direction: row" >

                {{-- <li class="nav-item  p-1" >
                    <a class="nav-link  "  href="" style="padding: 7px;
border-radius: 50%;
border: 4px solid;
margin: 4px;"> <i class="fab fa-android" aria-hidden="true"></i>
                    </a>
                </li> --}}
                <li class="nav-item  p-1" style="background: none !important;">
                    <a class="nav-link  a-mob-down"  href="{{\App\Models\Icon::where('title','google')->first()->link ?? "" }}"
                       target="_blank"> <i class="icon-mob-down fab fa-google-play" style='color: #fff !important;padding: 5px 0 5px 10px !important;'></i>
                    </a>
                </li>
                <li class="nav-item  p-1" style="background: none !important;">
                    <a class="nav-link a-mob-down "  href="{{\App\Models\Icon::where('title','iphone')->first()->link?? "" }}"
                       target="_blank"> <i class="icon-mob-down fab fa-app-store"style='color: #fff !important;' ></i>
                    </a>
                </li>
                {{-- <li class="nav-item  border-bottom">
                    <a class="nav-link  "  href="" >  @lang('site.Email') : {{\App\Models\Setting::where('name','email')->first()->description }}</a>
                </li> --}}


            </ul>
        </div>

        <div class="col-12 bottom_footer">
            <div class=" text-center p-2">
                @lang('site.All rights reserved to kocart 2022 Designed and developed by')
                <a href="https://bluezonekw.com/en" class="main-color" style="color: #55708B !important;">blueZone</a>
            </div>

        </div>


    </div>


</footer>


<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>


<script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>

<script src="{{asset('front/js/popper.min.js')}}"></script>
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/wow.min.js')}}"></script>
<script src="https://kit.fontawesome.com/a25cfb3468.js" crossorigin="anonymous"></script>

@if (session('error_login'))


    <script>
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: "{{ session()->get('error_login') }}",
                          confirmButtonText: 'okay'
                        });
                </script>
@endif
@if (session('error'))

    <script>
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: "{{ session()->get('error') }}",
                          confirmButtonText: 'okay'
                        });
                </script>
@endif
@if (session('success'))

    <script>
                        Swal.fire({
                          icon: 'success',
                          title: 'Done',
                          text: "{{ session()->get('success') }}",
                          confirmButtonText: 'okay'
                        });
                </script>
@endif
<script>
              new WOW().init();
              </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
  </script>
<script src="{{asset('front/js/scripts.js')}}"></script>
<script src="{{asset('front/js/main-js.js')}}"></script>
<script src="{{asset('front/js/canvas.js')}}"></script>
<script src="{{asset('front/js/canvas2.js')}}"></script>
@stack('content')
@include('sweetalert::alert')
<script>
    {{--  $("#privacy-item").click(function(){--}}
    {{--     var element = document.getElementById("home-item");--}}
    {{--      element.classList.remove("active");--}}

    {{--element.style.color = "blue";--}}
    {{--       var element2 = document.getElementById("privacy-item");--}}
    {{--       element2.classList.add("active");--}}
    {{--       });--}}
</script>
<script>

    var swiper = new Swiper(".mySwiper2", {

        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            // when window width is >= 480px
            770: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            // when window width is >= 640px
            1000: {
                slidesPerView: 4,
                spaceBetween: 30
            }
        },

        // autoplay: {
        //       delay: 2500,
        //       disableOnInteraction: false,
        //       },
        freeMode: true,
        // autoplay: {
        //     delay: 1500,
        // },

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
    var swiper = new Swiper(".mySwiper", {
         breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            // when window width is >= 480px
            770: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            // when window width is >= 640px
            1000: {
                slidesPerView: 3,
                spaceBetween: 30
            }
        },
        //   autoplay: {
        //       delay: 2500,
        //       disableOnInteraction: false,
        //       },
        freeMode: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });


    var swiper = new Swiper(".mySwiper-brand", {
         breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 3,
                spaceBetween: 20
            },
            // when window width is >= 480px
            770: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            // when window width is >= 640px
            1000: {
                slidesPerView: 4,
                spaceBetween: 30
            }
        },
        //   autoplay: {
        //       delay: 2500,
        //       disableOnInteraction: false,
        //       },
        freeMode: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

</script>

<script>
function active(e) {
{{--    $$('.active').each(function(i) {--}}
    {{--        i.removeClassName('active');--}}
    {{--    });--}}
    {{--    e.addClassName('active');--}}

    };


{{--          window.onscroll = function() {myFunction();myFunction1();};--}}
{{--      var header = document.getElementById("myHeader2");--}}
    {{--      var sticky = header.offsetTop;--}}
    {{--      var header1 = document.getElementById("myHeader1");--}}
    {{--      var sticky1 = header.offsetTop;--}}
    {{--      function myFunction() {--}}
    {{--          if (window.pageYOffset > sticky) {--}}
    {{--            header.classList.add("sticky1");--}}
    {{--          } else {--}}
    {{--            header.classList.remove("sticky1");--}}
    {{--          }--}}
    {{--      }--}}
    {{--      function myFunction1() {--}}
    {{--          if (window.pageYOffset > sticky1) {--}}
    {{--            header1.classList.add("sticky");--}}
    {{--          } else {--}}
    {{--            header1.classList.remove("sticky");--}}
    {{--          }--}}
    {{--      }--}}
    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
  $(document).ready(function () {
    $("#icon_search2").click(function(){
        if($('#navcol-1').hasClass("show")){
          $('#navcol-1').removeClass('show');

        }else{
          $('#navcol-1').addClass('show');
          topFunction();
        }
    });

      $('.navbar-light .dmenu').hover(function () {
              $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
          }, function () {
              $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
          });
      });
      $('#search-submit').on('click' , function (e) {
          e.preventDefault();

          //TODO :: CALL AJAX

          let id = $('#id').val();
          let cat_or_sub =$('#cat_or_sub').val();
          let search =$('#search-word').val();
          console.log(search);
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
          });

          $.ajax({
              type:'GET',
              url:'{{route('searching')}}',
                data:{
                    id:id,
                    cat_or_sub:cat_or_sub,
                    search:search,
                },
                success:function(data) {
                    // $("#msg").html(data.msg);

                    console.log(data);
                    $('#content-container').html(data)

                }
            });
        })

        $('#search-submit2').on('click' , function (e) {
            e.preventDefault();

            //TODO :: CALL AJAX

            let id = $('#id2').val();
            let cat_or_sub =$('#cat_or_sub2').val();
            let search =$('#search-word2').val();
            //alert(search);
            if (search === ""){
                search =$('#search-word3').val();
            }

            //alert(search);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type:'GET',
                url:'{{route('searching')}}',
                data:{
                    id:id,
                    cat_or_sub:cat_or_sub,
                    search:search,
                },
                success:function(data) {
                    // $("#msg").html(data.msg);
                    console.log(data);
                    $('#content-container').html(data)

                }
            });
        })
</script>
<script type="text/javascript">
if ($(window).width() < 768) {
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'ar', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element_mob');
      }

    }else{


      function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'ar', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');

      }
    }

</script>
<script>
            /*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2006, 2014 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
  if (typeof define === 'function' && define.amd) {
    define(['jquery'], factory);
  } else if (typeof exports === 'object') {
    module.exports = factory(require('jquery'));
  } else {
    factory(jQuery);
  }
}(function ($) {

  var pluses = /\+/g;

  function encode(s) {
    return config.raw ? s : encodeURIComponent(s);
  }

  function decode(s) {
    return config.raw ? s : decodeURIComponent(s);
  }

  function stringifyCookieValue(value) {
    return encode(config.json ? JSON.stringify(value) : String(value));
  }

  function parseCookieValue(s) {
    if (s.indexOf('"') === 0) {
      s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
    }

    try {
      s = decodeURIComponent(s.replace(pluses, ' '));
      return config.json ? JSON.parse(s) : s;
    } catch(e) {}
  }

  function read(s, converter) {
    var value = config.raw ? s : parseCookieValue(s);
    return $.isFunction(converter) ? converter(value) : value;
  }

  var config = $.cookie = function (key, value, options) {

    if (arguments.length > 1 && !$.isFunction(value)) {
      options = $.extend({}, config.defaults, options);

      if (typeof options.expires === 'number') {
        var days = options.expires, t = options.expires = new Date();
        t.setMilliseconds(t.getMilliseconds() + days * 864e+5);
      }

      return (document.cookie = [
        encode(key), '=', stringifyCookieValue(value),
        options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
        options.path    ? '; path=' + options.path : '',
        options.domain  ? '; domain=' + options.domain : '',
        options.secure  ? '; secure' : ''
      ].join(''));
    }

    var result = key ? undefined : {},
      cookies = document.cookie ? document.cookie.split('; ') : [],
      i = 0,
      l = cookies.length;

    for (; i < l; i++) {
      var parts = cookies[i].split('='),
        name = decode(parts.shift()),
        cookie = parts.join('=');

      if (key === name) {
        result = read(cookie, value);
        break;
      }

      if (!key && (cookie = read(cookie)) !== undefined) {
        result[name] = cookie;
      }
    }

    return result;
  };

  config.defaults = {};

  $.removeCookie = function (key, options) {
    $.cookie(key, '', $.extend({}, options, { expires: -1 }));
    return !$.cookie(key);
  };

}));
            /*
 show Modals
*/
 jQuery(function($){
    function initnewsLetterObj($obj) {
        var pause = $obj.attr('data-pause');
         setTimeout(function() {
           $obj.modal('show');
         }, pause);
    };

    $('#Modalnewsletter').on('click', '.checkbox-group', function() {
        $.cookie('modalnewsletter', '1', { expires: 7 });
    });
    $('#ModalVerifyAge').on('click', '.js-btn-close', function() {
        $.cookie('modalverifyage', '2', { expires: 7 });
        console.log("click");
        return false;
    });
     $('#ModalDiscount').on('click', '.js-reject-discount', function() {
        $.cookie('modaldiscount', '3', { expires: 7 });
        console.log("click");
        return false;
    });
    var $body = $('body'),
        modalnewsletter = $.cookie('modalnewsletter'),
        newsLetterObj = $('#Modalnewsletter'),
        modalverifyage = $.cookie('modalverifyage'),
        verifyageObj = $('#ModalVerifyAge'),
        modaldiscount = $.cookie('modaldiscount'),
        discountObj = $('#ModalDiscount');

    if (modalnewsletter == 1) return;
    if(newsLetterObj.length){
        initnewsLetterObj(newsLetterObj);
        $body.addClass('modal-newsletter');
        $('#Modalnewsletter').on('click', '.modal-header .close', function() {
          $body.removeClass('modal-newsletter');
        });
    };

    if(modalverifyage == 2) return;
    if(verifyageObj.length){
        initnewsLetterObj(verifyageObj);
        verifyageObj.on('click', '.js-btn-close', function() {
            verifyageObj.find('.modal-header .close').trigger('click');
            return false;
        });
    };

    if(modaldiscount == 3) return;
    if(discountObj.length){
        initnewsLetterObj(discountObj);
        discountObj.on('click', '.js-reject-discount', function() {
            discountObj.find('.modal-header .close').trigger('click');
            return false;
        });
    };
});
function div_open() {
  document.getElementById("mySidebar").style.display = "block";
  $('#hd_ct_yk2').attr('onclick','div_close();')
}

function div_close() {
  document.getElementById("mySidebar").style.display = "none";
  $('#hd_ct_yk2').attr('onclick','div_open();')

}
$(function() {
    $(".img-item")
        .mouseover(function() {
            // var src = $(this).attr("src").match(/[^\.]+/) + "over.gif";
            // $(this).attr("src", src);
        })
        .mouseout(function() {
            // var src = $(this).attr("src").replace("over.gif", ".gif");
            // $(this).attr("src", src);
        });
});

        </script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="{{asset('new_front/js/swiper-bundle.min.js')}}"></script>

<script src="{{asset('new_front/js/script-slider.js')}}"></script>
<script src="{{asset('new_front/js/script.js')}}"></script>

@yield('js')
</body>

</html>

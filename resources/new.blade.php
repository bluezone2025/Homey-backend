<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('front/css/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/animate.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
{{--    <link rel="stylesheet" href="{{asset('front/css/main-style.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('front/css/media.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('front/css/carousel.css')}}">--}}
    <title>@yield('title')</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/duotone.css"
          integrity="sha384-R3QzTxyukP03CMqKFe0ssp5wUvBPEyy9ZspCB+Y01fEjhMwcXixTyeot+S40+AjZ" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css"
          integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous"/>

{{--    <link rel="stylesheet" href="{{asset('front/product/css/animate.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('front/product/css/main-style.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('front/product/css/media.css')}}">--}}

    <script src="{{asset('front/product/js/jquery-3.3.1.min.js')}}"></script>
    {{--<title>Document</title>--}}
    <style>

        /*        #des-title:hover{*/
        /*            cursor: pointer;*/
        /*            border-bottom: 5px solid black;*/
        /*        }*/
        /*        #delivery-title:hover{*/
        /*            cursor: pointer;*/
        /*            border-bottom: 5px solid black;*/
        /*        }*/

        body {
            background-color: rgba(0, 0, 0, 0.05);
        }

        input:active {
            border: 0;
        }

        #design-parent {
        / background-color: rgba(0, 0, 0, 0.05);
        / display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            width: 100%;
            height: 80vh;
            align-items: stretch;
            justify-content: space-between;
        / min-height: 80 vh;
        /
        }

        #design-control-slider {
            flex-basis: 20%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        / background-color: red;
        /
        }

        #design-images-slider {
        / justify-content: center;
        / margin: auto;
            align-self: center;
            flex-basis: 50%;
        / background-color: blue;
        /
        }

        #design-product-data {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            flex-basis: 30%;
            padding: 20px;
            margin: auto;
        / background-color: green;
        /
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Position the image container (needed to position the left and right arrows) */
        .container {
            position: relative;
        }

        /* Hide the images by default */
        .mySlides {
            display: none;
        / margin: auto;
        / / height: 70 vh;
        /
        }

        .mySlides img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        / height: 50 vh;
        / / margin: auto;
        / width: 70 %;

        }

        /* Add a pointer when hovering over the thumbnail images */
        .cursor {
            cursor: pointer;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 40%;
            width: auto;
            padding: 16px;
            margin-top: -50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            border-radius: 0 3px 3px 0;
            user-select: none;
            -webkit-user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* Container for image text */
        .caption-container {
            text-align: center;
            background-color: #222;
            padding: 2px 16px;
            color: white;
        }

        .row {
        / content: "";
        / display: flex;
            align-items: center;
            flex-direction: column;
            clear: both;
        }

        /* Six columns side by side */
        .column {
            float: left;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;

        }

        /* Add a transparency effect for thumnbail images */
        .demo {
            opacity: 0.6;
        }

        .active,
        .demo:hover {
            opacity: 1;
        }

        .column img {
            height: 15vh;
            margin: auto;
        }

        @media only screen and (max-width: 1025px) {


            .column img {
                height: 10vh;
                margin: auto;
            }

            .mySlides img {
                width: 100%;
                height: auto;
                margin: auto;
                align-self: center;
            }

            #design-parent {
            / background-color: rgba(0, 0, 0, 0.05);
            / / display: flex;
            / flex-direction: row;
                flex-wrap: wrap;
                width: 100%;
            / min-height: auto;
            / align-items: center;
                justify-content: space-between;
                height: auto;
            }

            #design-control-slider {
                margin-top: 1vh;
                order: 2;
                flex-basis: 100%;
            / background-color: red;
            /
            }

            #design-product-data {
                order: 3;
                flex-basis: 80%;
            / height: 40 vh;
            / / background-color: green;
            /
            }

            #design-images-slider {
                margin: auto;
                order: 1;
            / height: 50 vh;
            / flex-basis: 79 %;
            / background-color: blue;
            /
            }

            .row {
            / content: "";
            / / display: flex;
            / justify-content: center;
                align-items: center;
                flex-direction: row;
                width: 100%;
                flex-wrap: wrap;

            / clear: both;
            /
            }
        }

        @media only screen and (max-width: 768px) {

            .mySlides img {
                width: 100%;
                height: auto;
                margin: auto;
                align-self: center;
            }

            #design-parent {
            / background-color: rgba(0, 0, 0, 0.05);
            / / display: flex;
            / flex-direction: row;
                flex-wrap: wrap;
                width: 100%;
            / min-height: auto;
            / align-items: center;
                justify-content: space-between;
                height: auto;
            }

            #design-control-slider {
                order: 3;
                flex-basis: 100%;
            / background-color: red;
            /
            }

            #design-images-slider {
                order: 1;
            / height: 50 vh;
            / flex-basis: 49 %;
            / background-color: blue;
            /
            }

            #design-product-data {
                order: 2;
                flex-basis: 49%;
            / height: 40 vh;
            / / background-color: green;
            /
            }

            .row {
            / content: "";
            / / display: flex;
            / justify-content: center;
                align-items: center;
                flex-direction: row;
                width: 100%;
                flex-wrap: wrap;

            / clear: both;
            /
            }

            .column img {
                height: 10vh;
            }


        }


        @media only screen and (max-width: 480px) {
            #design-parent {
            / background-color: rgba(0, 0, 0, 0.05);
            / / display: flex;
            / flex-direction: column;
                flex-wrap: nowrap;
                width: 100%;
                min-height: auto;
                align-items: center;
            / justify-content: space-between;
            / / min-height: 80 vh;
            /
            }

            #design-control-slider {
                order: 2;
                width: 100%;
            / background-color: red;
            /
            }

            #design-images-slider {
                order: 1;
            / height: 50 vh;
            / width: 100 %;
            / background-color: blue;
            /
            }

            #design-product-data {
                order: 3;
                width: 100%;
                height: 40vh;
            / background-color: green;
            /
            }

            .row {
            / content: "";
            / / display: flex;
            / justify-content: center;
                align-items: center;
                flex-direction: row;
            / clear: both;
            /
            }

        }


    </style>

</head>
<body>
<div class=" container-fluid  d-lg-block d-none bg-light">
    <header class=" container" style="">
        <div class="float-left ">
            <a class="  logo  " href="{{route('home')}}">
                <img src="{{asset($my_setting->logo)}}" style="height:70;width:90">
            </a>
        </div>
        {{--/* Islam modification when logged in the logged in email--}}
        <ul class="nav  float-right pad-10">

            @if(!Auth::guard('client')->check())
                <li class="nav-item link-login"><a class="nav-link border-right " href="{{route('login/client')}}"> <i
                            class="fas fa-unlock"></i> log in</a>
                    <div class=" login">
                        <form role="form" action="{{route('login/client')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="arrow">
                                    <i class="fas fa-sort-up"></i></div>
                                <input placeholder="email " name="email" class="w-100 " type="email">
                                <input placeholder="password " name="password" class="w-100" minlength="6"
                                       type="password">
                                <button type="submit" class="btn w-100 btn-dark bg-main">login</button>
                                <a href="#" class="" data-toggle="modal" data-target="#login">forget
                                    password?</a><br><br>
                                <p>do not have account yet <a href="{{route('register/client')}}" class="main-color">creat
                                        one</a></p>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item"><a class="nav-link  border-right" href="{{route('register/client')}}"> <i
                            class="fas fa-key"></i> @lang('site.register')

                    </a>
                </li>
            @elseif(Auth::guard('client')->check())
                <li class="nav-item link-login"><a class="nav-link border-right " href="{{route('account.index')}}"> <i
                            class="fas fa-user"></i> {{Auth::guard('client')->user()->name}}</a>




            @endif
            {{--End of modification Islam--}}
            @if(Auth::guard('client')->check())
                <li class="nav-item"><a class="nav-link  border-right" href="{{route('wishlist.products.index')}}"> <i
                            class="fas fa-heart"></i> @lang('site.wishlist') </a>
                </li>

            @endif
        <!--  <li class="nav-item"><a class="nav-link border-right " href="account.html">  <i class="fas fa-user-tie"></i>  My Account </a></li> -->
            <li class="nav-item  li1">
                @include('front.includes.header_cart')

            </li>

            @if(Auth::guard('client')->check())
                <li class="nav-item link-logout"><a class="nav-link border-right " href="{{route('logout.client')}}"> <i
                            class="fas fa-sign-out-alt"></i> Logout</a>
            @endif

            <li class="nav-item relative link-login"><a class="nav-link border-right" href="{{route('home')}}">
                <!--   <img src="{{asset('front/img/k.svg')}}" width="20">-->
                    {{get_country_helper()}}

                    <i class="fas fa-chevron-down "></i> </a>


                <div class=" login  bg-w  text-left ">
                    @foreach($kokart_country as $one)
                        <a class="nav-link "
                           href="{{route('home')}}?country_id={{$one->id}}"><!-- <img src="{{asset('front/img/k.svg')}}" width="20">--> {{$one->name_en}} </a>
                        <hr class="mr-0">
                    @endforeach


                </div>

            </li>

        <!--
<li class="nav-item">  <a class="nav-link "  href="" ><img src="{{asset('front/img/k.svg')}}"  width="30px">  العربية</a>
</li>
-->
        </ul>
        <div style="clear: both"></div>
    </header>
</div>
<header class=" container-fluid d-lg-block d-none bg-b ">
    <div class=" container  ">
        <div class="row">
            <ul class="nav  col-9">
                <li class="nav-item "><a class="nav-link  " href="{{route('home')}}"> @lang('site.dashboard') </a>
                </li>
                <li class="nav-item li1"><a class="nav-link  " href=""> @lang('site.category') <i
                            class="fas fa-angle-down"></i> </a>
                    <div class=" li2 pad-0">
                        <ul class="navbar-nav  w-100 pad-0">
                            @foreach($blue_zone_cats as $cat)

                                <li class="nav-item li3 pad-10 relative">
                                    <a class="nav-link  " href="{{route('cat.products' , $cat->id)}}">
                                        <i class="fas fa-female"></i> {{$cat->name_en}} <i
                                            class="fas fa-angle-down"></i> </a>
                                    <div class=" li4 pad-0">
                                        <ul class="navbar-nav  w-100 pad-0">

                                            @foreach($cat->sub as $sub_cat)
                                                <li class="nav-item  pad-10 li5">
                                                    <a class="nav-link  "
                                                       href="{{route('cat.products' , $cat->id)}}">
                                                        <i class="fas fa-female"></i>
                                                        {{$sub_cat->name_en}} <i class="fas fa-angle-down"></i> </a>

                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </li>
                            @endforeach

                        </ul>
                    </div>
                </li>

                <li class="nav-item ">
                    <a class="nav-link  " href="{{route("terms")}}">
                        @lang('site.terms_and_condition')
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link  " href="{{route("policy")}}">
                        @lang('site.policies')
                    </a>
                </li>

            </ul>
            <ul class="nav  col-3 ">
                <li class="nav-item w-100 ">
                    <form class="mr-0 ">
                        <div class="input-group  ">

                            <input type="hidden" id="id2" name="id" value="@yield('id')">
                            <input type="hidden" id="cat_or_sub2" name="cat_or_sub" value="@yield('cat_or_sub')">

                            <input type="text" class="form-control " placeholder="search" aria-label="search"
                                   aria-describedby="basic-addon2" name="search" id="search-word2"
                                   style="margin-left: 10px">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" id="search-submit2">
                                    <i class="fas fa-search" style="font-size: 20px"></i>
                                </button>
                            </div>
                        </div>

                    </form>

                </li>

            </ul>
        </div>
    </div>
</header>

<!-----md-nav --->
<header class=" container-fluid d-lg-none d-block ">

    <a class="  logo " href="{{route('home')}}">
        <img src="{{asset($my_setting->logo)}}" style="height:70;width:90">
    </a>
    <button class="navbar-toggler open float-right nav-item" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        <a class="nav-link  ">
            <i class="fas fa-align-justify" style="font-size: 25px"></i> </a>
    </button>


</header>
<header class=" container-fluid d-lg-none d-block bg-b" style="margin: 10px; width: calc(100% - 20px); ">
    <form class="mr-0 ">
        <div class="input-group ">

            <input type="hidden" id="id" name="id" value="@yield('id')">
            <input type="hidden" id="cat_or_sub" name="cat_or_sub" value="@yield('cat_or_sub')">

            <input type="text" class="form-control " placeholder="search" aria-label="search"
                   aria-describedby="basic-addon2" name="search" id="search-word">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary"
                        type="button"
                        id="search-submit"><i class="fas fa-search" style="font-size: 20px"></i></button>
            </div>
        </div>

    </form>
</header>
<!--- sidbar --->

<header class="sidbar col-md-6 col-sm-8 col-10"
        style="background-image: url('{{asset("bg_image/css3-floating-background-animation-website-designer.png")}}')">
    <div class="close hide text-right col-12">
        <i class="fas fa-times "></i>
    </div>
    @if(!Auth::guard('client')->check())

        <div class="text-center col-12"
             style="display: flex;flex-wrap: nowrap;justify-content: space-evenly;align-items: center">
            <a href="{{route("login/client")}}" class="btn bg-main"> @lang('site.login')</a>
            <span> @lang('site.or')</span>
            <a href="{{route("register/client")}}" class="btn bg-main">
                @lang('site.register')</a>
        </div>
    @endif

    <ul class="navbar-nav   pad-10">

        {{--        <li class="nav-item link-login border-bottom"><a class="nav-link  " href=""> <i class="fas fa-search"--}}
        {{--                                                                                        style="font-size: 20px"></i></a>--}}
        {{--            <form role="form" class=" search">--}}

        {{--                <input placeholder="search" class="w-100" type="text">--}}
        {{--            </form>--}}

        {{--        </li>--}}

        <li class="nav-item  border-bottom" style="padding:10px 0">
            <a class="nav-link   " href="{{route('cart.show')}}"> <i class="fas fa-shopping-bag"
                                                                     style="font-size: 20px;margin: 0 10px 0 0 ;color:#2878d1"></i>
                cart</a>
        </li>
        @if(Auth::guard('client')->check())

            <li class="nav-item border-bottom" style="padding:10px 0">
                <a class="nav-link  " href="{{route('wishlist.products.index')}}"> @lang('site.wishlist')</a>
            </li>
        @endif
        @foreach($blue_zone_cats as $cat)

            <li class="nav-item dropdown border-bottom li1 " style="padding:10px 0">
                <a class="nav-link " href="{{route('cat.products' , $cat->id)}}" id="dropdownMenuButton"
                   data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    {{$cat->name_en}}
                    <i class="fas fa-chevron-down "></i> </a>


                <div class="dropdown-menu  " aria-labelledby="dropdownMenuButton">
                    <ul class="navbar-nav  pad-0">
                        @foreach($cat->sub as $sub_cat)

                            <li class="nav-item   pad-10">
                                <a class="nav-link  " href=" {{route('cat.products' , $cat->id)}}">
                                    {{$sub_cat->name_en}}
                                </a>
                            </li>


                        @endforeach
                    </ul>
                </div>

            </li>

        @endforeach
        @if(Auth::guard('client')->check())
            <li class="nav-item border-bottom" style="padding:10px 0">
                <a class="nav-link " href="{{route('account.index')}}">@lang('site.my_account') </a>
            </li>
    @endif
    <!--
        <li class="nav-item border-bottom">
            <a class="nav-link  " href="index-ar.html"><img src="{{asset('front/img/k.svg')}}" width="30px"> عربي</a>
        </li>
-->
        <li class="nav-item relative link-login  border-bottom" style="padding:10px 0"><a class="nav-link "
                                                                                          href="{{route('home')}}">
                <img src="{{asset('front/img/k.svg')}}" width="20"> Kuwait
                <i class="fas fa-chevron-down "></i> </a>
            <div class=" login  bg-w  text-left ">
                <a class="nav-link " href="{{route('home')}}"> <img src="{{asset('front/img/k.svg')}}" width="20">
                    Kuwait </a>

            </div>

        </li>


        <li class="nav-item  border-bottom" style="padding:10px 0">
            <a class="nav-link  " href="{{route("terms")}}">
                @lang('site.terms_and_condition')
            </a>
        </li>
        <li class="nav-item  border-bottom" style="padding:10px 0">
            <a class="nav-link  " href="{{route("policy")}}">
                @lang('site.policies')
            </a>
        </li>

    </ul>
</header>
<!-----end nav --->


<div id="content-container">
    @yield('new_titles')
    @php
        $photos = $result->images;
    @endphp

    <section id="design-parent" style="height:auto">
        <div id="design-control-slider">
            <div class="row">
                @foreach($photos as $i=>$photo)

                    <div class="column">
                        <img class="demo cursor" src="{{asset('https://kocart.net/'.$photo->img)}}"
                             onclick="currentSlide($i)" alt="The Woods">
                    </div>
                @endforeach


            </div>
        </div>
        <div id="design-images-slider">
            <!-- Container for the image gallery -->
            <div class="container">
            @foreach($photos as $i=>$photo)

                <!-- Full-width images with number text -->
                    <div class="mySlides">
                        <!--                    <div class="numbertext">1 / 6</div>-->
                        <img src="{{asset('https://kocart.net/'.$photo->img)}}">
                    </div>
            @endforeach





            <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

                <!-- Image text -->
                <!--                <div class="caption-container">-->
                <!--                    <p id="caption"></p>-->
                <!--                </div>-->

                <!-- Thumbnail images -->

            </div>

        </div>
        <div id="design-product-data" style="font-family: Arial">
            <h1>
                {{$result->name_en}}
            </h1>
            <br>
            <p style="font-family: 'Arial';color: grey">
                {{$result->description_en}}
            </p>
            <br>

            <p style="color:red;font-weight: bolder;font-size: 20px">
                {{$result->price}}
                KWD
            </p>

            <br>
            <!--            <div id="colors">-->
            <!--                <div id="s" class="color-blocks" style="display: flex;justify-content: space-evenly;flex-wrap: wrap">-->
            <!--                    <span style="font-size:18px;font-weight: normal">Color :</span>-->
            <!--                    <div class="radio-inline color" style="background-color: red;border-radius: 3px">-->
            <!--                        <input type="radio" name="size"  id="size-0" checked="">-->
            <!--                        <label for="size-0" ></label>-->
            <!--                    </div>-->
            <!--                    <div class="radio-inline color"  style="background-color: green;border-radius: 3px">-->
            <!--                        <input type="radio" name="size" id="size-1" checked="">-->
            <!--                        <label for="size-1" ></label>-->
            <!--                    </div>-->

            <!--                    <div class="radio-inline color"  style="background-color: blue;border-radius: 3px">-->
            <!--                        <input type="radio" name="size" id="size-2" checked="">-->
            <!--                        <label for="size-2" ></label>-->
            <!--                    </div>-->
            <!--                </div></div>-->
            <br>


            <form method="post" id="cart{{ $result->id}}" name="cart_form" class="col-md-6 col-12"
                  action="{{ route('add.cart.post') }}">
                @csrf


                <div style="display: flex;justify-content: space-evenly;
            align-items: center;
            padding: 10px">
                    <select
                        style="border: 2px solid black;
                       font-size: 18px;width:100%;font-family: 'Agency FB';
                       background-color: white;color: grey;padding: 10px 5px">
                        <option style="color: black">
                            Select Color ...
                        </option>
                        @foreach($list as $pro)
                            @if($pro->has_color==1)
                                @if($result->id==$pro->id)


                                    <option style="color: {{$pro->color_en}}">
                                        <a href="{{route('product',$pro->id)}}"> <span
                                                style="margin:10px;border:1px solid #000;padding:10px">{{$pro->color_en}}</span></a>
                                    </option>
                                @else
                                    <option style="color: {{$pro->color_en}}">
                                        <a href="{{route('product',$pro->id)}}"> <span
                                                style="margin:10px;border:1px solid #000;padding:10px">{{$pro->color_en}}</span></a>
                                    </option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
                @foreach($list as $pro)
                    @if($pro->has_color==1)
                        @if($result->id==$pro->id)
                            <div class=" row" style="margin:20px 0px ">
                                <a href="{{route('product',$pro->id)}}"> <span
                                        style="margin:10px;border:1px solid #000;padding:10px;;background:{{$pro->color_en}}"></span></a>
                            </div>
                        @else
                            <div class=" " style="margin:20px 0px ">
                                <a href="{{route('product',$pro->id)}}"> <span
                                        style="margin:10px;border:1px solid #000;padding:10px;background:{{$pro->color_en}} "></span></a>
                            </div>
                        @endif
                    @endif
                @endforeach
                <div style="display: flex;justify-content: space-evenly;
            align-items: center;
            padding: 10px">
                    <label for="quantity" style="font-family: Arial;font-size: 18px">

                        Quantity
                    </label>
                    <input type="number" min="1" name="qut" id="qty_{{$result->id}}"
                           value="<?=(isset((\Session::get('cart'))[$result->id]['quantity'])) ? (\Session::get('cart'))[$result->id]['quantity'] : 1 ?>"

                           style="border: 0;
                       background-color: rgba(0,0,0,0.05);
                       border-radius: 10px;color: black;padding: 10px" value="1">
                </div>
                <br>
                <div style="display: flex;justify-content: center;
            align-items: center;
            padding: 10px">
                    <select
                        style="border: 2px solid black;
                       font-size: 18px;width:100%;font-family: 'Agency FB';
                       background-color: white;color: grey;padding: 10px 5px" name='option_id'>
                        @foreach($result->options as $pro)

                            <option style="color: black" value='{{$pro->id}}'>
                                {{$pro->value_en}}
                            </option>
                        @endforeach

                    </select>
                </div>
                <br>
                <div style="display: flex;justify-content: space-between;font-family: 'Arial'">

                    <div class="col-12" style="padding: 0;">

                        <input type="hidden" name="item_id" value="{{$result->id}}"/>

                        <button type="submit" id="send{{ $result->id}}" style="background-color: red;
                        color: white;width:200%;border-radius: 30px;
                        text-align: center;font-size: 20px;
                        padding: 10px">Add
                            to cart
                        </button>
                        <br><br>
                    </div>
            </form>


            <i
                style="text-align: center;padding: 10px ;border-radius: 20px;background-color: rgba(0,0,0,0.05);color: red;font-size:17px"
                class="far fa-heart"></i>


        </div>


</div>
</section>
<section>
    <!--        USE BOOTSTRAP-->
    <div id="titles" style="display: flex;padding: 10px;flex-direction: column">
        <div>
            <p id="des-title"
               style="width: 150px;padding: 5px;margin: 0 10px;font-weight: bold;font-size: 20px;color: black;border-bottom: 5px solid black">
                Description
            </p>

            <div style="padding: 30px">
                {{$result->description_en}}
            </div>
        </div>
        <div>

            <p id="delivery-title"
               style=" width: 250px ;padding: 5px;margin: 0 10px;font-weight: bold;font-size: 20px;color: black;border-bottom: 5px solid black">
                Delivery and Return
            </p>
            <div style="padding: 30px">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Atque beatae consequuntur dolorum error expedita facilis id
                impedit ipsam obcaecati, odit
                officiis pariatur quia quod ratione ullam ut vitae? Laudantium, quia!
            </div>
        </div>

    </div>
</section>


<script>

    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        var captionText = document.getElementById("caption");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        captionText.innerHTML = dots[slideIndex - 1].alt;
    }
</script>
<script>
    $(document).ready(function () {
        $('#des-title').on('click', function () {
            aler('hiiiiiii')
            $(this).style.borderBottom = '5px solid black';
            $('#delivery-title').style.borderBottom = '0';
        })

        $('#delivery-title').on('click', function () {
            $(this).style.borderBottom = '5px solid black';
            $('#des-title').style.borderBottom = '0';
        })
    })
</script>
<script type="text/javascript">

    function get_total_price(price) {
        $.ajax({
            url: "{{url('/en/total_price')}}",
            method: "get",
            data: {
                _token: '{{ csrf_token() }}',
                price: price

            },
            success: function (response) {
                $("#my_total").val(response + "KWD");

                //$("#divid").load(" #divid");
                //return response;
            }

        });

    }


    function update_cart(elem, pro_price, factor, item_id) {

        var ele = document.getElementById('qty_' + elem).value;
        if (factor == 'minus') {
            // alert(ele);

            qq = (Number($("#qty_" + elem).val()) - 1 > 1) ? Number($("#qty_" + elem).val()) - 1 : 1;
            $.ajax({
                url: "{{url('/update_cart')}}/" + item_id + "/" + qq,
                method: "get",


                success: function (response) {
                    $(".my_total").html(response.data + "KWD");
//alert(response.data);
                }, error: function (response, u) {
//$(".my_total").html(response + "KWD");
                    alert(u);

                }

            });
        } else if (factor == 'plus') {
            qq = Number($("#qty_" + elem).val()) + 1;
            $.ajax({
                url: "{{url('/update_cart')}}/" + item_id + "/" + qq,
                method: "get",

                success: function (response) {
                    $(".my_total").html(response.data + "KWD");
                    //alert(response.data);

                }, error: function (response, u) {
//$(".my_total").html(response + "KWD");
//	alert(u);

                }

            });
        } else {
        }
//calc_total_cost(elem,pro_price,factor);
        $(".x_sub_total_price_" + elem).html(pro_price * qq + " KWD");
        //$("#total").load(location.href +"#total");

        //$("#total").load("#total > *");
    }


    function calc_total_cost(elem, pro_price, factor) {

        pro_price = pro_price;
        if (factor == 'minus') {
            qty = document.getElementById('qty_' + elem).value;
            qty = (Number(qty) - 1 > 0) ? Number(qty) - 1 : 1;
        } else if (factor == 'plus') {
            qty = document.getElementById('qty_' + elem).value;
            qty = Number(qty) + 1;
        } else {
            qty = 1;
        }

        /*
        $.ajax({
        url: "{{url('/en/total_cost/qty')}}/" + qty+'/pro_price/'+pro_price+'/factor/'+factor ,
type: "POST",
data: {
_token: '{{ csrf_token() }}',
id: elem.value,
}, success: function (result) {
	//alert(result);
$(".x_sub_total_price_"+elem).html(result + "KWD");
get_total_price(result);

}});
*/
    }


</script>

</div>
<!-----start footer --->
<footer class="container-fluid  border-top">
    <div class="container"><br>
        <div class="row ">
            <div class="col-lg-4 col-sm-12 col-12 text-center">
                <a href="{{route('home')}}">
                    <img src="{{asset($my_setting->logo)}}" style="width:200">
                </a>
            </div>

            <div class="col-lg-4 col-sm-6 col-12" style="margin-top:15px">
                <h5>Company Information</h5>
                <ul class="navbar-nav  w-100">
                    <li class="nav-item border-bottom ">
                        <a class="nav-link  " href="{{route("about")}}"> About us</a>
                    </li>
                    <li class="nav-item   border-bottom">
                        <a class="nav-link  " href="{{route("contact")}}"> contact us</a>
                    </li>
                    <li class="nav-item border-bottom ">
                        <a class="nav-link  " href="{{route("terms")}}"> Terms and conditions</a>
                    </li>
                    <li class="nav-item   border-bottom">
                        <a class="nav-link  " href="">Delivery Terms</a>
                    </li>
                </ul>
                <br> <br></div>
            <div class="col-lg-4 col-sm-6 col-12">
                <h5>Contact us</h5>
                <ul class="navbar-nav  w-100">
                    <li class="nav-item  border-bottom">
                        <a class="nav-link  " href="tel:{{$my_setting->phone}}"> Call: +965 22263400</a>
                    </li>
                    <li class="nav-item  border-bottom">
                        <a class="nav-link  " href=""> Email: s@gmail.com</a>
                    </li>
                </ul>
                <h5><br>Follow us on</h5>
                <a href="#" class="mr-10"> <i class="fab fa-instagram" style="font-size: 25px;"></i> </a>
                <a href="#" class="mr-10"> <i class="fab fa-snapchat-ghost" style="font-size: 25px;"></i> </a>
                <a href="#" class="mr-10"> <i class="fab fa-whatsapp" style="font-size: 25px;"></i> </a>
                <a href="#" class="mr-10"> <i class="fab fa-facebook-f" style="font-size: 25px;"></i> </a>
                <br> <br></div>
        </div>
    </div>
</footer>
<div class="container-fluid bg-b ">
    <div class="row ">
        <p class="col-12"><br>All rights reserved to kocart 2020 Designed and developed by <a
                href="https://bluezonekw.com/en" class="main-color">blueZone</a></p>
    </div>
</div>
<!-- country -->
{{--<div class="country ">--}}
{{--<header class="container-fliud ">--}}
{{--<div class="container">--}}
{{--<div class="row">--}}
{{--<a href="{{route('home')}}" class="logo col-4 pad-0"><img src="{{asset('front/img/logo.png')}}" ></a> --}}
{{--<p class="col-8 main-color pad-0  mr-0"><br> <br>Welcome to kocart Ecommerce!</p>--}}
{{--</div>   </div>--}}
{{--</header>--}}
{{--<div class="relative">--}}

{{--<video class=" w-100 "  autoplay controls muted >--}}
{{--<source src="{{asset('vedio/monstroid.mp4')}}" type="video/mp4" >--}}
{{--</video>--}}
{{--<div class="abs-shop text-center">--}}
{{--<button  class=" btn btn-danger close-country  ">shop now  <i class="far fa-heart"></i> </button>--}}
{{--</div>--}}

{{--</div>--}}
{{--<p class="text-center main-color shadow mr-0"><br>All rights reserved to kocart 2020 designed and developed by <a href="https://bluezonekw.com/"--}}
{{--class="text-danger">blueZone</a><br><br></p>--}}

{{--</div>--}}


<!-- Modal -->
<div class="modal fade " id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content  text-center">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLongTitle">forget password </h5>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="text" placeholder="Enter a phone number or email" class="pad-0 w-100">
                    <br><br>
                    <p>Enter a phone number or email <br>
                        You will receive a message to set the password </p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#password"
                        data-dismiss="modal">send
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade " id="password" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLongTitle">change password</h5>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">The new password
                        </label>
                        <div class="col-sm-8">
                            <input type="password" placeholder="" class=" pad-0 mr-10">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Repeat the password
                        </label>
                        <div class="col-sm-8">
                            <input type="password" placeholder="" class=" pad-0 mr-10">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">send</button>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('front/js/popper.min.js')}}"></script>
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/all.min.js')}}"></script>
<script src="{{asset('front/js/wow.min.js')}}"></script>
<script>
    new WOW().init();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
<script src="{{asset('front/js/scripts.js')}}"></script>
<script src="{{asset('front/js/main-js.js')}}"></script>
@stack('content')
@include('sweetalert::alert')
<script>

    $('#search-submit').on('click', function (e) {
        e.preventDefault();

        //TODO :: CALL AJAX

        let id = $('#id').val();
        let cat_or_sub = $('#cat_or_sub').val();
        let search = $('#search-word').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{url('/searching')}}',
            data: {
                id: id,
                cat_or_sub: cat_or_sub,
                search: search,
            },
            success: function (data) {
                // $("#msg").html(data.msg);
                console.log(data);
                $('#content-container').html(data)

            }
        });
    })

    $('#search-submit2').on('click', function (e) {
        e.preventDefault();

        //TODO :: CALL AJAX

        let id = $('#id2').val();
        let cat_or_sub = $('#cat_or_sub2').val();
        let search = $('#search-word2').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{url('/searching')}}',
            data: {
                id: id,
                cat_or_sub: cat_or_sub,
                search: search,
            },
            success: function (data) {
                // $("#msg").html(data.msg);
                console.log(data);
                $('#content-container').html(data)

            }
        });
    })
</script>
</body>

</html>

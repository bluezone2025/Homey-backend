<html dir="ltr" lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/main-style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/media.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}"> --}}

    <!-- slick css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/slick-theme.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    @yield('meta')
    <link rel="stylesheet" href="{{ asset('front/css/animate.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/duotone.css"
        integrity="sha384-R3QzTxyukP03CMqKFe0ssp5wUvBPEyy9ZspCB+Y01fEjhMwcXixTyeot+S40+AjZ" crossorigin="anonymous" />
    {{-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css"
        integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous" /> --}}
    <link href="{{ asset('front/img/logo1.PNG') }}" rel="icon" type="image/png">
    {{-- <link href="//db.onlinewebfonts.com/c/be395203fb38e2f170265aa2a9785467?family=M+Sung+PRC" rel="stylesheet" --}}
    {{-- type="text/css" /> --}}
    {{-- slider ismail start --}}
    {{-- <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap..min.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('front/assets/css/boxicons.min.css')}}"> --}}
    <link rel="stylesheet" href="{{ asset('front/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.css')}}">

    {{-- slider ismail end --}}


    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <style>
    .end-quantity {
        position: absolute;
        /* top: 5px; */
        /* right: 5px; */
        padding: 4px;
        border-radius: 10%;
        z-index: 10;
        color: #fff;
        background: #212529;
    }

    .heart2 {

        right: 35px !important;

    }

    .title-span {
        display: block;
    }

    .icon-container div {
        width: 150px;
        height: 150px;
    }


    @media only screen and (max-width: 960px) {
        .title-span {
            display: none;
        }

        .icon-container div {
            width: 100px;
            height: 100px;
        }
    }

    .color-blocks .color input:checked+label {
        border: 2px solid #212529;
        color: #fff;
        background-color: #212529;
    }

    .bg-b nav .ul2 {
        margin-top: 35px;
    }

    .swal2-popup {
        padding: 0.25em !important;
    }

    .swal2-popup .swal2-title {
        font-size: 23px !important;
        font-weight: initial !important;

    }
    </style>
    @yield('css')
    <title>

        @if ($my_setting->site_name_en)

        {{ $my_setting->site_name_en }}

        @endif

    </title>

    <script>
    $(document).ready(function() {
        // alert('hiiiiiiiiiiiiii')

        $('.circle').on('click', function(e) {
            e.preventDefault();
            alert('hola');
        })

        //TODO ::VIEW CART FIRST ITEM AND CALL THIS WHEN READY AND ON HOVER

        $('#cart-hover').on({
            mouseenter: function() {
                // $('#cart-items').html('<p style="color:black;">wait  ... </p> ');
                viewFromCart();
                //stuff to do on mouse enter
            },
            mouseleave: function() {
                //stuff to do on mouse leave
                // alert('i am leaving')
            }
        });


        function viewFromCart() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('view.from.cart') }}",
                method: 'get',
                success: function(result) {
                    //CHECK SIZE VALUES
                    //CHECK HEIGHTS VALUE
                    // Swal.fire({
                    //     toast: true,
                    //     icon: 'success',
                    //     title: 'تمت الإضافه الي السله',
                    //     animation: false,
                    //     position: 'bottom',
                    //     showConfirmButton: false,
                    //     timer: 3000,
                    //     timerProgressBar: true,
                    //     didOpen: (toast) => {
                    //         toast.addEventListener('mouseenter', Swal.stopTimer)
                    //         toast.addEventListener('mouseleave', Swal.resumeTimer)
                    //     }
                    // });

                    //CART . HTML = RESULT
                    // location.reload();
                    // $('#cart-items').html(result);

                    $('#cart-items').html(result);

                    console.log(result);
                },
                error: function(error) {
                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'لم تكتمل العمليه ',
                    // })
                    console.log(error);
                }
            });
        }

        // viewFromCart();
    })
    </script>
</head>


<body>
    {{-- 
    <div class="vwrap">
        <div class="vmove">

            @foreach (App\News::where('appearance', 1)->get() as $news)
            <div class="vitem">
                @if (app()->getLocale() == 'en')
                {{ $news->content_en }}
    @else
    {{ $news->content_ar }}
    @endif


    </div>
    @endforeach
    </div>
    </div>
    --}}

    <div class="container-fluid pad-0 bg-white head-flex d-md-flex d-sm-none justify-content-center align-items-center my-4">
        <!-- image -->
        <div>
            <a class="nav-link" href="{{ route('/') }}" style="padding: 3px !important;">
                <img src="{{ asset('/storage/' . $my_setting->logo) }}" style="max-width:100%;">
            </a>
        </div>
    </div>

    <div style="border-bottom: 1px solid #AE9332;"></div>


    <script>
    $('#search-submit').on('click', function(e) {
        e.preventDefault();
        console.log('xxx');

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
            url: '{{ url(' / searching ') }}',
            data: {
                id: id,
                cat_or_sub: cat_or_sub,
                search: search,
            },
            success: function(data) {
                // $("#msg").html(data.msg);
                console.log(data);
                $('#content-container').html(data)

            }
        });
    })

    $('#search-submit2').on('click', function(e) {
        e.preventDefault();
        console.log('clicked');

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
            url: '{{ url(' / searching ') }}',
            data: {
                id: id,
                cat_or_sub: cat_or_sub,
                search: search,
            },
            success: function(data) {
                // $("#msg").html(data.msg);
                console.log(data);
                $('#content-container').html(data)

            }
        });


    })
    $('#search-submit3').on('click', function(e) {
        e.preventDefault();

        //TODO :: CALL AJAX

        let id = $('#id2').val();
        let cat_or_sub = $('#cat_or_sub2').val();
        let search = $('#search-word3').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{ url(' / searching ') }}',
            data: {
                id: id,
                cat_or_sub: cat_or_sub,
                search: search,
            },
            success: function(data) {
                // $("#msg").html(data.msg);

                //TODO :: CLOSE NAV BAR
                console.log(data);
                $('#content-container').html(data)

            }
        });


    })
    </script>
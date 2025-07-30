@include('layouts2.header2')



@yield('content')

@include('sweetalert::alert')



<script src="{{ asset('front/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('front/js/popper.min.js') }}"></script>
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/js/all.min.js') }}"></script>
<script src="{{ asset('front/js/wow.min.js') }}"></script>
{{-- <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script> --}}

<script>
    new WOW().init();
</script>
<script src="{{ asset('front/js/main-js.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/slick.min.js') }}"></script>
<script src="{{ asset('front/js/counterup.min.js') }}"></script>
<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    $(document).ready(function() {

        // jQuery counterUp
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });

        $('.MyServices').slick({
            autoplay: true,
            dots: true,
            autoplaySpeed: 2000,
            centerMode: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 1260,
                settings: {
                    arrows: false,
                    slidesToShow: 5
                }
            },
                {
                    breakpoint: 992,
                    settings: {
                        arrows: false,
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        arrows: false,
                        slidesToShow: 2
                    }
                }
            ]
        });

        $('#search-submit').on('click' , function (e) {
            e.preventDefault();

            //TODO :: CALL AJAX

            let id = $('#id').val();
            let cat_or_sub =$('#cat_or_sub').val();
            let search =$('#search-word').val();
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
    });
</script>
<script>
    var swiper = new Swiper(".mySwiper", {
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            // when window width is >= 480px
            770: {
                slidesPerView: 2,
                spaceBetween: 30
            },
            // when window width is >= 640px
            1000: {
                slidesPerView: 3,
                spaceBetween: 30
            }
        },
        freeMode: true,
        // autoplay: {
        //     delay: 1500,
        // },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
    var swiper = new Swiper(".mySwiper1", {
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
        freeMode: true,
        // autoplay: {
        //     delay: 1500,
        // },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })

</script>


{{-- slider ismail start --}}
{{-- <script src="{{asset('front/assets/js/jquery.min.js')}}"></script> --}}
{{-- <script src="{{asset('front/assets/js/bootstrap.min.js')}}"></script> --}}
<script src="{{asset('front/assets/js/owl.carousel.min.js')}}"></script>
{{-- <script src="{{asset('front/assets/js/mixitup.min.js')}}"></script> --}}
<script src="{{asset('front/assets/js/meanmenu.min.js')}}"></script>
<script src="{{asset('front/assets/js/main.js')}}"></script>
<script>
    $('.owl-one').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        // autoplay:true,
        lazyLoad:true,
        autoWidth:true,

        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:2,
                nav:false
            },
            1080:{
                items:6,
                nav:true,
                loop:true
            }
        }
    });
    $('.owl-two').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        // autoplay:true,
        lazyLoad:true,
        // autoWidth:true,

        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:2,
                nav:false
            },
            1080:{
                items:3,
                nav:true,
                loop:true
            }
        }
    });

    // $('.owl-slider').owlCarousel({
    //     loop: false,
    //         margin: 10,

    //         responsive: {
    //             0: {
    //                 items: 1,
    //                 nav: true
    //             },
    //             600: {
    //                 items: 1,
    //                 nav: false
    //             },
    //             1000: {
    //                 items: 3,
    //                 nav: true,
    //                 loop: false
    //             }
    //         }
    // });
    $('.owl-three').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        // autoplay:true,
        lazyLoad:true,
        autoWidth:true,

        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:2,
                nav:false
            },
            1080:{
                items:1,
                nav:true,
                loop:true
            }
        }
    });
</script>
{{-- slider ismail end --}}

@yield('script')
</body>

</html>

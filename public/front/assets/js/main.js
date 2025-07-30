(function($) {
    "use strict";
    jQuery(document).on('ready', function() {



        // Slideshow Slides
        $('.slideshow-slides').owlCarousel({
            loop: true,
            nav: false,
            dots: false,
            animateOut: 'fadeOut',
            autoplayHoverPause: false,
            autoplay: true,
            smartSpeed: 400,
            mouseDrag: false,
            autoHeight: true,
            items: 1,
            navText: [
                "<i class='bx bx-left-arrow-alt'></i>",
                "<i class='bx bx-right-arrow-alt'></i>"
            ],
        });


    });

    // Preloader JS
    $(window).on('load', function() {
        $('.preloader').addClass('preloader-deactivate');
    });
}(jQuery));
                $(".navbar-toggler").click(function() {
                    $(".sidbar").toggleClass("open-sidbar");

                });

                $(".close-sidbar").click(function() {
                    $(".sidbar").toggleClass("open-sidbar");

                });
                $(".close-country").click(function() {
                    $(".country").addClass("display-none");
                });

                // $(".heart").click(function() {
                //     $(this).toggleClass("heart-hover");

                // });
                $(".toggler1").click(function() {
                    $(".sidbar1").toggleClass("open-sidbar");

                });

                $(".close-sidbar1").click(function() {
                    $(".sidbar1").toggleClass("open-sidbar");

                });
                // ============================================================================
                // btn-plus and btn-minus in "#order-detail-content" table
                // ============================================================================

                $('.btn-plus').on('click', function() {
                    var $count = $(this).parent().find('.count');
                    var val = parseInt($count.val(), 10);
                    $count.val(val + 1);
                    return false;
                });

                $('.btn-minus').on('click', function() {
                    var $count = $(this).parent().find('.count');
                    var val = parseInt($count.val(), 10);
                    if (val > 0) $count.val(val - 1);
                    return false;
                });

	$('#carousel-our').on('slide.bs.carousel', function (e) {

	    /*
	        CC 2.0 License Iatek LLC 2018
	        Attribution required
	    */
	    var $e = $(e.relatedTarget);
	    var idx = $e.index();
	    var itemsPerSlide = 5;
	    var totalItems = $('#carousel-our .carousel-item').length;
	    
	    if (idx >= totalItems-(itemsPerSlide-1)) {
	        var it = itemsPerSlide - (totalItems - idx);
	        for (var i=0; i<it; i++) {
	            // append slides to end
	            if (e.direction=="left") {
	                $('#carousel-our .carousel-item').eq(i).appendTo('#carousel-our  .carousel-inner');
	            }
	            else {
	                $('#carousel-our .carousel-item').eq(0).appendTo('#carousel-our  .carousel-inner');
	            }
	        }
	    }
	});
	
	$('#carousel-product').on('slide.bs.carousel', function (e) {

	    /*
	        CC 2.0 License Iatek LLC 2018
	        Attribution required
	    */
	    var $e = $(e.relatedTarget);
	    var idx = $e.index();
	    var itemsPerSlide = 5;
	    var totalItems = $('#carousel-product  .carousel-item').length;
	    
	    if (idx >= totalItems-(itemsPerSlide-1)) {
	        var it = itemsPerSlide - (totalItems - idx);
	        for (var i=0; i<it; i++) {
	            // append slides to end
	            if (e.direction=="left") {
	                $('#carousel-product .carousel-item').eq(i).appendTo('#carousel-product  .carousel-inner');
	            }
	            else {
	                $('#carousel-product .carousel-item').eq(0).appendTo('#carousel-product .carousel-inner');
	            }
	        }
	    }
	});
	$('#carousel-shoes').on('slide.bs.carousel', function (e) {

	    /*
	        CC 2.0 License Iatek LLC 2018
	        Attribution required
	    */
	    var $e = $(e.relatedTarget);
	    var idx = $e.index();
	    var itemsPerSlide = 5;
	    var totalItems = $('#carousel-shoes  .carousel-item').length;
	    
	    if (idx >= totalItems-(itemsPerSlide-1)) {
	        var it = itemsPerSlide - (totalItems - idx);
	        for (var i=0; i<it; i++) {
	            // append slides to end
	            if (e.direction=="left") {
	                $('#carousel-shoes .carousel-item').eq(i).appendTo('#carousel-shoes  .carousel-inner');
	            }
	            else {
	                $('#carousel-shoes .carousel-item').eq(0).appendTo('#carousel-shoes .carousel-inner');
	            }
	        }
	    }
	});
	$('#carousel-shirt').on('slide.bs.carousel', function (e) {

	    /*
	        CC 2.0 License Iatek LLC 2018
	        Attribution required
	    */
	    var $e = $(e.relatedTarget);
	    var idx = $e.index();
	    var itemsPerSlide = 5;
	    var totalItems = $('#carousel-shirt  .carousel-item').length;
	    
	    if (idx >= totalItems-(itemsPerSlide-1)) {
	        var it = itemsPerSlide - (totalItems - idx);
	        for (var i=0; i<it; i++) {
	            // append slides to end
	            if (e.direction=="left") {
	                $('#carousel-shirt .carousel-item').eq(i).appendTo('#carousel-shirt  .carousel-inner');
	            }
	            else {
	                $('#carousel-shirt .carousel-item').eq(0).appendTo('#carousel-shirt  .carousel-inner');
	            }
	        }
	    }
	});


$('#carousel-glass').on('slide.bs.carousel', function (e) {

	    /*
	        CC 2.0 License Iatek LLC 2018
	        Attribution required
	    */
	    var $e = $(e.relatedTarget);
	    var idx = $e.index();
	    var itemsPerSlide = 5;
	    var totalItems = $('#carousel-glass  .carousel-item').length;
	    
	    if (idx >= totalItems-(itemsPerSlide-1)) {
	        var it = itemsPerSlide - (totalItems - idx);
	        for (var i=0; i<it; i++) {
	            // append slides to end
	            if (e.direction=="left") {
	                $('#carousel-glass .carousel-item').eq(i).appendTo('#carousel-glass  .carousel-inner');
	            }
	            else {
	                $('#carousel-glass .carousel-item').eq(0).appendTo('#carousel-glass  .carousel-inner');
	            }
	        }
	    }
	});
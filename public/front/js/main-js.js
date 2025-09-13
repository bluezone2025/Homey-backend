
$(document).ready(function(){
    $(".open").click(function(){
      $(".open").toggle();
	   $(".sidbar  .close").toggle();
	  $(".sidbar").toggleClass("active");
    });
});
$(document).ready(function(){
    $(".sidbar  .close").click(function(){
      $(".open").toggle();
	   $(".sidbar .close").toggle();
	  $(".sidbar").toggleClass("active");
    });
});

$(document).ready(function(){
    $(".menu").click(function(){
		  $(".li2").removeClass("display-block");
		     $( this ).children(".li2").toggleClass("display-block");
			
    });
});
$(document).ready(function(){
  $(".menu").click(function(){
		  
		     $( this ).children(".li2").toggleClass("display-block");
			
    });
});
          $(".close-country").click(function(){
 $(".country").addClass("display-none");
});  
// ============================================================================
// btn-plus and btn-minus in "#order-detail-content" table
// ============================================================================

  $('.btn-plus').on('click', function () {
    var $count = $(this).parent().find('.count');
    var val = parseInt($count.val(),10);
    $count.val(val+1);
    return false;
  });

  $('.btn-minus').on('click', function () {
    var $count = $(this).parent().find('.count');
    var val = parseInt($count.val(),10);
    if(val > 0) $count.val(val-1);
    return false;
  });
$(".heart").click(function(){
    $(this).children(".heart-none").toggleClass("display-block");
    $(this).children(".heart-block").toggleClass("display-none");
    $(this).toggleClass("fas-heart");

});


//for mobile menu
//$(document).ready(function(){
//    $(".menu").click(function(){
//		 $(".li2").removeClass("display-block");
//     $( this ).children(".li2").toggleClass("display-block");
//    });
//});


$(document).ready(function () {
    $(".menu").click(function () {
        $(this).children(".li2").toggleClass("display-block");

    });
});
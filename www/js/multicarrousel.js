var $origin = $("#carouselPlus .carousel-inner").prop("outerHTML");
function multiCarousel(){
	if ( $( "#lg" ).is( ":visible" ) ) {
		do {
			$( "#carouselPlus .carousel-inner" ).children( ".carousel-grid:lt(4)" ).wrapAll( "<div class=\"carousel-item \"><div class=\"row\"></div></div>" );
			$( "#carouselPlus .carousel-inner .carousel-item:first" ).addClass("active");
		} while ( $( "#carouselPlus .carousel-inner" ).children( ".carousel-grid" ).length );
	} else if ( $( "#md" ).is( ":visible" ) ) {
		do {
			$( "#carouselPlus .carousel-inner" ).children( ".carousel-grid:lt(3)" ).wrapAll( "<div class=\"carousel-item \"><div class=\"row\"></div></div>" );
			$( "#carouselPlus .carousel-inner .carousel-item:first" ).addClass("active");
		} while ( $( "#carouselPlus .carousel-inner" ).children( ".carousel-grid" ).length );
	} else  {
		do {
			$( "#carouselPlus .carousel-inner" ).children( ".carousel-grid:sm(1)" ).wrapAll( "<div class=\"carousel-item \"><div class=\"row\"></div></div>" );
			$( "#carouselPlus .carousel-inner .carousel-item:first" ).addClass("active");
		} while ( $( "#carouselPlus .carousel-inner" ).children( ".carousel-grid" ).length);
	}
}
$(window).on( "load resize", function() {
	$.when(
		$( "#carouselPlus .carousel-inner" ).replaceWith( $origin ),
		multiCarousel()
	).done(function() {
		$( ".multi-carousel" ).animate({opacity: "1"}, 1000);
	});
});// JavaScript Document
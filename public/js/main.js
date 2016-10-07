$(document).ready(function() {



	function isElementInViewport(elem) {
	    var $elem = $(elem);

	    // Get the scroll position of the page.
	    var scrollElem = ((navigator.userAgent.toLowerCase().indexOf('webkit') != -1) ? 'body' : 'html');
	    var viewportTop = $(scrollElem).scrollTop();
	    var viewportBottom = viewportTop + $(window).height();

	    // Get the position of the element on the page.
	    var elemTop = Math.round( $elem.offset().top );
	    var elemBottom = elemTop + $elem.height();

	    return ((elemTop < viewportBottom) && (elemBottom > viewportTop));
	}
	
	// Check if it's time to start the animation.
	function checkAnimation() {
	    var $elem = $('.slide-intro');

	    // If the animation has already been started

	    if (isElementInViewport($elem)) {
	        // Start the animation
			$('.easing').css('opacity', '1');
			$('.easing').css('transform', 'none');
	    }
	    if(isElementInViewport(slides)) {
	    	top.css('opacity', '0');
	    } else {
	    	top.css('opacity', '1');
	    }
	}


	// Capture scroll events
	$(window).scroll(function(){
	    checkAnimation();
	});

});

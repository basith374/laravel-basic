
$(document).ready(function() {

	var PortFolio = function() {
		this.items = ko.observableArray();
	}
	var portfolio = new PortFolio();

	var loading;
	var finished = false;
	var count = 0;

	if(loading == undefined) {
		console.log('initial load')
		$elem = $("#show_more");
        $elem.find('.msg').remove();
        $elem.append($('<div>').addClass('loader'));
		loading = $.ajax({
			url: '/portfolio',
			dataType: 'json',
  			cache: false,
			success: function(data) {
				processInput(data.portfolio);
				// console.log(portfolio.items())
			}
		});
	}

	function debounce(func, wait, immediate) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		};
	};

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
	    var $elem = $('#show_more');

	    // If the animation has already been started

	    if (isElementInViewport($elem)) {
	    	console.log('time')
	        // Start the animation
	        if(!finished) {
		        if(loading == undefined) {
		        	console.log('loading more')
			        $elem.find('.msg').remove();
			        $elem.append($('<div>').addClass('loader').html('<span></span><span></span><span></span>'));
			        var url = '/portfolio';
			        if(count) {
			        	url += '?offset=' + count;
			        }
					loading = $.ajax({
								url: url,
								dataType: 'json',
								success: function(data) {
									processInput(data.portfolio);
								},
								error: function(data) {
									console.log(data.responseText);
								}
							})
				}
			}
	    }
	}

	function processInput(input) {
		$elem = $("#show_more");
		// console.log(input)
		$elem.find('.loader').remove();
		if(input.length == 0) {
			finished = true;
			$elem.append($('<div>').addClass('msg').text(count ? 'Finished' : 'No Items'));
		} else {
			if(input.length < 7) {
				finished = true;
				$elem.append($('<div>').addClass('msg').text('Finished'));
			} else {
				$elem.append($('<div>').addClass('msg').text('Older...'));
			}
			$.each(input, function(k, v) {
				// v.image = '/uploads/' + v.image;
				portfolio.items.push(v);
			});
			count += input.length;
			loading = undefined;	
		}
	}
	ko.applyBindings(portfolio)
	
	// Capture scroll events
	$(window).scroll(debounce(checkAnimation, 250));


});
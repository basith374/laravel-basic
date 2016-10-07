$(document).ready(function() {
	$('[data-toggle=tooltip]').tooltip();

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

	var loading;
	var finished = false;
	var count = 0;

	function processInput(input) {
		$elem = $("#show_more");
		// console.log(input)
		$elem.find('.loader').remove();
		if(input.length == 0) {
			finished = true;
			$elem.append($('<div>').addClass('msg').text(count ? 'Loading Complete' : 'No Items'));
		} else {
			if(input.length < 7) {
				finished = true;
				$elem.append($('<div>').addClass('msg').text('Loading Complete'));
			} else {
				$elem.append($('<div>').addClass('msg').text('Older...'));
			}
			$.each(input, function(k, v) {
				v.selected = ko.observable(false);
				v.home = ko.observable(v.home);
				// v.image = '/uploads/' + v.image;
				portfolio.items.push(v);
			});
			count += input.length;
			loading = undefined;	
		}
	}

	// Check if it's time to start the animation.
	function checkAnimation() {
	    var $elem = $('#show_more');

	    // If the animation has already been started

	    if (isElementInViewport($elem)) {
	        // Start the animation
	        if(!finished) {
		        if(loading == undefined) {
		        	console.log('loading more')
			        $elem.find('.msg').remove();
			        $elem.append($('<div>').addClass('loader'));
			        var url = '/portfolio';
			        if(count) {
			        	url += '?offset=' + count;
			        }
					loading = $.get(url)
						.success(function(data) {
							processInput(data.portfolio);
						})
						.fail(function(data) {
							console.log(data.responseText);
						});
				}
			}
	    }
	}

	if(loading == undefined) {
		console.log('initial load')
		$elem = $("#show_more");
        $elem.find('.msg').remove();
        $elem.append($('<div>').addClass('loader').html('<span></span><span></span><span></span>'));
		loading = $.get('/portfolio')
			.success(function(data) {
				processInput(data.portfolio);
				// console.log(portfolio.items())
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

	// Capture scroll events
	$(window).scroll(debounce(checkAnimation, 250));

	if(window.location.pathname.endsWith('settings')) {
		// fix height
		var pageWrapper = $("#page-wrapper");
		// console.log(pageWrapper.outerHeight())
		// console.log(window.innerHeight)
		var maxHeight = window.innerHeight - 50; // minus navbar height
		var curHeight = pageWrapper.innerHeight();
		if(curHeight < maxHeight) {
			pageWrapper.css('height', maxHeight);
		}
		// Javascript to enable link to tab
		var url = document.location.toString();
		if (url.match('#')) {
		    $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
		} 
		// Change hash for page-reload
		$('.nav-tabs a').on('shown.bs.tab', function (e) {
		    window.location.hash = e.target.hash;
		});
		// show alert message
		var message = $('#msg');
		if(message.children().length) {
			var hash = window.location.hash;
			if(!hash) {
				hash = '#contact';
			}
			$(hash).prepend(message.children());
		}
		var alerts = $(".alert");
		if(alerts.length) {
			setTimeout(function() {
				alerts.fadeOut(function() {
					$(this).remove();
				});
			}, 5000);
		}
	}
});
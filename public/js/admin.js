$(document).ready(function() {
	$('[data-toggle=tooltip]').tooltip();
	
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

	function resizeWrapper() {
		$('#page-wrapper').css('min-height', window.innerHeight - 50);
	}

	$(window).resize(debounce(resizeWrapper, 250));

	$('.nav-tabs a').on('shown.bs.tab', function (e) {
		var page = e.target.hash.substr(1);
		window.history.replaceState(null, null, location.pathname + '?page=' + page);
		if(page == 'map') {
			// refresh map
			google.maps.event.trigger(window.map, 'resize');
		}
	});
});
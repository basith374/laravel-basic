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
			pageWrapper.css('min-height', maxHeight);
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
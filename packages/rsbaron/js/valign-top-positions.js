var ie_version = false;
if ( jQuery.browser.msie && (jQuery.browser.version=='8.0' || jQuery.browser.version=='7.0') ) {
	ie_version = true;
}
var width_accepted = 750;
if ( jQuery.browser.webkit) {
	width_accepted = 768;
}
jQuery(document).ready(function($) {
	var window_w 	= $(window).width();
	var topElementsHeight = $('.rstpl-header > div').first().height();
	if (window_w >= width_accepted || ie_version) {
		$('.rstpl-header > div').each(function() {
			var differenceHeight = topElementsHeight-$(this).height();
			if (differenceHeight > 5) {
				var marginTop = differenceHeight/2;
				$(this).css('margin-top',marginTop);
			}
		});
	}
	$(window).resize(function(){
		window_w 	= $(window).width();
		topElementsHeight = $('.rstpl-header > div').first().height();
		$('.rstpl-header > div').first().each(function() {
			var differenceHeight = topElementsHeight-$(this).height();
			if (differenceHeight > 5) {
				var marginTop = differenceHeight/2;
				if (window_w >= width_accepted || ie_version) {
					$(this).css('margin-top',marginTop);
				}
				else {
					$(this).css('margin-top',0);
				}
			}
		});
	});
});

jQuery(window).load(function() {
	var window_w 	= jQuery(window).width();
	var topElementsHeight = jQuery('.rstpl-header > div').first().height();
	if (window_w >= width_accepted || ie_version) {
		jQuery('.rstpl-header > div').each(function() {
			var differenceHeight = topElementsHeight-jQuery(this).height();
			if (differenceHeight > 5) {
				var marginTop = differenceHeight/2;
				jQuery(this).css('margin-top',marginTop);
			}
		});
	}
});

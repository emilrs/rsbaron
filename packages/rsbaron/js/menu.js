jQuery(document).ready(function($) {
	var window_w 	= $(window).width();
	var ie_version = false;
	if ( $.browser.msie && ($.browser.version=='8.0' || $.browser.version=='7.0') ) {
		ie_version = true;
	}
	if(window_w>=960 || ie_version){
		$('.dropdown').hover(function() {
		  $(this).find('.dropdown-menu').first().stop(true, true).fadeIn();
		}, function() {
		  $(this).find('.dropdown-menu').first().stop(true, true).fadeOut()
		});
		$('.dropdown-submenu').hover(function() {
		  $(this).find('.dropdown-menu').first().stop(true, true).fadeIn();
		}, function() {
		  $(this).find('.dropdown-menu').first().stop(true, true).fadeOut()
		});
	}
	$(window).resize(function(){
		window_w 	= $(window).width();
		if(window_w<960 && !ie_version){
			$('.dropdown').unbind('hover');
			$('.dropdown').find('.dropdown-menu').first().show();
			$('.dropdown-submenu').unbind('hover');
			$('.dropdown-submenu').find('.dropdown-menu').first().show();
		}
		else { 
			$('.dropdown').find('.dropdown-menu').first().hide();
			$('.dropdown-submenu').find('.dropdown-menu').first().hide();
			$('.dropdown').hover(function() {
				  $(this).find('.dropdown-menu').first().stop(true, true).fadeIn();
			}, function() {
			  $(this).find('.dropdown-menu').first().stop(true, true).fadeOut()
			});
			$('.dropdown-submenu').hover(function() {
			  $(this).find('.dropdown-menu').first().stop(true, true).fadeIn();
			}, function() {
			  $(this).find('.dropdown-menu').first().stop(true, true).fadeOut()
			});
		}
	});
	
});


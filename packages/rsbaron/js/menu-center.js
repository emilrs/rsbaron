var margin_l = 0;

jQuery(document).ready(function() {
	var window_w 	= jQuery(window).width();
	var menu_w 		= jQuery('.rstpl-main-menu-position .nav').width();
	var container_w = jQuery('.rstpl-main-menu-position .container').width();
	margin_l = ((container_w - menu_w) - 2)/2;
	
	if(window_w>=960){
		if (margin_l>0) {
			jQuery('.rstpl-main-menu-position .nav').css('margin-left',margin_l);
		}
	}
	jQuery(window).resize(function(){
		window_w 	= jQuery(window).width();
		if (window_w>=960) {
			menu_w 		= jQuery('.rstpl-main-menu-position .nav').width();
			container_w = jQuery('.rstpl-main-menu-position .container').width();
			margin_l = ((container_w - menu_w) - 2)/2;
			if (margin_l>0) {
				jQuery('.rstpl-main-menu-position .nav').css('margin-left',margin_l);
			}
		}
		else {
			jQuery('.rstpl-main-menu-position .nav').css('margin-left',0);
		}
	});
});


jQuery(window).load(function() {
	var window_w 		= jQuery(window).width();
	var menu_w 			= jQuery('.rstpl-main-menu-position .nav').width();
	var container_w 	= jQuery('.rstpl-main-menu-position .container').width();
	var check_margin_l	= ((container_w - menu_w) - 2)/2;
	
	if (margin_l!=check_margin_l) {
		margin_l = check_margin_l;
		if(window_w>=960){
			if (margin_l>0) {
				jQuery('.rstpl-main-menu-position .nav').css('margin-left',margin_l);
			}
		}
	}
});
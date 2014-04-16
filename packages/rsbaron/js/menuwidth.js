jQuery(document).ready(function($) {
	var window_w 	= $(window).width();
	if(window_w>=960){
		$('.dropdown').hover(function() {
			var width_parent = $(this).width();
			$(this).find('.dropdown-menu').first().css('min-width',width_parent);
			$(this).addClass('active');
		}, function() {
				$(this).removeClass('active');
		});
	}
	$(window).resize(function(){
		window_w 	= $(window).width();		
		if (window_w>=960) {
			$('.dropdown').hover(function() {
				var width_parent = $(this).width();
				$(this).find('.dropdown-menu').first().css('min-width',width_parent);
				$(this).addClass('active');
			}, function() {
				$(this).removeClass('active');
			});
		}
	});
	$('.rstpl-main-menu-position .menu').css('visibility','visible');
});
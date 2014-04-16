jQuery(document).ready(function($){
	var $navbar = $('.rstpl-menu');
	if ($navbar.length > 0) {
		$navbarTop 	  = $navbar.offset().top;
		$(window).scroll(function(){
			var $top = $(window).scrollTop();
			if ($top > $navbarTop) {
				$navbar.addClass('navbar-fixed-top');
			} else {
				$navbar.removeClass('navbar-fixed-top');
			}
		});
	}
});

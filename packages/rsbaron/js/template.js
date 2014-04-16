/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

(function($)
{
	$(document).ready(function()
	{
		$('*[rel=tooltip]').tooltip()

		// Turn radios into btn-group
		$('.radio.btn-group label').addClass('btn');
		$('.btn-group label:not(.active)').click(function()
		{
			var label = $(this);
			var input = $('#' + label.attr('for'));

			if (!input.prop('checked')) {
				label.closest('.btn-group').find("label").removeClass('active btn-success btn-danger btn-primary');
				if (input.val() == '') {
					label.addClass('active btn-primary');
				} else if (input.val() == 0) {
					label.addClass('active btn-danger');
				} else {
					label.addClass('active btn-success');
				}
				input.prop('checked', true);
			}
		});
		$('.btn-group input[checked=checked]').each(function()
		{
			if ($(this).val() == '') {
				$("label[for=" + $(this).attr('id') + "]").addClass('active btn-primary');
			} else if ($(this).val() == 0) {
				$("label[for=" + $(this).attr('id') + "]").addClass('active btn-danger');
			} else {
				$("label[for=" + $(this).attr('id') + "]").addClass('active btn-success');
			}
		});

		/* Fix for bootstrap collapse (accordion) */
		$('.rstpl-box-accordion, .accordion').each(function(){
			$(this).find('.accordion-toggle').each(function(i,title){
				if ( $(title).parent().siblings('.accordion-body').hasClass('in') === false )
					$(title).addClass('collapsed');
			});
		});
		$('.accordion-toggle').click(function(){
			$(this).parents('.rstpl-box-accordion, .accordion').each(function(){
				$(this).find('.accordion-toggle').each(function(i,title){
					$(title).addClass('collapsed');
				});
			});
		});
		/* End Fix for bootstrap collapse (accordion) */

		/*Conflict Fix for Mootools.slide vs. Jquery Bootstrap carousel slide effect */
		$('.carousel').each(function(index, element) {$(this)[0].slide = null;});
		$('.carousel').carousel();

	})
})(jQuery);
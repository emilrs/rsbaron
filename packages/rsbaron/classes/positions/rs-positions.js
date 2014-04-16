jQuery(function() {
	jQuery("#rs_sortable").sortable({
	axis: 'y',
	scroll: false,
	stop: function( event, ui ) {
		var elements = [];
		jQuery('#rs_sortable li').each(function(index, elem){
			var rs_pos = jQuery(elem).attr('data_item');
			elements.push(rs_pos);
		});
		var serialize_elem = elements.join();
		jQuery('#jform_params_definedPositions').val(serialize_elem);
	}
	});
	jQuery("#rs_sortable, #rs_sortable li").disableSelection();
});
function rsResetPositions() {
	var old_order = jQuery('#jform_params_defaultPositions').val();
	jQuery('#jform_params_definedPositions').val(old_order);

	var order = old_order.split(',');

	// set the first element
	jQuery('[data_item="'+order[0]+'"]').parent().prepend(jQuery('[data_item="'+order[0]+'"]'));
	for(var i=1; i < order.length; i++) {
		jQuery('[data_item="'+order[i]+'"]').insertAfter(jQuery('[data_item="'+order[i-1]+'"]'));
	}
}
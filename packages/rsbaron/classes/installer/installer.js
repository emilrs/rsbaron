jQuery.noConflict();

function installSampleData(type) { 
	if (type == 'normal') {
		var variables = { check: "extension", extensions: ["com_rsmediagallery","mod_rsmediagallery_responsive_slideshow"] };
	}
	else if (type == 'force') {
		var variables = { check: "none"};
	}
	jQuery.ajax({
		type: "POST",
		url: "../templates/rsbaron/classes/installer/installer.php",
		data: variables,
		beforeSend: function(){
                       jQuery("#data-loading").show();
                   }
		}).done(function( msg ) {
			response = jQuery.parseJSON(msg);
			 jQuery("#data-loading").hide();
			if (response.error) {
				jQuery('#install-response').empty();
				jQuery('#install-response').css('display','block');
				jQuery('#install-response').append(response.error);
			}
			else if (response.success) {
				jQuery('#install-response').empty();
				jQuery('#install-response').css('display','block');
				jQuery('#install-response').append(response.success);
			}
	});
}

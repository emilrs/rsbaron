<?php
/**
* @version 1.0.0
* @package RSTemplate! 1.0.0
* @copyright (C) 2007-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-2.0.html
*/
defined('_JEXEC') or die;
?>
	<div class="row-fluid">
		<div class="span12" id="options">
			<i class="icon-profile nolink"></i>
			<input type="text" id="box_title" name="box_title" class="input-xlarge" value="<?php echo JText::_('TPL_RSBARON_TEMPLATE_ACCORDION_TITLE_DEFAULT_VALUE');?>" rel="tooltip" title="<?php echo JText::_('TPL_RSBARON_TEMPLATE_ACCORDION_TITLE_LABEL');?>" data-placement="bottom" />
		</div>
	</div>
	<h4><?php echo JText::_('TPL_RSBARON_TEMPLATE_ACCORDION_ITEMS');?></h4>
	<div class="row-fluid">
		<div class="span12">
			<table id="items" class="table table-hover table-striped table-condensed">
				<tr>
					<th width="30%"><i class="icon-image hasTip hasTooltip"></i> <?php echo JText::_('TPL_RSBARON_TEMPLATE_ACCORDION_HEADER');?></th>
					<th width="65%"><i class="icon-text-width hasTip hasTooltip"></i> <?php echo JText::_('TPL_RSBARON_TEMPLATE_ACCORDION_TEXT');?></th>
					<th width="5%"></th>
				</tr>
				<tr>
					<td class="middle">
						<input class="input-xlarge" type="text" name="accordion_header[]" value="<?php echo JText::sprintf('TPL_RSBARON_TEMPLATE_ACCORDION_ITEM_HEADER_DEFAULT', 1);?>" />
					</td>
					<td class="middle"><textarea class="input-xxxlarge" name="accordion_text[]" rows="2" placeholder="Enter accordion content" ><?php echo JText::_('TPL_RSBARON_TEMPLATE_ACCORDION_ITEM_TEXT_DEFAULT');?></textarea></td>
					<td class="middle"><a class="delete_row" href="javascript:void(0)"><i class="icon-remove"></i></a></td>
				</tr>
				<tr>
					<td class="middle">
						<input class="input-xlarge" type="text" name="accordion_header[]" value="<?php echo JText::sprintf('TPL_RSBARON_TEMPLATE_ACCORDION_ITEM_HEADER_DEFAULT', 2);?>" />
					</td>
					<td class="middle"><textarea class="input-xxxlarge" name="accordion_text[]" rows="2" placeholder="Enter accordion content" ><?php echo JText::_('TPL_RSBARON_TEMPLATE_ACCORDION_ITEM_TEXT_DEFAULT');?></textarea></td>
					<td class="middle"><a class="delete_row" href="javascript:void(0)"><i class="icon-remove"></i></a></td>
				</tr>
				<tr>
					<td class="middle">
						<input class="input-xlarge" type="text" name="accordion_header[]" value="<?php echo JText::sprintf('TPL_RSBARON_TEMPLATE_ACCORDION_ITEM_HEADER_DEFAULT', 3);?>" />
					</td>
					<td class="middle"><textarea class="input-xxxlarge" name="accordion_text[]" rows="2" placeholder="Enter accordion content" ><?php echo JText::_('TPL_RSBARON_TEMPLATE_ACCORDION_ITEM_TEXT_DEFAULT');?></textarea></td>
					<td class="middle"><a class="delete_row" href="javascript:void(0)"><i class="icon-remove"></i></a></td>
				</tr>
				<tr>
					<td class="middle" colspan="3"><button class="btn btn-small btn-info pull-left" id="new_tab"><i class="icon-plus"></i><?php echo JText::_('TPL_RSBARON_TEMPLATE_CAROUSEL_NEW_ACCORDION_ITEM');?></button></td>
				</tr>
			</table>
		</div>
	</div>
	
	<a class="btn btn-primary pull-left update_preview"><i class="icon-spinner6"></i> <?php echo JText::_('PLG_SYSTEM_RSTEMPLATE_REFRESH_PREVIEW');?></a>
	<div class="row-fluid">
		<div class="span12 rstpl-margin-bottom">
			<h3 class="rstpl-title-color m-large rstpl-box-title"></h3>
			<div class="clearfix"></div><br />
			<div class="rstpl-box-accordion"></div>
		</div>
	</div>

	<div class="clearfix"></div><br />
	<div class="row-fluid">
		<i class="icon-code hasTip hasTooltip nolink"></i> 
		<textarea id="shortcode_preview" cols="19" rows="7" readonly="readonly"></textarea>
	</div>

<script type="text/javascript">
jQuery(document).ready(function(){
	function nl2br (str) {
		var breakTag = '<br />';
		return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
	}
	function br2nl (str) {
		return (str).replace(/<br>/g, '\r');
	}

	function update_shortcode()
	{
		title 		 	= jQuery('#box_title').val();
		container_id 	= title.replace(/([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g, '_')+(new Date).getTime().toString().substring(0,4);
		total_items 	= (jQuery('#items tr').length - 2);

		code 	= '[accordions id="'+container_id+'" heading="'+title+'"]\n';
		for (i = 0; i < total_items; i++) {
			row 		= jQuery('#items tr:eq('+(i+1)+')');
			header 		= row.find('[name="accordion_header[]"]').val();
			accordionid = row.find('[name="accordion_header[]"]').val().replace(/([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g, '_');;
			text 		= row.find('[name="accordion_text[]"]').val();

			code 	+= '\t[accordion title="'+header+'" accordionid="'+accordionid+'"]'+nl2br(text)+'[/accordion]\n';
		}
		code 	+= '[/accordions]';

		jQuery('#shortcode_preview').val(code);
	}

	function update_preview()
	{
		total_items = (jQuery('#items tr').length - 2);
		acc_title	= jQuery('#box_title').val();
		html		= '<div class="accordion" id="rsaccordion">';

		for (i = 0; i < total_items; i++) 
		{
			item 	= jQuery('#items tr:eq('+(i+1)+')').children();
			title 	= item.children('[name="accordion_header[]"]').val();
			accordionid = title.replace(/([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g, '_');
			text 	= item.children('[name="accordion_text[]"]').val();

			html += '<div class="accordion-group"><div class="accordion-heading"><a class="accordion-toggle" data-toggle="collapse" data-parent="#rsaccordion" href="#'+accordionid+'">'+title+'</a></div>';
			html += '<div id="'+accordionid+'" class="accordion-body collapse'+(i==0 ? ' in' : '')+'"><div class="accordion-inner">'+nl2br(text)+'</div></div></div>';
		}

		html += '</div>';

		jQuery('.rstpl-box-accordion').html(html);
		jQuery('.rstpl-box-title').html(acc_title);
		jQuery('#rsaccordion').collapse('show');
		fix_collapse();
	}

	function update_items_table(item) 
	{
		row 	= jQuery('#items tr:eq('+(jQuery('#tabsContent .tab-pane').index(item.parents('.tab-pane'))+1)+')');
		if (item.parent().hasClass('rstpl-box-content')) 
			row.find('[name="accordion_text[]"]').val(br2nl(item.val()));
	}

	/* Fix for bootstrap collapse (accordion) */
	function fix_collapse(){
	
	jQuery('.rstpl-box-accordion').each(function(){
		jQuery(this).find('.accordion-toggle').each(function(i,title){
			if ( jQuery(title).parent().siblings('.accordion-body').hasClass('in') === false )
				jQuery(title).addClass('collapsed');
		});
	});
	jQuery('.accordion-toggle').click(function(){
		jQuery(this).parents('.rstpl-box-accordion').each(function(){
			jQuery(this).find('.accordion-toggle').each(function(i,title){
				jQuery(title).addClass('collapsed');
			});
		});
	});
	}
	/* End Fix for bootstrap collapse (accordion) */
	
	// add new row in the tabs table
	jQuery('#new_tab').click(function(){
		row = jQuery(this).parents('tr').prev().clone();
		jQuery(this).parents('tr').before(row);
	});

	// delete row in the tabs table
	jQuery('.delete_row').live('click',function(){
		if (jQuery('#items tr').length > 3)
			jQuery(this).parent().parent().remove();
	});

	// inserting shortcode to parent editor
	jQuery('#insert_shortcode').click(function() {
		code = jQuery('#shortcode_preview').val();
		if (window.parent) window.parent.jSelectRSTemplateAccordion(code);
		return false;
	});
	
	jQuery('.update_preview').click(function() { update_preview(); update_shortcode(); });

	update_shortcode();
	update_preview();
	
});
</script>
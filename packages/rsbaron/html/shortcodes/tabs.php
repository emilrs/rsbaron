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
			<i class="icon-profile hasTip hasTooltip nolink"></i>
			<input type="text" id="tabs_title" name="tabs_title" class="input-xlarge" value="<?php echo JText::_('TPL_RSBARON_TEMPLATE_TABS_TITLE_DEFAULT_VALUE');?>" rel="tooltip" title="<?php echo JText::_('TPL_RSBARON_TEMPLATE_TABS_TITLE_LABEL');?>" data-placement="bottom" />
		</div>
	</div>
	<h4><?php echo JText::_('TPL_RSBARON_TEMPLATE_TABS_ITEMS');?></h4>
	<div class="row-fluid">
		<div class="span12">
			<table id="items" class="table table-hover table-striped table-condensed">
				<tr>
					<th width="30%"><i class="icon-image hasTip hasTooltip"></i> <?php echo JText::_('TPL_RSBARON_TEMPLATE_TABS_HEADER_COLUMN');?></th>
					<th width="65%"><i class="icon-text-width hasTip hasTooltip"></i> <?php echo JText::_('TPL_RSBARON_TEMPLATE_TABS_TEXT_COLUMN');?></th>
					<th width="5%"></th>
				</tr>
				<tr>
					<td class="middle">
						<input class="input-xlarge" type="text" name="tab_header[]" value="<?php echo JText::sprintf('TPL_RSBARON_TEMPLATE_TABS_HEADER', '1');?>"/>
					</td>
					<td class="middle"><textarea class="input-xxxlarge" name="tab_text[]" rows="2"><?php echo JText::_('TPL_RSBARON_TEMPLATE_TABS_CONTENT');?></textarea></td>
					<td class="middle"><a class="delete_row" href="javascript:;"><i class="icon-trash"></i></a></td>
				</tr>
				<tr>
					<td class="middle">
						<input class="input-xlarge" type="text" name="tab_header[]" value="<?php echo JText::sprintf('TPL_RSBARON_TEMPLATE_TABS_HEADER', '2');?>"/>
					</td>
					<td class="middle"><textarea class="input-xxxlarge" name="tab_text[]" rows="2"><?php echo JText::_('TPL_RSBARON_TEMPLATE_TABS_CONTENT');?></textarea></td>
					<td class="middle"><a class="delete_row" href="javascript:;"><i class="icon-trash"></i></a></td>
				</tr>
				<tr>
					<td class="middle" colspan="3"><button class="btn btn-small btn-info pull-left" id="new_tab"><i class="icon-plus"></i><?php echo JText::_('TPL_RSBARON_TEMPLATE_TABS_NEW_TAB');?></button></td>
				</tr>
			</table>
		</div>
	</div>
	
	<a class="btn btn-primary pull-left update_preview"><i class="icon-spinner6"></i> <?php echo JText::_('PLG_SYSTEM_RSTEMPLATE_REFRESH_PREVIEW');?></a>
	<div class="row-fluid">
		<div class="span12 rstpl-margin-bottom">

			<h3 class="rstpl-title-color m-large rstpl-box-title"></h3>
			
			<div class="rstpl-box-tabs">
				<ul id="tabsHeaders" class="nav nav-tabs"></ul>
				<div id="tabsContent" class="tab-content rstpl-padding"></div>
			</div>
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
		title 		 	= jQuery('#tabs_title').val();
		container_id 	= title.replace(/([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g, '_')+(new Date).getTime().toString().substring(0,4);
		total_items 	= (jQuery('#items tr').length - 2);

		code 	= '[tabs id="'+container_id+'" heading="'+title+'"]\n';
		for (i = 0; i < total_items; i++) {
			row 	= jQuery('#items tr:eq('+(i+1)+')');
			header 	= row.find('[name="tab_header[]"]').val();
			tabid 	= row.find('[name="tab_header[]"]').val().replace(/([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g, '_');;
			text 	= row.find('[name="tab_text[]"]').val();

			code 	+= '\t[tab title="'+header+'" tabid="'+tabid+'"]'+nl2br(text)+'[/tab]\n';
		}

		code 	+= '[/tabs]';

		jQuery('#shortcode_preview').val(code);
	}

	function update_preview()
	{
		total_items 	= (jQuery('#items tr').length - 2);
		tabs_title		= jQuery('#tabs_title').val();
		html_headers 	= '<ul id="tabsHeaders" class="nav nav-tabs">';
		html_content 	= '<div id="tabsContent" class="tab-content rstpl-padding">';

		for (i = 0; i < total_items; i++) 
		{
			item 	= jQuery('#items tr:eq('+(i+1)+')').children();
			title 	= item.children('[name="tab_header[]"]').val();
			item_id = title.replace(/([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g, '_');
			text 	= item.children('[name="tab_text[]"]').val();

			html_headers += '<li'+( i == 0 ? ' class="active"' : '' )+'><a href="#'+item_id+'" data-toggle="tab" class="rstpl-box-header">'+title+'</a></li>';
			html_content += '<div class="tab-pane'+( i == 0 ? ' active' : '' )+'" id="'+item_id+'"><div class="rstpl-box-content">'+nl2br(text)+'</div></div>';
		}

		html_headers 	+= '</ul>';
		html_content 	+= '</div>';

		jQuery('.rstpl-box-tabs').html(html_headers+html_content);
		jQuery('.rstpl-box-title').html(tabs_title);
		jQuery('.rstpl-box-tabs').tab('show');
	}

	function update_items_table(item) 
	{
		row 	= jQuery('#items tr:eq('+(jQuery('#tabsContent .tab-pane').index(item.parents('.tab-pane'))+1)+')');
		if (item.parent().hasClass('rstpl-box-content')) 
			row.find('[name="tab_text[]"]').val(br2nl(item.val()));
	}

	// add new row in the tabs table
	jQuery('#new_tab').click(function(){
		row = jQuery(this).parents('tr').prev().clone();
		jQuery(this).parents('tr').before(row);

		update_shortcode();
		update_preview();
	});

	// delete row in the tabs table
	jQuery('.delete_row').live('click',function(){
		if (jQuery('#items tr').length > 3)
			jQuery(this).parent().parent().remove();

		update_shortcode();
		update_preview();
	});

	// inserting shortcode to parent editor
	jQuery('#insert_shortcode').click(function() {
		code = jQuery('#shortcode_preview').val();
		if (window.parent) window.parent.jSelectRSTemplateTabs(code);
		return false;
	});
	
	jQuery('.update_preview').click(function() { update_preview(); update_shortcode(); });

	update_preview();
	update_shortcode();
});
</script>
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
			<i class="icon-list2 hasTip hasTooltip nolink"></i>
			<input type="text" id="items_per_slide" class="input-small" value="1" rel="tooltip" data-placement="bottom" title="<?php echo JText::_('TPL_RSBARON_TEMPLATE_CAROUSEL_ITEMS_PER_SLIDE_LABEL');?>" />
			<i class="icon-profile hasTip hasTooltip nolink" ></i>
			<input type="text" id="box_title" name="box_title" class="input-xlarge" value="<?php echo JText::_('TPL_RSBARON_TEMPLATE_CAROUSEL_TITLE_PLACEHOLDER');?>" rel="tooltip" data-placement="bottom" title="<?php echo JText::_('TPL_RSBARON_TEMPLATE_CAROUSEL_TITLE_LABEL');?>"/>
		</div>
	</div>
	<h4><?php echo JText::_('TPL_RSBARON_TEMPLATE_CAROUSEL_ITEMS');?></h4>
	<div class="row-fluid">
		<div class="span12">
			<table id="slides" class="table table-hover table-striped table-condensed">
				<tr>
					<th width="30%"><i class="icon-image hasTip hasTooltip"></i> <?php echo JText::_('TPL_RSBARON_TEMPLATE_CAROUSEL_IMAGE_URL');?></th>
					<th width="65%"><i class="icon-text-width hasTip hasTooltip"></i> <?php echo JText::_('TPL_RSBARON_TEMPLATE_CAROUSEL_TEXT');?></th>
					<th width="5%"></th>
				</tr>
				<tr>
					<td class="middle">
						<input class="input-xlarge" type="text" name="slide_url[]" value="<?php echo JURI::root(true);?>/templates/<?php echo $template->template;?>/images/sampledata/images/300x300-5.jpg"/>
						<input class="input-small" type="text" name="slide_url_w[]" value="400" rel="tooltip" title="width" /> px
						<input class="input-small" type="text" name="slide_url_h[]" value="400" rel="tooltip" title="height" /> px
					</td>
					<td class="middle">
					<input class="input-xxlarge" type="text" name="slide_title[]" value="<?php echo JText::_('TPL_RSBARON_TEMPLATE_CAROUSEL_SLIDE_TITLE_DEFAULT');?>"/>
					<textarea class="input-xxxlarge" name="slide_text[]" rows="2"><?php echo JText::_('TPL_RSBARON_TEMPLATE_CAROUSEL_SLIDE_TEXT_DEFAULT');?></textarea></td>
					<td class="middle"><a class="delete_row" href="javascript:;"><i class="icon-remove"></i></a></td>
				</tr>
				<tr>
					<td class="middle">
						<input class="input-xlarge" type="text" name="slide_url[]" value="<?php echo JURI::root(true);?>/templates/<?php echo $template->template;?>/images/sampledata/images/300x300-6.jpg"/>
						<input class="input-small" type="text" name="slide_url_w[]" value="400" rel="tooltip" title="width" /> px
						<input class="input-small" type="text" name="slide_url_h[]" value="400" rel="tooltip" title="height" /> px
					</td>
					<td class="middle">
					<input class="input-xxlarge" type="text" name="slide_title[]" value="<?php echo JText::_('TPL_RSBARON_TEMPLATE_CAROUSEL_SLIDE_TITLE_DEFAULT');?>"/>
					<textarea class="input-xxxlarge" name="slide_text[]" rows="2"><?php echo JText::_('TPL_RSBARON_TEMPLATE_CAROUSEL_SLIDE_TEXT_DEFAULT');?></textarea></td>
					<td class="middle"><a class="delete_row" href="javascript:;"><i class="icon-remove"></i></a></td>
				</tr>
				
				<tr>
					<td class="middle" colspan="3">
						<button class="btn btn-small btn-info pull-left" id="new_slide"><i class="icon-new"></i> <?php echo JText::_('TPL_RSBARON_TEMPLATE_CAROUSEL_NEW_SLIDE');?></button> &nbsp; &nbsp;
					</td>
				</tr>
			</table>
		</div>
	</div>

	<a class="btn btn-primary pull-left update_preview"><i class="icon-spinner6"></i> <?php echo JText::_('PLG_SYSTEM_RSTEMPLATE_REFRESH_PREVIEW');?></a>
	<div class="clearfix"></div>
	<div class="row-fluid">
		<div class="span12 rstpl-margin-bottom">
			<div id="carousel1" class="carousel slide rstpl-box-carousel-full m-large rstpl-padding">
				<h2 class="rstpl-box-title rstpl-padding"><?php echo JText::_('TPL_RSBARON_TEMPLATE_CAROUSEL_TITLE_PLACEHOLDER');?></h2>
				<div class="carousel-inner">
					<div class="item active">
						<div class="span12">
							<img src="<?php echo JURI::root(true);?>/templates/<?php echo $template->template;?>/images/sampledata/images/300x300-6.jpg" class="rstpl-box-image pull-left" style="width:400px;4eight:300px;" alt="" />
							<h4 class="rstpl-slide-title"><?php echo JText::_('TPL_RSBARON_TEMPLATE_CAROUSEL_SLIDE_TITLE_DEFAULT');?></h4>
							<div class="rstpl-slide-content"><?php echo JText::_('TPL_RSBARON_TEMPLATE_CAROUSEL_SLIDE_TEXT_DEFAULT');?></div>
						</div>
					</div>
				</div>
				<a class="left carousel-control" href="#carousel1" data-slide="prev" rel="nofollow"><i class="icon-angle-left"></i></a>
				<a class="right carousel-control" href="#carousel1" data-slide="next" rel="nofollow"><i class="icon-angle-right"></i></a>
			</div>
		</div>
	</div>

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
			total_items 	= (jQuery('#slides tr').length - 2);
			items_per_slide = (jQuery('#items_per_slide').val() == '' ? 1 : parseInt(jQuery('#items_per_slide').val()));

			code 	= '[carousel id="'+container_id+'" items="'+items_per_slide+'" heading="'+title+'"]\n';
			for (i = 0; i < total_items; i++) {
				row			= jQuery('#slides tr:eq('+(i+1)+')');
				image 		= row.find('[name="slide_url[]"]').val();
				width 		= row.find('[name="slide_url_w[]"]').val();
				height 		= row.find('[name="slide_url_h[]"]').val();
				slide_title = row.find('[name="slide_title[]"]').val();
				slide_text 	= row.find('[name="slide_text[]"]').val();

				code 	+= '\t[image] <img src="'+image+'" alt="" width="'+width+'" height="'+height+'" /> [/image]\n';
				code 	+= '\t[title]'+nl2br(slide_title)+'[/title]\n';
				code 	+= '\t[text]'+nl2br(slide_text)+'[/text]\n';
			}
			code 	+= '[/carousel]';

			jQuery('#shortcode_preview').val(code);
		}

		function update_preview()
		{
			total_items 	= (jQuery('#slides tr').length - 2);
			items_per_slide = (jQuery('#items_per_slide').val() == '' ? 1 : parseInt(jQuery('#items_per_slide').val()));
			title 		 	= jQuery('#box_title').val();
			html			= '<div class="item active">';

			for (i = 0; i < total_items; i++) {
				image 		= jQuery('#slides tr:eq('+(i+1)+')').children().children('[name="slide_url[]"]').val();
				width 		= jQuery('#slides tr:eq('+(i+1)+')').children().children('[name="slide_url_w[]"]').val();
				height 		= jQuery('#slides tr:eq('+(i+1)+')').children().children('[name="slide_url_h[]"]').val();
				slide_title = jQuery('#slides tr:eq('+(i+1)+')').children().children('[name="slide_title[]"]').val();
				slide_text 	= jQuery('#slides tr:eq('+(i+1)+')').children().children('[name="slide_text[]"]').val();
				html 	+= '<div class="span'+Math.round((12/items_per_slide))+'">';
				if ( image != '') {
					html	+= '<img src="'+image+'" class="rstpl-slide-image pull-left" style="width:'+width+'px; height:'+height+'px" alt="" />';
				}
				html	+= '<h4 class="rstpl-slide-title">'+nl2br(slide_title)+'</h4>';
				html	+= '<div class="rstpl-slide-content">'+nl2br(slide_text)+'</div></div>';

				if ( ((i+1)%items_per_slide) == 0 && (i+1) < total_items) 
					html 	+= '</div><div class="item">';
			}
			html += '</div>';

			jQuery('.rstpl-box-carousel-full h2').html(title);

			if (total_items > items_per_slide) 
				jQuery('.rstpl-box-carousel-full .carousel-inner').html(html);

			jQuery('#carousel1').carousel('pause');
		}

		function update_slides_table(item) 
		{
			row 	= jQuery('#slides tr:eq('+(jQuery('.carousel-inner').find('div[class^="span"]').index( item.parents('div[class^="span"]') )+1)+')');
			if (item.parent().hasClass('rstpl-box-image')) 
				row.find('[name="slide_url[]"]').val(item.val());

			if (item.parent().hasClass('rstpl-slide-title')) 
				row.find('[name="slide_title[]"]').val(br2nl(item.val()));
			if (item.parent().hasClass('rstpl-slide-content')) 
				row.find('[name="slide_text[]"]').val(br2nl(item.val()));
		}

		// add new row in the slides table
		jQuery('#new_slide').click(function(){
			row = jQuery(this).parents('tr').prev().clone();
			jQuery(this).parents('tr').before(row);
			
			jQuery('[rel="tooltip"]').tooltip();
		});

		// delete row in the slides table
		jQuery('.delete_row').live('click',function(){
			if (jQuery('#slides tr').length > 3)
				jQuery(this).parent().parent().remove();
		});

		// inserting shortcode to parent editor
		jQuery('#insert_shortcode').click(function() {
			code = jQuery('#shortcode_preview').val();
			if (window.parent) window.parent.jSelectRSTemplateCarousel(code);
			return false;
		});

		jQuery('.update_preview').click(function() { update_preview(); update_shortcode(); });

		update_preview();
		update_shortcode();
	});
</script>
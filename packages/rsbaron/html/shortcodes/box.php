<?php
/**
* @version 1.0.0
* @package RSTemplate! 1.0.0
* @copyright (C) 2007-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-2.0.html
*/
defined('_JEXEC') or die;
?>
	<div class="row m-small">
		<div class="control-group box_type">
			<label class="control-label hasTip hasTooltip nolink"><?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_TYPE');?></label>
			<select name="box_style" id="box_style" class="input-xlarge">
				<option value="full-width-horizontal-icon"><?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_TYPE_FULL_WIDTH_HORIZONTAL_ICON'); ?></option>
				
				
				<option value="featured"><?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_TYPE_FEATURED');?></option>
				<option value="simple-horizontal-image-small"><?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_TYPE_SIMPLE_HORIZONTAL_IMAGE_SMALL');?></option>
				<option value="simple-vertical-image"><?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_TYPE_SIMPLE_VERTICAL_IMAGE');?></option>
				<option value="simple-vertical-image-small"><?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_TYPE_SIMPLE_VERTICAL_IMAGE_SMALL');?></option>
				<option value="simple-horizontal-image"><?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_TYPE_SIMPLE_HORIZONTAL_IMAGE');?></option>
				<option value="full-width-horizontal-image"><?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_TYPE_FULL_WIDTH_HORIZONTAL_IMAGE'); ?></option>
				<option value="price"><?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_TYPE_PRICE');?></option>
				<option value="price-highlight"><?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_TYPE_PRICE_HIGHLIGHT');?></option>
				<option value="personal"><?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_TYPE_PERSONAL');?></option>
				
				
				
				

				<option value="full-width-dark-horizontal-icon"><?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_TYPE_FULL_WIDTH_DARK_HORIZONTAL_ICON');?></option>
				<option value="full-width-dark-vertical-icon"><?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_TYPE_FULL_WIDTH_DARK_VERTICAL_ICON');?></option>
				<option value="simple-vertical-icon"><?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_TYPE_SIMPLE_VERTICAL_ICON');?></option>
				<option value="simple-horizontal-icon"><?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_TYPE_SIMPLE_HORIZONTAL_ICON');?></option>
				
			</select>
		</div>
		<div class="clearfix"></div>
		<div id="options" class="row-fluid form form-vertical"></div>
	</div>
	<a class="btn btn-primary pull-left update_preview"><i class="icon-spinner6"></i> <?php echo JText::_('PLG_SYSTEM_RSTEMPLATE_REFRESH_PREVIEW');?></a>
	<div class="clearfix"></div>
	<div class="row-fluid m-small">
		<div class="span12" id="box_preview"></div>
	</div>
	<div class="row-fluid m-small">
		<i class="icon-code hasTip hasTooltip nolink"></i>
		<textarea id="shortcode_preview" cols="19" rows="7"></textarea>
	</div>
	<div class="modal" id="icons-modal">
		<div class="modal-header">
			<button class="close pull-right" id="close-modal">&times;</button>
			<div class="pagination nav nav-tabs" id="icons-pagination"><ul></ul></div>
		</div>
		<div class="modal-body">
			<div class="clearfix"></div>
			<div id="IconsList" class="tabs slide">
				<div class="tab-content" id="icons-content"></div>
			</div>
		</div>
	</div>

<script type="text/javascript">
	var IconsArray = new Array("quill","pen","blog","pawn","bullhorn","connection","podcast","feed","book","library","books","file","profile","copy","copy2","copy3","paste","paste2","paste3","stack","folder","folder-open","tag","tags","barcode","play","headphones","music","camera","images","image","home","home2","home3","office","newspaper","pencil2","droplet","paint-format","image2","film","camera2","dice","pacman","diamonds","file2","file3","file4","spades","clubs","qrcode","ticket","cart","cart2","cart3","coin","credit","calculate","support","phone","phone-hang-up","notebook","address-book","envelop","pushpin","location","location2","compass","map","map2","history","clock","clock2","alarm","alarm2","bell","stopwatch","drawer","drawer2","cabinet","tv","tablet","mobile","mobile2","laptop","screen","keyboard","print2","calendar","calendar2","drawer3","box-add","box-remove","download","upload","disk","storage","undo","redo","flip","flip2","undo2","redo2","forward","reply","bubble","bubbles","bubbles2","bubble2","bubbles3","bubbles4","user","users","user2","users2","user3","user4","quotes-left","busy","spinner","spinner2","spinner3","spinner4","spinner5","spinner6","binoculars","search","zoom-in","zoom-out","expand","contract","expand2","contract2","key","key2","lock","lock2","unlocked","wrench","settings","equalizer","cog","cogs","cog2","hammer","wand","aid","bug","pie","stats","bars","bars2","gift","trophy","glass","mug","food","leaf","rocket","meter","meter2","dashboard","hammer2","fire","lab","magnet","remove","remove2","briefcase","airplane","truck","road","accessibility","target","shield","lightning","switch","power-cord","signup","list","list2","numbered-list","menu","menu2","tree","cloud","cloud-download","cloud-upload","download2","upload2","download3","upload3","globe","earth","link","flag","attachment","eye","eye-blocked","eye2","bookmark","bookmarks","brightness-medium","brightness-contrast","contrast","star","star2","star3","heart","heart2","heart-broken","thumbs-up","thumbs-up2","happy","happy2","smiley","smiley2","tongue","tongue2","sad","sad2","wink","wink2","grin","grin2","cool","cool2","angry","angry2","evil","evil2","shocked","shocked2","confused","confused2","neutral","neutral2","wondering","wondering2","point-up","point-right","point-down","point-left","warning","notification","question","info","info2","blocked","cancel-circle","checkmark-circle","spam","close","checkmark","checkmark2","spell-check","minus","plus","enter","exit","play2","pause","stop","backward","forward2","play3","pause2","stop2","backward2","forward3","first","last","previous","next","eject","volume-high","volume-medium","volume-low","volume-mute","volume-mute2","volume-increase","volume-decrease","loop","loop2","loop3","shuffle","arrow-up-left","arrow-up","arrow-up-right","arrow-right","arrow-down-right","arrow-down","arrow-down-left","arrow-left","arrow-up-left2","arrow-up2","arrow-up-right2","arrow-right2","arrow-down-right2","arrow-down2","arrow-down-left2","arrow-left2","arrow-up-left3","arrow-up3","arrow-up-right3","arrow-right3","arrow-down-right3","arrow-down3","arrow-down-left3","arrow-left3","tab","checkbox-checked","checkbox-unchecked","checkbox-partial","radio-checked","radio-unchecked","crop","scissors","filter","filter2","font","text-height","text-width","bold","underline","italic","strikethrough","omega","sigma","table","table2","insert-template","pilcrow","left-toright","right-toleft","paragraph-left","paragraph-center","paragraph-right","paragraph-justify","paragraph-left2","paragraph-center2","paragraph-right2","paragraph-justify2","indent-increase","indent-decrease","new-tab","embed","code","console","share","mail","mail2","mail3","mail4","google","google-plus","google-plus2","google-plus3","google-plus4","google-drive","facebook","facebook2","facebook3","instagram","twitter","twitter2","twitter3","feed2","feed3","feed4","youtube","youtube2","vimeo","vimeo2","vimeo3","lanyrd","flickr","flickr2","flickr3","flickr4","picassa","picassa2","dribbble","dribbble2","dribbble3","forrst","forrst2","deviantart","deviantart2","steam","steam2","github","github2","github3","github4","github5","wordpress","wordpress2","tumblr","yahoo","tux","apple","finder","android","windows","windows8","soundcloud","lastfm","lastfm2","delicious","stumbleupon","stumbleupon2","stackoverflow","pinterest","pinterest2","xing","paypal","paypal2","paypal3","yelp","libreoffice","file-pdf","file-openoffice","file-word","file-excel","html5","html52","css3","chrome","firefox","IE","opera","safari","IcoMoon","file-css","file-xml","file-powerpoint","file-zip","foursquare","foursquare2","flattr","xing2","linkedin","reddit","skype","soundcloud2","tumblr2","blogger","blogger2","joomla");

jQuery(document).ready(function(){

	function nl2br (str) 
	{
		var breakTag = '<br />';
		return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
	}
	function br2nl (str) 
	{
		return (str).replace(/<br>/g, '\r');
	}
	function get_config(box_style)
	{
		box_config  = {};
		defaults 	= {};
		defaults.title 	  = '<?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_DEFAULT_TITLE');?>';
		defaults.subtitle = '<?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_DEFAULT_SUBTITLE');?>';
		defaults.price 	  = '<?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_DEFAULT_PRICE');?>';
		defaults.text 	  = '<?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_DEFAULT_TEXT');?>';
		defaults.link 	  = '<?php echo JText::_('TPL_RSBARON_TEMPLATE_BOX_DEFAULT_LINK');?>';
		defaults.icon 	  = 'icon-bubbles2';

		// Boxes Configuration
		box_config['featured'] 					= {'class': 'rstpl-box-featured rstpl-padding', 'span': 5, 'elements' : {'price': defaults.price, 'title': defaults.title, 'text': defaults.text, 'link': defaults.link}};
		
		box_config['simple-vertical-image'] 	= {'class': 'rstpl-box-image-vertical', 'span': 5, 'elements': {'title' : defaults.title, 'image': '<?php echo JURI::root(true);?>/templates/<?php echo $template->template;?>/images/sampledata/images/300x300-4.jpg', 'text': defaults.text, 'buttons' : { 'buttons_label' : ['Read More'], 'buttons_link' : [defaults.link]}}};

		box_config['simple-vertical-image-small'] 	= {'class': 'rstpl-box-image-vertical-small', 'span': 5, 'elements': {'text': defaults.text, 'title' : defaults.title, 'subtitle' : defaults.subtitle, 'image': '<?php echo JURI::root(true);?>/templates/<?php echo $template->template;?>/images/sampledata/images/300x300-7.jpg'}};

		box_config['simple-horizontal-image'] 	= {'class': 'rstpl-box-image-left m-bot-large', 'span' : 6, 'elements': {'image': '<?php echo JURI::root(true);?>/templates/<?php echo $template->template;?>/images/sampledata/images/300x300-5.jpg', 'title': defaults.title, 'text': defaults.text,'price': defaults.price, 'buttons' : {'buttons_label' : ['Read More'], 'buttons_link' : [defaults.link]}}};

		box_config['simple-horizontal-image-small'] 	= {'class': 'rstpl-box-image-left-small m-bot-small', 'span' : 5, 'elements': { 'image': '<?php echo JURI::root(true);?>/templates/<?php echo $template->template;?>/images/sampledata/images/100x100-2.jpg', 'link': defaults.link, 'title': defaults.title, 'text': defaults.text}};
		
						
		box_config['full-width-horizontal-icon'] 	= {'class': 'rstpl-box-big-img rstpl-padding', 'span': 12, 'elements': {'title': defaults.title, 'buttons' : { 'buttons_label' : ['GET A QUOTE'], 'buttons_link' : [defaults.link]}, 'image': '<?php echo JURI::root(true);?>/templates/<?php echo $template->template;?>/images/box-big-image.png'}};
		
		box_config['full-width-horizontal-image'] 		= {'class': 'rstpl-box-full-horizontal-image', 'span': 12, 'elements': {'image': '<?php echo JURI::root(true);?>/templates/<?php echo $template->template;?>/images/sampledata/images/300x300-4.jpg', 'title': defaults.title, 'text': defaults.text, 'buttons' : { 'buttons_label' : ['REGISTER', 'READ MORE'], 'buttons_link' : [defaults.link, defaults.link]}}};

		
		box_config['price'] 							= {'class': 'rstpl-box-pricing', 'span': 4, 'elements': {'title': defaults.title, 'price': defaults.price, 'text': defaults.text, 'features': defaults.features, 'buttons' : { 'buttons_label' : ['Buy Now'], 'buttons_link' : [defaults.link]}}};
		
		box_config['price-highlight'] 					= {'class': 'rstpl-box-pricing highlight', 'span': 4, 'elements': {'title': defaults.title, 'price': defaults.price, 'text': defaults.text, 'features': defaults.features, 'buttons' : { 'buttons_label' : ['Buy Now'], 'buttons_link' : [defaults.link]}}};

		box_config['personal'] 							= {'class': 'rstpl-box-personal m-bot-large', 'span': 4, 'elements': {'image': '<?php echo JURI::root(true);?>/templates/<?php echo $template->template;?>/images/sampledata/images/300x300-7.jpg', 'link': defaults.link, 'title': defaults.title, 'subtitle': defaults.subtitle, 'text': defaults.text, 'social_links':4}};


			
		

		
		
		
		box_config['full-width-dark-vertical-image'] 	= {'class': 'rstpl-box-big-img rstpl-padding', 'span': 12, 'elements': {'title': defaults.title, 'buttons' : { 'buttons_label' : ['GET A QUOTE'], 'buttons_link' : [defaults.link]}, 'image': '<?php echo JURI::root(true);?>/templates/<?php echo $template->template;?>/images/box-big-image.png'}};
		box_config['full-width-dark-vertical-icon'] 	= {'class': 'rstpl-box-big-icon-center rstpl-padding m-bot-large', 'span': 12, 'elements': {'icon': 'icon-twitter', 'text': defaults.text}};
		box_config['simple-vertical-icon'] 				= {'class': 'rstpl-box-thumb-top rstpl-padding', 'span': 5, 'elements': {'icon': defaults.icon, 'title': defaults.title, 'text': defaults.text, 'buttons' : { 'buttons_label' : ['Read more'], 'buttons_link' : [defaults.link]}}};
		box_config['simple-horizontal-icon'] 			= {'class': 'rstpl-box-thumb-left m-bot-large', 'span' : 5, 'elements': {'icon': defaults.icon, 'title': defaults.title, 'text': defaults.text}};
		

		return box_config[box_style];
	}

	function generate_config_fields(elements)
	{
		html = new Array();
		current_values = {};

		jQuery.each(elements, function(property, value) 
		{
			if (property == 'title') 
				html.push('<div class="control-group"><label class="control-label">Box Title </label><input type="text" name="box_title" class="input-xxlarge" value="'+value+'" /></div>');
			if (property == 'subtitle') 
				html.push('<div class="control-group"><label class="control-label">Box Subtitle </label><input type="text" name="box_subtitle" class="input-xxlarge" value="'+value+'" /></div>');
			if (property == 'link') 
				html.push('<div class="control-group"><label class="control-label">Link </label><input type="text" name="box_link" class="input-large" value="'+value+'" /></div>');
			if (property == 'price') 
				html.push('<div class="control-group"><label class="control-label">Price </label><input type="text" name="box_price" class="input-mini" value="'+value+'" /></div>');
			if (property == 'icon') 
				html.push('<div class="control-group"><label class="control-label">Icon</label><input type="hidden" name="box_icon" class="input-small box_icon" value="'+value+'" /><a class="select_icon_btn" href="javascript:;"><i class="'+value+'"></i></a></div>');
			if (property == 'image') 
				html.push('<div class="control-group"><label class="control-label">Image Url </label><input type="text" name="box_image_url" class="input-xxlarge" value="'+value+'" /></div>');
			if (property == 'text') 
				html.push('<div class="clearfix"></div><div class="control-group"><label class="control-label">Text </label><textarea name="box_text" class="input-xxlarge">'+value+'</textarea></div>');
			if (property == 'buttons') {
				html.push('<div id="buttons" class="">');

				for (b=0; b < value.buttons_label.length; b++) {
					html.push('<div class="control-group"><label class="control-label">Button Label</label><input type="text" name="box_button_label[]" class="input-large" value="'+value.buttons_label[b] +'" /><label class="control-label">Button Link </label><input type="text" name="box_button_link[]" class="input-xlarge" value="'+value.buttons_link[b]+'" /></div>');
				}
				html.push('</div>');
			}
			if (property == 'social_links') {
				social_classes = ['icon-facebook2', 'icon-twitter2', 'icon-linkedin', 'icon-google-plus3', 'icon-plus'];
				social_links = ['http://www.facebook.com/', 'http://www.twitter.com/', 'http://www.linkedin.com/', 'https://plus.google.com/', 'http://www.example.com/'];
				html.push('<div class="clearfix"></div><div id="social">');
				for (s=0; s<value; s++) 
					html.push('<div class="control-group pull-left span2"><br /><input type="hidden" name="box_social_icon[]" class="input-small box_icon" value="'+social_classes[s]+'" /><a href="javascript:;" class="select_icon_btn"><i class="'+social_classes[s]+'"></i></a><input type="text" name="box_social_link[]" class="input-medium" value="'+social_links[s]+'" /><input type="text" name="box_social_link_attributes[]" class="input-medium" value=\'target="_blank" title="Social link"\'/></div>');
				html.push('</div>');
			}
			if (property == 'features') {
				html.push('<div class="clearfix"></div><div id="features" class="form form-vertical pull-left">');
				for (f=0; f<5; f++) 
					html.push('<div class="control-group pull-left"><label class="control-label">Feature '+(f+1)+' </label><input type="text" name="box_features[]" class="input-large" value="Feature '+(f+1)+'" /></div>');
				html.push('</div>');
			}
		});

		jQuery('#options').empty().html(html.join(''));
	}

	function update_shortcode()
	{
		container_id 	= 'rstpl-random-id-'+(new Date).getTime().toString().slice(0,4);
		if (jQuery('[name="box_title"]').length > 0)
			container_id 	= jQuery('[name="box_title"]').val().replace(/([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g, '_');

		box_style    = jQuery('#box_style').find(":selected").val();
		box_config   = get_config(box_style);

		icon 		 = jQuery('[name="box_icon"]').val();
		image 		 = jQuery('[name="box_image_url"]').val();
		title 		 = jQuery('[name="box_title"]').val();
		subtitle 	 = jQuery('[name="box_subtitle"]').val();
		link	 	 = jQuery('[name="box_link"]').val();
		price		 = jQuery('[name="box_price"]').val();

		if (price) { 
			price_parts  = jQuery('[name="box_price"]').val().split('.');
			price 		 = price_parts[0];
			if (price_parts[1]) 
				price 	+= '<sup>.'+price_parts[1]+'</sup>';
		}
		text 		 = jQuery('[name="box_text"]').val();
		buttons_link = [];
		jQuery('[name="box_button_link[]"]').each(function(){  buttons_link.push(jQuery(this).val()); });
		buttons_label = [];
		jQuery('[name="box_button_label[]"]').each(function(){  buttons_label.push(jQuery(this).val()); });
		buttons_icon = [];
		jQuery('[name="box_social_icon[]"]').each(function(){  buttons_icon.push(jQuery(this).val()); });
		buttons_social_link = [];
		jQuery('[name="box_social_link[]"]').each(function(){  buttons_social_link.push(jQuery(this).val()); });
		box_social_link_attributes = [];
		jQuery('[name="box_social_link_attributes[]"]').each(function(){  box_social_link_attributes.push(jQuery(this).val()); });
		features = [];
		jQuery('[name="box_features[]"]').each(function(){  if ( jQuery(this).val() ) { features.push(jQuery(this).val()); } });
		
		code 	= '[box id="'+container_id+'" boxtype="'+box_style+'" class="'+box_config.class+'"]\n';
		if (icon) code	+= '\t[icon]'+icon+'[/icon]\n';
		if (image) code += '\t[image]<img src="'+image+'" alt="" />[/image]\n';
		if (title) code	+= '\t[title]'+title+'[/title]\n';
		if (link) code	+= '\t[link]'+link+'[/link]\n';
		if (subtitle) code	+= '\t[subtitle]'+subtitle+'[/subtitle]\n';
		if (price) code	+= '\t[price]'+price+'[/price]\n';
		if (text) code	+= '\t[text]'+nl2br(text)+'[/text]\n';
		if (buttons_link) {
			for (i=0; i < buttons_link.length; i++)	
				code += '\t[button href="'+buttons_link[i]+'"]'+buttons_label[i]+'[/button]\n';
		}
		if (buttons_social_link) {
			for (i=0; i < buttons_social_link.length; i++) 
				code += '\t[social href="'+buttons_social_link[i]+'" '+box_social_link_attributes[i]+']'+buttons_icon[i]+'[/social]\n';
		}
		if (features) {
			for (i=0; i < features.length; i++)	
				code += '\t[feature]'+features[i]+'[/feature]\n';
		}
		
		code 	+= '[/box]';

		jQuery('#shortcode_preview').val(code);
	}

	function update_preview()
	{
		box_style    = jQuery('#box_style').find(":selected").val();
		box_config   = get_config(box_style);

		// Fetching values from fields
		icon 	 = jQuery('[name="box_icon"]').val();
		image 	 = jQuery('[name="box_image_url"]').val();
		title 	 = jQuery('[name="box_title"]').val();
		subtitle = jQuery('[name="box_subtitle"]').val();
		price	 = jQuery('[name="box_price"]').val();
		link	 = jQuery('[name="box_link"]').val();
		if (price) { 
			price_parts  = jQuery('[name="box_price"]').val().split('.');
			price 		 = price_parts[0];
			if (price_parts[1]) 
				price 	+= '<sup>.'+price_parts[1]+'</sup>';
		}
		text 		 = nl2br(jQuery('[name="box_text"]').val());
		buttons_link = [];
		jQuery('[name="box_button_link[]"]').each(function(){  buttons_link.push(jQuery(this).val()); });
		buttons_label = [];
		jQuery('[name="box_button_label[]"]').each(function(){  buttons_label.push(jQuery(this).val()); });
		buttons_icon = [];
		jQuery('[name="box_social_icon[]"]').each(function(){  buttons_icon.push(jQuery(this).val()); });
		buttons_social_link = [];
		jQuery('[name="box_social_link[]"]').each(function(){  buttons_social_link.push(jQuery(this).val()); });
		features = [];
		jQuery('[name="box_features[]"]').each(function(){ if ( jQuery(this).val() ) { features.push(jQuery(this).val()); } });


		// Generating HTML structure for boxes and populating them with the input values
		preview_box	 = [];
		preview_box['featured'] 		 				= '<div class="'+box_config.class+'"><h3 class="rstpl-box-title m-bot-small"><a href="'+link+'">'+title+'</a></h3><span class="rstpl-box-price">'+price+'</span><div class="rstpl-box-content">'+text+'</div></div>';
		preview_box['simple-vertical-image'] 			= '<div class="'+box_config.class+'"><div class="rstpl-box-image"><img src="'+image+'" alt="" width="100%" /></div><div class="rstpl-box-content"><h3 class="rstpl-box-title m-bot-small">'+title+'</h3>'+text+'<a class="btn btn-primary rstpl-box-link" href="'+buttons_link[0]+'">'+buttons_label[0]+'</a></div></div>';

		preview_box['simple-vertical-image-small'] 	= '<div class="'+box_config.class+'"><div class="rstpl-box-content">'+text+'<h4 class="rstpl-box-title m-top-small">'+title+'</h4><h5 class="rstpl-box-subtitle">'+subtitle+'</h5></div><div class="rstpl-box-image m-top-small"><img src="'+image+'" alt="" /></div></div>';

		preview_box['simple-horizontal-image'] 			= '<div class="'+box_config.class+'" ><div class="rstpl-box-image pull-left span4"><img src="'+image+'" alt="" /><div class="rstpl-mask"><a href="'+buttons_link[0]+'"><i class="icon-plus2"></i></a></div></div><div class="span8"><h4 class="rstpl-box-title">'+title+'</h4><div class="rstpl-box-content">'+text+'</div><span class="rstpl-box-price">'+price+'</span><a class="btn btn-primary rstpl-box-link pull-right" href="'+buttons_link[0]+'">'+buttons_label[0]+'</a></div></div>';
		
		preview_box['simple-horizontal-image-small'] 	= '<div class="'+box_config.class+'" ><div class="rstpl-box-image pull-left span2"><img src="'+image+'" alt="" /><div class="rstpl-mask"><a href="'+link+'"><i class="icon-plus2"></i></a></div></div><div class="span10"><h5 class="rstpl-box-title">'+title+'</h5><div class="rstpl-box-content">'+text+'</div></div></div>';

		features_html = '';
		for (i=0; i<features.length; i++) 
			features_html += '<tr><td>'+features[i]+'</td></tr>';
		preview_box['price'] 							= '<div class="'+box_config.class+'"><h3 class="rstpl-box-title">'+title+'</h3><span class="rstpl-box-price">'+price+'</span><div class="rstpl-box-content">'+text+'</div><table class="table center"><tbody>'+features_html+'<tr><td><a href="'+buttons_link[0]+'" class="btn btn-large btn-inverse">'+buttons_label[0]+'</a></td></tr></tbody></table></div>';
		preview_box['price-highlight'] 		 			= '<div class="'+box_config.class+'"><h3 class="rstpl-box-title">'+title+'</h3><span class="rstpl-box-price">'+price+'</span><div class="rstpl-box-content">'+text+'</div><table class="table center"><tbody>'+features_html+'<tr><td><a href="'+buttons_link[0]+'" class="btn btn-large btn-inverse">'+buttons_label[0]+'</a></td></tr></tbody></table></div>';

		preview_box['personal'] 						= '<div class="'+box_config.class+'"><div class="rstpl-box-image"><img src="'+image+'" alt="'+title+'"/><div class="rstpl-mask"><a href="'+link+'"><i class="icon-plus2"></i></a></div></div><div class="rstpl-box-content"><h2 class="rstpl-box-title">'+title+'</h2><span class="rstpl-box-subtitle m-bot-small">'+subtitle+'</span><p>'+text+'</p><div class="rstpl-box-social"><a class="'+buttons_icon[0]+'" href="'+buttons_social_link[0]+'" title=""></a><a class="'+buttons_icon[1]+'" href="'+buttons_social_link[1]+'" title=""></a><a class="'+buttons_icon[2]+'" href="'+buttons_social_link[2]+'" title=""></a><a class="'+buttons_icon[3]+'" href="'+buttons_social_link[3]+'" title=""></a></div></div></div>';

		preview_box['full-width-horizontal-image']  	= '<div class="'+box_config.class+'"><div class="rstpl-box-image pull-left"><img src="'+image+'" alt="'+title+'" width="200"/></div><h3 class="rstpl-box-title">'+title+'</h3><div class="rstpl-box-content rstpl-margin-large">'+text+'<div class="m-bot-large rstpl-box-buttons"><a href="'+buttons_link[0]+'" class="btn btn-large btn-primary rstpl-box-button m-small pull-left">'+buttons_label[0]+'</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="'+buttons_link[1]+'" class="btn btn-large btn-inverse rstpl-box-button m-small pull-left">'+buttons_label[1]+'</a></div></div></div>';





		preview_box['full-width-horizontal-icon'] 		= '<div class="'+box_config.class+'"><span class="'+icon+' span1">&nbsp;</span><div class="span9"><h3 class="rstpl-box-title">'+title+'</h3><div class="rstpl-box-content">'+text+'</div></div><div class="span2"><a class="btn btn-primary rstpl-box-button pull-right" href="'+buttons_link[0]+'" title="">'+buttons_label[0]+'</a></div></div>';


		preview_box['full-width-dark-vertical-icon'] 	= '<div class="'+box_config.class+'"><span class="'+icon+'"></span><div class="rstpl-box-content m-bot-large">'+text+'</div><div class="rstpl-box-bg"></div></div>';


		preview_box['simple-vertical-icon'] 			= '<div class="'+box_config.class+'"><span class="'+icon+'"></span><h2 class="rstpl-box-title rstpl-padding">'+title+'</h2><div class="rstpl-box-content m-large">'+text+'</div><a class="btn btn-primary rstpl-box-button m-small" href="'+buttons_link[0]+'">'+buttons_label[0]+'</a></div>';

		
		preview_box['simple-horizontal-icon'] 		 	= '<div class="'+box_config.class+'"><span class="'+icon+' pull-left"></span><h4 class="rstpl-box-title">'+title+'</h4><div class="rstpl-box-content">'+text+'</div></div>';

		
		


		total_items = (jQuery('#items tr').length - 2);

		jQuery('#box_preview').html(preview_box[box_style]);
		jQuery('#box_preview').prop('class', 'span'+box_config.span);
	}

	function show_iconlist(item) 
	{
		var pagination 	= jQuery('#icons-pagination ul');
		var content 	= jQuery('#icons-content');
		var curent_page = 0;

		maxPerPage = 100;
		maxPerRow  = 10;

		// html pagination
		pagination_html = '';
		for (var i = 0; i < Math.ceil(IconsArray.length/maxPerPage); i++ ){
			pagination_html += '<li><a href="#icon-page'+i+'" class="'+(i == 0 ? 'active' : '')+'" data-toggle="tab">'+(i+1)+'</a></li>';
		}
		pagination.html(pagination_html);

		// html content icons-list
		content_html = '<div class="tab-pane active" id="icon-page0"><ul class="icons-page">';
		for (var i = 0; i < IconsArray.length; i++) {
			var liclass = '';
			if ( (i % maxPerRow) == 0 ) 
				liclass = 'class="last"';

			content_html += '<li '+liclass+'><a class="icon-item"><span class="icon-'+IconsArray[i]+'"></span></a></li>';

			if ( ((i+1) % maxPerPage) == 0 ) 
				content_html += '</ul></div><div class="tab-pane" id="icon-page'+Math.ceil(i / maxPerPage)+'"><ul class="icons-page">';
		}
		content_html += '</ul></div>';
		content.html(content_html);

		// insert value to sibbling input 
		jQuery('.icons-page').on('click','.icon-item',function(){
			var icon_val = jQuery(this).children('span').attr('class');

			jQuery(item).siblings('[type="hidden"]').val(icon_val);
			jQuery(item).children('i').attr('class',icon_val);
			jQuery('#icons-modal').hide();
		});
		// position modal
		window_pos	= jQuery(window).scrollTop();
		var icons_modal = jQuery('#icons-modal');
		icons_modal.css({'position': 'absolute','top': (window_pos+50)+'px', 'left':'19%'}).show();
	}

	// changing box style
	jQuery('#box_style').change(function(){
		box_config = get_config(jQuery(this).val());
		generate_config_fields(box_config.elements);
		update_preview(); 
		update_shortcode();
	});

	// set default box style
	jQuery('#box_style').val('top-featured-dark-strong').trigger('change');

	// open icon list modal
	jQuery('div').on('click', '.select_icon_btn', function(){
		show_iconlist(jQuery(this));
	});

	// close modal iconlist
	jQuery('#close-modal').click( function(event){
		jQuery('#icons-modal').hide();
	});
	
	// update the preview and shortcode
	jQuery('.update_preview').click(function() { update_preview(); update_shortcode(); });

	// inserting shortcode to parent editor
	jQuery('#insert_shortcode').click(function() {
		code = jQuery('#shortcode_preview').val();
		if (window.parent) window.parent.jSelectRSTemplateBox(code);
		return false;
	});

	update_shortcode();
});
</script>
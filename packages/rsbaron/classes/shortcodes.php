<?php
 /**
* @version 1.0.0
* @package RSBaron! 1.0.0
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;

class RSTemplateShortCodes
{
	public static function replace() {
		$content = JResponse::getBody();

		// some components use the description for creating meta description tags(E.g.: facebook)
		// we don't want to change the shortodes over there
		preg_match("/<body.*\<\/body>/ism", $content, $body);

		$original_body = $body = $body[0];

		$body = self::replaceBoxes($body);
		$body = self::replaceCarousels($body);
		$body = self::replaceTabs($body);
		$body = self::replaceAccordions($body);

		$content = str_replace($original_body, $body, $content);

		JResponse::setBody($content);
	}

	public static function validateShortcode($type, $shortcode, &$return = '') 
	{
		$pattern	= '#\['.$type.'(.*?)\](.*?)\[\/'.$type.'\]#ism';
		$pattern2 	= '#\['.$type.'(.*?)#ism'; // check to see if any unclosed tags exist

		if ( preg_match($pattern2, $shortcode) ) 
		{
			preg_match_all($pattern, $shortcode, $matches);
			foreach ($matches[2] as $i => $match) 
			{
				if ( preg_match($pattern2, $match) ) 
				{
					self::validateShortcode($type, $match.'[/'.$type.']', $return);
				} else 
					$return = $matches[0][$i];
			}
		}

		return $return;
	}
	
	public static function replaceCarousels($body) 
	{
		// get all carousels from content
		preg_match_all("/\[carousel(.*?)\](.*?)\[\/carousel\]/ism", $body, $raw_carousels);
		$valid_shortcodes = array();

		foreach ( $raw_carousels[0] as $id => $shortcode ) {
			$valid_shortcode = self::validateShortcode('carousel', $shortcode);
			if (!empty($valid_shortcode))
				$valid_shortcodes[] = $valid_shortcode;
		}

		// transform to xml in order manipulate the easier
		$raw = str_replace(array('[',']'), array('<','>'), $valid_shortcodes);

		// return only htmlspecialchars in order to keep tags inside the text
		$raw = preg_replace_callback("/\<text\>(.*?)\<\/text\>/ism", array('self', 'sanitizeHtml'), $raw);

		// convert to xml objects
		$carousels		= simplexml_load_string('<xml>'.implode('',$raw).'</xml>');

		// build html carousel
		$html_carousels	=  array();

		foreach ($carousels->carousel as $car)
		{
			$id 	 	 = $car->attributes()->id[0];
			$heading 	 = $car->attributes()->heading[0];
			$items 		 = ($car->attributes()->items[0] ? $car->attributes()->items[0] : 1);
			$count_items = count($car->image);

			$html_carousel = '<div id="'.$id.'" class="carousel slide rstpl-box-carousel-full m-small">';
			if ($heading) 
				$html_carousel .= '<h2 class="rstpl-box-title">'.$heading.'</h2>';

			$html_carousel .= '<div class="carousel-inner">';
			$html_carousel .= '	<div class="item active">';

			for ( $i=0; $i < $count_items; $i++ ) 
			{
				$image  = $car->image[$i]->img;
				$src    = $image->attributes()->src[0];
				$width  = ($image->attributes()->width[0] ? $image->attributes()->width[0] : 100) ;
				$height = ($image->attributes()->height[0] ? $image->attributes()->height[0] : 100) ;
				$alt    = $image->attributes()->alt[0];
				$title  = htmlspecialchars_decode($car->title[$i]);
				$text   = htmlspecialchars_decode($car->text[$i]);

				$html_carousel .= '<div class="span'.(12/$items).'">';
				if ($src) {
					$html_carousel .= 			'<img src="'.$src.'" class="rstpl-slide-image pull-left" style="width:'.$width.'px;height:'.$height.'px" alt="'.$alt.'" />';
				}
				$html_carousel .= 				'<h4 class="rstpl-slide-title">'.$title.'</h4><div class="rstpl-slide-content">'.$text.'</div>
										</div>';

				if (($i%$items) == ($items-1) && ($i+1) != $count_items) $html_carousel .= '</div><div class="item">';
			}
			$html_carousel .= ' </div>';

			$html_carousel .= '</div>
			<a class="left carousel-control" href="#'.$id.'" data-slide="prev" rel="nofollow"><i class="icon-angle-left"></i></a>
			<a class="right carousel-control" href="#'.$id.'" data-slide="next" rel="nofollow"><i class="icon-angle-right"></i></a>
			</div>';

			$html_carousels[] = $html_carousel;
		}

		$body = str_replace($raw_carousels[0], $html_carousels, $body);

		return $body;
	}

	public static function replaceTabs($body) 
	{
		// get all tabs from content
		preg_match_all("/\[tabs(.*?)\](.*?)\[\/tabs\]/ism", $body, $raw_tabs);
		$valid_shortcodes = array();

		foreach ( $raw_tabs[0] as $id => $shortcode ) {
			$valid_shortcode = self::validateShortcode('tabs', $shortcode);
			if (!empty($valid_shortcode))
				$valid_shortcodes[] = $valid_shortcode;
		}

		// transform to xml in order manipulate the easier
		$raw = str_replace(array('[',']'), array('<','>'), $valid_shortcodes);

		// return only htmlspecialchars in order to keep tags inside the text
		$raw = preg_replace_callback("/\<tab (.*?)\>(.*?)\<\/tab\>/ism", array('self', 'sanitizeHtml'), $raw);

		// convert to xml objects
		$alltabs		= simplexml_load_string('<xml>'.implode('',$raw).'</xml>');

		// build html carousel
		$html_tabs	=  array();

		foreach ($alltabs->tabs  as $tabs)
		{
			$id 	 	 = $tabs->attributes()->id[0];
			$heading 	 = $tabs->attributes()->heading[0];
			$count_items = count($tabs->tab);

			$html_tab = '';
			if (!empty($heading)) 
				$html_tab .= '<h3 class="rstpl-title-color m-bot-large">'.$heading.'</h3>';

			$html_tabs_header 	= '';
			$html_tabs_content 	= '';
			for ( $i=0; $i < $count_items; $i++ ) 
			{
				$tab  	= $tabs->tab[$i];
				$title 	= $tab->attributes()->title[0];
				$tabid	= $tab->attributes()->tabid[0];

				$html_tabs_header .= '<li'.($i==0 ? ' class="active"' : '').'><a href="#'.$tabid.'" data-toggle="tab">'.$title.'</a></li>';
				$html_tabs_content .= '<div class="tab-pane '.($i==0 ? 'active' : '').'" id="'.$tabid.'">'.htmlspecialchars_decode($tab).'</div>';
			}

			$html_tab .= '<div class="rstpl-box-tabs">
				<ul id="'.$id.'" class="nav nav-tabs">'.$html_tabs_header.'</ul>
				<div id="myTabContent" class="tab-content rstpl-padding">'.$html_tabs_content.'</div>
				</div>';

			$html_tabs[] = $html_tab;
			
		}
		$body 			= str_replace($raw_tabs[0], $html_tabs, $body);

		return $body;
	}

	public static function replaceAccordions($body) 
	{
		// get all Accordions from content
		preg_match_all("/\[accordions(.*?)\](.*?)\[\/accordions\]/ism", $body, $raw_accordions);
		$valid_shortcodes = array();

		foreach ( $raw_accordions[0] as $id => $shortcode ) {
			$valid_shortcode = self::validateShortcode('accordions', $shortcode);
			if (!empty($valid_shortcode))
				$valid_shortcodes[] = $valid_shortcode;
		}

		// transform to xml in order manipulate the easier
		$raw = str_replace(array('[',']'), array('<','>'), $valid_shortcodes);

		// return only htmlspecialchars in order to keep tags inside the text
		$raw = preg_replace_callback("/\<accordion (.*?)\>(.*?)\<\/accordion\>/ism", array('self', 'sanitizeHtml'), $raw);

		// convert to xml objects
		$allaccordions	 = simplexml_load_string('<xml>'.implode('',$raw).'</xml>');

		// build html carousel
		$html_accordions =  array();

		foreach ($allaccordions->accordions  as $accordions)
		{
			$id 	 	 = $accordions->attributes()->id[0];
			$heading 	 = $accordions->attributes()->heading[0];
			$count_items = count($accordions->accordion);

			$html_accordion = '';
			if (!empty($heading)) 
				$html_accordion .= '<h3 class="rstpl-title-color m-bot-large">'.$heading.'</h3>';

			$html_accordion .= '<div class="rstpl-box-accordion"><div class="accordion" id="'.$id.'">';

			for ( $i=0;$i<$count_items; $i++ )
			{
				$accordion 	 = $accordions->accordion[$i];
				$title 	 	 = $accordion->attributes()->title[0];
				$accordionid = $accordion->attributes()->accordionid[0];

				$html_accordion .= '<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#'.$id.'" href="#'.$accordionid.'">'.$title.'</a>
							</div>
							<div id="'.$accordionid.'" class="accordion-body collapse'.($i==0 ? ' in' : '').'">
								<div class="accordion-inner">'.htmlspecialchars_decode($accordion).'</div>
							</div>
						</div>';
			}

			$html_accordion .= '</div></div>';

			$html_accordions[] = $html_accordion;
		}

		$body = str_replace($raw_accordions[0], $html_accordions, $body);

		return $body;
	}

	public static function replaceBoxes($body) 
	{
		// get all boxes from content
		preg_match_all("#\[box(.*?)\](.*?)\[\/box\]#ism", $body, $raw_boxes);
		$valid_shortcodes = array();

		foreach ( $raw_boxes[0] as $id => $shortcode ) {
			$valid_shortcode = self::validateShortcode('box', $shortcode);
			if (!empty($valid_shortcode))
				$valid_shortcodes[] = $valid_shortcode;
		}

		// transform to xml in order manipulate the easier
		$raw = str_replace(array('[',']'), array('<','>'), $valid_shortcodes);

		// return only htmlspecialchars in order to keep tags inside the text
		$raw = preg_replace_callback("/\<text\>(.*?)\<\/text\>/ism", array('self', 'sanitizeHtml'), $raw);
		$raw = preg_replace_callback("/\<price\>(.*?)\<\/price\>/ism", array('self', 'sanitizeHtml'), $raw);

		// convert to xml objects
		$allboxes	 = simplexml_load_string('<xml>'.implode('',$raw).'</xml>');

		// build html boxes
		$html_boxes =  array();

		foreach ($allboxes->box  as $boxes)
		{
		
			$id 	 	 = $boxes->attributes()->id[0];
			$boxtype 	 = $boxes->attributes()->boxtype[0];
			$class	 	 = $boxes->attributes()->class[0];
			$image		 = '';
			if ($boxes->image)
				$image		 = htmlspecialchars_decode($boxes->image[0]->img[0]->attributes()->src[0]);

			$icon		 = $boxes->icon[0];
			$price		 = htmlspecialchars_decode($boxes->price[0]);
			$title		 = $boxes->title[0];
			$subtitle	 = $boxes->subtitle[0];
			$link	 	 = $boxes->link[0];
			$button		 = $boxes->button;
			$social		 = $boxes->social;
			$features	 = $boxes->feature;
			$text		 = htmlspecialchars_decode($boxes->text[0]);

			$html_box = '';

			switch ($boxtype)
			{
				case 'featured':
					$html_box .= '<div class="'.$class.'" id="'.$id.'"><h4 class="rstpl-box-title m-bot-small"><a href="'.$link.'">'.$title.'</a></h4><span class="rstpl-box-price">'.$price.'</span><div class="rstpl-box-content">'.$text.'</div></div>';
				break;
				case 'simple-vertical-image':
					$html_box .= '<div class="'.$class.'" id="'.$id.'"><div class="rstpl-box-image"><img src="'.$image.'" alt="'.$title.'" /></div><div class="rstpl-box-content"><h4 class="rstpl-box-title m-bot-small">'.$title.'</h4>'.$text.'<a class="btn btn-primary rstpl-box-link" href="'.$button[0]->attributes()->href.'">'.$button[0].'</a></div></div>';
				break;
				case 'simple-vertical-image-small':
					$html_box .= '<div class="'.$class.'" id="'.$id.'"><div class="rstpl-box-content"><div>'.$text.'</div><h4 class="rstpl-box-title m-top-small">'.$title.'</h4><h5 class="rstpl-box-subtitle">'.$subtitle.'</h5></div><div class="rstpl-box-image m-top-small"><img src="'.$image.'" alt="" /></div></div>';
				break;
				case 'simple-horizontal-image':
					$html_box .= '<div class="'.$class.'" id="'.$id.'"><div class="rstpl-box-image pull-left span4"><img src="'.$image.'" alt="" /><div class="rstpl-mask"><a href="'.$button[0]->attributes()->href.'"><i class="icon-plus2"></i></a></div></div><div class="span8"><h4 class="rstpl-box-title">'.$title.'</h4><div class="rstpl-box-content">'.$text.'</div><span class="rstpl-box-price">'.$price.'</span><a class="btn btn-primary rstpl-box-link pull-right" href="'.$button[0]->attributes()->href.'">'.$button[0].'</a></div></div>';
				break;
				case 'simple-horizontal-image-small':
					$html_box .= '<div class="'.$class.'" ><div class="rstpl-box-image pull-left span3"><img src="'.$image.'" alt="" /><div class="rstpl-mask"><a href="'.$link.'"><i class="icon-plus2"></i></a></div></div><div class="span9"><h5 class="rstpl-box-title">'.$title.'</h5><div class="rstpl-box-content">'.$text.'</div></div></div>';
				break;
				case 'price':
					$html_box .= '<div class="'.$class.'" id="'.$id.'"><h3 class="rstpl-box-title">'.$title.'</h3><span class="rstpl-box-price">'.$price.'</span><div class="rstpl-box-content">'.$text.'</div><table class="table center"><tbody>';
					foreach ($features as $feature) 
						$html_box .= '<tr><td>'.$feature.'</td></tr>';
					$html_box .= '<tr><td><a title="" href="'.$button[0]->attributes()->href.'" '.(!empty($button[0]->attributes()->rel) ? 'rel="'.$button[0]->attributes()->rel.'"' : '').' class="btn btn-large btn-inverse">'.$button[0].'</a></td></tr></tbody></table></div>';
				break;
				case 'price-highlight':
					$html_box .= '<div class="'.$class.'" id="'.$id.'"><h3 class="rstpl-box-title">'.$title.'</h3><span class="rstpl-box-price">'.$price.'</span><div class="rstpl-box-content">'.$text.'</div><table class="table center"><tbody>';
					foreach ($features as $feature) 
						$html_box .= '<tr><td>'.$feature.'</td></tr>';
					$html_box .= '<tr><td><a title="" href="'.$button[0]->attributes()->href.'" '.(!empty($button[0]->attributes()->rel) ? 'rel="'.$button[0]->attributes()->rel.'"' : '').' class="btn btn-large btn-inverse">'.$button[0].'</a></td></tr></tbody></table></div>';
				break;
				case 'personal':
					$html_box .= '<div class="'.$class.'" id="'.$id.'"><div class="rstpl-box-image"><img src="'.$image.'" alt="'.$title.'"/><div class="rstpl-mask"><a href="'.$link.'"><i class="icon-plus2"></i></a></div></div><div class="rstpl-box-content"><h4 class="rstpl-box-title">'.$title.'</h4><span class="rstpl-box-subtitle m-bot-small">'.$subtitle.'</span><p>'.$text.'</p><div class="rstpl-box-social">'.($social[0]->attributes()->href != '#' ? '<a class="'.$social[0].'" href="'.$social[0]->attributes()->href.'" title=""></a>' : '').($social[1]->attributes()->href != '#' ? '<a class="'.$social[1].'" href="'.$social[1]->attributes()->href.'" title=""></a>' : '').($social[2]->attributes()->href != '#' ? '<a class="'.$social[2].'" href="'.$social[2]->attributes()->href.'" title=""></a>' : '').($social[3]->attributes()->href != '#' ? '<a class="'.$social[3].'" href="'.$social[3]->attributes()->href.'" title=""></a>' : '').'</div></div></div>';
				break;
				case 'full-width-horizontal-image':
					$html_box .= '<div class="'.$class.'" id="'.$id.'"><div class="rstpl-box-image pull-left"><img src="'.$image.'" alt="'.$title.'" width="200" /></div><h3 class="rstpl-box-title m-top-large">'.$title.'</h3><div class="rstpl-box-content rstpl-margin-large">'.$text.'<div class="m-bot-large rstpl-box-buttons"><a href="'.$button[0]->attributes()->href.'" class="btn btn-large btn-primary rstpl-box-button m-small pull-left">'.$button[0].'</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$button[1]->attributes()->href.'" class="btn btn-large btn-inverse rstpl-box-button m-small pull-left">'.$button[1].'</a></div></div></div>';
				break;

				
				
				

				case 'full-width-horizontal-icon':
					$html_box .= '<div class="'.$class.'" id="'.$id.'"><span class="'.$icon.' span1">&nbsp;</span><div class="span9"><h3 class="rstpl-box-title">'.$title.'</h3><div class="rstpl-box-content">'.$text.'</div></div><div class="span2"><a class="btn btn-primary rstpl-box-button pull-right" href="'.$button[0]->attributes()->href.'" title="'.$button[0].'">'.$button[0].'</a></div></div>';
				break;
				case 'full-width-dark-vertical-image':
					$html_box .= '<div class="'.$class.'" id="'.$id.'"><h2 class="rstpl-box-title m-small">'.$title.'</h2><a class="btn btn-primary btn-large rstpl-box-button m-small" href="'.$button[0]->attributes()->href.'" >'.$button[0].'</a><div class="clearfix"></div><img alt="'.$title.'" src="'.$image.'" class="rstpl-box-image m-top-small" width="80%"><div class="rstpl-box-bg"></div></div>';
				break;
				
				case 'full-width-dark-vertical-icon':
					$html_box .= '<div class="'.$class.'" id="'.$id.'"><span class="'.$icon.'"></span><div class="rstpl-box-content m-bot-large">'.$text.'</div><div class="rstpl-box-bg"></div></div>';
				break;
				
				case 'simple-vertical-icon':
					$html_box .= '<div class="'.$class.'" id="'.$id.'"><span class="'.$icon.'"></span><h2 class="rstpl-box-title m-large">'.$title.'</h2><div class="rstpl-box-content m-large">'.$text.'</div><a class="btn btn-primary rstpl-box-button m-small" href="'.$button[0]->attributes()->href.'">'.$button[0].'</a></div>';
				break;
				case 'simple-horizontal-icon':
					$html_box .= '<div class="'.$class.'" id="'.$id.'"><span class="'.$icon.' pull-left"></span><h4 class="rstpl-box-title">'.$title.'</h4><div class="rstpl-box-content">'.$text.'</div></div>';
				break;
			}
			$html_boxes[] = $html_box;
		}

		$body 			= str_replace($valid_shortcodes, $html_boxes, $body);

		return $body;
	}
	
	public static function sanitizeHtml($m) {
		if (substr($m[0], 0,4) != '<acc' && substr($m[0], 0,4) != '<tab') // for all cases
			return str_replace($m[1], '<![CDATA['.htmlspecialchars($m[1]).']]>', $m[0]);
		else { 															  // for accordion and tab cases
			return str_replace($m[2], '<![CDATA['.htmlspecialchars($m[2]).']]>', $m[0]);
		}
	}
}
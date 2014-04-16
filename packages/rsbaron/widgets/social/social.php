<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;

$position   = $this->params->get('socialPosition');
$alignment	= $this->params->get('positionAlignment','center');
$h3text 	= $this->params->get('socialText'); 

// links
$facebook 	= $this->params->get('socialFacebook');
$twitter 	= $this->params->get('socialTwitter');
$linkedin 	= $this->params->get('socialLinkedin');
$google 	= $this->params->get('socialGoogle');
$youtube 	= $this->params->get('socialYoutube');
$vimeo 		= $this->params->get('socialVimeo');
$flickr 	= $this->params->get('socialFlickr');
$pinterest 	= $this->params->get('socialPinterest');
$skype 		= $this->params->get('socialSkype');
$yahoo 		= $this->params->get('socialYahoo');

if ($position != 'none') {
	// render default layout
	include $this->getLayout('default');
}
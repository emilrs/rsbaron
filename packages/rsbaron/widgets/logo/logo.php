<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;

$position   = $this->params->get('logoPosition');
$className  = $this->params->get('logoCssClass') ? ' '.$this->params->get('logoCssClass') : '';
$appearance = $this->params->get('logoAppearance');
$anchor = $this->params->get('logoAnchor');

// text settings
$text	       = $this->params->get('logoText');
$heading	   = $this->params->get('logoHeading');
$textAlignment = $this->params->get('logoTextAlignment');
$textColor 	   = $this->params->get('logoColor');

// image settings
$image			= $this->params->get('logoImage');
$imageAlignment = $this->params->get('logoImageAlignment');
if ($position != 'none') {
	// render default layout
	include $this->getLayout('default');
}
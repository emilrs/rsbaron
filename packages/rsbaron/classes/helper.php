<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

defined('_JEXEC') or die;

class RSTemplateHelper
{
	public static function addOptiontext($raw_text, $aditional_text,$icon='icon-printer') {
		$checkIfImg = stristr($raw_text,'<img');
		if ($checkIfImg) {
			$raw_text = preg_replace("/<img[^>]+\>/i", '<span class="'.$icon.'"></span> '.$aditional_text, $raw_text);
		}
		return $raw_text;
	}
	
	public static function showGravatar($user_id) {
		$uri = JURI::getInstance();
		$prefix_protocol = 'http';
		if ($uri->isSSL()) {
			$prefix_protocol .= 's';
		}
		$user   = JFactory::getUser($user_id);
		$email  = $user->get('email');
		$hash   = md5($email);
		$params	= JFactory::getApplication()->getTemplate(true)->params;
		if ($params->get('showGravatar', 1)) {
			return '<img src="'.$prefix_protocol.'://www.gravatar.com/avatar/'.$hash.'?s=150&d=mm" class="article-img" />';
		} else {
			return '';
		}
	}
}
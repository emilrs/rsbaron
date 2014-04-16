<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
$jversion = new JVersion();
$is30 = $jversion->isCompatible('3.0');

if ($is30) {
	//// 3.x template overwrite
	echo $this->loadTemplate('view30');
} else {
	//// 2.5 template overwrite
	echo $this->loadTemplate('view25');
}
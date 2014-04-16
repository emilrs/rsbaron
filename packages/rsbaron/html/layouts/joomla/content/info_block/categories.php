<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

defined('JPATH_BASE') or die;

?>
<?php if ($displayData['params']->get('show_parent_category') && !empty($displayData['item']->parent_slug)) { ?>
	<dd class="parent-category-name">
		<?php $title = $this->escape($displayData['item']->parent_title);
		$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($displayData['item']->parent_slug)).'">'.$title.'</a>';
		if ($displayData['params']->get('link_parent_category') && !empty($displayData['item']->parent_slug)) { 
			echo $url; 
		} else {
			echo $title; 
		} 
		?>
	</dd>
	<dd>
		<span class="icon-folder-open"></span>
	</dd>
<?php } ?>
<?php if ($displayData['params']->get('show_category')) { ?>
	<dd class="category-name">
		<span class="icon-folder-open"></span>
		<?php $title = $this->escape($displayData['item']->category_title);
		$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($displayData['item']->catslug)) . '">' . $title . '</a>';
		if ($displayData['params']->get('link_category') && $displayData['item']->catslug) { 
			echo $url; 
		} else {
			echo $title; 
		}
		?>
	</dd>
<?php }
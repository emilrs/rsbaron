<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

defined('JPATH_BASE') or die;

$blockPosition = $displayData['params']->get('info_block_position', 0);

?>
<dl class="article-info muted">

	<?php if ($displayData['position'] == 'above' && ($blockPosition == 0 || $blockPosition == 2)
			|| $displayData['position'] == 'below' && ($blockPosition == 1)
			) : ?>

		<?php if ($displayData['params']->get('show_author') && !empty($displayData['item']->author )) : ?>
			<?php echo JLayoutHelper::render('joomla.content.info_block.author', $displayData); ?>
		<?php endif; ?>
		
		<?php if ($displayData['params']->get('show_hits')) : ?>
			<?php echo JLayoutHelper::render('joomla.content.info_block.hits', $displayData); ?>
		<?php endif; ?>

		<?php if ($displayData['params']->get('show_publish_date')) : ?>
			<?php echo JLayoutHelper::render('joomla.content.info_block.publish_date', $displayData); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($displayData['position'] == 'above' && ($blockPosition == 0)
			|| $displayData['position'] == 'below' && ($blockPosition == 1 || $blockPosition == 2)
			) : ?>
		<?php if ($displayData['params']->get('show_create_date')) : ?>
			<?php echo JLayoutHelper::render('joomla.content.info_block.create_date', $displayData); ?>
		<?php endif; ?>

		<?php if ($displayData['params']->get('show_modify_date')) : ?>
			<?php echo JLayoutHelper::render('joomla.content.info_block.modify_date', $displayData); ?>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if ($displayData['position'] == 'above' && ($blockPosition == 0 || $blockPosition == 2)
			|| $displayData['position'] == 'below' && ($blockPosition == 1)
			) : ?>
			<?php if (($displayData['params']->get('show_parent_category') && !empty($displayData['item']->parent_slug)) || $displayData['params']->get('show_category')) : ?>
			<?php echo JLayoutHelper::render('joomla.content.info_block.categories', $displayData); ?>
		<?php endif; ?>
	<?php endif; ?>				
</dl>
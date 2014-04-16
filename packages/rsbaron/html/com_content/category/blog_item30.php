<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

defined('_JEXEC') or die;?>
<?php
// Create a shortcut for params.
$params = $this->item->params;
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
$canEdit = $this->item->params->get('access-edit');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.framework');
?>
<?php if ($this->item->state == 0) { ?>
	<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
<?php } ?>

<?php echo JLayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>

<?php // Todo Not that elegant would be nice to group the params ?>
<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
		|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') ); ?>
<?php $blockPosition = $params->get('info_block_position', 0); ?>

<?php echo JLayoutHelper::render('joomla.content.content_intro_image', $this->item); ?>

			<?php if ($useDefList && ($blockPosition==0 || $blockPosition==2)) { ?>
			<div class="article-info">
				<div class="rstpl-article-container">
					<div class="row-fluid">
						<div class="span12">
			<?php } ?>
			<?php if ($useDefList) { ?>
				<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
			<?php } ?>

			<?php if ($useDefList) { ?>
					<?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false, 'hits' => true, 'position' => $blockPosition, 'columns' => $this->columns, 'leads' => $this->leads)); ?>
			<?php } else { ?>
				<?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false, 'hits' => false, 'columns' => $this->columns, 'leads' => $this->leads)); ?>
			<?php } ?>
			<?php if ($useDefList && ($blockPosition==0 || $blockPosition==2)) { ?>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>


<?php if (!$params->get('show_intro')) { ?>
	<?php echo $this->item->event->afterDisplayTitle; ?>
<?php } ?>
<?php echo $this->item->event->beforeDisplayContent; ?> <?php echo $this->item->introtext; ?>

<?php if ($useDefList) { ?>
	<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
<?php } ?>

<?php 
if ($params->get('show_readmore') && $this->item->readmore) {
	if ($params->get('access-view')) {
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
	} else {
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
		$link = new JURI($link1);
		$link->setVar('return', base64_encode($returnURL));
	}
	?>

	<p class="readmore"><a class="btn" href="<?php echo $link; ?>"> <span class="icon-chevron-right"></span>

	<?php if (!$params->get('access-view')) {
			echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		} elseif ($readmore = $this->item->alternative_readmore) {
			echo $readmore;
	}
	if ($params->get('show_readmore_title', 0) != 0) {
		echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		}
	elseif ($params->get('show_readmore_title', 0) == 0) {
		echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
	} else {
		echo JText::_('COM_CONTENT_READ_MORE');
		echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
	} ?>

	</a></p>

<?php } ?>

<?php if ($this->item->state == 0) { ?>
</div>
<?php } ?>

<?php echo $this->item->event->afterDisplayContent;
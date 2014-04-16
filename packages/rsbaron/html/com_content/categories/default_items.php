<?php
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

// no direct access
defined('_JEXEC') or die;

$jversion = new JVersion();
$is30 = $jversion->isCompatible('3.0');

$class = ' class="rstpl-category-item first"';

if ($is30) {
	JHtml::_('bootstrap.tooltip');
	$lang	= JFactory::getLanguage();
}

if (count($this->items[$this->parent->id]) > 0 && $this->maxLevelcat != 0) {
?>
	<?php foreach($this->items[$this->parent->id] as $id => $item) { ?>
		<?php
		if ($this->params->get('show_empty_categories_cat') || $item->numitems || count($item->getChildren())) {
		if (!isset($this->items[$this->parent->id][$id + 1]))
		{
			$class = ' class="rstpl-category-item last"';
		}
		?>
		<div <?php echo $class; ?> >
		<?php $class = ''; ?>
			<h3 class="page-header item-title m-bot-small">
				<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id));?>" class="rstpl-v_middle">
				<?php echo $this->escape($item->title); ?></a>
				<?php if ($this->params->get('show_cat_num_articles_cat') == 1) { ?>
					<span class="badge badge-info rstpl-v_middle">
						<?php echo $item->numitems; ?>
					</span>
				<?php } ?>
				<?php if (count($item->getChildren()) > 0) { ?>
					<a href="#category-<?php echo $item->id;?>" data-toggle="collapse" data-toggle="button" class="btn btn-small pull-right rstpl-v_middle"><span class="icon-plus"></span></a>
				<?php } ?>
			</h3>
			<?php if ($this->params->get('show_subcat_desc_cat') == 1) { ?>
				<?php if ($item->description) { ?>
					<div class="category-desc">
						<?php echo JHtml::_('content.prepare', $item->description, '', 'com_content.categories'); ?>
					</div>
				<?php } ?>
			<?php } ?>

			<?php if (count($item->getChildren()) > 0) { ?>
				<div class="collapse fade" id="category-<?php echo $item->id;?>">
				<?php
				$this->items[$item->id] = $item->getChildren();
				$this->parent = $item;
				$this->maxLevelcat--;
				echo $this->loadTemplate('items');
				$this->parent = $item->getParent();
				$this->maxLevelcat++;
				?>
				</div>
			<?php } ?>
		</div>
		<?php } ?>
	<?php } ?>
<?php }
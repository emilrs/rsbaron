<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

// no direct access
defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');
$jversion = new JVersion();
$is30 = $jversion->isCompatible('3.0');
?>
<?php 
if ($is30) {
	JHtml::_('behavior.caption');
	?>
	<div class="category-list<?php echo $this->pageclass_sfx;?>">

	<?php
	$this->subtemplatename = 'articles';
	echo JLayoutHelper::render('joomla.content.category_default', $this);
	?>

	</div>
	<?php 
}
else{
?>
<div class="category-list<?php echo $this->pageclass_sfx;?>">

	<?php if ($this->params->get('show_page_heading')) { ?>
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php } ?>

	<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) { ?>
	<h2>
		<?php echo $this->escape($this->params->get('page_subheading')); ?>
		<?php if ($this->params->get('show_category_title')) { ?>
			<span class="subheading-category"><?php echo $this->category->title;?></span>
		<?php } ?>
	</h2>
	<?php } ?>

	<?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) { ?>
	<div class="category-desc">
		<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) { ?>
			<img src="<?php echo $this->category->getParams()->get('image'); ?>"/>
		<?php } ?>
		<?php if ($this->params->get('show_description') && $this->category->description) { ?>
			<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
		<?php } ?>
		<div class="clr"></div>
	</div>
	<?php } ?>

	<div class="cat-items">
		<?php echo $this->loadTemplate('articles'); ?>
	</div>

	<?php if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) { ?>
	<div class="cat-children">
		<?php if ($this->params->get('show_category_heading_title_text', 1) == 1) { ?>
		<h3 class="m-small">
			<?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?>
		</h3>
		<?php } ?>
		<?php echo $this->loadTemplate('children'); ?>
	</div>
	<?php } ?>
</div>
<?php }
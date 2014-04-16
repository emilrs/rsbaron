<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');

?>
<div class="blog<?php echo $this->pageclass_sfx;?>">
<?php if ($this->params->get('show_page_heading')) { ?>
	<h1 class="m-bot-large">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php } ?>

	<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) { ?>
	<h2 class="m-bot-large">
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

<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) { ?>
<div class="items-leading">
	<?php foreach ($this->lead_items as &$item) { ?>
		<div class="leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
			<?php
				$this->item = &$item;
				$this->leads = $this->item->id;
				echo $this->loadTemplate('item25');
			?>
		</div>
		<?php
			$leadingcount++;
		?>
	<?php } ?>
</div>
<?php } ?>
<?php
	$introcount=(count($this->intro_items));
	$counter=0;
?>
<?php if (!empty($this->intro_items)) { ?>

	<?php foreach ($this->intro_items as $key => &$item) { ?>
	<?php
		$key= ($key-$leadingcount)+1;
		$rowcount=( ((int)$key-1) %	(int) $this->columns) +1;
		$row = $counter / $this->columns ;

		if ($rowcount==1) { ?>
	<div class="items-row cols-<?php echo (int) $this->columns;?> <?php echo 'row-'.$row ; ?> row-fluid m-top-large">
	<?php } ?>
	<div class="span<?php echo round((12 / $this->columns));?>">
		<div class="item column-<?php echo $rowcount;?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
			<?php
				$this->item = &$item;
				$this->leads = $this->item->id;
				echo $this->loadTemplate('item25');
			?>
		</div>
	</div>
	<?php $counter++; ?>
	<?php if (($rowcount == $this->columns) or ($counter ==$introcount)){ ?>
				<span class="row-separator"></span>
				</div>

			<?php } ?>
	<?php } ?>
	
<?php } ?>

<?php if (!empty($this->link_items)) { ?>

	<?php echo $this->loadTemplate('links'); ?>

<?php } ?>

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

<?php if (($this->params->def('show_pagination', 1) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) { ?>
		<div class="pagination">
				<?php  if ($this->params->def('show_pagination_results', 1)) { ?>
					<p class="counter">
							<?php echo $this->pagination->getPagesCounter(); ?>
					</p>
				<?php } ?>
				<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
<?php  } ?>
</div>
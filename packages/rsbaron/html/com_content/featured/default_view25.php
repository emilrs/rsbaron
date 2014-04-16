<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// If the page class is defined, add to class as suffix.
// It will be a separate class if the user starts it with a space
?>

<div class="blog-featured<?php echo $this->pageclass_sfx;?>">
<?php if ( $this->params->get('show_page_heading')!=0) { ?>
	<h1 class="m-bot-large">
	<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
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
	<?php foreach ($this->intro_items as $key => &$item) {
		$key= ($key-$leadingcount)+1;
		$rowcount=( ((int)$key-1) %	(int) $this->columns) +1;
		$row = $counter / $this->columns ;
		if ($rowcount==1) { ?>
			<div class="items-row cols-<?php echo (int) $this->columns;?> <?php echo 'row-'.$row ; ?> row-fluid m-top-large">
		<?php } ?>
		<div class="item column-<?php echo $rowcount;?><?php echo $item->state == 0 ? ' system-unpublished"' : null; ?> span<?php echo round((12 / $this->columns));?>">
			<?php
					$this->item = &$item;
					echo $this->loadTemplate('item25');
			?>
		</div>
		<?php $counter++; ?>
			<?php if (($rowcount == $this->columns) or ($counter ==$introcount)) { ?>
				<span class="row-separator"></span>
				</div>

			<?php } ?>
	<?php } ?>
<?php } ?>

<?php if (!empty($this->link_items)) { ?>
	<div class="items-more">
	<?php echo $this->loadTemplate('links'); ?>
	</div>
<?php } ?>

<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1)) { ?>
	<div class="pagination">
		<?php if ($this->params->def('show_pagination_results', 1)) { ?>
			<p class="counter">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		<?php  } ?>
				<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
<?php } ?>

</div>
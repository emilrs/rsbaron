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
	JHtml::_('behavior.caption');
}
?>
<div class="archive<?php echo $this->pageclass_sfx;?>">
<?php if ($this->params->get('show_page_heading', 1)) { ?>
	<div class="page-header">
	<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	</div>
<?php } ?>
<form id="adminForm" action="<?php echo JRoute::_('index.php')?>" method="post" class="form-inline">
	<fieldset class="filters">
	<div class="filter-search alert alert-info">
		<?php if ($this->params->get('filter_field') != 'hide') { ?>
		<label class="filter-search-lbl" for="filter-search"><?php echo JText::_('COM_CONTENT_'.$this->params->get('filter_field').'_FILTER_LABEL').'&#160;'; ?></label>
		<input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->filter); ?>" class="inputbox span2" onchange="document.getElementById('adminForm').submit();" />
		<?php } ?>

		<?php echo $this->form->monthField; ?>
		<?php echo $this->form->yearField; ?>
		<?php echo $this->form->limitField; ?>

		<button type="submit" class="btn btn-large btn-primary pull-right" id="rstpl-filter-btn"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button>
	</div>
	<input type="hidden" name="view" value="archive" />
	<input type="hidden" name="option" value="com_content" />
	<input type="hidden" name="limitstart" value="0" />
	</fieldset>

	<?php 
	if ($is30) {
		echo $this->loadTemplate('item30');
	}
	else {
		echo $this->loadTemplate('item25');
	}?>
</form>
</div>
<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php if ($this->countModules('bottom-fluid-a or bottom-fluid-b or bottom-fluid-c or bottom-fluid-d')) { 
	$span 		= 12;
	$modules 	= 0;
	if ($this->countModules('bottom-fluid-a')) $modules++;
	if ($this->countModules('bottom-fluid-b')) $modules++;
	if ($this->countModules('bottom-fluid-c')) $modules++;
	if ($this->countModules('bottom-fluid-d')) $modules++;
	if ($modules>0) $span = $span / $modules;
?>
<!-- Start bottom-fluid -->
	<div class="row-fluid rstpl-bottom-fluid-position rstpl-padding">
		<?php if ($this->countModules('bottom-fluid-a')) {?>
		<div class="span<?php echo $span; ?>">
			<jdoc:include type="modules" name="bottom-fluid-a" style="rscontent"/>
		</div>
		<?php } ?>
		<?php if ($this->countModules('bottom-fluid-b')) {?>
		<div class="span<?php echo $span; ?>">
			<jdoc:include type="modules" name="bottom-fluid-b" style="rscontent"/>
		</div>
		<?php } ?>
		<?php if ($this->countModules('bottom-fluid-c')) {?>
		<div class="span<?php echo $span; ?>">
			<jdoc:include type="modules" name="bottom-fluid-c" style="rscontent"/>
		</div>
		<?php } ?>
		<?php if ($this->countModules('bottom-fluid-d')) {?>
		<div class="span<?php echo $span; ?>">
			<jdoc:include type="modules" name="bottom-fluid-d" style="rscontent"/>
		</div>
		<?php } ?>
	</div>
<!-- End bottom-fluid -->
<?php } ?>
<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php if ($this->countModules('middle-fluid-a or middle-fluid-b or middle-fluid-c or middle-fluid-d')) { 
	$span 		= 12;
	$modules 	= 0;
	if ($this->countModules('middle-fluid-a')) $modules++;
	if ($this->countModules('middle-fluid-b')) $modules++;
	if ($this->countModules('middle-fluid-c')) $modules++;
	if ($this->countModules('middle-fluid-d')) $modules++;
	if ($modules>0) $span = $span / $modules;
?>
<!-- Start middle-fluid -->
	<div class="row-fluid rstpl-middle-fluid-position rstpl-padding">
		<?php if ($this->countModules('middle-fluid-a')) {?>
		<div class="span<?php echo $span; ?>">
			<jdoc:include type="modules" name="middle-fluid-a" style="rscontent"/>
		</div>
		<?php } ?>
		<?php if ($this->countModules('middle-fluid-b')) {?>
		<div class="span<?php echo $span; ?>">
			<jdoc:include type="modules" name="middle-fluid-b" style="rscontent"/>
		</div>
		<?php } ?>
		<?php if ($this->countModules('middle-fluid-c')) {?>
		<div class="span<?php echo $span; ?>">
			<jdoc:include type="modules" name="middle-fluid-c" style="rscontent"/>
		</div>
		<?php } ?>
		<?php if ($this->countModules('middle-fluid-d')) {?>
		<div class="span<?php echo $span; ?>">
			<jdoc:include type="modules" name="middle-fluid-d" style="rscontent"/>
		</div>
		<?php } ?>
	</div>
<!-- End middle-fluid -->
<?php } ?>
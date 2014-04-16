<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php if ($this->countModules('top-fluid-a or top-fluid-b or top-fluid-c or top-fluid-d')) {
	$span 	= 12;
	$modules = 0;
	if ($this->countModules('top-fluid-a')) $modules++;
	if ($this->countModules('top-fluid-b')) $modules++;
	if ($this->countModules('top-fluid-c')) $modules++;
	if ($this->countModules('top-fluid-d')) $modules++;
	if ($modules>0) $span = $span / $modules;
?>
<!-- Start Top Fluid -->
<div class="row-fluid rstpl-top-fluid-position rstpl-padding">
	<?php if ($this->countModules('top-fluid-a')) { ?>
		<!-- Start top-fluid-a -->
		<div class="span<?php echo $span;?>">
			<jdoc:include type="modules" name="top-fluid-a"/>
		</div>
		<!-- End top-fluid-a -->
	<?php } ?>
	<?php if ($this->countModules('top-fluid-b')) { ?>
		<!-- Start top-fluid-b -->
		<div class="span<?php echo $span;?>">
			<jdoc:include type="modules" name="top-fluid-b"/>
		</div>
		<!-- End top-fluid-b -->
	<?php } ?>
	<?php if ($this->countModules('top-fluid-c')) { ?>
		<!-- Start top-fluid-c -->
		<div class="span<?php echo $span;?>">
			<jdoc:include type="modules" name="top-fluid-c"/>
		</div>
		<!-- End top-fluid-c -->
	<?php } ?>
	<?php if ($this->countModules('top-fluid-d')) { ?>
		<!-- Start top-fluid-d -->
		<div class="span<?php echo $span;?>">
			<jdoc:include type="modules" name="top-fluid-d"/>
		</div>
		<!-- End top-fluid-d -->
	<?php } ?>
</div>
<!-- End Top Fluid -->
<?php } ?>

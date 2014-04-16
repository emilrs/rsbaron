<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php if ($this->countModules('footer-fluid-a or footer-fluid-b or footer-fluid-c or footer-fluid-d')) { 
		$span 	 = 12;
		$modules = 0;
		if ($this->countModules('footer-fluid-a')) $modules++;
		if ($this->countModules('footer-fluid-b')) $modules++;
		if ($this->countModules('footer-fluid-c')) $modules++;
		if ($this->countModules('footer-fluid-d')) $modules++;
		if ($modules>0) $span = $span / $modules;
?>
<!-- Start footer-fluid -->
	<div class="row-fluid rstpl-footer-fluid-position rstpl-padding m-bot-large">
		<?php if ($this->countModules('footer-fluid-a')) { ?>
		<div class="span<?php echo $span; ?>">
			<jdoc:include type="modules" name="footer-fluid-a" style="rsfooter"/>
		</div>
		<?php } ?>
		<?php if ($this->countModules('footer-fluid-b')) { ?>
		<div class="span<?php echo $span; ?>">
			<jdoc:include type="modules" name="footer-fluid-b" style="rsfooter"/>
		</div>
		<?php } ?>
		<?php if ($this->countModules('footer-fluid-c')) { ?>
		<div class="span<?php echo $span; ?>">
			<jdoc:include type="modules" name="footer-fluid-c" style="rsfooter"/>
		</div>
		<?php } ?>
		<?php if ($this->countModules('footer-fluid-d')) { ?>
		<div class="span<?php echo $span; ?>">
			<jdoc:include type="modules" name="footer-fluid-d" style="rsfooter"/>
		</div>
		<?php } ?>
	</div>
<!-- End footer-fluid -->
<?php } ?>

<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php if ($this->countModules('featured-a or featured-b or featured-c')) { 
		$span 	 = 12;
		$modules = 0;
		if ($this->countModules('featured-a')) $modules++;
		if ($this->countModules('featured-b')) $modules++;
		if ($this->countModules('featured-c')) $modules++;
		if ($modules>0) $span = $span / $modules;
?>
<!-- Start featured -->
	<div class="row-fluid rstpl-featured-position rstpl-padding">
		<?php if ($this->countModules('featured-a')) { ?>
		<div class="span<?php echo $span; ?>">
			<jdoc:include type="modules" name="featured-a" style="rscontent"/>
		</div>
		<?php } ?>
		<?php if ($this->countModules('featured-b')) { ?>
		<div class="span<?php echo $span; ?>">
			<jdoc:include type="modules" name="featured-b" style="rscontent"/>
		</div>
		<?php } ?>
		<?php if ($this->countModules('featured-c')) { ?>
		<div class="span<?php echo $span; ?>">
			<jdoc:include type="modules" name="featured-c" style="rscontent"/>
		</div>
		<?php } ?>
	</div>
<!-- End featured -->
<?php } ?>

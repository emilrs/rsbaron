<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;

	if($this->params->get('logoFluid')) {
		$span = 12;

		$activePositions = array();
		if ($this->countModules('top-a')) $activePositions[] = 'top-a';
		if ($this->countModules('top-b')) $activePositions[] = 'top-b';
		if ($this->countModules('top-c')) $activePositions[] = 'top-c';
		if ($this->params->get('logoPosition') != 'none') $activePositions[] = $this->params->get('logoPosition');
		if ($this->params->get('socialPosition') != 'none') $activePositions[] = $this->params->get('socialPosition');
		array_unique($activePositions);
		$nrActive = count($activePositions);
		$span = $span / $nrActive;
	}
	else 
		$span = 4;
?>

<?php if ($this->countModules('top-a or top-b or top-c') || !empty($activePositions) ) { ?>
<!-- Start Top -->
	<div class="row-fluid rstpl-top-position">
<?php if ($this->countModules('top-a or top-b or top-c') || $this->params->get('logoPosition') != 'none') { ?>

	<?php if (!$this->params->get('logoFluid') || (isset($activePositions) && in_array('top-a',$activePositions))) { ?>
		<!-- Start Top-A -->
		<div class="span<?php echo $span;?> rstpl-top-a<?php echo (($this->params->get('logoPosition') != 'top-a' && !$this->countModules('top-a') && $this->params->get('socialPosition') != 'top-a') ? ' hidden-phone':'')?>">
			<?php if ($this->params->get('logoPosition') == 'top-a') $template->widgets['logo']->render();?>
			<?php if ($this->params->get('socialPosition') == 'top-a') $template->widgets['social']->render(); ?>
			<jdoc:include type="modules" name="top-a" style="rstop"/>
		</div>
		<!-- End Top-A -->
	<?php } ?>
	<?php if (!$this->params->get('logoFluid') || (isset($activePositions) && in_array('top-b',$activePositions))) { ?>
		<!-- Start Top-B -->
		<div class="span<?php echo $span;?> rstpl-top-b<?php echo (($this->params->get('logoPosition') != 'top-b' && !$this->countModules('top-b') && $this->params->get('socialPosition') != 'top-b') ? ' hidden-phone':'')?>">
			<?php if ($this->params->get('logoPosition') == 'top-b') $template->widgets['logo']->render();?>
			<?php if ($this->params->get('socialPosition') == 'top-b') $template->widgets['social']->render(); ?>
			<jdoc:include type="modules" name="top-b" style="rstop"/>
		</div>
		<!-- End Top-B -->
	<?php } ?>
	<?php if (!$this->params->get('logoFluid') || (isset($activePositions) && in_array('top-c',$activePositions))) { ?>
		<!-- Start Top-C -->
		<div class="span<?php echo $span;?> rstpl-top-c<?php echo (($this->params->get('logoPosition') != 'top-c' && !$this->countModules('top-c') && $this->params->get('socialPosition') != 'top-c') ? ' hidden-phone':'')?>">
			<?php if ($this->params->get('logoPosition') == 'top-c') $template->widgets['logo']->render();?>
			<?php if ($this->params->get('socialPosition') == 'top-c') $template->widgets['social']->render(); ?>
			<jdoc:include type="modules" name="top-c" style="rstop"/>
		</div>
		<!-- End Top-C -->
	<?php } ?>
<?php } ?>
	</div>
<!-- End Top -->
<?php } ?>

<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php 
$hasLeftColumn 	= $this->countModules('column-left');
$hasRightColumn = $this->countModules('column-right');
$isHomeHidden	= $template->isHomeHidden();

if ($hasLeftColumn && $hasRightColumn) { // 3 columns
	// if the component is set to be hidden on the homepage
	// the left and right columns will span each half width (span6)
	$columnSpan 	= ($isHomeHidden ? 'span4' : 'span3');
	$contentSpan 	= 'span6';
	$contentPadding = 'rstpl-padding-top';

	$hideAllContent = false;
} elseif ($hasLeftColumn || $hasRightColumn) { // 2 columns
	// if the component is set to be hidden on the homepage
	// the left or right column will span the whole width (span12)
	$columnSpan 	= ($isHomeHidden ? 'span12' : 'span3');
	$contentSpan 	= 'span9';
	$contentPadding = 'rstpl-padding';

	$hideAllContent = false;
} else { // 1 column
	$contentSpan 	= 'span12';
	$contentPadding = 'rstpl-padding';

	// if the component is set to be hidden on the homepage
	// hides all content if there are no left or right columns to display
	$hideAllContent = $isHomeHidden;
}
?>
<?php
	if (!$hideAllContent) {
?>
	<div class="row-fluid rstpl-all-content-position rstpl-padding">
	<?php if ($hasLeftColumn) { ?>
<!-- Start Left Column -->
		<div class="<?php echo $columnSpan; ?> column-left">
			<jdoc:include type="modules" name="column-left" style="rscontent"/>
		</div>
<!-- End Left Column -->
	<?php } ?>
		<div class="<?php echo $contentSpan; ?>">
			<?php if ($this->countModules('inner-before-content')) { ?>
<!-- Start Inner-Before-Content -->
			<div class="row-fluid m-bot-large">
				<div class="span12">
					<jdoc:include type="modules" name="inner-before-content" style="rscontent" />
				</div>
			</div>
			<div class="clearfix"></div>
<!-- End Inner-Before-Content -->
			<?php } ?>
			<?php if (!$isHomeHidden) { ?>
				<jdoc:include type="message" />
<!-- Start Content -->
				<div id="rstpl-<?php echo $template->getOption(); ?>" class="rstpl-content m-bot-large"> 
					<jdoc:include type="component" />
				</div>
<!-- End Content -->
			<?php } ?>
				
			<?php if ($this->countModules('inner-after-content')) { ?>
<!-- Start inner-after-content -->
			<div class="clearfix"></div>
			<div class="row-fluid m-large">
				<div class="span12">
					<jdoc:include type="modules" name="inner-after-content" style="rscontent" />
				</div>
			</div>
<!-- End inner-after-content -->
			<?php } ?>
		</div>
	<?php if ($hasRightColumn) { ?>
<!-- Start Right Column -->
		<div class="span3 column-right">
			<jdoc:include type="modules" name="column-right" style="rsright"/>
		</div>
<!-- End Right Column -->
	<?php } ?>

	</div>
<?php } ?>
<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php if ($this->countModules('top-fixed-a or top-fixed-b or top-fixed-c or top-fixed-d')) { ?>
<!-- Start Top fixed -->
	<div class="row-fluid rstpl-top-fixed-position rstpl-padding">
		<div class="span3">
			<jdoc:include type="modules" name="top-fixed-a" style="rsbottom"/>
		</div>
		<div class="span3">
			<jdoc:include type="modules" name="top-fixed-b" style="rsbottom"/>
		</div>
		<div class="span3">
			<jdoc:include type="modules" name="top-fixed-c" style="rsbottom"/>
		</div>
		<div class="span3">
			<jdoc:include type="modules" name="top-fixed-d" style="rsbottom"/>
		</div>
	</div>
<!-- End Top fixed -->
<?php } ?>


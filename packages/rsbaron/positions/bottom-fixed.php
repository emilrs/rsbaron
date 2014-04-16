<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>

<?php if ($this->countModules('bottom-fixed-a or bottom-fixed-b or bottom-fixed-c or bottom-fixed-d')) { ?>
<!-- Start bottom-fixed -->
<div class="row-fluid rstpl-bottom-fixed-position rstpl-padding">
	<div class="span3">
		<jdoc:include type="modules" name="bottom-fixed-a" style="rsbottom"/>
	</div>
	<div class="span3">
		<jdoc:include type="modules" name="bottom-fixed-b" style="rsbottom"/>
	</div>
	<div class="span3">
		<jdoc:include type="modules" name="bottom-fixed-c" style="rsbottom"/>
	</div>
	<div class="span3">
		<jdoc:include type="modules" name="bottom-fixed-d" style="rsbottom"/>
	</div>
</div>
<!-- End bottom-fixed -->
<?php } ?>
<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>

<?php if ($this->countModules('middle-fixed-a or middle-fixed-b or middle-fixed-c or middle-fixed-d')) { ?>
<!-- Start middle-fixed -->
<div class="row-fluid rstpl-middle-fixed-position rstpl-padding">
	<div class="span3">
		<jdoc:include type="modules" name="middle-fixed-a" style="rsmiddle"/>
	</div>
	<div class="span3">
		<jdoc:include type="modules" name="middle-fixed-b" style="rsmiddle"/>
	</div>
	<div class="span3">
		<jdoc:include type="modules" name="middle-fixed-c" style="rsmiddle"/>
	</div>
	<div class="span3">
		<jdoc:include type="modules" name="middle-fixed-d" style="rsmiddle"/>
	</div>
</div>
<!-- End middle-fixed -->
<?php } ?>
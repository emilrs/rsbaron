<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php if ($this->countModules('footer-fixed-a or footer-fixed-b or footer-fixed-c or footer-fixed-d')) { ?>
	<div class="row-fluid rstpl-footer-fixed-position rstpl-padding">
	<!-- Start footer a,b,c -->
		<div class="span3">
			<jdoc:include type="modules" name="footer-fixed-a" style="rsfooter"/>
		</div>
		<div class="span3">
			<jdoc:include type="modules" name="footer-fixed-b" style="rsfooter"/>
		</div>
		<div class="span3">
			<jdoc:include type="modules" name="footer-fixed-c" style="rsfooter"/>
		</div>
		<div class="span3">
			<jdoc:include type="modules" name="footer-fixed-d" style="rsfooter"/>
		</div>
	<!-- End footer -->
	</div>
<?php } ?>
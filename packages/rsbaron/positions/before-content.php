<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php if ($this->countModules('before-content')) { ?>
<!-- Start Before Content -->
	<div class="row-fluid rstpl-before-content-position rstpl-padding">
		<div class="span12">
			<jdoc:include type="modules" name="before-content" style="rscontent"/>
		</div>
	</div>
<!-- End Before Content -->
<?php } ?>
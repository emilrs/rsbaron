<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php if ($this->countModules('after-content')) { ?>
<!-- Start After Content -->
	<div class="row-fluid rstpl-after-content-position">
		<div class="span12">
			<jdoc:include type="modules" name="after-content" style="rscontent"/>
		</div>
	</div>
<!-- End After Content -->
<?php } ?>
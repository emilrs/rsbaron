<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php if ($this->countModules('slideshow')) { ?>
<!-- Top Slideshow -->
	<div class="row-fluid rstpl-slideshow-position rstpl-back-color-white">
		<div class="span12">
			<jdoc:include type="modules" name="slideshow"/>
		</div>
	</div>
<!-- End Top Slideshow-->
<?php } ?>
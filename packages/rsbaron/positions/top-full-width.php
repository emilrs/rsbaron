<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php if ($this->countModules('top-full-width')) { ?>
<!-- Start Top Full Width -->
	<div class="row-fluid rstpl-top-full-width-position">
		<jdoc:include type="modules" name="top-full-width"/>
	</div>
<!-- End Top Full Width  -->
<?php } ?>
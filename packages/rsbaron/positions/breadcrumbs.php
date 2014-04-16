<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php if ($this->countModules('breadcrumbs')) { ?>
<!-- Start Breadcrumbs -->
	<div class="row-fluid rstpl-padding rstpl-breadcrumbs-position">
		<div class="span12 breadcrumbs-container">
			<jdoc:include type="modules" name="breadcrumbs"/>
		</div>
	</div>
<!-- End Breadcrumbs -->
<?php } ?>
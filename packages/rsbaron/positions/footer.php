<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php if ($this->countModules('footer')) { ?>
<!-- Start footer -->
	<div class="row-fluid rstpl-footer-position">
		<jdoc:include type="modules" name="footer"/>
	</div>
<!-- End footer -->
<?php } ?>

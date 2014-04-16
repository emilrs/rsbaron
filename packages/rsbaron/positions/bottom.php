<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php if ($this->countModules('bottom')) { ?>
<!-- Start bottom -->
		<div class="row-fluid rstpl-bottom-position">
			<div class="span12">
				<jdoc:include type="modules" name="bottom"/>
			</div>
		</div>
<!-- End bottom -->
	<?php } ?>
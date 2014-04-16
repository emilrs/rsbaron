<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php if ($this->countModules('middle')) { ?>
<!-- Start middle -->
		<div class="row-fluid rstpl-middle-position rstpl-padding">
			<div class="span12">
				<jdoc:include type="modules" name="middle"/>
			</div>
		</div>
<!-- End middle -->
	<?php } ?>
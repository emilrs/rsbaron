<?php 
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<?php if ($this->countModules('main-menu')) { ?>
<!-- Start Main Menu -->
	<div class="row-fluid rstpl-main-menu-position">
		<div class="navbar pull-center">
			<div class="navbar-inner">
				<div class="container">
					<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" rel="nofollow">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					  <!-- Be sure to leave the brand out there if you want it shown -->
					<a class="brand hidden-desktop" data-toggle="collapse" data-target=".nav-collapse" rel="nofollow"><?php echo JText::_('TPL_RSBARON_MENU_BUTTON'); ?></a>
					  <!-- Everything you want hidden at 940px or less, place within here -->
					<div class="nav-collapse collapse  navbar-responsive-collapse">
						<jdoc:include type="modules" name="main-menu"/>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- End Main Menu -->
<?php } ?>
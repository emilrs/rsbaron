<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
$base_url = JURI::root(true);
$doc = JFactory::getDocument();
?>

<div class="rstpl-social rstpl-social-center-container rstpl-social-align-block pull-<?php echo $alignment;?>">
	<?php if (trim($h3text) != '') { ?>
	<h5 class="rstpl-display-inline pull-left rstpl-social-heading"><?php echo $this->escape($h3text); ?></h5>
	<div class="pull-left">
	<?php } ?>
	<?php if (trim($facebook) != '') { ?>
			<a href="<?php echo $this->escape($facebook); ?>" class="rstpl-social-link" title="<?php echo JText::_('RSTPL_FACEBOOK_TAG'); ?>"><span class="icon-facebook"></span></a>
	<?php } ?>
	<?php if (trim($twitter) != '') { ?>
			<a href="<?php echo $this->escape($twitter); ?>" class="rstpl-social-link" title="<?php echo JText::_('RSTPL_TWITTER_TAG'); ?>"><span class="icon-twitter"></span></a>
	<?php } ?>	
	<?php if (trim($linkedin) != '') { ?>
			<a href="<?php echo $this->escape($linkedin); ?>" class="rstpl-social-link" title="<?php echo JText::_('RSTPL_LINKEDIN_TAG'); ?>"><span class="icon-linkedin"></span></a>
	<?php } ?>
	<?php if (trim($google) != '') { ?>
			<a href="<?php echo $this->escape($google); ?>" class="rstpl-social-link" title="<?php echo JText::_('RSTPL_GOOGLE_TAG'); ?>"><span class="icon-google-plus"></span></a>
	<?php } ?> 
	<?php if (trim($youtube) != '') { ?>
			<a href="<?php echo $this->escape($youtube); ?>" class="rstpl-social-link" title="<?php echo JText::_('RSTPL_YOUTUBE_TAG'); ?>"><span class="icon-youtube"></span></a>
	<?php } ?>
	<?php if (trim($vimeo) != '') { ?>
			<a href="<?php echo $this->escape($vimeo); ?>" class="rstpl-social-link" title="<?php echo JText::_('RSTPL_VIMEO_TAG'); ?>"><span class="icon-vimeo"></span></a>
	<?php } ?>
	<?php if (trim($flickr) != '') { ?>
			<a href="<?php echo $this->escape($flickr); ?>" class="rstpl-social-link" title="<?php echo JText::_('RSTPL_FLICKR_TAG'); ?>"><span class="icon-flickr"></span></a>
	<?php } ?>
	<?php if (trim($pinterest) != '') { ?>
			<a href="<?php echo $this->escape($pinterest); ?>" class="rstpl-social-link" title="<?php echo JText::_('RSTPL_PINTEREST_TAG'); ?>"><span class="icon-pinterest"></span></a>
	<?php } ?>
	<?php if (trim($yahoo) != '') { ?>
			<a href="ymsgr:sendim?<?php echo $this->escape($yahoo); ?>" class="rstpl-social-link" title="<?php echo JText::_('RSTPL_YAHOO_TAG'); ?>"><span class="icon-yahoo"></span></a>
	<?php } ?>
	<?php if (trim($skype) != '') { ?>
			<a href="skype:<?php echo $this->escape($skype); ?>" class="rstpl-social-link" title="<?php echo JText::_('RSTPL_SKYPE_TAG'); ?>"><span class="icon-skype"></span></a>
	<?php } ?>
	<?php if (trim($h3text) != '') { ?>
		</div>
	<?php } ?>
</div>
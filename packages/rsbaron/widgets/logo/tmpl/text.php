<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<<?php echo $this->escape($heading); ?> class="textalign-<?php echo $this->escape($textAlignment); ?> color-<?php echo $this->escape($textColor); ?>">
	<?php if ($anchor!='') { ?>
		<a href="<?php echo $this->escape($anchor); ?>" class="color-<?php echo $this->escape($textColor); ?>">
	<?php }?>
	<?php echo $this->escape($text); ?>
	<?php if ($anchor!='') { ?>
		</a>
	<?php } ?>
</<?php echo $this->escape($heading); ?>>
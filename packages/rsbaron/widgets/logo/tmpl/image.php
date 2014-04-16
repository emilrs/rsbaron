<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<div class="textalign-<?php echo $this->escape($imageAlignment); ?>">
<?php if ($anchor!='') { ?>
		<a href="<?php echo $this->escape($anchor); ?>">
<?php } ?>
			<img src="<?php echo $this->escape(JURI::root(true).'/'.$image); ?>" alt="<?php echo $this->escape($text); ?>" />
<?php if ($anchor!='') { ?>
		</a>
<?php } ?>
</div>
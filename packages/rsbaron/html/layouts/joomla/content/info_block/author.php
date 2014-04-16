<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

defined('JPATH_BASE') or die;

?>
<dd class="createdby">
	<i class="icon-user2"></i>
	<?php $author = $displayData['item']->author; ?>
	<?php $author = ($displayData['item']->created_by_alias ? $displayData['item']->created_by_alias : $author); ?>
	<?php if (!empty($displayData['item']->contactid ) && $displayData['params']->get('link_author') == true) : ?>
		<?php
		echo JText::sprintf('COM_CONTENT_WRITTEN_BY',
			JHtml::_('link', JRoute::_('index.php?option=com_contact&view=contact&id='.$displayData['item']->contactid), ':<div class="rstpl-author">'.$author.'</div>')
		); ?>
	<?php else :?>
		<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', ':<div class="rstpl-author">'.$author.'</div>'); ?>
	<?php endif; ?>
</dd>
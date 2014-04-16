<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

// no direct access
defined('_JEXEC') or die;

// Create a shortcut for params.
$params = &$this->item->params;
$images = json_decode($this->item->images);
$canEdit	= $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.framework');

require_once JPATH_SITE.'/templates/rsbaron/classes/helper.php';

?>
<?php if ($this->item->state == 0) { ?>
<div class="system-unpublished">
<?php } ?>
<?php if ($params->get('show_title')) { ?>
	<h2 class="m-bot-small">
		<?php if ($params->get('link_titles') && $params->get('access-view')) { ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
			<?php echo $this->escape($this->item->title); ?></a>
		<?php } else { ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php } ?>
	</h2>
<?php } ?>

<?php if (!$params->get('show_intro')) { ?>
	<?php echo $this->item->event->afterDisplayTitle; ?>
<?php } ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<?php // to do not that elegant would be nice to group the params ?>

<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits')) or $params->get('show_print_icon') or $params->get('show_email_icon')) { ?>
 <div class="row-fluid article-info">
 <div class="span12">
 <dl class="article-info">
 <dt class="article-info-term"><?php echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>
<?php } ?>

<?php if ($params->get('show_author') && !empty($this->item->author )) { ?>
	<dd class="createdby">
		<?php $author =  $this->item->author; ?>
		<?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>

			<?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true) { ?>
				<?php 	echo JText::sprintf('COM_CONTENT_WRITTEN_BY',
				 JHtml::_('link', JRoute::_('index.php?option=com_contact&view=contact&id='.$this->item->contactid), '<div class="rstpl-author rstpl-display-inline">'.$author.'</div>')); ?>

			<?php } else { ?>
				<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', '<div class="rstpl-author rstpl-display-inline">'.$author.'</div>'); ?>
			<?php } ?>
	</dd>
<?php } ?>
<?php if ($params->get('show_hits')) { ?>
	<dd class="hits">
	<span class="icon-eye"></span> <?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
	</dd>
<?php } ?>
<?php if ($params->get('show_create_date')) { ?>
		<dd class="create">
		<span class="icon-clock"></span>
		<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php } ?>
<?php if ($params->get('show_modify_date')) { ?>
		<dd class="modified">
		<span class="icon-clock"></span>
		<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php } ?>
<?php if ($params->get('show_publish_date')) { ?>
		<dd class="published">
		<span class="icon-clock"></span>
		<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
		</dd>
<?php } ?>
	</dl>
<?php if (($canEdit || $params->get('show_category')) or ($params->get('show_parent_category')) or $params->get('show_print_icon') or $params->get('show_email_icon')) { ?>
	<?php if (($params->get('show_parent_category') && $this->item->parent_id != 1) || $params->get('show_category')) { ?> 
			<dl class="rstpl-structure-article">
			<?php 
			if ($params->get('show_parent_category') && $this->item->parent_slug != '1:root') { ?>
				<dd class="parent-category-name">
					<?php $title = $this->escape($this->item->parent_title);
					$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)).'">'.$title.'</a>';
					if ($params->get('link_parent_category') && !empty($this->item->parent_slug)) { 
						echo $url;
					} else {
						echo $title;
					} 
					?>
				</dd>
				<dd>
					<span class="icon-chevron-right"></span>
				</dd>
			<?php } ?>
			
			<?php if ($params->get('show_category')) { ?>
				<dd class="category-name">
					<?php $title = $this->escape($this->item->category_title);
					$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catid)) . '">' . $title . '</a>';
					if ($params->get('link_category') && $this->item->catid) {
						echo $url; 
					} else {
						echo $title;
					} 
					?>
				</dd>
			<?php } ?>
			</dl>
		<?php } ?>	
		<dl class="article-info">	
			<?php if ($canEdit ||  $params->get('show_print_icon') || $params->get('show_email_icon')) { ?>
				<?php if ($params->get('show_print_icon')) { ?>
				<dd class="rstpl-print-article rstpl-clear-right"><span class="print-icon"> <?php echo RSTemplateHelper::addOptiontext(JHtml::_('icon.print_popup', $this->item, $params),JText::_('JGLOBAL_PRINT'),'icon-print2'); ?></span> </dd>
				<?php } ?>
				<?php if ($params->get('show_email_icon')) { ?>
				<dd class="rstpl-print-article rstpl-clear-right"> <span class="email-icon"> <?php echo RSTemplateHelper::addOptiontext(JHtml::_('icon.email', $this->item, $params),JText::_('JGLOBAL_EMAIL'),'icon-mail'); ?></span> </dd>
				<?php } ?>
				<?php if ($canEdit) { ?>
				<dd class="rstpl-print-article rstpl-clear-right" style="clear:left"> <span class="edit-icon"> <?php echo RSTemplateHelper::addOptiontext(JHtml::_('icon.edit', $this->item, $params),JText::_('JGLOBAL_EDIT'),'icon-pencil2');  ?></span> </dd>
				<?php } ?>
			<?php } ?>
		</dl>
	<?php } ?>
<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits')) or $params->get('show_print_icon') or $params->get('show_email_icon')) { ?>
</div>
</div>
<?php } ?>
<?php if (isset($images->image_intro) and !empty($images->image_intro)) { ?>
	<?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
	<div class="img-intro-<?php echo htmlspecialchars($imgfloat); ?>">
	<img
		<?php if ($images->image_intro_caption) {
			echo 'class="caption"'.' title="' .htmlspecialchars($images->image_intro_caption) .'"';
		} ?>
		src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/>
	</div>
<?php } ?>
<?php echo $this->item->introtext; ?>

<?php if ($params->get('show_readmore') && $this->item->readmore) {
	if ($params->get('access-view')) {
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
	} else {
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
		$link = new JURI($link1);
		$link->setVar('return', base64_encode(urlencode($returnURL)));
	}
?>
		<p class="readmore">					
			<a class="btn" href="<?php echo $link; ?>"> <span class="icon-chevron-right"></span>
				<?php if (!$params->get('access-view')) {
					echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
				} elseif ($readmore = $this->item->alternative_readmore) {
					echo $readmore;
					if ($params->get('show_readmore_title', 0) != 0) {
						echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					}
				} elseif ($params->get('show_readmore_title', 0) == 0) {
					echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
				} else {
					echo JText::_('COM_CONTENT_READ_MORE');
					echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
				} ?></a>
		</p>
<?php } ?>

<?php if ($this->item->state == 0) { ?>
</div>
<?php } ?>

<div class="item-separator"></div>
<?php echo $this->item->event->afterDisplayContent;?>
<div class="clearfix"></div>
<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
$params = &$this->params;
require_once JPATH_SITE.'/templates/rsbaron/classes/helper.php';
?>

<ul id="archive-items">
<?php foreach ($this->items as $i => $item) { ?>
		<li class="row<?php echo $i % 2; ?>">

			<h2 class="m-bot-large">
			<?php if ($params->get('link_titles')) { ?>
				<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug)); ?>">
					<?php echo $this->escape($item->title); ?></a>
			<?php } else { ?>
					<?php echo $this->escape($item->title); ?>
			<?php } ?>
			</h2>

			
	<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits')) or $params->get('show_print_icon') or $params->get('show_email_icon')) { ?>
		 <div class="row-fluid article-info">
		 <div class="span12">
		 <dl class="article-info">
		 <dt class="article-info-term"><?php echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>
	<?php } ?>

	<?php if ($params->get('show_author') && !empty($item->author )) { ?>
			<dd class="createdby">
				<?php $author =  $item->author; ?>
				<?php $author = ($item->created_by_alias ? $item->created_by_alias : $author);?>

					<?php if (!empty($item->contactid ) &&  $params->get('link_author') == true) { ?>
						<?php 	echo JText::sprintf('COM_CONTENT_WRITTEN_BY',
						 JHtml::_('link', JRoute::_('index.php?option=com_contact&view=contact&id='.$item->contactid), '<div class="rstpl-author rstpl-display-inline">'.$author.'</div>')); ?>

					<?php } else { ?>
						<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', '<div class="rstpl-author rstpl-display-inline">'.$author.'</div>'); ?>
					<?php } ?>
			</dd>
	<?php } ?>
	
	<?php if ($params->get('show_hits')) { ?>
		<dd class="hits">
		<span class="icon-eye"></span> <?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $item->hits); ?>
		</dd>
	<?php } ?>	
				
	<?php if ($params->get('show_create_date')) { ?>
			<dd class="create">
			<span class="icon-clock"></span>
			<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC2'))); ?>
			</dd>
	<?php } ?>
	<?php if ($params->get('show_modify_date')) { ?>
			<dd class="modified">
			<span class="icon-clock"></span>
			<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
			</dd>
	<?php } ?>
	<?php if ($params->get('show_publish_date')) { ?>
			<dd class="published">
			<span class="icon-clock"></span>
			<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
			</dd>
	<?php } ?>
	</dl>

	<?php if (($params->get('show_category')) or ($params->get('show_parent_category')) or $params->get('show_print_icon') or $params->get('show_email_icon')) { ?>
		
		<?php if (($params->get('show_parent_category') && $item->parent_id != 1) || $params->get('show_category')) { ?> 
				<dl class="rstpl-structure-article">
				<?php 
				if ($params->get('show_parent_category') && $item->parent_slug != '1:root') { ?>
					<dd class="parent-category-name">
						<?php $title = $this->escape($item->parent_title);
						$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($item->parent_slug)).'">'.$title.'</a>';?>
						<?php if ($params->get('link_parent_category') && !empty($item->parent_slug)) { ?>
							<?php echo $url; ?>
						<?php } else { ?>
							<?php echo $title; ?>
						<?php } ?>
					</dd>
					<dd>
						<span class="icon-chevron-right"></span>
					</dd>
				<?php } ?>
				
				<?php if ($params->get('show_category')) { ?>
					<dd class="category-name">
						<?php $title = $this->escape($item->category_title);
						$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->catid)) . '">' . $title . '</a>';?>
						<?php if ($params->get('link_category') && $item->catid) { ?>
							<?php echo $url; ?>
						<?php } else { ?>
							<?php echo $title; ?>
						<?php } ?>
					</dd>
				<?php } ?>
				</dl>
		<?php } ?>	
		
		<?php if ($params->get('show_print_icon') || $params->get('show_email_icon')) { ?>
			<dl class="article-info">
					<?php if ($params->get('show_print_icon')) { ?>
					<dd class="rstpl-print-article rstpl-clear-right"><span class="print-icon"> <?php echo RSTemplateHelper::addOptiontext(JHtml::_('icon.print_popup', $item, $params),JText::_('JGLOBAL_PRINT'),'icon-print2'); ?></span> </dd>
					<?php } ?>
					<?php if ($params->get('show_email_icon')) { ?>
					<dd class="rstpl-print-article rstpl-clear-right"> <span class="email-icon"> <?php echo RSTemplateHelper::addOptiontext(JHtml::_('icon.email', $item, $params),JText::_('JGLOBAL_EDIT'),'icon-mail'); ?></span> </dd>
					<?php } ?>
			</dl>
		<?php } ?>
	<?php } ?>	
	<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits')) or $params->get('show_print_icon') or $params->get('show_email_icon')) { ?>
		</div>
	</div>
	<?php } ?>		
			

	<?php if ($params->get('show_intro')) { ?>
		<div class="intro">
			<?php echo JHtml::_('string.truncate', $item->introtext, $params->get('introtext_limit')); ?>
		</div>
	<?php } ?>
		</li>
<?php } ?>
</ul>

<div class="pagination">
	<p class="counter">
		<?php echo $this->pagination->getPagesCounter(); ?>
	</p>
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
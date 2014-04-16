<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
$params = $this->params;
?>

<div id="archive-items">
	<?php foreach ($this->items as $i => $item) { ?>
		<?php $info = $item->params->get('info_block_position', 0); ?>
		<div class="row<?php echo $i % 2; ?>">
			<div class="page-header pull-left">
				<h2>
					<?php if ($params->get('link_titles')) { ?>
						<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug)); ?>"> <?php echo $this->escape($item->title); ?></a>
					<?php } else { ?>
						<?php echo $this->escape($item->title); ?>
					<?php } ?>
				</h2>
			</div>
		<?php 
		$useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date') || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category')); ?>
			
		<?php if ((!$useDefList || ($useDefList && $info == 1))) { ?> 
			<?php if ($params->get('show_print_icon') || $params->get('show_email_icon')) { ?>
			<div class="rstpl-just-print pull-right">
				<?php // Note the actions class is deprecated. Use dropdown-menu instead. ?>
				<ul class="actions">
					<?php if ($params->get('show_print_icon')) { ?>
					<li class="print-icon"> <?php echo JHtml::_('icon.print_popup', $item, $params); ?> </li>
					<?php } ?>
					<?php if ($params->get('show_email_icon')) { ?>
					<li class="email-icon"> <?php echo JHtml::_('icon.email', $item, $params); ?> </li>
					<?php } ?>
				</ul>
			</div>
			<?php } ?>
		<?php } ?>
		<div class="clearfix"></div>
		<?php if ($useDefList && ($info == 0 || $info == 2)) { ?>
			<div class="row-fluid article-info muted">
				<div class="span12">
					<dl class="article-info rstpl-archive-metas">
					
			<?php if ($info == 0) { ?>
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
			<?php } ?>
			<?php if ($params->get('show_publish_date')) { ?>
					<dd class="published">
					<span class="icon-clock"></span>
					<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
					</dd>
			<?php } ?>
					
			<?php if ($params->get('show_author') && !empty($item->author )) { ?>
				<dd class="createdby">
					<i class="icon-user"></i>
					<?php $author =  $item->author; ?>
					<?php $author = ($item->created_by_alias ? $item->created_by_alias : $author);?>

						<?php if (!empty($item->contactid ) &&  $params->get('link_author') == true) {?>
							<?php 	echo JText::sprintf('COM_CONTENT_WRITTEN_BY',
							 '<div class="rstpl-author rstpl-display-inline">'.JHtml::_('link', JRoute::_('index.php?option=com_contact&view=contact&id='.$item->contactid), $author).'</div>'); ?>

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

				<?php if (($params->get('show_parent_category') && $item->parent_id != 1) || $params->get('show_category')) { ?> 
					
						<?php 
						if ($params->get('show_parent_category') && $item->parent_slug != '1:root') { ?>
							<dd class="parent-category-name">
								<?php $title = $this->escape($item->parent_title);
								$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($item->parent_slug)).'">'.$title.'</a>';
								if ($params->get('link_parent_category') && !empty($item->parent_slug)) { 
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
								<i class="icon-folder-open"></i>
								<?php 
								$title  = $this->escape($item->category_title);
								$url 	= '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->catid)) . '">' . $title . '</a>';
								if ($params->get('link_category') && $item->catid) {
									echo $url;
								} else {
									echo $title; 
								}
								?>
							</dd>
						<?php } ?>
				<?php } ?>	
					</dl>
				
				<?php if ($params->get('show_print_icon') || $params->get('show_email_icon')) { ?>
					<dl class="article-info">
							<?php if ($params->get('show_print_icon')) { ?>
							<dd class="rstpl-print-article rstpl-clear-right"><span class="print-icon"> <?php echo JHtml::_('icon.print_popup', $item, $params); ?></span> </dd>
							<?php } ?>
							<?php if ($params->get('show_email_icon')) { ?>
							<dd class="rstpl-print-article rstpl-clear-right"> <span class="email-icon"> <?php echo JHtml::_('icon.email', $item, $params); ?></span> </dd>
							<?php } ?>
					</dl>
					<?php }?>
				</div>
			</div>
		<?php } ?>

		<?php if ($params->get('show_intro')) { ?>
			<div class="intro"> <?php echo JHtml::_('string.truncate', $item->introtext, $params->get('introtext_limit')); ?> </div>
		<?php } ?>
		
		
		
		<?php if ($useDefList && ($info == 1 || $info == 2)) { ?>
			<div class="article-info muted">
				<div class="rstpl-article-container">
					<div class="row-fluid">
						<div class="span12">
							<dl class="article-info">
							<?php if ($info == 1) { ?>
								<?php if ($params->get('show_author') && !empty($item->author )) { ?>
									<dd class="createdby">
										<?php $author =  $item->author; ?>
										<?php $author = ($item->created_by_alias ? $item->created_by_alias : $author);?>

											<?php if (!empty($item->contactid ) &&  $params->get('link_author') == true) { ?>
												<?php 	echo JText::sprintf('COM_CONTENT_WRITTEN_BY',
												 '<div class="rstpl-author rstpl-display-inline">'.JHtml::_('link', JRoute::_('index.php?option=com_contact&view=contact&id='.$item->contactid), $author).'</div>'); ?>

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
								<?php if ($params->get('show_publish_date')) { ?>
									<dd class="published">
										<span class="icon-clock"></span> <?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
									</dd>
								<?php } ?>
							<?php } ?>
							<?php if ($params->get('show_modify_date')) { ?>
								<dd class="modified">
									<span class="icon-clock"></span> <?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
								</dd>
							<?php } ?>
							<?php if ($params->get('show_create_date')) { ?>
								<dd class="create">
									<span class="icon-clock"></span> <?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC3'))); ?>
								</dd>
							<?php } ?>
							</dl>
							<?php if ($info == 1) { ?>
								<dl class="rstpl-structure-article">
								<?php if ($params->get('show_parent_category') && !empty($item->parent_slug)) { ?>
									<dd class="parent-category-name">
										<?php $title = $this->escape($item->parent_title);
										$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($item->parent_slug)).'">'.$title.'</a>';
										if ($params->get('link_parent_category') && !empty($item->parent_slug)) { 
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
										<?php $title = $this->escape($item->category_title);
										$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug)) . '">' . $title . '</a>';
										if ($params->get('link_category') && $item->catslug) {
											echo $url; 
										} else { 
											echo $title; 
										} 
										?>
									</dd>
								<?php } ?>
								
								</dl>
							<?php } ?>
						</div>
					</div>
				</div>
				
			</div>
		<?php } ?>
		
	</div>
	<?php } ?>
</div>
<div class="pagination">
	<p class="counter"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
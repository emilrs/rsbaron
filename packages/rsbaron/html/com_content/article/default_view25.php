<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

defined('_JEXEC') or die;
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();


require_once JPATH_SITE.'/templates/rsbaron/classes/helper.php';
?>
<div class="item-page<?php echo $this->pageclass_sfx?> rstpl-article-fix">
	<?php if ($this->params->get('show_page_heading')) { ?>
		<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
	<?php } ?>
	<?php
	if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative) {
		echo $this->item->pagination;
	}
	?>

	<?php if ($params->get('show_title')) { ?>
		<h2 class="m-bot-large">
		<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) { ?>
			<a href="<?php echo $this->item->readmore_link; ?>">
			<?php echo $this->escape($this->item->title); ?></a>
		<?php } else { ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php } ?>
		</h2>
	<?php } ?>

	<?php 
		if (!$params->get('show_intro')) {
			echo $this->item->event->afterDisplayTitle;
		} 
	?>

	<?php echo $this->item->event->beforeDisplayContent; ?>

	<?php 
		$useDefList = (($params->get('show_author')) || ($params->get('show_category')) || ($params->get('show_parent_category'))
		|| ($params->get('show_create_date')) || ($params->get('show_modify_date')) || ($params->get('show_publish_date'))
		|| ($params->get('show_hits')) || $canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')); 
	?>

	<?php if ($useDefList) { ?>
		<div class="article-info muted">
			<div class="rstpl-article-container">
				<div class="row-fluid">
					<div class="span12">
						<?php echo RSTemplateHelper::showGravatar($this->item->created_by);?>
						<div class="inner-article">
						<dl class="article-info">
						<?php if ($params->get('show_author') && !empty($this->item->author )) { ?>
							<dd class="createdby">
								<?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
								<?php if (!empty($this->item->contactid) && $params->get('link_author') == true) { ?>
									<?php
									$needle = 'index.php?option=com_contact&view=contact&id=' . $this->item->contactid;
									$menu = JFactory::getApplication()->getMenu();
									$item = $menu->getItems('link', $needle, true);
									$cntlink = !empty($item) ? $needle . '&Itemid=' . $item->id : $needle;
									?>
									<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', '<div class="rstpl-author rstpl-display-inline">'.JHtml::_('link', JRoute::_($cntlink), $author)).'</div>'; ?>
								<?php } else { ?>
									<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', '<div class="rstpl-author rstpl-display-inline">'.$author.'</div>'); ?>
								<?php } ?>
							</dd>
						<?php } ?>
	<?php //} ?>		
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
						
			<?php if (($params->get('show_parent_category') && $this->item->parent_slug != '1:root') || $params->get('show_category')) { ?> 
						<dl class="rstpl-structure-article">
						<?php 
						if ($params->get('show_parent_category') && $this->item->parent_slug != '1:root') { ?>
							<dd class="parent-category-name">
								<?php $title = $this->escape($this->item->parent_title);
								$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)).'">'.$title.'</a>';?>
								<?php if ($params->get('link_parent_category') && !empty($this->item->parent_slug)) { ?>
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
								<?php $title = $this->escape($this->item->category_title);
								$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) . '">' . $title . '</a>';?>
								<?php if ($params->get('link_category') && $this->item->catslug) { ?>
									<?php echo $url; ?>
								<?php } else { ?>
									<?php echo $title; ?>
								<?php } ?>
							</dd>
						<?php } ?>
						</dl>
			<?php } ?>		
						
	<?php //if ($useDefList) { ?>
					<?php if ($params->get('show_hits') || $canEdit ||  $params->get('show_print_icon') || $params->get('show_email_icon')) { ?>
						
								<dl class="article-info">
									
									<?php if ($canEdit ||  $params->get('show_print_icon') || $params->get('show_email_icon')) { ?>
										<?php if ($params->get('show_print_icon')) { ?>
										<dd class="rstpl-print-article rstpl-clear-right"><span class="print-icon"></span> <?php echo RSTemplateHelper::addOptiontext(JHtml::_('icon.print_popup', $this->item, $params),JText::_('JGLOBAL_PRINT'),'icon-print2'); ?> </dd>
										<?php } ?>
										<?php if ($params->get('show_email_icon')) { ?>
										<dd class="rstpl-print-article rstpl-clear-right"> <span class="email-icon"> <?php echo RSTemplateHelper::addOptiontext(JHtml::_('icon.email', $this->item, $params),JText::_('JGLOBAL_EMAIL'),'icon-mail'); ?></span> </dd>
										<?php } ?>
										<?php if ($canEdit) { ?>
										<dd class="rstpl-print-article rstpl-clear-right"> <span class="edit-icon"> <?php echo RSTemplateHelper::addOptiontext(JHtml::_('icon.edit', $this->item, $params),JText::_('JGLOBAL_EDIT'),'icon-pencil2'); ?></span> </dd>
										<?php } ?>
									<?php } ?>
								</dl>
							
						<?php } ?>
						</div>
					</div>
					<?php ///// end 30 style ?>
				</div>
			</div>
		</div>
	<?php } ?>

	<?php 
		if (isset ($this->item->toc) AND $params->get('urls_position')=='0') { 
			echo $this->item->toc;
		} 
	?>

	<?php 
		if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position=='0')) ||  ($params->get('urls_position')=='0' && empty($urls->urls_position) )) || (empty($urls->urls_position) && (!$params->get('urls_position')))) {
			echo $this->loadTemplate('links');
		} 
	?>

	<?php 
	if ($params->get('access-view')) {
		if (isset($images->image_fulltext) and !empty($images->image_fulltext)) { 
				$imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
				<div class="img-fulltext-<?php echo htmlspecialchars($imgfloat); ?>">
				<img
					<?php 
					if ($images->image_fulltext_caption) {
						echo 'class="caption"'.' title="' .htmlspecialchars($images->image_fulltext_caption) .'"';
					} 
					?>
					src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>"/>
				</div>
		<?php } ?>
		<?php
			if (!empty($this->item->pagination) AND $this->item->pagination AND !$this->item->paginationposition AND !$this->item->paginationrelative) {
				echo $this->item->pagination;
			}
		?>
		<?php echo $this->item->text; ?>
		<?php
			if (isset($urls) AND ((!empty($urls->urls_position)  AND ($urls->urls_position=='1')) OR ($params->get('urls_position')=='1'))) { 
				echo $this->loadTemplate('links'); 
			} 
		?>
		<?php 
			if (isset ($this->item->toc) AND $params->get('urls_position')=='1') {
				echo $this->item->toc;
			} 
		?>
		<?php //optional teaser intro text for guests ?>
	<?php 
	} elseif ($params->get('show_noauth') == true and  $user->get('guest') ) { 
		echo $this->item->introtext; 
		//Optional link to let them register to see the whole article. 
		if ($params->get('show_readmore') && $this->item->fulltext != null) {
			$link1 = JRoute::_('index.php?option=com_users&view=login');
			$link = new JURI($link1);?>
			<p class="readmore">
			<a href="<?php echo $link; ?>">
			<?php $attribs = json_decode($this->item->attribs);  ?>
			<?php
				if ($attribs->alternative_readmore == null) {
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
				} 
			?></a>
			</p>
		<?php } ?>
	<?php } ?>
	<?php
		if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND $this->item->paginationrelative) {
			 echo $this->item->pagination;
		}
	?>

	<?php echo $this->item->event->afterDisplayContent; ?>
	</div>
<?php
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();
$info    = $params->get('info_block_position', 0);
JHtml::_('behavior.caption');

require_once JPATH_SITE.'/templates/rsbaron/classes/helper.php';
?>
<div class="item-page<?php echo $this->pageclass_sfx?> rstpl-article-container">
	<?php if ($this->params->get('show_page_heading') && $params->get('show_title')) : ?>
	<div class="page-header">
		<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
	</div>
	<?php endif;
if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
{
	echo $this->item->pagination;
}
?>
	<?php if ($params->get('show_title') || $params->get('show_author')) : ?>
	<div class="page-header">
		<h2>
			<?php if ($this->item->state == 0) : ?>
				<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
			<?php endif; ?>
			<?php if ($params->get('show_title')) : ?>
				<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
					<a href="<?php echo $this->item->readmore_link; ?>"> <?php echo $this->escape($this->item->title); ?></a>
				<?php else : ?>
					<?php echo $this->escape($this->item->title); ?>
				<?php endif; ?>
			<?php endif; ?>
		</h2>
	</div>
	<?php endif; ?>
	<?php if (!$this->print) : ?>
		<?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
		<div class="btn-group pull-right">
			<a class="btn dropdown-toggle" data-toggle="dropdown" href="#"> <span class="icon-cog"></span> <span class="caret"></span> </a>
			<?php // Note the actions class is deprecated. Use dropdown-menu instead. ?>
			<ul class="dropdown-menu actions">
				<?php // if ($params->get('show_print_icon')) : ?>
				<li class="print-icon"> <?php echo JHtml::_('icon.print_popup', $this->item, $params); ?> </li>
				<?php // endif; ?>
				<?php //if ($params->get('show_email_icon')) : ?>
				<li class="email-icon"> <?php echo JHtml::_('icon.email', $this->item, $params); ?> </li>
				<?php //endif; ?>
				<?php if ($canEdit) : ?>
				<li class="edit-icon"> <?php echo JHtml::_('icon.edit', $this->item, $params); ?> </li>
				<?php endif; ?>
			</ul>
		</div>
		<?php endif; ?>
		<?php else : ?>
		<div class="pull-right">
		<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
		</div>
	<?php endif; ?>
<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
	|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author')); ?>
	<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
		<div class="article-info muted">
			<dl class="article-info">
			<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
				<dt class="createdby"><?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY','');?></dt>
				<dd class="createdby">
					<?php $gravatar = RSTemplateHelper::showGravatar($this->item->created_by); ?>

					<?php $author 	= $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
					<?php $author 	= !empty($gravatar) ? $gravatar : $author ;?>
					<?php if (!empty($this->item->contactid) && $params->get('link_author') == true) : ?>
						<?php
						$needle = 'index.php?option=com_contact&view=contact&id=' . $this->item->contactid;
						$menu = JFactory::getApplication()->getMenu();
						$item = $menu->getItems('link', $needle, true);
						$cntlink = !empty($item) ? $needle . '&Itemid=' . $item->id : $needle;
						?>
						<?php echo JHtml::_('link', JRoute::_($cntlink), $author); ?>
					<?php else: ?>
						<?php echo $author; ?>
					<?php endif; ?>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_parent_category') && !empty($this->item->parent_slug)) : ?>
				<dt class="parent-category-name"><i class="icon-folder"></i><?php echo JText::sprintf('COM_CONTENT_PARENT','');?></dt>
				<dd class="parent-category-name">
					<?php $title = $this->escape($this->item->parent_title);
					$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)).'">'.$title.'</a>';?>
					<?php if ($params->get('link_parent_category') && !empty($this->item->parent_slug)) : ?>
						<?php echo $url; ?>
					<?php else : ?>
						<?php echo $title; ?>
					<?php endif; ?>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_category')) : ?>
				<dt class="category-name"><i class="icon-folder-open"></i><?php echo JText::sprintf('COM_CONTENT_CATEGORY', '');?></dt>
				<dd class="category-name">
					<?php $title = $this->escape($this->item->category_title);
					$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) . '">' . $title . '</a>';?>
					<?php if ($params->get('link_category') && $this->item->catslug) : ?>
						<?php echo $url; ?>
					<?php else : ?>
						<?php echo $title; ?>
					<?php endif; ?>
				</dd>
			<?php endif; ?>

			<?php if ($params->get('show_publish_date')) : ?>
				<dt class="published"><?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON','');?></dt>
				<dd class="published">
					<span class="icon-clock"></span> <?php echo JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3')); ?>
				</dd>
			<?php endif; ?>

			<?php if ($info == 0) : ?>
				<?php if ($params->get('show_modify_date')) : ?>
					<dt class="modified"><?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED',''); ?></dt>
					<dd class="modified">
						<span class="icon-clock"></span> <?php echo JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC3')); ?>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_create_date')) : ?>
					<dt class="create"><?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', ''); ?></dt>
					<dd class="create">
						<span class="icon-clock"></span> <?php echo JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3')); ?>
					</dd>
				<?php endif; ?>

				<?php if ($params->get('show_hits')) : ?>
					<dt class="hits"><?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', '');?></dt>
					<dd class="hits">
						<span class="icon-eye"></span> <?php echo $this->item->hits; ?>
					</dd>
				<?php endif; ?>
			<?php endif; ?>
			</dl>
		</div>
	<?php endif; ?>

	<?php if ($params->get('show_tags', 1) && !empty($this->item->tags)) : ?>
		<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>

		<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
	<?php endif; ?>

	<?php if (!$params->get('show_intro')) : echo $this->item->event->afterDisplayTitle; endif; ?>
	<?php echo $this->item->event->beforeDisplayContent; ?>

	<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '0')) || ($params->get('urls_position') == '0' && empty($urls->urls_position)))
		|| (empty($urls->urls_position) && (!$params->get('urls_position')))) : ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php if ($params->get('access-view')):?>
	<?php if (isset($images->image_fulltext) && !empty($images->image_fulltext)) : ?>
	<?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
	<div class="pull-<?php echo htmlspecialchars($imgfloat); ?> item-image"> <img
	<?php if ($images->image_fulltext_caption):
		echo 'class="caption"'.' title="' .htmlspecialchars($images->image_fulltext_caption) . '"';
	endif; ?>
	src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>"/> </div>
	<?php endif; ?>
	<?php
	if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && !$this->item->paginationrelative):
		echo $this->item->pagination;
	endif;
	?>
	<?php if (isset ($this->item->toc)) :
		echo $this->item->toc;
	endif; ?>
	<?php echo $this->item->text; ?>

	<?php if ($useDefList && ($info == 1 || $info == 2)) : ?>
		<div class="article-info muted">
			<dl class="article-info">
			<dt class="article-info-term"><?php echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>

			<?php if ($info == 1) : ?>
				<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
					<dd class="createdby">
						<?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
						<?php if (!empty($this->item->contactid) && $params->get('link_author') == true) : ?>
						<?php
						$needle = 'index.php?option=com_contact&view=contact&id=' . $this->item->contactid;
						$menu = JFactory::getApplication()->getMenu();
						$item = $menu->getItems('link', $needle, true);
						$cntlink = !empty($item) ? $needle . '&Itemid=' . $item->id : $needle;
						?>
						<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', JRoute::_($cntlink), $author)); ?>
						<?php else: ?>
						<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
						<?php endif; ?>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_parent_category') && !empty($this->item->parent_slug)) : ?>
					<dd class="parent-category-name"><i class="icon-folder"></i>
						<?php	$title = $this->escape($this->item->parent_title);
						$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)) . '">' . $title . '</a>';?>
						<?php if ($params->get('link_parent_category') && $this->item->parent_slug) : ?>
							<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
						<?php else : ?>
							<?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
						<?php endif; ?>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_category')) : ?>
					<dd class="category-name"><i class="icon-folder-open"></i>
						<?php 	$title = $this->escape($this->item->category_title);
						$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) . '">' . $title . '</a>';?>
						<?php if ($params->get('link_category') && $this->item->catslug) : ?>
							<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
						<?php else : ?>
							<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
						<?php endif; ?>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_publish_date')) : ?>
					<dd class="published">
						<span class="icon-clock"></span>
						<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
					</dd>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ($params->get('show_create_date')) : ?>
				<dd class="create">
					<span class="icon-clock"></span>
					<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3'))); ?>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_modify_date')) : ?>
				<dd class="modified">
					<span class="icon-clock"></span>
					<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_hits')) : ?>
				<dd class="hits">
					<span class="icon-eye"></span> <?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
				</dd>
			<?php endif; ?>
			</dl>
		</div>
	<?php endif; ?>

	<?php
if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && !$this->item->paginationrelative):
	echo $this->item->pagination;
?>
	<?php endif; ?>
	<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '1')) || ($params->get('urls_position') == '1'))) : ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php // Optional teaser intro text for guests ?>
	<?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
	<?php echo $this->item->introtext; ?>
	<?php //Optional link to let them register to see the whole article. ?>
	<?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
		$link1 = JRoute::_('index.php?option=com_users&view=login');
		$link = new JUri($link1);?>
	<p class="readmore">
		<a href="<?php echo $link; ?>">
		<?php $attribs = json_decode($this->item->attribs); ?>
		<?php
		if ($attribs->alternative_readmore == null) :
			echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		elseif ($readmore = $this->item->alternative_readmore) :
			echo $readmore;
			if ($params->get('show_readmore_title', 0) != 0) :
				echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
			endif;
		elseif ($params->get('show_readmore_title', 0) == 0) :
			echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
		else :
			echo JText::_('COM_CONTENT_READ_MORE');
			echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		endif; ?>
		</a>
	</p>
	<?php endif; ?>
	<?php endif; ?>
	<?php
if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative) :
	echo $this->item->pagination;
?>
	<?php endif; ?>
	<?php echo $this->item->event->afterDisplayContent; ?> </div>

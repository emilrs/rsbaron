<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.framework');

// Create some shortcuts.
$params		= &$this->item->params;
$n			= count($this->items);
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

$isEditable = false;
if (!empty($this->items))
{
	foreach ($this->items as $article)
	{
		if ($article->params->get('access-edit'))
		{
			$isEditable = true;
			break;
		}
	}
}
?>

<?php if (empty($this->items)) { ?>

	<?php if ($this->params->get('show_no_articles', 1)) { ?>
	<p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
	<?php } ?>

<?php } else { ?>

<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm" class="form-inline">
	<?php if ($this->params->get('show_headings') || $this->params->get('filter_field') != 'hide' || $this->params->get('show_pagination_limit')) { ?>
	<fieldset class="filters btn-toolbar">
		<?php if ($this->params->get('filter_field') != 'hide') { ?>
			<div class="btn-group">
				<label class="filter-search-lbl element-invisible" for="filter-search">
					<?php echo JText::_('COM_CONTENT_'.$this->params->get('filter_field').'_FILTER_LABEL').'&#160;'; ?>
				</label>
				<input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="inputbox" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_CONTENT_FILTER_SEARCH_DESC'); ?>" placeholder="<?php echo JText::_('COM_CONTENT_'.$this->params->get('filter_field').'_FILTER_LABEL'); ?>" />
			</div>
		<?php } ?>
		<?php if ($this->params->get('show_pagination_limit')) { ?>
			<div class="btn-group pull-right">
				<label for="limit" class="element-invisible">
					<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
				</label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
		<?php } ?>

		<input type="hidden" name="filter_order" value="" />
		<input type="hidden" name="filter_order_Dir" value="" />
		<input type="hidden" name="limitstart" value="" />
		<input type="hidden" name="task" value="" />
		<div class="clearfix"></div>
	</fieldset>
	<?php } ?>

	<table class="category table table-striped table-bordered table-hover">
		<?php if ($this->params->get('show_headings')) { ?>
		<thead>
			<tr>
				<th id="categorylist_header_title">
					<?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
				</th>
				<?php if ($date = $this->params->get('list_show_date')) { ?>
					<th id="categorylist_header_date">
						<?php 
						if ($date == "created") { 
							echo JHtml::_('grid.sort', 'COM_CONTENT_'.$date.'_DATE', 'a.created', $listDirn, $listOrder); 
						} elseif ($date == "modified") { 
							echo JHtml::_('grid.sort', 'COM_CONTENT_'.$date.'_DATE', 'a.modified', $listDirn, $listOrder); 
						} elseif ($date == "published") { 
							echo JHtml::_('grid.sort', 'COM_CONTENT_'.$date.'_DATE', 'a.publish_up', $listDirn, $listOrder); 
						} 
						?>
					</th>
				<?php } ?>
				<?php if ($this->params->get('list_show_author')) { ?>
					<th id="categorylist_header_author">
						<?php echo JHtml::_('grid.sort', 'JAUTHOR', 'author', $listDirn, $listOrder); ?>
					</th>
				<?php } ?>
				<?php if ($this->params->get('list_show_hits')) { ?>
					<th id="categorylist_header_hits">
						<?php echo JHtml::_('grid.sort', 'JGLOBAL_HITS', 'a.hits', $listDirn, $listOrder); ?>
					</th>
				<?php } ?>
				<?php if ($isEditable) { ?>
					<th id="categorylist_header_edit"><?php echo JText::_('COM_CONTENT_EDIT_ITEM'); ?></th>
				<?php } ?>
			</tr>
		</thead>
		<?php } ?>
		<tbody>
			<?php foreach ($this->items as $i => $article) { ?>
				<?php if ($this->items[$i]->state == 0) { ?>
				 <tr class="system-unpublished cat-list-row<?php echo $i % 2; ?>">
				<?php } else { ?>
				<tr class="cat-list-row<?php echo $i % 2; ?>" >
				<?php } ?>
					<td headers="categorylist_header_title" class="list-title">
						<?php if (in_array($article->access, $this->user->getAuthorisedViewLevels())) { ?>
							<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid)); ?>">
								<?php echo $this->escape($article->title); ?>
							</a>
						<?php } else { ?>
							<?php
							echo $this->escape($article->title).' : ';
							$menu		= JFactory::getApplication()->getMenu();
							$active		= $menu->getActive();
							$itemId		= $active->id;
							$link = JRoute::_('index.php?option=com_users&view=login&Itemid='.$itemId);
							$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($article->slug));
							$fullURL = new JURI($link);
							$fullURL->setVar('return', base64_encode($returnURL));
							?>
							<a href="<?php echo $fullURL; ?>" class="register">
								<?php echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE'); ?>
							</a>
						<?php } ?>
						<?php if ($article->state == 0) { ?>
							<span class="list-published label label-warning">
								<?php echo JText::_('JUNPUBLISHED'); ?>
							</span>
						<?php } ?>
					</td>
					<?php if ($this->params->get('list_show_date')) { ?>
						<td headers="categorylist_header_date" class="list-date small">
							<?php
							echo JHtml::_(
								'date', $article->displayDate,
								$this->escape($this->params->get('date_format', JText::_('DATE_FORMAT_LC3')))
							); ?>
						</td>
					<?php } ?>
					<?php if ($this->params->get('list_show_author', 1)) { ?>
						<td headers="categorylist_header_author" class="list-author">
							<?php if (!empty($article->author) || !empty($article->created_by_alias)) { ?>
								<?php $author = $article->author ?>
								<?php $author = ($article->created_by_alias ? $article->created_by_alias : $author);?>

								<?php if (!empty($article->contactid ) &&  $this->params->get('link_author') == true) { ?>
									<?php echo JHtml::_(
											'link',
											JRoute::_('index.php?option=com_contact&view=contact&id='.$article->contactid),
											$author
									); ?>

								<?php } else { ?>
									<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
								<?php } ?>
							<?php } ?>
						</td>
					<?php } ?>
					<?php if ($this->params->get('list_show_hits', 1)) { ?>
						<td headers="categorylist_header_hits" class="list-hits">
							<span class="badge badge-info">
								<?php echo JText::sprintf('JGLOBAL_HITS_COUNT', $article->hits); ?>
							</span>
						</td>
					<?php } ?>
					<?php if ($isEditable) { ?>
						<td headers="categorylist_header_edit" class="list-edit">
							<?php if ($article->params->get('access-edit')) { ?>
								<?php echo JHtml::_('icon.edit', $article, $params); ?>
							<?php } ?>
						</td>
					<?php } ?>
				</tr>
			<?php } ?>
		</tbody>
	</table>
<?php } ?>

<?php // Code to add a link to submit an article. ?>
<?php if ($this->category->getParams()->get('access-create')) { ?>
	<?php echo JHtml::_('icon.create', $this->category, $this->category->params); ?>
<?php } ?>

<?php // Add pagination links ?>
<?php if (!empty($this->items)) { ?>
	<?php if (($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) { ?>
	<div class="pagination">

		<?php if ($this->params->def('show_pagination_results', 1)) { ?>
			<p class="counter pull-right">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		<?php } ?>

		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php } ?>
</form>
<?php
}
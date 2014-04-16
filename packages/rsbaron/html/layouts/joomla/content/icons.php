<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

defined('JPATH_BASE') or die;

$canEdit = $displayData['params']->get('access-edit');
?>

<?php if ($displayData['hits']==true) :
		if ($displayData['position']=='1') :
?>
		<div class="rstpl-just-print pull-right">
			<?php // Note the actions class is deprecated. Use dropdown-menu instead. ?>
			<ul class="actions">
				<?php if ($displayData['params']->get('show_print_icon')) : ?>
				<li class="print-icon"> <?php echo JHtml::_('icon.print_popup', $displayData['item'], $displayData['params']); ?> </li>
				<?php endif; ?>
				<?php if ($displayData['params']->get('show_email_icon')) : ?>
				<li class="email-icon"> <?php echo JHtml::_('icon.email', $displayData['item'], $displayData['params']); ?> </li>
				<?php endif; ?>
				<?php if ($canEdit) : ?>
				<li class="edit-icon"> <?php echo JHtml::_('icon.edit', $displayData['item'], $displayData['params']); ?> </li>
				<?php endif; ?>
			</ul>
		</div>
		<?php else: ?>
			
				<dl class="article-info muted">
					<?php if (empty($displayData['print'])) : ?>
						<?php if ($canEdit || $displayData['params']->get('show_print_icon') || $displayData['params']->get('show_email_icon')) : ?>
							<?php if ($displayData['params']->get('show_print_icon')) : ?>
							<dd class="rstpl-print-article"> <span class="print-icon"> <?php echo JHtml::_('icon.print_popup', $displayData['item'], $displayData['params']); ?></span> </dd>
							<?php endif; ?>
							<?php if ($displayData['params']->get('show_email_icon')) : ?>
							<dd class="rstpl-print-article"> <span class="email-icon"> <?php echo JHtml::_('icon.email', $displayData['item'], $displayData['params']); ?></span> </dd>
							<?php endif; ?>
							<?php if ($canEdit) : ?>
							<dd class="rstpl-print-article"> <span class="edit-icon"> <?php echo JHtml::_('icon.edit', $displayData['item'], $displayData['params']); ?></span> </dd>
							<?php endif; ?>
						<?php endif; ?>
					<?php endif;?>
				</dl>
		<?php endif;?>
<?php else :?>
	<div id="icons">
		<?php if (empty($displayData['print'])) : ?>

			<?php if ($canEdit || $displayData['params']->get('show_print_icon') || $displayData['params']->get('show_email_icon')) : ?>
				<div class="btn-group pull-right">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#"> <span class="icon-cog"></span> <span class="caret"></span> </a>
					<?php // Note the actions class is deprecated. Use dropdown-menu instead. ?>
					<ul class="dropdown-menu">
						<?php if ($displayData['params']->get('show_print_icon')) : ?>
							<li class="print-icon"> <?php echo JHtml::_('icon.print_popup', $displayData['item'], $displayData['params']); ?> </li>
						<?php endif; ?>
						<?php if ($displayData['params']->get('show_email_icon')) : ?>
							<li class="email-icon"> <?php echo JHtml::_('icon.email', $displayData['item'], $displayData['params']); ?> </li>
						<?php endif; ?>
						<?php if ($canEdit) : ?>
							<li class="edit-icon"> <?php echo JHtml::_('icon.edit', $displayData['item'], $displayData['params']); ?> </li>
						<?php endif; ?>
					</ul>
				</div>
			<?php endif; ?>

		<?php else : ?>

			<div class="pull-right">
				<?php echo JHtml::_('icon.print_screen', $displayData['item'], $displayData['params']); ?>
			</div>

		<?php endif; ?>
	</div>
<?php endif;
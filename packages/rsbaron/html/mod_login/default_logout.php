<?php
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-vertical">
<?php if ($params->get('greeting')) : ?>
	<div class="login-greeting">
		<div class="rstpl-login-greeting">
		<?php if ($params->get('name') == 0) : {
			echo JText::sprintf('MOD_LOGIN_HINAME', '<span class="name">'.htmlspecialchars($user->get('name')).'</span>');
		} else : {
			echo JText::sprintf('MOD_LOGIN_HINAME', '<span class="name">'.htmlspecialchars($user->get('username')).'</span>');
		} endif; ?>
		</div>
	</div>
<?php endif; ?>
	<div class="logout-button">
		<div class="row-fluid">
			<div class="span12 textalign-center">
				<input type="submit" name="Submit" class="btn btn-small btn-inverse rstpl-box-button" value="<?php echo JText::_('JLOGOUT'); ?>" />
				<input type="hidden" name="option" value="com_users" />
				<input type="hidden" name="task" value="user.logout" />
				<input type="hidden" name="return" value="<?php echo $return; ?>" />
				<?php echo JHtml::_('form.token'); ?>
			</div>
		</div>
	</div>
</form>
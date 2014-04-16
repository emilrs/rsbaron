<?php
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;
?>
<div class="rstpl-search<?php echo $moduleclass_sfx ?>">
    <form action="<?php echo JRoute::_('index.php');?>" method="post" class="form-inline navbar-search">
		<?php
			$output = '';
			$class  = 'inputbox'.$moduleclass_sfx;
			if (!$button) {
				$class .= ' search-query';
			}
			$label  = '<label for="mod-search-searchword" class="element-invisible">' . $label . '</label>';
			$input  = '<input name="searchword" id="mod-search-searchword" maxlength="' . $maxlength . '"  class="'.$class.'" type="text" size="' . $width . '" value="' . $text . '"  onblur="if (this.value==\'\') this.value=\'' . $text . '\';" onfocus="if (this.value==\'' . $text . '\') this.value=\'\';" />';

			if ($button) {
				$output = $label.$input;
			} else {
				$output = $label.'<div class="input-append">'.$input.'<span class="icon-search add-on"></span></div>';
			}
			
			if ($button) {
				if ($imagebutton) {
					$btn_output = ' <input type="image" value="' . $button_text . '" class="button' . $moduleclass_sfx.'" src="' . $img . '" onclick="this.form.searchword.focus();"/>';
				} else {
					$btn_output = ' <button class="button' . $moduleclass_sfx . ' btn btn-primary" onclick="this.form.searchword.focus();">' . $button_text . '</button>';
				}

				switch ($button_pos) {
					case 'top' :
						$output = $btn_output . '<br />' . $output;
						break;

					case 'bottom' :
						$output .= '<br />' . $btn_output;
						break;

					case 'right' :
						$output .= $btn_output;
						break;

					case 'left' :
					default :
						$output = $btn_output . $output;
						break;
				}
			}

			echo $output;
		?>

    	<input type="hidden" name="task" value="search" />
    	<input type="hidden" name="option" value="com_search" />
    	<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
    </form>
</div>
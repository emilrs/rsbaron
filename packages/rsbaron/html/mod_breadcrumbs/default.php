<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

defined('_JEXEC') or die;
$jversion = new JVersion();
$is30 = $jversion->isCompatible('3.0');
$doc = JFactory::getDocument();
if($is30){
	JHtml::_('bootstrap.tooltip');

	?>

	<ul class="breadcrumb<?php echo $moduleclass_sfx; ?>">
		<?php
		if ($params->get('showHere', 1))
		{
			echo '<li class="active"><span class="icon icon-location hasTooltip" title="' . JText::_('MOD_BREADCRUMBS_HERE') . '"></span></li>';
		}

		// Get rid of duplicated entries on trail including home page when using multilanguage
		for ($i = 0; $i < $count; $i++)
		{
			if ($i == 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link == $list[$i - 1]->link)
			{
				unset($list[$i]);
			}
		}

		// Find last and penultimate items in breadcrumbs list
		end($list);
		$last_item_key = key($list);
		prev($list);
		$penult_item_key = key($list);

		// Generate the trail
		foreach ($list as $key => $item) :
		// Make a link if not the last item in the breadcrumbs
		$show_last = $params->get('showLast', 1);
		if ($key != $last_item_key)
		{
			// Render all but last item - along with separator
			echo '<li>';
			if (!empty($item->link))
			{
				echo '<a href="' . $item->link . '" class="pathway">' . $item->name . '</a>';
			}
			else
			{
				echo '<span>' . $item->name . '</span>';
			}

			if (($key != $penult_item_key) || $show_last)
			{
				echo '<div class="divider icon icon-play3"></div>';
			}

			echo '</li>';
		}
		elseif ($show_last)
		{
			// Render last item if reqd.
			echo '<li>';
			echo '<span>' . $item->name . '</span>';
			echo '</li>';
		}
		endforeach; ?>
	</ul>
<?php } else { ?>
	<ul class="breadcrumb<?php echo $moduleclass_sfx; ?>">
	<?php if ($params->get('showHere', 1))
		{
			echo '<li class="active"><span class="showHere">' .JText::_('MOD_BREADCRUMBS_HERE').'</span></li>';
		}

		// Get rid of duplicated entries on trail including home page when using multilanguage
		for ($i = 0; $i < $count; $i ++)
		{
			if ($i == 1 && !empty($list[$i]->link) && !empty($list[$i-1]->link) && $list[$i]->link == $list[$i-1]->link)
			{
				unset($list[$i]);
			}
		}

		// Find last and penultimate items in breadcrumbs list
		end($list);
		$last_item_key = key($list);
		prev($list);
		$penult_item_key = key($list);

		// Generate the trail
		foreach ($list as $key=>$item) :
		// Make a link if not the last item in the breadcrumbs
		$show_last = $params->get('showLast', 1);
		if ($key != $last_item_key)
		{	
			echo '<li>';
			// Render all but last item - along with separator
			if (!empty($item->link))
			{
				echo '<a href="' . $item->link . '" class="pathway">' . $item->name . '</a>';
			}
			else
			{
				echo '<span>' . $item->name . '</span>';
			}

			if (($key != $penult_item_key) || $show_last)
			{
				echo '<div class="divider icon icon-play3"></div>';
			}
			echo '</li>';
		}
		elseif ($show_last)
		{
			// Render last item if reqd.
			echo '<li>';
			echo '<span>' . $item->name . '</span>';
			echo '</li>';
		}
		endforeach; ?>
	</ul>
<?php }
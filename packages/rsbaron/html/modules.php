<?php
 /**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

defined('_JEXEC') or die;

function modChrome_no($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo $module->content;
	}
}

function modChrome_well($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo '<div class="well ' . htmlspecialchars($params->get('moduleclass_sfx')) . '">';
		if ($module->showtitle)
		{
			echo '<h3 class="page-header">' . $module->title . '</h3>';
		}
		echo $module->content;
		echo '</div>';
	}
}

function modChrome_rstop($module, &$params, &$attribs)
{
	if ($module->content)
	{
		if($params->get('moduleclass_sfx')!='') echo '<div class="' . htmlspecialchars($params->get('moduleclass_sfx')) . '">';
		if ($module->showtitle)
		{
			echo '<h3 class="rstpl-title-color rstpl-h3-top">' . $module->title . '</h3>';
		}
		echo '<div class="rstpl-module">' . $module->content . '</div>';
		if($params->get('moduleclass_sfx')!='') echo '</div>';
	}
}

function modChrome_rscontent($module, &$params, &$attribs)
{
	if ($module->content)
	{
		if($params->get('moduleclass_sfx')!='') echo '<div class="' . htmlspecialchars($params->get('moduleclass_sfx')) . '">';
		if ($module->showtitle)
		{
			echo '<h3 class="rstpl-title-color m-bot-small">' . $module->title . '</h3>';
		}
		echo '<div class="rstpl-module">' . $module->content . '</div>';
		if($params->get('moduleclass_sfx')!='') echo '</div>';
		echo '<div class="clearfix"></div>';
	}
}

function modChrome_rsright($module, &$params, &$attribs)
{
	if ($module->content)
	{
		if($params->get('moduleclass_sfx')!='') echo '<div class="' . htmlspecialchars($params->get('moduleclass_sfx')) . '">';
		
		echo '<div class="rstpl-right-box m-bot-large">';
		if ($module->showtitle)
		{
			echo '<h5 class="rstpl-title rstpl-title-color m-bot-small">' . $module->title . '</h5>';
		}
		echo $module->content;
		echo '</div>';
		if($params->get('moduleclass_sfx')!='') echo '</div>';
		echo '<div class="clearfix"></div>';
	}
}

function modChrome_rsinside($module, &$params, &$attribs)
{
	if ($module->content)
	{
		if($params->get('moduleclass_sfx')!='') echo '<div class="' . htmlspecialchars($params->get('moduleclass_sfx')) . '">';
		
		echo '<div class="rstpl-module-box m-large">';
			if ($module->showtitle) 
				echo '<h3 class="rstpl-title rstpl-title-color m-bot-large">' . $module->title . '</h3>';

			echo $module->content;
		echo '</div>';

		if($params->get('moduleclass_sfx')!='') echo '</div>';
	}
}

function modChrome_rsfooter($module, &$params, &$attribs)
{
	if ($module->content)
	{
		if($params->get('moduleclass_sfx')!='') echo '<div class="' . htmlspecialchars($params->get('moduleclass_sfx')) . '">';

		echo '<div class="rstpl-module-box-footer">';
			if ($module->showtitle) 
				echo '<h3 class="rstpl-title rstpl-title-color m-bot-small">' . $module->title . '</h3>';

			echo $module->content;
		echo '</div>';

		if($params->get('moduleclass_sfx')!='') echo '</div>';
	}
}
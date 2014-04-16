<?php
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('JPATH_PLATFORM') or die;

class JFormFieldDefinedPositions extends JFormField
{
	protected $type = 'positionChanger';
	public $is30;
	
	public function __construct() {
		$jversion = new JVersion();
		$this->is30 = $jversion->isCompatible('3.0');
	}

	protected function getInput()
	{
		$document = JFactory::getDocument();
		$root = JURI::root(true);
		$rootAbsolute = JURI::root(false);

		if (!$this->is30) {
			$document->addScript($root.'/templates/rsbaron/js/jquery/jquery.js');
			$document->addScript($root.'/templates/rsbaron/js/jquery/jquery-noconflict.js');
		}
		$document->addScript($root.'/templates/rsbaron/classes/positions/jquery-ui.js');
		$document->addScript($root.'/templates/rsbaron/classes/positions/rs-positions.js');
		$document->addStyleSheet($root.'/templates/rsbaron/classes/positions/rs-positions.css');

		if ($this->value!='')
			$positions = explode(',',$this->value);

		// reset array values
		$positions = array_fill_keys($positions, '');

		// set the positions that have multiple variants 
		$positions['top'] = array('a','b','c');
		$positions['top-fixed'] = array('a','b','c','d');
		$positions['top-fluid'] = array('a','b','c','d');
		$positions['featured'] = array('a','b','c');
		$positions['middle-fluid'] = array('a','b','c','d');
		$positions['middle-fixed'] = array('a','b','c','d');
		$positions['bottom-fluid'] = array('a','b','c','d');
		$positions['bottom-fixed'] = array('a','b','c','d');
		$positions['footer-fluid'] = array('a','b','c','d');
		$positions['footer-fixed'] = array('a','b','c','d');

		$html = '
		<div class="rs-reset"><input type="button" class="btn btn-primary" value="'.JText::_('TPL_RSBARON_TEMPLATE_POSITIONS_CONFIRM_BUTTON').'" onclick="if(confirm(\''.JText::_('TPL_RSBARON_TEMPLATE_POSITIONS_CONFIRM').'\')) return rsResetPositions()"/></div>
		<div style="clear:both"></div>
		<div class="rs_inner-sortable">
				<ul id="rs_sortable" class="ui-sortable">';
		
		if (isset($positions) && count($positions) > 0) {
			foreach($positions as $pos => $variants) {
				$pos  = trim($pos);
				$pos  = $this->escape($pos);
				$span = 12/count($variants);
				$html .= '<li class="ui-state-default '.$pos.'" data_item="'.$pos.'">';
				if ($pos == 'all-content') 
					$html .= '<div>column-left</div><div><div>inner-before-content</div><div>content</div><div>inner-after-content</div></div><div>column-right</div>';
				elseif(!empty($variants))
					$html .= '<div class="span'.$span.'">'.$pos.'-'.implode('</div><div class="span'.$span.'">'.$pos.'-', $variants).'</div>';
				else 
					$html .= '<div>'.$pos.'</div>';
				$html .'</li>';
			}
		}

		$html .= '</ul>
		</div>
		<input id="jform_params_definedPositions" type="hidden" value="'.$this->value.'" name="jform[params][definedPositions]">';
		return $html;
	}
	
	public function escape($string) {
		$escaped = htmlentities($string, ENT_COMPAT, 'utf-8');
		return $escaped;
	}
	
}

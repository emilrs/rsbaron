<?php

defined('JPATH_PLATFORM') or die;

class JFormFieldSampledatainstaller extends JFormField
{
	protected $type = 'sampledatainstaller';
	public $is30;
	
	public function __construct() {
		$jversion = new JVersion();
		$this->is30 = $jversion->isCompatible('3.0');
	}

	protected function getInput()
	{
		$document = JFactory::getDocument();
		if (!$this->is30) {
			$document->addScript(JURI::root(true).'/templates/rsbaron/js/jquery/jquery.js');
		}
		$document->addScript(JURI::root(true).'/templates/rsbaron/classes/installer/installer.js');
		return '<button type="button" class="btn btn-primary" onclick="installSampleData(\'normal\')">'.JText::_('TPL_INSTALL_SAMPLE_DATA_BUTTON').'</button>
		<div id="install-response" style="padding-top:10px"></div>
		<div id="data-loading" style="display:none; margin-top:10px"><img src="'.JURI::root(true).'/templates/rsbaron/images/ajax-loader.gif" alt=""/></div>';
	}
}

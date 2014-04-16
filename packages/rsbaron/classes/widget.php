<?php
 /**
* @version 1.0.0
* @package RSBaron! 1.0.0
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;

class RSTemplateWidget
{
	protected $name;
	protected $path;
	protected $params;
	
	public function __construct($widgetName, $templateParams) {
		$this->name 	= $widgetName;
		$this->path 	= RSTEMPLATE_PATH.'/widgets/'.$widgetName;
		$this->params 	= $templateParams;
	}
	
	public function render() {
		$entryPoint = $this->path.'/'.$this->name.'.php';
		if (file_exists($entryPoint)) {
			include $entryPoint;
		}
	}
	
	protected function getLayout($layout) {
		$layoutPath = $this->path.'/tmpl/'.$this->sanitize($layout).'.php';
		if (file_exists($layoutPath)) {
			return $layoutPath;
		}
	}
	
	protected function sanitize($string) {
		return preg_replace('/[^A-Z0-9_]/i', '', $string);
	}
	
	protected function escape($string) {
		return htmlentities($string, ENT_COMPAT, 'utf-8');
	}
}
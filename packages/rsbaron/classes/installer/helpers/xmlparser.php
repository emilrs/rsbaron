<?php

defined('_JEXEC') or die('Restricted access');

class XMLParser
{
	protected $fileName;
	protected $path;
	protected $xmlData;
	protected $tableData;
	
	public function __construct() {
		$this->buildFileName();
		$this->buildPath();
		$this->loadXML();
	}
	
	protected function checkVersion() {
		$jversion = new JVersion();
		$is30 = $jversion->isCompatible('3.0');
		return $is30;
	}
	
	protected function buildFileName() {
		$className 		= get_class($this);
		$this->fileName = strtolower(substr($className, strlen('XMLParser')));
	}
	
	protected function buildPath() {
		$this->path = dirname(__FILE__).'/../data/';
	}
	
	protected function loadXML() {
		$this->xmlData = simplexml_load_file($this->path.$this->fileName.'.xml');
	}
	
	public static function getInstance($childName) {		
		static $instances = array();
	
		$childName = strtolower($childName);
		if (!isset($instances[$childName])) {
			$className = 'XMLParser'.$childName;
			
			if (!class_exists($className)) {
				require_once dirname(__FILE__).'/parsers/'.$childName.'.php';
			}
			
			$instances[$childName] = new $className();
		}
		
		return $instances[$childName];
	}
	
	public function getItems() {
		$data = array();
		foreach ($this->xmlData->item as $item) {
			$data[] = $item;
		}
		return $data;
	}
	
	protected function prepareData($item) {
		$data = array();
		foreach ($item as $key=>$val) {
			if ($key!='child') $data[$key] = (string) $val;
		}
		return $data;
	}

	protected function getItemChildren($item) {
		$children = array();
		$i = 0;
		if ( !empty($item->child) ) {
			foreach ($item->child as $key=>$val) {
				$j = 0; // for the innerchild innerchild
				foreach ($val as $k=>$v) {
					if ($k!='innerchild')	$children[$i][$k] = (string) $v;
					else {
						$children[$i][$k][$j] = $v;
						$j++;
					}
				}
				$i++;
			}
		}
		return $children;
	}

	protected function getItemInnerChildren($item) {
		$children = array();
		$i = 0;
		if(isset($item['innerchild'])) {
			foreach ($item['innerchild'] as $key=>$val) {
				foreach ($val as $k=>$v){
					$children[$i][$k] = (string) $v;
				}
				$i++;
			}
		}
		return $children;
	}
	
	protected function setDefaultValue($item,$key,$value,$unset = 0) {
		if(isset($item[$key])){
			return $item[$key];
			if ($unset) unset($item[$key]);
		}
		else return $value;
	}
	
	public static function getTemplateName() {
		$dir_name = dirname(__FILE__);
		$pattern = '#templates[/?\\\](.*)[/?\\\]classes#';
		preg_match($pattern,$dir_name,$template);
		$template = $template[1];
		return $template;
	}
	
	/* 	
		com_rsmediagallery
		mod_rsmediagallery_responsive_slideshow 
	*/
	public static function checkIfInstalled($extension) {
		$table = JTable::getInstance('Extension', 'JTable');
		$table->load(array('element' => $extension));
		if ($table->extension_id!=null) return true;
		else return false;
	}
}
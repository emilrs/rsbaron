<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.filesystem.folder');

class XMLSorter 
{
	protected $path;
	
	public function __construct() {
		$this->buildPath();
	}
	
	protected function buildPath() {
		$this->path = dirname(__FILE__).'/../data/';
	}
	
	public function getFiles() {
		$files = JFolder::files($this->path, '\.xml');
		
		$sorted = array();
		foreach ($files as $file) {
			$order = $this->getOrder($this->readFile($this->path.$file));
			$sorted[$order] = substr($file, 0, -4);
		}
		
		ksort($sorted);
		
		return $sorted;
	}
	
	protected function readFile($file) {
		return file_get_contents($file);
	}
	
	protected function getOrder($contents) {
		$pattern = '#<order>([0-9]+)<\/order>#';
		if (preg_match($pattern, $contents, $match)) {
			return $match[1];
		}
	}
}
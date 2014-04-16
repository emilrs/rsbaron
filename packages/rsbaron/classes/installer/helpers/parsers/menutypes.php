<?php
defined('_JEXEC') or die('Restricted access');

class XMLParserMenuTypes extends XMLParser 
{
	protected function getTable() {
		// JTableCategories
		$is30 = $this->checkVersion();
		if (!$is30) {
			JTable::addIncludePath(JPATH_SITE.'/libraries/joomla/database/table/');
		}
		else {
			JTable::addIncludePath(JPATH_SITE.'/libraries/legacy/table/menu/');
		}
		return JTable::getInstance('MenuType','JTable');
	}
	
	public function saveItem($item) {
		$item 				= $this->prepareData($item);
		
		$table				= $this->getTable();
		$table->bind($item);
		$table->id 			= null;
		
		if ($table->check()) {
			$table->store();
			$this->tableData[] = $table;
		}
	}
	
	
	public function getCategoryId($alias) {
		static $cache = array();
		
		if (!isset($cache[$alias])) {
			foreach ($this->tableData as $position => $table) {
				if ($table->alias == $alias) {
					$cache[$alias] = $position;
					break;
				}
			}
		}
		return $this->tableData[$cache[$alias]]->id;
	}
}
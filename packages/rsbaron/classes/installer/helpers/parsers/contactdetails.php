<?php
defined('_JEXEC') or die('Restricted access');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_contact/tables/');

class XMLParserContactDetails extends XMLParser 
{
	protected function getTable() {
		// JTableContact
		return JTable::getInstance('contact','ContactTable');
	}
	
	public function saveItem($item) {
		$item 			= $this->prepareData($item);
		$extension		= $this->setDefaultValue($item,'extension','com_content');
		if($item['cat_id']!='') {
			$catid 			= XMLParser::getInstance('Categories')->getCategoryId($item['cat_id'],$extension);
		}
		else $catid = 4;

		$table				= $this->getTable();
		$table->bind($item);            
		$table->id 			= null;
		$table->default_con	= $this->setDefaultValue($item,'default_con',0);
		$table->published	= 1;
		$table->user_id		= JFactory::getUser()->id;
		$table->catid		= $catid;
		$table->access		= 1;
		$table->language	= '*';
		$table->created_by	= JFactory::getUser()->id;
		$table->featured	= $this->setDefaultValue($item,'featured',0);

		if ($table->check()) {
			$table->store();
			$this->tableData[] = $table;
		}
	}
	
	
	public function getContactId($alias) {
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
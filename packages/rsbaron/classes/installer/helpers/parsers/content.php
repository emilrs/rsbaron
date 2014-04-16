<?php
defined('_JEXEC') or die('Restricted access');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_content/tables/');

class XMLParserContent extends XMLParser 
{
	protected function getTable() {
		// JTableCategories
		return JTable::getInstance('Content', 'JTable');
	}
	
	public function saveItem($item) {
		$item 			= $this->prepareData($item);
		$extension		= $this->setDefaultValue($item,'extension','com_content');
		$featured 		= $this->setDefaultValue($item,'featured',0);
		$catid 			= XMLParser::getInstance('Categories')->getCategoryId($item['alias_category'],$extension);

		$table				 = $this->getTable();
		$table->bind($item);
		$table->id 			 = null;
		$table->catid		 = $catid;
		$table->featured	 = $featured;
		$table->state		 = 1;
		$table->language	 = '*';

		if ($table->check()) {
			$table->store();
			$this->tableData[] = $table;

			if(isset($item['frontpage_ordering'])) {
				$this->addToFrontpage(array(
					'content_id' => $table->id,
					'ordering'	 => (int) $item['frontpage_ordering']
				));
			}
		}
	}
	
	private function addToFrontpage($data) {
		$db    =  JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->clear()
			->insert('#__content_frontpage')
			->columns(array($db->quoteName('content_id'), $db->quoteName('ordering')))
			->values($data['content_id'] . ",".$data['ordering']);
		$db->setQuery($query);
		$db->execute();
	}
	
	public function getContentId($alias) {
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
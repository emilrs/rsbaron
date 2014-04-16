<?php
defined('_JEXEC') or die('Restricted access');

class XMLParserCategories extends XMLParser 
{
	protected function getTable() {
		// JTableCategories
		JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_categories/tables/');
		return JTable::getInstance('Category', 'CategoriesTable');
	}
	public function saveItem($item) {
		$item 		= $this->prepareData($item);
		$parent_id 	= 1;

		if (isset($item['parent_id'])) {
			$parent_id = $this->getCategoryId($item['parent_id'],$item['extension']);
		}
		
		$table					= $this->getTable();
		$table->bind($item);
		$table->id 				= $this->getId($item['extension'], $item['alias']);
		$table->published 		= 1;
		$table->access			= 1;
		$table->created_user_id	= JFactory::getUser()->id;
		$table->language		= '*';
		$table->setLocation($parent_id, 'last-child');

		if ($table->check()) {
			$table->store();
			$table->rebuildPath($table->id);
			$table->rebuild($table->id, $table->lft, $table->level, $table->path);
			$this->tableData[] = $table;
		}
	}
	
	public function getId($extension, $alias) {
		$db 	= JFactory::getDBO();
		$query 	= $db->getQuery(true);

		if (($extension == 'com_content' && $alias == 'uncategorised') || ($extension == 'com_contact' && $alias == 'uncategorised')) {
			$query->select('id')->from($db->qn('#__categories'))->where($db->qn('extension').' = '. $db->q($extension))->where($db->qn('alias').' = '.$db->q($alias));
			$db->setQuery($query);

			if ($id = (int) $db->loadResult()){
				return $id;
			}
		} 

		return null;
	}

	public function getCategoryId($alias, $extension = 'com_content') {
		static $cache = array();

		if (!isset($cache[$extension.'.'.$alias])) {
			foreach ($this->tableData as $position => $table) {
				if ($table->alias == $alias && $table->extension == $extension) {
					$cache[$extension.'.'.$alias] = $position;
					break;
				}
			}
		}

		return $this->tableData[$cache[$extension.'.'.$alias]]->id;
	}
}
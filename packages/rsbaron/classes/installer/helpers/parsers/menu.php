<?php
defined('_JEXEC') or die('Restricted access');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_menus/tables/');

class XMLParserMenu extends XMLParser 
{
	protected function getTable() {
		// JTableCategories
		return JTable::getInstance('menu','MenusTable');
	}

	public function saveItem($item) {
		$children 		= $this->getItemChildren($item);
		$item 			= $this->prepareData($item);
		$component_id	= $this->getComponentID($this->setDefaultValue($item,'component_id','com_content'));

		$extension		= $this->setDefaultValue($item, 'extension', 'com_content', 1);
		$link 			= $item['link'];
		$ref 			= $item['ref'];
		unset($item['ref']);

		if ($this->checkIdLink($item['link'])) {
			$linkData 	= $this->checkIdLink($item['link']);
			$link 	= $this->buildNewLink($linkData,$link,$extension);
		}

		$table					= $this->getTable();
		$table->bind($item);
		$table->id 				= null;
		$table->link 			= $link;
		$table->published		= $this->setDefaultValue($item, 'published', 1);;
		$table->component_id	= $component_id;
		$table->access			= 1;
		$table->level			= $this->setDefaultValue($item, 'level', 0);
		$table->home			= $this->setDefaultValue($item, 'home', 0);
		$table->client_id		= $this->setDefaultValue($item, 'client_id', 0);
		$table->language		= '*';
		$table->params			= $this->parseParams($item);
		$table->setLocation(1, 'last-child');

		if ($table->check()) {
			$existingId = $this->checkIfExists($table,1);

			if (count($existingId)==0) {
				$table->store();
				$table->rebuildPath($table->id);
				$table->rebuild($table->id, $table->lft, $table->level, $table->path);
			}
			else {
				$table->id = $existingId[0]->id;
			}

			$this->tableData[$ref] = $table;
			if ($children) 
			{
				foreach ($children as $child)
				{
					if ($child['type'] == 'alias') 
						$child['alias'] = JFactory::getDate()->format('Y-m-d-H-i-s');

					$child_children = $this->getItemInnerChildren($child);
					$component_id 	= $this->getComponentID($this->setDefaultValue($child,'component_id','com_content'));

					$extension		= $this->setDefaultValue($child, 'extension', 'com_content', 1);
					$link 			= $child['link'];
					$ref 			= $child['ref'];
					unset($child['ref']);

					if ($this->checkIdLink($child['link'])) {
						$linkData 	= $this->checkIdLink($child['link']);
						$link 	= $this->buildNewLink($linkData,$link,$extension);
					}
					$table_child				= $this->getTable();
					$table_child->bind($child);
					$table_child->id 			= null;
					$table_child->link 			= $link;
					$table_child->published		= $this->setDefaultValue($child,'published',1);
					$table_child->component_id	= $component_id;
					$table_child->access		= 1;
					$table_child->level			= $this->setDefaultValue($child,'level',0);
					$table_child->home			= $this->setDefaultValue($child,'home',0);
					$table_child->client_id		= $this->setDefaultValue($child,'client_id',0);
					$table_child->language		= '*';
					$table_child->params		= $this->parseParams($child);
					$table_child->setLocation($table->id, 'last-child');

					if ($table_child->check()) {
						$existingId = $this->checkIfExists($table_child,$table->id);
						if (count($existingId)==0) {
							$table_child->store();
							$table_child->rebuildPath($table_child->id);
							$table_child->rebuild($table_child->id, $table_child->lft, $table_child->level, $table_child->path);
						}
						else {
							$table_child->id = $existingId[0]->id;
						}
							$this->tableData[$ref] = $table_child;
						if ($child_children) 
						{
							foreach ($child_children as $ch_child) 
							{
								if ($ch_child['type'] == 'alias') 
									$ch_child['alias'] = JFactory::getDate()->format('Y-m-d-H-i-s');

								$component_id 	= $this->getComponentID($this->setDefaultValue($ch_child,'component_id','com_content'));
								$extension		= $this->setDefaultValue($ch_child, 'extension', 'com_content', 1);
								$link 			= $ch_child['link'];
								$ref 			= $ch_child['ref'];
								unset($ch_child['ref']);

								if ($this->checkIdLink($ch_child['link'])) {
									$linkData 	= $this->checkIdLink($ch_child['link']);
									$link 	= $this->buildNewLink($linkData,$link,$extension);
								}

								$table_ch_child					= $this->getTable();
								$table_ch_child->bind($ch_child);
								$table_ch_child->id 			= null;
								$table_ch_child->link 			= $link;
								$table_ch_child->published		= $this->setDefaultValue($ch_child,'published',1);
								$table_ch_child->component_id	= $component_id;
								$table_ch_child->access		= 1;
								$table_ch_child->level			= $this->setDefaultValue($ch_child,'level',0);
								$table_ch_child->home			= $this->setDefaultValue($ch_child,'home',0);
								$table_ch_child->client_id		= $this->setDefaultValue($ch_child,'client_id',0);
								$table_ch_child->language		= '*';
								$table_ch_child->params			= $this->parseParams($ch_child);	
								$table_ch_child->setLocation($table_child->id, 'last-child');
								
								if ($table_ch_child->check()) {
									$existingId = $this->checkIfExists($table_ch_child,$table->id);
									if (count($existingId)==0) {
										$table_ch_child->store();
										$table_ch_child->rebuildPath($table_ch_child->id);
										$table_ch_child->rebuild($table_ch_child->id, $table_ch_child->lft, $table_ch_child->level, $table_ch_child->path);
									}
									else {
										$table_ch_child->id = $existingId[0]->id;
									}
									$this->tableData[$ref] = $table_ch_child;
								}
							}
						}
					}
				}
			}
		}
	}

	private function parseParams($item) {
		$params = $item['params'];
		$data 	= json_decode($params);

		// for Menu Item Alias: replace "aliasoptions" param with the corresponding "idmenuX"
		if($item['type'] == 'alias') {
			$data->aliasoptions = $this->getMenuId($data->aliasoptions);
		}

		if(isset($data->featured_categories) && $data->featured_categories!='') {
			if (is_array($data->featured_categories)) {
				foreach($data->featured_categories as &$cat) {
					if($cat!=''){
						$infoCat = $this->getAliasExtension($cat);
						$cat = XMLParser::getInstance('Categories')->getCategoryId($infoCat->alias,$infoCat->extension);
					}
				} 
			}
			else {
				$infoCat = $this->getAliasExtension($data->featured_categories);
				$data->featured_categories = XMLParser::getInstance('Categories')->getCategoryId($infoCat->alias,$infoCat->extension);
			}
		}

		$data = json_encode($data);
		return $data;
	}

	private function getAliasExtension($cat) {
		$data = new stdClass;
		$expl = explode('|',$cat);
		$data->alias = $expl[0];
		$data->extension = ($expl[1]==''?'com_content':$expl[1]);
		return $data;
	}

	protected function checkIfExists($tableLoaded,$parent_id) {
		// client_id parent_id alias language
		$client_id 	= $tableLoaded->client_id;
		$alias		= $tableLoaded->alias;
		$language	= $tableLoaded->language;

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		 
		$query->select(array('id'));
		$query->from('#__menu');
		$query->where("client_id = '".$client_id."' AND parent_id = '".$parent_id."' AND alias = '".$alias."' AND language = '".$language."'");

		$db->setQuery($query);
		$results = $db->loadObjectList(); 

		return $results;
	}

	protected function buildNewLink($linkData,$link,$extension = null) {
		$type 	= $linkData->type;
		$alias	= $linkData->alias;
		switch ($type) {
			case 'category':
				$id 	= XMLParser::getInstance('Categories')->getCategoryId($alias,$extension);
			break;
			case 'contact':
				$id 	= XMLParser::getInstance('ContactDetails')->getContactId($alias);
			break;
			case 'article':
				$id 	= XMLParser::getInstance('Content')->getContentId($alias);
			break;
		}
		$link = str_replace('&id='.$alias,'&id='.$id,$link);
		return $link;
	}
	
	protected function checkIdLink($link) {
		$pattern 	= '#view=([a-z0-9\-]+)\&?#';
		$exceptions = array('article','category','contact');
		$returned 	= new stdClass;
		
		if (preg_match($pattern, $link, $match)) {
			$lookFor = $match[1];
			if (in_array($lookFor,$exceptions)) {
				$extractAlias 	= stristr($link,'&id=');
				$extractAlias	= explode('=',$extractAlias);
				$alias 		= array_pop($extractAlias);
				if ($alias!='0') {
					$returned->type 	= $lookFor;
					$returned->alias 	= $alias;
					return $returned;
				}
				else return false;
			}
			else return false;
		}
		else return false;
	}

	protected function getComponentId($alias) {
		if(isset(JComponentHelper::getComponent($alias)->id)) {
			return JComponentHelper::getComponent($alias)->id;
		}
		else return JComponentHelper::getComponent('com_content')->id;
	}	

	public function getMenuId($ref) {
		return $this->tableData[$ref]->id;
	}
}
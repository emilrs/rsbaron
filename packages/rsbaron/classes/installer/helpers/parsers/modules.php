<?php
defined('_JEXEC') or die('Restricted access');

class XMLParserModules extends XMLParser 
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
		return JTable::getInstance('Module', 'JTable');
	}
	
	public function saveItem($item) {
		$item 		= $this->prepareData($item);
		$setMenu	= false;
		if (isset($item['menuid'])) {
			$setMenu 	= json_decode($item['menuid']);
			unset($item['menuid']);
		}
		
		$table			= $this->getTable();
		$table->bind($item);
		$table->id 				= null;
		$table->access			= $this->setDefaultValue($item,'access',1);
		$table->showtitle		= $this->setDefaultValue($item,'showtitle',1);
		$table->ordering		= $this->setDefaultValue($item,'ordering',1);
		$table->published		= 1;
		$table->params			= $this->parseParams($item['params']);	
		$table->language		= '*';
		
		
		if ($table->check()) {
			$table->store();
			$this->tableData[] = $table;
			
			if ($setMenu) {
				foreach($setMenu->ids as $sMenu) {
					$data_ref = $this->checkMenuSign($sMenu);
					$ref 	  = $data_ref->value;
					$sign	  = $data_ref->sign;
					$menuid   = XMLParser::getInstance('Menu')->getMenuId($ref);
					
					$this->addToModulesMenu(array(
						'moduleid' 	=> $table->id,
						'menuid'	=> (int) $menuid,
						'sign'		=> $sign
					));
				}
			}
			else {
				$this->addToModulesMenu(array(
					'moduleid' 	=> $table->id,
					'menuid'	=> 0,
					'sign'		=> ''
				));
			}
		}
		
	}
	
	private function parseParams($params) {
		$data = json_decode($params);
		if(isset($data->catid) && $data->catid!='') {
			if (is_array($data->catid)) {
				foreach($data->catid as &$cat) {
					if($cat!=''){
						$infoCat = $this->getAliasExtension($cat);
						$cat = XMLParser::getInstance('Categories')->getCategoryId($infoCat->alias,$infoCat->extension);
					}
				} 
			}
			else {
				$infoCat = $this->getAliasExtension($data->catid);
				$data->catid = XMLParser::getInstance('Categories')->getCategoryId($infoCat->alias,$infoCat->extension);
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
	
	private function checkMenuSign($string) {
		$menu = new stdClass;
		if (substr($string,0,1)!='-') {
			$menu->value	= $string;
			$menu->sign		= '';
		}
		else{
			$menu->value	= substr($string,1);
			$menu->sign		= '-';
		}
		return $menu;
	}
	
	private function addToModulesMenu($data) {
		$db    =  JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->clear()
			->insert('#__modules_menu')
			->columns(array($db->quoteName('moduleid'), $db->quoteName('menuid')))
			->values((int) $data['moduleid'] . ','. $data['sign'].$data['menuid']);
		$db->setQuery($query);
		$db->execute();
	}
	
	public function getModuleId($alias) {
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
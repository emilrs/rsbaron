<?php
defined('_JEXEC') or die('Restricted access');

JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_rsmediagallery/tables/');

class XMLParserRsMediaGalleryItems extends XMLParser 
{
	public $error;
	protected function getTable() {
		// JTableCategories
		return JTable::getInstance('Items', 'RSMediaGalleryTable');
	}
	
	public function saveItem($item) {
		$check = XMLParser::checkIfInstalled('com_rsmediagallery');
		
		if($check) {
			$item 			= $this->prepareData($item);
			$file 			= $item['original_filename'];
			$tag 			= $this->setDefaultValue($item,'tag',null);
			$title 			= $this->setDefaultValue($item,'title',null);
			$description 	= $this->setDefaultValue($item,'description','');
			$params 		= $this->setDefaultValue($item,'params','');
			$this->copyImage($file,$params,$title,$description,$tag);
		}
	}
	
	private function copyImage($file,$params,$title=null,$description='',$tag=null) {
		$dir_name = dirname(__FILE__);
		$pattern = '#templates[/?\\\](.*)[/?\\\]classes#';
		preg_match($pattern,$dir_name,$template);
		$template = $template[1];
		$from_path 	= JPATH_SITE.'/templates/'.$template.'/images/sampledata/rsmediagallery/'.$file;
		$from_thumb_path 	= JPATH_SITE.'/templates/'.$template.'/images/sampledata/rsmediagallery/thumb/'.$file;
		
		$fileName 	= explode('.',$file);
		$ext		= $fileName[1];
		$fileName 	= $fileName[0];
		$hash 		= md5(uniqid($fileName));
		$upload_location = JPATH_SITE.'/components/com_rsmediagallery/assets/gallery';
		//if(class_exists('JComponentHelper')) var_dump(JComponentHelper::getParams('com_rsmediagallery'));
		jimport('joomla.filesystem.file');
		JFile::copy($from_path, $upload_location.'/original/'.$hash.'.'.$ext);
	
		$componentParams = JComponentHelper::getParams('com_rsmediagallery');
		$perms 			 = octdec('0'.$componentParams->get('file_perms', '644'));
		@chmod($upload_location.'/original/'.$hash.'.'.$ext, $perms);
		
		
		JFile::copy($from_thumb_path, $upload_location.'/'.$hash.'.'.$ext);
		// set file permissions
		@chmod($upload_location.'/'.$hash.'.'.$ext, $perms);
		
		// get date object
		$date = JFactory::getDate();
		
		// save to db
		JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_rsmediagallery/tables');
		$image = $this->getTable();
		$image->original_filename 	= $fileName.'.'.$ext;
		$image->filename 			= $hash.'.'.$ext;
		$image->title 				= ($title==null ? JFile::stripExt($fileName) : $title);
		$image->description 		= $description;
		$image->type 				= 'image';
		// set correct ordering
		$image->ordering 			= $image->getNextOrder();		
		$image->params = $params;
		
		$image->created  = $date->toSql();
		$image->modified = $date->toSql();
		
		// set it to unpublished
		$image->published			= 1;
		if ($image->store())
		{
			// add tags
			if ($tag!=null) {
				$this->addToRSmediagalleryTags(array(
					'item_id' 	=> $image->id,
					'tag'		=> $tag
				));
			}
		}
	}
	
	private function addToRSmediagalleryTags($data) {
		$db    =  JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->clear()
			->insert('#__rsmediagallery_tags')
			->columns(array($db->quoteName('item_id'), $db->quoteName('tag')))
			->values((int) $data['item_id'] . ",'".$data['tag']."'");
		$db->setQuery($query);
		$db->execute();
	}
	
	
	public function getGalleryItemId($alias) {
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
<?php
define('_JEXEC', 1);

define('JPATH_BASE', realpath(dirname(__FILE__).'/../../../../administrator'));
require_once JPATH_BASE.'/includes/defines.php';

require_once JPATH_BASE.'/includes/framework.php';
require_once JPATH_BASE.'/includes/helper.php';
require_once JPATH_BASE.'/includes/toolbar.php';

require_once JPATH_SITE."/templates/rsbaron/classes/installer/helpers/xmlsorter.php";
require_once JPATH_SITE."/templates/rsbaron/classes/installer/helpers/xmlparser.php";


$templateName = XMLParser::getTemplateName();
//Language initialization
$lang = JFactory::getLanguage();
$extension = 'tpl_'.$templateName;
$base_dir = JPATH_SITE;
$language_tag = 'en-GB';
$reload = true;
$lang->load($extension, $base_dir, $language_tag, $reload);

// Instantiate the application.
$app = JFactory::getApplication('administrator');
$prefix = $app->getCfg('dbprefix');

function escape($string) {
	$escaped = htmlentities($string, ENT_COMPAT, 'utf-8');
	return $escaped;
}

$user = JFactory::getUser();
if ($user->get('guest')) {
	die('{"error":"You don`t have permission for this action!"}');
}

$templateExtension 	= JTable::getInstance('Extension', 'JTable');
$templateExtension->load(array('element' => $templateName));
$params				= json_decode($templateExtension->params);
$check				= JFactory::getApplication()->input->get('check', '', 'string');
$extensions			= JFactory::getApplication()->input->get('extensions', array(), 'array');

if(!$params->installedSampleData) {
	if ($check =='extension') {
		if (!empty($extensions)) {
			$error = '';
			foreach ($extensions as $extension) {
				$test = XMLParser::checkIfInstalled($extension);
				if (!$test) $error .= '<i style=\"color:red\">'.$extension.'</i> '.JText::_('TPL_AND').' ';
			}
			if ($error!='') {
				$error = substr($error,0,-4);
				die('{"error":"'.JText::_('TPL_FOR_BEST').'<br/>'.$error.' <br/><br/> <button type=\"button\" class=\"btn btn-primary\" onclick=\"installSampleData(\'force\')\">'.JText::_('TPL_PROCEED_ANYWAY').'</button>"}');
			}
		}
		else die('{"error":"'.JText::_('TPL_NO_EXTENSION').'"}');
	}

	$sorter = new XMLSorter();
	$files  = $sorter->getFiles();

	// parsing xml files
	foreach ($files as $file) {
		$parser 		= XMLParser::getInstance($file);
		$items 			= $parser->getItems(); 

		foreach ($items as $item) {
			try {
				$parser->saveItem($item);
			} catch (Exception $e) {
				die ('{"error":"'.escape($e->getMessage()).'"}');
			}
		}
	}

	// building sample data params
	$params->installedSampleData = 1;
	if(isset($params->googleClasses)) {
		$params->googleClasses = str_replace("'","",$params->googleClasses);
	}
	$params->hideHome 			= '0';
	$params->valignTopPositions = '1';
	$params->menuCenter 		= '0';
	// Menu
	$params->useMenuEffects 	= '1';
	$params->stickyMenu 		= '1';
	// Logo
	$params->logoAppearance 	= 'image';
	$params->logoAnchor 		= escape('http://www.rsjoomla.com/joomla-templates/rsbaron.html');
	$params->logoImage 			= escape('templates/rsbaron/images/logo.png');
	$params->logoImageAlignment = 'left';
	// Social
	$params->socialPosition 	= 'top-b';
	$params->positionAlignment 	= 'center';
	$params->socialFacebook 	= escape('https://www.facebook.com/rsjoomla');
	$params->socialTwitter 		= escape('http://twitter.com/rsjoomla');
	$params->socialLinkedin 	= escape('https://www.linkedin.com/company/rsjoomla-com');
	$params->socialYoutube 		= escape('http://www.youtube.com/rsjoomla');
	$params->socialGoogle 		= escape('https://plus.google.com/+Rsjoomlacom/posts');
	$params->socialVimeo 		= escape('https://vimeo.com/');
	$params->socialFlickr 		= escape('https://www.flickr.com/');
	$params->socialPinterest 	= escape('https://www.pinterest.com/');

	$new_params = json_encode($params);
	$db   		=  JFactory::getDbo();
	$query 		= $db->getQuery(true);

	$fields = array(
		$db->qn('params') . '=\''.$new_params.'\''
	);

	// Conditions for which records should be updated.
	$conditions = array(
		$db->qn('extension_id') . '='.$templateExtension->extension_id
	);

	// change the extension params
	$query->update($db->qn('#__extensions'))->set($fields)->where($conditions);
	$db->setQuery($query);
	$db->execute();

	// change the template style params
	$conditions_template = array(
		$db->quoteName('template') . '='.$db->q('rsbaron')
	);
	$query->clear();
	$query->update($db->quoteName('#__template_styles'))->set($fields)->where($conditions_template);
	$db->setQuery($query);
	$db->execute();

	die('{"success":"<span style=\"color:green\">'.JText::_('TPL_SUCCESS_DATA').'</span>"}');
}
else {
	die('{"error":"'.JText::_('TPL_ALREADY_INSTALLED').'"}');
}
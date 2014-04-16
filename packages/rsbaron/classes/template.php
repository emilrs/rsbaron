<?php
 /**
* @version 1.0.0
* @package RSBaron! 1.0.0
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;

require_once dirname(__FILE__).'/widget.php';

function _initRSTemplateShortCodes() {
	return RSTemplateShortCodes::replace();
}

class RSTemplate
{
	public $widgets = array();
	
	protected $document;
	protected $root;
	protected $option;
	protected $params;
	protected $absolute_root;
	public $customCSSPath;

	public $is30;

	public function __construct($document, $params=null) {
		$this->root				= JURI::root(true);
		$this->option			= JFactory::getApplication()->input->getCmd('option');
		
		// get Joomla! version
		$jversion = new JVersion();
		$this->is30 = $jversion->isCompatible('3.0');
		
		// set document
		$this->document = &$document;
		
		// set params
		$this->params = is_null($params) ? $this->document->params : $params;
		
		$this->widgets['logo'] 		= new RSTemplateWidget('logo', 	 $this->params);
		$this->widgets['social'] 	= new RSTemplateWidget('social', $this->params);
	}
	
	public function registerShortCodes() {
		require_once dirname(__FILE__).'/shortcodes.php';

		$app = JFactory::getApplication();
		$app->registerEvent('onAfterRender', '_initRSTemplateShortCodes');
	}
	
	// gets the current component
	public function getOption() {
		return $this->option;
	}
	
	public function getItemId() {
		$app 	= JFactory::getApplication();
		$menu 	= $app->getMenu();
		$active = $menu->getActive();
		if ($active) { 
			return $active->id;
		}
		else {
			return $app->input->getInt('Itemid', 0);
		}
	}
	
	public function isHome() {
		$active = $this->getItemId();
		$app = JFactory::getApplication();
		$menu = $app->getMenu();
		$lang = '*';

		if ($app->getLanguageFilter()) {
			$lang = JFactory::getLanguage()->getTag();
		}

		$home = $menu->getDefault($lang);

		return ($active && $home && $active == $home->id);
	}
	
	public function isHomeHidden() {
		$isHome = $this->isHome();
		return ($this->params->get('hideHome') && $isHome);
	}
	
	// adds the google analytics traking code
	public function addGoogleAnalytics() {
		if ($this->params->get('googleAnalyticsCode')) {
			$code 			= $this->params->get('googleAnalyticsCode');
			$trackingScript = "
					  var _gaq = _gaq || [];
					  _gaq.push(['_setAccount', '".$code."']);
					  _gaq.push(['_trackPageview']);

					  (function() {
						var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
						ga.src = ('https:' == document.location.protocol ?  'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
						var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
					  })();";
			$trakingScript = '<script type="text/javascript">'.$trackingScript.'</script>';
			return $trakingScript;
		}
	}
	
	// set the menu effect
	public function setMenuEffect(){
		$this->addJS('menuwidth.js');
		if ($this->params->get('useMenuEffects')) {
			$this->addJS('menu.js');
		} else {
			$this->addCSS('menu-no-animation.css');
		}
		
		if ($this->params->get('menuCenter')) {
			$this->addJS('menu-center.js');
		}
		
		if($this->params->get('stickyMenu')) {
			$this->addJS('sticky-menu.js');
		}
	}
	
	// set the default Google Classes and the Extra Ones the user sets
	public function addGoogleFont() {
		// if ($this->params->get('googleFontTitle') && $this->params->get('googleFontTitle') != '') {
			$uri = JURI::getInstance();
			$prefix_protocol = 'http';
			if ($uri->isSSL()) {
				$prefix_protocol .= 's';
			}

			$sufix = ':300,400,700,400italic,700italic';
			if ($this->params->get('googleFontSubset') && $this->params->get('googleFontSubset') != '') {
				$sufix = '&amp;subset='.$this->params->get('googleFontSubset');
			}
			// Google font for Titles
			$this->document->addCustomTag('<link href="'.$prefix_protocol.'://fonts.googleapis.com/css?family='.urlencode($this->params->get('googleTitleFont')).$sufix.'" rel="stylesheet" type="text/css" />');

			// Google font for Content
			$this->document->addCustomTag('<link href="'.$prefix_protocol.'://fonts.googleapis.com/css?family='.urlencode($this->params->get('googleContentFont')).$sufix.'" rel="stylesheet" type="text/css" />');

			// Title selectors with Google Font 
			$extraTitleSelectors = '';
			if (trim($this->params->get('addGoogleTitleClasses')) != '') {
				$extraTitleSelectors = trim($this->params->get('addGoogleTitleClasses'), ',');
			}
			$allTitleSelectors  = $this->params->get('googleTitleClasses');
			if ($extraTitleSelectors) {
				$allTitleSelectors .= ', '.$extraTitleSelectors;
			}
			$this->document->addStyleDeclaration($allTitleSelectors." { font-family: '".$this->escape($this->params->get('googleTitleFont'))."', sans-serif; }");

			// Content selectors with Google Font 
			$extraContentSelectors = '';
			if (trim($this->params->get('addGoogleContentClasses')) != '') {
				$extraContentSelectors = trim($this->params->get('addGoogleContentClasses'), ',');
			}
			$allContentSelectors  = $this->params->get('googleContentClasses');
			if ($extraContentSelectors) {
				$allContentSelectors .= ', '.$extraContentSelectors;
			}
			$this->document->addStyleDeclaration($allContentSelectors." { font-family: '".$this->escape($this->params->get('googleContentFont'))."', sans-serif; }");
		
	}
	
	// gets the css fixes for different joomla versions
	public function addJoomlaCSS() {
		if(!$this->is30){
			$this->addCSS('joomla25.css');
		}
	}
	
	/// aligns vertically the top-a/b/c positions
	public function valignTopPositions(){
		if ( $this->params->get('valignTopPositions') && $this->params->get('loadJQuery')!='no' ) {
			$this->addJS('valign-top-positions.js');
		}
	}
	
	///escaping function 
	public function escape($string) {
		$escaped = htmlentities($string, ENT_COMPAT, 'utf-8');
		return $escaped;
	}
	
	//add used javascript files
	public function addJS($url, $useRoot=true) {
		$prefix = '';
		if ($useRoot) {
			$prefix = $this->root.'/templates/'.$this->document->template.'/js/';
		}
		$this->document->addScript($prefix.$url);
	}
	
	public function addTemplateJs() {
		$this->addJS('template.js');
	}

	public function addjQuery($noConflict=true) {
		if ($this->is30) {
			JHtml::_('jquery.framework', $noConflict);
		}
		else {
			$this->addJS('jquery/jquery.min.js');
			$this->addJS('jquery/jquery-noconflict.js');
			$this->addJS('jquery/jquery.ui.core.min.js');
		}
	}
	
	//add normal stylesheet for the template
	public function addCSS($url, $useRoot=true) {
		$prefix = '';
		if ($useRoot) {
			$prefix = $this->root.'/templates/'.$this->document->template.'/css/';
		}
		
		$this->document->addStyleSheet($prefix.$url);
	}
	
	// adds a custom stylesheet for the current component (com_content.css for example)
	public function addComponentCSS() {
		$cssName		= $this->option.'.css';
		$cssPath 		= RSTEMPLATE_PATH.'/css/components/'.$cssName;
		if (file_exists($cssPath)) {
			$this->addCSS('components/'.$cssName);
		}
	}

	///adds a custom.css file if exists
	public function addCustomCSS() {
		$cssName					= 'custom.css';
		$this->customCSSPath 		= RSTEMPLATE_PATH.'/css/'.$cssName;
		if (file_exists($this->customCSSPath)) {
			$this->addCSS($cssName);
		}
	}
	
	// adds a custom stylesheet for the modules if exist (mod_login.css for example)
	public function addModulesCSS() {
		$xml 		= simplexml_load_file(JPATH_SITE."/templates/".$this->document->template."/templateDetails.xml");
		$positions 	= $xml->positions->position;
		
		if (count($positions)) {
			foreach ($positions as $position) {
				$modules = JModuleHelper::getModules($position);
				foreach ($modules as $module) {
					$cssName = $module->module.'.css';
					$cssPath = RSTEMPLATE_PATH.'/css/modules/'.$cssName;
					if (file_exists($cssPath)) {
						$this->addCSS('modules/'.$cssName);
					}
				}
			}
		}
	}
	
	
	public function addBootstrap() {
		if ($this->is30) {
			// Add JavaScript Frameworks
			JHtml::_('bootstrap.framework');
			
			// Load optional rtl Bootstrap css and Bootstrap bugfixes
			JHtmlBootstrap::loadCss($includeMaincss = true, $this->document->direction);
		} else {
			$this->addCSS('bootstrap/bootstrap.min.css');
			$this->addCSS('bootstrap/bootstrap-responsive.min.css');
			$this->addCSS('bootstrap/bootstrap-extended.css');
			$this->addjQuery();
			$this->addJS('bootstrap/bootstrap.min.js');
		}
	}
	
	public function getCSSPath($category, $file) {
		switch ($category) {
			case 'bootstrap':
				if ($this->is30) {
					return '/media/jui/css/'.$file;
				} else {
					return '/templates/'.$this->document->template.'/css/bootstrap/'.$file;
				}
			break;
		}
	}
	
	public function getJSPath($category, $file) {
		switch ($category) {
			case 'bootstrap':
			case 'jquery':
				if ($this->is30) {
					return '/media/jui/js/'.$file;
				} else {
					return '/templates/'.$this->document->template.'/js/'.$category.'/'.$file;
				}
			break;
			
			case 'html5':
				if ($this->is30) {
					return '/media/jui/js/'.$file;
				} else {
					return '/templates/'.$this->document->template.'/js/'.$file;
				}
			break;
		}
	}

	public function getPositions() {
		if ($this->params->get('definedPositions')) {
			$positions = explode(',',$this->params->get('definedPositions'));
			return $positions;
		}
	}
}
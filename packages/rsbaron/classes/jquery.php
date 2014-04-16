<?php
/**
* @version 1.0.0
* @package RSMediaGallery! 1.0.0
* @copyright (C) 2012 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/

defined('_JEXEC') or die('Restricted access');

function _iniRSTemplatejQuery()
{
	$jqueryHelper 	= RSTemplatejQuery::getInstance();
	// we're running onAfterRender() so set this to 1
	$jqueryHelper->afterRender = true;
	// force our own mode since the only one available now is the smart load
	$jqueryHelper->mode = 'smart';
	// try to add jQuery
	$jqueryHelper->addjQuery();
}

class RSTemplatejQuery
{
	public $mode = 'auto';
	public $afterRender = false;
	protected $document;
	protected $jQueryPattern = '#src="([\\\/a-zA-Z0-9_:\.-\\\!]*)\/jquery([0-9\.-]|core|min|pack)*?.js|(v\?\=)"#';
	
	
	public static function getInstance()
	{
		static $inst;
		
		if (empty($inst))
		{
			$params		= JFactory::getApplication()->getTemplate(true)->params;
			$inst 	= new RSTemplatejQuery($params->get('loadJQuery', 'auto'));
		}
		
		return $inst;
	}
	
	public function __construct($mode)
	{
		$this->document = JFactory::getDocument();
		$this->mode = $mode;
		// if debug is on, we need to add .src as well since our scripts include it
		if (JDEBUG)
			$this->jQueryPattern = str_replace('|min|pack)', '|min|src|pack)', $this->jQueryPattern);
	}
	
	public function addjQuery()
	{		
		// this if() clause will be run only once since 'auto' will be changed to something else
		// attempt to detect best approach
		if ($this->mode == 'auto')
		{
			// did we find multiple instances of jQuery ?
			// we haven't added anything yet so it means something else loaded jQuery this is why it's > 0
			if ($this->foundMultiplejQuery() > 0)
				// ok, try to load just one
				$this->mode = 'smart';
			// otherwise, add our own
			else
				$this->mode = 'own';
			
			// attach the function on both cases since we're on auto and we need to make sure that a single jquery instance runs
			$mainframe = JFactory::getApplication();
			$mainframe->registerEvent('onAfterRender', '_iniRSTemplatejQuery');
			
		}
		
		switch ($this->mode)
		{
			case 'own':
				// just add our script
				$this->addScript();
				
			
			break;
			
			case 'smart':
				// we can't run now since the "smart load" mode requires "onAfterRender()"
				if (!$this->afterRender)
				{
					// just add our script...
					$this->addScript();
					
					// just attach the event so it can run
					$mainframe = JFactory::getApplication();
					$mainframe->registerEvent('onAfterRender', '_iniRSTemplatejQuery');
					return true;
				}
					
				// if found multiple instances AND we are running onAfterRender() we can proceed
				// we've already added our own jQuery so this means that we need to check if we have more than one
				if ($this->foundMultiplejQuery() > 1)
					$this->replacejQuery();
			break;

			case 'no':
				$jversion = new JVersion();
				if ( $jversion->isCompatible('3.0') ) {
					JHtml::_('jquery.framework');
				}
				// do nothing - do not load
				return true;
			break;
		}
	}
	
	protected function addScript()
	{
		$src 	  =  JDEBUG ? '' : '.min';
		
		$this->document->addScript(JURI::root(true).'/templates/'.$this->document->template.'/js/jquery/jquery'.$src.'.js');
		$this->document->addScript(JURI::root(true).'/templates/'.$this->document->template.'/js/jquery/jquery-noconflict.js');
		//var_dump(JURI::root(true).'/templates/'.$this->document->template.'/js/jquery/jquery'.$src.'.js');
	}

	public function foundMultiplejQuery($where=null)
	{		
		$body = $where ? $where : JResponse::getBody();
		// find jQuery versions
		$found = preg_match_all($this->jQueryPattern, $body, $matches);
		
		return $found;
	}
	
	public function replacejQuery($where=null)
	{
		$src  = JDEBUG ? '' : '.min';
		$body = $where ? $where : JResponse::getBody();
		// remove all other references to jQuery library
		$body = preg_replace($this->jQueryPattern, 'GARBAGE', $body);
		// remove newly empty scripts
		$body = preg_replace('#<script[^>]*GARBAGE[^>]*></script>#', '', $body);
		// jQuery
		$jquery 	= '<script type="text/javascript" src="'.JURI::root(true).'/templates/'.$this->document->template.'/js/jquery/jquery'.$src.'.js'.'"></script>';
		// jQuery noConflict() mode enforcer
		$noconflict = '<script type="text/javascript" src="'.JURI::root(true).'/templates/'.$this->document->template.'/js/jquery/jquery-noconflict.js'.'"></script>';
		$body = str_replace('<head>', '<head>'."\r\n".$jquery."\r\n".$noconflict, $body);
		
		if ($where)
			return $body;
			
		JResponse::setBody($body);
	}
}
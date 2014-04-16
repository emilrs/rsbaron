<?php
/**
* @package RSBaron!
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-3.0.html
*/
defined('_JEXEC') or die;

define('RSTEMPLATE_PATH', dirname(__FILE__));

// Include helper file
require_once dirname(__FILE__).'/classes/template.php';
// Initialize our template
$template = new RSTemplate($this);

$template->registerShortCodes();

// Load bootstrap
if ($this->params->get('loadBootstrap')) {
	$template->addBootstrap();
}
$template->addTemplateJs();
// Add Stylesheets
$template->addCSS('template.css');
$template->addCSS('icons.css');

$template->addComponentCSS();
$template->addModulesCSS();
// Check version and load fixes
$template->addJoomlaCSS();
// theme CSS 
$template->addCSS('theme/'.$this->params->get('templateTheme').'.css');
// Load the custom.css
$template->addCustomCSS();
// Add Javascript Files
$template->setMenuEffect();
// Add Google Font
$template->addGoogleFont();
// Vertical align top positions
$template->valignTopPositions();

// Include helper file
require_once dirname(__FILE__).'/classes/jquery.php';
$jquery = RSTemplatejQuery::getInstance();
$jquery->addJQuery();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
	<!--[if lt IE 9]>
		<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/ie.css" rel="stylesheet" type="text/css"></script>
		<script src="<?php echo $this->baseurl; ?><?php echo $template->getJSPath('html5', 'html5.js'); ?>"></script>
	<![endif]-->
	<?php 
		// Add Google Analytics Tracking Code
		echo $template->addGoogleAnalytics();
		if (trim($this->params->get('addHeaderContent')) != '') {
			echo $this->params->get('addHeaderContent');
		}
	?>
</head>
<body class="site">
	<div class="body custom_<?php echo $template->getItemId(); ?>">
		<div class="container head-bg">
			<span class="header-line small"></span>
			<span class="header-line medium"></span>
			<span class="header-line big"></span>
		</div>
		<div class="container">
		<?php 
			$positions = $template->getPositions();
			if( is_array($positions) && count($positions)) {
				foreach ( $positions as $position ) {
					$position = trim($position);
					$file = realpath(JPATH_SITE.'/templates/'.$this->template.'/positions/'.$position.'.php');
					if (is_file($file)) {
						include $file;
					}
				}
			}
		?>
		</div>
		<div class="container footer-bg">
			<span class="footer-line big"></span>
			<span class="footer-line medium"></span>
			<span class="footer-line small"></span>
		</div>
	</div>
<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
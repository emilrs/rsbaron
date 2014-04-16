<?php
/**
* @version 1.0.0
* @package RSTemplate! 1.0.0
* @copyright (C) 2007-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-2.0.html
*/
defined('_JEXEC') or die;
JHtml::_('behavior.tooltip');
?>
<html>
<head>
	<base href="<?php echo JUri::root();?>" />
	<link rel="stylesheet" href="<?php echo JUri::root(true);?>/templates/<?php echo $template->template;?>/css/bootstrap/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo JUri::root(true);?>/templates/<?php echo $template->template;?>/css/bootstrap/bootstrap-responsive.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo JUri::root(true);?>/templates/<?php echo $template->template;?>/css/bootstrap/bootstrap-extended.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo JUri::root(true);?>/templates/<?php echo $template->template;?>/css/template.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo JUri::root(true);?>/templates/<?php echo $template->template;?>/css/icons.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo JUri::root(true);?>/templates/<?php echo $template->template;?>/css/theme/<?php echo $params->get('templateTheme');?>.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo JUri::root(true);?>/templates/<?php echo $template->template;?>/css/bootstrap-carousel.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo JUri::root(true);?>/templates/<?php echo $template->template;?>/css/iconlist-modal.css" type="text/css" />
	<link href="http://fonts.googleapis.com/css?family=<?php echo urlencode($params->get('googleTitleFont'));?>:300,400,700,400italic,700italic" rel="stylesheet" type="text/css" />
	<link href="http://fonts.googleapis.com/css?family=<?php echo urlencode($params->get('googleContentFont'));?>:300,400,700,400italic,700italic" rel="stylesheet" type="text/css" />

	<style type="text/css">
		<?php echo $params->get('googleTitleClasses')." { font-family: '".$params->get('googleTitleFont')."', sans-serif; }"; ?>
		<?php echo $params->get('googleContentClasses')." { font-family: '".$params->get('googleContentFont')."', sans-serif; }"; ?>
	</style>

	<style type="text/css">
			body{background:none; padding:5px;}
			select {cursor:default;} 
			#shortcode_preview { width:95%;}
			#box_preview {margin:0px auto;float:none;}
			#box_preview .rstpl-box-personal .rstpl-box-image{  }
			.update_preview {font-weight:bold;}
			.nolink{font-size:14px !important;}
			.admin-nav {margin:0px; float:left;}
			.admin-nav li {float:left; padding:3px 10px 3px 0px;}
			.admin-nav li h4{margin:2px 0 0 0;}
			.admin-nav li a{padding:3px 10px;}
			input {margin:10px 0px;}
			table tr .middle { vertical-align:middle; }
			.rstpl-box-carousel-full .item div .rstpl-box-content { width:78%; }
			.rstpl-box-full-width [class*="icon-"] { font-size:60px }
			.rstpl-box-big-icon-center [class*="icon-"] { width:0px; display:block; margin:30px auto 20px auto; }
			#features div { width:320px; }
			#box_style { margin-top:10px; }
			#options .control-label, #features .control-label, .box_type .control-label{ display: inline-block; width: 90px; }
			#features .control-label { width:80px; }
			[class^="icon-"] { background:none; }
			#buttons input, #options input { margin-right:10px }
			#slides tr td .input-xlarge { margin:0px; }
			#slides tr td .input-small { margin:8px 0px; }
			label {color:#555555}
			#social .select_icon_btn{ text-align:center;float:none;margin:0px auto;width:20px; height:30px; display:block }
			#social .select_icon_btn i{ font-size:26px;}
			.delete_row i{ color:#BD362F;}
			.rstpl-box-accordion {border:1px solid #DFDFDF;}
			.accordion {margin:0px;}
	</style>

	<script type="text/javascript" src="<?php echo JUri::root(true);?>/templates/<?php echo $template->template;?>/js/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo JUri::root(true);?>/templates/<?php echo $template->template;?>/js/jquery/jquery-noconflict.js"></script>
	<script type="text/javascript" src="<?php echo JUri::root(true);?>/templates/<?php echo $template->template;?>/js/bootstrap/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo JUri::root(true);?>/templates/<?php echo $template->template;?>/js/template.js"></script>
</head>
<body>
	<div id="shortcode_type" class="rstpl-m-large"><?php require_once JPATH_SITE.'/templates/'.$template->template.'/html/shortcodes/'.$shortcode_type.'.php'; ?></div>

	<div class="row-fluid">
		<a class="btn btn-success span8 offset2" href="javascript:void(0)" id="insert_shortcode"><?php echo JText::_('PLG_SYSTEM_RSTEMPLATE_INSERT_SHORTCODE');?></a>
	</div>
</body>
</html>
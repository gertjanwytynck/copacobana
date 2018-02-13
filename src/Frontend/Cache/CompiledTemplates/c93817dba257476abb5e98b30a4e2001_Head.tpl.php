<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLANGUAGE')) { echo $this->variables->getLANGUAGE(); } else { ?>{$LANGUAGE}<?php } ?>" class="ie6"> <![endif]-->
<!--[if IE 7 ]> <html lang="<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLANGUAGE')) { echo $this->variables->getLANGUAGE(); } else { ?>{$LANGUAGE}<?php } ?>" class="ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLANGUAGE')) { echo $this->variables->getLANGUAGE(); } else { ?>{$LANGUAGE}<?php } ?>" class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLANGUAGE')) { echo $this->variables->getLANGUAGE(); } else { ?>{$LANGUAGE}<?php } ?>" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLANGUAGE')) { echo $this->variables->getLANGUAGE(); } else { ?>{$LANGUAGE}<?php } ?>"> <!--<![endif]-->
<head>
	
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="generator" content="Fork CMS" />
	<?php if(array_key_exists('meta', (array) $this->variables)) { echo $this->variables['meta']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMeta')) { echo $this->variables->getMeta(); } else { ?>{$meta}<?php } ?>
	<?php if(array_key_exists('metaCustom', (array) $this->variables)) { echo $this->variables['metaCustom']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMetaCustom')) { echo $this->variables->getMetaCustom(); } else { ?>{$metaCustom}<?php } ?>

	<title><?php if(array_key_exists('pageTitle', (array) $this->variables)) { echo $this->variables['pageTitle']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getPageTitle')) { echo $this->variables->getPageTitle(); } else { ?>{$pageTitle}<?php } ?></title>

	
	<link rel="shortcut icon" href="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/favicon.png" type="image/x-icon"/>
	<link rel="apple-touch-icon" href="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/apple-touch-icon.png" />

	
	<meta name="application-name" content="<?php if(array_key_exists('siteTitle', (array) $this->variables)) { echo $this->variables['siteTitle']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getSiteTitle')) { echo $this->variables->getSiteTitle(); } else { ?>{$siteTitle}<?php } ?>"/>
	<meta name="msapplication-TileColor" content="#3380aa"/>
	<meta name="msapplication-TileImage" content="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/tile.png"/>

    <!-- Typekit -->
    <script src="//use.typekit.net/swj0ucl.js"></script>
    <script>try{Typekit.load();}catch(e){}</script>

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

	
	<?php
						if(!isset($this->variables['cssFiles']))
						{
							?>{iteration:cssFiles}<?php
							$this->variables['cssFiles'] = array();
							$this->iterations['c93817dba257476abb5e98b30a4e2001_Head.tpl.php_1']['fail'] = true;
						}
					$this->iterations['c93817dba257476abb5e98b30a4e2001_Head.tpl.php_1']['iteration'] = $this->variables['cssFiles'];
				if(isset(${'cssFiles'})) $this->iterations['c93817dba257476abb5e98b30a4e2001_Head.tpl.php_1']['old'] = ${'cssFiles'};
				$this->iterations['c93817dba257476abb5e98b30a4e2001_Head.tpl.php_1']['i'] = 1;
				$this->iterations['c93817dba257476abb5e98b30a4e2001_Head.tpl.php_1']['count'] = count($this->iterations['c93817dba257476abb5e98b30a4e2001_Head.tpl.php_1']['iteration']);
				foreach($this->iterations['c93817dba257476abb5e98b30a4e2001_Head.tpl.php_1']['iteration'] as ${'cssFiles'})
				{
					if(is_array(${'cssFiles'}))
					{
						if(!isset(${'cssFiles'}['first']) && $this->iterations['c93817dba257476abb5e98b30a4e2001_Head.tpl.php_1']['i'] == 1) ${'cssFiles'}['first'] = true;
						if(!isset(${'cssFiles'}['last']) && $this->iterations['c93817dba257476abb5e98b30a4e2001_Head.tpl.php_1']['i'] == $this->iterations['c93817dba257476abb5e98b30a4e2001_Head.tpl.php_1']['count']) ${'cssFiles'}['last'] = true;
						if(isset(${'cssFiles'}['formElements']) && is_array(${'cssFiles'}['formElements']))
						{
							foreach(${'cssFiles'}['formElements'] as $name => $object)
							{
								${'cssFiles'}[$name] = $object->parse();
								${'cssFiles'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
		<link rel="stylesheet" href="<?php if(array_key_exists('file', (array) ${'cssFiles'})) { echo ${'cssFiles'}['file']; } elseif(is_object(${'cssFiles'}) && method_exists(${'cssFiles'}, 'getFile')) { echo ${'cssFiles'}->getFile(); } else { ?>{$cssFiles->file}<?php } ?>" />
	<?php
					$this->iterations['c93817dba257476abb5e98b30a4e2001_Head.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['c93817dba257476abb5e98b30a4e2001_Head.tpl.php_1']['fail']) && $this->iterations['c93817dba257476abb5e98b30a4e2001_Head.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:cssFiles}<?php
					}
				if(isset($this->iterations['c93817dba257476abb5e98b30a4e2001_Head.tpl.php_1']['old'])) ${'cssFiles'} = $this->iterations['c93817dba257476abb5e98b30a4e2001_Head.tpl.php_1']['old'];
				else unset($this->iterations['c93817dba257476abb5e98b30a4e2001_Head.tpl.php_1']);
				?>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	
	<?php if(array_key_exists('siteHTMLHeader', (array) $this->variables)) { echo $this->variables['siteHTMLHeader']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getSiteHTMLHeader')) { echo $this->variables->getSiteHTMLHeader(); } else { ?>{$siteHTMLHeader}<?php } ?>
</head>
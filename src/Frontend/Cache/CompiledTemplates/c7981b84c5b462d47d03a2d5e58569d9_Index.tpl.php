<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Partials/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/Applications/MAMP/htdocs/copacobana/app/../src/Frontend/Themes/Copacobana/Core/Layout/Templates/Partials/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/Applications/MAMP/htdocs/copacobana/app/../src/Frontend/Core/Layout/Templates/Partials/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/copacobana/src/Frontend/Themes/Copacobana/Core/Layout/Templates'))) $this->compile('/Applications/MAMP/htdocs/copacobana/src/Frontend/Themes/Copacobana/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/copacobana/src/Frontend/Themes/Copacobana/Core/Layout/Templates');
                if($return === false && $this->compile('/Applications/MAMP/htdocs/copacobana/src/Frontend/Themes/Copacobana/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/copacobana/src/Frontend/Themes/Copacobana/Core/Layout/Templates');
                }
if($return === false) {
                    ?>{include:Core/Layout/Templates/Partials/Head.tpl}<?php
                }
?>

<body class="<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLANGUAGE')) { echo $this->variables->getLANGUAGE(); } else { ?>{$LANGUAGE}<?php } ?>" itemscope itemtype="http://schema.org/WebPage">
<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Partials/Header.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/Applications/MAMP/htdocs/copacobana/app/../src/Frontend/Themes/Copacobana/Core/Layout/Templates/Partials/Header.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/Applications/MAMP/htdocs/copacobana/app/../src/Frontend/Core/Layout/Templates/Partials/Header.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/copacobana/src/Frontend/Themes/Copacobana/Core/Layout/Templates'))) $this->compile('/Applications/MAMP/htdocs/copacobana/src/Frontend/Themes/Copacobana/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/copacobana/src/Frontend/Themes/Copacobana/Core/Layout/Templates');
                if($return === false && $this->compile('/Applications/MAMP/htdocs/copacobana/src/Frontend/Themes/Copacobana/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/copacobana/src/Frontend/Themes/Copacobana/Core/Layout/Templates');
                }
if($return === false) {
                    ?>{include:Core/Layout/Templates/Partials/Header.tpl}<?php
                }
?>

<main class="">
    <figure class="copacobana">
        <a href="<?php if(array_key_exists('FRONTEND_FILES_URL', (array) $this->variables)) { echo $this->variables['FRONTEND_FILES_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFRONTENDFILESURL')) { echo $this->variables->getFRONTENDFILESURL(); } else { ?>{$FRONTEND_FILES_URL}<?php } ?>/copacobana/copaboekje.pdf" target="_blank"><button class="btn-volunteer-header"><?php if(array_key_exists('lblProgamFolder', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblProgamFolder']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblProgamFolder')) { echo $this->variables->getLblProgamFolder(); } else { ?>{$lblProgamFolder|ucfirst}<?php } ?>!</button></a>
        <a href="<?php if(array_key_exists('FRONTEND_FILES_URL', (array) $this->variables)) { echo $this->variables['FRONTEND_FILES_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFRONTENDFILESURL')) { echo $this->variables->getFRONTENDFILESURL(); } else { ?>{$FRONTEND_FILES_URL}<?php } ?>/copacobana/plattegrond.jpg" target="_blank"><button class="btn-plattegrond-header"><?php if(array_key_exists('lblFestivalMap', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFestivalMap']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFestivalMap')) { echo $this->variables->getLblFestivalMap(); } else { ?>{$lblFestivalMap|ucfirst}<?php } ?>!</button></a>

        <div class="scroll-down">
          <a class="arrow-wrap" href="#content">
             <span class="arrow"></span>
           </a>
        </div>
    </figure>

    <section class="widget-artists cover-overflow">
      <div class="mobile-triggers">
        <div>
          <a class="practical-info-href-fix" href=""><button class="btn-mobile-trigger"><?php if(array_key_exists('lblPractical', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPractical']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblPractical')) { echo $this->variables->getLblPractical(); } else { ?>{$lblPractical|ucfirst}<?php } ?></button></a>
        </div>
        <div>
          <a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Frontend\Core\Engine\TemplateModifiers::getURLForBlock($this->variables['var'], 'Festival'); } elseif(is_object($this->variables) && method_exists($this->variables, 'getVar')) { echo $this->variables->getVar(); } else { ?>{$var|geturlforblock:'Festival'}<?php } ?>/line-up"><button class="btn-mobile-trigger"><?php if(array_key_exists('lblTimeTable', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTimeTable']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblTimeTable')) { echo $this->variables->getLblTimeTable(); } else { ?>{$lblTimeTable|ucfirst}<?php } ?></button></a>
        </div>
        <div>
          <a href="<?php if(array_key_exists('FRONTEND_FILES_URL', (array) $this->variables)) { echo $this->variables['FRONTEND_FILES_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFRONTENDFILESURL')) { echo $this->variables->getFRONTENDFILESURL(); } else { ?>{$FRONTEND_FILES_URL}<?php } ?>/copacobana/plattegrond.jpg" target="_blank"><button class="btn-mobile-trigger"><?php if(array_key_exists('lblFestivalMap', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFestivalMap']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFestivalMap')) { echo $this->variables->getLblFestivalMap(); } else { ?>{$lblFestivalMap|ucfirst}<?php } ?></button></a>
        </div>
        <div>
          <a href="<?php if(array_key_exists('FRONTEND_FILES_URL', (array) $this->variables)) { echo $this->variables['FRONTEND_FILES_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFRONTENDFILESURL')) { echo $this->variables->getFRONTENDFILESURL(); } else { ?>{$FRONTEND_FILES_URL}<?php } ?>/copacobana/copaboekje.pdf" target="_blank"><button class="btn-mobile-trigger"><?php if(array_key_exists('lblProgamFolder', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblProgamFolder']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblProgamFolder')) { echo $this->variables->getLblProgamFolder(); } else { ?>{$lblProgamFolder|ucfirst}<?php } ?></button></a>
        </div>
      </div>

      <div class="container-fluid">
          <?php
						if(!isset($this->variables['positionArtists']))
						{
							?>{iteration:positionArtists}<?php
							$this->variables['positionArtists'] = array();
							$this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_1']['fail'] = true;
						}
					$this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_1']['iteration'] = $this->variables['positionArtists'];
				if(isset(${'positionArtists'})) $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_1']['old'] = ${'positionArtists'};
				$this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_1']['i'] = 1;
				$this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_1']['count'] = count($this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_1']['iteration']);
				foreach($this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_1']['iteration'] as ${'positionArtists'})
				{
					if(is_array(${'positionArtists'}))
					{
						if(!isset(${'positionArtists'}['first']) && $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_1']['i'] == 1) ${'positionArtists'}['first'] = true;
						if(!isset(${'positionArtists'}['last']) && $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_1']['i'] == $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_1']['count']) ${'positionArtists'}['last'] = true;
						if(isset(${'positionArtists'}['formElements']) && is_array(${'positionArtists'}['formElements']))
						{
							foreach(${'positionArtists'}['formElements'] as $name => $object)
							{
								${'positionArtists'}[$name] = $object->parse();
								${'positionArtists'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
              <?php if(array_key_exists('blockContent', (array) ${'positionArtists'})) { echo ${'positionArtists'}['blockContent']; } elseif(is_object(${'positionArtists'}) && method_exists(${'positionArtists'}, 'getBlockContent')) { echo ${'positionArtists'}->getBlockContent(); } else { ?>{$positionArtists->blockContent}<?php } ?>
          <?php
					$this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_1']['fail']) && $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:positionArtists}<?php
					}
				if(isset($this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_1']['old'])) ${'positionArtists'} = $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_1']['old'];
				else unset($this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_1']);
				?>
      </div>
    </section>

    <section class="pattern-dotty cover-overflow">
        <div class="intro container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 news">
                    <?php
						if(!isset($this->variables['positionNews']))
						{
							?>{iteration:positionNews}<?php
							$this->variables['positionNews'] = array();
							$this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_2']['fail'] = true;
						}
					$this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_2']['iteration'] = $this->variables['positionNews'];
				if(isset(${'positionNews'})) $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_2']['old'] = ${'positionNews'};
				$this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_2']['i'] = 1;
				$this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_2']['count'] = count($this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_2']['iteration']);
				foreach($this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_2']['iteration'] as ${'positionNews'})
				{
					if(is_array(${'positionNews'}))
					{
						if(!isset(${'positionNews'}['first']) && $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_2']['i'] == 1) ${'positionNews'}['first'] = true;
						if(!isset(${'positionNews'}['last']) && $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_2']['i'] == $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_2']['count']) ${'positionNews'}['last'] = true;
						if(isset(${'positionNews'}['formElements']) && is_array(${'positionNews'}['formElements']))
						{
							foreach(${'positionNews'}['formElements'] as $name => $object)
							{
								${'positionNews'}[$name] = $object->parse();
								${'positionNews'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
                        <?php if(array_key_exists('blockContent', (array) ${'positionNews'})) { echo ${'positionNews'}['blockContent']; } elseif(is_object(${'positionNews'}) && method_exists(${'positionNews'}, 'getBlockContent')) { echo ${'positionNews'}->getBlockContent(); } else { ?>{$positionNews->blockContent}<?php } ?>
                    <?php
					$this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_2']['i']++;
				}
					if(isset($this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_2']['fail']) && $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_2']['fail'] == true)
					{
						?>{/iteration:positionNews}<?php
					}
				if(isset($this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_2']['old'])) ${'positionNews'} = $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_2']['old'];
				else unset($this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_2']);
				?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </section>

    <section class="video container-fluid">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
              <?php
						if(!isset($this->variables['positionVideo']))
						{
							?>{iteration:positionVideo}<?php
							$this->variables['positionVideo'] = array();
							$this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_3']['fail'] = true;
						}
					$this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_3']['iteration'] = $this->variables['positionVideo'];
				if(isset(${'positionVideo'})) $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_3']['old'] = ${'positionVideo'};
				$this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_3']['i'] = 1;
				$this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_3']['count'] = count($this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_3']['iteration']);
				foreach($this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_3']['iteration'] as ${'positionVideo'})
				{
					if(is_array(${'positionVideo'}))
					{
						if(!isset(${'positionVideo'}['first']) && $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_3']['i'] == 1) ${'positionVideo'}['first'] = true;
						if(!isset(${'positionVideo'}['last']) && $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_3']['i'] == $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_3']['count']) ${'positionVideo'}['last'] = true;
						if(isset(${'positionVideo'}['formElements']) && is_array(${'positionVideo'}['formElements']))
						{
							foreach(${'positionVideo'}['formElements'] as $name => $object)
							{
								${'positionVideo'}[$name] = $object->parse();
								${'positionVideo'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
                  <?php if(array_key_exists('blockContent', (array) ${'positionVideo'})) { echo ${'positionVideo'}['blockContent']; } elseif(is_object(${'positionVideo'}) && method_exists(${'positionVideo'}, 'getBlockContent')) { echo ${'positionVideo'}->getBlockContent(); } else { ?>{$positionVideo->blockContent}<?php } ?>
              <?php
					$this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_3']['i']++;
				}
					if(isset($this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_3']['fail']) && $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_3']['fail'] == true)
					{
						?>{/iteration:positionVideo}<?php
					}
				if(isset($this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_3']['old'])) ${'positionVideo'} = $this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_3']['old'];
				else unset($this->iterations['c7981b84c5b462d47d03a2d5e58569d9_Index.tpl.php_3']);
				?>
          </div>
        </div>
    </section>
</main>

<div id="map"></div>

<footer class="footer-dark">
    <a href="/"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/copacobana-light.svg" title="copacobana" alt="copacobana" class="copa-footer"/></a>
	<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Partials/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/Applications/MAMP/htdocs/copacobana/app/../src/Frontend/Themes/Copacobana/Core/Layout/Templates/Partials/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/Applications/MAMP/htdocs/copacobana/app/../src/Frontend/Core/Layout/Templates/Partials/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/copacobana/src/Frontend/Themes/Copacobana/Core/Layout/Templates'))) $this->compile('/Applications/MAMP/htdocs/copacobana/src/Frontend/Themes/Copacobana/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/copacobana/src/Frontend/Themes/Copacobana/Core/Layout/Templates');
                if($return === false && $this->compile('/Applications/MAMP/htdocs/copacobana/src/Frontend/Themes/Copacobana/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/copacobana/src/Frontend/Themes/Copacobana/Core/Layout/Templates');
                }
if($return === false) {
                    ?>{include:Core/Layout/Templates/Partials/Footer.tpl}<?php
                }
?>
</body>
</html>

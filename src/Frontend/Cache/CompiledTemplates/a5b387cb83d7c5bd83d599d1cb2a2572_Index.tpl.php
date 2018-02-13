<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Partials/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/Applications/MAMP/htdocs/gertjan/copacobana/2017/app/../src/Frontend/Themes/Copacobana/Core/Layout/Templates/Partials/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/Applications/MAMP/htdocs/gertjan/copacobana/2017/app/../src/Frontend/Core/Layout/Templates/Partials/Head.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates'))) $this->compile('/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates');
                if($return === false && $this->compile('/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates');
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
                ?>/Applications/MAMP/htdocs/gertjan/copacobana/2017/app/../src/Frontend/Themes/Copacobana/Core/Layout/Templates/Partials/Header.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/Applications/MAMP/htdocs/gertjan/copacobana/2017/app/../src/Frontend/Core/Layout/Templates/Partials/Header.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates'))) $this->compile('/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates');
                if($return === false && $this->compile('/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates');
                }
if($return === false) {
                    ?>{include:Core/Layout/Templates/Partials/Header.tpl}<?php
                }
?>
<main class="">
    <figure class="copacobana">
        <a href="https://docs.google.com/forms/d/1FzA-sEjGNXUUJ35k5qabYRFbvOobKpwjTJoc0LjYPHU/viewform" target="_blank"><button class="btn-volunteer-header"><?php if(array_key_exists('lblBecomeVolunteer', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblBecomeVolunteer']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblBecomeVolunteer')) { echo $this->variables->getLblBecomeVolunteer(); } else { ?>{$lblBecomeVolunteer|ucfirst}<?php } ?>!</button></a>
    </figure>

    <section class="widget-artists cover-overflow">
        <div class="container">
            <?php
						if(!isset($this->variables['positionArtists']))
						{
							?>{iteration:positionArtists}<?php
							$this->variables['positionArtists'] = array();
							$this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_1']['fail'] = true;
						}
					$this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_1']['iteration'] = $this->variables['positionArtists'];
				if(isset(${'positionArtists'})) $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_1']['old'] = ${'positionArtists'};
				$this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_1']['i'] = 1;
				$this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_1']['count'] = count($this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_1']['iteration']);
				foreach($this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_1']['iteration'] as ${'positionArtists'})
				{
					if(is_array(${'positionArtists'}))
					{
						if(!isset(${'positionArtists'}['first']) && $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_1']['i'] == 1) ${'positionArtists'}['first'] = true;
						if(!isset(${'positionArtists'}['last']) && $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_1']['i'] == $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_1']['count']) ${'positionArtists'}['last'] = true;
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
					$this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_1']['fail']) && $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:positionArtists}<?php
					}
				if(isset($this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_1']['old'])) ${'positionArtists'} = $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_1']['old'];
				else unset($this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_1']);
				?>
        </div>
    </section>
    <section class="pattern-dotty cover-overflow">
        <div class="intro container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 news">
                    <?php
						if(!isset($this->variables['positionNews']))
						{
							?>{iteration:positionNews}<?php
							$this->variables['positionNews'] = array();
							$this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_2']['fail'] = true;
						}
					$this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_2']['iteration'] = $this->variables['positionNews'];
				if(isset(${'positionNews'})) $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_2']['old'] = ${'positionNews'};
				$this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_2']['i'] = 1;
				$this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_2']['count'] = count($this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_2']['iteration']);
				foreach($this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_2']['iteration'] as ${'positionNews'})
				{
					if(is_array(${'positionNews'}))
					{
						if(!isset(${'positionNews'}['first']) && $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_2']['i'] == 1) ${'positionNews'}['first'] = true;
						if(!isset(${'positionNews'}['last']) && $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_2']['i'] == $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_2']['count']) ${'positionNews'}['last'] = true;
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
					$this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_2']['i']++;
				}
					if(isset($this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_2']['fail']) && $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_2']['fail'] == true)
					{
						?>{/iteration:positionNews}<?php
					}
				if(isset($this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_2']['old'])) ${'positionNews'} = $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_2']['old'];
				else unset($this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_2']);
				?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </section>

    <section class="video">
        <div class="container">
            <div class="row scheetjesvlieger">
                <div class="col-md-8 col-md-offset-2">
                    <div class="sterrenketting"></div>
                    <?php
						if(!isset($this->variables['positionVideo']))
						{
							?>{iteration:positionVideo}<?php
							$this->variables['positionVideo'] = array();
							$this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_3']['fail'] = true;
						}
					$this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_3']['iteration'] = $this->variables['positionVideo'];
				if(isset(${'positionVideo'})) $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_3']['old'] = ${'positionVideo'};
				$this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_3']['i'] = 1;
				$this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_3']['count'] = count($this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_3']['iteration']);
				foreach($this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_3']['iteration'] as ${'positionVideo'})
				{
					if(is_array(${'positionVideo'}))
					{
						if(!isset(${'positionVideo'}['first']) && $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_3']['i'] == 1) ${'positionVideo'}['first'] = true;
						if(!isset(${'positionVideo'}['last']) && $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_3']['i'] == $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_3']['count']) ${'positionVideo'}['last'] = true;
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
					$this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_3']['i']++;
				}
					if(isset($this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_3']['fail']) && $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_3']['fail'] == true)
					{
						?>{/iteration:positionVideo}<?php
					}
				if(isset($this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_3']['old'])) ${'positionVideo'} = $this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_3']['old'];
				else unset($this->iterations['a5b387cb83d7c5bd83d599d1cb2a2572_Index.tpl.php_3']);
				?>
                </div>
               <img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/scheetjesvlieger.png" title="copacobana" alt="copacobana" class="img-s"/>
            </div>
        </div>
    </section>
</main>

<footer class="footer-dark">
    <a href="/"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/copacobana-light.png" title="copacobana" alt="copacobana" class="copa-footer"/></a>
	<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Partials/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/Applications/MAMP/htdocs/gertjan/copacobana/2017/app/../src/Frontend/Themes/Copacobana/Core/Layout/Templates/Partials/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/Applications/MAMP/htdocs/gertjan/copacobana/2017/app/../src/Frontend/Core/Layout/Templates/Partials/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates'))) $this->compile('/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates');
                if($return === false && $this->compile('/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates');
                }
if($return === false) {
                    ?>{include:Core/Layout/Templates/Partials/Footer.tpl}<?php
                }
?>
</body>
</html>
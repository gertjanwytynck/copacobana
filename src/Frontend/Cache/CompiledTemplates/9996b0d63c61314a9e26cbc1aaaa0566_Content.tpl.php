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

<main id="tplContent">
    <section class="container">
        <div class="row">
            <div class="col-md-6">
                <?php
						if(!isset($this->variables['positionTopLeft']))
						{
							?>{iteration:positionTopLeft}<?php
							$this->variables['positionTopLeft'] = array();
							$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_1']['fail'] = true;
						}
					$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_1']['iteration'] = $this->variables['positionTopLeft'];
				if(isset(${'positionTopLeft'})) $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_1']['old'] = ${'positionTopLeft'};
				$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_1']['i'] = 1;
				$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_1']['count'] = count($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_1']['iteration']);
				foreach($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_1']['iteration'] as ${'positionTopLeft'})
				{
					if(is_array(${'positionTopLeft'}))
					{
						if(!isset(${'positionTopLeft'}['first']) && $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_1']['i'] == 1) ${'positionTopLeft'}['first'] = true;
						if(!isset(${'positionTopLeft'}['last']) && $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_1']['i'] == $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_1']['count']) ${'positionTopLeft'}['last'] = true;
						if(isset(${'positionTopLeft'}['formElements']) && is_array(${'positionTopLeft'}['formElements']))
						{
							foreach(${'positionTopLeft'}['formElements'] as $name => $object)
							{
								${'positionTopLeft'}[$name] = $object->parse();
								${'positionTopLeft'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
                    <?php if(array_key_exists('blockContent', (array) ${'positionTopLeft'})) { echo ${'positionTopLeft'}['blockContent']; } elseif(is_object(${'positionTopLeft'}) && method_exists(${'positionTopLeft'}, 'getBlockContent')) { echo ${'positionTopLeft'}->getBlockContent(); } else { ?>{$positionTopLeft->blockContent}<?php } ?>
                <?php
					$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_1']['fail']) && $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:positionTopLeft}<?php
					}
				if(isset($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_1']['old'])) ${'positionTopLeft'} = $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_1']['old'];
				else unset($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_1']);
				?>
            </div>
            <div class="col-md-6">
                <?php
						if(!isset($this->variables['positionTopRight']))
						{
							?>{iteration:positionTopRight}<?php
							$this->variables['positionTopRight'] = array();
							$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_2']['fail'] = true;
						}
					$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_2']['iteration'] = $this->variables['positionTopRight'];
				if(isset(${'positionTopRight'})) $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_2']['old'] = ${'positionTopRight'};
				$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_2']['i'] = 1;
				$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_2']['count'] = count($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_2']['iteration']);
				foreach($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_2']['iteration'] as ${'positionTopRight'})
				{
					if(is_array(${'positionTopRight'}))
					{
						if(!isset(${'positionTopRight'}['first']) && $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_2']['i'] == 1) ${'positionTopRight'}['first'] = true;
						if(!isset(${'positionTopRight'}['last']) && $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_2']['i'] == $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_2']['count']) ${'positionTopRight'}['last'] = true;
						if(isset(${'positionTopRight'}['formElements']) && is_array(${'positionTopRight'}['formElements']))
						{
							foreach(${'positionTopRight'}['formElements'] as $name => $object)
							{
								${'positionTopRight'}[$name] = $object->parse();
								${'positionTopRight'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
                    <?php if(array_key_exists('blockContent', (array) ${'positionTopRight'})) { echo ${'positionTopRight'}['blockContent']; } elseif(is_object(${'positionTopRight'}) && method_exists(${'positionTopRight'}, 'getBlockContent')) { echo ${'positionTopRight'}->getBlockContent(); } else { ?>{$positionTopRight->blockContent}<?php } ?>
                <?php
					$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_2']['i']++;
				}
					if(isset($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_2']['fail']) && $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_2']['fail'] == true)
					{
						?>{/iteration:positionTopRight}<?php
					}
				if(isset($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_2']['old'])) ${'positionTopRight'} = $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_2']['old'];
				else unset($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_2']);
				?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mob-hide">
                <?php
						if(!isset($this->variables['positionBottomLeft']))
						{
							?>{iteration:positionBottomLeft}<?php
							$this->variables['positionBottomLeft'] = array();
							$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_3']['fail'] = true;
						}
					$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_3']['iteration'] = $this->variables['positionBottomLeft'];
				if(isset(${'positionBottomLeft'})) $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_3']['old'] = ${'positionBottomLeft'};
				$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_3']['i'] = 1;
				$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_3']['count'] = count($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_3']['iteration']);
				foreach($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_3']['iteration'] as ${'positionBottomLeft'})
				{
					if(is_array(${'positionBottomLeft'}))
					{
						if(!isset(${'positionBottomLeft'}['first']) && $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_3']['i'] == 1) ${'positionBottomLeft'}['first'] = true;
						if(!isset(${'positionBottomLeft'}['last']) && $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_3']['i'] == $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_3']['count']) ${'positionBottomLeft'}['last'] = true;
						if(isset(${'positionBottomLeft'}['formElements']) && is_array(${'positionBottomLeft'}['formElements']))
						{
							foreach(${'positionBottomLeft'}['formElements'] as $name => $object)
							{
								${'positionBottomLeft'}[$name] = $object->parse();
								${'positionBottomLeft'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
                    <?php if(array_key_exists('blockContent', (array) ${'positionBottomLeft'})) { echo ${'positionBottomLeft'}['blockContent']; } elseif(is_object(${'positionBottomLeft'}) && method_exists(${'positionBottomLeft'}, 'getBlockContent')) { echo ${'positionBottomLeft'}->getBlockContent(); } else { ?>{$positionBottomLeft->blockContent}<?php } ?>
                <?php
					$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_3']['i']++;
				}
					if(isset($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_3']['fail']) && $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_3']['fail'] == true)
					{
						?>{/iteration:positionBottomLeft}<?php
					}
				if(isset($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_3']['old'])) ${'positionBottomLeft'} = $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_3']['old'];
				else unset($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_3']);
				?>
            </div>
            <div class="col-md-6">
                <?php
						if(!isset($this->variables['positionBottomRight']))
						{
							?>{iteration:positionBottomRight}<?php
							$this->variables['positionBottomRight'] = array();
							$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_4']['fail'] = true;
						}
					$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_4']['iteration'] = $this->variables['positionBottomRight'];
				if(isset(${'positionBottomRight'})) $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_4']['old'] = ${'positionBottomRight'};
				$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_4']['i'] = 1;
				$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_4']['count'] = count($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_4']['iteration']);
				foreach($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_4']['iteration'] as ${'positionBottomRight'})
				{
					if(is_array(${'positionBottomRight'}))
					{
						if(!isset(${'positionBottomRight'}['first']) && $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_4']['i'] == 1) ${'positionBottomRight'}['first'] = true;
						if(!isset(${'positionBottomRight'}['last']) && $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_4']['i'] == $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_4']['count']) ${'positionBottomRight'}['last'] = true;
						if(isset(${'positionBottomRight'}['formElements']) && is_array(${'positionBottomRight'}['formElements']))
						{
							foreach(${'positionBottomRight'}['formElements'] as $name => $object)
							{
								${'positionBottomRight'}[$name] = $object->parse();
								${'positionBottomRight'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
                    <?php if(array_key_exists('blockContent', (array) ${'positionBottomRight'})) { echo ${'positionBottomRight'}['blockContent']; } elseif(is_object(${'positionBottomRight'}) && method_exists(${'positionBottomRight'}, 'getBlockContent')) { echo ${'positionBottomRight'}->getBlockContent(); } else { ?>{$positionBottomRight->blockContent}<?php } ?>
                <?php
					$this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_4']['i']++;
				}
					if(isset($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_4']['fail']) && $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_4']['fail'] == true)
					{
						?>{/iteration:positionBottomRight}<?php
					}
				if(isset($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_4']['old'])) ${'positionBottomRight'} = $this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_4']['old'];
				else unset($this->iterations['9996b0d63c61314a9e26cbc1aaaa0566_Content.tpl.php_4']);
				?>
            </div>
        </div>
    </section>
</main>
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

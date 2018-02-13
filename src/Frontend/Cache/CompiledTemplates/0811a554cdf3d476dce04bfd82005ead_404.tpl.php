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

<main class="sitemap">
    <section class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <?php
						if(!isset($this->variables['positionMain']))
						{
							?>{iteration:positionMain}<?php
							$this->variables['positionMain'] = array();
							$this->iterations['0811a554cdf3d476dce04bfd82005ead_404.tpl.php_1']['fail'] = true;
						}
					$this->iterations['0811a554cdf3d476dce04bfd82005ead_404.tpl.php_1']['iteration'] = $this->variables['positionMain'];
				if(isset(${'positionMain'})) $this->iterations['0811a554cdf3d476dce04bfd82005ead_404.tpl.php_1']['old'] = ${'positionMain'};
				$this->iterations['0811a554cdf3d476dce04bfd82005ead_404.tpl.php_1']['i'] = 1;
				$this->iterations['0811a554cdf3d476dce04bfd82005ead_404.tpl.php_1']['count'] = count($this->iterations['0811a554cdf3d476dce04bfd82005ead_404.tpl.php_1']['iteration']);
				foreach($this->iterations['0811a554cdf3d476dce04bfd82005ead_404.tpl.php_1']['iteration'] as ${'positionMain'})
				{
					if(is_array(${'positionMain'}))
					{
						if(!isset(${'positionMain'}['first']) && $this->iterations['0811a554cdf3d476dce04bfd82005ead_404.tpl.php_1']['i'] == 1) ${'positionMain'}['first'] = true;
						if(!isset(${'positionMain'}['last']) && $this->iterations['0811a554cdf3d476dce04bfd82005ead_404.tpl.php_1']['i'] == $this->iterations['0811a554cdf3d476dce04bfd82005ead_404.tpl.php_1']['count']) ${'positionMain'}['last'] = true;
						if(isset(${'positionMain'}['formElements']) && is_array(${'positionMain'}['formElements']))
						{
							foreach(${'positionMain'}['formElements'] as $name => $object)
							{
								${'positionMain'}[$name] = $object->parse();
								${'positionMain'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
                    <?php if(array_key_exists('blockContent', (array) ${'positionMain'})) { echo ${'positionMain'}['blockContent']; } elseif(is_object(${'positionMain'}) && method_exists(${'positionMain'}, 'getBlockContent')) { echo ${'positionMain'}->getBlockContent(); } else { ?>{$positionMain->blockContent}<?php } ?>
                <?php
					$this->iterations['0811a554cdf3d476dce04bfd82005ead_404.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['0811a554cdf3d476dce04bfd82005ead_404.tpl.php_1']['fail']) && $this->iterations['0811a554cdf3d476dce04bfd82005ead_404.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:positionMain}<?php
					}
				if(isset($this->iterations['0811a554cdf3d476dce04bfd82005ead_404.tpl.php_1']['old'])) ${'positionMain'} = $this->iterations['0811a554cdf3d476dce04bfd82005ead_404.tpl.php_1']['old'];
				else unset($this->iterations['0811a554cdf3d476dce04bfd82005ead_404.tpl.php_1']);
				?>
            </div>
        </div>
    </section>
</main>
<footer>
    <a href="/"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/copacobana.svg" title="copacobana" alt="copacobana" class="copa-footer" /></a>
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

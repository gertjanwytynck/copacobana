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

<main class="default">
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php
						if(!isset($this->variables['positionContent']))
						{
							?>{iteration:positionContent}<?php
							$this->variables['positionContent'] = array();
							$this->iterations['215da628b8d8132782e7579b6a27d545_Default.tpl.php_1']['fail'] = true;
						}
					$this->iterations['215da628b8d8132782e7579b6a27d545_Default.tpl.php_1']['iteration'] = $this->variables['positionContent'];
				if(isset(${'positionContent'})) $this->iterations['215da628b8d8132782e7579b6a27d545_Default.tpl.php_1']['old'] = ${'positionContent'};
				$this->iterations['215da628b8d8132782e7579b6a27d545_Default.tpl.php_1']['i'] = 1;
				$this->iterations['215da628b8d8132782e7579b6a27d545_Default.tpl.php_1']['count'] = count($this->iterations['215da628b8d8132782e7579b6a27d545_Default.tpl.php_1']['iteration']);
				foreach($this->iterations['215da628b8d8132782e7579b6a27d545_Default.tpl.php_1']['iteration'] as ${'positionContent'})
				{
					if(is_array(${'positionContent'}))
					{
						if(!isset(${'positionContent'}['first']) && $this->iterations['215da628b8d8132782e7579b6a27d545_Default.tpl.php_1']['i'] == 1) ${'positionContent'}['first'] = true;
						if(!isset(${'positionContent'}['last']) && $this->iterations['215da628b8d8132782e7579b6a27d545_Default.tpl.php_1']['i'] == $this->iterations['215da628b8d8132782e7579b6a27d545_Default.tpl.php_1']['count']) ${'positionContent'}['last'] = true;
						if(isset(${'positionContent'}['formElements']) && is_array(${'positionContent'}['formElements']))
						{
							foreach(${'positionContent'}['formElements'] as $name => $object)
							{
								${'positionContent'}[$name] = $object->parse();
								${'positionContent'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
                    <?php if(array_key_exists('blockContent', (array) ${'positionContent'})) { echo ${'positionContent'}['blockContent']; } elseif(is_object(${'positionContent'}) && method_exists(${'positionContent'}, 'getBlockContent')) { echo ${'positionContent'}->getBlockContent(); } else { ?>{$positionContent->blockContent}<?php } ?>
                <?php
					$this->iterations['215da628b8d8132782e7579b6a27d545_Default.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['215da628b8d8132782e7579b6a27d545_Default.tpl.php_1']['fail']) && $this->iterations['215da628b8d8132782e7579b6a27d545_Default.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:positionContent}<?php
					}
				if(isset($this->iterations['215da628b8d8132782e7579b6a27d545_Default.tpl.php_1']['old'])) ${'positionContent'} = $this->iterations['215da628b8d8132782e7579b6a27d545_Default.tpl.php_1']['old'];
				else unset($this->iterations['215da628b8d8132782e7579b6a27d545_Default.tpl.php_1']);
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

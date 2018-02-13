<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>

<?php $includes = array();
                ob_start();
                ?>Core/Layout/Templates/Elements/FooterContent.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/Applications/MAMP/htdocs/gertjan/copacobana/2017/app/../src/Frontend/Themes/Copacobana/Core/Layout/Templates/Elements/FooterContent.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/Applications/MAMP/htdocs/gertjan/copacobana/2017/app/../src/Frontend/Core/Layout/Templates/Elements/FooterContent.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates/Partials'))) $this->compile('/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates/Partials', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates/Partials');
                if($return === false && $this->compile('/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates/Partials', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/MAMP/htdocs/gertjan/copacobana/2017/src/Frontend/Themes/Copacobana/Core/Layout/Templates/Partials');
                }
if($return === false) {
                    ?>{include:Core/Layout/Templates/Elements/FooterContent.tpl}<?php
                }
?>


<?php
						if(!isset($this->variables['jsFiles']))
						{
							?>{iteration:jsFiles}<?php
							$this->variables['jsFiles'] = array();
							$this->iterations['9b1d9f2884c7a121b914146b62973032_Footer.tpl.php_1']['fail'] = true;
						}
					$this->iterations['9b1d9f2884c7a121b914146b62973032_Footer.tpl.php_1']['iteration'] = $this->variables['jsFiles'];
				if(isset(${'jsFiles'})) $this->iterations['9b1d9f2884c7a121b914146b62973032_Footer.tpl.php_1']['old'] = ${'jsFiles'};
				$this->iterations['9b1d9f2884c7a121b914146b62973032_Footer.tpl.php_1']['i'] = 1;
				$this->iterations['9b1d9f2884c7a121b914146b62973032_Footer.tpl.php_1']['count'] = count($this->iterations['9b1d9f2884c7a121b914146b62973032_Footer.tpl.php_1']['iteration']);
				foreach($this->iterations['9b1d9f2884c7a121b914146b62973032_Footer.tpl.php_1']['iteration'] as ${'jsFiles'})
				{
					if(is_array(${'jsFiles'}))
					{
						if(!isset(${'jsFiles'}['first']) && $this->iterations['9b1d9f2884c7a121b914146b62973032_Footer.tpl.php_1']['i'] == 1) ${'jsFiles'}['first'] = true;
						if(!isset(${'jsFiles'}['last']) && $this->iterations['9b1d9f2884c7a121b914146b62973032_Footer.tpl.php_1']['i'] == $this->iterations['9b1d9f2884c7a121b914146b62973032_Footer.tpl.php_1']['count']) ${'jsFiles'}['last'] = true;
						if(isset(${'jsFiles'}['formElements']) && is_array(${'jsFiles'}['formElements']))
						{
							foreach(${'jsFiles'}['formElements'] as $name => $object)
							{
								${'jsFiles'}[$name] = $object->parse();
								${'jsFiles'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
	<script src="<?php if(array_key_exists('file', (array) ${'jsFiles'})) { echo ${'jsFiles'}['file']; } elseif(is_object(${'jsFiles'}) && method_exists(${'jsFiles'}, 'getFile')) { echo ${'jsFiles'}->getFile(); } else { ?>{$jsFiles->file}<?php } ?>"></script>
<?php
					$this->iterations['9b1d9f2884c7a121b914146b62973032_Footer.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['9b1d9f2884c7a121b914146b62973032_Footer.tpl.php_1']['fail']) && $this->iterations['9b1d9f2884c7a121b914146b62973032_Footer.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:jsFiles}<?php
					}
				if(isset($this->iterations['9b1d9f2884c7a121b914146b62973032_Footer.tpl.php_1']['old'])) ${'jsFiles'} = $this->iterations['9b1d9f2884c7a121b914146b62973032_Footer.tpl.php_1']['old'];
				else unset($this->iterations['9b1d9f2884c7a121b914146b62973032_Footer.tpl.php_1']);
				?>


<script src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Js/jquery.lazyloadxt.min.js"></script>
<script src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Js/jquery.lazyloadxt.extra.min.js"></script>
<script src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Js/copacobana.js"></script>


<?php if(array_key_exists('siteHTMLFooter', (array) $this->variables)) { echo $this->variables['siteHTMLFooter']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getSiteHTMLFooter')) { echo $this->variables->getSiteHTMLFooter(); } else { ?>{$siteHTMLFooter}<?php } ?>
<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
						if(isset($this->variables['navigation']) && empty($this->variables['navigation']) === false)
						{
							?>
	<ul>
		<?php
						if(!isset($this->variables['navigation']))
						{
							?>{iteration:navigation}<?php
							$this->variables['navigation'] = array();
							$this->iterations['fefe725cff63660279efc611672c0e8e_Sitemap.tpl.php_1']['fail'] = true;
						}
					$this->iterations['fefe725cff63660279efc611672c0e8e_Sitemap.tpl.php_1']['iteration'] = $this->variables['navigation'];
				if(isset(${'navigation'})) $this->iterations['fefe725cff63660279efc611672c0e8e_Sitemap.tpl.php_1']['old'] = ${'navigation'};
				$this->iterations['fefe725cff63660279efc611672c0e8e_Sitemap.tpl.php_1']['i'] = 1;
				$this->iterations['fefe725cff63660279efc611672c0e8e_Sitemap.tpl.php_1']['count'] = count($this->iterations['fefe725cff63660279efc611672c0e8e_Sitemap.tpl.php_1']['iteration']);
				foreach($this->iterations['fefe725cff63660279efc611672c0e8e_Sitemap.tpl.php_1']['iteration'] as ${'navigation'})
				{
					if(is_array(${'navigation'}))
					{
						if(!isset(${'navigation'}['first']) && $this->iterations['fefe725cff63660279efc611672c0e8e_Sitemap.tpl.php_1']['i'] == 1) ${'navigation'}['first'] = true;
						if(!isset(${'navigation'}['last']) && $this->iterations['fefe725cff63660279efc611672c0e8e_Sitemap.tpl.php_1']['i'] == $this->iterations['fefe725cff63660279efc611672c0e8e_Sitemap.tpl.php_1']['count']) ${'navigation'}['last'] = true;
						if(isset(${'navigation'}['formElements']) && is_array(${'navigation'}['formElements']))
						{
							foreach(${'navigation'}['formElements'] as $name => $object)
							{
								${'navigation'}[$name] = $object->parse();
								${'navigation'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
			<li>
				<a href="<?php if(array_key_exists('link', (array) ${'navigation'})) { echo ${'navigation'}['link']; } elseif(is_object(${'navigation'}) && method_exists(${'navigation'}, 'getLink')) { echo ${'navigation'}->getLink(); } else { ?>{$navigation->link}<?php } ?>" title="<?php if(array_key_exists('navigation_title', (array) ${'navigation'})) { echo ${'navigation'}['navigation_title']; } elseif(is_object(${'navigation'}) && method_exists(${'navigation'}, 'getNavigationTitle')) { echo ${'navigation'}->getNavigationTitle(); } else { ?>{$navigation->navigation_title}<?php } ?>"<?php
						if(
							(is_object(${'navigation'}) && ${'navigation'}->getNofollow() && ${'navigation'}->getNofollow() != '' && ${'navigation'}->getNofollow() !== false)
							|| (is_array(${'navigation'}) && isset(${'navigation'}['nofollow']) && empty(${'navigation'}['nofollow']) === false))
						{
							?> rel="nofollow"<?php } ?>><?php if(array_key_exists('navigation_title', (array) ${'navigation'})) { echo ${'navigation'}['navigation_title']; } elseif(is_object(${'navigation'}) && method_exists(${'navigation'}, 'getNavigationTitle')) { echo ${'navigation'}->getNavigationTitle(); } else { ?>{$navigation->navigation_title}<?php } ?></a>
				<?php if(array_key_exists('children', (array) ${'navigation'})) { echo ${'navigation'}['children']; } elseif(is_object(${'navigation'}) && method_exists(${'navigation'}, 'getChildren')) { echo ${'navigation'}->getChildren(); } else { ?>{$navigation->children}<?php } ?>
			</li>
		<?php
					$this->iterations['fefe725cff63660279efc611672c0e8e_Sitemap.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['fefe725cff63660279efc611672c0e8e_Sitemap.tpl.php_1']['fail']) && $this->iterations['fefe725cff63660279efc611672c0e8e_Sitemap.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:navigation}<?php
					}
				if(isset($this->iterations['fefe725cff63660279efc611672c0e8e_Sitemap.tpl.php_1']['old'])) ${'navigation'} = $this->iterations['fefe725cff63660279efc611672c0e8e_Sitemap.tpl.php_1']['old'];
				else unset($this->iterations['fefe725cff63660279efc611672c0e8e_Sitemap.tpl.php_1']);
				?>
	</ul>
<?php } ?>
<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<ul>
    <?php
						if(isset($this->variables['navigation']) && count($this->variables['navigation']) != 0 && $this->variables['navigation'] != '' && $this->variables['navigation'] !== false)
						{
							?>
      <?php
						if(!isset($this->variables['navigation']))
						{
							?>{iteration:navigation}<?php
							$this->variables['navigation'] = array();
							$this->iterations['0bbefbbf13f586731da494456f1b0c94_Navigation.tpl.php_1']['fail'] = true;
						}
					$this->iterations['0bbefbbf13f586731da494456f1b0c94_Navigation.tpl.php_1']['iteration'] = $this->variables['navigation'];
				if(isset(${'navigation'})) $this->iterations['0bbefbbf13f586731da494456f1b0c94_Navigation.tpl.php_1']['old'] = ${'navigation'};
				$this->iterations['0bbefbbf13f586731da494456f1b0c94_Navigation.tpl.php_1']['i'] = 1;
				$this->iterations['0bbefbbf13f586731da494456f1b0c94_Navigation.tpl.php_1']['count'] = count($this->iterations['0bbefbbf13f586731da494456f1b0c94_Navigation.tpl.php_1']['iteration']);
				foreach($this->iterations['0bbefbbf13f586731da494456f1b0c94_Navigation.tpl.php_1']['iteration'] as ${'navigation'})
				{
					if(is_array(${'navigation'}))
					{
						if(!isset(${'navigation'}['first']) && $this->iterations['0bbefbbf13f586731da494456f1b0c94_Navigation.tpl.php_1']['i'] == 1) ${'navigation'}['first'] = true;
						if(!isset(${'navigation'}['last']) && $this->iterations['0bbefbbf13f586731da494456f1b0c94_Navigation.tpl.php_1']['i'] == $this->iterations['0bbefbbf13f586731da494456f1b0c94_Navigation.tpl.php_1']['count']) ${'navigation'}['last'] = true;
						if(isset(${'navigation'}['formElements']) && is_array(${'navigation'}['formElements']))
						{
							foreach(${'navigation'}['formElements'] as $name => $object)
							{
								${'navigation'}[$name] = $object->parse();
								${'navigation'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
          <li class="<?php
						if(
							(is_object(${'navigation'}) && ${'navigation'}->getSelected() && ${'navigation'}->getSelected() != '' && ${'navigation'}->getSelected() !== false)
							|| (is_array(${'navigation'}) && isset(${'navigation'}['selected']) && count(${'navigation'}['selected']) != 0 && ${'navigation'}['selected'] != '' && ${'navigation'}['selected'] !== false))
						{
							?>active<?php } ?>">
              <a href="<?php if(array_key_exists('link', (array) ${'navigation'})) { echo ${'navigation'}['link']; } elseif(is_object(${'navigation'}) && method_exists(${'navigation'}, 'getLink')) { echo ${'navigation'}->getLink(); } else { ?>{$navigation->link}<?php } ?>" <?php
						if(
							(is_object(${'navigation'}) && ${'navigation'}->getNofollow() && ${'navigation'}->getNofollow() != '' && ${'navigation'}->getNofollow() !== false)
							|| (is_array(${'navigation'}) && isset(${'navigation'}['nofollow']) && count(${'navigation'}['nofollow']) != 0 && ${'navigation'}['nofollow'] != '' && ${'navigation'}['nofollow'] !== false))
						{
							?> rel="nofollow"<?php } ?>><?php if(array_key_exists('navigation_title', (array) ${'navigation'})) { echo ${'navigation'}['navigation_title']; } elseif(is_object(${'navigation'}) && method_exists(${'navigation'}, 'getNavigationTitle')) { echo ${'navigation'}->getNavigationTitle(); } else { ?>{$navigation->navigation_title}<?php } ?></a>
          </li>
      <?php
					$this->iterations['0bbefbbf13f586731da494456f1b0c94_Navigation.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['0bbefbbf13f586731da494456f1b0c94_Navigation.tpl.php_1']['fail']) && $this->iterations['0bbefbbf13f586731da494456f1b0c94_Navigation.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:navigation}<?php
					}
				if(isset($this->iterations['0bbefbbf13f586731da494456f1b0c94_Navigation.tpl.php_1']['old'])) ${'navigation'} = $this->iterations['0bbefbbf13f586731da494456f1b0c94_Navigation.tpl.php_1']['old'];
				else unset($this->iterations['0bbefbbf13f586731da494456f1b0c94_Navigation.tpl.php_1']);
				?>
    <?php } ?>
    <li class="mobile-location">
      <p>
        <?php if(array_key_exists('lblFestivalDate', (array) $this->variables)) { echo $this->variables['lblFestivalDate']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFestivalDate')) { echo $this->variables->getLblFestivalDate(); } else { ?>{$lblFestivalDate}<?php } ?>
        <a href="https://www.google.be/maps/place/S%26R+Rozebroeken/@51.0596485,3.7587856,17z/data=!3m1!4b1!4m5!3m4!1s0x47c376c156ac8097:0xd16c48285d5edaca!8m2!3d51.0596451!4d3.7609796" target="_blank"><?php if(array_key_exists('lblFestivalLocation', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFestivalLocation']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFestivalLocation')) { echo $this->variables->getLblFestivalLocation(); } else { ?>{$lblFestivalLocation|ucfirst}<?php } ?></a>
      </p>
    </li>
</ul>
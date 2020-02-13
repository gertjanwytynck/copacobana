<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<header>
    <div class="top-bar"></div>
    <div class="copa-intro">
      <a href="/<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLANGUAGE')) { echo $this->variables->getLANGUAGE(); } else { ?>{$LANGUAGE}<?php } ?>/">
        <img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/copa-small.svg" title="copacobana" alt="copacobana" />
      </a>
    </div>
    <nav class="navbar" role="navigation">
        <div class="navbar-header">
            <a href="/<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLANGUAGE')) { echo $this->variables->getLANGUAGE(); } else { ?>{$LANGUAGE}<?php } ?>/" class="mob-img"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/copa-small.svg" title="copacobana" alt="copacobana" class="mob-img"/></a>
            <div class="mobile-menu">
              <a class="target-burger">
                <ul class="buns">
                  <li class="bun"></li>
                  <li class="bun"></li>
                </ul>
                <p class="menu-text-mobile">Menu</p>
              </a>
            </div>
        </div>
        <div class="row collapse navbar-collapse navigation" id="navigationbar">
          <div class="col-sm-7 location">
            <p>
              <?php if(array_key_exists('lblFestivalDate', (array) $this->variables)) { echo $this->variables['lblFestivalDate']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFestivalDate')) { echo $this->variables->getLblFestivalDate(); } else { ?>{$lblFestivalDate}<?php } ?><br /> <a href="https://www.google.be/maps/place/S%26R+Rozebroeken/@51.0596485,3.7587856,17z/data=!3m1!4b1!4m5!3m4!1s0x47c376c156ac8097:0xd16c48285d5edaca!8m2!3d51.0596451!4d3.7609796" target="_blank"><?php if(array_key_exists('lblFestivalLocation', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFestivalLocation']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFestivalLocation')) { echo SpoonFilter::ucfirst($this->variables->getLblFestivalLocation()); } else { ?>{$lblFestivalLocation|ucfirst}<?php } ?></a>
            </p>
          </div>
          <div class="col-sm-5">
              <div class="pull-right">
                  <ul class="social">
                      <li><a href="/nl/" class="lang-nl-active">NL</a> |</li>
                      <li>&nbsp;<a href="/fr/" class="lang-fr-active">FR</a> |</li>
                      <li>&nbsp;<a href="/en/" class="lang-en-active">EN</a></li>
                      <li class="facebook"><a href="<?php if(array_key_exists('lblFestivalFb', (array) $this->variables)) { echo $this->variables['lblFestivalFb']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFestivalFb')) { echo $this->variables->getLblFestivalFb(); } else { ?>{$lblFestivalFb}<?php } ?>" target="_blank"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/facebook.svg" title="facebook" alt="facebook"/></a></li>
                      <li class="twitter"><a href="<?php if(array_key_exists('lblFestivalTwitter', (array) $this->variables)) { echo $this->variables['lblFestivalTwitter']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFestivalTwitter')) { echo $this->variables->getLblFestivalTwitter(); } else { ?>{$lblFestivalTwitter}<?php } ?>" target="_blank"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/twitter.svg" title="twitter" alt="twitter"/></a></li>
                      <li class="instagram"><a href="<?php if(array_key_exists('lblFestivalInstagram', (array) $this->variables)) { echo $this->variables['lblFestivalInstagram']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFestivalInstagram')) { echo $this->variables->getLblFestivalInstagram(); } else { ?>{$lblFestivalInstagram}<?php } ?>" target="_blank"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/instagram.svg" title="instagram" alt="instagram"/></a></li>
                  </ul>
                  <div class="hamburger">
                    <div id="nav-icon">
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                    </div>
                    <p>menu</p>
                  </div>
              </div>
          </div>
        </div>
    </nav>

    <div class="container-fluid sub-nav box-shadow">
      <?php if(array_key_exists('var', (array) $this->variables)) { echo Frontend\Core\Engine\TemplateModifiers::getNavigation($this->variables['var'], 'page', 0, 1, 1, '/Core/Layout/Templates/Elements/Navigation.tpl'); } elseif(is_object($this->variables) && method_exists($this->variables, 'getVar')) { echo ""; throw new Exception('Variables in modifiers on objects are not supported.');; } else { ?>{$var|getnavigation:'page':0:1:1:'/Core/Layout/Templates/Elements/Navigation.tpl'}<?php } ?>
    </div>
</header>

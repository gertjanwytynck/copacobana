<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<header class="header box-shadow">
    <!-- Navigation -->
    <div class="container">
        <nav class="navbar " role="navigation">
            <div class="navbar-header">
                <a href="/" class="mob-img"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/copa-small.svg" title="copacobana" alt="copacobana" class="mob-img"/></a>
                <div class="mobile-hamburger">
                    <p class="menu-text-mobile">Menu</p>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigationbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

            </div>
            <div class="row collapse navbar-collapse navigation" id="navigationbar">
                <div class="col-sm-7 intro">
                    <a href="/"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/copa-small.svg" title="copacobana" alt="copacobana" /></a>
                    <p><?php if(array_key_exists('lblFestivalDate', (array) $this->variables)) { echo $this->variables['lblFestivalDate']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFestivalDate')) { echo $this->variables->getLblFestivalDate(); } else { ?>{$lblFestivalDate}<?php } ?><br /><?php if(array_key_exists('lblFestivalLocation', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFestivalLocation']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFestivalLocation')) { echo $this->variables->getLblFestivalLocation(); } else { ?>{$lblFestivalLocation|ucfirst}<?php } ?></p>
                </div>
                <div class="col-sm-5">
                    <div class="pull-right">
                        <ul class="social">
                            <li><?php if(array_key_exists('lblFestivalHashtag', (array) $this->variables)) { echo $this->variables['lblFestivalHashtag']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFestivalHashtag')) { echo $this->variables->getLblFestivalHashtag(); } else { ?>{$lblFestivalHashtag}<?php } ?></li>
                            <li class="facebook"><a href="<?php if(array_key_exists('lblFestivalFb', (array) $this->variables)) { echo $this->variables['lblFestivalFb']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFestivalFb')) { echo $this->variables->getLblFestivalFb(); } else { ?>{$lblFestivalFb}<?php } ?>" target="_blank"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/facebook.svg" title="facebook" alt="facebook"/></a></li>
                            <li class="twitter"><a href="<?php if(array_key_exists('lblFestivalTwitter', (array) $this->variables)) { echo $this->variables['lblFestivalTwitter']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFestivalTwitter')) { echo $this->variables->getLblFestivalTwitter(); } else { ?>{$lblFestivalTwitter}<?php } ?>" target="_blank"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/twitter.svg" title="twitter" alt="twitter"/></a></li>
                             <li class="instagram"><a href="<?php if(array_key_exists('lblFestivalInstagram', (array) $this->variables)) { echo $this->variables['lblFestivalInstagram']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFestivalInstagram')) { echo $this->variables->getLblFestivalInstagram(); } else { ?>{$lblFestivalInstagram}<?php } ?>" target="_blank"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/instagram.svg" title="instagram" alt="instagram"/></a></li>
                        </ul>
                        <ul class="nav navbar-nav menu-box">
                            <li class="menu">
                                <input type="checkbox" class="menu-open" name="menu-open" id="menu-open"/>
                                <label class="menu-open-button" for="menu-open">
                                    <span class="bar bar-1"></span>
                                    <span class="bar bar-2"></span>
                                    <span class="bar bar-3"></span>
                                    <div class="menu-text">
                                        <p>Menu</p>
                                    </div>
                                </label>
                                <div class="container-fluid sub-nav box-shadow">
                                    <?php if(array_key_exists('var', (array) $this->variables)) { echo Frontend\Core\Engine\TemplateModifiers::getNavigation($this->variables['var'], 'page', 0, 1, 1, '/Core/Layout/Templates/Elements/Navigation.tpl'); } elseif(is_object($this->variables) && method_exists($this->variables, 'getVar')) { echo $this->variables->getVar(); } else { ?>{$var|getnavigation:'page':0:1:1:'/Core/Layout/Templates/Elements/Navigation.tpl'}<?php } ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

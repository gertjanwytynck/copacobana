<header>
    <div class="top-bar"></div>
    <div class="copa-intro">
      <a href="/">
        <img src="{$THEME_URL}/Core/Layout/images/copa-small.svg" title="copacobana" alt="copacobana" />
      </a>
    </div>
    <nav class="navbar" role="navigation">
        <div class="navbar-header">
            <a href="/" class="mob-img"><img src="{$THEME_URL}/Core/Layout/images/copa-small.svg" title="copacobana" alt="copacobana" class="mob-img"/></a>
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
          <div class="col-sm-7 location">
            <p>
              <p>{$lblFestivalDate}<br /> {$lblFestivalLocation|ucfirst}</p>
            </p>
          </div>
          <div class="col-sm-5">
              <div class="pull-right">
                  <ul class="social">
                      <li>{$lblFestivalHashtag}</li>
                      <li class="facebook"><a href="{$lblFestivalFb}" target="_blank"><img src="{$THEME_URL}/Core/Layout/images/facebook.svg" title="facebook" alt="facebook"/></a></li>
                      <li class="twitter"><a href="{$lblFestivalTwitter}" target="_blank"><img src="{$THEME_URL}/Core/Layout/images/twitter.svg" title="twitter" alt="twitter"/></a></li>
                      <li class="instagram"><a href="{$lblFestivalInstagram}" target="_blank"><img src="{$THEME_URL}/Core/Layout/images/instagram.svg" title="instagram" alt="instagram"/></a></li>
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
      {$var|getnavigation:'page':0:1:1:'/Core/Layout/Templates/Elements/Navigation.tpl'}
    </div>
</header>

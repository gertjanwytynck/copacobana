<header>
    <div class="top-bar"></div>
    <div class="copa-intro">
      <a href="/{$LANGUAGE}/">
        <img src="{$THEME_URL}/Core/Layout/images/copa-small.svg" title="copacobana" alt="copacobana" />
      </a>
    </div>
    <nav class="navbar" role="navigation">
        <div class="navbar-header">
            <a href="/{$LANGUAGE}/" class="mob-img"><img src="{$THEME_URL}/Core/Layout/images/copa-small.svg" title="copacobana" alt="copacobana" class="mob-img"/></a>
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
              {$lblFestivalDate}<br /> <a href="https://www.google.be/maps/place/S%26R+Rozebroeken/@51.0596485,3.7587856,17z/data=!3m1!4b1!4m5!3m4!1s0x47c376c156ac8097:0xd16c48285d5edaca!8m2!3d51.0596451!4d3.7609796" target="_blank">{$lblFestivalLocation|ucfirst}</a>
            </p>
          </div>
          <div class="col-sm-5">
              <div class="pull-right">
                  <ul class="social">
                      <li><a href="/nl/">NL</a> |</li>
                      <li>&nbsp;<a href="/fr/">FR</a> |</li>
                      <li>&nbsp;<a href="/en/">EN</a></li>
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

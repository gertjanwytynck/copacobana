{include:Core/Layout/Templates/Partials/Head.tpl}

<body class="{$LANGUAGE}" itemscope itemtype="http://schema.org/WebPage">
{include:Core/Layout/Templates/Partials/Header.tpl}

<main class="contact">
    <section class="container">
        <div class="row">
            <div class="col-md-6">
              {iteration:positionMain}
              {$positionMain.blockContent}
              {/iteration:positionMain}
            </div>
            <div class="col-md-6 contact-information">
              <h2>
                Ledestraat 38<br/>
                9040 Sint-Amandsberg</br />
                België
              </h2>

              <h2>
                {$lblAnamma|ucfirst}<br / />
                BTW: {$lblBtwNumber}
              </h2>

              <ul class="social">
                  <li class="facebook"><a href="{$lblFestivalFb}" target="_blank"><img src="{$THEME_URL}/Core/Layout/images/facebook.svg" title="facebook" alt="facebook"/></a></li>
                  <li class="twitter"><a href="{$lblFestivalTwitter}" target="_blank"><img src="{$THEME_URL}/Core/Layout/images/twitter.svg" title="twitter" alt="twitter"/></a></li>
                  <li class="instagram"><a href="{$lblFestivalInstagram}" target="_blank"><img src="{$THEME_URL}/Core/Layout/images/instagram.svg" title="instagram" alt="instagram"/></a></li>
              </ul>
            </div>
        </div>
    </section>
</main>
<div id="map"></div>
<footer class="footer-dark">
    <a href="/"><img src="{$THEME_URL}/Core/Layout/images/copacobana-light.svg" title="copacobana" alt="copacobana" class="copa-footer" /></a>
    {include:Core/Layout/Templates/Partials/Footer.tpl}
</body>
</html>

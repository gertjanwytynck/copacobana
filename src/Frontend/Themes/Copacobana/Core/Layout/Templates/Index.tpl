{include:Core/Layout/Templates/Partials/Head.tpl}

<body class="{$LANGUAGE}" itemscope itemtype="http://schema.org/WebPage">
{include:Core/Layout/Templates/Partials/Header.tpl}

<main class="">
    <figure class="copacobana">
        <a href="{$FRONTEND_FILES_URL}/copacobana/copaboekje.pdf" target="_blank"><button class="btn-volunteer-header">{$lblProgamFolder|ucfirst}!</button></a>

        <div class="scroll-down">
          <a class="arrow-wrap" href="#content">
             <span class="arrow"></span>
           </a>
        </div>
    </figure>

    <section class="widget-artists cover-overflow">
      <div class="mobile-triggers">
        <div>
          <a class="practical-info-href-fix" href=""><button class="btn-mobile-trigger">{$lblPractical|ucfirst}</button></a>
        </div>
        <div>
          <a href="{$var|geturlforblock:'Festival'}/line-up"><button class="btn-mobile-trigger">{$lblTimeTable|ucfirst}</button></a>
        </div>
        <!-- <div>
          <a href=""><button class="btn-mobile-trigger">{$lblFestivalMap|ucfirst}</button></a>
        </div> -->
        <div>
          <a href="{$FRONTEND_FILES_URL}/copacobana/copaboekje.pdf" target="_blank"><button class="btn-mobile-trigger">{$lblProgamFolder|ucfirst}</button></a>
        </div>
      </div>

      <div class="container-fluid">
          {iteration:positionArtists}
              {$positionArtists.blockContent}
          {/iteration:positionArtists}
      </div>
    </section>

    <section class="pattern-dotty cover-overflow">
        <div class="intro container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 news">
                    {iteration:positionNews}
                        {$positionNews.blockContent}
                    {/iteration:positionNews}
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </section>

    <section class="video container-fluid">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
              {iteration:positionVideo}
                  {$positionVideo.blockContent}
              {/iteration:positionVideo}
          </div>
        </div>
    </section>
</main>

<div id="map"></div>

<footer class="footer-dark">
    <a href="/"><img src="{$THEME_URL}/Core/Layout/images/copacobana-light.svg" title="copacobana" alt="copacobana" class="copa-footer"/></a>
	{include:Core/Layout/Templates/Partials/Footer.tpl}
</body>
</html>

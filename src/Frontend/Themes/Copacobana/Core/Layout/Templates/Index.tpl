{include:Core/Layout/Templates/Partials/Head.tpl}

<body class="{$LANGUAGE}" itemscope itemtype="http://schema.org/WebPage">
{include:Core/Layout/Templates/Partials/Header.tpl}
<main class="">
    <figure class="copacobana">
        <!-- <a href="https://docs.google.com/forms/d/1FzA-sEjGNXUUJ35k5qabYRFbvOobKpwjTJoc0LjYPHU/viewform" target="_blank"><button class="btn-volunteer-header">{$lblBecomeVolunteer|ucfirst}!</button></a> -->
    </figure>

    <section class="widget-artists cover-overflow">
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

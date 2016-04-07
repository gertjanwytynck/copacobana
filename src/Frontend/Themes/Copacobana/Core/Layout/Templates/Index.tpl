{include:Core/Layout/Templates/Partials/Head.tpl}

<body class="{$LANGUAGE}" itemscope itemtype="http://schema.org/WebPage">
{include:Core/Layout/Templates/Partials/Header.tpl}
<main class="">
    <figure class="copacobana">
        <a href="https://docs.google.com/forms/d/1FzA-sEjGNXUUJ35k5qabYRFbvOobKpwjTJoc0LjYPHU/viewform" target="_blank"><button class="btn-volunteer-header">{$lblBecomeVolunteer|ucfirst}!</button></a>
    </figure>
    <section class="pattern-dotty cover-overflow">
        <div class="intro container">
            <div class="row">
                <div class="col-md-12  news">
                    {iteration:positionNews}
                        {$positionNews.blockContent}
                    {/iteration:positionNews}
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </section>
<!--     <section class="widget-artists">
        <div class="container">
            {iteration:positionArtists}
                {$positionArtists.blockContent}
            {/iteration:positionArtists}
        </div>
    </section> -->
    <section class="video">
        <div class="container">
            <div class="row scheetjesvlieger">
                <div class="col-md-8 col-md-offset-2">
                    <div class="sterrenketting"></div>
                    {iteration:positionVideo}
                        {$positionVideo.blockContent}
                    {/iteration:positionVideo}
                </div>
               <img src="{$THEME_URL}/Core/Layout/images/scheetjesvlieger.png" title="copacobana" alt="copacobana" class="img-s"/>
            </div>
        </div>
    </section>
</main>

<footer class="footer-dark">
    <a href="/"><img src="{$THEME_URL}/Core/Layout/images/copacobana-light.png" title="copacobana" alt="copacobana" class="copa-footer"/></a>
	{include:Core/Layout/Templates/Partials/Footer.tpl}
</body>
</html>
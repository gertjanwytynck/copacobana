{include:Core/Layout/Templates/Partials/Head.tpl}

<body class="{$LANGUAGE}" itemscope itemtype="http://schema.org/WebPage">
{include:Core/Layout/Templates/Partials/Header.tpl}

<main class="default bg-pattern-dark">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                {iteration:positionContent}
                    {$positionContent.blockContent}
                {/iteration:positionContent}
            </div>
        </div>
    </section>
</main>
<section class="default artist-random">
   <section class="widget-artists">
        <div class="container">
            {iteration:positionArtists}
                {$positionArtists.blockContent}
            {/iteration:positionArtists}
        </div>
    </section>
</section>
<footer>
    <a href="/"><img src="{$THEME_URL}/Core/Layout/images/copacobana.png" title="copacobana" alt="copacobana" class="copa-footer" /></a>
    {include:Core/Layout/Templates/Partials/Footer.tpl}
</body>
</html>
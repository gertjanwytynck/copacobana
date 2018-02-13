{include:Core/Layout/Templates/Partials/Head.tpl}

<body class="{$LANGUAGE}" itemscope itemtype="http://schema.org/WebPage">
{include:Core/Layout/Templates/Partials/Header.tpl}

{$var|getartistmenu:"Artist"}

<main class="default wid">
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
        <div class="container-fluid">
            {iteration:positionArtists}
                {$positionArtists.blockContent}
            {/iteration:positionArtists}
        </div>
    </section>
</section>
<footer>
    <a href="/"><img src="{$THEME_URL}/Core/Layout/images/copacobana.svg" title="copacobana" alt="copacobana" class="copa-footer" /></a>
    {include:Core/Layout/Templates/Partials/Footer.tpl}
</body>
</html>

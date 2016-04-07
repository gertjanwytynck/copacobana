{include:Core/Layout/Templates/Partials/Head.tpl}

<body class="{$LANGUAGE}" itemscope itemtype="http://schema.org/WebPage">
{include:Core/Layout/Templates/Partials/Header.tpl}

<main class="sitemap">
    <section class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>{$page.title}</h1>
                {iteration:positionMain}
                    {$positionMain.blockContent}
                {/iteration:positionMain}

                <img src="{$THEME_URL}/Core/Layout/images/img-pizza.png" alt="sitemap"/>
            </div>
        </div>
    </section>
</main>
<footer>
    <a href="/"><img src="{$THEME_URL}/Core/Layout/images/copacobana.png" title="copacobana" alt="copacobana" class="copa-footer" /></a>
    {include:Core/Layout/Templates/Partials/Footer.tpl}
</body>
</html>
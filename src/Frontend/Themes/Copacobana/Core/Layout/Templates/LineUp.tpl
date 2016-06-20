{include:Core/Layout/Templates/Partials/Head.tpl}

<body class="{$LANGUAGE}" itemscope itemtype="http://schema.org/WebPage">
{include:Core/Layout/Templates/Partials/Header.tpl}

{$var|getartistmenu:"Artist"}

<main class="line-up-page bg-blue">
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
<footer class="footer-dark">
    <a href="/"><img src="{$THEME_URL}/Core/Layout/images/copacobana-light.png" title="copacobana" alt="copacobana" class="copa-footer" /></a>
    {include:Core/Layout/Templates/Partials/Footer.tpl}
</body>
</html>
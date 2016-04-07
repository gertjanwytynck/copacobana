{include:Core/Layout/Templates/Partials/Head.tpl}

<body class="{$LANGUAGE}" itemscope itemtype="http://schema.org/WebPage">
{include:Core/Layout/Templates/Partials/Header.tpl}

<main class="default">
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
<footer>
    <a href="/"><img src="{$THEME_URL}/Core/Layout/images/copacobana.png" title="copacobana" alt="copacobana" class="copa-footer" /></a>
    {include:Core/Layout/Templates/Partials/Footer.tpl}
</body>
</html>
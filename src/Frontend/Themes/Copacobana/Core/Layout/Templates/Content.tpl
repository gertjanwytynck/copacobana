{include:Core/Layout/Templates/Partials/Head.tpl}

<body class="{$LANGUAGE}" itemscope itemtype="http://schema.org/WebPage">
{include:Core/Layout/Templates/Partials/Header.tpl}

<main id="tplContent">
    <section class="container">
        <div class="row">
            <div class="col-md-6">
                {iteration:positionTopLeft}
                    {$positionTopLeft.blockContent}
                {/iteration:positionTopLeft}
            </div>
            <div class="col-md-6">
                {iteration:positionTopRight}
                    {$positionTopRight.blockContent}
                {/iteration:positionTopRight}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mob-hide">
                {iteration:positionBottomLeft}
                    {$positionBottomLeft.blockContent}
                {/iteration:positionBottomLeft}
            </div>
            <div class="col-md-6">
                {iteration:positionBottomRight}
                    {$positionBottomRight.blockContent}
                {/iteration:positionBottomRight}
            </div>
        </div>
    </section>
</main>
<footer class="footer-dark">
    <a href="/"><img src="{$THEME_URL}/Core/Layout/images/copacobana-light.svg" title="copacobana" alt="copacobana" class="copa-footer"/></a>
    {include:Core/Layout/Templates/Partials/Footer.tpl}
</body>
</html>

{include:Core/Layout/Templates/Partials/Head.tpl}

<body class="{$LANGUAGE}" itemscope itemtype="http://schema.org/WebPage">
{include:Core/Layout/Templates/Partials/Header.tpl}

<main id="tplContent" class="practical">
    <section class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-md-5">
                        {iteration:positionTopLeft}
                        {$positionTopLeft.blockContent}
                        {/iteration:positionTopLeft}
                    </div>
                    <div class="col-md-6 p-l">
                        {iteration:positionTopRight}
                        {$positionTopRight.blockContent}
                        {/iteration:positionTopRight}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-r">
                        {iteration:positionSubTopLeft}
                        {$positionSubTopLeft.blockContent}
                        {/iteration:positionSubTopLeft}
                    </div>
                    <div class="col-md-5">
                        {iteration:positionSubTopRight}
                            {$positionSubTopRight.blockContent}
                        {/iteration:positionSubTopRight}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        {iteration:positionSubBottomLeft}
                        {$positionSubBottomLeft.blockContent}
                        {/iteration:positionSubBottomLeft}
                    </div>
                    <div class="col-md-6 p-l">
                        {iteration:positionSubBottomRight}
                        {$positionSubBottomRight.blockContent}
                        {/iteration:positionSubBottomRight}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 p-r">
                        {iteration:positionBottomLeft}
                        {$positionBottomLeft.blockContent}
                        {/iteration:positionBottomLeft}
                    </div>
                    <div class="col-md-5">
                        {iteration:positionBottomRight}
                        {$positionBottomRight.blockContent}
                        {/iteration:positionBottomRight}
                    </div>
                </div>
            </div>
        </div>

    </section>
</main>
<div id="mappie"></div>
<footer class="footer-dark">
    <a href="/"><img src="{$THEME_URL}/Core/Layout/images/copacobana-light.png" title="copacobana" alt="copacobana" class="copa-footer"/></a>
    {include:Core/Layout/Templates/Partials/Footer.tpl}
</body>
</html>
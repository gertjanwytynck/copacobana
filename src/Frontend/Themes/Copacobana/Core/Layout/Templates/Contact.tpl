{include:Core/Layout/Templates/Partials/Head.tpl}

<body class="{$LANGUAGE}" itemscope itemtype="http://schema.org/WebPage">
{include:Core/Layout/Templates/Partials/Header.tpl}

<main class="contact default">
    <section class="container">
        <div class="row">

            <div class="col-md-5 col-md-offset-1">
                {iteration:positionMain}
                    {$positionMain.blockContent}
                {/iteration:positionMain}
            </div>
                <div class="col-md-2">
                <img src="{$THEME_URL}/Core/Layout/images/moeder-kind.png" title="moeder-kind" alt="moeder-kind" class="moeder-kind"/>
            </div>

        </div>
    </section>
</main>
<div id="mappie"></div>
<footer class="footer-dark">
    <a href="/"><img src="{$THEME_URL}/Core/Layout/images/copacobana-light.svg" title="copacobana" alt="copacobana" class="copa-footer" /></a>
    {include:Core/Layout/Templates/Partials/Footer.tpl}
</body>
</html>

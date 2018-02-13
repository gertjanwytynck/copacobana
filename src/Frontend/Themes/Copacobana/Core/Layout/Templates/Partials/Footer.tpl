{* Footer Content *}
{include:Core/Layout/Templates/Elements/FooterContent.tpl}

{* General Javascript *}
{iteration:jsFiles}
	<script src="{$jsFiles.file}"></script>
{/iteration:jsFiles}

{* Theme specific Javascript *}
<script src="{$THEME_URL}/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{$THEME_URL}/vendor/session/session.js"></script>
<script src="{$THEME_URL}/Core/Js/jquery.lazyloadxt.min.js"></script>
<script src="{$THEME_URL}/Core/Js/jquery.lazyloadxt.extra.min.js"></script>
<script src="{$THEME_URL}/Core/Js/copacobana.js"></script>

{* Site wide HTML *}
{$siteHTMLFooter}

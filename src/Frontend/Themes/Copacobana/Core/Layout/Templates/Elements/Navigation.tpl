<ul>
    {option:navigation}
    {iteration:navigation}
        <li class="{option:navigation.selected}active{/option:navigation.selected}">
            <a href="{$navigation.link}" {option:navigation.nofollow} rel="nofollow"{/option:navigation.nofollow}>{$navigation.navigation_title}</a>
        </li>
    {/iteration:navigation}
    {/option:navigation}
</ul>

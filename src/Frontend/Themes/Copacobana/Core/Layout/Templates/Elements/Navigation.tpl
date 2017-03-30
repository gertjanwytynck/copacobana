<ul>
    {option:navigation}
    {iteration:navigation}
        <li class="{option:navigation.selected}active{/option:navigation.selected}">
            <a href="{$navigation.link}" {option:navigation.nofollow} rel="nofollow"{/option:navigation.nofollow}>{$navigation.navigation_title}</a>
        </li>
    {/iteration:navigation}
    {/option:navigation}
    <li class="mobile-location">
      <a href="https://www.google.be/maps/place/S%26R+Rozebroeken/@51.0596485,3.7587856,17z/data=!3m1!4b1!4m5!3m4!1s0x47c376c156ac8097:0xd16c48285d5edaca!8m2!3d51.0596451!4d3.7609796" target="_blank">{$lblFestivalDate}<br />{$lblFestivalLocation|ucfirst}</a>
    </li>
</ul>

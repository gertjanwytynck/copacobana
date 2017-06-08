{option:menuItems}
<div class="sub-nav-artists">
  <ul class="container">
    <li class="all"><a href="{$var|geturlforblock:'Festival'}">ABC</a></li>
    <li class="line-up"><a href="{$var|geturlforblock:'Festival'}/line-up" >{$lblTimeTable}</a></li>
    <li class="friday"><a href="{$var|geturlforblock:'Festival'}/{$lblFriday}" >{$lblFriday|ucfirst}</a></li>
    <li class="saturday"><a href="{$var|geturlforblock:'Festival'}/{$lblSaturday}" >{$lblSaturday|ucfirst}</a></li>
    <li class="sunday"><a href="{$var|geturlforblock:'Festival'}/{$lblSunday}" >{$lblSunday|ucfirst}</a></li>
    <!-- <li><a href="{$THEME_URL}/Core/Layout/images/copacobanaboekje.pdf" target="_blank" class="download-prog">Programma boekje</a></li> -->
  </ul>
</div>
{/option:menuItems}

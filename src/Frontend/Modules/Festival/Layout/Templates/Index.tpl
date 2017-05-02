{*
	variables that are available:
	- {items}: contains an array with all the artists
*}

<div class="artists">
<!--     <a href="{$var|geturlforblock:'Festival':'LineUp'}" class="line-up text-center">Bekijk overzicht</a>
 -->
    <ul id="" class="row og-grid">
        {iteration:artists}
          <li>
            <a href="">
              <figure>
                  <img data-src="{$FRONTEND_FILES_URL}/festival/artists/covers/x330/{$artists.cover}" alt=""
                       title="{$artists.name}"/>
              </figure>
              <p class="artist-name">{$artists.name}<br /><span>{$artists.day}<span></p>
              <!-- <p class="more">More info &#10095;</p> -->
            </a>
          </li>
      {/iteration:artists}
    </ul>
</div>

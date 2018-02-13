{*
	variables that are available:
	- {items}: contains an array with all the artists
*}

<div class="artists">
    <ul id="" class="row og-grid">
        {iteration:artists}
          <li>
            <a href="{$artists.full_url}">
              <figure>
                  <img data-src="{$FRONTEND_FILES_URL}/festival/artists/covers/x330/{$artists.cover}" alt=""
                       title="{$artists.name}"/>
              </figure>
              <p class="artist-name">{$artists.name}<br /><span>{$artists.day}<span></p>
              <p class="more">{$lblMoreInfo|ucfirst} &#10095;</p>
            </a>
          </li>
      {/iteration:artists}
    </ul>
</div>

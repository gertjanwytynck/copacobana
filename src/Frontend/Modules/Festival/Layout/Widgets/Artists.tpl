{*
	variables that are available:
	- {widgetArtists}: contains an array with all the artists
*}

{option:widgetArtists}
    <ul id="" class="row og-grid">
      {iteration:widgetArtists}
          <li>
            <a href="{$widgetArtists.full_url}">
              <figure>
                  <img data-src="{$FRONTEND_FILES_URL}/festival/artists/covers/x330/{$widgetArtists.cover}"
                    alt="{$widgetArtists.name}"
                    title="{$widgetArtists.name}" />
              </figure>
              <p class="artist-name">{$widgetArtists.name}<br /><span>{$widgetArtists.day}<span></p>
              <p class="more">{$lblMoreInfo|ucfirst} &#10095;</p>
            </a>
          </li>
      {/iteration:widgetArtists}
    </ul>
    <div class="row">
      <div class="col-sm-12">
        <div class="btn-all-artists">
          <a href="{$var|geturlforblock:'Festival'}">{$lblViewAllArtists|ucfirst}</a>
        </div>
      </div>
    </div>
{/option:widgetArtists}

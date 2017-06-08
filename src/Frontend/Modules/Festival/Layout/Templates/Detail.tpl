{*
  variables that are available:
  - {$artist}: contains data about the artist
  - {$settings}: contains the news module settings
*}

<div id="artistDetail">
    <article class="artist">
        <div class="row">
            <div class="col-md-8">
                <div class="img-block">
                  <img src="{$FRONTEND_FILES_URL}/festival/artists/covers/source/{$artist.cover}" />
                </div>

                <div class="artist-bio">
                    {option:artist.website.0.bio}
                      <h2>{$lblBio|ucfirst} {$artist.name}</h2>
                      {$artist.website.0.bio}
                    {/option:artist.website.0.bio}
                </div>
            </div>
            <div class="col-md-4 content-block">
                <h1>{$artist.name}</h1>
                <p class="artist-genre">{$artist.date.0.category.category}</p>
                <div class="artist-dates">
                  {iteration:dates}
                      <p>{$lblStage|ucfirst}: <strong>{$dates.stage}</strong></p>
                      <p>{$lblDate|ucfirst}: <strong>{$dates.date|ucfirst} {$dates.time}</strong></p>
                  {/iteration:dates}
                </div>
                <div class="artist-social">
                    {option:artist.website.0.facebookUrl}
                    <a href="{$artist.website.0.facebookUrl}" target="_blank">
                        <img src="{$THEME_URL}/Core/Layout/images/social-fb-front.svg" class="svg" title="facebook" alt="facebook"/>
                    </a>
                    {/option:artist.website.0.facebookUrl}
                    {option:artist.website.0.twitterUrl}
                    <a href="{$artist.website.0.twitterUrl}" target="_blank">
                        <img src="{$THEME_URL}/Core/Layout/images/social-front-twitter.svg" class="svg" title="twitter" alt="twitter"/>
                    </a>
                    {/option:artist.website.0.twitterUrl}
                    {option:artist.website.0.youtubeUrl}
                    <a href="{$artist.website.0.youtubeUrl}" target="_blank">
                        <img src="{$THEME_URL}/Core/Layout/images/social-front-youtube.svg" class="svg" title="youtube" alt="youtube"/>
                    </a>
                    {/option:artist.website.0.youtubeUrl}
                    {option:artist.website.0.soundcloudUrl}
                    <a href="{$artist.website.0.soundcloudUrl}" target="_blank">
                        <img src="{$THEME_URL}/Core/Layout/images/social-front-soundcloud.svg" class="svg" title="soundcloud" alt="soundcloud"/>
                    </a>
                    {/option:artist.website.0.soundcloudUrl}
                    {option:artist.website.0.instagramUrl}
                    <a href="{$artist.website.0.instagramUrl}" target="_blank">
                        <img src="{$THEME_URL}/Core/Layout/images/social-front-instagram.svg" class="svg" title="instagram" alt="instagram"/>
                    </a>
                    {/option:artist.website.0.instagramUrl}
                    {option:artist.website.0.websiteUrl}
                    <a href="{$artist.website.0.websiteUrl}" target="_blank">
                        <img src="{$THEME_URL}/Core/Layout/images/social-front-www.svg" class="svg" title="website" alt="website"/>
                    </a>
                    {/option:artist.website.0.websiteUrl}
                </div>

                {option:artist.website.0.soundcloudUrl}
                    <div class="sound-cloud-webplayer">
                    <iframe width="100%" height="130" scrolling="yes" frameborder="no" src="https://w.soundcloud.com/player/?url={$artist.website.0.soundcloudUrl}&amp;color=eec155&amp;auto_play=false&amp;hide_related=false&amp;show_comments=false&amp;show_user=true&amp;show_reposts=false"></iframe>
                    </div>
                {/option:artist.website.0.soundcloudUrl}

                <div class="share">
                  <div class="fb-share-button" data-href="{$artist.full_url}" data-layout="button_count"></div>
                  <div class="tweet">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-via="CopacobanaFest">Tweet</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

                  </div>
                </div>
            </div>
        </div>

    </article>
</div>

{*
	variables that are available:
	- {$item}: contains data about the news article
	- {$settings}: contains the news module settings
*}

<div id="newsDetail">
    {option:item.prev_url}
        <a href="{$item.prev_url}"><div class="prev"></div></a>
    {/option:item.prev_url}
    {option:item.next_url}
        <a href="{$item.next_url}"><div class="next"></div></a>
    {/option:item.next_url}

	<article class="mod article row">
		<div class="inner col-md-10 col-md-offset-1">
            <div class="row">
                <header class="hd col-md-5">
                    {* article title *}

                    {option:item.youtube_url}
                        <div class="youtube">
                            <iframe src="{$item.youtube_url}" frameborder="0" allowfullscreen></iframe>
                            <div class="clear"></div>
                        </div>
                    {/option:item.youtube_url}
                    {option:!item.youtube_url}
                    {option:settings.cover_image_enabled}
                        {option:item.cover_image}
                            <ul class="image-box ">
                                <li class="slide-img fancybox" href="{$FRONTEND_FILES_URL}/news/covers/400x400/{$item.cover_image}"  data-fancybox-group="group">
                                    <img src="{$FRONTEND_FILES_URL}/news/covers/400x400/{$item.cover_image}" alt="{$item.title}"/>
                                </li>
                            </ul>

                        {/option:item.cover_image}
                    {/option:settings.cover_image_enabled}
                    {/option:!item.youtube_url}

                    <ul class="image-box ">
                        {* optional feature: multi images *}
                        {option:settings.multi_images_enabled}
                        {option:item.images}
                        {iteration:item.images}
                            <li class="slide-img fancybox"  href="{$FRONTEND_FILES_URL}/news/images/800x/{$item.images.filename}"  data-fancybox-group="group">
                                <img src="{$FRONTEND_FILES_URL}/news/images/dataGrid/{$item.images.filename}" {option:item.images.title}alt="{$item.images.title}"{/option:item.images.title} />
                            </li>
                        {/iteration:item.images}
                        {/option:item.images}
                        {/option:settings.multi_images_enabled}
                    </ul>
                </header>
                <div class="bd content col-md-7">
                    {option:item.tags}
                        <div class="tags">
                            {iteration:item.tags}
                                <p>#{$item.tags.name}</p>
                            {/iteration:item.tags}
                        </div>
                    {/option:item.tags}
                    <h1>{$item.title}</h1>
                    <h2>{$item.publish_on|date:'d/m/Y':{$LANGUAGE}|ucfirst}</h2>
                    {$item.content}

                    <div class="share">
                        <div class="fb-share-button" data-href="{$item.full_url}" data-layout="button_count"></div>
                        <div class="tweet">
                            <a href="https://twitter.com/share" class="twitter-share-button" data-via="CopacobanaFest">Tweet</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

                        </div>
                      </div>
                </div>
            </div>
		</div>
	</article>
</div>
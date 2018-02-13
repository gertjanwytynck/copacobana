{*
	variables that are available:
	- {$items}: contains all articles
	- {$settings}: contains the news module settings
*}
{option:!items}
	<div id="faqIndex">
		<section class="mod">
			<div class="row">
				<div class="col-md-12 content">
					<p>{$msgNewsNoItems}</p>
				</div>
			</div>
		</section>
	</div>
{/option:!items}

{option:items}
	<section id="newsItemsIndex">
        {iteration:items}
            <article class="col-md-3">
                <div class="inner">
                    <header class="hd">
                        {option:items.cover_image}
                            <img src="{$FRONTEND_FILES_URL}/news/covers/400x400/{$items.cover_image}" alt="{$items.title}" />
                        {/option:items.cover_image}
                        <div class="hover-box">
                            <a href="{$items.full_url}"><div class="hover-box-outer">
                                    <div class="hover-box-inner">
                                        <h4>{$items.publish_on|date:'d/m/Y':{$LANGUAGE}|ucfirst}</h4>
                                        {option:items.tags}
                                            <div class="tags">
                                                {iteration:items.tags}
                                                    <p>#{$items.tags.name}</p>
                                                {/iteration:items.tags}
                                            </div>
                                        {/option:items.tags}
                                    </div>
                                </div></a>
                        </div>
                    </header>
                    <div class="bd content">
                        <h3><a href="{$items.full_url}" title="{$items.title}">{$items.title}</a></h3>
                        <p class="text">{$items.content|truncate:200:true:true}<br /><a href="{$items.full_url}" class="rm">{$lblReadMore|ucfirst}</a></p>
                    </div>
                </div>
            </article>
        {/iteration:items}
	</section>

{*
	{include:Core/Layout/Templates/Pagination.tpl}
*}
{/option:items}

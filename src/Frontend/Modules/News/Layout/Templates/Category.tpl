{*
	variables that are available:
	- {$category}: contains data about the category
	- {$items}: contains an array with all articles, each element contains data about the article
	- {$settings}: contains the news module settings
*}
{option:items}
	<section id="newsCategory">
		{iteration:items}
			<article class="mod article">
				<div class="inner">
					<header class="hd">
						<h3><a href="{$items.full_url}" title="{$items.title}">{$items.title}</a></h3>
						<ul>
							<li>
								{* written on *}
								{$lblOn} {$items.publish_on|date:{$dateFormatLong}:{$LANGUAGE}}

								{* category*}
								{$lblIn} {$lblThe} {$lblCategory} <a href="{$items.category_full_url}" title="{$items.category_title}">{$items.category_title}</a>{option:!items.tags}.{/option:!items.tags}

								{* tags*}
								{option:items.tags}
									{$lblWith} {$lblThe} {$lblTags}
									{iteration:items.tags}
										<a href="{$items.tags.full_url}" rel="tag" title="{$items.tags.name}">{$items.tags.name}</a>{option:!items.tags.last}, {/option:!items.tags.last}{option:items.tags.last}.{/option:items.tags.last}
									{/iteration:items.tags}
								{/option:items.tags}
							</li>
						</ul>
					</header>
					<div class="bd content">
						{* optional feature: cover image *}
						{option:settings.cover_image_enabled}
							{option:items.cover_image}
								<img src="{$FRONTEND_FILES_URL}/news/covers/source/{$items.cover_image}" alt="{$items.title}" width="50%" />
							{/option:items.cover_image}
						{/option:settings.cover_image_enabled}

						<p>
							{$items.content|truncate:400:true:true}
						</p>
					</div>
				</div>
			</article>
		{/iteration:items}
	</section>
	{include:Core/Layout/Templates/Pagination.tpl}
{/option:items}

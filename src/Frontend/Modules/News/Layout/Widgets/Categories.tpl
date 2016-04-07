{*
	variables that are available:
	- {$widgetNewsCategories}:
*}

{option:widgetNewsCategories}
	<section id="newsCategoriesWidget" class="mod">
		<div class="inner">
			<header class="hd">
				<h3>{$lblCategories|ucfirst}</h3>
			</header>
			<div class="bd content">
				<ul>
					{iteration:widgetNewsCategories}
						<li>
							<a href="{$var|geturlforblock:'News':'Category'}/{$widgetNewsCategories.url}">
								{$widgetNewsCategories.title})
							</a>
						</li>
					{/iteration:widgetNewsCategories}
				</ul>
			</div>
		</div>
	</section>
{/option:widgetNewsCategories}
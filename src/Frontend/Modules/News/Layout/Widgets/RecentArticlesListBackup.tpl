{*
	variables that are available:
	- {$widgetNewsRecentArticlesList}: contains an array with all recent articles, each element contains data about the article
*}

        {option:widgetNewsRecentArticlesList}
            <section class="carousel carousel-widget" data-interval="6000" data-ride="carousel-widget" id="carousel-widget">
                <!-- Carousel items -->
                <div class="carousel-inner">
                    {iteration:widgetNewsRecentArticlesList}
                        <article class="row item {option:widgetNewsRecentArticlesList.first}active{/option:widgetNewsRecentArticlesList.first}">
                            <div class="col-sm-4 news-img">
                                <div class="">
                                    <a href="{$widgetNewsRecentArticlesList.full_url}"><img src="{$FRONTEND_FILES_URL}/news/covers/400x400/{$widgetNewsRecentArticlesList.cover_image}" alt="{$widgetNewsRecentArticlesList.title}" /></a>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <h1>{$widgetNewsRecentArticlesList.title}</h1>
                                <h2>{$widgetNewsRecentArticlesList.publish_on|date:'d/m/Y':{$LANGUAGE}|ucfirst}</h2>
                                <p>{$widgetNewsRecentArticlesList.content|truncate:650:true:true}</p>
                                <p class="rm"><a href="{$widgetNewsRecentArticlesList.full_url}">Lees meer</a></p>
                            </div>
                        </article>
                    {/iteration:widgetNewsRecentArticlesList}
                </div>
                <!-- Indicators -->
                <ol class="carousel-indicators carousel-widget-indicators">
                    {iteration:widgetNewsRecentArticlesList}
                        <li data-target="#carousel-widget" data-slide-to="{$widgetNewsRecentArticlesList.dataSlide}" class="{option:widgetNewsRecentArticlesList.first}active{/option:widgetNewsRecentArticlesList.first}"></li>
                    {/iteration:widgetNewsRecentArticlesList}
                </ol>
            </section>
        {/option:widgetNewsRecentArticlesList}

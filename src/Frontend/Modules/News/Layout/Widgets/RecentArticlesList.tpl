{*
  variables that are available:
  - {$widgetNewsRecentArticlesList}: contains an array with all recent articles, each element contains data about the article
*}

{option:widgetNewsRecentArticlesList}

    <div class="row">
        <div class="col-md-12 text-center vers-pers">
            <img src="{$THEME_URL}/Core/Layout/images/vers-van-de-pers.svg" title="vers-van-de-pers" alt="vers-van-de-pers"  class=""/>
        </div>
    </div>

    <div class="row">
<!--     <hr class="index-hr">
 -->    {iteration:widgetNewsRecentArticlesList}
        <article class="col-sm-4 item">
            <div class="news-img{option:widgetNewsRecentArticlesList.first}active{/option:widgetNewsRecentArticlesList.first}">
                <a href="{$widgetNewsRecentArticlesList.full_url}"><img src="{$FRONTEND_FILES_URL}/news/covers/400x400/{$widgetNewsRecentArticlesList.cover_image}" alt="{$widgetNewsRecentArticlesList.title}" /></a>
            </div>
            <div class="news-content">
                <h2>{$widgetNewsRecentArticlesList.publish_on|date:'d/m/Y':{$LANGUAGE}|ucfirst}</h2>
                <h1>{$widgetNewsRecentArticlesList.title}</h1>
                <p>{$widgetNewsRecentArticlesList.content|truncate:150:true:true}</p>
                <p class="read-more"><a href="{$widgetNewsRecentArticlesList.full_url}">Lees meer <span>&#10095;</span></a></p>
            </div>
        </article>
    {/iteration:widgetNewsRecentArticlesList}
        <div class="col-sm-12"><div class="btn-all-news"><a href="/nl/nieuws">Bekijk alle nieuwsitems</a></div></div>
    </div>
{/option:widgetNewsRecentArticlesList}

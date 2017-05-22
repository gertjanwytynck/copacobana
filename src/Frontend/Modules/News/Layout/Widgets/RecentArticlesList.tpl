{*
  variables that are available:
  - {$widgetNewsRecentArticlesList}: contains an array with all recent articles, each element contains data about the article
*}

{option:widgetNewsRecentArticlesList}
    <div class="row">
      {iteration:widgetNewsRecentArticlesList}
        <article class="col-sm-12 item">
            <div class="news-img col-sm-4">
                <a href="{$widgetNewsRecentArticlesList.full_url}"><img src="{$FRONTEND_FILES_URL}/news/covers/400x400/{$widgetNewsRecentArticlesList.cover_image}" alt="{$widgetNewsRecentArticlesList.title}" /></a>
            </div>
            <div class="news-content col-sm-8">
                <h2><a href="{$widgetNewsRecentArticlesList.full_url}">{$widgetNewsRecentArticlesList.publish_on|date:'d/m/Y':{$LANGUAGE}|ucfirst} | <span class="latest-news">{$lblLatestNews|ucfirst}</span></a></h2>
                <h1><a href="{$widgetNewsRecentArticlesList.full_url}">{$widgetNewsRecentArticlesList.title}</a></h1>
                <p><a href="{$widgetNewsRecentArticlesList.full_url}">{$widgetNewsRecentArticlesList.content|truncate:550:true:true}</a></p>
                <div class="btn-all-news">
                  <a href="{$var|geturlforblock:'News'}">{$lblAllNewsItems|ucfirst}</a>
                </div>
            </div>
        </article>
      {/iteration:widgetNewsRecentArticlesList}
    </div>
{/option:widgetNewsRecentArticlesList}

<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>


<?php
						if(isset($this->variables['widgetNewsRecentArticlesList']) && count($this->variables['widgetNewsRecentArticlesList']) != 0 && $this->variables['widgetNewsRecentArticlesList'] != '' && $this->variables['widgetNewsRecentArticlesList'] !== false)
						{
							?>

    <div class="row">
        <div class="col-md-12 text-center vers-pers">
            <img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/vers-van-de-pers.svg" title="vers-van-de-pers" alt="vers-van-de-pers"  class=""/>
        </div>
    </div>

    <div class="row">
<!--     <hr class="index-hr">
 -->    <?php
						if(!isset($this->variables['widgetNewsRecentArticlesList']))
						{
							?>{iteration:widgetNewsRecentArticlesList}<?php
							$this->variables['widgetNewsRecentArticlesList'] = array();
							$this->iterations['b2271e73bfed5190a1c967d78708ea89_RecentArticlesList.tpl.php_1']['fail'] = true;
						}
					$this->iterations['b2271e73bfed5190a1c967d78708ea89_RecentArticlesList.tpl.php_1']['iteration'] = $this->variables['widgetNewsRecentArticlesList'];
				if(isset(${'widgetNewsRecentArticlesList'})) $this->iterations['b2271e73bfed5190a1c967d78708ea89_RecentArticlesList.tpl.php_1']['old'] = ${'widgetNewsRecentArticlesList'};
				$this->iterations['b2271e73bfed5190a1c967d78708ea89_RecentArticlesList.tpl.php_1']['i'] = 1;
				$this->iterations['b2271e73bfed5190a1c967d78708ea89_RecentArticlesList.tpl.php_1']['count'] = count($this->iterations['b2271e73bfed5190a1c967d78708ea89_RecentArticlesList.tpl.php_1']['iteration']);
				foreach($this->iterations['b2271e73bfed5190a1c967d78708ea89_RecentArticlesList.tpl.php_1']['iteration'] as ${'widgetNewsRecentArticlesList'})
				{
					if(is_array(${'widgetNewsRecentArticlesList'}))
					{
						if(!isset(${'widgetNewsRecentArticlesList'}['first']) && $this->iterations['b2271e73bfed5190a1c967d78708ea89_RecentArticlesList.tpl.php_1']['i'] == 1) ${'widgetNewsRecentArticlesList'}['first'] = true;
						if(!isset(${'widgetNewsRecentArticlesList'}['last']) && $this->iterations['b2271e73bfed5190a1c967d78708ea89_RecentArticlesList.tpl.php_1']['i'] == $this->iterations['b2271e73bfed5190a1c967d78708ea89_RecentArticlesList.tpl.php_1']['count']) ${'widgetNewsRecentArticlesList'}['last'] = true;
						if(isset(${'widgetNewsRecentArticlesList'}['formElements']) && is_array(${'widgetNewsRecentArticlesList'}['formElements']))
						{
							foreach(${'widgetNewsRecentArticlesList'}['formElements'] as $name => $object)
							{
								${'widgetNewsRecentArticlesList'}[$name] = $object->parse();
								${'widgetNewsRecentArticlesList'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
        <article class="col-sm-4 item">
            <div class="news-img<?php
						if(
							(is_object(${'widgetNewsRecentArticlesList'}) && ${'widgetNewsRecentArticlesList'}->getFirst() && ${'widgetNewsRecentArticlesList'}->getFirst() != '' && ${'widgetNewsRecentArticlesList'}->getFirst() !== false)
							|| (is_array(${'widgetNewsRecentArticlesList'}) && isset(${'widgetNewsRecentArticlesList'}['first']) && count(${'widgetNewsRecentArticlesList'}['first']) != 0 && ${'widgetNewsRecentArticlesList'}['first'] != '' && ${'widgetNewsRecentArticlesList'}['first'] !== false))
						{
							?>active<?php } ?>">
                <a href="<?php if(array_key_exists('full_url', (array) ${'widgetNewsRecentArticlesList'})) { echo ${'widgetNewsRecentArticlesList'}['full_url']; } elseif(is_object(${'widgetNewsRecentArticlesList'}) && method_exists(${'widgetNewsRecentArticlesList'}, 'getFullUrl')) { echo ${'widgetNewsRecentArticlesList'}->getFullUrl(); } else { ?>{$widgetNewsRecentArticlesList->full_url}<?php } ?>"><img src="<?php if(array_key_exists('FRONTEND_FILES_URL', (array) $this->variables)) { echo $this->variables['FRONTEND_FILES_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFRONTENDFILESURL')) { echo $this->variables->getFRONTENDFILESURL(); } else { ?>{$FRONTEND_FILES_URL}<?php } ?>/news/covers/400x400/<?php if(array_key_exists('cover_image', (array) ${'widgetNewsRecentArticlesList'})) { echo ${'widgetNewsRecentArticlesList'}['cover_image']; } elseif(is_object(${'widgetNewsRecentArticlesList'}) && method_exists(${'widgetNewsRecentArticlesList'}, 'getCoverImage')) { echo ${'widgetNewsRecentArticlesList'}->getCoverImage(); } else { ?>{$widgetNewsRecentArticlesList->cover_image}<?php } ?>" alt="<?php if(array_key_exists('title', (array) ${'widgetNewsRecentArticlesList'})) { echo ${'widgetNewsRecentArticlesList'}['title']; } elseif(is_object(${'widgetNewsRecentArticlesList'}) && method_exists(${'widgetNewsRecentArticlesList'}, 'getTitle')) { echo ${'widgetNewsRecentArticlesList'}->getTitle(); } else { ?>{$widgetNewsRecentArticlesList->title}<?php } ?>" /></a>
            </div>
            <div class="news-content">
                <h2><?php if(array_key_exists('publish_on', (array) ${'widgetNewsRecentArticlesList'}) && array_key_exists('LANGUAGE', (array) $this->variables)) { echo SpoonFilter::ucfirst(SpoonTemplateModifiers::date(${'widgetNewsRecentArticlesList'}['publish_on'], 'd/m/Y', $this->variables['LANGUAGE'])); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLANGUAGE')) { echo $this->variables->getLANGUAGE(); } else { ?>{$widgetNewsRecentArticlesList->publish_on|date:'d/m/Y':<?php if(array_key_exists('LANGUAGE', (array) $this->variables)) { echo $this->variables['LANGUAGE']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLANGUAGE')) { echo $this->variables->getLANGUAGE(); } else { ?>{$LANGUAGE}<?php } ?>|ucfirst}<?php } ?></h2>
                <h1><?php if(array_key_exists('title', (array) ${'widgetNewsRecentArticlesList'})) { echo ${'widgetNewsRecentArticlesList'}['title']; } elseif(is_object(${'widgetNewsRecentArticlesList'}) && method_exists(${'widgetNewsRecentArticlesList'}, 'getTitle')) { echo ${'widgetNewsRecentArticlesList'}->getTitle(); } else { ?>{$widgetNewsRecentArticlesList->title}<?php } ?></h1>
                <p><?php if(array_key_exists('content', (array) ${'widgetNewsRecentArticlesList'})) { echo Frontend\Core\Engine\TemplateModifiers::truncate(${'widgetNewsRecentArticlesList'}['content'], 150, true, true); } elseif(is_object(${'widgetNewsRecentArticlesList'}) && method_exists(${'widgetNewsRecentArticlesList'}, 'getContent')) { echo ${'widgetNewsRecentArticlesList'}->getContent(); } else { ?>{$widgetNewsRecentArticlesList->content|truncate:150:true:true}<?php } ?></p>
                <p class="read-more"><a href="<?php if(array_key_exists('full_url', (array) ${'widgetNewsRecentArticlesList'})) { echo ${'widgetNewsRecentArticlesList'}['full_url']; } elseif(is_object(${'widgetNewsRecentArticlesList'}) && method_exists(${'widgetNewsRecentArticlesList'}, 'getFullUrl')) { echo ${'widgetNewsRecentArticlesList'}->getFullUrl(); } else { ?>{$widgetNewsRecentArticlesList->full_url}<?php } ?>">Lees meer <span>&#10095;</span></a></p>
            </div>
        </article>
    <?php
					$this->iterations['b2271e73bfed5190a1c967d78708ea89_RecentArticlesList.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['b2271e73bfed5190a1c967d78708ea89_RecentArticlesList.tpl.php_1']['fail']) && $this->iterations['b2271e73bfed5190a1c967d78708ea89_RecentArticlesList.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:widgetNewsRecentArticlesList}<?php
					}
				if(isset($this->iterations['b2271e73bfed5190a1c967d78708ea89_RecentArticlesList.tpl.php_1']['old'])) ${'widgetNewsRecentArticlesList'} = $this->iterations['b2271e73bfed5190a1c967d78708ea89_RecentArticlesList.tpl.php_1']['old'];
				else unset($this->iterations['b2271e73bfed5190a1c967d78708ea89_RecentArticlesList.tpl.php_1']);
				?>
        <div class="col-sm-12"><div class="btn-all-news"><a href="/nl/nieuws">Bekijk alle nieuwsitems</a></div></div>
    </div>
<?php } ?>
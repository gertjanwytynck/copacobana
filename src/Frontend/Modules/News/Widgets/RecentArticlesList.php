<?php

namespace Frontend\Modules\News\Widgets;

use Frontend\Core\Engine\Base\Widget;
use Frontend\Core\Engine\Model;
use Frontend\Modules\News\Engine\Model as FrontendNewsModel;

/**
 * This is a widget with recent news-articles
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class RecentArticlesList extends Widget
{
    /**
     * Execute the extra
     */
    public function execute()
    {
        parent::execute();

        $this->loadTemplate();
        $this->parse();
    }

    /**
     * Parse
     */
    protected function parse()
    {
        // get the item
        $items = FrontendNewsModel::getAll(Model::getModuleSetting('News', 'recent_articles_list_num_items', 3), 0, null, true);

        // append slideKey
        $i = 0;
        foreach ($items as $key => $item) {
            $items[$key]['dataSlide'] = $i;
            if ( $i == 0 ){ $items[$key]['dataSlideActive'] = true; }
            $i++;
        }

        // assign comments
        $this->tpl->assign('widgetNewsRecentArticlesList', $items);

        // set facebook image
        $this->header->addOpenGraphData('url',  SITE_URL);
        $this->header->addOpenGraphData('title', 'Copacobana');
        $this->header->addOpenGraphData('image',  SITE_URL . '/src/Frontend/Themes/Copacobana/Core/Layout/images/copacobana_fb.png');
        $this->header->addOpenGraphData('site_name', 'Copacobana');
        $this->header->addOpenGraphData('author', 'Copacobana', true);
        $this->header->addOpenGraphData('publisher', 'Copacobana', true);
    }
}

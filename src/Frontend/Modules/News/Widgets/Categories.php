<?php

namespace Frontend\Modules\News\Widgets;

use Frontend\Core\Engine\Base\Widget;
use Frontend\Modules\News\Engine\Model as FrontendNewsModel;

/**
 * This is a widget with the news-categories
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Categories extends Widget
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
    private function parse()
    {
        // get categories
        $categories = FrontendNewsModel::getAllCategories();

        // pass the categories
        $this->tpl->assign('widgetNewsCategories', $categories);
    }
}

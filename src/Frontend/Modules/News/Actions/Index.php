<?php

namespace Frontend\Modules\News\Actions;

use Frontend\Core\Engine\Base\Block;
use Frontend\Core\Engine\Model;
use Frontend\Core\Engine\Navigation;
use Frontend\Modules\News\Engine\Model as FrontendNewsModel;

/**
 * This is the index-action
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Index extends Block
{
    /** @var array */
    private $items = array();

    /** @var array */
    private $categories = array();

    /** @var array $settings */
    private $settings;

    /** @var array */
    protected $pagination = array(
        'limit' => 25,
        'offset' => 0,
        'requested_page' => 1,
        'num_items' => null,
        'num_pages' => null
    );

    /**
     * Execute the extra
     */
    public function execute()
    {
        parent::execute();

        $this->loadTemplate();
        $this->getData();
        $this->parse();
    }

    /**
     * Get the data
     */
    private function getData()
    {
        // requested page
        $requestedPage = $this->URL->getParameter('page', 'int', 1);

        // set URL and limit
        $this->pagination['url'] = Navigation::getURLForBlock('News', 'Index');
        $this->pagination['limit'] = Model::getModuleSetting('News', 'overview_num_items', 10);

        // populate count fields in pagination
        $this->pagination['num_items'] = FrontendNewsModel::getAllCount();
        $this->pagination['num_pages'] = (int) ceil($this->pagination['num_items'] / $this->pagination['limit']);

        // num pages is always equal to at least 1
        if ($this->pagination['num_pages'] == 0) {
            $this->pagination['num_pages'] = 1;
        }

        // redirect if the request page doesn't exist
        if ($requestedPage > $this->pagination['num_pages'] || $requestedPage < 1) {
            $this->redirect(
                Navigation::getURL(404)
            );
        }

        // populate calculated fields in pagination
        $this->pagination['requested_page'] = $requestedPage;
        $this->pagination['offset'] = ($this->pagination['requested_page'] * $this->pagination['limit']) - $this->pagination['limit'];

        // get articles
        $this->items = FrontendNewsModel::getAll($this->pagination['limit'], $this->pagination['offset']);

        // get the module settings
        $this->settings = Model::getModuleSettings($this->module);

        // get categories
        $this->categories = FrontendNewsModel::getAllCategories();
    }

    /**
     * Parse the data into the template
     */
    private function parse()
    {
        // assign the items
        $this->tpl->assign('items', (array) $this->items);

        // assign the categories
        $this->tpl->assign('categories', (array) $this->categories);
        $this->header->addJS('/src/Frontend/Modules/News/Js/packery.min.js', false);

        // parse the pagination
        $this->parsePagination();

        // assign settings
        $this->tpl->assign('settings', $this->settings);
    }
}

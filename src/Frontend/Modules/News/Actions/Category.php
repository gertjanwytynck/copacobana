<?php

namespace Frontend\Modules\News\Actions;

use Frontend\Core\Engine\Base\Block;
use Frontend\Core\Engine\Language;
use Frontend\Core\Engine\Model;
use Frontend\Core\Engine\Navigation;
use Frontend\Modules\News\Engine\Model as FrontendNewsModel;

/**
 * This is the category-action
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Category extends Block
{
    /** @var array $items */
    private $items;

    /** @var array $category */
    private $category;

    /** @var array $settings */
    private $settings;

    /** @var array */
    protected $pagination = array(
        'limit' => 10,
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
     * Load the data, don't forget to validate the incoming data
     */
    private function getData()
    {
        // get categories
        $categories = FrontendNewsModel::getAllCategories();
        $possibleCategories = array();
        foreach ($categories as $category) {
            $possibleCategories[$category['url']] = $category['id'];
        }

        // requested category
        $requestedCategory = \SpoonFilter::getValue(
            $this->URL->getParameter(1, 'string'),
            array_keys($possibleCategories),
            'false'
        );

        // requested page
        $requestedPage = $this->URL->getParameter('page', 'int', 1);

        // validate category
        if ($requestedCategory == 'false') $this->redirect(Navigation::getURL(404));

        // set category
        $this->category = $categories[$possibleCategories[$requestedCategory]];

        // set URL and limit
        $this->pagination['url'] = Navigation::getURLForBlock('News', 'Category') . '/' . $requestedCategory;
        $this->pagination['limit'] = Model::getModuleSetting('News', 'overview_num_items', 10);

        // populate count fields in pagination
        $this->pagination['num_items'] = FrontendNewsModel::getAllCount($requestedCategory);
        $this->pagination['num_pages'] = (int) ceil($this->pagination['num_items'] / $this->pagination['limit']);

        // redirect if the request page doesn't exists
        if ($requestedPage > $this->pagination['num_pages'] || $requestedPage < 1) {
            $this->redirect(Navigation::getURL(404));
        }

        // populate calculated fields in pagination
        $this->pagination['requested_page'] = $requestedPage;
        $this->pagination['offset'] = ($this->pagination['requested_page'] * $this->pagination['limit']) - $this->pagination['limit'];

        // get articles
        $this->items = FrontendNewsModel::getAll(
            $this->pagination['limit'],
            $this->pagination['offset'],
            $requestedCategory
        );

        // get the module settings
        $this->settings = $this->get('fork.settings')->getForModule('News');
    }

    /**
     * Parse the data into the template
     */
    private function parse()
    {
        // add into breadcrumb
        $this->breadcrumb->addElement(\SpoonFilter::ucfirst(Language::lbl('Category')));
        $this->breadcrumb->addElement($this->category['title']);

        // set pageTitle
        $this->header->setPageTitle(\SpoonFilter::ucfirst(Language::lbl('Category')));
        $this->header->setPageTitle($this->category['title']);

        // assign category
        $this->tpl->assign('category', $this->category);

        // assign settings
        $this->tpl->assign('settings', $this->settings);

        // set meta
        $this->header->setPageTitle($this->items['meta']->getTitle(), $this->items['meta']->getOverwriteTitle());
        $this->header->addMetaDescription(
            $this->items['meta']->getDescription(),
            $this->items['meta']->getOverwriteDescription()
        );
        $this->header->addMetaKeywords(
            $this->items['meta']->getKeywords(),
            $this->items['meta']->getOverwriteKeywords()
        );

        // advanced SEO-attributes
        $metaData = (array) $this->items['meta']->getData();
        if (isset($metaData['seo_index'])) {
            $this->header->addMetaData(
                array('name' => 'robots', 'content' => $metaData['seo_index'])
            );
        }
        if (isset($metaData['seo_follow'])) {
            $this->header->addMetaData(
                array('name' => 'robots', 'content' => $metaData['seo_follow'])
            );
        }

        // assign articles
        unset($this->items['meta']);
        $this->tpl->assign('items', $this->items);

        // parse the pagination
        $this->parsePagination();
    }
}

<?php

namespace Frontend\Modules\News\Actions;

use Frontend\Core\Engine\Base\Block;
use Frontend\Core\Engine\Language;
use Frontend\Core\Engine\Model;
use Frontend\Core\Engine\Navigation;
use Frontend\Modules\News\Engine\Model as FrontendNewsModel;
use Frontend\Modules\Tags\Engine\Model as FrontendTagsModel;

/**
 * This is the detail-action
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Detail extends Block
{
    /** @var Form $images */
    private $images;

    /** @var array $record */
    protected $record;

    /** @var array related */
    protected $related = array();

    /** @var array $settings */
    protected $settings;

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
    protected function getData()
    {
        // validate incoming parameters
        if ($this->URL->getParameter(1) === null) $this->redirect(Navigation::getURL(404));

        // get by URL
        $this->record = FrontendNewsModel::getByUrl($this->URL->getParameter(1));

        // anything found?
        if ($this->record === null) $this->redirect(Navigation::getURL(404));

        // get images by id
        $this->images = FrontendNewsModel::getAllImages($this->record['id']);

        // get the module settings
        $this->settings = $this->get('fork.settings')->getForModule('News');
    }

    /**
     * Parse the data into the template
     */
    private function parse()
    {
        // fancybox
        $this->header->addCSS('/src/Frontend/Modules/News/Layout/Css/jquery.fancybox.css');
        $this->header->addJS('/src/Frontend/Modules/News/Js/jquery.fancybox.js', false);

        // add to breadcrumb
        $this->breadcrumb->addElement($this->record['title']);

        // hide the page title
        $this->header->setPageTitle($this->record['meta']->getTitle(), $this->record['meta']->getOverwriteTitle());

        // assign article
        $this->tpl->assign('item', $this->record);
        $this->tpl->assign('related', $this->related);
        $this->tpl->assign('images', $this->images);

        // assign settings
        $this->tpl->assign('settings', $this->settings);


        $content = strip_tags($this->record['content']);
        // set facebook image
        $this->header->addOpenGraphData('url',  SITE_URL . $this->record['full_url'], true);
        $this->header->addOpenGraphData('title', $this->record['title'], true);
        $this->header->addOpenGraphData('description', substr($content, 0, 200), true);
        $this->header->addOpenGraphData('image', SITE_URL . '' . FRONTEND_FILES_URL . '/news/covers/400x400/' . $this->record['cover_image'], true);
        $this->header->addOpenGraphData('site_name', 'Copacobana', true);
        $this->header->addOpenGraphData('type', 'article', true);
        $this->header->addOpenGraphData('author', 'Copacobana', true);
        $this->header->addOpenGraphData('publisher', 'Copacobana', true);

        // set meta
        $this->header->addMetaDescription(
            $this->record['meta']->getDescription(),
            $this->record['meta']->getOverwriteDescription()
        );
        $this->header->addMetaKeywords(
            $this->record['meta']->getKeywords(),
            $this->record['meta']->getOverwriteKeywords()
        );

        // advanced SEO-attributes
        $metaData = (array) $this->record['meta']->getData();
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

        // set the canonical url
        $this->header->setCanonicalUrl($this->record['full_url']);
    }
}

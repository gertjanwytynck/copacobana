<?php

namespace Frontend\Modules\Festival\Actions;

use Frontend\Core\Engine\Base\Block;
use Frontend\Core\Engine\Language;
use Frontend\Core\Engine\Model;
use Frontend\Core\Engine\Navigation as FrontendNavigation;
use Frontend\Modules\Festival\Engine\Model as FrontendFestivalModel;

/**
 * This is the detail-action
 *
 * @author Gertjan Wytynck <gertjan@studiorauw.be>
 */
class Detail extends Block
{

    /** @var array $record */
    protected $record;

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
        if ($this->URL->getParameter(0) === null) $this->redirect(FrontendNavigation::getURL(404));

         // get doctrine manager
        $em = Model::get('doctrine.orm.entity_manager');

        // get by URL
        $this->record = $em ->getRepository(FrontendFestivalModel::ARTIST_ENTITY_CLASS)
            ->_findByUrl($this->URL->getParameter(0), FRONTEND_LANGUAGE);

        if ($this->record === null) $this->redirect(FrontendNavigation::getURL(404));

        $link = FrontendNavigation::getURLForBlock('Festival', 'Detail');

        $this->record['full_url'] = $link . '/' . $this->record['meta']['url'];
        $this->record['website'][0]['bio'] = htmlspecialchars_decode(htmlspecialchars_decode($this->record['website'][0]['bio']));
        setlocale(LC_TIME, FRONTEND_LANGUAGE .'_' . strtoupper(FRONTEND_LANGUAGE));

          // create practical info
        $startDates = array();
        foreach ($this->record["date"] as $key => $startDate) {
            $startDates[$key]['date'] = strftime("%A", $startDate['startOn']->getTimestamp());
            $startDates[$key]['time'] = strftime('%H:%M', $startDate['startOn']->getTimestamp()) . " - " . strftime("%H:%M", $startDate['endOn']->getTimestamp());
            $startDates[$key]['stage'] = $startDate['stage']['stageName'];
        }
        $this->tpl->assign('dates', $startDates);

        // anything found?
        if ($this->record === null) $this->redirect(Navigation::getURL(404));

        // get the module settings
        $this->settings = $this->get('fork.settings')->getForModule('Artist');
    }

    /**
     * Parse the data into the template
     */
    private function parse()
    {
        // add to breadcrumb
        $this->breadcrumb->addElement($this->record['meta']['title']);
        $this->header->addJS('/src/Frontend/Modules/Festival/Js/masonry.min.js', false, false);
        $this->header->addJsData($this->module, 'backstage', 'undefined');

        // hide the page title
        $this->header->setPageTitle($this->record['meta']['title'], $this->record['meta']['overwriteTitle']);

        // assign article
        $this->tpl->assign('artist', $this->record);

        // assign settings
        $this->tpl->assign('settings', $this->settings);

        $content = strip_tags($this->record['website'][0]['bio']);
        // set facebook image
        $this->header->addOpenGraphData('url',  SITE_URL . $this->record['full_url'], true);
        $this->header->addOpenGraphData('title', $this->record['meta']['title'], true);
        $this->header->addOpenGraphData('description', substr($content, 0, 200), true);
        $this->header->addOpenGraphData('image', SITE_URL . '' . FRONTEND_FILES_URL . '/festival/artists/covers/350x280/' . $this->record['cover'], true);
        $this->header->addOpenGraphData('site_name', 'Copacobana | ' . $this->record['name'] , true);
        $this->header->addOpenGraphData('type', 'article', true);
        $this->header->addOpenGraphData('author', 'Copacobana', true);
        $this->header->addOpenGraphData('publisher', 'Copacobana', true);

        // set meta
        $this->header->addMetaDescription(
            $this->record['meta']['description'],
            $this->record['meta']['overwriteDescription']
        );
        $this->header->addMetaKeywords(
            $this->record['meta']['keywords'],
            $this->record['meta']['overwriteKeywords']
        );

        // set the canonical url
        $this->header->setCanonicalUrl($this->record['full_url']);
    }
}

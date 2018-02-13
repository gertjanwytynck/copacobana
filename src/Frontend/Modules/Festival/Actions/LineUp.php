<?php

namespace Frontend\Modules\Festival\Actions;

use Frontend\Core\Engine\Base\Block;
use Frontend\Core\Engine\Model;
use Frontend\Core\Engine\Navigation as FrontendNavigation;
use Frontend\Modules\Festival\Engine\Model as FrontendFestivalModel;

/**
 * This is the lineup-action
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class LineUp extends Block
{
    /**
     * @var $friday
     */
    private $friday;

    /**
     * @var $saturday
     */
    private $saturday;

    /**
     * @var $sunday
     */
    private $sunday;

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
        // check for parameter
        if ($this->URL->getParameter(0) !== null) {
            $this->redirect(FrontendNavigation::getURL(404));
        }

        // get doctrine manager + get all the artists
        $em = Model::get('doctrine.orm.entity_manager');
        $artistRepo = $em->getRepository(FrontendFestivalModel::ARTIST_ENTITY_CLASS);
        $artists = $artistRepo->_getAll();

        // get all the stages
        $stages = $em->getRepository(FrontendFestivalModel::ARTIST_STAGE_ENTITY_CLASS)->findAll();

        // Redirect for empty parameter
        if (empty($artists)) { $this->redirect(FrontendNavigation::getURL(404)); }

        // Set locale
        setlocale(LC_TIME, FRONTEND_LANGUAGE . '_' . strtoupper(FRONTEND_LANGUAGE));

        foreach ($stages as $keyStage => $stage) {
            $i = 0;
            foreach ($artists as $key => $artist) {
                // Loop through stages
                foreach($artist['date'] as $artistKeyStage => $artistDate) {
                    $i++;

                    if ($artistDate["stage"]["id"] == $stage->getId()) {
                        $day = strftime("%A", $artistDate['startOn']->getTimestamp());
                        $link = FrontendNavigation::getURLForBlock('Festival', 'Detail');

                        if ($day == 'vrijdag' || $day == 'Friday' || $day == 'vendredi') {
                            $this->friday[$keyStage]['stage'] = $stage->getStageName();
                            $this->friday[$keyStage]['artist'][$i]['name'] = $artist['name'];
                            $this->friday[$keyStage]['artist'][$i]['date'] = strftime("%H:%M", $artistDate['startOn']->getTimestamp()) . " - " . strftime("%H:%M", $artistDate['endOn']->getTimestamp());
                            $this->friday[$keyStage]['artist'][$i]['url'] =  $link . '/' . $artist['meta']['url'];
                        }

                        if ($day == 'zaterdag' || $day == 'Saturday' || $day == 'samedi') {
                            $this->saturday[$keyStage]['stage'] = $stage->getStageName();
                            $this->saturday[$keyStage]['artist'][$i]['name'] = $artist['name'];
                            $this->saturday[$keyStage]['artist'][$i]['date'] = strftime("%H:%M", $artistDate['startOn']->getTimestamp()) . " - " . strftime("%H:%M", $artistDate['endOn']->getTimestamp());
                            $this->saturday[$keyStage]['artist'][$i]['url'] =  $link . '/' . $artist['meta']['url'];
                        }

                        if ($day == 'zondag' || $day == 'Sunday' || $day == 'dimanche') {
                            $this->sunday[$keyStage]['stage'] = $stage->getStageName();
                            $this->sunday[$keyStage]['artist'][$i]['name'] = $artist['name'];
                            $this->sunday[$keyStage]['artist'][$i]['date'] = strftime("%H:%M", $artistDate['startOn']->getTimestamp()) . " - " . strftime("%H:%M", $artistDate['endOn']->getTimestamp());
                            $this->sunday[$keyStage]['artist'][$i]['url'] =  $link . '/' . $artist['meta']['url'];
                        }
                    }
                }
            }
        }

        foreach ($this->friday as $key=>$value) {
            usort($value['artist'], function($a, $b) {
                $ad = $a['date'];
                $bd = $b['date'];

                if ($ad < '01:00' && $bd < '02:00') {
                    return 0;
                }

                if ($bd < '01:00') {
                    return -1;
                }

                if ($ad < '02:00') {

                    return 1;
                }

                if ($bd < '02:00') {
                    return -1;
                }
                return $ad < $bd ? -1 : 1;
            });

            $this->friday[$key]["artist"] = $value['artist'];
        }

        foreach ($this->saturday as $key=>$value) {
            usort($value['artist'], function($a, $b) {
                $ad = $a['date'];
                $bd = $b['date'];

                if ($ad < '01:00' && $bd < '02:00') {
                    return 0;
                }

                if ($bd < '01:00') {
                    return -1;
                }

                if ($ad < '02:00') {

                    return 1;
                }

                if ($bd < '02:00') {
                    return -1;
                }
                return $ad < $bd ? -1 : 1;
            });

            $this->saturday[$key]["artist"] = $value['artist'];
        }

         foreach ($this->sunday as $key=>$value) {
            usort($value['artist'], function($a, $b) {
                $ad = $a['date'];
                $bd = $b['date'];

                if ($ad < '01:00' && $bd < '02:00') {
                    return 0;
                }

                if ($bd < '01:00') {
                    return -1;
                }

                if ($ad < '02:00') {

                    return 1;
                }

                if ($bd < '02:00') {
                    return -1;
                }
                return $ad < $bd ? -1 : 1;
            });

            $this->sunday[$key]["artist"] = $value['artist'];
        }
    }

    /**
     * Parse the data into the template
     */
    private function parse()
    {

        // set facebook image
        $this->header->addOpenGraphData('url', 'http://copacobana.be/nl/artiesten/line-up', true);
        $this->header->addOpenGraphData('title', 'Line Up', true);
        $this->header->addOpenGraphData('description', 'Het tijdsrooster van Copacobana Festival 2015', true);
        $this->header->addOpenGraphData('image', SITE_URL . '/src/Frontend/Themes/Copacobana/Core/Layout/images/copacobana_fb.png', true);
        $this->header->addOpenGraphData('site_name', 'Copacobana', true);
        $this->header->addOpenGraphData('type', 'article', true);
        $this->header->addOpenGraphData('author', 'Copacobana', true);
        $this->header->addOpenGraphData('publisher', 'Copacobana', true);

        // parse the extra header files
        $this->header->addJS('/src/Frontend/Modules/Festival/Js/masonry.min.js', false, false);
        $this->header->addJsData($this->module, 'backstage', 'undefined');


        // assign the items
        $this->tpl->assign('friday', (array) $this->friday);
        $this->tpl->assign('saturday', (array) $this->saturday);
        $this->tpl->assign('sunday', (array) $this->sunday);
    }
}

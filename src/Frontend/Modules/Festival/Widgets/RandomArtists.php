<?php

namespace Frontend\Modules\Festival\Widgets;

use Frontend\Core\Engine\Base\Widget;
use Frontend\Core\Engine\Model;
use Frontend\Core\Engine\Navigation as FrontendNavigation;
use Frontend\Modules\Festival\Engine\Model as FrontendFestivalModel;

/**
 * This is a widget with the news-categories
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 *//**/
class RandomArtists extends Widget
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
        // get artists
        $em = Model::get('doctrine.orm.entity_manager');
        $artistRepo = $em->getRepository(FrontendFestivalModel::ARTIST_ENTITY_CLASS);
        $allArtists = $artistRepo->_getRandomArtists();
        shuffle($allArtists);
        $artists = array_slice($allArtists, 0, 8, true);

        $link = FrontendNavigation::getURLForBlock('Festival', 'Detail');

        // add header css files
        $this->header->addJS('/src/Frontend/Modules/Festival/Js/masonry.min.js', false, false);

        // make clean array
        $items = array();
        setlocale(LC_TIME, FRONTEND_LANGUAGE .'_' . strtoupper(FRONTEND_LANGUAGE));
        foreach ($artists as $key=>$value) {
            $items[$key]['name'] = $value['name'];
            $items[$key]['cover'] = $value['cover'];
            $items[$key]['full_url'] = $link . '/' . $value['meta']['url'];

            $days = array();
            foreach ($value['date'] as $keyDate => $date) {
                $day = strftime("%A", $date['startOn']->getTimestamp());
                if ($keyDate == 0) {
                    $items[$key]['day'] = $day;
                } else {
                    $inArray = false;
                    foreach($days as $dayCheck){
                        if ($dayCheck == $day) {
                           $inArray = true;
                        }
                    }

                    if (!$inArray) {
                        $items[$key]['day'] = $items[$key]['day'] . ", " . $day;
                    }
                }
                array_push($days, $day);
            }
        }

        // pass the categories
        $this->tpl->assign('widgetArtists', $items);
    }
}

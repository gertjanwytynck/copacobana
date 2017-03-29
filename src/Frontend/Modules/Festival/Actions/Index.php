<?php

namespace Frontend\Modules\Festival\Actions;

use Frontend\Core\Engine\Base\Block;
use Frontend\Core\Engine\Model;
use Frontend\Core\Engine\Navigation as FrontendNavigation;
use Frontend\Modules\Festival\Engine\Model as FrontendFestivalModel;

/**
 * This is the index-action
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class Index extends Block
{
    /**
     * @var $items
     */
    private $items;

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
        setlocale(LC_TIME, FRONTEND_LANGUAGE .'_' . strtoupper(FRONTEND_LANGUAGE));
        $fridayString = 'vrijdag';
        $saturdayString = 'zaterdag';
        $sundayString = 'zondag';

        // check for parameter
        if ($this->URL->getParameter(0) != $fridayString && $this->URL->getParameter(0) != $saturdayString && $this->URL->getParameter(0) != $sundayString) {
            if ($this->URL->getParameter(0) !== null) $this->redirect(FrontendNavigation::getURL(404));
        }

        // Friday
        $friday = false;
        if ($this->URL->getParameter(0) === $fridayString) {
            $friday = true;
        }

        // Saturday
        $saturday = false;
        if ($this->URL->getParameter(0) === $saturdayString) {
            $saturday = true;
        }

         // Saturday
        $sunday = false;
        if ($this->URL->getParameter(0) === $sundayString) {
            $sunday = true;
        }

        $link = FrontendNavigation::getURLForBlock('Festival', 'Detail');

        // get doctrine manager + get all the artists
        $em = Model::get('doctrine.orm.entity_manager');
        $artistRepo = $em->getRepository(FrontendFestivalModel::ARTIST_ENTITY_CLASS);
        $artists = $artistRepo->_getAll();

        if (empty($artists)) $this->redirect(FrontendNavigation::getURL(404));

        $i = 0;
        foreach ($artists as $key=>$value) {

            // Only friday
            if ($friday) {
                $fridayCheck = false;
                $fridayCheck = $this->fillInDays($value, $fridayString, $fridayCheck, $i);

                if ($fridayCheck) {
                    $this->fillInArtist($value, $link, $i);
                    $i++;
                }

            }

            // Only saturday
            if ($saturday) {
                $saturdayCheck = false;
                $saturdayCheck = $this->fillInDays($value, $saturdayString, $saturdayCheck, $i);

                if ($saturdayCheck) {
                    $this->fillInArtist($value, $link, $i);
                    $i++;
                }

            }

            // Only sunday
            if ($sunday) {
                $sundayCheck = false;
                $sundayCheck = $this->fillInDays($value, $sundayString, $sundayCheck, $i);
                if ($sundayCheck) {
                  $this->fillInArtist($value, $link, $i);
                  $i++;
                }
            }

            // ABC
            if (!$sunday && !$saturday && !$friday) {
                $days = array();
                foreach ($value['date'] as $keyDate => $date) {
                    $day = strftime("%A", $date['startOn']->getTimestamp());
                    if ($keyDate == 0) {
                        $this->items[$key]['day'] = $day;
                    } else {
                        $inArray = false;
                        foreach($days as $dayCheck){
                            if ($dayCheck == $day) {
                               $inArray = true;
                            }
                        }

                        if (!$inArray) {
                            $this->items[$key]['day'] = $this->items[$key]['day'] . ", " . $day;
                        }
                    }
                    array_push($days, $day);
                }

                $this->fillInArtist($value, $link, $key);
            }
        }
    }

    private function fillInArtist($value, $link, $key)
    {
        $this->items[$key]['name'] = $value['name'];
        $this->items[$key]['cover'] = $value['cover'];
        $this->items[$key]['full_url'] = $link . '/' . $value['meta']['url'];
    }

    private function fillInDays($value, $string, $bool, $key)
    {
        $days = array();
        foreach ($value['date'] as $keyDate => $date) {
            $day = strftime("%A", $date['startOn']->getTimestamp());
            if ($day === $string) {
                $bool = true;
                if ($keyDate == 0) {
                    $this->items[$key]['day'] = $day;
                } else {
                    $inArray = false;
                    foreach($days as $dayCheck){
                        if ($dayCheck == $day) {
                           $inArray = true;
                        }
                    }

                    if (!$inArray) {
                        if (isset($this->items[$key]['day'])) {
                            $this->items[$key]['day'] = $this->items[$key]['day'] . ", " . $day;
                        } else {
                            $this->items[$key]['day'] = $day;
                        }
                    }
                }
                array_push($days, $day);
            }
        }

        return $bool;
    }

    /**
     * Parse the data into the template
     */
    private function parse()
    {
        // parse the extra header files
        $this->header->addJS('/src/Frontend/Modules/Festival/Js/masonry.min.js', false, false);


        // assign the items
        $this->tpl->assign('artists', (array) $this->items);
        $this->tpl->assign('artistNavigation', true);
    }
}

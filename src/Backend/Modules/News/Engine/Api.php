<?php

namespace Backend\Modules\News\Engine;

use Api\V1\Engine\Api as BaseAPI;
use Frontend\Modules\News\Engine\Model as FrontendNewsModel;
use Frontend\Core\Engine\Language;

/**
 * In this file we store all generic functions that we will be available through the Api
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 * @author Gertjan Wytynck <gertjan@studiorauw.be>
 */
class Api
{
    /**
     * Get the all categories
     *
     * @param  string $language
     * @return array
     */
    public static function categoriesGet($language = 'nl')
    {
        if (BaseAPI::isValidRequestMethod('GET')) {
            define("FRONTEND_LANGUAGE", $language);
            return array('categories' => FrontendNewsModel::getAllCategories());
        }
    }

    /**
     * Get all news items
     *
     * @param  string $categoryUrl
     * @param  string $language
     * @return array
     */
    public static function itemsGet($language = 'nl', $categoryUrl = null)
    {
        if (BaseAPI::isValidRequestMethod('GET')) {
            define("FRONTEND_LANGUAGE", $language);
            $items = FrontendNewsModel::getAll('10', '0', $categoryUrl);

            return array('items' => (array) $items);
        }
    }

    /**
     * Get all news items
     *
     * @param  string $language
     * @param  string $term
     * @param  string selectedCat
     * @return array
     */
    public static function searchByTerm($language = 'nl', $term, $selectedCat = null)
    {
        if (BaseAPI::isValidRequestMethod('GET')) {
            define("FRONTEND_LANGUAGE", $language);
            $items = FrontendNewsModel::SearchByTerm('10', '0', $term, $selectedCat);
            return array('items' => (array) $items);
        }
    }
}
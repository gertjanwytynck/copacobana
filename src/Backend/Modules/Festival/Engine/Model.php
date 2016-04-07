<?php

namespace Backend\Modules\Festival\Engine;

use Common\Uri as CommonUri;

use Backend\Core\Engine\Model as BackendModel;

/**
 * In this file we store all generic functions that we will be using in the artist module
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class Model
{
    const ARTIST_ENTITY_CLASS =                             'Backend\Modules\Festival\Entity\Artist';
    const ARTIST_REPOSITORY_ENTITY_CLASS =                  'Backend\Modules\Festival\Entity\ArtistRepository';
    const ARTIST_CATEGORIES_ENTITY_CLASS =                  'Backend\Modules\Festival\Entity\ArtistCategories';
    const ARTIST_PRACTICAL_ENTITY_CLASS =                   'Backend\Modules\Festival\Entity\ArtistPractical';
    const ARTIST_PRACTICAL_BACKSTAGE_ENTITY_CLASS =         'Backend\Modules\Festival\Entity\ArtistPracticalBackstage';
    const ARTIST_PRACTICAL_ONSTAGE_ENTITY_CLASS =           'Backend\Modules\Festival\Entity\ArtistPracticalOnstage';
    const ARTIST_STAGE_ENTITY_CLASS =                       'Backend\Modules\Festival\Entity\ArtistStage';
    const ARTIST_WEBSITE_ENTITY_CLASS =                     'Backend\Modules\Festival\Entity\ArtistWebsite';
    const ARTIST_WEBSITE_LOCALE_ENTITY_CLASS =              'Backend\Modules\Festival\Entity\ArtistWebsiteLocale';
    const ARTIST_WEBSITE_LOCALE_REPOSITORY_ENTITY_CLASS =   'Backend\Modules\Festival\Entity\ArtistWebsiteLocaleRepository';

    /**
     * Retrieve the unique URL for an artist
     *
     * @param  string  $url
     * @param  string  $language
     * @param  int     $id          The id of the item to ignore.
     * @return string
     */
    public static function getArtistURL($url, $language, $id = null)
    {
        $url = CommonUri::getUrl((string) $url);
        $em = BackendModel::get('doctrine.orm.entity_manager');
        $artistWithUrl = $em
            ->getRepository(self::ARTIST_ENTITY_CLASS)
            ->findByUrl($url, $id)
        ;
        if (!empty($artistWithUrl)) {
            $url = BackendModel::addNumber($url);
            return self::getArtistURL($url, '');
        }
        return $url;
    }
}

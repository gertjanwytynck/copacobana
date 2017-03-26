<?php

namespace Frontend\Modules\Festival\Engine;

/**
 * In this file we store all generic functions that we will be using in the artist module
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class Model
{
    const ARTIST_ENTITY_CLASS =                             'Backend\Modules\Festival\Entity\Artist';
    const ARTIST_REPOSITORY_ENTITY_CLASS =                  'Backend\Modules\Festival\Entity\ArtistRepository';
    const ARTIST_GENRES_ENTITY_CLASS =                      'Backend\Modules\Festival\Entity\ArtistGenres';
    const ARTIST_PRACTICAL_ENTITY_CLASS =                   'Backend\Modules\Festival\Entity\ArtistPractical';
    const ARTIST_PRACTICAL_BACKSTAGE_ENTITY_CLASS =         'Backend\Modules\Festival\Entity\ArtistPracticalBackstage';
    const ARTIST_PRACTICAL_ONSTAGE_ENTITY_CLASS =           'Backend\Modules\Festival\Entity\ArtistPracticalOnstage';
    const ARTIST_STAGE_ENTITY_CLASS =                       'Backend\Modules\Festival\Entity\ArtistStage';
    const ARTIST_WEBSITE_ENTITY_CLASS =                     'Backend\Modules\Festival\Entity\ArtistWebsite';
    const ARTIST_WEBSITE_LOCALE_ENTITY_CLASS =              'Backend\Modules\Festival\Entity\ArtistWebsiteLocale';
    const ARTIST_WEBSITE_LOCALE_REPOSITORY_ENTITY_CLASS =   'Backend\Modules\Festival\Entity\ArtistWebsiteLocaleRepository';
}
<?php

namespace Backend\Modules\News\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * The Article Locale Repository
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class ArticleLocaleRepository extends EntityRepository
{
    /**
     * Fetch a article locale based on it's id and language
     *
     * @param  string $url      The url for the article
     * @param  string $language The current language
     * @param  int    $ignoreId The id of the article we don't want to fetch
     *
     * @return ArticleLocale|null  The article locale that matches these criteria
     */
    function findByUrl($url, $language, $ignoreId = null)
    {
        // Add limits on url and language to the querybuilder
        $qb = $this->createQueryBuilder('pl')
            ->select('pl')
            ->innerJoin('pl.meta', 'm')
            ->where('m.url = :url')
            ->andWhere('pl.language = :language')
            ->setParameters(array(
                'url' => $url,
                'language' => $language,
            ))
        ;

        // if we got an id to ignore, add it to the query
        if ($ignoreId !== null) {
            $qb->andWhere('pl.id != :id')
                ->setParameter('id', $ignoreId)
            ;
        }

        return $qb->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
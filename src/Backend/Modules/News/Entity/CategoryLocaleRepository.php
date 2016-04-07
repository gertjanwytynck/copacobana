<?php

namespace Backend\Modules\News\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * The Category Locale Repository
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class CategoryLocaleRepository extends EntityRepository
{
    /**
     * Fetch a category locale based on it's id and language
     *
     * @param  string $url      The url for the category
     * @param  string $language The current language
     * @param  int    $ignoreId The id of the category locale we don't want to fetch
     *
     * @return CategoryLocale|null  The catgeory locale that matches these criteria
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
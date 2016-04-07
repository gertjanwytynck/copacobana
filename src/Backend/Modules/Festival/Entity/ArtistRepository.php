<?php

namespace Backend\Modules\Festival\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * This is the FestivalRepository
 *
 * @author Gertjan Wytynck <gertjan@studiorauw.be>
 */
class ArtistRepository extends EntityRepository
{
    /**
     * Fetch a product line locale based on it's id and language
     *
     * @param  string  $url         The url for the product line
     * @param  int     $ignoreId    The id of the product line we don't want to fetch
     *
     * @return LineLocale|null  The product line locale that matches these criteria
     */
    public function findByUrl($url, $ignoreId = null)
    {
        // Add limits on url and language to the querybuilder
        $qb = $this->createQueryBuilder('a')
            ->select('a')
            ->innerJoin('a.meta', 'm')
            ->where('m.url = :url')
            ->setParameters(array(
                'url' => $url
            ))
        ;

        // if we got an id to ignore, add it to the query
        if ($ignoreId !== null) {
            $qb->andWhere('a.id != :id')
                ->setParameter('id', $ignoreId)
            ;
        }

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * Get all info for an artist
     *
     * @return Artists|array  All the artists
     */
    public function getAll()
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a', 'aw', 'awl')
            ->leftJoin('a.website', 'aw')
            ->leftJoin('aw.locales', 'awl')
            ->where('a.isHidden = :hidden' )
            ->orderBy('a.name', 'ASC')
            ->setParameters(array(
                'hidden' => '0'
            ))

        ;

        return (array) $qb->getQuery()->getResult();
    }

    /**
     * Fetch a artist based on it's url
     *
     * @param  string  $url         The url for the product line
     * @param  int     $ignoreId    The id of the product line we don't want to fetch
     *
     * @return LineLocale|null  The product line locale that matches these criteria
     */
    public function _findByUrl($url, $ignoreId = null)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a', 'ap', 'ars', 'ab', 'm', 'apb', 'apo')
            ->innerJoin('a.stage', 'ars')
            ->innerJoin('a.meta', 'm')
            ->leftJoin('a.practical', 'ap')
            ->leftJoin('ap.backstage', 'apb')
            ->leftJoin('ap.onstage', 'apo')
            ->leftJoin('a.website', 'ab')
            ->where('m.url = :url')
            ->setParameters(array(
                'url' => $url
            ))
        ;

        // if we got an id to ignore, add it to the query
        if ($ignoreId !== null) {
            $qb->andWhere('m.id != :id')
                ->setParameter('id', $ignoreId)
            ;
        }

        return $qb->getQuery()->getOneOrNullResult(Query::HYDRATE_ARRAY);
    }

    /**
     * Check if token is correct
     *
     * @param  int     $id         The artist id.
     * @param  string  $token      The token.
     *
     * @return Artist|null  The artist token that matches these criteria
     */
    public function _checkToken($id, $token)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a')
            ->where('a.id = :id', 'a.token = :token')
            ->setParameters(array(
                'id' => $id,
                'token' => $token
            ))
        ;

        return (bool) ($qb->getQuery()->getOneOrNullResult() === null) ? false : true;
    }

    /**
     * Get all info for an artist
     *
     * @return Artists|array  All the artists
     */
    public function _getAll()
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a', 'aw', 'awl', 's', 'c')
            ->leftJoin('a.stage', 's')
            ->leftJoin('a.category', 'c')
            ->leftJoin('a.website', 'aw')
            ->leftJoin('aw.locales', 'awl')
            ->where('a.isHidden = :hidden' )
            ->where('a.year = :year' )
            ->orderBy('a.startOn', 'ASC')
            ->setParameters(array(
                'hidden' => '0',
                'year' => '2016'
            ))

        ;

        return (array) $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);
    }

    /**
     * Get all info for an artist
     *
     * @return Artists|array  All the artists for spotlight
     */
    public function _getAllSpotlight()
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a', 'aw', 'awl', 's', 'c')
            ->leftJoin('a.stage', 's')
            ->leftJoin('a.category', 'c')
            ->leftJoin('a.website', 'aw')
            ->leftJoin('aw.locales', 'awl')
            ->where('a.isHidden = :hidden' )
            ->andWhere('a.spotlight = :spotlight' )
            ->andWhere('a.year = :year' )
            ->orderBy('a.name', 'ASC')
            ->setParameters(array(
                'hidden' => '0',
                'spotlight' => '1',
                'year' => '2016'
            ))

        ;

        return (array) $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);
    }
}

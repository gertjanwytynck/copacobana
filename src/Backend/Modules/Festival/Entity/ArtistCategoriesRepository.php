<?php

namespace Backend\Modules\Festival\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * This is the Category Repository
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class ArtistCategoriesRepository extends EntityRepository
{
    /**
     * Fetch the maximum sequence
     *
     * @return int
     */
    public function getMaximumSequence()
    {
        $qb = $this->createQueryBuilder('l')
            ->select('l.sequence')
            ->orderBy('l.sequence', 'DESC')
            ->setMaxResults(1)
        ;

        $result = $qb->getQuery()->getOneOrNullResult();
        return ($result !== null) ? $result['sequence'] : 0;
    }

    /**
     * Fetch an array with categories to populate a dropdown
     *
     * @return array|null
     */
    public function categoriesDropdown()
    {
        $qb = $this->createQueryBuilder('s')->select('partial s.{id,category}');
        $results = $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);

        $categories = array();
        foreach ($results as $key => $result) {
            $categories[$result['id']] = $result['category'];
        }

        return $categories;
    }
}
<?php

namespace Backend\Modules\Festival\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * This is the LineRepository
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class ArtistStageRepository extends EntityRepository
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
     * Fetch an array with stages to populate a dropdown
     *
     * @return array|null
     */
    public function stagesDropdown()
    {
        $qb = $this->createQueryBuilder('s')->select('partial s.{id,stageName}');
        $results = $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);

        $stages = array();
        foreach ($results as $key => $result) {
            $stages[$key]['id'] = $result['id'];
            $stages[$key]['name'] = $result['stageName'];
        }

        return $stages;
    }
}
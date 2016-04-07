<?php

namespace Backend\Modules\Downloads\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * This is the DownloadRepository
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class DownloadRepository extends EntityRepository
{
    /**
     * Fetch the maximum sequence
     *
     * @return int
     */
    public function getMaximumSequence()
    {
        $qb = $this->createQueryBuilder('d')
            ->select('d.sequence')
            ->orderBy('d.sequence', 'DESC')
            ->setMaxResults(1);

        $result = $qb->getQuery()->getOneOrNullResult();
        return ($result !== null) ? $result['sequence'] : 0;
    }
}
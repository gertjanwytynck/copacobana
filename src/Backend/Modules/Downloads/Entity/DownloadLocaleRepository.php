<?php

namespace Backend\Modules\Downloads\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * This is the DownloadLocaleRepository
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class DownloadLocaleRepository extends EntityRepository
{
    /**
     * Fetch a download locale based on it's extra id
     *
     * @param  int      $downloadId     The download id
     * @param  string   $language       The language
     *
     * @return DownloadLocale|null      The download
     */
    public function _findDownloadByDownloadId($downloadId, $language)
    {
        $qb = $this->createQueryBuilder('dl')
            ->select('dl')
            ->innerJoin('dl.download', 'd', 'WITH', 'd.id = :downloadId')
            ->where('dl.language = :language')
            ->setParameters(array(
                'downloadId' => $downloadId,
                'language' => $language
            ))
        ;

        return $qb->getQuery()->getOneOrNullResult(Query::HYDRATE_ARRAY);
    }
}
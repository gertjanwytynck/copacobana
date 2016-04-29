<?php

namespace Frontend\Modules\News\Engine;

use Frontend\Core\Engine\Model as FrontendModel;
use Frontend\Core\Engine\URL as FrontendURL;
use Frontend\Core\Engine\Navigation as FrontendNavigation;
use Frontend\Modules\Tags\Engine\Model as FrontendTagsModel;
use Frontend\Modules\Tags\Engine\TagsInterface as FrontendTagsInterface;
use Doctrine\ORM\Query;

/**
 * In this file we store all generic functions that we will be using in the news module
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Model implements FrontendTagsInterface
{
    const META_ENTITY_CLASS =                       'Backend\Core\Entity\Meta';
    const ARTICLE_ENTITY_CLASS =                    'Backend\Modules\News\Entity\Article';
    const ARTICLE_LOCALE_ENTITY_CLASS =             'Backend\Modules\News\Entity\ArticleLocale';
    const ARTICLE_IMAGE_ENTITY_CLASS =              'Backend\Modules\News\Entity\ArticleImage';
    const CATEGORY_ENTITY_CLASS =                   'Backend\Modules\News\Entity\Category';
    const CATEGORY_LOCALE_ENTITY_CLASS =            'Backend\Modules\News\Entity\CategoryLocale';


    /**
     * Get all articles
     *
     * @param int     $limit
     * @param int     $offset
     * @param string  $categoryUrl
     * @param boolean  $spotlight
     * @return array
     */
    public static function getAll($limit, $offset, $categoryUrl = null, $spotlight = false)
    {
        $limit = (int) $limit;
        $offset = (int) $offset;

        $em = FrontendModel::get('doctrine.orm.entity_manager');
        $link = FrontendNavigation::getURLForBlock('News', 'Detail');
        $categoryLink = FrontendNavigation::getURLForBlock('News', 'Category');

        $qb = $em->createQueryBuilder();

        if( $spotlight) {
            $qb->select('al, a')
                ->from(self::ARTICLE_LOCALE_ENTITY_CLASS, 'al')
                ->innerJoin('al.article', 'a', 'WITH', 'a.publishOn <= :now AND a.isHidden = :hidden')
                ->where('al.language = :language')
                ->andWhere('a.spotlight = :spotlight')
                ->orderBy('a.publishOn', 'DESC')
                ->setFirstResult($offset)
                ->setMaxResults($limit)
                ->setParameters(array(
                    'language' => FRONTEND_LANGUAGE,
                    'now' => new \DateTime(),
                    'hidden' => false,
                    'spotlight' => $spotlight
                ))
            ;
        } else {
            $qb->select('al, a')
                ->from(self::ARTICLE_LOCALE_ENTITY_CLASS, 'al')
                ->innerJoin('al.article', 'a', 'WITH', 'a.publishOn <= :now AND a.isHidden = :hidden')
                ->where('al.language = :language')
                ->orderBy('a.publishOn', 'DESC')
                ->setFirstResult($offset)
                ->setMaxResults($limit)
                ->setParameters(array(
                    'language' => FRONTEND_LANGUAGE,
                    'now' => new \DateTime(),
                    'hidden' => false,
                ))
            ;
        }


        if ($categoryUrl !== null) {
            $qb->innerJoin('a.category', 'c');
            $qb->innerJoin('c.locales', 'cl', 'WITH', 'cl.language = :language');
            $qb->innerJoin('cl.meta', 'cm');
            $qb->andWhere('cm.url = :categoryUrl');
            $qb->setParameter('categoryUrl', $categoryUrl);
        }

        $query = $qb->getQuery();
        $results = $query->getResult();

        $return = array();
        /** @var \Backend\Modules\News\Entity\ArticleLocale $result */
        foreach ($results as $result) {
            $return[$result->getId()] = array(
                'id' => $result->getArticle()->getId(),
                'title' => $result->getTitle(),
                'content' => $result->getContent(),
                'publish_on' => FrontendModel::getUTCDate('U', $result->getArticle()->getPublishOn()->format('U')),
                'full_url' => $link . '/' . $result->getMeta()->getUrl(),
                'url' => $result->getMeta()->getUrl(),
                'category_title' => $result->getArticle()->getCategory()->getLocale(FRONTEND_LANGUAGE)->getTitle(),
                'category_full_url' =>
                    $categoryLink . '/' . $result->getArticle()->getCategory()->getLocale(FRONTEND_LANGUAGE)->getMeta()->getUrl()
            );

            if (FrontendModel::get('fork.settings')->getForModule('News', 'cover_image_enabled')) {
                $return[$result->getId()]['cover_image'] = $result->getArticle()->getCoverImage();
            }
        }

        if (!empty($return)) {
            // get all tags
            $tags = FrontendTagsModel::getForMultipleItems('News', array_keys($return));

            // loop tags and add to correct item
            foreach ($tags as $articleLocaleId => $data) {
                if (isset($return[$articleLocaleId])) {
                    $return[$articleLocaleId]['tags'] = $data;
                }
            }
        }

        if ($categoryUrl != null) {
            $qb = $em->createQueryBuilder();
            $qb->select('cl, cm')
                ->from(self::CATEGORY_LOCALE_ENTITY_CLASS, 'cl')
                ->innerJoin('cl.meta', 'cm')
                ->where('cm.url = :categoryUrl')
                ->andWhere('cl.language = :language')
                ->setParameters(array(
                    'categoryUrl' => $categoryUrl,
                    'language' => FRONTEND_LANGUAGE
                ))
            ;

            $query = $qb->getQuery();

            /** @var \Backend\Modules\News\Entity\CategoryLocale $result */
            $result = $query->getOneOrNullResult();

            // add the category meta to the return array
            // $return['meta'] = $result->getMeta();
        }

        return $return;
    }

    /**
     * Get all categories
     *
     * @return array
     */
    public static function getAllCategories()
    {
        $em = FrontendModel::get('doctrine.orm.entity_manager');
        $qb = $em->createQueryBuilder();
        $qb->select('c, cl, m')
            ->from(self::CATEGORY_LOCALE_ENTITY_CLASS, 'cl')
            ->innerJoin('cl.category', 'c')
            ->innerJoin('cl.meta', 'm')
            ->where('cl.language = :language')
            ->orderBy('c.sequence', 'ASC')
            ->setParameter('language', FRONTEND_LANGUAGE)
        ;
        $query = $qb->getQuery();
        $results = $query->getResult();

        $categories = array();
        /** @var \Backend\Modules\News\Entity\CategoryLocale $result */
        foreach ($results as $result) {
            $categories[$result->getCategory()->getId()] = array(
                'id' => $result->getCategory()->getId(),
                'title' => $result->getTitle(),
                'url' => $result->getMeta()->getUrl()
            );
        }

        return $categories;
    }

    /**
     * Count all articles
     *
     * @param  string  $categoryUrl
     * @return int
     */
    public static function getAllCount($categoryUrl = null)
    {
        $em = FrontendModel::get('doctrine.orm.entity_manager');
        $qb = $em->createQueryBuilder();
        $qb->select('COUNT(al.id)')
            ->from(self::ARTICLE_LOCALE_ENTITY_CLASS, 'al')
            ->innerJoin('al.article', 'a', 'WITH', 'a.publishOn <= :now AND a.isHidden = :hidden')
            ->where('al.language = :language')
            ->orderBy('a.publishOn', 'DESC')
            ->setParameters(array(
                'language' => FRONTEND_LANGUAGE,
                'now' => new \DateTime(),
                'hidden' => false
            ))
        ;

        if ($categoryUrl !== null) {
            $qb->innerJoin('a.category', 'c');
            $qb->innerJoin('c.locales', 'cl', 'WITH', 'cl.language = :language');
            $qb->innerJoin('cl.meta', 'cm');
            $qb->andWhere('cm.url = :categoryUrl');
            $qb->setParameter('categoryUrl', $categoryUrl);
        }

        $query = $qb->getQuery();

        return (int) $query->getSingleScalarResult();
    }

    /**
     * Retrieve a specific article by it's url
     *
     * @param string $url
     * @return Array
     */
    public static function getByUrl($url)
    {
        $em = FrontendModel::get('doctrine.orm.entity_manager');
        $link = FrontendNavigation::getURLForBlock('News', 'Detail');
        $categoryLink = FrontendNavigation::getURLForBlock('News', 'Category');

        $qb = $em->createQueryBuilder();
        $query = $qb->select('al, a')
            ->from(self::ARTICLE_LOCALE_ENTITY_CLASS, 'al')
            ->innerJoin('al.article', 'a', 'WITH', 'a.publishOn <= :now AND a.isHidden = :hidden')
            ->innerJoin('al.meta', 'm', 'WITH', 'm.url = :url')
            ->where('al.language = :language')
            ->setParameters(array(
                'language' => FRONTEND_LANGUAGE,
                'now' => new \DateTime(),
                'hidden' => false,
                'url' => $url
            ))
            ->getQuery()
        ;
        /** @var \Backend\Modules\News\Entity\ArticleLocale $result */
        $result = $query->getOneOrNullResult();

        if (empty($result)) return null;


        $id = $result->getArticle()->getId();

        $rsm = new Query\ResultSetMapping();

        $rsm->addScalarResult('id', 'id');
        $query = $em->createNativeQuery('SELECT id FROM NewsArticle WHERE
        id = (SELECT id FROM NewsArticle WHERE id > ' . $id  . ' AND isHidden != ' . 1 . ' LIMIT 1)', $rsm);
        $next = $query->execute();


        $query = $em->createNativeQuery('SELECT id FROM NewsArticle WHERE
        id = (SELECT id FROM NewsArticle WHERE id < ' . $id  . ' AND isHidden != ' . 1 . ' ORDER BY id DESC LIMIT 1)', $rsm);
        $prev = $query->execute();

        if ( ! empty($next) ) {
            $qb = $em->createQueryBuilder();
            $query = $qb->select('al, a')
                ->from(self::ARTICLE_LOCALE_ENTITY_CLASS, 'al')
                ->innerJoin('al.article', 'a', 'WITH', 'a.publishOn <= :now AND a.isHidden = :hidden')
                ->innerJoin('al.meta', 'm', 'WITH', 'al.id = :id')
                ->where('al.language = :language')
                ->setParameters(array(
                    'language' => FRONTEND_LANGUAGE,
                    'now' => new \DateTime(),
                    'hidden' => false,
                    'id' => $next[0]['id']
                ))
                ->getQuery()
            ;
            /** @var \Backend\Modules\News\Entity\ArticleLocale $result */
            $next = $query->getOneOrNullResult();
            $next = $link . '/' . $next->getMeta()->getUrl();
        } else {
            $next = false;
        }

        if ( ! empty($prev) ) {
            $qb = $em->createQueryBuilder();
            $query = $qb->select('al, a')
                ->from(self::ARTICLE_LOCALE_ENTITY_CLASS, 'al')
                ->innerJoin('al.article', 'a', 'WITH', 'a.publishOn <= :now AND a.isHidden = :hidden')
                ->innerJoin('al.meta', 'm', 'WITH', 'al.id = :id')
                ->where('al.language = :language')
                ->setParameters(array(
                    'language' => FRONTEND_LANGUAGE,
                    'now' => new \DateTime(),
                    'hidden' => false,
                    'id' => $prev[0]['id']
                ))
                ->getQuery()
            ;
            /** @var \Backend\Modules\News\Entity\ArticleLocale $result */
            $prev = $query->getOneOrNullResult();


            $prev = $link . '/' . $prev->getMeta()->getUrl();
        } else {
            $prev = false;
        }


        $article = array(
            'id' => $result->getArticle()->getId(),
            'locale_id' => $result->getId(),
            'title' => $result->getTitle(),
            'content' => $result->getContent(),
            'publish_on' => FrontendModel::getUTCDate('U', $result->getArticle()->getPublishOn()->format('U')),
            'category_title' => $result->getArticle()->getCategory()->getLocale(FRONTEND_LANGUAGE)->getTitle(),
            'category_url' => $result->getArticle()->getCategory()->getLocale(FRONTEND_LANGUAGE)->getMeta()->getUrl(),
            'category_full_url' =>
                $categoryLink . '/' . $result->getArticle()->getCategory()->getLocale(FRONTEND_LANGUAGE)->getMeta()->getUrl(),
            'meta' => $result->getMeta(),
            'full_url' => $link . '/' . $result->getMeta()->getUrl(),
            'next_url' => $next,
            'prev_url' => $prev,
            'youtube_url' =>  $result->getArticle()->getYoutubeUrl()
        );

        if (FrontendModel::get('fork.settings')->getForModule('News', 'cover_image_enabled')) {
            $article['cover_image'] = $result->getArticle()->getCoverImage();
        }

        if (FrontendModel::get('fork.settings')->getForModule('News', 'multi_images_enabled')) {
            $qb = $em->createQueryBuilder();
            $query = $qb->select('ai')
                ->from(self::ARTICLE_IMAGE_ENTITY_CLASS, 'ai')
                ->where('ai.article = :article AND ai.isHidden = :hidden')
                ->orderBy('ai.sequence', 'ASC')
                ->setParameters(array(
                    'article' => $result->getArticle(),
                    'hidden' => false
                ))
                ->getQuery()
            ;
            $imageResult = $query->getResult();

            if (!empty($imageResult)) {
                foreach ($imageResult as $image) {
                    $article['images'][] = array(
                        'title' => $image->getTitle(),
                        'filename' => $image->getFilename()
                    );
                }
            }
        }

        // get tags
        $article['tags'] = FrontendTagsModel::getForItem('News', $article['locale_id']);

        return $article;
    }

    /**
     * Retrieve a specific article by it's url
     *
     * @param int $id
     * @return Array
     */
    public static function getById($id)
    {
        $em = FrontendModel::get('doctrine.orm.entity_manager');
        $link = FrontendNavigation::getURLForBlock('News', 'Detail');
        $categoryLink = FrontendNavigation::getURLForBlock('News', 'Category');

        $qb = $em->createQueryBuilder();
        $query = $qb->select('al, a')
            ->from(self::ARTICLE_LOCALE_ENTITY_CLASS, 'al')
            ->innerJoin('al.article', 'a', 'WITH', 'a.publishOn <= :now AND a.isHidden = :hidden')
            ->innerJoin('al.meta', 'm', 'WITH', 'm.url = :url')
            ->where('al.language = :language')
            ->setParameters(array(
                'language' => FRONTEND_LANGUAGE,
                'now' => new \DateTime(),
                'hidden' => false,
                'url' => $url
            ))
            ->getQuery()
        ;
        /** @var \Backend\Modules\News\Entity\ArticleLocale $result */
        $result = $query->getOneOrNullResult();

        if (empty($result)) return null;

        $article = array(
            'id' => $result->getArticle()->getId(),
            'locale_id' => $result->getId(),
            'title' => $result->getTitle(),
            'content' => $result->getContent(),
            'publish_on' => FrontendModel::getUTCDate('U', $result->getArticle()->getPublishOn()->format('U')),
            'category_title' => $result->getArticle()->getCategory()->getLocale(FRONTEND_LANGUAGE)->getTitle(),
            'category_url' => $result->getArticle()->getCategory()->getLocale(FRONTEND_LANGUAGE)->getMeta()->getUrl(),
            'category_full_url' =>
                $categoryLink . '/' . $result->getArticle()->getCategory()->getLocale(FRONTEND_LANGUAGE)->getMeta()->getUrl(),
            'meta' => $result->getMeta(),
            'full_url' => $link . '/' . $result->getMeta()->getUrl()
        );

        if (FrontendModel::get('fork.settings')->getForModule('News', 'cover_image_enabled')) {
            $article['cover_image'] = $result->getArticle()->getCoverImage();
        }

        if (FrontendModel::get('fork.settings')->getForModule('News', 'multi_images_enabled')) {
            $qb = $em->createQueryBuilder();
            $query = $qb->select('ai')
                ->from(self::ARTICLE_IMAGE_ENTITY_CLASS, 'ai')
                ->where('ai.article = :article AND ai.isHidden = :hidden')
                ->orderBy('ai.sequence', 'ASC')
                ->setParameters(array(
                    'article' => $result->getArticle(),
                    'hidden' => false
                ))
                ->getQuery()
            ;
            $imageResult = $query->getResult();

            if (!empty($imageResult)) {
                foreach ($imageResult as $image) {
                    $article['images'][] = array(
                        'title' => $image->getTitle(),
                        'filename' => $image->getFilename()
                    );
                }
            }
        }

        // get tags
        $article['tags'] = FrontendTagsModel::getForItem('News', $article['locale_id']);

        return $article;
    }

    /**
     * Retrieve a specific article by it's url
     *
     * @param array $ids
     * @return Array
     */
    public static function getAllByIds($ids)
    {
        $em = FrontendModel::get('doctrine.orm.entity_manager');
        $link = FrontendNavigation::getURLForBlock('News', 'Detail');
        $categoryLink = FrontendNavigation::getURLForBlock('News', 'Category');

        $qb = $em->createQueryBuilder();
        $query = $qb->select('al, a, m')
            ->from(self::ARTICLE_LOCALE_ENTITY_CLASS, 'al')
            ->innerJoin('al.article', 'a', 'WITH', 'a.publishOn <= :now AND a.isHidden = :hidden')
            ->innerJoin('al.meta', 'm')
            ->where('al.language = :language')
            ->andWhere($qb->expr()->in('a.id', ':ids'))
            ->setParameters(array(
                'language' => FRONTEND_LANGUAGE,
                'now' => new \DateTime(),
                'hidden' => false,
                'ids' => $ids
            ))
            ->getQuery()
        ;
        /** @var \Backend\Modules\News\Entity\ArticleLocale $result */
        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return $result;
    }

    public static function getAllImages($id){
        $em = FrontendModel::get('doctrine.orm.entity_manager');

        $qb = $em->createQueryBuilder();
        $query = $qb->select('ai')
            ->from(self::ARTICLE_IMAGE_ENTITY_CLASS, 'ai')
            ->where('ai.article = :id')
            ->andWhere('ai.isHidden = :hidden')
            ->orderBy('ai.sequence', 'ASC')
            ->setParameters(array(
                'id' => $id,
                'hidden' => false
            ))
            ->getQuery()
        ;
        /** @var \Backend\Modules\News\Entity\ArticleLocale $result */
        $result = $query->getResult(Query::HYDRATE_ARRAY);

        return $result;
    }

    /**
     * Fetch the list of tags for a list of items
     *
     * @param array $ids
     * @return array
     */
    public static function getForTags(array $ids)
    {
        $em = FrontendModel::get('doctrine.orm.entity_manager');

        $qb = $em->createQueryBuilder();
        $query = $qb->select('al, m')
            ->from(self::ARTICLE_LOCALE_ENTITY_CLASS, 'al')
            ->innerJoin('al.article', 'a')
            ->innerJoin('al.meta', 'm')
            ->where($qb->expr()->in('al.id', ':ids'))
            ->andWhere('a.isHidden = :hidden')
            ->andWhere('a.publishOn <= :now')
            ->andWhere('al.language <= :language')
            ->setParameters(array('ids' => (array) $ids, 'language' => FRONTEND_LANGUAGE, 'hidden' => false, 'now' => new \DateTime()))
            ->getQuery()
        ;
        $results = (array) $query->getResult();

        $items = array();
        if (!empty($results)) {
            $link = FrontendNavigation::getURLForBlock('News', 'Detail');

            // build the item urls
            foreach ($results as $result) {
                $items[] = array(
                    'title' => $result->getTitle(),
                    'full_url' => $link . '/' . $result->getMeta()->getUrl()
                );
            }
        }

        return $items;
    }

    /**
     * Get the id of an item by the full URL of the current page.
     * Selects the proper part of the full URL to get the item's id from the database.
     *
     * @param FrontendURL $url
     * @return int
     */
    public static function getIdForTags(FrontendURL $url)
    {
        $itemURL = (string) $url->getParameter(1);

        $item = self::getByUrl($itemURL);

        if (!empty($item)) {
            return $item['locale_id'];
        } else {
            return null;
        }
    }

    /**
     * Parse the search results for this module
     *
     * @param array $ids
     * @return array
     */
    public static function search(array $ids)
    {
        $em = FrontendModel::get('doctrine.orm.entity_manager');

        $qb = $em->createQueryBuilder();
        $query = $qb->select('al, a, m')
            ->from(self::ARTICLE_LOCALE_ENTITY_CLASS, 'al')
            ->innerJoin('al.article', 'a')
            ->innerJoin('al.meta', 'm')
            ->where($qb->expr()->in('a.id', ':ids'))
            ->andWhere('a.isHidden = :hidden')
            ->andWhere('a.publishOn <= :now')
            ->andWhere('al.language = :language')
            ->setParameters(array('language' => FRONTEND_LANGUAGE, 'hidden' => false, 'now' => new \DateTime(), 'ids' => $ids))
            ->getQuery()
        ;
        $results = (array) $query->getResult();

        $items = array();
        if (!empty($results)) {
            $link = FrontendNavigation::getURLForBlock('News', 'Detail');

            // build the item urls
            foreach ($results as $result) {
                $items[$result->getArticle()->getId()] = array(
                    'title' => $result->getTitle(),
                    'text' => $result->getContent(),
                    'full_url' => $link . '/' . $result->getMeta()->getUrl()
                );
            }
        }

        return $items;
    }

    /**
     * Parse the search results for this module
     *
     * @param int     $limit
     * @param int     $offset
     * @param string $term
     * @param string $categoryUrl
     * @return array
     */
    public static function searchByTerm($limit, $offset, $term, $categoryUrl = null)
    {
        $em = FrontendModel::get('doctrine.orm.entity_manager');

        $qb = $em->createQueryBuilder();
        $qb->select('al, a')
            ->from(self::ARTICLE_LOCALE_ENTITY_CLASS, 'al')
            ->innerJoin('al.article', 'a', 'WITH', 'a.publishOn <= :now AND a.isHidden = :hidden')
            ->where('al.language = :language')
            ->andWhere('al.title LIKE :term')
            ->orderBy('a.publishOn', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->setParameters(array(
                'language' => FRONTEND_LANGUAGE,
                'now' => new \DateTime(),
                'hidden' => false,
                'term' => $term .'%'
            ))
        ;

        if ($categoryUrl !== null) {
            $qb->innerJoin('a.category', 'c');
            $qb->innerJoin('c.locales', 'cl', 'WITH', 'cl.language = :language');
            $qb->innerJoin('cl.meta', 'cm');
            $qb->andWhere('cm.url = :categoryUrl');
            $qb->setParameter('categoryUrl', $categoryUrl);
        }

        $query = $qb->getQuery();
        $results = $query->getResult();


        $items = array();
        if (!empty($results)) {
            $link = FrontendNavigation::getURLForBlock('News', 'CustomDetail');

            // build the item urls
            foreach ($results as $result) {
                $items[$result->getArticle()->getId()] = array(
                    'title' => $result->getTitle(),
                    'text' => $result->getContent(),
                    'full_url' => $link . '/' . $result->getMeta()->getUrl(),
                    'content' => $result->getContent(),
                    'publish_on' => FrontendModel::getUTCDate('U', $result->getArticle()->getPublishOn()->format('U')),
                    'url' => $result->getMeta()->getUrl(),
                    'category_title' => $result->getArticle()->getCategory()->getLocale(FRONTEND_LANGUAGE)->getTitle(),
                );

                if (FrontendModel::get('fork.settings')->getForModule('News', 'cover_image_enabled')) {
                    $items[$result->getArticle()->getId()]['cover_image'] = $result->getArticle()->getCoverImage();
                }
            }
        }


        return $items;
    }
}

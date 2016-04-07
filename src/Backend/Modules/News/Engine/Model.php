<?php

namespace Backend\Modules\News\Engine;

use Common\Uri as CommonUri;

use Backend\Core\Engine\Model as BackendModel;
use Backend\Modules\News\Entity\Article;
use Backend\Modules\News\Entity\ArticleImage;

/**
 * In this file we store all generic functions that we will be using in the news module
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Model
{
    const ARTICLE_ENTITY_CLASS =                    'Backend\Modules\News\Entity\Article';
    const ARTICLE_LOCALE_ENTITY_CLASS =             'Backend\Modules\News\Entity\ArticleLocale';
    const ARTICLE_IMAGE_ENTITY_CLASS =              'Backend\Modules\News\Entity\ArticleImage';
    const CATEGORY_ENTITY_CLASS =                   'Backend\Modules\News\Entity\Category';
    const CATEGORY_LOCALE_ENTITY_CLASS =            'Backend\Modules\News\Entity\CategoryLocale';

    /**
     * Count all categories
     *
     * @return int
     */
    public static function countAllCategories(){
        $em = BackendModel::get('doctrine.orm.entity_manager');

        $query = $em->createQuery('SELECT COUNT(c.id) FROM ' . self::CATEGORY_ENTITY_CLASS . ' c');
        return $query->getSingleScalarResult();
    }

    /**
     * Retrieve a article
     *
     * @param int $id The article id
     * @return Article
     */
    public static function get($id){
        $em = BackendModel::get('doctrine.orm.entity_manager');

        return $em
            ->getRepository(self::ARTICLE_ENTITY_CLASS)
            ->find($id)
        ;
    }

    /**
     * Get all the categories
     *
     * @param bool $includeCount
     * @return array
     */
    public static function getCategories($includeCount = false)
    {
        $em = BackendModel::get('doctrine.orm.entity_manager');
        $categories = $em
            ->getRepository(self::CATEGORY_ENTITY_CLASS)
            ->findAll()
        ;
        $pairs = array();
        foreach ($categories as $category) {
            $pairs[$category->getId()] = $category->getBackendTitle();
            if ($includeCount) {
                $pairs[$category->getId()] .= ' (' . count($category->getArticles()) . ')';
            }
        }
        return $pairs;
    }


    /**
     * Retrieve an article
     *
     * @param int $id  The article id
     * @return Article
     */
    public static function getCategory($id){
        $em = BackendModel::get('doctrine.orm.entity_manager');

        return $em
            ->getRepository(self::CATEGORY_ENTITY_CLASS)
            ->find($id)
        ;
    }

    /**
     * Retrieve an article image
     *
     * @param  int $id  The article image id
     * @return ArticleImage
     */
    public static function getArticleImage($id){
        $em = BackendModel::get('doctrine.orm.entity_manager');

        return $em
            ->getRepository(self::ARTICLE_IMAGE_ENTITY_CLASS)
            ->find($id)
        ;
    }

    /**
     * Retrieve the unique URL for an item
     *
     * @param string $url
     * @param string $language
     * @param int    $id The id of the item to ignore.
     * @return string
     */
    public static function getURL($url, $language, $id = null)
    {
        $url = CommonUri::getUrl((string) $url);
        $em = BackendModel::get('doctrine.orm.entity_manager');
        $articleWithUrl = $em
            ->getRepository(self::ARTICLE_LOCALE_ENTITY_CLASS)
            ->findByUrl($url, $language, $id)
        ;
        if (!empty($articleWithUrl)) {
            $url = BackendModel::addNumber($url);
            return self::getURL($url, $language);
        }
        return $url;
    }

    /**
     * Retrieve the unique URL for an category
     *
     * @param string $url
     * @param string $language
     * @param int    $id The id of the category to ignore.
     * @return string
     */
    public static function getCategoryURL($url, $language, $id = null)
    {
        $url = CommonUri::getUrl((string) $url);
        $em = BackendModel::get('doctrine.orm.entity_manager');
        $categoryWithUrl = $em
            ->getRepository(self::CATEGORY_LOCALE_ENTITY_CLASS)
            ->findByUrl($url, $language, $id)
        ;
        if (!empty($categoryWithUrl)) {
            $url = BackendModel::addNumber($url);
            return self::getURL($url, $language);
        }
        return $url;
    }

    /**
     * Get the maximum sequence for a category
     *
     * @return int
     */
    public static function getMaximumCategorySequence()
    {
        $em = BackendModel::get('doctrine.orm.entity_manager');
        $maxCategory = $em
            ->getRepository(self::CATEGORY_ENTITY_CLASS)
            ->findOneBy(
                array(),
                array('sequence' => 'DESC')
            )
        ;
        return empty($maxCategory) ? 0 : $maxCategory->getSequence();
    }

    /**
     * Get the maximum sequence for an article image
     *
     * @param Article $article
     * @return int
     */
    public static function getMaximumArticleImageSequence(Article $article)
    {
        $em = BackendModel::get('doctrine.orm.entity_manager');
        $maxImage = $em
            ->getRepository(self::ARTICLE_IMAGE_ENTITY_CLASS)
            ->findOneBy(
                array('article' => $article),
                array('sequence' => 'DESC')
            )
        ;
        return empty($maxImage) ? 0 : $maxImage->getSequence();
    }
}

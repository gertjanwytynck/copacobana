<?php

namespace Backend\Modules\News\Entity;

use Doctrine\ORM\Mapping as ORM;
use Backend\Core\Entity\Meta;

/**
 * ArticleLocale
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 *
 * @ORM\Entity(repositoryClass="Backend\Modules\News\Entity\ArticleLocaleRepository")
 * @ORM\Table(
 *   name="NewsArticleLocale",
 *   indexes={@ORM\Index(
 *       name="fk_article_locales",
 *       columns={"language"}
 *   )}
 * )
 */
class ArticleLocale
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Article
     *
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="locales")
     * @ORM\JoinColumn(name="articleId", referencedColumnName="id", nullable=false)
     **/
    private $article;

    /**
     * @var Meta
     *
     * @ORM\OneToOne(targetEntity="Backend\Core\Entity\Meta", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="metaId", referencedColumnName="id", nullable=false)
     **/
    private $meta;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=5)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $content;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set article
     *
     * @param Article $article
     * @return ArticleLocale
     */
    public function setArticle(Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set meta
     *
     * @param Meta $meta
     * @return ArticleLocale
     */
    public function setMeta(Meta $meta)
    {
        $this->meta = $meta;
        return $this;
    }
    /**
     * Get meta
     *
     * @return Meta
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return ArticleLocale
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return ArticleLocale
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return ArticleLocale
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}

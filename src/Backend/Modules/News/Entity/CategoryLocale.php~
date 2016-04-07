<?php

namespace Backend\Modules\News\Entity;

use Doctrine\ORM\Mapping as ORM;
use Backend\Core\Entity\Meta;

/**
 * CategoryLocale
 *
 * @ORM\Entity(repositoryClass="Backend\Modules\News\Entity\CategoryLocaleRepository")
 * @ORM\Table(
 *   name="NewsCategoryLocale",
 *   indexes={@ORM\Index(
 *       name="fk_article_category_locales",
 *       columns={"language"}
 *   )}
 * )
 */
class CategoryLocale
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
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="locales")
     * @ORM\JoinColumn(name="categoryId", referencedColumnName="id", nullable=false)
     **/
    private $category;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return CategoryLocale
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
     * @return CategoryLocale
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
     * Set category
     *
     * @param Category $category
     * @return CategoryLocale
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set meta
     *
     * @param \Backend\Core\Entity\Meta $meta
     * @return CategoryLocale
     */
    public function setMeta(\Backend\Core\Entity\Meta $meta)
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Get meta
     *
     * @return \Backend\Core\Entity\Meta 
     */
    public function getMeta()
    {
        return $this->meta;
    }
}

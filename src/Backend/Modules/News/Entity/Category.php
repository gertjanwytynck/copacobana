<?php

namespace Backend\Modules\News\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This is the News Category Entity
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="NewsCategory")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer", length=11)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CategoryLocale", mappedBy="category", cascade={"persist", "remove"})
     */
    private $locales;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Article", mappedBy="category", cascade={"persist", "remove"})
     */
    private $articles;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $backendTitle;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $sequence;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdOn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $editedOn;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->locales = new ArrayCollection();
    }

    /**
     *  @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->createdOn = $this->editedOn = new \Datetime();
    }

    /**
     *  @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->editedOn = new \Datetime();
    }

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
     * Set sequence
     *
     * @param integer $sequence
     * @return Category
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;

        return $this;
    }

    /**
     * Get sequence
     *
     * @return integer 
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return Category
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime 
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set editedOn
     *
     * @param \DateTime $editedOn
     * @return Category
     */
    public function setEditedOn($editedOn)
    {
        $this->editedOn = $editedOn;

        return $this;
    }

    /**
     * Get editedOn
     *
     * @return \DateTime 
     */
    public function getEditedOn()
    {
        return $this->editedOn;
    }

    /**
     * Add locales
     *
     * @param CategoryLocale $locales
     * @return Category
     */
    public function addLocale(CategoryLocale $locales)
    {
        $this->locales[] = $locales;

        return $this;
    }

    /**
     * Remove locales
     *
     * @param CategoryLocale $locales
     */
    public function removeLocale(CategoryLocale $locales)
    {
        $this->locales->removeElement($locales);
    }

    /**
     * Get locales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLocales()
    {
        return $this->locales;
    }

    /**
     * Get locale
     *
     * @param string $language
     * @return CategoryLocale
     */
    public function getLocale($language)
    {
        if ($this->getLocales() !== null) {
            foreach ($this->locales as $locale) {
                if ($locale->getLanguage() == $language) return $locale;
            }
        }

        return null;
    }

    /**
     * Add articles
     *
     * @param Article $articles
     * @return Category
     */
    public function addArticle(Article $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param Article $articles
     */
    public function removeArticle(Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Set backend title
     *
     * @param string $backendTitle
     * @return Article
     */
    public function setBackendTitle($backendTitle)
    {
        $this->backendTitle = $backendTitle;

        return $this;
    }

    /**
     * Get backend title
     *
     * @return string
     */
    public function getBackendTitle()
    {
        return $this->backendTitle;
    }
}

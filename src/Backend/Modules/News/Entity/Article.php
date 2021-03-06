<?php

namespace Backend\Modules\News\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

/**
 * This is the Article Entity
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 *
 * @ORM\Entity
 * @ORM\Table(name="NewsArticle")
 * @ORM\HasLifecycleCallbacks
 */
class Article
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
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ArticleLocale", mappedBy="article", cascade={"persist", "remove"})
     */
    private $locales;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="articles")
     * @ORM\JoinColumn(name="categoryId", referencedColumnName="id", nullable=false)
     **/
    private $category;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ArticleImage", mappedBy="article", cascade={"persist", "remove"})
     */
    private $images;

    /**
     * @var integer
     *
     * @ORM\Column(name="userId", type="integer")
     */
    private $author; // @todo Replace this with an relation once the user entity is integrated in fork cms!

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $backendTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $youtubeUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $coverImage;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $isHidden = false;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $spotlight = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $publishOn;

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
        $this->publishOn = new \DateTime();

        $this->locales = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->createdOn = $this->editedOn = new \Datetime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->editedOn = new \Datetime();
    }

    /**
     * @ORM\PostRemove
     */
    public function postRemove()
    {
        $this->removeCoverImage();
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
     * Set author
     *
     * @param int $userId
     * @return Article
     */
    public function setAuthor($userId)
    {
        $this->author = $userId;

        return $this;
    }

    /**
     * Get author
     *
     * @return int
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Sets the value of isHidden.
     *
     * @param boolean $isHidden the is hidden
     * @return self
     */
    public function setIsHidden($isHidden)
    {
        $this->isHidden = $isHidden;
        return $this;
    }

    /**
     * Gets the value of isHidden.
     *
     * @return boolean
     */
    public function getIsHidden()
    {
        return $this->isHidden;
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

    /**
     * Set cover image
     *
     * @param string $coverImage
     * @return Article
     */
    public function setCoverImage($coverImage)
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    /**
     * Get cover image
     *
     * @return string
     */
    public function getCoverImage()
    {
        return $this->coverImage;
    }

    /**
     * Remove cover image
     *
     * @return bool
     */
    public function removeCoverImage()
    {
        if ($this->coverImage !== null) {
            $finder = new Finder();
            $fs = new Filesystem();
            $imagePath = FRONTEND_FILES_PATH . '/news/covers';

            foreach ($finder->directories()->in($imagePath) as $directory) {
                $file = $directory . '/' . $this->coverImage;

                if (is_file($file)) {
                    $fs->remove($file);
                }
            }

            $this->coverImage = null;

            return true;
        }

        return false;
    }

    /**
     * Set publishOn
     *
     * @param \DateTime $publishOn
     * @return Article
     */
    public function setPublishOn($publishOn)
    {
        $this->publishOn = $publishOn;

        return $this;
    }

    /**
     * Get publishOn
     *
     * @return \DateTime
     */
    public function getPublishOn()
    {
        return $this->publishOn;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return Article
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
     * @return Article
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
     * @param Articlelocale $locales
     * @return Article
     */
    public function addLocale(ArticleLocale $locales)
    {
        $this->locales[] = $locales;

        return $this;
    }

    /**
     * Remove locales
     *
     * @param ArticleLocale $locales
     */
    public function removeLocale(ArticleLocale $locales)
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
     * @return ArticleLocale
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
     * Set category
     *
     * @param Category $category
     * @return Article
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
     * Add images
     *
     * @param ArticleImage $images
     * @return Article
     */
    public function addImage(ArticleImage $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param ArticleImage $images
     */
    public function removeImage(ArticleImage $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set youtubeUrl
     *
     * @param string $youtubeUrl
     * @return Article
     */
    public function setYoutubeUrl($youtubeUrl)
    {
        $this->youtubeUrl = $youtubeUrl;

        return $this;
    }

    /**
     * Get youtubeUrl
     *
     * @return string 
     */
    public function getYoutubeUrl()
    {
        return $this->youtubeUrl;
    }

    /**
     * Set spotlight
     *
     * @param boolean $spotlight
     * @return Article
     */
    public function setSpotlight($spotlight)
    {
        $this->spotlight = $spotlight;

        return $this;
    }

    /**
     * Get spotlight
     *
     * @return boolean 
     */
    public function getSpotlight()
    {
        return $this->spotlight;
    }
}

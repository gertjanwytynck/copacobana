<?php

namespace Backend\Modules\News\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

/**
 * This is the ArticleImage Entity
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 *
 * @ORM\Entity
 * @ORM\Table(name="NewsArticleImage")
 * @ORM\HasLifecycleCallbacks
 */
class ArticleImage
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
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="images")
     * @ORM\JoinColumn(name="articleId", referencedColumnName="id", nullable=false)
     */
    private $article;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $original;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $sequence;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $isHidden = false;

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
        $this->removeImage();
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
     * Set title
     *
     * @param string $title
     * @return ArticleImage
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
     * Set filename
     *
     * @param string $filename
     * @return ArticleImage
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set original
     *
     * @param string $original
     * @return ArticleImage
     */
    public function setOriginal($original)
    {
        $this->original = $original;

        return $this;
    }

    /**
     * Get original
     *
     * @return string
     */
    public function getOriginal()
    {
        return $this->original;
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
     * Set isHidden
     *
     * @param boolean $isHidden
     * @return ArticleImage
     */
    public function setIsHidden($isHidden)
    {
        $this->isHidden = $isHidden;

        return $this;
    }

    /**
     * Get isHidden
     *
     * @return boolean 
     */
    public function getIsHidden()
    {
        return $this->isHidden;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return ArticleImage
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
     * @return ArticleImage
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
     * Set article
     *
     * @param Article $article
     * @return ArticleImage
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
     * Remove image
     */
    public function removeImage()
    {
        $finder = new Finder();
        $fs = new Filesystem();
        $imagePath = FRONTEND_FILES_PATH . '/news/images';

        foreach ($finder->directories()->in($imagePath) as $directory) {
            $file = $directory . '/' . $this->filename;

            if (is_file($file)) {
                $fs->remove($file);
            }
        }
    }
}

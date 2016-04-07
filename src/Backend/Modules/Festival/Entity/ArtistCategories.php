<?php

namespace Backend\Modules\Festival\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

/**
 * This is the Artist Categories Entity
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 *
 * @ORM\Entity(repositoryClass="Backend\Modules\Festival\Entity\ArtistCategoriesRepository")
 * @ORM\Table(name="ArtistCategories")
 * @ORM\HasLifecycleCallbacks
 */
class ArtistCategories
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
     * @ORM\OneToMany(targetEntity="Artist", mappedBy="category", cascade={"persist", "remove"})
     */
    private $artist;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $url;

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
        $this->artist = new ArrayCollection();
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return ArtistCategories
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return ArtistCategories
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Add artist
     *
     * @param \Backend\Modules\Festival\Entity\Artist $artist
     * @return ArtistCategories
     */
    public function addArtist(\Backend\Modules\Festival\Entity\Artist $artist)
    {
        $this->artist[] = $artist;

        return $this;
    }

    /**
     * Remove artist
     *
     * @param \Backend\Modules\Festival\Entity\Artist $artist
     */
    public function removeArtist(\Backend\Modules\Festival\Entity\Artist $artist)
    {
        $this->artist->removeElement($artist);
    }

    /**
     * Get artist
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return ArtistCategories
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return ArtistCategories
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
     * @return ArtistCategories
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
}

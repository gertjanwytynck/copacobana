<?php

namespace Backend\Modules\Festival\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

/**
 * This is the Artist Stage Entity
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 *
 * @ORM\Entity(repositoryClass="Backend\Modules\Festival\Entity\ArtistStageRepository")
 * @ORM\Table(name="ArtistStage")
 * @ORM\HasLifecycleCallbacks
 */
class ArtistStage
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
     * @var Stage
     *
     * @ORM\OneToMany(targetEntity="ArtistDate", mappedBy="stage", cascade={"persist", "remove"})
     */
    private $stage;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $stageName;

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
        $this->artists = new ArrayCollection();
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
     * Set stageName
     *
     * @param string $stageName
     * @return ArtistStages
     */
    public function setStageName($stageName)
    {
        $this->stageName = $stageName;

        return $this;
    }

    /**
     * Get stageName
     *
     * @return string
     */
    public function getStageName()
    {
        return $this->stageName;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return ArtistStages
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
     * @return ArtistStages
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
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return ArtistStages
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
     * @return ArtistStages
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
     * Add artists
     *
     * @param \Backend\Modules\Festival\Entity\Artist $artists
     * @return ArtistStages
     */
    public function addArtist(\Backend\Modules\Festival\Entity\Artist $artists)
    {
        $this->artists[] = $artists;

        return $this;
    }

    /**
     * Remove artists
     *
     * @param \Backend\Modules\Festival\Entity\Artist $artists
     */
    public function removeArtist(\Backend\Modules\Festival\Entity\Artist $artists)
    {
        $this->artists->removeElement($artists);
    }

    /**
     * Get artists
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFestival()
    {
        return $this->artists;
    }

    /**
     * Get artists
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArtists()
    {
        return $this->artists;
    }

    /**
     * Set artist
     *
     * @param \Backend\Modules\Festival\Entity\ArtistDate $artist
     *
     * @return ArtistStage
     */
    public function setArtist(\Backend\Modules\Festival\Entity\ArtistDate $artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return \Backend\Modules\Festival\Entity\ArtistDate
     */
    public function getArtist()
    {
        return $this->artist;
    }
}

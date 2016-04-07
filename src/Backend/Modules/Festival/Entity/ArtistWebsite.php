<?php

namespace Backend\Modules\Festival\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

/**
 * This is the Artist Website Entity
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="ArtistWebsite")
 * @ORM\HasLifecycleCallbacks
 */
class ArtistWebsite
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
     * @ORM\OneToMany(targetEntity="ArtistWebsiteLocale", mappedBy="artist", cascade={"persist", "remove"})
     */
    private $locales;

    /**
     * @var Artist
     *
     * @ORM\ManyToOne(targetEntity="Artist", inversedBy="website")
     * @ORM\JoinColumn(name="artistId", referencedColumnName="id", nullable=false)
     */
    private $artist;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $facebookUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $twitterUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $youtubeUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $instagramUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $soundcloudUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $websiteUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $bio;

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
        $this->locales = new ArrayCollection();
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
     * Set facebookUrl
     *
     * @param string $facebookUrl
     * @return ArtistWebsite
     */
    public function setFacebookUrl($facebookUrl)
    {
        $this->facebookUrl = $facebookUrl;

        return $this;
    }

    /**
     * Get facebookUrl
     *
     * @return string 
     */
    public function getFacebookUrl()
    {
        return $this->facebookUrl;
    }

    /**
     * Set twitterUrl
     *
     * @param string $twitterUrl
     * @return ArtistWebsite
     */
    public function setTwitterUrl($twitterUrl)
    {
        $this->twitterUrl = $twitterUrl;

        return $this;
    }

    /**
     * Get twitterUrl
     *
     * @return string 
     */
    public function getTwitterUrl()
    {
        return $this->twitterUrl;
    }

    /**
     * Set youtubeUrl
     *
     * @param string $youtubeUrl
     * @return ArtistWebsite
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
     * Set instagramUrl
     *
     * @param string $instagramUrl
     * @return ArtistWebsite
     */
    public function setInstagramUrl($instagramUrl)
    {
        $this->instagramUrl = $instagramUrl;

        return $this;
    }

    /**
     * Get instagramUrl
     *
     * @return string 
     */
    public function getInstagramUrl()
    {
        return $this->instagramUrl;
    }

    /**
     * Set soundcloudUrl
     *
     * @param string $soundcloudUrl
     * @return ArtistWebsite
     */
    public function setSoundcloudUrl($soundcloudUrl)
    {
        $this->soundcloudUrl = $soundcloudUrl;

        return $this;
    }

    /**
     * Get soundcloudUrl
     *
     * @return string 
     */
    public function getSoundcloudUrl()
    {
        return $this->soundcloudUrl;
    }

    /**
     * Set websiteUrl
     *
     * @param string $websiteUrl
     * @return ArtistWebsite
     */
    public function setWebsiteUrl($websiteUrl)
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    /**
     * Get websiteUrl
     *
     * @return string 
     */
    public function getWebsiteUrl()
    {
        return $this->websiteUrl;
    }

    /**
     * Set bio
     *
     * @param string $bio
     * @return ArtistWebsite
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio
     *
     * @return string 
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return ArtistWebsite
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
     * @return ArtistWebsite
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
     * @param \Backend\Modules\Festival\Entity\ArtistWebsiteLocale $locales
     * @return ArtistWebsite
     */
    public function addLocale(\Backend\Modules\Festival\Entity\ArtistWebsiteLocale $locales)
    {
        $this->locales[] = $locales;

        return $this;
    }

    /**
     * Remove locales
     *
     * @param \Backend\Modules\Festival\Entity\ArtistWebsiteLocale $locales
     */
    public function removeLocale(\Backend\Modules\Festival\Entity\ArtistWebsiteLocale $locales)
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
     * @return TypeLocale
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
     * Set artist
     *
     * @param \Backend\Modules\Festival\Entity\Artist $artist
     * @return ArtistWebsite
     */
    public function setArtist(\Backend\Modules\Festival\Entity\Artist $artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return \Backend\Modules\Festival\Entity\Artist
     */
    public function getArtist()
    {
        return $this->artist;
    }
}

<?php

namespace Backend\Modules\Festival\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

/**
 * This is the Artist Website Locale Entity
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="ArtistWebsiteLocale")
 * @ORM\HasLifecycleCallbacks
 */
class ArtistWebsiteLocale
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
     * @var Artist
     *
     * @ORM\ManyToOne(targetEntity="ArtistWebsite", inversedBy="locales")
     * @ORM\JoinColumn(name="artistWebsiteId", referencedColumnName="id", nullable=false)
     */
    private $artist;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=5)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $bio;


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
     * @return ArtistWebsiteLocale
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
     * Set bio
     *
     * @param string $bio
     * @return ArtistWebsiteLocale
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
     * Set artist
     *
     * @param \Backend\Modules\Festival\Entity\ArtistWebsite $artist
     * @return ArtistWebsiteLocale
     */
    public function setArtist(\Backend\Modules\Festival\Entity\ArtistWebsite $artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return \Backend\Modules\Festival\Entity\ArtistWebsite
     */
    public function getArtist()
    {
        return $this->artist;
    }
}

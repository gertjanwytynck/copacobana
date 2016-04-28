<?php

namespace Backend\Modules\Festival\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

/**
 * This is the Artist Practical Backstage Entity
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="ArtistPracticalBackstage")
 * @ORM\HasLifecycleCallbacks
 */
class ArtistPracticalBackstage
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
     * @ORM\ManyToOne(targetEntity="ArtistPractical", inversedBy="backstage")
     * @ORM\JoinColumn(name="artistPracticalId", referencedColumnName="id", nullable=false)
     */
    private $artist;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

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
     * Set name
     *
     * @param string $name
     * @return ArtistPracticalBackstage
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set artist
     *
     * @param \Backend\Modules\Festival\Entity\ArtistPractical $artist
     * @return ArtistPracticalBackstage
     */
    public function setArtist(\Backend\Modules\Festival\Entity\ArtistPractical $artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return \Backend\Modules\Festival\Entity\ArtistPractical
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return ArtistPracticalBackstage
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}

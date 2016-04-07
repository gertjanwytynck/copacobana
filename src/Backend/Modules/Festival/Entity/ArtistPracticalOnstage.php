<?php

namespace Backend\Modules\Festival\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

/**
 * This is the Artist Practical Onstage Entity
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="ArtistPracticalOnstage")
 * @ORM\HasLifecycleCallbacks
 */
class ArtistPracticalOnstage
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
     * @ORM\ManyToOne(targetEntity="ArtistPractical", inversedBy="onstage")
     * @ORM\JoinColumn(name="artistPracticalId", referencedColumnName="id", nullable=false)
     */
    private $artist;

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
     * @return ArtistPracticalOnstage
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
     * Set firstName
     *
     * @param string $firstName
     * @return ArtistPracticalOnstage
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set artist
     *
     * @param \Backend\Modules\Festival\Entity\ArtistPractical $artist
     * @return ArtistPracticalOnstage
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
}

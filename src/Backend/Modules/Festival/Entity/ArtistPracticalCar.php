<?php

namespace Backend\Modules\Festival\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This is the Artist Entity
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="ArtistPracticalCar")
 * @ORM\HasLifecycleCallbacks
 */
class ArtistPracticalCar
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
   * @ORM\ManyToOne(targetEntity="ArtistPractical", inversedBy="car")
   * @ORM\JoinColumn(name="artistPracticalId", referencedColumnName="id", nullable=false)
   */
  private $artist;

 /**
   * @var string
   *
   * @ORM\Column(type="string", nullable=true)
   */
  private $licencePlate;



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
     * Set licencePlate
     *
     * @param string $licencePlate
     *
     * @return ArtistPracticalCar
     */
    public function setLicencePlate($licencePlate)
    {
        $this->licencePlate = $licencePlate;

        return $this;
    }

    /**
     * Get licencePlate
     *
     * @return string
     */
    public function getLicencePlate()
    {
        return $this->licencePlate;
    }

    /**
     * Set artist
     *
     * @param \Backend\Modules\Festival\Entity\ArtistPractical $artist
     *
     * @return ArtistPracticalCar
     */
    public function setArtist(\Backend\Modules\Festival\Entity\ArtistPractical $artist)
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

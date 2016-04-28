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
 * @ORM\Table(name="ArtistDate")
 * @ORM\HasLifecycleCallbacks
 */
class ArtistDate
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
   * @ORM\ManyToOne(targetEntity="Artist", inversedBy="date")
   * @ORM\JoinColumn(name="artistId", referencedColumnName="id", nullable=false)
   */
  private $artist;

  /**
   * @var Stage
   *
   * @ORM\ManyToOne(targetEntity="ArtistStage", inversedBy="stage")
   * @ORM\JoinColumn(name="stageId", referencedColumnName="id", nullable=false)
   */
  private $stage;

   /**
   * @var Category
   *
   * @ORM\ManyToOne(targetEntity="ArtistCategories", inversedBy="cat")
   * @ORM\JoinColumn(name="categoryId", referencedColumnName="id", nullable=false)
   */
  private $category;

  /**
   * @var \DateTime
   *
   * @ORM\Column(type="datetime")
   */
  private $startOn;

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
   * Constructor
   */
  public function __construct()
  {
    $this->stage = new ArrayCollection();
    $this->category = new ArrayCollection();
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
   * Set startOn
   *
   * @param \DateTime $startOn
   *
   * @return ArtistDate
   */
  public function setStartOn($startOn)
  {
      $this->startOn = $startOn;

      return $this;
  }

  /**
   * Get startOn
   *
   * @return \DateTime
   */
  public function getStartOn()
  {
      return $this->startOn;
  }

  /**
   * Set createdOn
   *
   * @param \DateTime $createdOn
   *
   * @return ArtistDate
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
   *
   * @return ArtistDate
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
   * Add artist
   *
   * @param \Backend\Modules\Festival\Entity\Artist $artist
   *
   * @return ArtistDate
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
   * Set artist
   *
   * @param \Backend\Modules\Festival\Entity\Artist $artist
   *
   * @return ArtistDate
   */
  public function setArtist(\Backend\Modules\Festival\Entity\Artist $artist)
  {
      $this->artist = $artist;

      return $this;
  }

  /**
   * Set stage
   *
   * @param \Backend\Modules\Festival\Entity\ArtistStage $stage
   *
   * @return ArtistDate
   */
  public function setStage(\Backend\Modules\Festival\Entity\ArtistStage $stage)
  {
      $this->stage = $stage;

      return $this;
  }

  /**
   * Get stage
   *
   * @return \Backend\Modules\Festival\Entity\ArtistStage
   */
  public function getStage()
  {
      return $this->stage;
  }

  /**
   * Set category
   *
   * @param \Backend\Modules\Festival\Entity\ArtistCategories $category
   *
   * @return ArtistDate
   */
  public function setCategory(\Backend\Modules\Festival\Entity\ArtistCategories $category)
  {
      $this->category = $category;

      return $this;
  }

  /**
   * Get category
   *
   * @return \Backend\Modules\Festival\Entity\ArtistCategories
   */
  public function getCategory()
  {
      return $this->category;
  }

  /**
   * Add stage
   *
   * @param \Backend\Modules\Festival\Entity\ArtistStage $stage
   *
   * @return ArtistDate
   */
  public function addStage(\Backend\Modules\Festival\Entity\ArtistStage $stage)
  {
      $this->stage[] = $stage;

      return $this;
  }

  /**
   * Remove stage
   *
   * @param \Backend\Modules\Festival\Entity\ArtistStage $stage
   */
  public function removeStage(\Backend\Modules\Festival\Entity\ArtistStage $stage)
  {
      $this->stage->removeElement($stage);
  }

  /**
   * Add category
   *
   * @param \Backend\Modules\Festival\Entity\ArtistCategories $category
   *
   * @return ArtistDate
   */
  public function addCategory(\Backend\Modules\Festival\Entity\ArtistCategories $category)
  {
      $this->category[] = $category;

      return $this;
  }

  /**
   * Remove category
   *
   * @param \Backend\Modules\Festival\Entity\ArtistCategories $category
   */
  public function removeCategory(\Backend\Modules\Festival\Entity\ArtistCategories $category)
  {
      $this->category->removeElement($category);
  }
}

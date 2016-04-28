<?php

namespace Backend\Modules\Festival\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

/**
 * This is the Artist Practical Entity
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="ArtistPractical")
 * @ORM\HasLifecycleCallbacks
 */
class ArtistPractical
{
    /**
     * @var integer
     *
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Artist
     *
     * @ORM\ManyToOne(targetEntity="Artist", inversedBy="practical")
     * @ORM\JoinColumn(name="artistId", referencedColumnName="id", nullable=false)
     */
    private $artist;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ArtistPracticalBackstage", mappedBy="artist", cascade={"persist", "remove"})
     */
    private $backstage;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ArtistPracticalCar", mappedBy="artist", cascade={"persist", "remove"})
     */
    private $car;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $contactName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $contactFirstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $contactPhone;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $contactEmail;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $soundEngineer = false;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hotMeal;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $veggieMeal;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $veganMeal;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $technicalFilename;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $contractFilename;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $stageFilename;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $remark;

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
        $this->backstage = new ArrayCollection();
        $this->car = new ArrayCollection();
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
        $this->removeTechnical();
        $this->removeContract();
        $this->removeStage();
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
     * Set contactName
     *
     * @param string $contactName
     * @return ArtistPractical
     */
    public function setContactName($contactName)
    {
        $this->contactName = $contactName;

        return $this;
    }

    /**
     * Get contactName
     *
     * @return string
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * Set contactFirstName
     *
     * @param string $contactFirstName
     * @return ArtistPractical
     */
    public function setContactFirstName($contactFirstName)
    {
        $this->contactFirstName = $contactFirstName;

        return $this;
    }

    /**
     * Get contactFirstName
     *
     * @return string
     */
    public function getContactFirstName()
    {
        return $this->contactFirstName;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     * @return ArtistPractical
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     * @return ArtistPractical
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set soundEngineer
     *
     * @param boolean $soundEngineer
     * @return ArtistPractical
     */
    public function setSoundEngineer($soundEngineer)
    {
        $this->soundEngineer = $soundEngineer;

        return $this;
    }

    /**
     * Get soundEngineer
     *
     * @return boolean
     */
    public function getSoundEngineer()
    {
        return $this->soundEngineer;
    }

    /**
     * Set hotMeal
     *
     * @param integer $hotMeal
     * @return ArtistPractical
     */
    public function setHotMeal($hotMeal)
    {
        $this->hotMeal = $hotMeal;

        return $this;
    }

    /**
     * Get hotMeal
     *
     * @return integer
     */
    public function getHotMeal()
    {
        return $this->hotMeal;
    }

    /**
     * Set veggieMeal
     *
     * @param integer $veggieMeal
     * @return ArtistPractical
     */
    public function setVeggieMeal($veggieMeal)
    {
        $this->veggieMeal = $veggieMeal;

        return $this;
    }

    /**
     * Get veggieMeal
     *
     * @return integer
     */
    public function getVeggieMeal()
    {
        return $this->veggieMeal;
    }

    /**
     * Set totalCars
     *
     * @param integer $totalCars
     * @return ArtistPractical
     */
    public function setTotalCars($totalCars)
    {
        $this->totalCars = $totalCars;

        return $this;
    }

    /**
     * Get totalCars
     *
     * @return integer
     */
    public function getTotalCars()
    {
        return $this->totalCars;
    }

    /**
     * Set technicalFilename
     *
     * @param string $technicalFilename
     * @return ArtistPractical
     */
    public function setTechnicalFilename($technicalFilename)
    {
        $this->technicalFilename = $technicalFilename;

        return $this;
    }

    /**
     * Get technicalFilename
     *
     * @return string
     */
    public function getTechnicalFilename()
    {
        return $this->technicalFilename;
    }

    /* Remove file image
    *
    * @return bool
    */
    public function removeTechnical()
    {
        if ($this->technicalFilename !== null) {
            $finder = new Finder();
            $fs = new Filesystem();
            $imagePath = FRONTEND_FILES_PATH . '/festival/artists/files/technical';

            foreach ($finder->directories()->in($imagePath) as $directory) {
                $file = $directory . '/' . $this->technicalFilename;

                if (is_file($file)) {
                    $fs->remove($file);
                }
            }

            $this->technicalFilename = null;

            return true;
        }

        return false;
    }

    /**
     * Set contractFilename
     *
     * @param string $contractFilename
     * @return ArtistPractical
     */
    public function setContractFilename($contractFilename)
    {
        $this->contractFilename = $contractFilename;

        return $this;
    }

    /**
     * Get contractFilename
     *
     * @return string
     */
    public function getContractFilename()
    {
        return $this->contractFilename;
    }


    /* Remove file image
    *
    * @return bool
    */
    public function removeContract()
    {
        if ($this->contractFilename !== null) {
            $finder = new Finder();
            $fs = new Filesystem();
            $imagePath = FRONTEND_FILES_PATH . '/festival/artists/files/contract';

            foreach ($finder->directories()->in($imagePath) as $directory) {
                $file = $directory . '/' . $this->contractFilename;

                if (is_file($file)) {
                    $fs->remove($file);
                }
            }

            $this->contractFilename = null;

            return true;
        }

        return false;
    }

    /**
     * Set remark
     *
     * @param string $remark
     * @return ArtistPractical
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Get remark
     *
     * @return string
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return ArtistPractical
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
     * @return ArtistPractical
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
     * Set artist
     *
     * @param \Backend\Modules\Festival\Entity\Artist $artist
     * @return ArtistPractical
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

    /**
     * Add backstage
     *
     * @param \Backend\Modules\Festival\Entity\ArtistPracticalBackstage $backstage
     * @return ArtistPractical
     */
    public function addBackstage(\Backend\Modules\Festival\Entity\ArtistPracticalBackstage $backstage)
    {
        $this->backstage[] = $backstage;

        return $this;
    }

    /**
     * Remove backstage
     *
     * @param \Backend\Modules\Festival\Entity\ArtistPracticalBackstage $backstage
     */
    public function removeBackstage(\Backend\Modules\Festival\Entity\ArtistPracticalBackstage $backstage)
    {
        $this->backstage->removeElement($backstage);
    }

    /**
     * Get backstage
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBackstage()
    {
        return $this->backstage;
    }

    /**
     * Add onstage
     *
     * @param \Backend\Modules\Festival\Entity\ArtistPracticalOnstage $onstage
     * @return ArtistPractical
     */
    public function addOnstage(\Backend\Modules\Festival\Entity\ArtistPracticalOnstage $onstage)
    {
        $this->onstage[] = $onstage;

        return $this;
    }

    /**
     * Remove onstage
     *
     * @param \Backend\Modules\Festival\Entity\ArtistPracticalOnstage $onstage
     */
    public function removeOnstage(\Backend\Modules\Festival\Entity\ArtistPracticalOnstage $onstage)
    {
        $this->onstage->removeElement($onstage);
    }

    /**
     * Get onstage
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOnstage()
    {
        return $this->onstage;
    }

    /**
     * Set veganMeal
     *
     * @param integer $veganMeal
     *
     * @return ArtistPractical
     */
    public function setVeganMeal($veganMeal)
    {
        $this->veganMeal = $veganMeal;

        return $this;
    }

    /**
     * Get veganMeal
     *
     * @return integer
     */
    public function getVeganMeal()
    {
        return $this->veganMeal;
    }

    /**
     * Set stageFilename
     *
     * @param string $stageFilename
     *
     * @return ArtistPractical
     */
    public function setStageFilename($stageFilename)
    {
        $this->stageFilename = $stageFilename;

        return $this;
    }

    /**
     * Get stageFilename
     *
     * @return string
     */
    public function getStageFilename()
    {
        return $this->stageFilename;
    }


    /* Remove file image
    *
    * @return bool
    */
    public function removeStage()
    {
        if ($this->stageFilename !== null) {
            $finder = new Finder();
            $fs = new Filesystem();
            $imagePath = FRONTEND_FILES_PATH . '/festival/artists/files/stages';

            foreach ($finder->directories()->in($imagePath) as $directory) {
                $file = $directory . '/' . $this->stageFilename;

                if (is_file($file)) {
                    $fs->remove($file);
                }
            }

            $this->stageFilename = null;

            return true;
        }

        return false;
    }

    /**
     * Add car
     *
     * @param \Backend\Modules\Festival\Entity\ArtistPracticalCar $car
     *
     * @return ArtistPractical
     */
    public function addCar(\Backend\Modules\Festival\Entity\ArtistPracticalCar $car)
    {
        $this->car[] = $car;

        return $this;
    }

    /**
     * Remove car
     *
     * @param \Backend\Modules\Festival\Entity\ArtistPracticalCar $car
     */
    public function removeCar(\Backend\Modules\Festival\Entity\ArtistPracticalCar $car)
    {
        $this->car->removeElement($car);
    }

    /**
     * Get car
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCar()
    {
        return $this->car;
    }
}

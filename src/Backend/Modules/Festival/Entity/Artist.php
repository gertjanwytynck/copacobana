<?php

namespace Backend\Modules\Festival\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

/**
 * This is the Artist Entity
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 *
 * @ORM\Entity(repositoryClass="Backend\Modules\Festival\Entity\ArtistRepository")
 * @ORM\Table(name="Artist")
 * @ORM\HasLifecycleCallbacks
 */
class Artist
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
     * @ORM\OneToMany(targetEntity="ArtistPractical", mappedBy="artist", cascade={"persist", "remove"})
     */
    private $practical;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ArtistWebsite", mappedBy="artist", cascade={"persist", "remove"})
     */
    private $website;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ArtistDate", mappedBy="artist", cascade={"persist", "remove"})
     */
    private $date;

    /**
     * @var Meta
     *
     * @ORM\OneToOne(targetEntity="Backend\Core\Entity\Meta", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="metaId", referencedColumnName="id", nullable=false)
     **/
    private $meta;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $authorId;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $cover;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $year;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $signUpOpen = false;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $finalized = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="spotlight", type="boolean")
     */
    private $spotlight = false;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $isHidden = false;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $token;

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
        $this->practical = new ArrayCollection();
        $this->website = new ArrayCollection();
        $this->date = new ArrayCollection();
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
        $this->removeCover();
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
     * Set name
     *
     * @param string $name
     * @return Artist
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
     * Set cover
     *
     * @param string $cover
     * @return Artist
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Remove cover image
     *
     * @return bool
     */
    public function removeCover()
    {
        if ($this->cover !== null) {
            $finder = new Finder();
            $fs = new Filesystem();
            $imagePath = FRONTEND_FILES_PATH . '/festival/artists/covers';

            foreach ($finder->directories()->in($imagePath) as $directory) {
                $file = $directory . '/' . $this->cover;

                if (is_file($file)) {
                    $fs->remove($file);
                }
            }

            $this->cover = null;

            return true;
        }

        return false;
    }


    /**
     * Set year
     *
     * @param string $year
     * @return Artist
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set startOn
     *
     * @param \DateTime $startOn
     * @return Artist
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
     * Set endOn
     *
     * @param \DateTime $endOn
     * @return Artist
     */
    public function setEndOn($endOn)
    {
        $this->endOn = $endOn;

        return $this;
    }

    /**
     * Get endOn
     *
     * @return \DateTime
     */
    public function getEndOn()
    {
        return $this->endOn;
    }

    /**
     * Set signUpOpen
     *
     * @param boolean $signUpOpen
     * @return Artist
     */
    public function setSignUpOpen($signUpOpen)
    {
        $this->signUpOpen = $signUpOpen;

        return $this;
    }

    /**
     * Get signUpOpen
     *
     * @return boolean
     */
    public function getSignUpOpen()
    {
        return $this->signUpOpen;
    }

    /**
     * Set finalized
     *
     * @param boolean $finalized
     * @return Artist
     */
    public function setFinalized($finalized)
    {
        $this->finalized = $finalized;

        return $this;
    }

    /**
     * Get finalized
     *
     * @return boolean
     */
    public function getFinalized()
    {
        return $this->finalized;
    }

    /**
     * Set spotlight
     *
     * @param boolean $spotlight
     * @return Artist
     */
    public function setSpotlight($spotlight)
    {
        $this->spotlight = $spotlight;

        return $this;
    }

    /**
     * Get spotlight
     *
     * @return boolean
     */
    public function getSpotlight()
    {
        return $this->spotlight;
    }

    /**
     * Set isHidden
     *
     * @param boolean $isHidden
     * @return Artist
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
     * @return Artist
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
     * @return Artist
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
     * Add practical
     *
     * @param \Backend\Modules\Festival\Entity\ArtistPractical $practical
     * @return Artist
     */
    public function addPractical(\Backend\Modules\Festival\Entity\ArtistPractical $practical)
    {
        $this->practical[] = $practical;

        return $this;
    }

    /**
     * Remove practical
     *
     * @param \Backend\Modules\Festival\Entity\ArtistPractical $practical
     */
    public function removePractical(\Backend\Modules\Festival\Entity\ArtistPractical $practical)
    {
        $this->practical->removeElement($practical);
    }

    /**
     * Get practical
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPractical()
    {
        return $this->practical;
    }

    /**
     * Add website
     *
     * @param \Backend\Modules\Festival\Entity\ArtistWebsite $website
     * @return Artist
     */
    public function addWebsite(\Backend\Modules\Festival\Entity\ArtistWebsite $website)
    {
        $this->website[] = $website;

        return $this;
    }

    /**
     * Remove website
     *
     * @param \Backend\Modules\Festival\Entity\ArtistWebsite $website
     */
    public function removeWebsite(\Backend\Modules\Festival\Entity\ArtistWebsite $website)
    {
        $this->website->removeElement($website);
    }

    /**
     * Get website
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set meta
     *
     * @param \Backend\Core\Entity\Meta $meta
     * @return Artist
     */
    public function setMeta(\Backend\Core\Entity\Meta $meta)
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Get meta
     *
     * @return \Backend\Core\Entity\Meta
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Set stage
     *
     * @param \Backend\Modules\Festival\Entity\ArtistStage $stage
     * @return Artist
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
     * Set authorId
     *
     * @param integer $authorId
     * @return Artist
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * Get authorId
     *
     * @return integer
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * Set category
     *
     * @param \Backend\Modules\Festival\Entity\ArtistCategories $category
     * @return Artist
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
     * Set token
     *
     * @param string $token
     * @return Artist
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Add date
     *
     * @param \Backend\Modules\Festival\Entity\ArtistDate $date
     *
     * @return Artist
     */
    public function addDate(\Backend\Modules\Festival\Entity\ArtistDate $date)
    {
        $this->date[] = $date;

        return $this;
    }

    /**
     * Remove date
     *
     * @param \Backend\Modules\Festival\Entity\ArtistDate $date
     */
    public function removeDate(\Backend\Modules\Festival\Entity\ArtistDate $date)
    {
        $this->date->removeElement($date);
    }

    /**
     * Get date
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDate()
    {
        return $this->date;
    }
}

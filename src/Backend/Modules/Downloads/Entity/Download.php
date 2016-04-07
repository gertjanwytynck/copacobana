<?php

namespace Backend\Modules\Downloads\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This is the Download Entity
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 *
 * @ORM\Entity(repositoryClass="Backend\Modules\Downloads\Entity\DownloadRepository")
 * @ORM\Table(name="Download")
 * @ORM\HasLifecycleCallbacks
 */
class Download
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer", length=11)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="DownloadLocale", mappedBy="download", cascade={"persist", "remove"})
     */
    private $locales;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $backendTitle;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $sequence;

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
     *  @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->createdOn = $this->editedOn = new \Datetime();
    }

    /**
     *  @ORM\PreUpdate
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
     * Add locales
     *
     * @param DownloadLocale $locales
     * @return Download
     */
    public function addLocale(DownloadLocale $locales)
    {
        $this->locales[] = $locales;

        return $this;
    }

    /**
     * Remove locales
     *
     * @param DownloadLocale $locales
     */
    public function removeLocale(DownloadLocale $locales)
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
     * @return DownloadLocale
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
     * Set backendTitle
     *
     * @param string $backendTitle
     * @return Download
     */
    public function setBackendTitle($backendTitle)
    {
        $this->backendTitle = $backendTitle;

        return $this;
    }

    /**
     * Get backendTitle
     *
     * @return string 
     */
    public function getBackendTitle()
    {
        return $this->backendTitle;
    }

    /**
     * Set sequence
     *
     * @param integer $sequence
     * @return Download
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;

        return $this;
    }

    /**
     * Get sequence
     *
     * @return integer 
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return Download
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
     * @return Download
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

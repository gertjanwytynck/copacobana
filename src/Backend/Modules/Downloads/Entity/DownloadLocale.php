<?php

namespace Backend\Modules\Downloads\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Filesystem\Filesystem;

use Backend\Core\Engine\Model;

/**
 * This is the DownloadLocale Entity
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 *
 * @ORM\Entity(repositoryClass="Backend\Modules\Downloads\Entity\DownloadLocaleRepository")
 * @ORM\Table(name="DownloadLocale")
 * @ORM\HasLifecycleCallbacks
 */
class DownloadLocale
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
     * @var Download
     *
     * @ORM\ManyToOne(targetEntity="Download", inversedBy="locales")
     * @ORM\JoinColumn(name="downloadId", referencedColumnName="id", nullable=false)
     */
    private $download;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=5)
     */
    private $language;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $extraId;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $filename;


    /**
     * @ORM\PostRemove
     */
    public function postRemove()
    {
        $this->removeFile();

        // @todo should be removed once Fork CMS fully supports doctrine.
        Model::deleteExtraById($this->extraId, true);
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
     * Set download
     *
     * @param Download $download
     * @return DownloadLocale
     */
    public function setDownload(Download $download)
    {
        $this->download = $download;

        return $this;
    }

    /**
     * Get download
     *
     * @return Download
     */
    public function getDownload()
    {
        return $this->download;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return DownloadLocale
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
     * Set extraId
     *
     * @param integer $extraId
     * @return DownloadLocale
     */
    public function setExtraId($extraId)
    {
        $this->extraId = $extraId;

        return $this;
    }

    /**
     * Get extraId
     *
     * @return integer 
     */
    public function getExtraId()
    {
        return $this->extraId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return DownloadLocale
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return DownloadLocale
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Remove file
     */
    public function removeFile()
    {
        $fs = new Filesystem();
        $file = FRONTEND_FILES_PATH . '/downloads/' . $this->filename;

        if (is_file($file)) {
            $fs->remove($file);
        }
    }
}

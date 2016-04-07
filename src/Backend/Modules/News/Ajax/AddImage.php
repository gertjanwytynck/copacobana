<?php

namespace Backend\Modules\News\Ajax;

use Backend\Core\Engine\Base\AjaxAction;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model;
use Backend\Modules\News\Engine\Model as BackendNewsModel;
use Backend\Modules\News\Engine\Helper as BackendNewsHelper;
use Backend\Modules\News\Entity\ArticleImage;

/**
 * This is the AddImage-action, it will add an image to an article
 *
 * // @todo refactor the symfony filesystem / finder
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class AddImage extends AjaxAction
{
    private $article;
    private $settings;
    private $original;
    private $image;
    private $filePath;
    private $fileInfo;
    private $filename;
    private $sizes;
    private $dgImages;

    public function execute()
    {
        parent::execute();

        if ($this->getData() === false) return;
        if (!$this->validate() === false) return;

        $this->loadImages();
        $this->parse();
    }

    private function getData()
    {
        $articleId = \SpoonFilter::getPostValue('articleId', null, 0, 'int');
        $this->article = BackendNewsModel::get($articleId);

        if ($articleId == null || empty($this->article)) {
            $this->output(self::BAD_REQUEST, null, 'article doesn\'t exist'); return false;
        }

        $this->original = \SpoonFilter::getPostValue('filename', null, '');
        $this->filePath = str_replace('//', '/', '/' . \SpoonFilter::getPostValue('filePath', null, ''));
        if (!\SpoonFile::exists($this->filePath)) $this->filePath = PATH_WWW . $this->filePath;

        $this->fileInfo = \SpoonFile::getInfo($this->filePath);
        $this->sizes = \SpoonDirectory::getList(
            FRONTEND_FILES_PATH . '/news/images',
            false,
            null,
            '/^([0-9]*x[0-9]*)$/'
        );

        // get settings
        $this->settings = $this->get('fork.settings')->getForModule($this->URL->getModule());
    }

    private function validate()
    {
        // validate
        if ($this->original === '' || $this->filePath === '' || !\SpoonFile::exists($this->filePath)) {
            $this->output(self::ERROR, null, Language::err('UploadedFileNotFound')); return false;
        }

        $path = FRONTEND_FILES_PATH . '/news/images';

        // check file type and size
        if (!in_array($this->fileInfo['extension'], array('jpg', 'jpeg', 'gif', 'png'))
            || $this->fileInfo['size'] == 0
        ) {
            $this->output(self::ERROR, null, Language::err('InvalidFile')); return false;
        }

        // create new filename, adding a random number
        $this->filename = $this->article->getId() . '_' . \SpoonFilter::urlise($this->fileInfo['name']) . '.' . $this->fileInfo['extension'];

        // build image item
        $this->image = new ArticleImage();
        $this->image->setArticle($this->article);
        $this->image->setFilename($this->filename);
        $this->image->setOriginal($this->original);
        $this->image->setSequence(BackendNewsModel::getMaximumArticleImageSequence($this->article) + 1);

        // resize
        foreach ($this->sizes as $size) {
            $dimensions = explode('x', $size);
            if (empty($dimensions[0])) $dimensions[0] = null;
            if (empty($dimensions[1])) $dimensions[1] = null;

            $thumbnail = new \SpoonThumbnail($this->filePath, $dimensions[0], $dimensions[1]);
            $thumbnail->setAllowEnlargement(true);
            if ($dimensions[0] !== null && $dimensions[1] !== null) $thumbnail->setForceOriginalAspectRatio(false);
            else $thumbnail->setForceOriginalAspectRatio(true);
            $thumbnail->parseToFile($path . '/' . $size . '/' . $this->filename);
        }

        // resize (dataGrid)
        $thumbnail = new \SpoonThumbnail($this->filePath, 64, 64);
        $thumbnail->setAllowEnlargement(true);
        $thumbnail->setForceOriginalAspectRatio(false);
        $thumbnail->parseToFile($path . '/dataGrid/' . $this->filename);

        // move source
        \SpoonFile::move($this->filePath, $path . '/source/' . $this->filename);

        // get the entity manager
        $em = Model::get('doctrine.orm.entity_manager');

        // insert the image
        $em->persist($this->image);
        $em->flush();
    }

    private function loadImages()
    {
        $this->dgImages = BackendNewsHelper::loadDgImages($this->article->getId());
    }

    protected function parse()
    {
        // get dataGrid html
        $dataGridHtml = ($this->dgImages->getNumResults() != 0)
            ? '<div class="dataGridHolder">' . $this->dgImages->getContent() . '</div>'
            : false
        ;

        // output
        $this->output(
            self::OK,
            array('image' => $this->image, 'dataGrid' => $dataGridHtml, 'message' => Language::msg('NoImages')),
            vsprintf(Language::msg('AddedImage'), array($this->image->getOriginal()))
        );
    }
}

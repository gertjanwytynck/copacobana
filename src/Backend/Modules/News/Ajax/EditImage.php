<?php

namespace Backend\Modules\News\Ajax;

use Backend\Core\Engine\Base\AjaxAction;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model;
use Backend\Modules\News\Engine\Model as BackendNewsModel;
use Backend\Modules\News\Engine\Helper as BackendNewsHelper;

/**
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class EditImage extends AjaxAction
{
    private $image;
    private $data;
    private $dgImages;

    public function execute()
    {
        parent::execute();

        if ($this->getData() === false) return;

        $this->loadImages();
        $this->parse();
    }

    private function getData()
    {
        $articleId = \SpoonFilter::getPostValue('articleId', null, 0, 'int');
        $imageId = \SpoonFilter::getPostValue('imageId', null, 0, 'int');
        $this->image = BackendNewsModel::getArticleImage($imageId);

        if ($articleId === null
            || $imageId === null
            || empty($this->image)
            || $this->image->getArticle()->getId() != $articleId
        ) {
            $this->output(self::BAD_REQUEST, null, 'article image doesn\'t exist'); return false;
        }

        if (!isset($_POST['data']) || $_POST['data'] === null) {
            $this->output(self::BAD_REQUEST, null, 'no data passed'); return false;
        } else {
            $this->data = \SpoonFilter::getPostValue('data', null, null, 'array'); // @todo shouldn\'t this be sanitized??
        }

        // get the image
        $this->image->setTitle((isset($this->data['image_title']) ? $this->data['image_title'] : null));
        $this->image->setIsHidden((!isset($this->data['image_visible'])));

        // get the entity manager
        $em = Model::get('doctrine.orm.entity_manager');

        // insert the image
        $em->persist($this->image);
        $em->flush();
    }

    private function loadImages()
    {
        $this->dgImages = BackendNewsHelper::loadDgImages($this->image->getArticle()->getId());
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
            array('dataGrid' => $dataGridHtml),
            vsprintf(
                Language::msg('EditedImage'),
                array(($this->image->getTitle() !== null) ? $this->image->getTitle() : array($this->image->getOriginal()))
            )
        );
    }
}

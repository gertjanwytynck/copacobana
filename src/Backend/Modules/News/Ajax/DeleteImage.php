<?php

namespace Backend\Modules\News\Ajax;

use Backend\Core\Engine\Base\AjaxAction;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model;
use Backend\Modules\News\Entity\ArticleImage;
use Backend\Modules\News\Engine\Model as BackendNewsModel;

/**
 * This is the DeleteImage-action, it will delete an article image
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class DeleteImage extends AjaxAction
{
    /** @var ArticleImage $image */
    private $image;

    public function execute()
    {
        parent::execute();

        if ($this->getData() === false) return;

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

        $em = Model::get('doctrine.orm.entity_manager');

        $em->remove($this->image);
        $em->flush();
    }

    protected function parse()
    {
        // output
        $this->output(
            self::OK,
            null,
            vsprintf(
                Language::msg('DeletedImage'),
                array(($this->image->getTitle() !== null) ? $this->image->getTitle() : array($this->image->getOriginal()))
            )
        );
    }
}

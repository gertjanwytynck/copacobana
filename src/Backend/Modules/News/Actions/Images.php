<?php

namespace Backend\Modules\News\Actions;

use Backend\Core\Engine\Base\ActionAdd;
use Backend\Core\Engine\DataGridDB;
use Backend\Core\Engine\Model;
use Backend\Core\Engine\Form;
use Backend\Modules\News\Engine\Model as BackendNewsModel;
use Backend\Modules\News\Engine\Helper as BackendNewsHelper;

/**
 * Display the images of an article.
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Images extends ActionAdd
{
    /** @var Article $article */
    protected $article;

    /** @var DataGridDB */
    private $dataGrid;

    /** @var array $settings */
    protected $settings = array();

    /**
     * Execute the action
     */
    public function execute()
    {
        parent::execute();

        $this->getData();
        $this->loadImagesUploadForm();
        $this->loadImageInfoForm();
        $this->loadDgImages();
        $this->parse();
        $this->display();
    }

    /**
     * Get the necessary data
     */
    private function getData()
    {
        $this->id = $this->getParameter('id', 'int');
        $this->article = BackendNewsModel::get($this->id);

        // get the article
        if ($this->id == null || empty($this->article)) {
            $this->redirect(BackendModel::createURLForAction('Index') . '&error=non-existing');
        }

        // get module settings
        $this->settings = $this->get('fork.settings')->getForModule($this->URL->getModule());
    }

    /**
     * Load the form
     */
    private function loadImagesUploadForm()
    {
        $this->frm = new Form('addImages');

        $this->frm->addHidden('article_id', $this->article->getId());
        $this->frm->addHidden('image_size_limit', $this->settings['image_size_limit']);
        $this->frm->addFile('imageUpload')->hideHelpTxt();
    }

    /**
     * Load image info form
     */
    private function loadImageInfoForm()
    {
        $this->frmEditImage = new Form('editImage');

        $this->frmEditImage->addText('image_title')->setAttribute('class', 'inputText title');
        $this->frmEditImage->addCheckbox('image_visible');
    }

    /**
     * Load the images
     */
    private function loadDgImages()
    {
        $this->dataGrid = BackendNewsHelper::loadDgImages($this->article->getId());
    }

    /**
     * Parses stuff into the template
     */
    protected function parse()
    {
        parent::parse();

        $this->header->addCss('uploadify.css');
        $this->header->addCss('jquery.fancybox.css');

        $this->header->addJS('swfobject.js');
        $this->header->addJS('jquery.uploadify.js');
        $this->header->addJS('jquery.fancybox.pack.js');

        $this->frmEditImage->parse($this->tpl);

        $this->tpl->assign('dataGrid', ($this->dataGrid->getNumResults() != 0) ? $this->dataGrid->getContent() : false);
        $this->tpl->assign('article', $this->article);
        $this->tpl->assign('settings', $this->settings);
    }
}

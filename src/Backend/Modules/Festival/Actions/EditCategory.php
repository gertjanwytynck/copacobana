<?php

namespace Backend\Modules\Festival\Actions;

use Backend\Core\Engine\Base\ActionEdit;
use Backend\Core\Engine\Form;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model;
use Backend\Modules\Festival\Engine\Model as BackendFestivalModel;

/**
 * This is the edit-action, it will display a form to edit a category
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class EditCategory extends ActionEdit
{
    /** The meta fields for each language */
    protected $meta = array();

    /**
     * Execute the action.
     */
    public function execute()
    {
        parent::execute();

        $this->getData();
        $this->loadForm();
        $this->validateForm();
        $this->parse();
        $this->display();
    }


    private function getData() {
        $em = Model::get('doctrine.orm.entity_manager');
        $artistCategoryRepo = $em->getRepository(BackendFestivalModel::ARTIST_CATEGORIES_ENTITY_CLASS);

        $this->id = $this->getParameter('id', 'int');
        $this->record = $artistCategoryRepo->find($this->id);

        if ($this->id == null || empty($this->record)) {
            $this->redirect(Model::createURLForAction('Categories') . '&error=non-existing');
        }
    }
    /**
     * Load the form
     */
    private function loadForm()
    {
        $this->frm = new Form('editCategory');
        $this->frm->addText('category', $this->record->getCategory(), 255, 'inputText title', 'inputTextError title');
    }

    /**
     * Parse the form
     */
    protected function parse()
    {
        $this->tpl->assign('item', $this->record);

        parent::parse();

    }

    /**
     * Validate the form
     */
    private function validateForm()
    {
        if ($this->frm->isSubmitted()) {
            $this->frm->cleanupFields();

            // validate the fields
            $this->frm->getField('category')->isFilled(Language::err('FieldIsRequired'));


            if ($this->frm->isCorrect()) {
                // get the entity manager
                $em = Model::get('doctrine.orm.entity_manager');

                // build item
                $category = $this->record;
                $category->setCategory($this->frm->getField('category')->getValue());

                // $category
                $em->persist($category);
                $em->flush();

                // trigger event
                Model::triggerEvent($this->getModule(), 'after_edit_category', array('item' => $category));

                // everything is saved, so redirect to the overview
                $this->redirect(
                    Model::createURLForAction('Categories') . '&report=edited-stage&var=' .
                    urlencode($category->getCategory()) . '&highlight=row-' . $category->getId()
                );
            }
        }
    }
}

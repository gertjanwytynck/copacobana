<?php

namespace Backend\Modules\Festival\Actions;

use Backend\Core\Engine\Base\ActionEdit;
use Backend\Core\Engine\Form;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model;
use Backend\Modules\Festival\Engine\Model as BackendFestivalModel;

/**
 * This is the add-action, it will display a form to add a new stage.
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class EditStage extends ActionEdit
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
        $artistStageRepo = $em->getRepository(BackendFestivalModel::ARTIST_STAGE_ENTITY_CLASS);

        $this->id = $this->getParameter('id', 'int');
        $this->record = $artistStageRepo->find($this->id);

        if ($this->id == null || empty($this->record)) {
            $this->redirect(Model::createURLForAction('Stages') . '&error=non-existing');
        }
    }
    /**
     * Load the form
     */
    private function loadForm()
    {
        $this->frm = new Form('editStage');
        $this->frm->addText('stage_name', $this->record->getStageName(), 255, 'inputText title', 'inputTextError title');
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
            $this->frm->getField('stage_name')->isFilled(Language::err('FieldIsRequired'));


            if ($this->frm->isCorrect()) {
                // get the entity manager
                $em = Model::get('doctrine.orm.entity_manager');

                // build item
                $stage = $this->record;
                $stage->setStageName($this->frm->getField('stage_name')->getValue());

                // $stage
                $em->persist($stage);
                $em->flush();

                // trigger event
                Model::triggerEvent($this->getModule(), 'after_edit_stage', array('item' => $stage));

                // everything is saved, so redirect to the overview
                $this->redirect(
                    Model::createURLForAction('Stages') . '&report=edited-stage&var=' .
                    urlencode($stage->getStageName()) . '&highlight=row-' . $stage->getId()
                );
            }
        }
    }
}

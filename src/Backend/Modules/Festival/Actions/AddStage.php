<?php

namespace Backend\Modules\Festival\Actions;

use Backend\Core\Engine\Base\ActionAdd;
use Backend\Core\Engine\Form;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model;
use Backend\Modules\Festival\Entity\ArtistStage;

/**
 * This is the add-action, it will display a form to add a new stage.
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class AddStage extends ActionAdd
{
    private $languages;

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

    }
    /**
     * Load the form
     */
    private function loadForm()
    {
        $this->frm = new Form('addStage');
        $this->frm->addText('stage_name', null, 255, 'inputText title', 'inputTextError title');
    }

    /**
     * Parse the form
     */
    protected function parse()
    {
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
                $stage = new ArtistStage();
                $stage->setStageName($this->frm->getField('stage_name')->getValue());

                // $stage
                $em->persist($stage);
                $em->flush();

                // trigger event
                Model::triggerEvent($this->getModule(), 'after_add_stage', array('item' => $stage));

                // everything is saved, so redirect to the overview
                $this->redirect(
                    Model::createURLForAction('Stages') . '&report=added-stage&var=' .
                    urlencode($stage->getStageName()) . '&highlight=row-' . $stage->getId()
                );
            }
        }
    }
}

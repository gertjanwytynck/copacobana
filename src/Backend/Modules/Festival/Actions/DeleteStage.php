<?php

namespace Backend\Modules\Festival\Actions;

use Backend\Core\Engine\Base\ActionDelete;
use Backend\Core\Engine\Model;
use Backend\Modules\Festival\Engine\Model as BackendFestivalModel;

/**
 * This is the add-action, it will display a form to add a new stage.
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class DeleteStage extends ActionDelete
{
    /**
     * Execute the action.
     */
    public function execute()
    {
        parent::execute();

        $em = Model::get('doctrine.orm.entity_manager');
        $stageRepo = $em->getRepository(BackendFestivalModel::ARTIST_STAGE_ENTITY_CLASS);

        $this->id = $this->getParameter('id', 'int');
        $this->record = $stageRepo->find($this->id);

        // does the item exist
        if ($this->id !== null && !empty($this->record)) {

            // get the entity manager
            $em = Model::get('doctrine.orm.entity_manager');

            // delete item
            $em->remove($this->record);

            // flush
            $em->flush();

            // trigger event
            Model::triggerEvent($this->getModule(), 'after_delete_stage', array('id' => $this->record->getId()));

            // product line was deleted, so redirect
            $this->redirect(
                Model::createURLForAction('Stages') . '&report=deleted&var=' .
                urlencode($this->record->getStageName())
            );
        }

        // something went wrong
        else $this->redirect(Model::createURLForAction('Stages') . '&error=non-existing');
    }
}

<?php

namespace Backend\Modules\Downloads\Actions;

use Backend\Core\Engine\Base\ActionDelete;
use Backend\Core\Engine\Model;
use Backend\Modules\Downloads\Engine\Model as BackendDownloadsModel;

/**
 * This is the delete-action, it will delete an item.
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Delete extends ActionDelete
{
    /**
     * Execute the action
     */
    public function execute()
    {
        parent::execute();

        $em = Model::get('doctrine.orm.entity_manager');
        $downloadRepo = $em->getRepository(BackendDownloadsModel::DOWNLOAD_ENTITY_CLASS);

        $this->id = $this->getParameter('id', 'int');
        $this->record = $downloadRepo->find($this->id);

        // does the item exist
        if ($this->id !== null && !empty($this->record)) {

            // get the entity manager
            $em = Model::get('doctrine.orm.entity_manager');

            // delete item
            $em->remove($this->record);

            // flush
            $em->flush();

            // trigger event
            Model::triggerEvent($this->getModule(), 'after_delete', array('id' => $this->record->getId()));

            // redirect
            $this->redirect(
                Model::createURLForAction('Index') . '&report=deleted&var=' .
                urlencode($this->record->getBackendTitle())
            );
        }

        // something went wrong
        else $this->redirect(Model::createURLForAction('Index') . '&error=non-existing');
    }
}

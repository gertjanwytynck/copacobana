<?php

namespace Backend\Modules\Festival\Actions;

use Backend\Core\Engine\Base\ActionDelete;
use Backend\Core\Engine\Model;
use Backend\Modules\Festival\Engine\Model as BackendFestivalModel;

/**
 * This is the delete-action, it will display a form to delete a category.
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class DeleteCategory extends ActionDelete
{
    /**
     * Execute the action.
     */
    public function execute()
    {
        parent::execute();

        $em = Model::get('doctrine.orm.entity_manager');
        $categoryStage = $em->getRepository(BackendFestivalModel::ARTIST_CATEGORIES_ENTITY_CLASS);

        $this->id = $this->getParameter('id', 'int');
        $this->record = $categoryStage->find($this->id);

        // does the item exist
        if ($this->id !== null && !empty($this->record)) {

            // get the entity manager
            $em = Model::get('doctrine.orm.entity_manager');

            // delete item
            $em->remove($this->record);

            // flush
            $em->flush();

            // trigger event
            Model::triggerEvent($this->getModule(), 'after_delete_category', array('id' => $this->record->getId()));

            // product line was deleted, so redirect
            $this->redirect(
                Model::createURLForAction('Categories') . '&report=deleted&var=' .
                urlencode($this->record->getCategory())
            );
        }

        // something went wrong
        else $this->redirect(Model::createURLForAction('Categories') . '&error=non-existing');
    }
}

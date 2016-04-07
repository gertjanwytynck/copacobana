<?php

namespace Backend\Modules\News\Actions;

use Backend\Core\Engine\Base\ActionDelete;
use Backend\Core\Engine\Model;
use Backend\Core\Engine\Language;
use Backend\Modules\News\Engine\Model as BackendNewsModel;
use Backend\Modules\Search\Engine\Model as BackendSearchModel;
use Backend\Modules\Tags\Engine\Model as BackendTagsModel;

/**
 * This action will delete an item
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

        $this->id = $this->getParameter('id', 'int');
        $this->record = BackendNewsModel::get($this->id);

        // does the item exist
        if ($this->id !== null && !empty($this->record)) {

            // get the entity manager
            $em = Model::get('doctrine.orm.entity_manager');

            // loop through every language
            foreach (Language::getActiveLanguages() as $abbreviation) {
                if ($this->record->getLocale($abbreviation) !== null) {
                    // remove search index
                    BackendSearchModel::removeIndex($this->getModule(), $this->record->getLocale($abbreviation)->getId(), $abbreviation);

                    // remove tags
                    BackendTagsModel::saveTags($this->record->getLocale($abbreviation)->getId(), '', $this->URL->getModule(), $abbreviation);
                }
            }

            // delete item
            $em->remove($this->record);

            // flush
            $em->flush();

            // trigger event
            Model::triggerEvent($this->getModule(), 'after_delete', array('id' => $this->record->getId()));

            // article was deleted, so redirect
            $this->redirect(
                Model::createURLForAction('Index') . '&report=deleted&var=' .
                urlencode($this->record->getBackendTitle())
            );
        }

        // something went wrong
        else $this->redirect(Model::createURLForAction('Index') . '&error=non-existing');
    }
}

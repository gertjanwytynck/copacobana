<?php

namespace Backend\Modules\News\Actions;

use Backend\Core\Engine\Base\ActionDelete;
use Backend\Core\Engine\Model;
use Backend\Core\Engine\Language;
use Backend\Modules\News\Engine\Model as BackendNewsModel;
use Backend\Modules\Search\Engine\Model as BackendSearchModel;
use Backend\Modules\Tags\Engine\Model as BackendTagsModel;

/**
 * This action will delete an category
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class DeleteCategory extends ActionDelete
{
    /**
     * Execute the action
     */
    public function execute()
    {
        parent::execute();

        $this->id = $this->getParameter('id', 'int');
        $this->record = BackendNewsModel::getCategory($this->id);

        // does the item exist
        if ($this->id !== null && !empty($this->record)) {

            // get the entity manager
            $em = Model::get('doctrine.orm.entity_manager');

            $this->removeArticles($em, $this->record);

            // delete item
            $em->remove($this->record);

            // flush
            $em->flush();

            // trigger event
            Model::triggerEvent($this->getModule(), 'after_delete_category', array('id' => $this->record->getId()));

            // category was deleted, so redirect
            $this->redirect(
                Model::createURLForAction('Categories') . '&report=deleted&var=' .
                urlencode($this->record->getBackendTitle())
            );
        }

        // something went wrong
        else $this->redirect(Model::createURLForAction('Categories') . '&error=non-existing');
    }

    // @todo refactor this out when tags and search module support doctrine and cascading deletes
    private function removeArticles($em, $category)
    {
        foreach ($category->getArticles() as $article) {
            // loop through every language
            foreach (Language::getActiveLanguages() as $abbreviation) {
                // remove search index
                BackendSearchModel::removeIndex($this->getModule(), $article->getId(), $abbreviation);

                // remove tags
                BackendTagsModel::saveTags($article->getId(), '', $this->URL->getModule(), $abbreviation);
            }

            // delete item
            $em->remove($this->record);
        }
    }
}

<?php

namespace Backend\Modules\News\Ajax;

use Backend\Core\Engine\Base\AjaxAction;
use Backend\Core\Engine\Model;
use Backend\Modules\News\Engine\Model as BackendNewsModel;

/**
 * Reorder categories
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class SequenceCategories extends AjaxAction
{
    /**
     * Execute the action
     */
    public function execute()
    {
        parent::execute();

        // get parameters
        $newIdSequence = trim(\SpoonFilter::getPostValue('new_id_sequence', null, '', 'string'));

        // list id
        $ids = (array) explode(',', rtrim($newIdSequence, ','));

        // get the entity manager and category repository
        $em = Model::get('doctrine.orm.entity_manager');
        $categoryRepo = $em->getRepository(BackendNewsModel::CATEGORY_ENTITY_CLASS);

        // loop id's and set new sequence
        foreach ($ids as $i => $id) {
            // build item
            $item['id'] = (int) $id;

            $category = $categoryRepo->find((int) $id);

            if ($category !== null) {
                $category->setSequence($i + 1);
                $em->persist($category);
            }
        }

        $em->flush();

        // success output
        $this->output(self::OK, null, 'sequence updated');
    }
}

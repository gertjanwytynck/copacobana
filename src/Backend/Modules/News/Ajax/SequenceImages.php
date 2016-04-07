<?php

namespace Backend\Modules\News\Ajax;

use Backend\Core\Engine\Base\AjaxAction;
use Backend\Core\Engine\Model;
use Backend\Modules\News\Engine\Model as BackendNewsModel;

/**
 * Reorder article images
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class SequenceImages extends AjaxAction
{
    public function execute()
    {
        parent::execute();

        $newIdSequence = trim(\SpoonFilter::getPostValue('new_id_sequence', null, '', 'string'));

        // list id
        $ids = (array) explode(',', rtrim($newIdSequence, ','));

        // get the entity manager and category repository
        $em = Model::get('doctrine.orm.entity_manager');
        $articleImageRepo = $em->getRepository(BackendNewsModel::ARTICLE_IMAGE_ENTITY_CLASS);

        // loop id's and set new sequence
        foreach ($ids as $i => $id) {
            // build item
            $item['id'] = (int) $id;

            $image = $articleImageRepo->find((int) $id);

            if ($image !== null) {
                $image->setSequence($i + 1);
                $em->persist($image);
            }
        }

        $em->flush();

        // success output
        $this->output(self::OK, null, 'sequence updated');
    }
}

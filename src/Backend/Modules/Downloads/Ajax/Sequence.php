<?php

namespace Backend\Modules\Downloads\Ajax;

use Backend\Core\Engine\Base\AjaxAction;
use Backend\Core\Engine\Model;
use Backend\Modules\Downloads\Engine\Model as BackendDownloadsModel;

/**
 * This is the Sequence-action, it will reorder the downloads
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Sequence extends AjaxAction
{
    public function execute()
    {
        parent::execute();

        $newIdSequence = trim(\SpoonFilter::getPostValue('new_id_sequence', null, '', 'string'));

        // list id
        $ids = (array) explode(',', rtrim($newIdSequence, ','));

        // get the entity manager and repository
        $em = Model::get('doctrine.orm.entity_manager');
        $downloadsRepo = $em->getRepository(BackendDownloadsModel::DOWNLOAD_ENTITY_CLASS);

        // loop id's and set new sequence
        foreach ($ids as $i => $id) {
            // build item
            $item['id'] = (int) $id;

            $file = $downloadsRepo->find((int) $id);

            if ($file !== null) {
                $file->setSequence($i + 1);
                $em->persist($file);
            }
        }

        $em->flush();

        // success output
        $this->output(self::OK, null, 'sequence updated');
    }
}

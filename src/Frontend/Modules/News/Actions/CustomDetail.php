<?php

namespace Frontend\Modules\News\Actions;

use Frontend\Core\Engine\Model;
use Frontend\Core\Engine\Navigation;
use Frontend\Modules\News\Engine\Model as FrontendNewsModel;
use Frontend\Modules\Tags\Engine\Model as FrontendTagsModel;

/**
 * This is the detail-action
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class CustomDetail extends Detail
{
    /**
     * Load the data, don't forget to validate the incoming data
     */
    protected function getData()
    {
        // validate incoming parameters
        if ($this->URL->getParameter(0) === null) $this->redirect(Navigation::getURL(404));

        // get by URL
        $this->record = FrontendNewsModel::getByUrl($this->URL->getParameter(0));

        $tagIds = [];
        if ( isset($this->record['tags'])) {
            foreach ( $this->record['tags'] as $key => $tag ) {
                $tagIds[$key] = $tag['id'];
            }
        }

        if ( ! empty($this->record) ) {
            //$tags = FrontendTagsModel::getRelatedItemsByTags($this->record['id'],'News', 'News');
            /* if ( ! empty($tags) ){
                $this->related = FrontendNewsModel::getAllByIds($tags);
            }*/

            $this->related = FrontendNewsModel::SearchByTerm('10', '0', '', $this->record['category_url']);
        }

        foreach ( $this->related as $key=>$related ) {
            if ( $related['title'] ==  $this->record['title'] ) {
                unset($this->related[$key]);
            }
        }

        // anything found?
        if ($this->record === null) $this->redirect(Navigation::getURL(404));

        // get the module settings
        $this->settings = Model::getModuleSettings($this->module);
    }
}

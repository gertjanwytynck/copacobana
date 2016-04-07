<?php

namespace Backend\Modules\Festival\Ajax;

use Backend\Core\Engine\Base\AjaxAction as BackendBaseAJAXAction;
use Backend\Modules\Festival\Engine\Model as BackendFestivalModel;

/**
 * This is the autocomplete-action, it will output a list of genres that start
 * with a certain string.
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class Autocomplete extends BackendBaseAJAXAction
{
    /**
     * Execute the action
     */
    public function execute()
    {
        parent::execute();

        // get parameters
        $term = \SpoonFilter::getPostValue('term', null, '');

        // validate
        if ($term == '') {
            $this->output(self::BAD_REQUEST, null, 'term-parameter is missing.');
        } else {
            // get tags
            //$tags = BackendTagsModel::getStartsWith($term);

            $tags = '';

            // output
            $this->output(self::OK, $tags);
        }
    }
}

<?php

namespace Backend\Modules\Downloads;

use Backend\Core\Engine\Base\Config as BackendBaseConfig;

/**
 * This is the configuration-object for the downloads module
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Config extends BackendBaseConfig
{
    /**
     * The default action
     *
     * @var	string
     */
    protected $defaultAction = 'Index';

    /**
     * The disabled actions
     *
     * @var	array
     */
    protected $disabledActions = array();

    /**
     * The disabled AJAX-actions
     *
     * @var	array
     */
    protected $disabledAJAXActions = array();
}

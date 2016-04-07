<?php

namespace Backend\Modules\News;

use Backend\Core\Engine\Base\Config as BackendBaseConfig;

/**
 * This is the configuration-object for the news module
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
}

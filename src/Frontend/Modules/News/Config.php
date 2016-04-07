<?php

namespace Frontend\Modules\News;

use Frontend\Core\Engine\Base\Config as FrontendBaseConfig;

/**
 * This is the configuration-object
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Config extends FrontendBaseConfig
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

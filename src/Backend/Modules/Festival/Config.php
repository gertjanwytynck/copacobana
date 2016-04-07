<?php

namespace Backend\Modules\Festival;

use Backend\Core\Engine\Base\Config as BackendBaseConfig;

/**
 * This is the configuration-object for the artists module.
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class Config extends BackendBaseConfig
{
    /**
     * The default action.
     *
     * @var	string
     */
    protected $defaultAction = 'Index';

    /**
     * The disabled actions.
     *
     * @var	array
     */
    protected $disabledActions = array();
}

<?php

namespace Backend\Modules\News\Engine;

use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model as BackendModel;
use Backend\Core\Engine\Authentication;

/**
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class DataGridFunctions
{
    /**
     * Replace a status with a label
     *
     * @param string $status The status.
     * @return string
     */
    public static function getStatusLabelSpotlight($status)
    {
        switch ($status) {
            case '1':   $span =  '<span class="label green">Spotlight</span></a>';
                        break;
            case '0':   $span =  '';
                        break;
            default:    $span =   '';
                        break;
        }
        return $span;
    }


}

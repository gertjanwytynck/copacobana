<?php

namespace Backend\Modules\Festival\Engine;

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
    public static function getStatusLabelFinalize($status)
    {
        switch ($status) {
            case '1':   $span =  '<span class="label green">Afgewerkt</span></a>';
                        break;
            case '0':   $span =  '<span class="label grey">Niet afgewerkt</span>';
                        break;
            default:    $span =   '<span class="label grey">Niet afgewerkt</span>';
                        break;
        }
        return $span;
    }

    /**
     * Replace a status with a label
     *
     * @param string $status The status.
     * @return string
     */
    public static function getStatusLabelSignUpOpen($status)
    {
        switch ($status) {
            case '1':   $span =  '<span class="label green">Inschrijving open</span></a>';
                break;
            case '0':   $span =  '<span class="label grey">Inschrijving gesloten</span>';
                break;
            default:    $span =  '<span class="label grey">Inschrijving gesloten</span>';
                break;
        }
        return $span;
    }

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
            case '0':   $span =  '<span class="label red"></span>';
                break;
            default:    $span =  '<span class=""></span>';
                break;
        }
        return $span;
    }

    /**
     * Replace a status with a label
     *
     * @param string $status The status.
     * @return string
     */
    public static function getStatusLabelIsHidden($status)
    {
        switch ($status) {
            case '1':   $span =  '<span class="label grey">Verborgen</span></a>';
                break;
            case '0':   $span =  '<span class="label green">Zichtbaar</span>';
                break;
            default:    $span =  '<span class=""></span>';
                break;
        }
        return $span;
    }
}

<?php

namespace Frontend\Core\Engine;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

/**
 * Add all custom stuff here.
 *
 * @author Tijs Verkoyen <tijs@sumocoders.be>
 */
class TemplateCustom
{
    /**
     * Template instance
     *
     * @var    Template
     */
    private $tpl;

    /**
     * @param Template $tpl The template instance.
     */
    public function __construct($tpl)
    {
        $this->tpl = $tpl;
        $this->parse();
    }

    private function parse() {
        \SpoonTemplateModifiers::mapModifier('getartistmenu', array('Frontend\Core\Engine\TemplateCustom', 'getArtistMenu'));
    }

    /**
     * Get the navigation html
     *    syntax: {$var|getartistMenu[:label[:pageId]]}
     *
     * @param string $var        The variable.
     * @param string $label      The label.
     * @return string
     */
    public static function getArtistMenu($var = null, $label = '') {
        // only when we have the page artists
        if ( $label == 'Artist' ) {
            // get the template
            $tpl = '/Themes/Copacobana/Core/Layout/Templates/Elements/ArtistMenu.tpl';

            // create template
            $navigationTpl = new Template(false);

            // assign line to template
            $navigationTpl->assign('menuItems', true);

            // return the template
            return $navigationTpl->getContent(FRONTEND_PATH . (string) $tpl);
        }
    }
}



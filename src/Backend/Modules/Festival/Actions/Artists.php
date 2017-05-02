<?php

namespace Backend\Modules\Festival\Actions;

use Backend\Core\Engine\Base\ActionIndex;
use Backend\Core\Engine\Authentication;
use Backend\Core\Engine\DataGridDoctrine;
use Backend\Core\Engine\DataGridFunctions;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model;
use Backend\Modules\Festival\Engine\Model as BackendFestivalModel;

/**
 * This is the index-action, it will display the overview of all artists.
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class Artists extends ActionIndex
{
    /**
     * Execute the action
     */
    public function execute()
    {
        parent::execute();

        $this->loadDataGrid();
        $this->parse();
        $this->display();
    }

    /**
     * Load the datagrid
     */
    private function loadDataGrid()
    {
        $this->settings = $this->get('fork.settings')->getForModule($this->URL->getModule());

        $this->dataGrid = new DataGridDoctrine(
            BackendFestivalModel::ARTIST_ENTITY_CLASS,
            array('year' => $this->settings['year']),
            array('id', 'name', 'isHidden', 'finalized', 'signUpOpen', 'spotlight', 'editedOn')
        );

        // set dataGrid id
        $this->dataGrid->setAttributes(array('id' => 'artist'));

        // sort the columns
        $this->dataGrid->setSortingColumns(array('name', 'editedOn'));

        // hide columns
        $this->dataGrid->setColumnsHidden(array('id'));

        // disable paging
        $this->dataGrid->setPaging(false);

        // column functions
        $this->dataGrid->setColumnFunction(
            array('Backend\Modules\Festival\Engine\DataGridFunctions', 'getStatusLabelFinalize'),
            array('[finalized]'), 'finalized', true
        );

        $this->dataGrid->setColumnFunction(
            array('Backend\Modules\Festival\Engine\DataGridFunctions', 'getStatusLabelSignUpOpen'),
            array('[signUpOpen]'), 'signUpOpen', true
        );

        $this->dataGrid->setColumnFunction(
            array('Backend\Modules\Festival\Engine\DataGridFunctions', 'getStatusLabelSpotlight'),
            array('[spotlight]'), 'spotlight', true
        );

        $this->dataGrid->setColumnFunction(
            array('Backend\Modules\Festival\Engine\DataGridFunctions', 'getStatusLabelIsHidden'),
            array('[isHidden]'), 'isHidden', true
        );

        // set column functions
        $this->dataGrid->setColumnFunction(
            array(new DataGridFunctions(), 'getLongDate'),
            array('[editedOn]'),
            'editedOn',
            true
        );

        // check if this action is allowed
        if (Authentication::isAllowedAction('EditArtist')) {
            $this->dataGrid->setColumnURL(
                'name',
                Model::createURLForAction('EditArtist') . '&amp;id=[id]'
            );
            $this->dataGrid->addColumn(
                'edit',
                null,
                Language::lbl('Edit'),
                Model::createURLForAction('EditArtist') . '&amp;id=[id]',
                Language::lbl('Edit')
            );
        }
    }

    /**
     * Parse the datagrid
     */
    protected function parse()
    {
        parent::parse();

        $this->tpl->assign('dataGrid', (string) $this->dataGrid->getContent());
    }
}

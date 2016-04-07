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
 * This is the Stages-action, it will display the stages
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class Stages extends ActionIndex
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
        $this->dataGrid = new DataGridDoctrine(
            BackendFestivalModel::ARTIST_STAGE_ENTITY_CLASS,
            array(),
            array('id', 'stageName',  'editedOn')
        );

        // set dataGrid id
        $this->dataGrid->setAttributes(array('id' => 'series'));

        // hide columns
        $this->dataGrid->setColumnsHidden(array('id'));

        // disable paging
        $this->dataGrid->setPaging(false);

        // set column functions
        $this->dataGrid->setColumnFunction(
            array(new DataGridFunctions(), 'getLongDate'),
            array('[editedOn]'),
            'editedOn',
            true
        );

        // check if this action is allowed
        if (Authentication::isAllowedAction('EditStage')) {
            $this->dataGrid->setColumnURL(
                'stageName',
                Model::createURLForAction('EditStage') . '&amp;id=[id]'
            );
            $this->dataGrid->addColumn(
                'edit',
                null,
                Language::lbl('Edit'),
                Model::createURLForAction('EditStage') . '&amp;id=[id]',
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

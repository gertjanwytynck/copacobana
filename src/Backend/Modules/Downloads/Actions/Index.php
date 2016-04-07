<?php

namespace Backend\Modules\Downloads\Actions;

use Backend\Core\Engine\Base\ActionIndex;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\DataGridDoctrine;
use Backend\Core\Engine\Authentication;
use Backend\Core\Engine\Model;
use Backend\Modules\Downloads\Engine\Model as BackendDownloadsModel;

/**
 * This is the index-action (default), it will display the overview
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Index extends ActionIndex
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
     * Load the datagrids
     */
    private function loadDataGrid()
    {
        $this->dataGrid = new DataGridDoctrine(
            BackendDownloadsModel::DOWNLOAD_ENTITY_CLASS,
            array(),
            array('id', 'backendTitle', 'sequence'),
            'sequence', 'asc'
        );

        // hide columns
        $this->dataGrid->setColumnsHidden(array('id'));

        // disable paging
        $this->dataGrid->setPaging(false);

        // enable sequencing
        $this->dataGrid->enableSequenceByDragAndDrop();

        // check if this action is allowed
        if (Authentication::isAllowedAction('Edit')) {
            $this->dataGrid->setColumnURL(
                'backendTitle',
                Model::createURLForAction('Edit') . '&amp;id=[id]'
            );
            $this->dataGrid->addColumn(
                'edit',
                null,
                Language::lbl('Edit'),
                Model::createURLForAction('Edit') . '&amp;id=[id]',
                Language::lbl('Edit')
            );
        }
    }

    /**
     * Parse the datagrid and the reports
     */
    protected function parse()
    {
        parent::parse();

        $this->tpl->assign('dataGrid', (string) $this->dataGrid->getContent());
    }
}

<?php

namespace Backend\Modules\News\Actions;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use Backend\Core\Engine\Base\ActionIndex;
use Backend\Core\Engine\Authentication;
use Backend\Core\Engine\DataGridDoctrine;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model;
use Backend\Modules\News\Engine\Model as BackendNewsModel;

/**
 * This is the categories-action, it will display the overview of news categories
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Categories extends ActionIndex
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
     * Load the dataGrid
     */
    private function loadDataGrid()
    {
        // create dataGrid
        $this->dataGrid = new DataGridDoctrine(
            BackendNewsModel::CATEGORY_ENTITY_CLASS,
            array(),
            array('id', 'backendTitle' => 'title', 'sequence'),
            'sequence',
            'asc'
        );

        $this->dataGrid->enableSequenceByDragAndDrop();
        $this->dataGrid->setAttributes(array('data-action' => 'SequenceCategories'));
        $this->dataGrid->setRowAttributes(array('id' => '[id]'));
        $this->dataGrid->setPaging(false);

        // check if this action is allowed
        if (Authentication::isAllowedAction('EditCategory')) {
            $this->dataGrid->setColumnURL('title', Model::createURLForAction('EditCategory') . '&amp;id=[id]');
            $this->dataGrid->addColumn(
                'edit',
                null,
                Language::lbl('Edit'),
                Model::createURLForAction('EditCategory') . '&amp;id=[id]',
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
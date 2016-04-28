<?php

namespace Backend\Modules\News\Actions;

use Backend\Core\Engine\Base\ActionIndex;
use Backend\Core\Engine\Authentication;
use Backend\Core\Engine\DataGridDoctrine;
use Backend\Core\Engine\DataGridFunctions;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model;
use Backend\Modules\News\Engine\Model as BackendNewsModel;

/**
 * This is the index-action (default), it will display the overview of news items
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Index extends ActionIndex
{
    /** @var array $settings */
    protected $settings = array();

    /**
     * Execute the action
     */
    public function execute()
    {
        parent::execute();

        $this->getData();
        $this->loadDataGrid();
        $this->parse();
        $this->display();
    }

    /**
     * Get the data
     */
    private function getData()
    {
        foreach (Language::getActiveLanguages() as $abbreviation) {
            $this->languages[$abbreviation] = array(
                'language' => $abbreviation
            );
        }

        // get module settings
        $this->settings = $this->get('fork.settings')->getForModule($this->URL->getModule());
    }

    /**
     * Load the datagrid
     */
    private function loadDataGrid()
    {
        $this->dataGrid = new DataGridDoctrine(
            BackendNewsModel::ARTICLE_ENTITY_CLASS,
            array(),
            array('id', 'backendTitle' => 'title', 'spotlight', 'publishOn', 'author')
        );

        // sorting columns
        $this->dataGrid->setSortingColumns(array('title', 'publishOn', 'author'), 'publishOn');

        // column functions
        $this->dataGrid->setColumnFunction(
            array('Backend\Modules\News\Engine\DataGridFunctions', 'getStatusLabelSpotlight'),
            array('[spotlight]'), 'spotlight', true
        );

        $this->dataGrid->setSortParameter('desc');

        // multi images enabled
        if ($this->settings['multi_images_enabled']) {
            if (Authentication::isAllowedAction('Images')) {
                // view images
                $this->dataGrid->addColumn('images', null,
                    '<a href="' . Model::createURLForAction('Images') . '&amp;id=[id]' . '" class="button icon iconImages linkButton">' .
                    '<span>' . Language::lbl('Images') . '</span>' .
                    '</a>'
                );
            }
        }

        // set column functions
        $this->dataGrid->setColumnFunction(
            array(new DataGridFunctions(), 'getLongDate'),
            array('[publishOn]'),
            'publishOn',
            true
        );
        $this->dataGrid->setColumnFunction(
            array(new DataGridFunctions(), 'getUser'),
            array('[author]'),
            'author',
            true
        );

        // check if this action is allowed
        if (Authentication::isAllowedAction('Edit')) {
            $this->dataGrid->setColumnURL(
                'title',
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
     * Parse the datagrid
     */
    protected function parse()
    {
        parent::parse();

        $this->tpl->assign('dataGrid', (string) $this->dataGrid->getContent());
        $this->tpl->assign('numCategories', (int) BackendNewsModel::countAllCategories());
    }
}

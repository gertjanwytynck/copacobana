<?php

namespace Backend\Modules\Festival\Actions;

use Backend\Core\Engine\Base\ActionEdit;
use Backend\Core\Engine\Authentication;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Form;
use Backend\Core\Engine\Model;

/**
 * This is the settings-action, it will display a form to set general artists settings
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class Settings extends ActionEdit
{
    /** @var boolean $godUser */
    private $godUser;

    /**
     * Execute the action
     */
    public function execute()
    {
        parent::execute();

        $this->getData();
        $this->loadForm();
        $this->validateForm();
        $this->parse();
        $this->display();
    }

    /**
     * Get the data
     */
    public function getData()
    {
        $this->godUser = Authentication::getUser()->isGod();
    }

    /**
     * Loads the settings form
     */
    private function loadForm()
    {
        // init settings form
        $this->frm = new Form('settings');

        // add festival year
        $this->frm->addText('festival_year', Model::getModuleSetting($this->module, 'festival_year', '2016'));

        // add fields for pagination
        $this->frm->addDropdown(
            'overview_num_items',
            array_combine(range(1, 30), range(1, 30)),
            Model::getModuleSetting($this->URL->getModule(), 'overview_num_items', 10)
        );
        $this->frm->addDropdown(
            'recent_festival_list_num_items',
            array_combine(range(1, 30), range(1, 30)),
            Model::getModuleSetting($this->URL->getModule(), 'recent_festival_list_num_items', 5)
        );

        // add functions fields
        $this->frm->addCheckbox('cover_image_enabled', Model::getModuleSetting($this->module, 'cover_image_enabled', false));
        $this->frm->addCheckbox('cover_image_required', Model::getModuleSetting($this->module, 'cover_image_required', false));
        $this->frm->addCheckbox('multi_images_enabled', Model::getModuleSetting($this->module, 'multi_images_enabled', false));

        // add god user only fields
        if ($this->godUser) {
            $this->frm->addText('image_size_limit', (float) Model::getModuleSetting($this->module, 'image_size_limit', 10));
        }
    }

    /**
     * Parse the data
     */
    protected function parse()
    {
        parent::parse();

        $this->tpl->assign('godUser', $this->godUser);
    }

    /**
     * Validates the settings form
     */
    private function validateForm()
    {
        if ($this->frm->isSubmitted()) {
            $this->frm->cleanupFields();

            $txtFestivalYear = $this->frm->getField('festival_year');
            $chkCoverImageEnabled = $this->frm->getField('cover_image_enabled');
            $chkCoverImageRequiredd = $this->frm->getField('cover_image_required');
            $chkMultiImagesEnabled = $this->frm->getField('multi_images_enabled');
            $ddmOverviewNumItems = $this->frm->getField('overview_num_items');
            $ddmRecentFestivalListNumitems = $this->frm->getField('recent_festival_list_num_items');

            // validate god user settings
            if ($this->godUser) {
                $txtImageSizeLimit = $this->frm->getField('image_size_limit');

                if ($txtImageSizeLimit->isFilled(Language::err('FieldIsRequired'))) {
                    $txtImageSizeLimit->isFloat(Language::err('ImageSizeIsInvalid'));
                }
            }

            // validation
            $txtFestivalYear->isFilled(Language::err('FieldIsRequired'));

            if ($this->frm->isCorrect()) {
                // set settings
                Model::setModuleSetting($this->module, 'festival_year', (string) ($txtFestivalYear->getValue()));
                Model::setModuleSetting($this->module, 'cover_image_enabled', (bool) ($chkCoverImageEnabled->isChecked()));
                Model::setModuleSetting($this->module, 'cover_image_required', (bool) ($chkCoverImageRequiredd->isChecked()));
                Model::setModuleSetting($this->module, 'multi_images_enabled', (bool) ($chkMultiImagesEnabled->isChecked()));
                Model::setModuleSetting($this->module, 'overview_num_items', (int) $ddmOverviewNumItems->getValue());
                Model::setModuleSetting($this->module, 'recent_festival_list_num_items', (int) $ddmRecentFestivalListNumitems->getValue());

                // set god user settings
                if ($this->godUser) {
                    Model::setModuleSetting($this->module, 'image_size_limit', (float) $txtImageSizeLimit->getValue());
                }

                // trigger event
                Model::triggerEvent($this->getModule(), 'after_saved_settings');

                // redirect to the settings page
                $this->redirect(Model::createURLForAction('Settings') . '&report=saved');
            }
        }
    }
}

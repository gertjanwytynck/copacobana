<?php

namespace Backend\Modules\Downloads\Actions;

use Common\Uri as CommonUri;

use Backend\Core\Engine\Base\ActionEdit;
use Backend\Core\Engine\Model;
use Backend\Core\Engine\Form;
use Backend\Core\Engine\Language;
use Backend\Modules\Downloads\Entity\DownloadLocale;
use Backend\Modules\Downloads\Engine\Model as BackendDownloadsModel;

/**
 * This is the edit-action, it will display a form to edit an existing item
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Edit extends ActionEdit
{
    /** @var array $language */
    private $languages = array();

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
    private function getData()
    {
        $em = Model::get('doctrine.orm.entity_manager');
        $downloadsRepo = $em->getRepository(BackendDownloadsModel::DOWNLOAD_ENTITY_CLASS);

        $this->id = $this->getParameter('id', 'int');
        $this->record = $downloadsRepo->find($this->id);

        if ($this->id == null || empty($this->record)) {
            $this->redirect(Model::createURLForAction('Index') . '&error=non-existing');
        }

        foreach (Language::getActiveLanguages() as $abbreviation) {
            $this->languages[$abbreviation] = array(
                'language' => $abbreviation
            );
        }
    }

    /**
     * Load the form
     */
    private function loadForm()
    {
        // create form
        $this->frm = new Form('edit');

        $this->frm->addText('backend_title', $this->record->getBackendTitle(), 255, 'inputText title', 'inputTextError title');

        // add language fields
        foreach ($this->languages as $abbreviation => $language) {
            $locale = $this->record->getLocale($abbreviation);

            // load existing locale or create blank one
            if ($locale !== null) {
                // locale exists
                $this->languages[$abbreviation]['formElements'] = array(
                    'chkActivate' => $this->frm->addCheckbox('activate_' . $abbreviation, true),
                    'txtTitle' => $this->frm->addText('title_' . $abbreviation, $locale->getTitle(), 255, 'inputText title', 'inputTextError title'),
                    'fileFile' => $this->frm->addFile('file_' . $abbreviation)
                );
                $this->languages[$abbreviation]['filename'] = $locale->getFilename();
            } else {
                $this->languages[$abbreviation]['formElements'] = array(
                    'chkActivate' => $this->frm->addCheckbox('activate_' . $abbreviation, false),
                    'txtTitle' => $this->frm->addText('title_' . $abbreviation, null, 255, 'inputText title', 'inputTextError title'),
                    'fileFile' => $this->frm->addFile('file_' . $abbreviation)
                );
            }
        }
    }

    /**
     * Parse the form
     */
    protected function parse()
    {
        parent::parse();

        $this->header->addJS('MultiLanguage.js');

        $this->tpl->assign('item', $this->record);
        $this->tpl->assign('languages', $this->languages);
    }

    /**
     * Validate the form
     */
    private function validateForm()
    {
        if ($this->frm->isSubmitted()) {
            $this->frm->cleanupFields();

            // validate the fields
            $this->frm->getField('backend_title')->isFilled(Language::err('FieldIsRequired'));

            // validate form elements for each language
            $atLeastOneLanguage = false;
            foreach ($this->languages as $abbreviation => $language) {
                if ($this->frm->getField('activate_' . $abbreviation)->getValue() == 'Y') {
                    // validate locale
                    $this->frm->getField('title_' . $abbreviation)->isFilled(Language::getError('TitleIsRequired'));

                    if ($this->record->getLocale($abbreviation) === null) {
                        $this->frm->getField('file_' . $abbreviation)->isFilled(Language::getError('FieldIsRequired'));
                    }

                    $atLeastOneLanguage = true;
                }
            }
            // we need at least one active language
            if (!$atLeastOneLanguage) {
                foreach ($this->languages as $abbreviation => $language) {
                    $this->frm->getField('activate_' . $abbreviation)->addError(Language::getError('AtLeastOneLanguageIsRequired'));
                }
            }

            if ($this->frm->isCorrect()) {
                // get the entity manager
                $em = Model::get('doctrine.orm.entity_manager');

                // update the download object
                $download = $this->record;
                $download->setBackendTitle($this->frm->getField('backend_title')->getValue());

                // loop through all languages
                foreach ($this->languages as $abbreviation => $language) {
                    $locale = $this->record->getLocale($abbreviation);
                    $activated = ($this->frm->getField('activate_' . $abbreviation)->getValue() == 'Y');

                    // save the record
                    if ($activated) {
                        if ($locale === null) {
                            // create extra
                            $extraId = Model::insertExtra(
                                'widget',
                                'Downloads',
                                'Download'
                            );

                            $locale = new DownloadLocale();
                            $locale->setDownload($download);
                            $locale->setLanguage($abbreviation);
                            $locale->setExtraId($extraId);
                        }

                        // store locale
                        $locale->setTitle($this->frm->getField('title_' . $abbreviation)->getValue());

                        // upload file
                        if ($this->frm->getField('file_' . $abbreviation)->isFilled()) {

                            if ($locale->getFilename() !== null){
                                $locale->removeFile();
                            }

                            // upload the file
                            $filePath = FRONTEND_FILES_PATH . '/downloads';
                            $fileName = $this->frm->getField('file_' . $abbreviation)->getFileName(false);
                            $fileExtension = $this->frm->getField('file_' . $abbreviation)->getExtension();
                            $locale->setFilename(CommonUri::getUrl((string) $fileName . '_' . uniqid()) . '.' . $fileExtension);
                            $this->frm->getField('file_' . $abbreviation)->moveFile($filePath . '/' . $locale->getFilename());
                        }

                        // update data for the extra
                        Model::updateExtra(
                            $locale->getExtraId(),
                            'data',
                            array(
                                'id' => $download->getId(),
                                'extra_label' => $locale->getTitle(),
                                'language' => $abbreviation,
                                'edit_url' => Model::createURLForAction('Edit', 'Downloads') . '&id=' . $download->getId()
                            )
                        );

                        $em->persist($locale);
                    }

                    // delete the locale record
                    else if ($locale !== null) {
                        $em->remove($locale);
                    }
                }

                // flush
                $em->flush();

                // trigger event
                Model::triggerEvent($this->getModule(), 'after_edit', array('item' => $download));

                // everything is saved, so redirect to the overview
                $this->redirect(
                    Model::createURLForAction('Index') . '&report=edited&var=' .
                    urlencode($download->getBackendTitle()) . '&highlight=row-' . $download->getId()
                );
            }
        }
    }
}

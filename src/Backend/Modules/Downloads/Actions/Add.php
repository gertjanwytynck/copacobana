<?php

namespace Backend\Modules\Downloads\Actions;

use Common\Uri as CommonUri;

use Backend\Core\Engine\Base\ActionAdd;
use Backend\Core\Engine\Model;
use Backend\Core\Engine\Form;
use Backend\Core\Engine\Language;
use Backend\Modules\Downloads\Entity\Download;
use Backend\Modules\Downloads\Entity\DownloadLocale;
use Backend\Modules\Downloads\Engine\Model as BackendDownloadsModel;

/**
 * This is the add-action, it will display a form to create a new item
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Add extends ActionAdd
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
        $this->frm = new Form('add');

        $this->frm->addText('backend_title', null, 255, 'inputText title', 'inputTextError title');

        // add language fields
        foreach ($this->languages as $abbreviation => $language) {
            $this->languages[$abbreviation]['formElements'] = array(
                'chkActivate' => $this->frm->addCheckbox('activate_' . $abbreviation),
                'txtTitle' => $this->frm->addText('title_' . $abbreviation, null, 255, 'inputText title', 'inputTextError title'),
                'fileFile' => $this->frm->addFile('file_' . $abbreviation)
            );
        }
    }

    /**
     * Parse the form
     */
    protected function parse()
    {
        parent::parse();

        $this->header->addJS('MultiLanguage.js');

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
                    $this->frm->getField('file_' . $abbreviation)->isFilled(Language::getError('FieldIsRequired'));

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

                // create the download object
                $download = new Download();
                $download->setBackendTitle($this->frm->getField('backend_title')->getValue());
                $download->setSequence($em->getRepository(BackendDownloadsModel::DOWNLOAD_ENTITY_CLASS)->getMaximumSequence());
                $em->persist($download);
                $em->flush();

                // loop through all languages
                foreach ($this->languages as $abbreviation => $language) {
                    if ($this->frm->getField('activate_' . $abbreviation)->getValue() == 'Y') {
                        // create extra
                        $extraId = Model::insertExtra(
                            'widget',
                            'Downloads',
                            'Download'
                        );

                        // create the download locale object
                        $locale = new DownloadLocale();
                        $locale->setDownload($download);
                        $locale->setLanguage($abbreviation);
                        $locale->setTitle($this->frm->getField('title_' . $abbreviation)->getValue());
                        $locale->setExtraId($extraId);

                        // upload file
                        $filePath = FRONTEND_FILES_PATH . '/downloads';
                        $fileName = $this->frm->getField('file_' . $abbreviation)->getFileName(false);
                        $fileExtension = $this->frm->getField('file_' . $abbreviation)->getExtension();
                        $locale->setFilename(CommonUri::getUrl((string) $fileName . '_' . uniqid()) . '.' . $fileExtension);
                        $this->frm->getField('file_' . $abbreviation)->moveFile($filePath . '/' . $locale->getFilename());

                        // update data for the extra
                        Model::updateExtra(
                            $extraId,
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
                }

                // flush
                $em->flush();

                // trigger event
                Model::triggerEvent($this->getModule(), 'after_add', array('item' => $download));

                // everything is saved, so redirect to the overview
                $this->redirect(
                    Model::createURLForAction('Index') . '&report=added&var=' .
                    urlencode($download->getBackendTitle()) . '&highlight=row-' . $download->getId()
                );
            }
        }
    }
}

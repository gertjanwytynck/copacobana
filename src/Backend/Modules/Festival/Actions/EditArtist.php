<?php

namespace Backend\Modules\Festival\Actions;

use Common\Uri as CommonUri;

use Backend\Core\Engine\Base\ActionEdit;
use Backend\Core\Engine\Form;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model;
use Backend\Core\Engine\MetaMultilanguage;
use Backend\Core\Entity\Meta;
use Backend\Modules\Festival\Entity\Artist;
use Backend\Modules\Festival\Entity\ArtistPractical;
use Backend\Modules\Festival\Entity\ArtistWebsite;
use Backend\Modules\Festival\Entity\ArtistWebsiteLocale;
use Backend\Modules\Users\Engine\Model as BackendUsersModel;
use Backend\Core\Engine\Authentication as BackendAuthentication;
use Backend\Modules\Festival\Engine\Model as BackendFestivalModel;


/**
 * This is the edit-action, it will display a form to edit an artist.
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class EditArtist extends ActionEdit
{
    /** @var languages */
    private $languages;

    /** @var link */
    private $link;

    /** @var link */
    private $linkEn;

    /** @var settings */
    private $settings;

    /** @var stages */
    private $stages;

    /** @var stages */
    private $categories;

    /** The meta fields for each language */
    protected $meta = array();

    /** @var array backstage */
    private $arrBackstage = array();

    /** @var array backstage */
    private $arrOnstage = array();

    /**
     * Execute the action.
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
        // get the entity manager
        $em = Model::get('doctrine.orm.entity_manager');
        $artistRepo = $em->getRepository(BackendFestivalModel::ARTIST_ENTITY_CLASS);

        $this->id = $this->getParameter('id', 'int');
        $this->record = $artistRepo->find($this->id);

        if ($this->id == null || empty($this->record)) {
            $this->redirect(Model::createURLForAction('Festival') . '&error=non-existing');
        }

        // get stages
        $this->stages = $em->getRepository(BackendFestivalModel::ARTIST_STAGE_ENTITY_CLASS)->stagesDropdown();
        if (empty($this->stages)) {
            $this->redirect(Model::createURLForAction('Artists') . '&error=create-a-stage-first');
        }

        // get categories
        $this->categories = $em->getRepository(BackendFestivalModel::ARTIST_CATEGORIES_ENTITY_CLASS)->categoriesDropdown();
        if (empty($this->categories)) {
            $this->redirect(Model::createURLForAction('Artists') . '&error=create-a-category-first');
        }

        // init languages
        foreach (Language::getActiveLanguages() as $abbreviation) {
            $this->languages[$abbreviation] = array(
                'language' => $abbreviation
            );
        }

        // get the link
        $this->link = SITE_URL . Model::getURLForBlock('Festival',
                'SignUp') . '/' . $this->record->getMeta()->getUrl() . '?token=' . $this->record->getToken();

        // get the link
        $this->linkEn = SITE_URL . Model::getURLForBlock('Festival',
                'SignUp', 'en') . '/' . $this->record->getMeta()->getUrl() . '?token=' . $this->record->getToken();

        // get module settings
        $this->settings = Model::getModuleSettings($this->module);
    }

    /**
     * Load the form
     */
    private function loadForm()
    {
        // create form
        $this->frm = new Form('edit');

        // set hidden values
        $rbtHiddenValues[] = array('label' => Language::lbl('Hidden', $this->URL->getModule()), 'value' => 'Y');
        $rbtHiddenValues[] = array('label' => Language::lbl('Published'), 'value' => 'N');

        // create general elements
        $this->frm->addText('name', $this->record->getName(), 255, 'inputText title', 'inputTextError title');
        $this->frm->addImage('cover');
        $this->frm->addCheckbox('delete_image');


        // create practical info
        $this->frm->addDate('start_on_date', $this->record->getStartOn()->getTimestamp());
        $this->frm->addTime('start_on_time', date('H:i', $this->record->getStartOn()->getTimestamp()));
        $this->frm->addDropdown('stageId', $this->stages, $this->record->getStage()->getId());
        $this->frm->addDropdown('categoryId', $this->categories,  $this->record->getCategory()->getId());

        // create status settings
        $this->frm->addRadiobutton('hidden', $rbtHiddenValues, ($this->record->getIsHidden() ? 'Y' : 'N'));
        $this->frm->addDropdown('userId', BackendUsersModel::getUsers(), $this->record->getAuthorId());
        $this->frm->addCheckbox('finalized', $this->record->getFinalized());
        $this->frm->addCheckbox('signUpOpen', $this->record->getSignUpOpen());
        $this->frm->addCheckbox('spotlight', $this->record->getSpotlight());

        // artist practical

        $practical = $this->record->getPractical();
        foreach ($practical as $practic) {
            $this->frm->addText('contactName', $practic->getContactName(), 255, 'inputText title',
                'inputTextError title')->setAttribute('required', true);
            $this->frm->addText('contactFirstName', $practic->getContactFirstName(), 255, 'inputText title',
                'inputTextError title');
            $this->frm->addText('contactPhone', $practic->getContactPhone(), 255, 'inputText title',
                'inputTextError title')->setAttribute('required', true);
            $this->frm->addText('contactEmail', $practic->getContactEmail(), 255, 'inputText title',
                'inputTextError title');
            $this->frm->addCheckbox('soundEngineer', $practic->getSoundEngineer());
            $this->frm->addText('hotMeal', $practic->getHotMeal(), 255, 'inputText title', 'inputTextError title');
            $this->frm->addText('veggieMeal', $practic->getVeggieMeal(), 255, 'inputText title',
                'inputTextError title');
            $this->frm->addText('totalCars', $practic->getTotalCars(), 255, 'inputText title', 'inputTextError title');
            $this->frm->addFile('technicalFile', $practic->getTechnicalFilename());
            $this->frm->addCheckbox('delete_technical');
            $this->frm->addFile('contractFile', $practic->getContractFilename());
            $this->frm->addCheckbox('delete_contract');
            $this->frm->addTextarea('remark', $practic->getRemark());

            // get backstage artist
            if ( $practic->getBackstage() ) {
                foreach ($practic->getBackstage() as $key=>$backstage) {
                    $this->arrBackstage[$key]['name'] = $backstage->getName();
                }
            }

            // get onstage artist
            if ( $practic->getOnstage() ) {
                foreach ($practic->getOnstage() as $key=>$onstage) {
                    $this->arrOnstage[$key]['name'] = $onstage->getName();
                }
            }


            // @todo only parse this in the parse() function..
            $this->tpl->assign('practical', $practic);

        }

        // artist practical
        $website = $this->record->getWebsite();
        foreach ($website as $content) {
            // create social elements
            $this->frm->addText('facebook', $content->getFacebookUrl(), 255, 'inputText title', 'inputTextError title');
            $this->frm->addText('twitter', $content->getTwitterUrl(), 255, 'inputText title', 'inputTextError title');
            $this->frm->addText('youtube', $content->getYoutubeUrl(), 255, 'inputText title', 'inputTextError title');
            $this->frm->addText('instagram', $content->getInstagramUrl(), 255, 'inputText title',
                'inputTextError title');
            $this->frm->addText('soundcloud', $content->getSoundcloudUrl(), 255, 'inputText title',
                'inputTextError title');
            $this->frm->addText('website', $content->getWebsiteUrl(), 255, 'inputText title', 'inputTextError title');
            $this->frm->addTextarea('bio', $content->getBio());

            // create form elements for each language
            foreach ($this->languages as $abbreviation => $language) {
                $locale = $content->getLocale($abbreviation);
                // load existing locale or create blank one
                if ($locale !== null) {
                    $this->languages[$abbreviation]['formElements'] = array(
                        'chkActivate' => $this->frm->addCheckbox('activate_' . $abbreviation, true),
                        'txtBio' => $this->frm->addEditor('bio_' . $abbreviation, $locale->getBio()),
                    );

                } else {
                    // locale fields
                    $this->languages[$abbreviation]['formElements'] = array(
                        'chkActivate' => $this->frm->addCheckbox('activate_' . $abbreviation),
                        'txtBio' => $this->frm->addEditor('bio_' . $abbreviation),
                    );
                }
            }
        }

        // create meta object
        $meta = new MetaMultilanguage($this->frm, '', $this->record->getMeta(), 'name', true);
        // set meta callback
        $meta->setURLCallback(
            'Backend\\Modules\\' . $this->URL->getModule() . '\\Engine\\Model',
            'getArtistURL', array('', $this->record->getId())
        );

        $this->meta = array(
            'language' => '',
            'meta' => $meta,
            'template' => $meta->createTemplate('')
        );
    }

    /**
     * Parse the form
     */
    protected function parse()
    {
        parent::parse();

        $this->tpl->assign('item', $this->record);
        $this->tpl->assign('languages', $this->languages);
        $this->tpl->assign('link', $this->link);
        $this->tpl->assign('linkEn', $this->linkEn);
        $this->tpl->assign('meta', $this->meta);

        // back & onstage
        $this->tpl->assign('personsOnstage', $this->arrOnstage);
        $this->tpl->assign('totalOnstage', count($this->arrOnstage));
        $this->tpl->assign('personsBackstage', $this->arrBackstage);
        $this->tpl->assign('totalBackstage', count($this->arrBackstage));
    }

    /**
     * Validate the form
     */
    private function validateForm()
    {
        // is the form submitted?
        if ($this->frm->isSubmitted()) {
            // cleanup the submitted fields, ignore fields that were added by hackers
            $this->frm->cleanupFields();

            // get fields
            $this->frm->getField('name')->isFilled(Language::err('FieldIsRequired'));

            // when cover is filled
            if ($this->frm->getField('cover')->isFilled()) {
                $this->frm->getField('cover')->isAllowedExtension(
                    array('jpg', 'png', 'gif', 'jpeg'), Language::err('JPGGIFAndPNGOnly')
                );
                $this->frm->getField('cover')->isAllowedMimeType(
                    array('image/jpg', 'image/png', 'image/gif', 'image/jpeg'), Language::err('JPGGIFAndPNGOnly')
                );
            }

            // no errors?
            if ($this->frm->isCorrect()) {
                // create artist repo
                $em = Model::get('doctrine.orm.entity_manager');
                $stageRepo = $em->getRepository(BackendFestivalModel::ARTIST_STAGE_ENTITY_CLASS);
                $categoryRepo = $em->getRepository(BackendFestivalModel::ARTIST_CATEGORIES_ENTITY_CLASS);

                $artist = $this->record;
                $artistPractical = $this->record->getPractical();
                $artistWebsite = $this->record->getWebsite();
                $artist->setName($this->frm->getField('name')->getValue());

                // get the stage
                if ($this->frm->getField('stageId')->isFilled(Language::err('FieldIsRequired'))) {
                    $stageRepo = $stageRepo->find($this->frm->getField('stageId')->getValue());
                    if ($stageRepo === null) {
                        $this->frm->getField('stageId')->setError(Language::err('InvalidValue'));
                    }
                }

                // get the category
                if ($this->frm->getField('categoryId')->isFilled(Language::err('FieldIsRequired'))) {
                    $categoryRepo = $categoryRepo->find($this->frm->getField('categoryId')->getValue());
                    if ($categoryRepo === null) {
                        $this->frm->getField('categoryId')->setError(Language::err('InvalidValue'));
                    }
                }

                // upload the cover
                if ($this->frm->getField('delete_image')->isChecked()) {
                    $artist->removeCover();
                }

                if ($this->frm->getField('cover')->isFilled()) {
                    $artist->removeCover();
                    $imagePath = FRONTEND_FILES_PATH . '/festival/artists/covers';
                    $artist->setCover(CommonUri::getUrl((string)$this->frm->getField('cover')->getFileName(false) . '_' . uniqid())
                        . '.' . $this->frm->getField('cover')->getExtension()
                    );
                    $this->frm->getField('cover')->generateThumbnails($imagePath, $artist->getCover());
                }

                // get start on datetime
                $startOn = new \DateTime();
                $startOn = $startOn->setTimestamp(Model::getUTCTimestamp(
                    $this->frm->getField('start_on_date'),
                    $this->frm->getField('start_on_time')
                ));

                // set artist
                $artist->setYear($this->settings['year']);
                $artist->setStartOn($startOn);
                $artist->setSignUpOpen($this->frm->getField('signUpOpen')->isChecked());
                $artist->setFinalized($this->frm->getField('finalized')->isChecked());
                $artist->setSpotlight($this->frm->getField('spotlight')->isChecked());
                $artist->setIsHidden(($this->frm->getField('hidden')->getValue() == 'Y'));
                $artist->setAuthorId($this->frm->getField('userId')->getValue());
                $artist->setStage($stageRepo);
                $artist->setCategory($categoryRepo);

                $meta = $this->meta['meta'];
                $meta->setURL($artist->getName());
                $artist->setMeta($meta->save());
                $em->persist($artist);

                // set artist pratical
                foreach ($artistPractical as $content) {
                    $content->setContactName($this->frm->getField('contactName')->getValue());
                    $content->setContactFirstName($this->frm->getField('contactFirstName')->getValue());
                    $content->setContactPhone($this->frm->getField('contactPhone')->getValue());
                    $content->setContactEmail($this->frm->getField('contactEmail')->getValue());
                    $content->setSoundEngineer($this->frm->getField('soundEngineer')->isChecked());
                    $content->setHotMeal($this->frm->getField('hotMeal')->getValue());
                    $content->setVeggieMeal($this->frm->getField('veggieMeal')->getValue());
                    $content->setTotalCars($this->frm->getField('totalCars')->getValue());
                    $content->setRemark($this->frm->getField('remark')->getValue());

                    // delete the technical
                    if ($this->frm->getField('delete_technical')->isChecked()) {
                        $content->removeTechnical();
                    }

                    // upload the technical file
                    if ($this->frm->getField('technicalFile')->isFilled()) {
                        $content->removeTechnical();
                        $imagePath = FRONTEND_FILES_PATH . '/festival/artists/files/technical';
                        $content->setTechnicalFilename(CommonUri::getUrl((string)$this->frm->getField('technicalFile')->getFileName(false) . '_' . uniqid())
                            . '.' . $this->frm->getField('technicalFile')->getExtension()
                        );
                        $this->frm->getField('technicalFile')->moveFile($imagePath . '/' . $content->getTechnicalFilename());
                    }

                    // delete the contract
                    if ($this->frm->getField('delete_technical')->isChecked()) {
                        $content->removeContract();
                    }

                    // upload the file
                    if ($this->frm->getField('contractFile')->isFilled()) {
                        $content->removeContract();
                        $imagePath = FRONTEND_FILES_PATH . '/festival/artists/files/contract';
                        $content->setContractFilename(CommonUri::getUrl((string)$this->frm->getField('contractFile')->getFileName(false) . '_' . uniqid())
                            . '.' . $this->frm->getField('contractFile')->getExtension()
                        );
                        $this->frm->getField('contractFile')->moveFile($imagePath . '/' . $content->getContractFilename());
                    }

                    // insert the practical
                    $em->persist($content);
                }

                // insert artist website
                foreach ($artistWebsite as $content) {
                    $content->setFacebookUrl($this->frm->getField('facebook')->getValue());
                    $content->setTwitterUrl($this->frm->getField('twitter')->getValue());
                    $content->setYoutubeUrl($this->frm->getField('youtube')->getValue());
                    $content->setInstagramUrl($this->frm->getField('instagram')->getValue());
                    $content->setSoundcloudUrl($this->frm->getField('soundcloud')->getValue());
                    $content->setWebsiteUrl($this->frm->getField('website')->getValue());
                    $content->setBio($this->frm->getField('bio')->getValue());
                    // insert the artist
                    $em->persist($content);

                    // loop through all languages
                    foreach ($this->languages as $abbreviation => $language) {
                        if ($this->frm->getField('activate_' . $abbreviation)->getValue() == 'Y') {
                            $locale = $content->getLocale($abbreviation);

                            if ($locale === null) $locale = new ArtistWebsiteLocale();
                            // set the locale
                            $locale->setArtist($content);
                            $locale->setBio($this->frm->getField('bio_' . $abbreviation)->getValue());
                            $locale->setLanguage($abbreviation);
                            $em->persist($locale);
                        }
                    }
                }

                // flush
                $em->flush();
                // trigger event
                Model::triggerEvent($this->getModule(), 'after_edit_artist', array('item' => $artist));

                // redirect
                $this->redirect(Model::createURLForAction('Artists') . '&id=' . $artist->getId() .
                    '&report=edited&var=' . urlencode($artist->getName())
                );
            }
        }
    }
}
<?php

namespace Backend\Modules\Festival\Actions;

use Common\Uri as CommonUri;

use Backend\Core\Engine\Base\ActionAdd;
use Backend\Core\Engine\Form;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model;
use Backend\Core\Engine\MetaMultilanguage;
use Backend\Core\Entity\Meta;
use Backend\Modules\Festival\Entity\Artist;
use Backend\Modules\Festival\Entity\ArtistDate;
use Backend\Modules\Festival\Entity\ArtistPractical;
use Backend\Modules\Festival\Entity\ArtistWebsite;
use Backend\Modules\Festival\Entity\ArtistWebsiteLocale;
use Backend\Modules\Users\Engine\Model as BackendUsersModel;
use Backend\Core\Engine\Authentication as BackendAuthentication;
use Backend\Modules\Festival\Engine\Model as BackendFestivalModel;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * This is the add-action, it will display a form to add a new artist.
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class AddArtist extends ActionAdd
{

    /**
     * @var languages
     */
    private $languages;

    /**
     * @var settings
     */
    private $settings;

    /**
     * @var stages
     */
    private $stages;

    /**
     * @var categories
     */
    private $categories;

    /** The meta fields for each language */
    protected $meta = array();

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
    private function getData() {
        // get the entity manager
        $em = Model::get('doctrine.orm.entity_manager');

        // get stages
        $this->stages = $em->getRepository(BackendFestivalModel::ARTIST_STAGE_ENTITY_CLASS)->stagesDropdown();
        if (empty($this->stages)) $this->redirect(Model::createURLForAction('Artists') . '&error=create-a-stage-first');

        // get stages
        $this->categories = $em->getRepository(BackendFestivalModel::ARTIST_CATEGORIES_ENTITY_CLASS)->categoriesDropdown();
        if (empty($this->categories)) $this->redirect(Model::createURLForAction('Artists') . '&error=create-a-category-first');

        // init languages
        foreach (Language::getActiveLanguages() as $abbreviation) {
            $this->languages[$abbreviation] = array(
                'language' => $abbreviation
            );
        }

        // get module settings
        $this->settings = $this->get('fork.settings')->getForModule($this->URL->getModule());
    }
    /**
     * Load the form
     */
    private function loadForm()
    {
        // create form
        $this->frm = new Form('add');

        // set hidden values
        $rbtHiddenValues[] = array('label' => Language::lbl('Hidden', $this->URL->getModule()), 'value' => 'Y');
        $rbtHiddenValues[] = array('label' => Language::lbl('Published'), 'value' => 'N');

        // create general elements
        $this->frm->addText('name',  null, 255, 'inputText title', 'inputTextError title');
        $this->frm->addImage('cover');

        // create status settings
        $this->frm->addRadiobutton('hidden', $rbtHiddenValues, 'Y');
        $this->frm->addDropdown('userId', BackendUsersModel::getUsers(), BackendAuthentication::getUser()->getUserId());
        $this->frm->addCheckbox('finalized');
        $this->frm->addCheckbox('signUpOpen', 'Y');
        $this->frm->addCheckbox('spotlight');

        // artist practical
        $this->frm->addText('contactName',  null, 255, 'inputText title', 'inputTextError title');
        $this->frm->addText('contactFirstName',  null, 255, 'inputText title', 'inputTextError title');
        $this->frm->addText('contactPhone',  null, 255, 'inputText title', 'inputTextError title');
        $this->frm->addText('contactEmail',  null, 255, 'inputText title', 'inputTextError title');
        $this->frm->addCheckbox('soundEngineer');
        $this->frm->addText('hotMeal', 0, 255, 'inputText title', 'inputTextError title');
        $this->frm->addText('veggieMeal', 0, 255, 'inputText title', 'inputTextError title');
        $this->frm->addText('veganMeal', 0, 255, 'inputText title', 'inputTextError title');
        $this->frm->addFile('technicalFile');
        $this->frm->addFile('contractFile');
        $this->frm->addFile('stageFile');
        $this->frm->addFile('extraFile');
        $this->frm->addEditor('remark');

        // create social elements
        $this->frm->addText('facebook', '', 255, 'inputText title', 'inputTextError title');
        $this->frm->addText('twitter', '', 255, 'inputText title', 'inputTextError title');
        $this->frm->addText('youtube', '', 255, 'inputText title', 'inputTextError title');
        $this->frm->addText('instagram', '', 255, 'inputText title', 'inputTextError title');
        $this->frm->addText('soundcloud', '', 255, 'inputText title', 'inputTextError title');
        $this->frm->addText('website', '', 255, 'inputText title', 'inputTextError title');
        $this->frm->addEditor('bio');

        // create form elements for each language
        foreach ($this->languages as $abbreviation => $language) {
            // locale fields
            $this->languages[$abbreviation]['formElements'] = array(
                'chkActivate' => $this->frm->addCheckbox('activate_' . $abbreviation),
                'txtBio' => $this->frm->addEditor('bio_' . $abbreviation),
            );
        }

        // create meta object
        $meta = new MetaMultilanguage($this->frm, '', new Meta(), 'name', true);
        $meta->setURLCallback(
            'Backend\\Modules\\' . $this->URL->getModule() . '\\Engine\\Model',
            'getArtistURL', array('')
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

        $this->tpl->assign('stages', $this->stages);
        $this->tpl->assign('categories', $this->categories);
        $this->tpl->assign('languages', $this->languages);
    }

    /**
     * Validate the form
     */
    private function validateForm()
    {
        $arrDates = array();
        if (!empty($_POST['dates']) && !empty($_POST['startTimes']) && !empty($_POST['endTimes'])) {
            foreach($_POST['dates'] as $key=>$date) {
                if (!empty($date)) {
                    $startOn = new \DateTime();
                    $endOn = new \DateTime();
                    $startTime = \DateTime::createFromFormat('d/m/Y H:i', $date . ' ' . $_POST['startTimes'][$key])->format('U');
                    $endTime = \DateTime::createFromFormat('d/m/Y H:i', $date . ' ' . $_POST['endTimes'][$key])->format('U');
                    $arrDates[$key]['startDate'] = $startOn->setTimestamp($startTime);
                    $arrDates[$key]['endDate'] = $endOn->setTimestamp($endTime);
                    $arrDates[$key]['stage'] = $_POST['stages'][$key];
                    $arrDates[$key]['category'] = $_POST['categories'][$key];
                }
            }
        }

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

                $artist = new Artist();
                $artistPractical = new ArtistPractical();
                $artistWebsite = new ArtistWebsite();
                $artist->setName($this->frm->getField('name')->getValue());

                // upload the cover
                if ($this->frm->getField('cover')->isFilled()) {
                    $imagePath = FRONTEND_FILES_PATH . '/festival/artists/covers';
                    $artist->setCover(CommonUri::getUrl((string)$this->frm->getField('cover')->getFileName(false) . '_' . uniqid())
                        . '.' . $this->frm->getField('cover')->getExtension()
                    );
                    $this->frm->getField('cover')->generateThumbnails($imagePath, $artist->getCover());
                }

                // get the meta
                $meta = $this->meta['meta'];
                $meta->setURL($this->frm->getField('name')->getValue());

                // set artist
                $artist->setYear($this->settings['year']);
                $artist->setStartOn($startOn);
                $artist->setEndOn($endOn);
                $artist->setSignUpOpen($this->frm->getField('signUpOpen')->isChecked());
                $artist->setFinalized($this->frm->getField('finalized')->isChecked());
                $artist->setSpotlight($this->frm->getField('spotlight')->isChecked());
                $artist->setIsHidden(($this->frm->getField('hidden')->getValue() == 'Y'));
                $artist->setAuthorId($this->frm->getField('userId')->getValue());
                $artist->setToken(uniqid());
                $artist->setMeta($meta->save());

                // insert the artist
                $em->persist($artist);

                // add dates
                foreach ($arrDates as $date) {
                    $stageRepo = $em->getRepository(BackendFestivalModel::ARTIST_STAGE_ENTITY_CLASS);
                    $categoryRepo = $em->getRepository(BackendFestivalModel::ARTIST_CATEGORIES_ENTITY_CLASS);
                    $stageRepo = $stageRepo->find($date['stage']);
                    $categoryRepo = $categoryRepo->find($date['category']);

                    if ($stageRepo != null && $categoryRepo != null) {
                        $artistDate = new ArtistDate();
                        $artistDate->setArtist($artist);
                        $artistDate->setStartOn($date['startDate']);
                        $artistDate->setEndOn($date['endDate']);
                        $artistDate->setStage($stageRepo);
                        $artistDate->setCategory($categoryRepo);
                        $em->persist($artistDate);
                        $em->flush();
                    }
                }

                // set artist pratical
                $artistPractical->setArtist($artist);
                $artistPractical->setContactName($this->frm->getField('contactName')->getValue());
                $artistPractical->setContactFirstName($this->frm->getField('contactFirstName')->getValue());
                $artistPractical->setContactPhone($this->frm->getField('contactPhone')->getValue());
                $artistPractical->setContactEmail($this->frm->getField('contactEmail')->getValue());
                $artistPractical->setSoundEngineer($this->frm->getField('soundEngineer')->isChecked());
                $artistPractical->setHotMeal($this->frm->getField('hotMeal')->getValue());
                $artistPractical->setVeggieMeal($this->frm->getField('veggieMeal')->getValue());
                $artistPractical->setVeganMeal($this->frm->getField('veganMeal')->getValue());
                $artistPractical->setRemark($this->frm->getField('remark')->getValue());

                // upload the technical file
                if ($this->frm->getField('technicalFile')->isFilled()) {
                    $imagePath = FRONTEND_FILES_PATH . '/festival/artists/files/technical';
                    $artistPractical->setTechnicalFilename(CommonUri::getUrl((string)$this->frm->getField('technicalFile')->getFileName(false) . '_' . uniqid())
                        . '.' . $this->frm->getField('technicalFile')->getExtension()
                    );
                    $this->frm->getField('technicalFile')->moveFile($imagePath . '/' . $artistPractical->getTechnicalFilename());
                }
                // upload the file
                if ($this->frm->getField('contractFile')->isFilled()) {
                    $imagePath = FRONTEND_FILES_PATH . '/festival/artists/files/contract';
                    $artistPractical->setContractFilename(CommonUri::getUrl((string)$this->frm->getField('contractFile')->getFileName(false) . '_' . uniqid())
                        . '.' . $this->frm->getField('contractFile')->getExtension()
                    );
                    $this->frm->getField('contractFile')->moveFile($imagePath . '/' . $artistPractical->getContractFilename());

                }
                // upload stage file
                if ($this->frm->getField('stageFile')->isFilled()) {
                    $imagePath = FRONTEND_FILES_PATH . '/festival/artists/files/stages';
                    $artistPractical->setStageFilename(CommonUri::getUrl((string)$this->frm->getField('stageFile')->getFileName(false) . '_' . uniqid())
                        . '.' . $this->frm->getField('stageFile')->getExtension()
                    );
                    $this->frm->getField('stageFile')->moveFile($imagePath . '/' . $artistPractical->getStageFileName());

                }

                 // upload extra file
                if ($this->frm->getField('extraFile')->isFilled()) {
                    $imagePath = FRONTEND_FILES_PATH . '/festival/artists/files/extra';
                    $artistPractical->setExtraFilename(CommonUri::getUrl((string)$this->frm->getField('extraFile')->getFileName(false) . '_' . uniqid())
                        . '.' . $this->frm->getField('extraFile')->getExtension()
                    );
                    $this->frm->getField('extraFile')->moveFile($imagePath . '/' . $artistPractical->getExtraFilename());

                }
                // insert the artist
                $em->persist($artistPractical);

                // insert artist website
                $artistWebsite->setArtist($artist);
                $artistWebsite->setFacebookUrl( $this->frm->getField('facebook')->getValue());
                $artistWebsite->setTwitterUrl( $this->frm->getField('twitter')->getValue());
                $artistWebsite->setYoutubeUrl( $this->frm->getField('youtube')->getValue());
                $artistWebsite->setInstagramUrl( $this->frm->getField('instagram')->getValue());
                $artistWebsite->setSoundcloudUrl( $this->frm->getField('soundcloud')->getValue());
                $artistWebsite->setWebsiteUrl( $this->frm->getField('website')->getValue());
                $artistWebsite->setBio($this->frm->getField('bio')->getValue());
                // insert the artist
                $em->persist($artistWebsite);

                // loop through all languages
                foreach ($this->languages as $abbreviation => $language) {
                    if ($this->frm->getField('activate_' . $abbreviation)->getValue() == 'Y') {
                        // create the download locale object
                        $locale = new ArtistWebsiteLocale();
                        $locale->setArtist($artistWebsite);
                        $locale->setBio($this->frm->getField('bio_' . $abbreviation)->getValue());
                        $locale->setLanguage($abbreviation);

                        $em->persist($locale);
                    }
                }

                // flush
                $em->flush();
                // trigger event
                Model::triggerEvent($this->getModule(), 'after_add_artist', array('item' => $artist));

                // redirect
                $this->redirect(
                    Model::createURLForAction('Artists') . '&id=' . $artist->getId() .
                    '&report=added&var=' . urlencode($artist->getName())
                );
            }
        }
    }
}

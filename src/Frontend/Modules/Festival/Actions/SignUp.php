<?php

namespace Frontend\Modules\Festival\Actions;

use Common\Uri as CommonUri;

use Frontend\Core\Engine\Base\Block;
use Frontend\Core\Engine\Model;
use Frontend\Core\Engine\Form;
use Frontend\Core\Engine\Language;
use Frontend\Core\Engine\Navigation;
use Backend\Modules\Festival\Entity\ArtistPracticalBackstage;
use Backend\Modules\Festival\Entity\ArtistPracticalCar;
use Frontend\Modules\Festival\Engine\Model as FrontendFestivalModel;

/**
 * This is the signup-action
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class SignUp extends Block
{
    /** @var array $record */
    protected $record;

    /** @var array $frm */
    protected $frm;

    /** @var array $settings */
    protected $settings;

    /** @var array $arrTypes */
    protected $arrTypes;

    /** @var array $emailFieldsDates */
    protected $emailFieldsDates = array();

    /** @var boolean $closed */
    protected $closed = false;

    /**
     * Execute the extra
     */
    public function execute()
    {
        parent::execute();

        $this->loadTemplate();
        $this->getData();
        $this->loadForm();
        $this->validateForm();
        $this->parse();
    }

    /**
     * Get the data
     */
    private function getData()
    {
        // check for parameter
        if ($this->URL->getParameter(0) === null) $this->redirect(Navigation::getURL(404));

        // check if there is a token
        if (empty($_GET['token'])) $this->redirect(Navigation::getURL(404));

        // get doctrine manager
        $em = Model::get('doctrine.orm.entity_manager');

        // get by URL
        $this->record = $em ->getRepository(FrontendFestivalModel::ARTIST_ENTITY_CLASS)
            ->_findByUrl($this->URL->getParameter(0), FRONTEND_LANGUAGE);

        // check if token is correct
        $token = $em ->getRepository(FrontendFestivalModel::ARTIST_ENTITY_CLASS)
            ->_checkToken($this->record['id'], $_GET['token']);

        // redirect if token is null
        if (!$token) $this->redirect(Navigation::getURL(404));

        // anything found?
        if ($this->record === null) $this->redirect(Navigation::getURL(404));

        // check if the sign up is open
        if ($this->record['signUpOpen'] != 1) $this->closed = true;

        // make a backstage array
        if (isset($this->record['practical'][0]['backstage'])){
            if (isset($this->record['practical'][0]['backstage'][1])){
                foreach ($this->record['practical'][0]['backstage'] as $key=>$backstage) {
                    if($key > 0) $arrBackstage[$key]['name'] = $backstage['name'];
                    if($key > 0) $arrBackstage[$key]['type'] = $backstage['type'];
                }
                $this->tpl->assign('personsBackstage', $arrBackstage);
            }
        }

        $cars = array();
        $cars[0]['id'] = '';
        $cars[0]['licencePlate'] = '';
        $cars[1]['id'] ='';
        $cars[1]['licencePlate'] = '';
        $cars[2]['id'] = '';
        $cars[2]['licencePlate'] = '';

        // assign the cars
        if (isset($this->record['practical'][0]['car'])){
            foreach ($this->record['practical'][0]['car'] as $key => $value) {
                $cars[$key]['id'] = $value['id'];
                $cars[$key]['licencePlate'] = $value['licencePlate'];
            }
        }
        $this->tpl->assign('cars', $cars);

        // convert the date
        setlocale(LC_TIME, FRONTEND_LANGUAGE .'_' . strtoupper(FRONTEND_LANGUAGE));

        // create practical info
        $startDates = array();
        foreach ($this->record["date"] as $key => $startDate) {
            $startDates[$key]['date'] = date("d-m-Y", $startDate['startOn']->getTimestamp());
            $startDates[$key]['time'] = date('H:i', $startDate['startOn']->getTimestamp());
            $startDates[$key]['stage'] = $startDate['stage']['stageName'];
        }
        $this->tpl->assign('startDates', $startDates);
        $this->emailFieldsDates = $startDates;

        // Hardcoded types for our crew
        $this->arrTypes = array();
        $this->arrTypes[0]['id'] = 0;
        $this->arrTypes[0]['name'] = 'artiest';
        $this->arrTypes[1]['id'] = 1;
        $this->arrTypes[1]['name'] = 'geluidstechnieker';
        $this->arrTypes[2]['id'] = 2;
        $this->arrTypes[2]['name'] = 'technieker';
        $this->arrTypes[3]['id'] = 3;
        $this->arrTypes[3]['name'] = 'manager';

        $this->tpl->assign('types', $this->arrTypes);

        // get the module settings
        $this->settings = $this->get('fork.settings')->getForModule('Festival');
    }

    /**
     * Load the form
     */
    private function loadForm()
    {
        // create form
        $this->frm = new Form('edit');

        $arrTypes = array();
        $arrTypes[0] = 'artiest';
        $arrTypes[1] = 'geluidstechnieker';
        $arrTypes[2] = 'technieker';
        $arrTypes[3] = 'manager';

        // set proper date
        if ( ! $this->closed ){
            $this->frm->addImage('cover')->setAttributes(array( 'class' => 'form-control uploadFile'));
            $this->frm->addCheckbox('delete_cover', false);
            $this->frm->addCheckbox('delete_technical', false);
            $this->frm->addCheckbox('delete_contract', false);
            $this->frm->addCheckbox('delete_stage', false);
            $this->frm->addCheckbox('delete_extra', false);

            $this->frm->addText('contactName', $this->record['practical'][0]['contactName'])->setAttributes(array('required' => true, 'class' => 'form-control', 'max-length' => '255', 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Name')) . '*' ));
            $this->frm->addText('contactFirstName',  $this->record['practical'][0]['contactFirstName'])->setAttributes(array('required' => true, 'class' => 'form-control', 'max-length' => '255', 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('FirstName')) . '*' ));
            $this->frm->addText('contactPhone',  $this->record['practical'][0]['contactPhone'])->setAttributes(array('required' => true, 'class' => 'form-control', 'max-length' => '255', 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Phone')) . '*' ));
            $this->frm->addText('contactEmail',  $this->record['practical'][0]['contactEmail'])->setAttributes(array('required' => true, 'class' => 'form-control', 'max-length' => '255', 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Email')) . '*' ));

            $this->frm->addCheckbox('soundEngineer',$this->record['practical'][0]['soundEngineer']);
            $this->frm->addText('hotMeal', $this->record['practical'][0]['hotMeal'])->setAttributes(array('required' => true, 'class' => 'form-control numeric'));
            $this->frm->addText('veggieMeal', $this->record['practical'][0]['veggieMeal'])->setAttributes(array('required' => true, 'class' => 'form-control numeric'));
            $this->frm->addText('veganMeal',  $this->record['practical'][0]['veganMeal'])->setAttributes(array('required' => true, 'class' => 'form-control numeric'));
            $this->frm->addFile('technical')->setAttributes(array( 'class' => 'form-control uploadFile'));
            $this->frm->addFile('contract')->setAttributes(array( 'class' => 'form-control uploadFile'));
            $this->frm->addFile('stage')->setAttributes(array( 'class' => 'form-control uploadFile'));
            $this->frm->addFile('extra')->setAttributes(array( 'class' => 'form-control uploadFile'));
            $this->frm->addTextarea('remark', $this->record['practical'][0]['remark'])->setAttributes(array('class' => 'form-control', 'placeholder' => \SpoonFilter::ucfirst(Language::msg('Remark'))));

            if (isset($this->record['practical'][0]['backstage'][0])) {
                $this->frm->addText('nameBackstage', $this->record['practical'][0]['backstage'][0]['name'])->setAttributes(array('class' => 'form-control', 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('FirstName')) . ' & ' . ucfirst(Language::lbl('Name'))));
                $this->frm->addDropdown('typeBackstage', $arrTypes, $this->record['practical'][0]['backstage'][0]['type']);
            } else {
                $this->frm->addText('nameBackstage')->setAttributes(array('class' => 'form-control', 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('FirstName')) . ' & ' . ucfirst(Language::lbl('Name'))));
                $this->frm->addDropdown('typeBackstage', $arrTypes);
            }

            $this->frm->addCheckbox('signUpOpen', '0');

            // create social elements
            $this->frm->addText('facebook', $this->record['website'][0]['facebookUrl'])->setAttributes(array('class' => 'form-control', 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Facebook'))));
            $this->frm->addText('twitter', $this->record['website'][0]['twitterUrl'])->setAttributes(array('class' => 'form-control', 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Twitter'))));
            $this->frm->addText('youtube', $this->record['website'][0]['youtubeUrl'])->setAttributes(array('class' => 'form-control', 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Youtube'))));
            $this->frm->addText('instagram', $this->record['website'][0]['instagramUrl'])->setAttributes(array('class' => 'form-control', 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Instagram'))));
            $this->frm->addText('soundcloud', $this->record['website'][0]['soundcloudUrl'])->setAttributes(array('class' => 'form-control', 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Soundcloud'))));
            $this->frm->addText('website', $this->record['website'][0]['websiteUrl'])->setAttributes(array('class' => 'form-control', 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Website'))));
            $this->frm->addTextarea('bio', htmlspecialchars_decode($this->record['website'][0]['bio']))->setAttributes(array('class' => 'form-control', 'placeholder' => \SpoonFilter::ucfirst(Language::msg('Bio'))));
        } else {
            $this->frm->addText('contactName', $this->record['practical'][0]['contactName'])->setAttributes(array('required' => true, 'class' => 'form-control', 'max-length' => '255', 'disabled' => true, 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Name')) . '*' ));
            $this->frm->addText('contactFirstName',  $this->record['practical'][0]['contactFirstName'])->setAttributes(array('required' => true, 'class' => 'form-control', 'max-length' => '255','disabled' => true,  'placeholder' => \SpoonFilter::ucfirst(Language::lbl('FirstName')) . '*' ));
            $this->frm->addText('contactPhone',  $this->record['practical'][0]['contactPhone'])->setAttributes(array('required' => true, 'class' => 'form-control', 'max-length' => '255', 'disabled' => true, 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Phone')) . '*' ));
            $this->frm->addText('contactEmail',  $this->record['practical'][0]['contactEmail'])->setAttributes(array('required' => true, 'class' => 'form-control', 'max-length' => '255', 'disabled' => true, 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Email')) . '*' ));
            $this->frm->addCheckbox('soundEngineer',$this->record['practical'][0]['soundEngineer'])->setAttributes(array('disabled', true));
            $this->frm->addText('hotMeal', $this->record['practical'][0]['hotMeal'])->setAttributes(array('required' => true,'disabled' => true,  'class' => 'form-control'));
            $this->frm->addText('veggieMeal', $this->record['practical'][0]['veggieMeal'])->setAttributes(array('required' => true, 'disabled' => true, 'class' => 'form-control'));
            $this->frm->addText('veganMeal',  $this->record['practical'][0]['veganMeal'])->setAttributes(array('required' => true, 'disabled' => true, 'class' => 'form-control'));
            $this->frm->addTextarea('remark', $this->record['practical'][0]['remark'])->setAttributes(array('class' => 'form-control', 'disabled' => true, 'placeholder' => \SpoonFilter::ucfirst(Language::msg('Remark'))));

            if (isset($this->record['practical'][0]['backstage'][0])) {
                $this->frm->addText('nameBackstage', $this->record['practical'][0]['backstage'][0]['name'])->setAttributes(array('class' => 'form-control', 'disabled' => true, 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('FirstName')) . ' & ' . ucfirst(Language::lbl('Name'))));
                $this->frm->addDropdown('typeBackstage', $arrTypes, $this->record['practical'][0]['backstage'][0]['type'])->setAttributes(array('disabled' => true));
            } else {
                $this->frm->addText('nameBackstage')->setAttributes(array('class' => 'form-control', 'disabled' => true, 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('FirstName')) . ' & ' . ucfirst(Language::lbl('Name'))));
                $this->frm->addDropdown('typeBackstage', $arrTypes)->setAttributes(array('disabled' => true));
            }

            // create social elements
            $this->frm->addText('facebook', $this->record['website'][0]['facebookUrl'])->setAttributes(array('class' => 'form-control', 'disabled' => true, 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Facebook'))));
            $this->frm->addText('twitter', $this->record['website'][0]['twitterUrl'])->setAttributes(array('class' => 'form-control', 'disabled' => true, 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Twitter'))));
            $this->frm->addText('youtube', $this->record['website'][0]['youtubeUrl'])->setAttributes(array('class' => 'form-control', 'disabled' => true, 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Youtube'))));
            $this->frm->addText('instagram', $this->record['website'][0]['instagramUrl'])->setAttributes(array('class' => 'form-control', 'disabled' => true, 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Instagram'))));
            $this->frm->addText('soundcloud', $this->record['website'][0]['soundcloudUrl'])->setAttributes(array('class' => 'form-control', 'disabled' => true, 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Soundcloud'))));
            $this->frm->addText('website', $this->record['website'][0]['websiteUrl'])->setAttributes(array('class' => 'form-control', 'disabled' => true, 'placeholder' => \SpoonFilter::ucfirst(Language::lbl('Website'))));
            $this->frm->addTextarea('bio', $this->record['website'][0]['bio'])->setAttributes(array('class' => 'form-control', 'disabled' => true, 'placeholder' => ''));
        }
    }

    /**
     * Parse the data into the template
     */
    private function parse()
    {
        if ($this->record['practical'][0]['soundEngineer'] == 1 ){
            $this->tpl->assign('soundActive', true);
        }

        $this->header->addJsData($this->module, 'backstage', $this->record['practical'][0]['backstage']);


        $this->header->addCSS('/src/Frontend/Modules/Festival/Layout/Css/content.min.css', false, false);
        $this->header->addCSS('/src/Frontend/Modules/Festival/Layout/Css/skin.min.css', false, false);

        $this->header->addJS('/src/Frontend/Modules/Festival/Js/masonry.min.js', false, false);
        $this->header->addJS('/src/Frontend/Modules/Festival/Js/jquery.tinymce.min.js', false, false);
        $this->header->addJS('/src/Frontend/Modules/Festival/Js/tinymce.min.js', false, false);
        $this->header->addJS('/src/Frontend/Modules/Festival/Js/theme.min.js', false, false);


        // assign the items
        $this->tpl->assign('item', (array) $this->record);
        $this->tpl->assign('settings', (array) $this->settings);
        $this->tpl->assign('closed', (boolean) $this->closed);

        // parse the form
        $this->frm->parse($this->tpl);

        // hide the page title
        $this->header->setPageTitle($this->record['meta']['title'], $this->record['meta']['overwriteTitle']);
        // set meta
        $this->header->addMetaDescription(
            $this->record['meta']['description'],
            $this->record['meta']['overwriteDescription']
        );
        $this->header->addMetaKeywords(
            $this->record['meta']['keywords'],
            $this->record['meta']['overwriteKeywords']
        );

        // advanced SEO-attributes
        $this->header->addMetaData(
            array('name' => 'robots', 'content' => 'noindex')
        );

        $this->header->addMetaData(
            array('name' => 'robots', 'content' => 'noindex')
        );
    }

    /**
     * Validate the form
     */
    private function validateForm()
    {
        // check if there are some added BackstagePerson
        if (!empty($_POST['nameBackstage'])) {
            $arrBackstage[0]['name'] = $_POST['nameBackstage'];
            $arrBackstage[0]['type'] = $_POST['typeBackstage'];
            $i=1;
            if (!empty($_POST['extraBackstage'])){
                foreach($_POST['extraBackstage'] as $key=>$backstage) {
                    if (!empty($backstage)) {
                        $arrBackstage[$i]['name'] = $backstage;
                        $arrBackstage[$i]['type'] = $_POST['typesBackstage'][$key];
                        $i++;
                    }
                }
            }
        }

        // get the licence plates
        if (!empty($_POST['car'])) {
            $i=0;
            foreach($_POST['car'] as $key=>$plate) {
                if (!empty($plate)) {
                    $arrCars[$i] = $plate;
                    $i++;
                }
            }
        }

        // echo '<pre>';
        // print_r($_POST['car']);
        // echo '</pre>';

        // is the form submitted?
        if ($this->frm->isSubmitted()) {
            // cleanup the submitted fields, ignore fields that were added by hackers
            $this->frm->cleanupFields();

            // check if they are urls {
            if ($this->frm->getField('facebook')->isFilled()) {
                $this->frm->getField('facebook')->isUrl(Language::err('IsUrl'));
            }

            if ($this->frm->getField('twitter')->isFilled()) {
                $this->frm->getField('twitter')->isUrl(Language::err('IsUrl'));
            }

            if ($this->frm->getField('youtube')->isFilled()) {
                $this->frm->getField('youtube')->isUrl(Language::err('IsUrl'));
            }

            if ($this->frm->getField('instagram')->isFilled()) {
                $this->frm->getField('instagram')->isUrl(Language::err('IsUrl'));
            }

            if ($this->frm->getField('soundcloud')->isFilled()) {
                $this->frm->getField('soundcloud')->isUrl(Language::err('IsUrl'));
            }

            if ($this->frm->getField('website')->isFilled()) {
                $this->frm->getField('website')->isUrl(Language::err('IsUrl'));
            }

            // when cover is filled
            if ($this->frm->getField('cover')->isFilled()) {
                $this->frm->getField('cover')->isAllowedExtension(
                    array('jpg', 'png', 'gif', 'jpeg'), Language::err('JPGGIFAndPNGOnly')
                );
                $this->frm->getField('cover')->isAllowedMimeType(
                    array('image/jpg', 'image/png', 'image/gif', 'image/jpeg'), Language::err('JPGGIFAndPNGOnly')
                );

                $this->frm->getField('cover')->isFilesize(
                    $this->settings['image_size_limit'], 'mb', 'smaller',
                    vsprintf(Language::msg('HelpMaxFileSizeMB'), array($this->settings['image_size_limit']))
                );
            }

            // when cover is filled
            if ($this->frm->getField('technical')->isFilled()) {
                $this->frm->getField('technical')->isFilesize(
                    $this->settings['image_size_limit'], 'mb', 'smaller',
                    vsprintf(Language::msg('HelpMaxFileSizeMB'), array($this->settings['file_size_limit']))
                );
            }

            // when cover is filled
            if ($this->frm->getField('contract')->isFilled()) {
                $this->frm->getField('contract')->isFilesize(
                    $this->settings['file_size_limit'], 'mb', 'smaller',
                    vsprintf(Language::msg('HelpMaxFileSizeMB'), array($this->settings['file_size_limit']))
                );
            }

            // when cover is filled
            if ($this->frm->getField('stage')->isFilled()) {
                $this->frm->getField('stage')->isFilesize(
                    $this->settings['file_size_limit'], 'mb', 'smaller',
                    vsprintf(Language::msg('HelpMaxFileSizeMB'), array($this->settings['file_size_limit']))
                );
            }

            // when cover is filled
            if ($this->frm->getField('extra')->isFilled()) {
                $this->frm->getField('extra')->isFilesize(
                    $this->settings['file_size_limit'], 'mb', 'smaller',
                    vsprintf(Language::msg('HelpMaxFileSizeMB'), array($this->settings['file_size_limit']))
                );
            }

            // validate the contact fields
            $this->frm->getField('contactName')->isFilled(Language::err('FieldIsRequired'));
            $this->frm->getField('contactFirstName')->isFilled(Language::err('FieldIsRequired'));
            $this->frm->getField('contactPhone')->isFilled(Language::err('FieldIsRequired'));
            $this->frm->getField('contactEmail')->isEmail(Language::err('EmailIsNotValid'));

            // no errors?
            if ($this->frm->isCorrect()) {
                // create artist repo
                $em = Model::get('doctrine.orm.entity_manager');
                // get the entity manager
                $artistRepo = $em->getRepository(FrontendFestivalModel::ARTIST_ENTITY_CLASS);
                $artist = $artistRepo->findByUrl($this->URL->getParameter(0), FRONTEND_LANGUAGE);

                $artist = $artist;
                $artistPractical = $artist->getPractical();
                $artistWebsite = $artist->getWebsite();

                // upload the cover
                if ($this->frm->getField('delete_cover')->isChecked()) {
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

                $artist->setSignUpOpen(1);
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
                    $content->setVeganMeal($this->frm->getField('veganMeal')->getValue());
                    $content->setRemark($this->frm->getField('remark')->getValue());

                    // Add email fields
                    $emailFields[] = array(
                        'label' =>  \SpoonFilter::ucfirst(Language::lbl('hotMeal')),
                        'value' => $this->frm->getField('hotMeal')->getValue()
                    );

                    $emailFields[] = array(
                        'label' =>  \SpoonFilter::ucfirst(Language::lbl('veggieMeal')),
                        'value' => $this->frm->getField('veggieMeal')->getValue()
                    );

                    $emailFields[] = array(
                        'label' =>  \SpoonFilter::ucfirst(Language::lbl('veganMeal')),
                        'value' => $this->frm->getField('veganMeal')->getValue()
                    );

                    $emailFields[] = array(
                        'label' =>  \SpoonFilter::ucfirst(Language::lbl('remark')),
                        'value' => $this->frm->getField('remark')->getValue()
                    );

                    if ($this->frm->getField('soundEngineer')->isChecked()) {
                        $emailFields[] = array(
                            'label' =>  \SpoonFilter::ucfirst(Language::lbl('soundEngineer')),
                            'value' => \SpoonFilter::ucfirst(Language::lbl('yes'))
                        );
                    } else {
                         $emailFields[] = array(
                            'label' =>  \SpoonFilter::ucfirst(Language::lbl('soundEngineer')),
                            'value' => \SpoonFilter::ucfirst(Language::lbl('no'))
                        );
                    }

                    // add person for backstage
                    if (!empty($arrBackstage)) {
                        foreach($content->getBackstage() as $back) {
                            $content->removeBackstage($back);
                            $em->remove($back);
                            $em->flush();
                        }

                        foreach ($arrBackstage as $backstage) {
                            $artistBackstage = new ArtistPracticalBackstage();
                            $artistBackstage->setArtist($content);
                            $artistBackstage->setName($backstage['name']);
                            $artistBackstage->setType($backstage['type']);
                            $em->persist($artistBackstage);
                            $em->flush();

                            // Add email fields
                            $emailFieldsCrew[] = array(
                                'label' =>  \SpoonFilter::ucfirst(Language::lbl('name')),
                                'value' => $backstage['name'] . " (" . $this->arrTypes[$backstage['type']]['name'] . ")"
                            );
                        }
                    }

                    // add cars
                    if (!empty($arrCars)) {
                        foreach($content->getCar() as $car) {
                            $content->removeCar($car);
                            $em->remove($car);
                            $em->flush();
                        }

                        foreach ($arrCars as $car) {
                            $artistCar = new ArtistPracticalCar();
                            $artistCar->setArtist($content);
                            $artistCar->setLicencePlate($car);
                            $em->persist($artistCar);
                            $em->flush();

                            // Add email fields
                            $emailFieldsCars[] = array(
                                'label' =>  \SpoonFilter::ucfirst(Language::lbl('licencePlate')),
                                'value' => $car
                            );
                        }
                    }

                    if ($content->getTechnicalFilename()) {
                        $technicalDeleted = true;
                    } else {
                        $technicalDeleted = false;
                    }
                    // delete the technical
                    if ($this->frm->getField('delete_technical')->isChecked()) {
                        $content->removeTechnical();
                    }

                    // upload the technical file
                    if ($this->frm->getField('technical')->isFilled()) {
                        $content->removeTechnical();
                        $imagePath = FRONTEND_FILES_PATH . '/festival/artists/files/technical';
                        $content->setTechnicalFilename(CommonUri::getUrl((string)$this->frm->getField('technical')->getFileName(false) . '_' . uniqid())
                            . '.' . $this->frm->getField('technical')->getExtension()
                        );
                        $this->frm->getField('technical')->moveFile($imagePath . '/' . $content->getTechnicalFilename());
                        $technicalDeleted = true;
                    }

                    if (!$technicalDeleted) {
                        $emailFields[] = array(
                            'label' =>  'Technical file' ,
                            'value' => \SpoonFilter::ucfirst(Language::lbl('no')),
                        );
                    } else {
                        $emailFields[] = array(
                            'label' =>  'Technical file' ,
                            'value' => \SpoonFilter::ucfirst(Language::lbl('yes')),
                        );
                    }


                    if ($content->getContractFilename()) {
                        $contractDeleted = true;
                    } else {
                        $contractDeleted = false;
                    }
                    // delete the contract
                    if ($this->frm->getField('delete_contract')->isChecked()) {
                        $content->removeContract();
                    }

                    // upload the file
                    if ($this->frm->getField('contract')->isFilled()) {
                        $content->removeContract();
                        $imagePath = FRONTEND_FILES_PATH . '/festival/artists/files/contract';
                        $content->setContractFilename(CommonUri::getUrl((string)$this->frm->getField('contract')->getFileName(false) . '_' . uniqid())
                            . '.' . $this->frm->getField('contract')->getExtension()
                        );
                        $this->frm->getField('contract')->moveFile($imagePath . '/' . $content->getContractFilename());
                        $contractDeleted = true;
                    }

                    if (!$contractDeleted) {
                        $emailFields[] = array(
                            'label' => 'Contract file',
                            'value' => \SpoonFilter::ucfirst(Language::lbl('no')),
                        );
                    } else {
                        $emailFields[] = array(
                            'label' => 'Contract file',
                            'value' => \SpoonFilter::ucfirst(Language::lbl('yes')),
                        );
                    }

                    if ($content->getStageFilename()) {
                        $stageDeleted = true;
                    } else {
                        $stageDeleted = false;
                    }
                    // delete the stage
                    if ($this->frm->getField('delete_stage')->isChecked()) {
                        $content->removeStage();
                        $stageDeleted = false;
                    }

                    // upload the file
                    if ($this->frm->getField('stage')->isFilled()) {
                        $content->removeStage();
                        $imagePath = FRONTEND_FILES_PATH . '/festival/artists/files/stages';
                        $content->setStageFilename(CommonUri::getUrl((string)$this->frm->getField('stage')->getFileName(false) . '_' . uniqid())
                            . '.' . $this->frm->getField('stage')->getExtension()
                        );
                        $this->frm->getField('stage')->moveFile($imagePath . '/' . $content->getStageFilename());
                        $stageDeleted = true;
                    }

                    if (!$stageDeleted) {
                        $emailFields[] = array(
                            'label' => 'Stage file',
                            'value' => \SpoonFilter::ucfirst(Language::lbl('no')),
                        );
                    } else {
                        $emailFields[] = array(
                            'label' => 'Stage file',
                            'value' => \SpoonFilter::ucfirst(Language::lbl('yes')),
                        );
                    }

                    if ($content->getExtraFilename()) {
                        $extraDeleted = true;
                    } else {
                        $extraDeleted = false;
                    }

                     // delete the stage
                    if ($this->frm->getField('delete_extra')->isChecked()) {
                        $content->removeExtra();
                        $extraDeleted = false;
                    }

                    // upload the file
                    if ($this->frm->getField('extra')->isFilled()) {
                        $content->removeExtra();
                        $imagePath = FRONTEND_FILES_PATH . '/festival/artists/files/extra';
                        $content->setExtraFilename(CommonUri::getUrl((string)$this->frm->getField('extra')->getFileName(false) . '_' . uniqid())
                            . '.' . $this->frm->getField('extra')->getExtension()
                        );
                        $this->frm->getField('extra')->moveFile($imagePath . '/' . $content->getExtraFilename());
                        $extraDeleted = true;
                    }

                    if (!$extraDeleted) {
                        $emailFields[] = array(
                            'label' => 'Extra file',
                            'value' => \SpoonFilter::ucfirst(Language::lbl('no')),
                        );
                    } else {
                        $emailFields[] = array(
                            'label' => 'Extra file',
                            'value' => \SpoonFilter::ucfirst(Language::lbl('yes')),
                        );
                    }

                    // insert the practical
                    $em->persist($content);
                }

                echo '<pre>';
                print_r($this->frm->getField('bio')->getValue());
                print_r(htmlspecialchars($this->frm->getField('bio')->getValue()));
                echo '</pre>';

                // insert artist website
                foreach ($artistWebsite as $content) {
                    $content->setFacebookUrl($this->frm->getField('facebook')->getValue());
                    $content->setTwitterUrl($this->frm->getField('twitter')->getValue());
                    $content->setYoutubeUrl($this->frm->getField('youtube')->getValue());
                    $content->setInstagramUrl($this->frm->getField('instagram')->getValue());
                    $content->setSoundcloudUrl($this->frm->getField('soundcloud')->getValue());
                    $content->setWebsiteUrl($this->frm->getField('website')->getValue());
                    $content->setBio(htmlspecialchars($this->frm->getField('bio')->getValue()));

                    // insert the artist
                    $em->persist($content);
                }

                // add field for email
                $emailFieldsPractical[] = array(
                    'label' =>  \SpoonFilter::ucfirst(Language::lbl('FirstName')),
                    'value' => $this->frm->getField('contactFirstName')->getValue()
                );

                $emailFieldsPractical[] = array(
                    'label' =>  \SpoonFilter::ucfirst(Language::lbl('Name')),
                    'value' => $this->frm->getField('contactName')->getValue()
                );

                $emailFieldsPractical[] = array(
                    'label' =>  \SpoonFilter::ucfirst(Language::lbl('Email')),
                    'value' => $this->frm->getField('contactEmail')->getValue()
                );

                $emailFieldsPractical[] = array(
                    'label' =>  \SpoonFilter::ucfirst(Language::lbl('Phone')),
                    'value' => $this->frm->getField('contactPhone')->getValue()
                );

                $variables['sentOn'] = time();
                $variables['name'] = Language::lbl('SignUpForm');
                $variables['fields'] = $emailFields;

                // flush
                $em->flush();

                // set mail
                $from = Model::get('fork.settings')->get('Core', 'mailer_from');
                $fieldData = $emailFields;
                $fieldDataPractical = $emailFieldsPractical;

                $fieldDataCrew = [];
                if (!empty($emailFieldsCrew)) {
                    $fieldDataCrew = $emailFieldsCrew;
                }

                $fieldDataCars = [];
                if (!empty($emailFieldsCars)) {
                    $fieldDataCars = $emailFieldsCars;
                }

                $fieldDataStage = $this->emailFieldsDates;
                $message = \Common\Mailer\Message::newInstance(sprintf(
                         \SpoonFilter::ucfirst(Language::lbl('SignUpForm')) . ": " . $artist->getName()
                    ))
                    ->parseHtml(
                        FRONTEND_PATH . '/Themes/Copacobana/Modules/FormBuilder/Layout/Mails/Form.tpl',
                        array(
                            'sentOn' => time(),
                            'name' => Language::lbl('SignUpForm') . ": " . $artist->getName(),
                            'fields' => $fieldData,
                            'fieldsPractical' => $fieldDataPractical,
                            'fieldsStartDates' => $fieldDataStage,
                            'fieldsCars' => $fieldDataCars,
                            'fieldsCrew' => $fieldDataCrew,
                        ),
                        true
                    )
                    ->setTo($this->frm->getField('contactEmail')->getValue())
                    ->setFrom(array($from['email'] => $from['name']))
                ;

                //$replyTo = Model::get('fork.settings')->get('Core', 'mailer_reply_to');
                //$message->setReplyTo(array($replyTo['email'] => $replyTo['name']));
                $message->setReplyTo(array('artiest@copacobana.be' => 'Copacobana Festival'));
                $this->get('mailer')->send($message);

                $message = \Common\Mailer\Message::newInstance(sprintf(
                         \SpoonFilter::ucfirst(Language::lbl('SignUpForm')) . ": " . $artist->getName()
                    ))
                    ->parseHtml(
                        FRONTEND_PATH . '/Themes/Copacobana/Modules/FormBuilder/Layout/Mails/Form.tpl',
                        array(
                            'sentOn' => time(),
                            'name' => Language::lbl('SignUpForm') . ": " . $artist->getName(),
                            'fields' => $fieldData,
                            'fieldsPractical' => $fieldDataPractical,
                            'fieldsStartDates' => $fieldDataStage,
                            'fieldsCars' => $fieldDataCars,
                            'fieldsCrew' => $fieldDataCrew,
                        ),
                        true
                    )
                    ->setTo('jochen@anamma.be')
                    ->setFrom(array($from['email'] => $from['name']))
                ;
                $message->setReplyTo(array('jochen@anamma.be' => 'Copacobana Festival'));
                $this->get('mailer')->send($message);

                $message = \Common\Mailer\Message::newInstance(sprintf(
                         \SpoonFilter::ucfirst(Language::lbl('SignUpForm')) . ": " . $artist->getName()
                    ))
                    ->parseHtml(
                        FRONTEND_PATH . '/Themes/Copacobana/Modules/FormBuilder/Layout/Mails/Form.tpl',
                        array(
                            'sentOn' => time(),
                            'name' => Language::lbl('SignUpForm') . ": " . $artist->getName(),
                            'fields' => $fieldData,
                            'fieldsPractical' => $fieldDataPractical,
                            'fieldsStartDates' => $fieldDataStage,
                            'fieldsCars' => $fieldDataCars,
                            'fieldsCrew' => $fieldDataCrew,
                        ),
                        true
                    )
                    ->setTo('gertjan.wytynck@gmail.com')
                    ->setFrom(array($from['email'] => $from['name']))
                ;
                $message->setReplyTo(array('jochen@anamma.be' => 'Copacobana Festival'));
                $this->get('mailer')->send($message);

                $this->tpl->assign('closed', true);
                $this->tpl->assign('success', true);
                $this->tpl->assign('link', SITE_URL . Navigation::getURLForBlock('Festival', 'SignUp') . '/' . $this->record['meta']['url'] . '?token=' . $this->record['token']);
            } else {
                $this->tpl->assign('error', true);
            }
        }
    }
}

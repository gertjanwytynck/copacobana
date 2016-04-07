<?php

namespace Backend\Modules\News\Actions;

use Common\Uri as CommonUri;

use Backend\Core\Engine\Base\ActionEdit;
use Backend\Core\Entity\Meta;
use Backend\Core\Engine\MetaMultilanguage;
use Backend\Core\Engine\Form;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model;
use Backend\Modules\News\Engine\Model as BackendNewsModel;
use Backend\Modules\Search\Engine\Model as BackendSearchModel;
use Backend\Modules\Users\Engine\Model as BackendUsersModel;
use Backend\Modules\Tags\Engine\Model as BackendTagsModel;
use Backend\Modules\News\Entity\ArticleLocale;

/**
 * This is the edit-action, it will display a form to create a new item
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Edit extends ActionEdit
{
    /** @var array $language */
    private $languages = array();

    /** @var array $meta */
    protected $meta = array();

    /** @var array $settings */
    protected $settings = array();

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

    private function getData()
    {
        $this->id = $this->getParameter('id', 'int');
        $this->record = BackendNewsModel::get($this->id);

        if ($this->id == null || empty($this->record)) {
            $this->redirect(BackendModel::createURLForAction('Index') . '&error=non-existing');
        }

        foreach (Language::getActiveLanguages() as $abbreviation) {
            $this->languages[$abbreviation] = array(
                'language' => $abbreviation
            );
        }

        // get module settings
        $this->settings = $this->get('fork.settings')->getForModule('News');
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

        // get categories
        $categories = BackendNewsModel::getCategories();

        // add fields
        $this->frm->addText('backend_title', $this->record->getBackendTitle(), 255, 'inputText title', 'inputTextError title');
        $this->frm->addText('youtube_url', $this->record->getYoutubeUrl(), 255, 'inputText title', 'inputTextError title');

        $this->frm->addRadiobutton('hidden', $rbtHiddenValues, ($this->record->getIsHidden() ? 'Y' : 'N'));
        $this->frm->addDropdown('category_id', $categories, $this->record->getCategory()->getId());
        $this->frm->addDropdown('user_id', BackendUsersModel::getUsers(), $this->record->getAuthor());
        $this->frm->addDate('publish_on_date', $this->record->getPublishOn()->getTimestamp());
        $this->frm->addTime('publish_on_time', date('H:i', $this->record->getPublishOn()->getTimestamp()));
        $this->frm->addCheckbox('spotlight', $this->record->getSpotlight());

        if ($this->settings['cover_image_enabled']) {
            $this->frm->addImage('image')->hideHelpTxt(true);
            $this->frm->addCheckbox('delete_image');
        }

        // add language fields and meta
        foreach ($this->languages as $abbreviation => $language) {
            $locale = $this->record->getLocale($abbreviation);

            // load existing locale or create blank one
            if ($locale !== null) {
                // locale exists
                $this->languages[$abbreviation]['formElements'] = array(
                    'chkActivate' => $this->frm->addCheckbox('activate_' . $abbreviation, true),
                    'txtTitle' => $this->frm->addText('title_' . $abbreviation, $locale->getTitle(), 255, 'inputText title', 'inputTextError title'),
                    'txtContent' => $this->frm->addEditor('content_' . $abbreviation, $locale->getContent()),
                    'txtTags' => $this->frm->addText('tags_' . $abbreviation,
                            BackendTagsModel::getTags(
                                $this->URL->getModule(),
                                $locale->getId(),
                                'string',
                                $abbreviation
                            ),
                        null, 'inputText tagOptionalLanguageBox', 'inputTextError tagOptionalLanguageBox'
                    )->setAttribute('data-language', $abbreviation)
                );

                // create meta object
                $meta = new MetaMultilanguage($this->frm, $abbreviation, $locale->getMeta(), 'title', true);

                // set meta callback
                $meta->setURLCallback(
                    'Backend\\Modules\\' . $this->URL->getModule() . '\\Engine\\Model',
                    'getURL',
                    array($abbreviation, $locale->getId())
                );
            } else {
                $this->languages[$abbreviation]['formElements'] = array(
                    'chkActivate' => $this->frm->addCheckbox('activate_' . $abbreviation, false),
                    'txtTitle' => $this->frm->addText('title_' . $abbreviation, null, 255, 'inputText title', 'inputTextError title'),
                    'txtContent' => $this->frm->addEditor('content_' . $abbreviation),
                    'txtTags' => $this->frm->addText(
                        'tags_' . $abbreviation,
                        null,
                        null,
                        'inputText tagOptionalLanguageBox',
                        'inputTextError tagOptionalLanguageBox'
                    )->setAttribute('data-language', $abbreviation)
                );

                // create meta object
                $meta = new MetaMultilanguage($this->frm, $abbreviation, new Meta(), 'title', true);

                // set meta callback
                $meta->setURLCallback(
                    'Backend\\Modules\\' . $this->URL->getModule() . '\\Engine\\Model',
                    'getURL',
                    array($abbreviation)
                );
            }

            // set meta info
            $this->meta[$abbreviation] = array(
                'language' => $abbreviation,
                'meta' => $meta,
                'template' => $meta->createTemplate($abbreviation)
            );
        }
    }

    /**
     * Parse the form
     */
    protected function parse()
    {
        parent::parse();

        $this->tpl->assign('item', $this->record);
        $this->tpl->assign('languages', $this->languages);
        $this->tpl->assign('meta', $this->meta);
        $this->tpl->assign('settings', $this->settings);
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
            $this->frm->getField('publish_on_date')->isValid(Language::err('DateIsInvalid'));
            $this->frm->getField('publish_on_time')->isValid(Language::err('TimeIsInvalid'));
            $this->frm->getField('category_id')->isFilled(Language::err('CategoryIsRequired'));

            // validate the image if enabled
            if ($this->settings['cover_image_enabled']) {
                if ($this->frm->getField('image')->isFilled()) {
                    $this->frm->getField('image')->isAllowedExtension(array('jpg', 'png', 'gif', 'jpeg'), Language::err('JPGGIFAndPNGOnly'));
                    $this->frm->getField('image')->isAllowedMimeType(array('image/jpg', 'image/png', 'image/gif', 'image/jpeg'), Language::err('JPGGIFAndPNGOnly'));
                    $this->frm->getField('image')->isFilesize(
                        $this->settings['image_size_limit'], 'mb', 'smaller',
                        vsprintf(Language::msg('HelpMaxFileSizeMB'), array($this->settings['image_size_limit']))
                    );
                }
            }

            // validate form elements for each language
            $atLeastOneLanguage = false;
            foreach ($this->languages as $abbreviation => $language) {
                if ($this->frm->getField('activate_' . $abbreviation)->getValue() == 'Y') {
                    // validate locale
                    $this->frm->getField('title_' . $abbreviation)->isFilled(Language::getError('TitleIsRequired'));
                    $this->frm->getField('content_' . $abbreviation)->isFilled(Language::getError('FieldIsRequired'));

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

                // get publish on datetime
                $publishOn = new \DateTime();
                $publishOn = $publishOn->setTimestamp(Model::getUTCTimestamp(
                    $this->frm->getField('publish_on_date'),
                    $this->frm->getField('publish_on_time')
                ));

                $article = $this->record;
                $article->setBackendTitle($this->frm->getField('backend_title')->getValue());
                $article->setYoutubeUrl($this->frm->getField('youtube_url')->getValue());
                $article->setCategory(BackendNewsModel::getCategory(
                    $this->frm->getField('category_id')->getValue()
                ));
                $article->setIsHidden(($this->frm->getField('hidden')->getValue() == 'Y'));
                $article->setSpotlight(($this->frm->getField('spotlight')->getValue() == 'Y'));
                $article->setPublishOn($publishOn);
                $article->setAuthor($this->frm->getField('user_id')->getValue());

                // upload the image if enabled
                if ($this->settings['cover_image_enabled']) {
                    $imagePath = FRONTEND_FILES_PATH . '/news/covers';

                    if (!$this->settings['cover_image_required'] && $this->frm->getField('delete_image')->isChecked()) {
                        $article->removeCoverImage();
                    } else if ($this->frm->getField('image')->isFilled()) {
                        $article->removeCoverImage();
                    }

                    if ($this->frm->getField('image')->isFilled()) {
                        // build the image name
                        $article->setCoverImage(CommonUri::getUrl($article->getBackendTitle()) . '_' . uniqid() . '.' . $this->frm->getField('image')->getExtension());

                        // upload the image & generate thumbnails
                        $this->frm->getField('image')->generateThumbnails($imagePath, $article->getCoverImage());
                    }
                }

                // update the article
                $em->persist($article);
                $em->flush(); // @todo Refactor: we need an id (tags and search do not yet support doctrine)

                // loop through all languages
                foreach ($this->languages as $abbreviation => $language) {
                    $locale = $this->record->getLocale($abbreviation);
                    $activated = ($this->frm->getField('activate_' . $abbreviation)->getValue() == 'Y');

                    // save the record
                    if ($activated) {
                        if ($locale === null) $locale = new ArticleLocale();

                        // store locale
                        $locale->setArticle($article);
                        $locale->setLanguage($abbreviation);
                        $locale->setTitle($this->frm->getField('title_' . $abbreviation)->getValue());
                        $locale->setContent($this->frm->getField('content_' . $abbreviation)->getValue());

                        // save meta
                        $meta = $this->meta[$abbreviation]['meta'];
                        $meta->setURL($locale->getTitle());
                        $locale->setMeta($meta->save());

                        $em->persist($locale);
                        $em->flush();

                        // save tags
                        BackendTagsModel::saveTags(
                            $locale->getId(),
                            $this->frm->getField('tags_' . $abbreviation)->getValue(),
                            $this->URL->getModule(),
                            $abbreviation
                        );

                        // save search index
                        BackendSearchModel::saveIndex(
                            $this->getModule(),
                            $locale->getId(),
                            array(
                                'title' => $this->frm->getField('title_' . $abbreviation)->getValue(),
                                'text' => $this->frm->getField('content_' . $abbreviation)->getValue()
                            ),
                            $abbreviation
                        );
                    }

                    // delete the locale record
                    else if ($locale !== null) {
                        // remove search index
                        BackendSearchModel::removeIndex($this->getModule(), $locale->getId(), $abbreviation);

                        // remove tags
                        BackendTagsModel::saveTags($locale->getId(), '', $this->getModule(), $abbreviation);

                        // remove the locale
                        $em->remove($locale);
                    }
                }

                // flush
                $em->flush();

                // trigger event
                Model::triggerEvent($this->getModule(), 'after_edit', array('item' => $article));

                // redirect
                $this->redirect(
                    Model::createURLForAction('Index') . '&id=' . $article->getId() .
                    '&report=edited&var=' . urlencode($article->getBackendTitle())
                );
            }
        }
    }
}

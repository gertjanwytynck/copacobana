<?php

namespace Backend\Modules\News\Actions;

use Backend\Core\Engine\Base\ActionAdd;
use Backend\Core\Engine\Form;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model;
use Backend\Core\Entity\Meta;
use Backend\Core\Engine\MetaMultilanguage;
use Backend\Modules\News\Engine\Model as BackendNewsModel;
use Backend\Modules\News\Entity\Category;
use Backend\Modules\News\Entity\CategoryLocale;

/**
 * This is the add-action, it will display a form to create a new category
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class AddCategory extends ActionAdd
{
    /** @var array $language */
    private $languages = array();

    /** @var array $meta */
    protected $meta = array();

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
        $this->frm = new Form('addCategory');
        $this->frm->addText('backend_title', null, 255, 'inputText title', 'inputTextError title');

        // add language fields and meta
        foreach ($this->languages as $abbreviation => $language) {
            $this->languages[$abbreviation]['formElements'] = array(
                'txtTitle' => $this->frm->addText('title_' . $abbreviation, null, 255, 'inputText title', 'inputTextError title')
            );

            // create meta object
            $meta = new MetaMultilanguage($this->frm, $abbreviation, new Meta(), 'title', true);
            $meta->setURLCallback(
                'Backend\\Modules\\' . $this->URL->getModule() . '\\Engine\\Model',
                'getCategoryURL',
                array($abbreviation)
            );

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

        $this->tpl->assign('languages', $this->languages);
        $this->tpl->assign('meta', $this->meta);
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
            foreach ($this->languages as $abbreviation => $language) {
                $this->frm->getField('title_' . $abbreviation)->isFilled(Language::getError('TitleIsRequired'));
            }

            if ($this->frm->isCorrect()) {
                // get the entity manager
                $em = Model::get('doctrine.orm.entity_manager');

                // build item
                $category = new Category();
                $category->setBackendTitle($this->frm->getField('backend_title')->getValue());
                $category->setSequence(BackendNewsModel::getMaximumCategorySequence() + 1);

                // loop through all languages
                foreach ($this->languages as $abbreviation => $language) {
                    // create locale
                    $locale = new CategoryLocale();
                    $locale->setCategory($category);
                    $locale->setLanguage($abbreviation);
                    $locale->setTitle($this->frm->getField('title_' . $abbreviation)->getValue());

                    // save meta
                    $meta = $this->meta[$abbreviation]['meta'];
                    $meta->setURL($locale->getTitle());
                    $locale->setMeta($meta->save());
                    $category->addLocale($locale);

                    // persist the locale
                    $em->persist($locale);
                }

                // flush
                $em->persist($category);
                $em->flush();

                // trigger event
                Model::triggerEvent($this->getModule(), 'after_add_category', array('item' => $category));

                // everything is saved, so redirect to the overview
                $this->redirect(
                    Model::createURLForAction('Categories') . '&report=added-category&var=' .
                    urlencode($category->getBackendTitle()) . '&highlight=row-' . $category->getId()
                );
            }
        }
    }
}
<?php

namespace Backend\Core\Engine;

use Common\Uri as CommonUri;

use Backend\Core\Engine\Model as BackendModel;
use Backend\Core\Engine\Template as BackendTemplate;
use Backend\Core\Entity\Meta as MetaEntity;

/**
 * This class represents a META-object
 *
 * @author Mathias Dewelde <mathias@dewelde.be>
 */
class MetaMultilanguage
{
    const ENTITY_CLASS = 'Backend\Core\Entity\Meta';

    /**
     * The abbreviation of the language.
     *
     * @var	string
     */
    protected $abbreviation;

    /**
     * The name of the field we should use to generate default-values
     *
     * @var    string
     */
    protected $baseFieldName;

    /**
     * The callback method
     *
     * @var    array
     */
    protected $callback = array();

    /**
     * Do we need meta custom
     *
     * @var    bool
     */
    protected $custom;

    /**
     * The data, when a existing meta-record is loaded
     *
     * @var    array
     */
    protected $data;

    /**
     * The form instance
     *
     * @var    Form
     */
    protected $frm;

    /**
     * The id, when an existing meta-record is loaded
     *
     * @var    int
     */
    protected $id;

    /**
     * The URL-instance
     *
     * @var    Url
     */
    protected $URL;

    /**
     * The URL to save when no custom URL is given - this overwrites the base field value.
     *
     * @var string
     */
    protected $overwriteURL = null;

    /**
     * @param Form   $form          An instance of Form, the elements will be parsed in here.
     * @param string $abbreviation  The language to parse the fields for.
     * @param int    $metaId        The metaID to load.
     * @param string $baseFieldName The field where the URL should be based on.
     * @param bool   $custom        Add/show custom-meta.
     * @throws
     */
    public function __construct(Form $form, $abbreviation, $metaId = null, $baseFieldName = 'title', $custom = false)
    {
        // check if URL is available from the reference
        if (!BackendModel::getContainer()->has('url')) {
            throw new Exception('URL should be available in the reference.');
        }

        // get BackendURL instance
        $this->URL = BackendModel::getContainer()->get('url');

        // should we use meta-custom
        $this->custom = (bool) $custom;

        // set form instance
        $this->frm = $form;

        if ($abbreviation == '' ) {
            // redefine
            $this->abbreviation = (string) $abbreviation;
        } else {
            // redefine
            $this->abbreviation = '_' . (string) $abbreviation;
        }

        // set base field name
        $this->baseFieldName = (string) $baseFieldName . $this->abbreviation;

        // metaId was specified, so we should load the item
        if ($metaId !== null) {
            $this->loadMeta($metaId);
        }

        // set default callback
        $this->setUrlCallback(
            'Backend\\Modules\\' . $this->URL->getModule() . '\\Engine\\Model',
            'getURL',
            array($abbreviation)
        );

        // load the form
        $this->loadForm();
    }

    /**
     * Generate a template for the seo fields and returns the path.
     *
     * @param string $abbreviation The language to make the template for.
     * @return string
     */
    public function createTemplate($abbreviation)
    {
        // new BackendTemplate instance
        $tpl = new BackendTemplate(false);
        $tpl->setForceCompile(true);

        // assign variables
        $tpl->assign(array('language' => $abbreviation));

        // grab the content
        $template = $tpl->getContent(BACKEND_CORE_PATH . '/Layout/Templates/SeoMultiLanguage.tpl');

        // save the parsed template
        $templatePath = BACKEND_CACHE_PATH . '/MetaTemplates/' . $this->URL->getModule() . '/' . $abbreviation . '.tpl';
        \SpoonFile::setContent($templatePath, $template);

        // return the path
        return $templatePath;
    }

    /**
     * Generate an url, using the predefined callback.
     *
     * @param string $URL The base-url to start from.
     * @return string
     * @throws Exception When the function does not exist
     */
    public function generateURL($URL)
    {
        // validate (check if the function exists)
        if (!is_callable(array($this->callback['class'], $this->callback['method']))) {
            throw new Exception('The callback-method doesn\'t exist.');
        }

        // build parameters for use in the callback
        $parameters[] = CommonUri::getUrl($URL);

        // add parameters set by user
        if (!empty($this->callback['parameters'])) {
            foreach ($this->callback['parameters'] as $parameter) {
                $parameters[] = $parameter;
            }
        }

        // get the real url
        return call_user_func_array(array($this->callback['class'], $this->callback['method']), $parameters);
    }

    /**
     * Get the current value for the meta-description;
     *
     * @return mixed
     */
    public function getDescription()
    {
        // not set so return null
        if (!isset($this->data['description'])) {
            return null;
        }

        // return value
        return $this->data['description'];
    }

    /**
     * Should the description overwrite the default
     *
     * @return mixed
     */
    public function getDescriptionOverwrite()
    {
        // not set so return null
        if (!isset($this->data['description_overwrite'])) {
            return null;
        }

        // return value
        return ($this->data['description_overwrite'] == 'Y');
    }

    /**
     * Get the current value for the metaId;
     *
     * @return mixed
     */
    public function getId()
    {
        // not set so return null
        if (!isset($this->data['id'])) {
            return null;
        }

        // return value
        return (int) $this->data['id'];
    }

    /**
     * Get the current value for the meta-keywords;
     *
     * @return mixed
     */
    public function getKeywords()
    {
        // not set so return null
        if (!isset($this->data['keywords'])) {
            return null;
        }

        // return value
        return $this->data['keywords'];
    }

    /**
     * Should the keywords overwrite the default
     *
     * @return mixed
     */
    public function getKeywordsOverwrite()
    {
        // not set so return null
        if (!isset($this->data['keywords_overwrite'])) {
            return null;
        }

        // return value
        return ($this->data['keywords_overwrite'] == 'Y');
    }

    /**
     * Get the current value for the page title;
     *
     * @return mixed
     */
    public function getTitle()
    {
        // not set so return null
        if (!isset($this->data['title'])) {
            return null;
        }

        // return value
        return $this->data['title'];
    }

    /**
     * Should the title overwrite the default
     *
     * @return mixed
     */
    public function getTitleOverwrite()
    {
        // not set so return null
        if (!isset($this->data['title_overwrite'])) {
            return null;
        }

        // return value
        return ($this->data['title_overwrite'] == 'Y');
    }

    /**
     * Return the current value for an URL
     *
     * @return mixed
     */
    public function getURL()
    {
        // not set so return null
        if (!isset($this->data['url'])) {
            return null;
        }

        // return value
        return urldecode($this->data['url']);
    }

    /**
     * Should the URL overwrite the default
     *
     * @return mixed
     */
    public function getURLOverwrite()
    {
        // not set so return null
        if (!isset($this->data['url_overwrite'])) {
            return null;
        }

        // return value
        return ($this->data['url_overwrite'] == 'Y');
    }

    /**
     * Add all element into the form
     */
    protected function loadForm()
    {
        // is the form submitted?
        if ($this->frm->isSubmitted()) {
            /**
             * If the fields are disabled we don't have any values in the post.
             * When an error occurs in the other fields of the form the meta-fields would be cleared
             * therefore we alter the POST so it contains the initial values.
             */
            if (!isset($_POST['page_title' . $this->abbreviation])) {
                $_POST['page_title' . $this->abbreviation] = (isset($this->data['title'])) ? $this->data['title'] : null;
            }
            if (!isset($_POST['meta_description' . $this->abbreviation])) {
                $_POST['meta_description' . $this->abbreviation] = (isset($this->data['description'])) ? $this->data['description'] : null;
            }
            if (!isset($_POST['meta_keywords' . $this->abbreviation])) {
                $_POST['meta_keywords' . $this->abbreviation] = (isset($this->data['keywords'])) ? $this->data['keywords'] : null;
            }
            if (!isset($_POST['url' . $this->abbreviation])) {
                $_POST['url' . $this->abbreviation] = (isset($this->data['url'])) ? $this->data['url'] : null;
            }
            if ($this->custom && !isset($_POST['meta_custom' . $this->abbreviation])) {
                $_POST['meta_custom' . $this->abbreviation] = (isset($this->data['custom'])) ? $this->data['custom'] : null;
            }
            if (!isset($_POST['seo_index' . $this->abbreviation])) {
                $_POST['seo_index' . $this->abbreviation] = (isset($this->data['data']['seo_index'])) ?
                    $this->data['data']['seo_index'] :
                    'none'
                ;
            }
            if (!isset($_POST['seo_follow' . $this->abbreviation])) {
                $_POST['seo_follow' . $this->abbreviation] = (isset($this->data['data']['seo_follow'])) ?
                    $this->data['data']['seo_follow'] :
                    'none'
                ;
            }
        }

        // add page title elements into the form
        $this->frm->addCheckbox(
            'page_title_overwrite' . $this->abbreviation,
            (isset($this->data['title_overwrite']) && $this->data['title_overwrite'] == 'Y')
        );
        $this->frm->addText('page_title' . $this->abbreviation, (isset($this->data['title'])) ? $this->data['title'] : null);

        // add meta description elements into the form
        $this->frm->addCheckbox(
            'meta_description_overwrite' . $this->abbreviation,
            (isset($this->data['description_overwrite']) && $this->data['description_overwrite'] == 'Y')
        );
        $this->frm->addText(
            'meta_description' . $this->abbreviation,
            (isset($this->data['description'])) ? $this->data['description'] : null
        );

        // add meta keywords elements into the form
        $this->frm->addCheckbox(
            'meta_keywords_overwrite' . $this->abbreviation,
            (isset($this->data['keywords_overwrite']) && $this->data['keywords_overwrite'] == 'Y')
        );
        $this->frm->addText('meta_keywords' . $this->abbreviation, (isset($this->data['keywords'])) ? $this->data['keywords'] : null);

        // add URL elements into the form
        $this->frm->addCheckbox(
            'url_overwrite' . $this->abbreviation,
            (isset($this->data['url_overwrite']) && $this->data['url_overwrite'] == 'Y')
        );
        $this->frm->addText('url' . $this->abbreviation, (isset($this->data['url'])) ? urldecode($this->data['url']) : null);

        // advanced SEO
        $indexValues = array(
            array('value' => 'none', 'label' => Language::getLabel('None')),
            array('value' => 'index', 'label' => 'index'),
            array('value' => 'noindex', 'label' => 'noindex')
        );
        $this->frm->addRadiobutton(
            'seo_index' . $this->abbreviation,
            $indexValues,
            (isset($this->data['data']['seo_index'])) ? $this->data['data']['seo_index'] : 'none'
        );
        $followValues = array(
            array('value' => 'none', 'label' => Language::getLabel('None')),
            array('value' => 'follow', 'label' => 'follow'),
            array('value' => 'nofollow', 'label' => 'nofollow')
        );
        $this->frm->addRadiobutton(
            'seo_follow' . $this->abbreviation,
            $followValues,
            (isset($this->data['data']['seo_follow'])) ? $this->data['data']['seo_follow'] : 'none'
        );

        // should we add the meta-custom field
        if ($this->custom) {
            // add meta custom element into the form
            $this->frm->addTextarea('meta_custom' . $this->abbreviation, (isset($this->data['custom'])) ? $this->data['custom'] : null);
        }

        $this->frm->addHidden('meta_id' . $this->abbreviation, $this->data['id']);
        $this->frm->addHidden('base_field_name' . $this->abbreviation, $this->baseFieldName);
        $this->frm->addHidden('custom' . $this->abbreviation, $this->custom);
        $this->frm->addHidden('class_name' . $this->abbreviation, $this->callback['class']);
        $this->frm->addHidden('method_name' . $this->abbreviation, $this->callback['method']);
        $this->frm->addHidden('parameters' . $this->abbreviation, \SpoonFilter::htmlspecialchars(serialize($this->callback['parameters'])));
    }

    /**
     * Load a specific meta-record
     *
     * @param int $id The id of the record to load.
     * @throws Exception If no meta-record exists with the provided id
     */
    protected function loadMeta($id)
    {
        if ($id instanceof MetaEntity) {
            $this->id = $id;

            $this->data = array(
                'id'                    => $id->getId(),
                'keywords'              => $id->getKeywords(),
                'keywords_overwrite'    => $id->getOverwriteKeywords() ? 'Y' : 'N',
                'description'           => $id->getDescription(),
                'description_overwrite' => $id->getOverwriteDescription() ? 'Y' : 'N',
                'title'                 => $id->getTitle(),
                'title_overwrite'       => $id->getOverwriteTitle() ? 'Y' : 'N',
                'url'                   => $id->getUrl(),
                'url_overwrite'         => $id->getOverwriteUrl() ? 'Y' : 'N',
                'custom'                => $id->getCustom(),
                'data'                  => $id->getData(),
            );
        } else {
            $this->id = (int) $id;

            // get item
            $this->data = (array) BackendModel::getContainer()->get('database')->getRecord(
                'SELECT *
                 FROM meta AS m
                 WHERE m.id = ?',
                array($this->id)
            );

            // validate meta-record
            if (empty($this->data)) {
                throw new Exception('Meta-record doesn\'t exist.');
            }
        }

        // unserialize data
        if (isset($this->data['data'])) {
            $this->data['data'] = @unserialize($this->data['data']);
        }
    }

    /**
     * Fetches the updated meta entity
     *
     * @return MetaEntity The meta entity with updated data
     */
    public function getUpdated()
    {
        $data = $this->getUpdatedData();

        $meta = $this->id;
        $meta
            ->setKeywords($data['keywords'])
            ->setOverwriteKeywords($data['keywords_overwrite'] == 'Y')
            ->setDescription($data['description'])
            ->setOverwriteDescription($data['description_overwrite'] == 'Y')
            ->setTitle($data['title'])
            ->setOverwriteTitle($data['title_overwrite'] == 'Y')
            ->setUrl(CommonUri::getUrl((string) $data['url'], SPOON_CHARSET))
            ->setOverwriteUrl($data['url_overwrite'] == 'Y')
        ;

        $meta->setCustom($data['custom']);
        if (isset($data['data'])) {
            $meta->setData($data['data']);
        } else {
            $meta->setData(null);
        }

        return $meta;
    }

    /**
     * Saves the meta object
     *
     * @param bool $update Should we update the record or insert a new one.
     * @throws Exception If no meta id was provided.
     * @return int
     */
    public function save($update = false)
    {
        if ($this->id instanceof MetaEntity) {
            return $this->getUpdated();
        }

        $meta = $this->getUpdatedData();

        $db = BackendModel::getContainer()->get('database');

        if ((bool) $update) {
            if ($this->id === null) {
                throw new Exception('No metaID specified.');
            }
            $db->update('meta', $meta, 'id = ?', array($this->id));

            return $this->id;
        } else {
            $id = (int) $db->insert('meta', $meta);

            return $id;
        }
    }

    /**
     * Set the URL - this overwrites the base field value.
     * Use this before meta is saved.
     *
     * @param string $URL
     */
    public function setURL($URL)
    {
        $this->overwriteURL = (string) $URL;
    }

    protected function getUpdatedData()
    {
        // get meta keywords
        if ($this->frm->getField('meta_keywords_overwrite' . $this->abbreviation)->isChecked()) {
            $data['keywords'] = $this->frm->getField('meta_keywords' . $this->abbreviation)->getValue();
        } else {
            $data['keywords'] = $this->frm->getField($this->baseFieldName)->getValue();
        }

        // get meta description
        if ($this->frm->getField('meta_description_overwrite' . $this->abbreviation)->isChecked()) {
            $data['description'] = $this->frm->getField('meta_description' . $this->abbreviation)->getValue();
        } else {
            $data['description'] = $this->frm->getField($this->baseFieldName)->getValue();
        }

        // get page title
        if ($this->frm->getField('page_title_overwrite' . $this->abbreviation)->isChecked()) {
            $data['title'] = $this->frm->getField('page_title' . $this->abbreviation)->getValue();
        } else {
            $data['title'] = $this->frm->getField($this->baseFieldName)->getValue();
        }

        // get URL
        if ($this->frm->getField('url_overwrite' . $this->abbreviation)->isChecked()) {
            $data['url'] = \SpoonFilter::htmlspecialcharsDecode($this->frm->getField('url' . $this->abbreviation)->getValue());
        } else {
            $data['url'] = \SpoonFilter::htmlspecialcharsDecode((isset($this->overwriteURL) ? $this->overwriteURL : $this->frm->getField($this->baseFieldName)->getValue()));
        }

        // get the real URL
        $data['url'] = $this->generateURL($data['url']);

        // get meta custom
        if ($this->custom && $this->frm->getField('meta_custom' . $this->abbreviation)->isFilled()) {
            $data['custom'] = $this->frm->getField('meta_custom' . $this->abbreviation)->getValue(true);
        } else {
            $data['custom'] = null;
        }

        $data['keywords_overwrite'] = ($this->frm->getField('meta_keywords_overwrite' . $this->abbreviation)->isChecked()) ? 'Y' : 'N';
        $data['description_overwrite'] = ($this->frm->getField('meta_description_overwrite' . $this->abbreviation)->isChecked()) ? 'Y' : 'N';
        $data['title_overwrite'] = ($this->frm->getField('page_title_overwrite' . $this->abbreviation)->isChecked()) ? 'Y' : 'N';
        $data['url_overwrite'] = ($this->frm->getField('url_overwrite' . $this->abbreviation)->isChecked()) ? 'Y' : 'N';

        if ($this->frm->getField('seo_index' . $this->abbreviation)->getValue() != 'none') {
            $data['data']['seo_index'] = $this->frm->getField('seo_index' . $this->abbreviation)->getValue();
        }
        if ($this->frm->getField('seo_follow' . $this->abbreviation)->getValue() != 'none') {
            $data['data']['seo_follow'] = $this->frm->getField('seo_follow' . $this->abbreviation)->getValue();
        }
        if (isset($data['data'])) {
            $data['data'] = serialize($data['data']);
        }

        return $data;
    }

    /**
     * Set the callback to calculate an unique URL
     * REMARK: this method has to be public and static
     * REMARK: if you specify arguments they will be appended
     *
     * @param string $className  Name of the class to use.
     * @param string $methodName Name of the method to use.
     * @param array  $parameters Parameters to parse, they will be passed after ours.
     */
    public function setURLCallback($className, $methodName, $parameters = array())
    {
        $className = (string) $className;
        $methodName = (string) $methodName;
        $parameters = (array) $parameters;

        // store in property
        $this->callback = array('class' => $className, 'method' => $methodName, 'parameters' => $parameters);

        // re-load the form
        $this->loadForm();
    }

    /**
     * Validates the form
     * It checks if there is a value when a checkbox is checked
     */
    public function validate()
    {
        // page title overwrite is checked
        if ($this->frm->getField('page_title_overwrite' . $this->abbreviation)->isChecked()) {
            $this->frm->getField('page_title' . $this->abbreviation)->isFilled(Language::err('FieldIsRequired'));
        }

        // meta description overwrite is checked
        if ($this->frm->getField('meta_description_overwrite' . $this->abbreviation)->isChecked()) {
            $this->frm->getField('meta_description' . $this->abbreviation)->isFilled(Language::err('FieldIsRequired'));
        }

        // meta keywords overwrite is checked
        if ($this->frm->getField('meta_keywords_overwrite' . $this->abbreviation)->isChecked()) {
            $this->frm->getField('meta_keywords' . $this->abbreviation)->isFilled(Language::err('FieldIsRequired'));
        }

        // URL overwrite is checked
        if ($this->frm->getField('url_overwrite' . $this->abbreviation)->isChecked()) {
            $this->frm->getField('url' . $this->abbreviation)->isFilled(Language::err('FieldIsRequired'));
            $URL = \SpoonFilter::htmlspecialcharsDecode($this->frm->getField('url' . $this->abbreviation)->getValue());
            $generatedUrl = $this->generateURL($URL);

            // check if urls are different
            if (CommonUri::getUrl($URL) != $generatedUrl) {
                $this->frm->getField('url' . $this->abbreviation)->addError(
                    Language::err('URLAlreadyExists')
                );
            }
        }

        // if the form was submitted correctly the data array should be populated
        if ($this->frm->isCorrect()) {
            // get meta keywords
            if ($this->frm->getField('meta_keywords_overwrite' . $this->abbreviation)->isChecked()) {
                $keywords = $this->frm->getField('meta_keywords' . $this->abbreviation)->getValue();
            } else {
                $keywords = $this->frm->getField($this->baseFieldName)->getValue();
            }

            // get meta description
            if ($this->frm->getField('meta_description_overwrite' . $this->abbreviation)->isChecked()) {
                $description = $this->frm->getField('meta_description' . $this->abbreviation)->getValue();
            } else {
                $description = $this->frm->getField($this->baseFieldName)->getValue();
            }

            // get page title
            if ($this->frm->getField('page_title_overwrite' . $this->abbreviation)->isChecked()) {
                $title = $this->frm->getField('page_title' . $this->abbreviation)->getValue();
            } else {
                $title = $this->frm->getField($this->baseFieldName)->getValue();
            }

            // get URL
            if ($this->frm->getField('url_overwrite' . $this->abbreviation)->isChecked()) {
                $URL = \SpoonFilter::htmlspecialcharsDecode($this->frm->getField('url' . $this->abbreviation)->getValue());
            } else {
                $URL = \SpoonFilter::htmlspecialcharsDecode($this->frm->getField($this->baseFieldName)->getValue());
            }

            // get the real URL
            $URL = $this->generateURL($URL);

            // get meta custom
            if ($this->custom && $this->frm->getField('meta_custom' . $this->abbreviation)->isFilled()) {
                $custom = $this->frm->getField('meta_custom' . $this->abbreviation)->getValue();
            } else {
                $custom = null;
            }

            // set data
            $this->data['keywords'] = $keywords;
            $this->data['keywords_overwrite'] = ($this->frm->getField('meta_keywords_overwrite' . $this->abbreviation)->isChecked(
            )) ? 'Y' : 'N';
            $this->data['description'] = $description;
            $this->data['description_overwrite'] = ($this->frm->getField('meta_description_overwrite' . $this->abbreviation)->isChecked(
            )) ? 'Y' : 'N';
            $this->data['title'] = $title;
            $this->data['title_overwrite'] = ($this->frm->getField('page_title_overwrite' . $this->abbreviation)->isChecked()) ? 'Y' : 'N';
            $this->data['url'] = $URL;
            $this->data['url_overwrite'] = ($this->frm->getField('url_overwrite' . $this->abbreviation)->isChecked()) ? 'Y' : 'N';
            $this->data['custom'] = $custom;
            if ($this->frm->getField('seo_index' . $this->abbreviation)->getValue() == 'none') {
                unset($this->data['data']['seo_index']);
            } else {
                $this->data['data']['seo_index'] = $this->frm->getField('seo_index' . $this->abbreviation)->getValue();
            }
            if ($this->frm->getField('seo_follow' . $this->abbreviation)->getValue() == 'none') {
                unset($this->data['data']['seo_follow']);
            } else {
                $this->data['data']['seo_follow'] = $this->frm->getField('seo_follow' . $this->abbreviation)->getValue();
            }
        }
    }
}
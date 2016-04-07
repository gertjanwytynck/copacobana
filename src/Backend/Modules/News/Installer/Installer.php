<?php

namespace Backend\Modules\News\Installer;

use Backend\Core\Installer\ModuleInstaller;
use Backend\Modules\News\Engine\Model as BackendNewsModel;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Installer for the news module
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Installer extends ModuleInstaller
{
    /**
     * Install the module
     */
    public function install()
    {
        $this->addModule('News');
        $this->addEntitiesInDatabase(array(
            BackendNewsModel::ARTICLE_ENTITY_CLASS,
            BackendNewsModel::ARTICLE_LOCALE_ENTITY_CLASS,
            BackendNewsModel::ARTICLE_IMAGE_ENTITY_CLASS,
            BackendNewsModel::CATEGORY_ENTITY_CLASS,
            BackendNewsModel::CATEGORY_LOCALE_ENTITY_CLASS,
        ));
        $this->importLocale(dirname(__FILE__) . '/Data/locale.xml');

        $this->makeSearchable('News');

        $this->setSettings();
        $this->setRights();
        $this->setBackendNavigation();
        $this->setExtras();
        $this->createDirectories();
    }

    private function setSettings()
    {
        $this->setSetting('News', 'overview_num_items', 10);
        $this->setSetting('News', 'recent_articles_list_num_items', 5);
        $this->setSetting('News', 'cover_image_enabled', false);
        $this->setSetting('News', 'cover_image_required', false);
        $this->setSetting('News', 'multi_images_enabled', false);
        $this->setSetting('News', 'image_size_limit', 5);
    }

    private function setRights()
    {
        $this->setModuleRights(1, 'News');
        $this->setActionRights(1, 'News', 'Index');
        $this->setActionRights(1, 'News', 'Add');
        $this->setActionRights(1, 'News', 'Edit');
        $this->setActionRights(1, 'News', 'Delete');
        $this->setActionRights(1, 'News', 'Categories');
        $this->setActionRights(1, 'News', 'AddCategory');
        $this->setActionRights(1, 'News', 'EditCategory');
        $this->setActionRights(1, 'News', 'DeleteCategory');
        $this->setActionRights(1, 'News', 'SequenceCategories');
        $this->setActionRights(1, 'News', 'Images');
        $this->setActionRights(1, 'News', 'AddImage');
        $this->setActionRights(1, 'News', 'EditImage');
        $this->setActionRights(1, 'News', 'DeleteImage');
        $this->setActionRights(1, 'News', 'SequenceImages');
        $this->setActionRights(1, 'News', 'Settings');
    }

    private function setBackendNavigation()
    {
        $navigationModulesId = $this->setNavigation(null, 'Modules');
        $navigationNewsId = $this->setNavigation($navigationModulesId, 'News');

        $this->setNavigation($navigationNewsId, 'Articles', 'news/index', array('news/add', 'news/edit', 'news/images'));
        $this->setNavigation($navigationNewsId, 'Categories', 'news/categories', array('news/add_category', 'news/edit_category'));

        $navigationSettingsId = $this->setNavigation(null, 'Settings');
        $navigationModulesId = $this->setNavigation($navigationSettingsId, 'Modules');
        $this->setNavigation($navigationModulesId, 'News', 'news/settings');
    }

    private function setExtras()
    {
        $this->insertExtra('News', 'block', 'News', null, null, 'N', 1000);
        $this->insertExtra('News', 'widget', 'Categories', 'Categories', null, 'N', 1001);
        $this->insertExtra('News', 'widget', 'RecentArticlesList', 'RecentArticlesList', null, 'N', 1002);
    }

    private function createDirectories()
    {
        $fs = new Filesystem();

        $fs->mkdir(PATH_WWW . '/src/Frontend/Files/news', 0755);
        $fs->mkdir(PATH_WWW . '/src/Frontend/Files/news/tmp', 0755);
        $fs->mkdir(PATH_WWW . '/src/Frontend/Files/news/covers', 0755);
        $fs->mkdir(PATH_WWW . '/src/Frontend/Files/news/covers/source', 0755);
        $fs->mkdir(PATH_WWW . '/src/Frontend/Files/news/images', 0755);
        $fs->mkdir(PATH_WWW . '/src/Frontend/Files/news/images/source', 0755);
        $fs->mkdir(PATH_WWW . '/src/Frontend/Files/news/images/dataGrid', 0755);

        $fs->copy(
            dirname(__FILE__) . '/Data/frontend_files/.gitignore',
            PATH_WWW . '/src/Frontend/Files/news/tmp/.gitignore'
        );
        $fs->copy(
            dirname(__FILE__) . '/Data/frontend_files/.gitignore',
            PATH_WWW . '/src/Frontend/Files/news/covers/source/.gitignore'
        );
        $fs->copy(
            dirname(__FILE__) . '/Data/frontend_files/.gitignore',
            PATH_WWW . '/src/Frontend/Files/news/images/source/.gitignore'
        );
        $fs->copy(
            dirname(__FILE__) . '/Data/frontend_files/.gitignore',
            PATH_WWW . '/src/Frontend/Files/news/images/dataGrid/.gitignore'
        );
    }
}
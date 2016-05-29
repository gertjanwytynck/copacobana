<?php

namespace Backend\Modules\Festival\Installer;

use Backend\Core\Installer\ModuleInstaller;
use Backend\Modules\Festival\Engine\Model as BackendFestivalModel;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Installer for the Festival module.
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class Installer extends ModuleInstaller
{
    /**
     * Install the module.
     */
    public function install()
    {
       /* $this->addEntitiesInDatabase(array(
            BackendFestivalModel::ARTIST_ENTITY_CLASS,
            BackendFestivalModel::ARTIST_CATEGORIES_ENTITY_CLASS,
            BackendFestivalModel::ARTIST_PRACTICAL_ENTITY_CLASS,
            BackendFestivalModel::ARTIST_PRACTICAL_BACKSTAGE_ENTITY_CLASS,
            BackendFestivalModel::ARTIST_PRACTICAL_ONSTAGE_ENTITY_CLASS,
            BackendFestivalModel::ARTIST_STAGE_ENTITY_CLASS,
            BackendFestivalModel::ARTIST_WEBSITE_ENTITY_CLASS,
            BackendFestivalModel::ARTIST_WEBSITE_LOCALE_ENTITY_CLASS,
        ));*/

        $this->addModule('Festival');
        $this->importLocale(dirname(__FILE__) . '/Data/locale.xml');

        $this->setSettings();
        $this->setRights();
        $this->setBackendNavigation();
        $this->createDirectories();
        $this->insertExtras();
    }

    private function setSettings()
    {
        $this->setSetting('Festival', 'year', 2016);
        $this->setSetting('Festival', 'overview_num_items', 10);
        $this->setSetting('Festival', 'cover_image_enabled', false);
        $this->setSetting('Festival', 'cover_image_required', false);
        $this->setSetting('Festival', 'multi_images_enabled', false);
        $this->setSetting('Festival', 'image_size_limit', 2);
    }

    private function setRights()
    {
        $this->setModuleRights(1, 'Festival');
        $this->setActionRights(1, 'Festival', 'AddArtist');
        $this->setActionRights(1, 'Festival', 'AddCategory');
        $this->setActionRights(1, 'Festival', 'AddStage');
        $this->setActionRights(1, 'Festival', 'DeleteStage');
        $this->setActionRights(1, 'Festival', 'DeleteArtist');
        $this->setActionRights(1, 'Festival', 'DeleteCategory');
        $this->setActionRights(1, 'Festival', 'EditStage');
        $this->setActionRights(1, 'Festival', 'EditArtist');
        $this->setActionRights(1, 'Festival', 'EditCategory');
        $this->setActionRights(1, 'Festival', 'Categories');
        $this->setActionRights(1, 'Festival', 'Index');
        $this->setActionRights(1, 'Festival', 'Settings');
        $this->setActionRights(1, 'Festival', 'Stages');
    }

    private function setBackendNavigation()
    {
        $navigationFestivalId = $this->setNavigation(null, 'Festival', '', null, 3);

        $this->setNavigation(
            $navigationFestivalId, 'Artists', 'festival/artists',
            array('festival/add_artist', 'festival/edit_artist', 'festival/print_artists')
        );

        $this->setNavigation(
            $navigationFestivalId,
            'Categories',
            'festival/categories',
            array('festival/add_category', 'festival/edit_category')
        );

        $this->setNavigation(
            $navigationFestivalId,
            'Stages',
            'festival/stages',
            array('festival/add_stage', 'festival/edit_stage')
        );

        $navigationSettingsId = $this->setNavigation(null, 'Settings');
        $navigationModulesId = $this->setNavigation($navigationSettingsId, 'Modules');
        $this->setNavigation($navigationModulesId, 'Festival', 'festival/settings');
    }

    private function insertExtras()
    {
        $this->insertExtra('Festival', 'block', 'Festival',  null, null, 'N', 1000);
        $this->insertExtra('Festival', 'block', 'SingUp', 'SignUp', null, 'N', 1001);
        $this->insertExtra('Festival', 'block', 'LineUp', 'LineUp', null, 'N', 1002);
        $this->insertExtra('Festival', 'widget', 'Artists', 'Artists', null, 'N', 1003);
        $this->insertExtra('Festival', 'widget', 'RandomArtists', 'RandomArtists', null, 'N', 1004);
    }

    private function createDirectories()
    {
        $fs = new Filesystem();

        $fs->mkdir(PATH_WWW . '/src/Frontend/Files/festival', 0755);

        $fs->copy(
            dirname(__FILE__) . '/Data/frontend_files/.gitignore',
            PATH_WWW . '/src/Frontend/Files/festival/artists/.gitignore'
        );

        $fs->copy(
            dirname(__FILE__) . '/Data/frontend_files/.gitignore',
            PATH_WWW . '/src/Frontend/Files/festival/artists/covers/.gitignore'
        );
        $fs->copy(
            dirname(__FILE__) . '/Data/frontend_files/.gitignore',
            PATH_WWW . '/src/Frontend/Files/festival/artists/covers/source/.gitignore'
        );
        $fs->copy(
            dirname(__FILE__) . '/Data/frontend_files/.gitignore',
            PATH_WWW . '/src/Frontend/Files/festival/artists/covers/150x150/.gitignore'
        );
        $fs->copy(
            dirname(__FILE__) . '/Data/frontend_files/.gitignore',
            PATH_WWW . '/src/Frontend/Files/festival/artists/covers/960x/.gitignore'
        );
    }
}

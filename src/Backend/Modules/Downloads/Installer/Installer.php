<?php

namespace Backend\Modules\Downloads\Installer;

use Symfony\Component\Filesystem\Filesystem;

use Backend\Core\Installer\ModuleInstaller;
use Backend\Modules\Downloads\Engine\Model as BackendDownloadsModel;

/**
 * Installer for the downloads module
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
        $this->addModule('Downloads');
        $this->addEntitiesInDatabase(array(
            BackendDownloadsModel::DOWNLOAD_ENTITY_CLASS,
            BackendDownloadsModel::DOWNLOAD_LOCALE_ENTITY_CLASS
        ));
        $this->importLocale(dirname(__FILE__) . '/Data/locale.xml');

        $this->setRights();
        $this->setBackendNavigation();
        $this->createDirectories();
    }

    private function setRights()
    {
        $this->setModuleRights(1, $this->getModule());
        $this->setActionRights(1, $this->getModule(), 'Add');
        $this->setActionRights(1, $this->getModule(), 'Delete');
        $this->setActionRights(1, $this->getModule(), 'Edit');
        $this->setActionRights(1, $this->getModule(), 'Index');
        $this->setActionRights(1, $this->getModule(), 'Sequence');
    }

    private function setBackendNavigation()
    {
        $navigationModulesId = $this->setNavigation(null, 'Modules');

        $this->setNavigation(
            $navigationModulesId,
            $this->getModule(),
            'downloads/index',
            array('downloads/add', 'downloads/edit')
        );
    }

    private function createDirectories()
    {
        $fs = new Filesystem();

        $fs->mkdir(PATH_WWW . '/src/Frontend/Files/downloads', 0755);

        $fs->copy(
            dirname(__FILE__) . '/Data/frontend_files/.gitignore',
            PATH_WWW . '/src/Frontend/Files/downloads/.gitignore'
        );
    }
}

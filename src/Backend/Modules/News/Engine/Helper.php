<?php

namespace Backend\Modules\News\Engine;

use Backend\Core\Engine\DataGridDoctrine;
use Backend\Core\Engine\Language;
use Backend\Modules\News\Engine\Model as BackendNewsModel;

/**
 * Helper functions for the news module
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
class Helper
{
    /**
     * Load the images data grid
     * (static function because it's also used in the ajax responses)
     *
     * @param integer $articleId
     * @return DataGridDoctrine
     */
    public static function loadDgImages($articleId)
    {
        // get images path
        $imagesPath = FRONTEND_FILES_URL . '/news/images';

        // create dataGrid
        $dataGrid = new DataGridDoctrine(
            BackendNewsModel::ARTICLE_IMAGE_ENTITY_CLASS,
            array('article' => $articleId),
            array('id', 'filename' => 'image', 'title', 'isHidden' => 'hidden', 'sequence'),
            'sequence', 'ASC'
        );

        // set dataGrid id
        $dataGrid->setAttributes(array('id' => 'images', 'data-action' => 'SequenceImages'));

        // hide columns
        $dataGrid->setColumnsHidden(array('id'));

        // disable paging
        $dataGrid->setPaging(false);

        // enable sequencing
        $dataGrid->enableSequenceByDragAndDrop();

        // add columns
        $dataGrid->addColumn('visibility', ucfirst(Language::lbl('Visible')));
        $dataGrid->addColumn('edit', ucfirst(Language::lbl('Edit')), ucfirst(Language::lbl('Edit')), null, Language::lbl('Edit'));
        $dataGrid->addColumn('delete', ucfirst(Language::lbl('Delete')), ucfirst(Language::lbl('Delete')), null, Language::lbl('Delete'));

        // set column functions
        $dataGrid->setColumnFunction(array(__CLASS__, 'getVisibility'), array('[hidden]'), 'visibility', true);
        $dataGrid->setColumnFunction(array(__CLASS__, 'getImage'), array('[image]', $imagesPath, '[title]'), 'image', true);
        $dataGrid->setColumnFunction(array(__CLASS__, 'getImageEditLink'), array('[id]', '[title]', '[hidden]'), 'edit', true);
        $dataGrid->setColumnFunction(array(__CLASS__, 'getImageDeleteLink'), array('[id]'), 'delete', true);

        return $dataGrid;
    }

    /**
     * Get the visibility of an image for a dataGrid
     *
     * @param boolean  $isHidden
     * @return string
     */
    public static function getVisibility($isHidden)
    {
        return (!$isHidden)
            ? '<img src="/src/Backend/Modules/News/Layout/images/Y.png" alt="visible" />'
            : '<img src="/src/Backend/Modules/News/Layout/images/N.png" alt="hidden" />'
        ;
    }

    /**
     * Get the image for a dataGrid
     *
     * @param string  $filename   The filename of the image.
     * @param string  $imagesPath The path to all image size folders.
     * @param string  $title      The image title.
     * @return string
     */
    public static function getImage($filename, $imagesPath, $title = null)
    {
        if ($title !== null) {
            return '<a href="' . $imagesPath . '/source/' . $filename . '" class="fancybox" rel="group" title="' . $title . '">
                <img src="' . $imagesPath . '/dataGrid/' . $filename . '" alt="' . $filename . '" />
            </a>';
        } else {
            return '<a href="' . $imagesPath . '/source/' . $filename . '" class="fancybox" rel="group">
                <img src="' . $imagesPath . '/dataGrid/' . $filename . '" alt="' . $filename . '" />
            </a>';
        }

    }

    /**
     * Get the edit link for an image
     *
     * @param int     $id
     * @param string  $title
     * @param string  $hidden
     * @return string
     */
    public static function getImageEditLink($id, $title, $hidden)
    {
        return '<a href="#editImage" data-image-id="' . $id . '" data-title="' . $title . '" data-hidden="' . $hidden . '" data-message-id="editFormImage" class="showDialogForm editImage button icon iconEdit linkButton" title="' . ucfirst(Language::lbl('Edit')) . '">
					<span>' . ucfirst(Language::lbl('Edit')) . '</span>
				</a>'
            ;
    }

    /**
     * Get the delete link for an image
     *
     * @param int  $id The id of the item to build the delete link for.
     * @return string
     */
    public static function getImageDeleteLink($id)
    {
        return '<a href="#deleteImage" data-image-id="' . $id . '" class="deleteImage button icon iconDelete linkButton" title="' . ucfirst(Language::lbl('Delete')) . '">
					<span>' . ucfirst(Language::lbl('Delete')) . '</span>
				</a>'
        ;
    }
}
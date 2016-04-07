{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
	<h2>{$lblDownloads|ucfirst}: {$msgEditDownload|sprintf:{$item.backendTitle}}</h2>
</div>

{form:edit}
    <p>
        <label for="backendTitle">{$lblBackendTitle|ucfirst}<abbr title="{$lblRequiredField}">*</abbr></label>
        {$txtBackendTitle} {$txtBackendTitleError}
    </p>

    <div class="tabs ui-tabs">
        <ul>
            {iteration:languages}
                <li>
                    <a href="#tab-{$languages.language|lowercase}">{$languages.language|uppercase}</a>
                </li>
            {/iteration:languages}
        </ul>

        {iteration:languages}
            <div id="tab-{$languages.language|lowercase}" class="ui-tabs-hide optional-language-tab">
                <div class="subtleBox">
                    <div class="heading">
                        <h3>
                            <label for="activate{$languages.language|ucfirst}" data-language="{$languages.language|lowercase}" class="toggle-optional-language inline">
                                {$languages.chkActivate} {$lblActivate|ucfirst}: {$languages.language|uppercase}
                            </label>
                            {$languages.chkActivateError}
                        </h3>
                    </div>
                </div>

                <div class="optional-language">
                    <div>
                        <p>
                            <label for="title{$languages.language|ucfirst}">{$lblTitle|ucfirst}
                                <abbr title="{$lblRequiredField}">*</abbr>
                            </label>
                            {$languages.txtTitle} {$languages.txtTitleError}
                        </p>
                    </div>
                    <div class="clearfix">
                        <div style="width: 230px; padding: 0 10px 0 0; float: left; overflow:hidden">
                            <p>
                                <label for="title{$languages.language|ucfirst}">{$lblFile|ucfirst}
                                    <abbr title="{$lblRequiredField}">*</abbr>
                                </label>
                                {$languages.fileFile} {$languages.fileFileError}
                            </p>
                        </div>
                        {option:languages.filename}
                            <div style="padding: 0 0 0 10px; border-left: 1px solid #eee; width: 230px; float: left">
                                <p>
                                    <label style="margin-bottom: 8px;">{$lblDownload|ucfirst}</label>
                                    <a href="{$FRONTEND_FILES_URL}/downloads/{$languages.filename}">
                                        <img src="/src/Backend/Modules/Downloads/Layout/images/download_file.png" alt="{$lblDownload|ucfirst}" />
                                    </a>
                                </p>
                            </div>
                        {/option:languages.filename}
                    </div>
                </div>
            </div>
        {/iteration:languages}
    </div>

	<div class="fullwidthOptions">
		{option:showDownloadsDelete}
		<a href="{$var|geturl:'delete'}&amp;id={$item.id}" data-message-id="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
			<span>{$lblDelete|ucfirst}</span>
		</a>
		{/option:showDownloadsDelete}

		<div class="buttonHolderRight">
			<input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="{$lblSave|ucfirst}" />
		</div>
	</div>

	<div id="confirmDelete" title="{$lblDelete|ucfirst}?" style="display: none;">
		<p>
			{$msgConfirmDelete|sprintf:{$item.backendTitle}}
		</p>
	</div>
{/form:edit}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}

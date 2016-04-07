{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
    <h2>{$lblDownloads|ucfirst}: {$lblAdd}</h2>
</div>

{form:add}
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
                    <div>
                        <p>
                            <label for="title{$languages.language|ucfirst}">{$lblFile|ucfirst}
                                <abbr title="{$lblRequiredField}">*</abbr>
                            </label>
                            {$languages.fileFile} {$languages.fileFileError}
                        </p>
                    </div>
                </div>
            </div>
        {/iteration:languages}
    </div>

    <div class="fullwidthOptions">
        <div class="buttonHolderRight">
            <input id="addButton" class="inputButton button mainButton" type="submit" name="add" value="{$lblAdd|ucfirst}" />
        </div>
    </div>
{/form:add}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}

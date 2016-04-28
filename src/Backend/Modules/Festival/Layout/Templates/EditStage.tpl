{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
    <h2>{$lblFestival|ucfirst}: {$lblEditStage}</h2>
</div>

{form:editStage}
    <div class="tabs ui-tabs">
        <div id="tabContent">
            <div>
                <p>
                    <label for="stageName">{$lblStage|ucfirst}</label>
                    {$txtStageName} {$txtStageNameError}
                </p>
            </div>
        </div>
    </div>

    <div class="fullwidthOptions">
        <!-- <a href="{$var|geturl:'delete_stage'}&amp;id={$item.id}" data-message-id="confirmDelete" class="askConfirmation linkButton button icon iconDelete">
            <span>{$lblDelete|ucfirst}</span>
        </a>
        <div id="confirmDelete" title="{$lblDelete|ucfirst}?" style="display: none;">
            <p>
                {$msgConfirmDelete|sprintf:{$item.stage_name}}
            </p>
        </div> -->
        <div class="buttonHolderRight">
            <input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="{$lblEdit|ucfirst}" />
        </div>
    </div>
{/form:editStage}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}

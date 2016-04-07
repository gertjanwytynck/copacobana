{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
    <h2>{$lblFestival|ucfirst}: {$lblAddStage}</h2>
</div>

{form:addStage}
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
        <div class="buttonHolderRight">
            <input id="addButton" class="inputButton button mainButton" type="submit" name="add" value="{$lblAdd|ucfirst}" />
        </div>
    </div>
{/form:addStage}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}

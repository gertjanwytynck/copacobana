{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
    <h2>{$lblFestival|ucfirst}: {$lblStages}</h2>

    {option:showFestivalAddStage}
        <div class="buttonHolderRight">
            <a href="{$var|geturl:'add_stage'}" class="button icon iconAdd" title="{$lblAddStage|ucfirst}">
                <span>{$lblAddStage|ucfirst}</span>
            </a>
        </div>
    {/option:showFestivalAddStage}
</div>

{option:dataGrid}
    <div class="dataGridHolder">
        {$dataGrid}
    </div>
{/option:dataGrid}

{option:!dataGrid}<p>{$msgNoItems|sprintf:{$var|geturl:'add_stage'}}</p>{/option:!dataGrid}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}
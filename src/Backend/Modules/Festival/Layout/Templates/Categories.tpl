{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
    <h2>{$lblFestival|ucfirst}: {$lblCategories}</h2>

    {option:showFestivalAddCategory}
        <div class="buttonHolderRight">
            <a href="{$var|geturl:'add_category'}" class="button icon iconAdd" title="{$lblAddCategory|ucfirst}">
                <span>{$lblAddCategory|ucfirst}</span>
            </a>
        </div>
    {/option:showFestivalAddCategory}
</div>

{option:dataGrid}
    <div class="dataGridHolder">
        {$dataGrid}
    </div>
{/option:dataGrid}

{option:!dataGrid}<p>{$msgNoItems|sprintf:{$var|geturl:'add_category'}}</p>{/option:!dataGrid}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}
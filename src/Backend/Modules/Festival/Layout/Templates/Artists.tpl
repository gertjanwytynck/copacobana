{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
	<h2>{$lblArtists|ucfirst}</h2>

    {option:showFestivalAddArtist}
        <div class="buttonHolderRight">
            <!-- <a href="{$var|geturl:'mail_volunteers'}" class="button icon iconPrint" title="Mail volunteers">
                <span>Mail volunteers</span>
            </a> -->
            <a href="{$var|geturl:'print_artists'}" class="button icon iconExport" title="Export artists">
                <span>{$lblExport|ucfirst}</span>
            </a>
            <a href="{$var|geturl:'add_artist'}" class="button icon iconAdd" title="{$lblAdd|ucfirst}">
                <span>{$lblAdd|ucfirst}</span>
            </a>
        </div>
    {/option:showFestivalAddArtist}
</div>

{option:dataGrid}
    <div class="dataGridHolder">
        {$dataGrid}
    </div>
{/option:dataGrid}

{option:!dataGrid}
    <p>{$msgNoFestival}</p>
{/option:!dataGrid}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}

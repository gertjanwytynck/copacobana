{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
	<h2>{$lblNews|ucfirst}</h2>

	{option:showNewsAdd}
		{option:numCategories}
			<div class="buttonHolderRight">
				<a href="{$var|geturl:'add'}" class="button icon iconAdd" title="{$lblAdd|ucfirst}">
					<span>{$lblAdd|ucfirst}</span>
				</a>
			</div>
		{/option:numCategories}
	{/option:showNewsAdd}
</div>

{option:dataGrid}
	<div class="dataGridHolder">
		{$dataGrid}
	</div>
{/option:dataGrid}

{option:!dataGrid}
	{option:numCategories}
		<p>{$msgNoItems|sprintf:{$var|geturl:'add'}}</p>
	{/option:numCategories}
	{option:!numCategories}
		<p>{$msgNoCategoriesYet|sprintf:{$var|geturl:'add_category'}}</p>
	{/option:!numCategories}
{/option:!dataGrid}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}

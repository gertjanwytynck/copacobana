{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
	<h2>{$lblNews|ucfirst}: {$msgEditCategory|sprintf:{$item.backend_title}}</h2>
</div>

{form:editCategory}
	<div class="tabs ui-tabs">
		<ul>
			<li><a href="#tabContent">{$lblContent|ucfirst}</a></li>
			{iteration:languages}
				<li class="pull-right">
					<a href="#tab-seo-{$languages.language|lowercase}">{$lblSEO|ucfirst} {$languages.language|uppercase}</a>
				</li>
			{/iteration:languages}
		</ul>

		<div id="tabContent" class="ui-tabs-hide">
			<div>
				<p>
					<label for="backendTitle">{$lblBackendTitle|ucfirst}</label>
					{$txtBackendTitle} {$txtBackendTitleError}
				</p>

				{iteration:languages}
					<p>
						<label for="title{$languages.language|ucfirst}">{$lblTitle|ucfirst} {$languages.language|uppercase}</label>
						{$languages.txtTitle} {$languages.txtTitleError}
					</p>
				{/iteration:languages}
			</div>
		</div>

		{iteration:meta}
			<div id="tab-seo-{$meta.language|lowercase}" class="ui-tabs-hide">
				{include:{$meta.template}}
			</div>
		{/iteration:meta}
	</div>

	<div class="fullwidthOptions">
		{option:showNewsDelete}
			<a href="{$var|geturl:'delete_category'}&amp;id={$item.id}" data-message-id="confirmDelete" class="askConfirmation button icon iconDelete">
				<span>{$lblDelete|ucfirst}</span>
			</a>
			<div id="confirmDelete" title="{$lblDelete|ucfirst}?" style="display: none;">
				<p>
					{$msgConfirmDeleteCategory|sprintf:{$item.backend_title}}
				</p>
			</div>
		{/option:showNewsDelete}

		<div class="buttonHolderRight">
			<input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="{$lblEdit|ucfirst}" />
		</div>
	</div>
{/form:editCategory}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}

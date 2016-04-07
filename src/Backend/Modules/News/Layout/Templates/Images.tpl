{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
	<h2>{$lblArticle|ucfirst}: {$article.backend_title}</h2>

	<div class="buttonHolderRight">
		<a href="{$var|geturl:'index'}" class="button icon iconBack" title="{$lblBack|ucfirst}">
			<span>{$lblBack|ucfirst}</span>
		</a>
	</div>
</div>

<div class="box">
	<div class="heading">
		<h3>{$lblUploadImages|ucfirst}</h3>
	</div>
	<div class="options clearfix">
		<p>
			<label for="fileImageUpload">{$lblImageUpload|ucfirst|sprintf:{$settings.image_size_limit}}</label>
			<span class="helpTxt">{$msgHelpImageUpload}</span>
		</p>
		<p>
			{$fileImageUpload} {$fileImageUploadError}
			<a href="#" id="uploadImages" class="button">{$lblUploadImages|ucfirst}</a>
			{$hidArticleId}
			{$hidImageSizeLimit}
		</p>
		{option:imagesError}<span class="formError">{$errImagesAreRequired}</span>{/option:imagesError}
	</div>
</div>

<div id="imagesDatagridContainer">
	{option:dataGrid}
		<div class="dataGridHolder">
			{$dataGrid}
		</div>
	{/option:dataGrid}
	{option:!dataGrid}{$msgNoImages}{/option:!dataGrid}
</div>

<div id="editFormImage" title="{$lblEditImage|ucfirst}" style="display: none;">
	{form:editImage}
		<div class="options">
			<p>
				<label for="imageTitle">{$lblTitle|ucfirst}</label> {$txtImageTitle}
			</p>
			<p>
				<label for="imageVisible">{$chkImageVisible} {$lblVisible|ucfirst}</label>
			</p>
		</div>
	{/form:editImage}
</div>

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}
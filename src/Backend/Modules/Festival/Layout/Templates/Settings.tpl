{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
	<h2>{$lblModuleSettings|ucfirst}: {$lblFestival}</h2>
</div>

{form:settings}
    <div class="box">
        <div class="heading">
            <h3>{$lblFestival|ucfirst}</h3>
        </div>
        <div class="options">
            <p>
                <label>{$lblFestivalYear|ucfirst}</label>
                {$txtFestivalYear} {$txtFestivalYearError}
            </p>
        </div>
    </div>

	<div class="box">
		<div class="heading">
			<h3>{$lblPagination|ucfirst}</h3>
		</div>
		<div class="options">
			<p>
				<label for="overviewNumItems">{$lblItemsPerPage|ucfirst}</label>
				{$ddmOverviewNumItems} {$ddmOverviewNumItemsError}
			</p>
			<p>
				<label for="recentFestivalListNumItems">{$msgNumItemsInRecentFestivalList}</label>
				{$ddmRecentFestivalListNumItems} {$ddmRecentFestivalListNumItemsError}
			</p>
		</div>
	</div>

	<div class="box">
		<div class="heading">
			<h3>{$lblFeatures|ucfirst}</h3>
		</div>
		<div class="options">
			<p>
				<label for="coverImageEnabled">{$chkCoverImageEnabled} {$lblCoverImage|ucfirst}</label> {$chkCoverImageEnabledError}
			</p>
			<p>
				<label for="multiImagesEnabled">{$chkMultiImagesEnabled} {$lblMultiImages|ucfirst}</label> {$chkMultiImagesEnabledError}
			</p>
		</div>
	</div>

	<div id="coverImageSettings" class="box hidden">
		<div class="heading">
			<h3>{$lblCoverImage|ucfirst} {$lblSettings}</h3>
		</div>
		<div class="options">
			<p>
				<label for="coverImageRequired">{$chkCoverImageRequired} {$lblRequired|ucfirst}</label> {$chkCoverImageRequiredError}
			</p>
		</div>
	</div>

	<div class="box">
		<div class="heading">
			<h3>{$lblGodUserSettings|ucfirst}</h3>
		</div>
		<div class="options">
			<p>
				<label for="imageSizeLimit"> {$lblImageSizeLimit|ucfirst}</label>
				{$txtImageSizeLimit} MB {$txtImageSizeLimitError}
			</p>
		</div>
	</div>

	<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="save" class="inputButton button mainButton" type="submit" name="save" value="{$lblSave|ucfirst}" />
		</div>
	</div>
{/form:settings}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}

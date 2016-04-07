<div id="seoMeta" class="subtleBox">
	<div class="heading">
		<h3>Meta-informatie</h3>
	</div>
	<div class="options">
		<p>
			<label for="pageTitleOverwrite">Paginatitel</label>
			<span class="helpTxt">De titel die in het browservenster staat (<code>&lt;title&gt;</code>).</span>
		</p>
		<ul class="inputList checkboxTextFieldCombo">
			<li>
				{$chkPageTitleOverwrite}
				<label for="pageTitle" class="visuallyHidden">Paginatitel</label>
				{$txtPageTitle} {$txtPageTitleError}
			</li>
		</ul>
		<p>
			<label for="metaDescriptionOverwrite">Beschrijving</label>
			<span class="helpTxt">Vat de inhoud kort samen. Deze samenvatting wordt getoond in de resultaten van zoekmachines.</span>
		</p>
		<ul class="inputList checkboxTextFieldCombo">
			<li>
				{$chkMetaDescriptionOverwrite}
				<label for="metaDescription" class="visuallyHidden">Beschrijving</label>
				{$txtMetaDescription} {$txtMetaDescriptionError}
			</li>
		</ul>
		<p>
			<label for="metaKeywordsOverwrite">Sleutelwoorden</label>
			<span class="helpTxt">Kies een aantal goed gekozen termen die de inhoud omschrijven. Vanuit SEO-standpunt bieden deze echter niet langer een meerwaarde.</span>
		</p>
		<ul class="inputList checkboxTextFieldCombo">
			<li>
				{$chkMetaKeywordsOverwrite}
				<label for="metaKeywords" class="visuallyHidden">Sleutelwoorden</label>
				{$txtMetaKeywords} {$txtMetaKeywordsError}
			</li>
		</ul>
			</div>
</div>

<div class="subtleBox">
	<div class="heading">
		<h3>URL</h3>
	</div>
	<div class="options">
		<p>
			<label for="urlOverwrite">Aangepaste URL</label>
			<span class="helpTxt">Vervang de automatisch gegenereerde URL door een zelfgekozen URL.</span>
		</p>
		<ul class="inputList checkboxTextFieldCombo">
			<li>
				{$chkUrlOverwrite}
				<label for="url" class="visuallyHidden">Aangepaste URL</label>
				{option:detailURL}<span id="urlFirstPart">{$detailURL}/</span>{/option:detailURL}{$txtUrl} {$txtUrlError}
			</li>
		</ul>
	</div>
</div>

<div class="subtleBox">
	<div class="heading">
		<h3>SEO</h3>
	</div>
	<div class="options">
		<p class="label">index</p>
		{$rbtSeoIndexError}
		<ul class="inputList inputListHorizontal">
			{iteration:seo_index_}
				<li><label for="{$seo_index_.id}">{$seo_index_.rbtSeoIndex} {$seo_index_.label}</label></li>
			{/iteration:seo_index_}
		</ul>
		<p class="label">follow</p>
		{$rbtSeoFollowError}
		<ul class="inputList inputListHorizontal">
			{iteration:seo_follow_}
				<li><label for="{$seo_follow_.id}">{$seo_follow_.rbtSeoFollow} {$seo_follow_.label}</label></li>
			{/iteration:seo_follow_}
		</ul>
	</div>
</div>


{$hidMetaId}
{$hidBaseFieldName}
{$hidCustom}
{$hidClassName}
{$hidMethodName}
{$hidParameters}

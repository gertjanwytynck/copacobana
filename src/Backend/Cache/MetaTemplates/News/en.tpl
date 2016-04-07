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
				{$chkPageTitleOverwriteEn}
				<label for="pageTitle" class="visuallyHidden">Paginatitel</label>
				{$txtPageTitleEn} {$txtPageTitleEnError}
			</li>
		</ul>
		<p>
			<label for="metaDescriptionOverwrite">Beschrijving</label>
			<span class="helpTxt">Vat de inhoud kort samen. Deze samenvatting wordt getoond in de resultaten van zoekmachines.</span>
		</p>
		<ul class="inputList checkboxTextFieldCombo">
			<li>
				{$chkMetaDescriptionOverwriteEn}
				<label for="metaDescription" class="visuallyHidden">Beschrijving</label>
				{$txtMetaDescriptionEn} {$txtMetaDescriptionEnError}
			</li>
		</ul>
		<p>
			<label for="metaKeywordsOverwrite">Sleutelwoorden</label>
			<span class="helpTxt">Kies een aantal goed gekozen termen die de inhoud omschrijven. Vanuit SEO-standpunt bieden deze echter niet langer een meerwaarde.</span>
		</p>
		<ul class="inputList checkboxTextFieldCombo">
			<li>
				{$chkMetaKeywordsOverwriteEn}
				<label for="metaKeywords" class="visuallyHidden">Sleutelwoorden</label>
				{$txtMetaKeywordsEn} {$txtMetaKeywordsEnError}
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
				{$chkUrlOverwriteEn}
				<label for="url" class="visuallyHidden">Aangepaste URL</label>
				{option:detailURLEn}<span id="urlFirstPart">{$detailURLEn}/</span>{/option:detailURLEn}{$txtUrlEn} {$txtUrlEnError}
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
		{$rbtSeoIndexEnError}
		<ul class="inputList inputListHorizontal">
			{iteration:seo_index_en}
				<li><label for="{$seo_index_en.id}">{$seo_index_en.rbtSeoIndexEn} {$seo_index_en.label}</label></li>
			{/iteration:seo_index_en}
		</ul>
		<p class="label">follow</p>
		{$rbtSeoFollowEnError}
		<ul class="inputList inputListHorizontal">
			{iteration:seo_follow_en}
				<li><label for="{$seo_follow_en.id}">{$seo_follow_en.rbtSeoFollowEn} {$seo_follow_en.label}</label></li>
			{/iteration:seo_follow_en}
		</ul>
	</div>
</div>


{$hidMetaIdEn}
{$hidBaseFieldNameEn}
{$hidCustomEn}
{$hidClassNameEn}
{$hidMethodNameEn}
{$hidParametersEn}

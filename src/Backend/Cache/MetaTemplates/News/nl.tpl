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
				{$chkPageTitleOverwriteNl}
				<label for="pageTitle" class="visuallyHidden">Paginatitel</label>
				{$txtPageTitleNl} {$txtPageTitleNlError}
			</li>
		</ul>
		<p>
			<label for="metaDescriptionOverwrite">Beschrijving</label>
			<span class="helpTxt">Vat de inhoud kort samen. Deze samenvatting wordt getoond in de resultaten van zoekmachines.</span>
		</p>
		<ul class="inputList checkboxTextFieldCombo">
			<li>
				{$chkMetaDescriptionOverwriteNl}
				<label for="metaDescription" class="visuallyHidden">Beschrijving</label>
				{$txtMetaDescriptionNl} {$txtMetaDescriptionNlError}
			</li>
		</ul>
		<p>
			<label for="metaKeywordsOverwrite">Sleutelwoorden</label>
			<span class="helpTxt">Kies een aantal goed gekozen termen die de inhoud omschrijven. Vanuit SEO-standpunt bieden deze echter niet langer een meerwaarde.</span>
		</p>
		<ul class="inputList checkboxTextFieldCombo">
			<li>
				{$chkMetaKeywordsOverwriteNl}
				<label for="metaKeywords" class="visuallyHidden">Sleutelwoorden</label>
				{$txtMetaKeywordsNl} {$txtMetaKeywordsNlError}
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
				{$chkUrlOverwriteNl}
				<label for="url" class="visuallyHidden">Aangepaste URL</label>
				{option:detailURLNl}<span id="urlFirstPart">{$detailURLNl}/</span>{/option:detailURLNl}{$txtUrlNl} {$txtUrlNlError}
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
		{$rbtSeoIndexNlError}
		<ul class="inputList inputListHorizontal">
			{iteration:seo_index_nl}
				<li><label for="{$seo_index_nl.id}">{$seo_index_nl.rbtSeoIndexNl} {$seo_index_nl.label}</label></li>
			{/iteration:seo_index_nl}
		</ul>
		<p class="label">follow</p>
		{$rbtSeoFollowNlError}
		<ul class="inputList inputListHorizontal">
			{iteration:seo_follow_nl}
				<li><label for="{$seo_follow_nl.id}">{$seo_follow_nl.rbtSeoFollowNl} {$seo_follow_nl.label}</label></li>
			{/iteration:seo_follow_nl}
		</ul>
	</div>
</div>


{$hidMetaIdNl}
{$hidBaseFieldNameNl}
{$hidCustomNl}
{$hidClassNameNl}
{$hidMethodNameNl}
{$hidParametersNl}

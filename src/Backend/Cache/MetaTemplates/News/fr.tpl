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
				{$chkPageTitleOverwriteFr}
				<label for="pageTitle" class="visuallyHidden">Paginatitel</label>
				{$txtPageTitleFr} {$txtPageTitleFrError}
			</li>
		</ul>
		<p>
			<label for="metaDescriptionOverwrite">Beschrijving</label>
			<span class="helpTxt">Vat de inhoud kort samen. Deze samenvatting wordt getoond in de resultaten van zoekmachines.</span>
		</p>
		<ul class="inputList checkboxTextFieldCombo">
			<li>
				{$chkMetaDescriptionOverwriteFr}
				<label for="metaDescription" class="visuallyHidden">Beschrijving</label>
				{$txtMetaDescriptionFr} {$txtMetaDescriptionFrError}
			</li>
		</ul>
		<p>
			<label for="metaKeywordsOverwrite">Sleutelwoorden</label>
			<span class="helpTxt">Kies een aantal goed gekozen termen die de inhoud omschrijven. Vanuit SEO-standpunt bieden deze echter niet langer een meerwaarde.</span>
		</p>
		<ul class="inputList checkboxTextFieldCombo">
			<li>
				{$chkMetaKeywordsOverwriteFr}
				<label for="metaKeywords" class="visuallyHidden">Sleutelwoorden</label>
				{$txtMetaKeywordsFr} {$txtMetaKeywordsFrError}
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
				{$chkUrlOverwriteFr}
				<label for="url" class="visuallyHidden">Aangepaste URL</label>
				{option:detailURLFr}<span id="urlFirstPart">{$detailURLFr}/</span>{/option:detailURLFr}{$txtUrlFr} {$txtUrlFrError}
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
		{$rbtSeoIndexFrError}
		<ul class="inputList inputListHorizontal">
			{iteration:seo_index_fr}
				<li><label for="{$seo_index_fr.id}">{$seo_index_fr.rbtSeoIndexFr} {$seo_index_fr.label}</label></li>
			{/iteration:seo_index_fr}
		</ul>
		<p class="label">follow</p>
		{$rbtSeoFollowFrError}
		<ul class="inputList inputListHorizontal">
			{iteration:seo_follow_fr}
				<li><label for="{$seo_follow_fr.id}">{$seo_follow_fr.rbtSeoFollowFr} {$seo_follow_fr.label}</label></li>
			{/iteration:seo_follow_fr}
		</ul>
	</div>
</div>


{$hidMetaIdFr}
{$hidBaseFieldNameFr}
{$hidCustomFr}
{$hidClassNameFr}
{$hidMethodNameFr}
{$hidParametersFr}

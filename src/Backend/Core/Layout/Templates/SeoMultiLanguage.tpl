<div id="seoMeta" class="subtleBox">
	<div class="heading">
		<h3>{$lblMetaInformation|ucfirst}</h3>
	</div>
	<div class="options">
		<p>
			<label for="pageTitleOverwrite">{$lblPageTitle|ucfirst}</label>
			<span class="helpTxt">{$msgHelpPageTitle}</span>
		</p>
		<ul class="inputList checkboxTextFieldCombo">
			<li>
				{$chkPageTitleOverwrite{$language|ucfirst}}
				<label for="pageTitle" class="visuallyHidden">{$lblPageTitle|ucfirst}</label>
				{$txtPageTitle{$language|ucfirst}} {$txtPageTitle{$language|ucfirst}Error}
			</li>
		</ul>
		<p>
			<label for="metaDescriptionOverwrite">{$lblDescription|ucfirst}</label>
			<span class="helpTxt">{$msgHelpMetaDescription}</span>
		</p>
		<ul class="inputList checkboxTextFieldCombo">
			<li>
				{$chkMetaDescriptionOverwrite{$language|ucfirst}}
				<label for="metaDescription" class="visuallyHidden">{$lblDescription|ucfirst}</label>
				{$txtMetaDescription{$language|ucfirst}} {$txtMetaDescription{$language|ucfirst}Error}
			</li>
		</ul>
		<p>
			<label for="metaKeywordsOverwrite">{$lblKeywords|ucfirst}</label>
			<span class="helpTxt">{$msgHelpMetaKeywords}</span>
		</p>
		<ul class="inputList checkboxTextFieldCombo">
			<li>
				{$chkMetaKeywordsOverwrite{$language|ucfirst}}
				<label for="metaKeywords" class="visuallyHidden">{$lblKeywords|ucfirst}</label>
				{$txtMetaKeywords{$language|ucfirst}} {$txtMetaKeywords{$language|ucfirst}Error}
			</li>
		</ul>
		{option:txtMetaCustom}
			<div class="textareaHolder">
				<p>
					<label for="metaCustom">{$lblExtraMetaTags|ucfirst}</label>
					<span class="helpTxt">{$msgHelpMetaCustom}</span>
				</p>
				{$txtMetaCustom{$language|ucfirst}} {$txtMetaCustom{$language|ucfirst}Error}
			</div>
		{/option:txtMetaCustom}
	</div>
</div>

<div class="subtleBox">
	<div class="heading">
		<h3>{$lblURL|uppercase}</h3>
	</div>
	<div class="options">
		<p>
			<label for="urlOverwrite">{$lblCustomURL|ucfirst}</label>
			<span class="helpTxt">{$msgHelpMetaURL}</span>
		</p>
		<ul class="inputList checkboxTextFieldCombo">
			<li>
				{$chkUrlOverwrite{$language|ucfirst}}
				<label for="url" class="visuallyHidden">{$lblCustomURL|ucfirst}</label>
				{option:detailURL{$language|ucfirst}}<span id="urlFirstPart">{$detailURL{$language|ucfirst}}/</span>{/option:detailURL{$language|ucfirst}}{$txtUrl{$language|ucfirst}} {$txtUrl{$language|ucfirst}Error}
			</li>
		</ul>
	</div>
</div>

<div class="subtleBox">
	<div class="heading">
		<h3>{$lblSEO|uppercase}</h3>
	</div>
	<div class="options">
		<p class="label">{$lblIndex}</p>
		{$rbtSeoIndex{$language|ucfirst}Error}
		<ul class="inputList inputListHorizontal">
			{iteration:seo_index_{$language}}
				<li><label for="{$seo_index_{$language}.id}">{$seo_index_{$language}.rbtSeoIndex{$language|ucfirst}} {$seo_index_{$language}.label}</label></li>
			{/iteration:seo_index_{$language}}
		</ul>
		<p class="label">{$lblFollow}</p>
		{$rbtSeoFollow{$language|ucfirst}Error}
		<ul class="inputList inputListHorizontal">
			{iteration:seo_follow_{$language}}
				<li><label for="{$seo_follow_{$language}.id}">{$seo_follow_{$language}.rbtSeoFollow{$language|ucfirst}} {$seo_follow_{$language}.label}</label></li>
			{/iteration:seo_follow_{$language}}
		</ul>
	</div>
</div>

{* Hidden settings, used for the Ajax-call to verify the url *}
{$hidMetaId{$language|ucfirst}}
{$hidBaseFieldName{$language|ucfirst}}
{$hidCustom{$language|ucfirst}}
{$hidClassName{$language|ucfirst}}
{$hidMethodName{$language|ucfirst}}
{$hidParameters{$language|ucfirst}}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
	<h2>{$lblNews|ucfirst}: {$msgEditArticle|sprintf:{$item.backend_title}}</h2>
</div>

{form:edit}
	<p>
		<label for="backendTitle">{$lblBackendTitle|ucfirst}<abbr title="{$lblRequiredField}">*</abbr></label>
		{$txtBackendTitle} {$txtBackendTitleError}
	</p>

	<table style="width: 100%">
		<tr>
			<td id="leftColumn">
				<div class="tabs ui-tabs">
					<ul>
						{iteration:languages}
							<li>
								<a href="#tab-{$languages.language|lowercase}">{$languages.language|uppercase}</a>
							</li>
						{/iteration:languages}

						{option:settings.cover_image_enabled}
							<li><a href="#tab-cover-image">{$lblCoverImage|ucfirst}</a></li>
						{/option:settings.cover_image_enabled}

						{iteration:languages}
							<li class="optional-seo-{$languages.language|lowercase} pull-right">
								<a href="#tab-seo-{$languages.language|lowercase}">{$lblSEO|ucfirst} {$languages.language|uppercase}</a>
							</li>
						{/iteration:languages}
					</ul>

					{iteration:languages}
						<div id="tab-{$languages.language|lowercase}" class="ui-tabs-hide optional-language-tab">
							<div class="subtleBox">
								<div class="heading">
									<h3>
										<label for="activate{$languages.language|ucfirst}" data-language="{$languages.language|lowercase}" class="toggle-optional-language inline">
											{$languages.chkActivate} {$lblActivate|ucfirst}: {$languages.language|uppercase}
										</label>
										{$languages.chkActivateError}
									</h3>
								</div>
							</div>

							<div class="optional-language">
								<div>
									<p>
										<label for="title{$languages.language|ucfirst}">{$lblTitle|ucfirst}
											<abbr title="{$lblRequiredField}">*</abbr>
										</label>
										{$languages.txtTitle} {$languages.txtTitleError}
									</p>
								</div>

								<div class="box">
									<div class="heading">
										<h3>
											<label for="content{$languages.language|ucfirst}">
												{$lblContent|ucfirst}<abbr title="{$lblRequiredField}">*</abbr>
											</label>
										</h3>
									</div>
									<div class="optionsRTE">
										{$languages.txtContent} {$languages.txtContentError}
									</div>
								</div>

								{option:showTagsIndex}
									<div class="box">
										<div class="heading">
											<h3><label for="tags{$languages.language|ucfirst}">{$lblTags|ucfirst}</label></h3>
										</div>
										<div class="options">
											{$languages.txtTags} {$languages.txtTagsError}
										</div>
									</div>
								{/option:showTagsIndex}
							</div>
						</div>
					{/iteration:languages}

					{option:settings.cover_image_enabled}
						<div id="tab-cover-image" class="ui-tabs-hide clearfix">
                            <div class="box">
                                <div class="heading">
                                    <h3>
                                        <label for="image">
                                            {$lblImage|ucfirst}
                                            {option:settings.cover_image_required}
                                                <abbr title="{$lblRequiredField}">*</abbr>
                                            {/option:settings.cover_image_required}
                                        </label>
                                    </h3>
                                </div>
                                <div class="options">
                                    {option:item.coverImage}
                                        <p class="">
                                            <img src="{$FRONTEND_FILES_URL}/news/covers/source/{$item.coverImage}" width="140" alt="{$lblImage|ucfirst}" />

                                            <label for="deleteImage">{$chkDeleteImage} {$lblDelete|ucfirst}</label>
                                            {$chkDeleteImageError}
                                        </p>
                                    {/option:item.coverImage}
                                    {$fileImage} {$fileImageError}
                                    <span class="helpTxt">
								    {$msgHelpImageFieldWithMaxFileSize|sprintf:{$settings.image_size_limit}.'MB'}
							        </span>
                                </div>
                            </div>



                            <div class="box">
                                <div class="heading">
                                    <h3>
                                        <label for="youtubeUrl">
                                            {$lblYoutube|ucfirst}
                                        </label>
                                    </h3>
                                </div>
                                <div class="options">
                                    {$txtYoutubeUrl} {$txtYoutubeUrlError}
                                </div>
                            </div>
						</div>
					{/option:settings.cover_image_enabled}

					{iteration:meta}
						<div id="tab-seo-{$meta.language|lowercase}" class="ui-tabs-hide">
							{include:{$meta.template}}
						</div>
					{/iteration:meta}
				</div>
			</td>
			<td id="sidebar">
				<div id="publishOptions" class="box">
					<div class="heading">
						<h3>{$lblStatus|ucfirst}</h3>
					</div>

					<div class="options">
						<ul class="inputList">
							{iteration:hidden}
								<li>
									{$hidden.rbtHidden}
									<label for="{$hidden.id}">{$hidden.label}</label>
								</li>
							{/iteration:hidden}
						</ul>
					</div>

                    <div class="options">
                        <label for="spotlight" class="inline">
                            {$chkSpotlight} {$lblSpotlight|ucfirst}
                        </label>
                        {$chkSpotlightError}
                    </div>

					<div class="options">
						<p class="p0"><label for="publishOnDate">{$lblPublishOn|ucfirst}</label></p>
						<div class="oneLiner">
							<p>
								{$txtPublishOnDate} {$txtPublishOnDateError}
							</p>
							<p>
								<label for="publishOnTime">{$lblAt}</label>
							</p>
							<p>
								{$txtPublishOnTime} {$txtPublishOnTimeError}
							</p>
						</div>
					</div>
				</div>

				<div class="box" id="articleMeta">
					<div class="heading">
						<h3>{$lblMetaData|ucfirst}</h3>
					</div>
					<div class="options">
						<label for="categoryId">{$lblCategory|ucfirst}</label>
						{$ddmCategoryId} {$ddmCategoryIdError}
					</div>
					<div class="options">
						<label for="userId">{$lblAuthor|ucfirst}</label>
						{$ddmUserId} {$ddmUserIdError}
					</div>
				</div>

				<div class="fullwidthOptions">
					{option:showNewsDelete}
						<a href="{$var|geturl:'delete'}&amp;id={$item.id}" data-message-id="confirmDelete" class="askConfirmation button icon iconDelete">
							<span>{$lblDelete|ucfirst}</span>
						</a>
						<div id="confirmDelete" title="{$lblDelete|ucfirst}?" style="display: none;">
							<p>
								{$msgConfirmDelete|sprintf:{$item.backend_title}}
							</p>
						</div>
					{/option:showNewsDelete}
					<div class="buttonHolderRight">
						<input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="{$lblEdit|ucfirst}" />
					</div>
				</div>
			</td>
		</tr>
	</table>
{/form:edit}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}

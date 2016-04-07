{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
	<h2>{$lblArtist|ucfirst}: {$lblEdit}</h2>
</div>

{form:edit}
	<div class="tabs ui-tabs">
		<ul>
			<li class="{option:infoError}ui-state-error{/option:infoError}"><a href="#tabArtist">{$lblArtist|ucfirst}</a></li>
			<li><a href="#tabPractical">{$lblPratical|ucfirst}</a></li>
			<li><a href="#tabInfo">{$lblInfo|ucfirst}</a></li>
			{iteration:languages}<li><a href="#tab{$languages.language|uppercase}">{$languages.language|uppercase}</a></li>{/iteration:languages}
			<li class="floatRight" style="float:right;"><a href="#tabSEO">{$lblSEO|ucfirst}</a></li>
		</ul>

        <div id="tabArtist" class="ui-tabs-hide">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td id="leftColumn">
						<div class="box">
							<div class="heading">
								<h3>{$lblArtistName|ucfirst}</h3>
							</div>
							<div class="options">
								<p>
									<label for="backendTitle">{$lblArtistName|ucfirst}<abbr title="{$lblRequiredField}">*</abbr></label>
									{$txtName} {$txtNameError}
								</p>
							</div>
						</div>
						<div class="box">
							<div class="heading">
								<h3>{$lblArtistImage|ucfirst}</h3>
							</div>
							<div class="options">
                                {option:item.cover}
                                    <p class="imageHolder">
                                        <img src="{$FRONTEND_FILES_URL}/festival/artists/covers/x250/{$item.cover}" width="140" alt="{$lblCoverImage|ucfirst}" />
                                        <label for="deleteImage">{$chkDeleteImage} {$lblDelete|ucfirst}</label>
                                        {$chkDeleteImageError}
                                    </p>
                                {/option:item.cover}
                                <p>
									<label for="coverImage">{$lblArtistImage|ucfirst}</label>
									{$fileCover} {$fileCoverError}
								</p>
							</div>
						</div>
					</td>

					<td id="sidebar">
                        <div class="box">
                            <div class="heading">
                                <h3>{$lblArtistUrlToShare|ucfirst}</h3>
                            </div>

                            <div class="options">
                                <p>
                                    <a href="{$link}" target="_blank">{$link}</a>
                                </p>
                            </div>

                            <div class="options">
                                <p>
                                    <a href="{$linkEn}" target="_blank">{$linkEn}</a>
                                </p>
                            </div>
                        </div>

						<div class="box">
							<div class="heading">
								<h3>{$lblPractical|ucfirst}</h3>
							</div>

							<div class="options">
                                <p class="p0"><label for="publishOnDate">{$lblStartOn|ucfirst}</label></p>
                                <div class="oneLiner">
                                    <p>
                                        {$txtStartOnDate} {$txtStartOnDateError}
                                    </p>
                                    <p>
                                        <label for="publishOnTime">{$lblAt}</label>
                                    </p>
                                    <p>
                                        {$txtStartOnTime} {$txtStartOnTimeError}
                                    </p>
                                    <p>
                                        <label for="publishOnTime">uu:mm</label>
                                    </p>
                                </div>
							</div>
                            <div class="options">
                                <p>
                                    <label for="stageId">{$lblStage|ucfirst}</label>
                                    {$ddmStageId} {$ddmStageIdError}
                                </p>
                            </div>

                            <div class="options">
                                <p>
                                    <label for="stageId">{$lblCategory|ucfirst}</label>
                                    {$ddmCategoryId} {$ddmCategoryIdError}
                                </p>
                            </div>
						</div>
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
                                <label for="finalized" class="inline">
                                    {$chkFinalized} {$lblFinalize|ucfirst}
                                </label>
                                {$chkFinalizedError}
                            </div>

                            <div class="options">
                                <label for="signUpOpen" class="inline">
                                    {$chkSignUpOpen} {$lblSignUpOpen|ucfirst}
                                </label>
                                {$chkSignUpOpenError}
                            </div>

                            <div class="options">
                                <label for="spotlight" class="inline">
                                    {$chkSpotlight} {$lblSpotlight|ucfirst}
                                </label>
                                {$chkSpotlightError}
                            </div>

							<div class="options">
								<label for="userId">{$lblAuthor|ucfirst}</label>
								{$ddmUserId} {$ddmUserIdError}
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>

		<div id="tabPractical" class="ui-tabs-hide">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td id="leftColumn">
                        <div class="box">
                            <div class="heading">
                                <h3>{$lblContactPerson|ucfirst}</h3>
                            </div>
                            <div class="options">
                                <p>
                                    <label for="contactFirstName">{$lblContactFirstName|ucfirst}</label>
                                    {$txtContactFirstName} {$txtContactFirstNameError}
                                </p>
                                <p>
                                    <label for="contactName">{$lblContactName|ucfirst}</label>
                                    {$txtContactName} {$txtContactNameError}
                                </p>
                                <p>
                                    <label for="contactEmail">{$lblContactEmail|ucfirst}</label>
                                    {$txtContactEmail} {$txtContactEmailError}
                                </p>
                                <p>
                                    <label for="contactPhone">{$lblContactPhone|ucfirst}</label>
                                    {$txtContactPhone} {$txtContactPhoneError}
                                </p>
                            </div>
                        </div>

                        <div class="box">
                            <div class="heading">
                                <h3>{$lblBackstage|ucfirst} ({$totalBackstage})</h3>
                            </div>
                            <div class="options">
                              {*  <p>
                                    <label for="personsBackstage" id="backstage">{$lblPersonsBackstage|ucfirst}</label>
                                <p>*}
                                {iteration:personsBackstage}
                                    <label>{$lblName|ucfirst}:</label> {$personsBackstage.name} <br />
                                {/iteration:personsBackstage}
                            </div>
                        </div>

                        <div class="box">
                            <div class="heading">
                                <h3>{$lblOnstage|ucfirst} ({$totalOnstage})</h3>
                            </div>
                            <div class="options">

                                {iteration:personsOnstage}
                                    <label>{$lblName|ucfirst}:</label> {$personsOnstage.name} <br />
                                {/iteration:personsOnstage}
                            </div>
                        </div>

                        <div class="box">
                            <div class="heading">
                                <h3>{$lblRemark|ucfirst}</h3>
                            </div>
                            <div class="options">
                                <p>
                                    <label for="remark">{$lblRemark|ucfirst}</label>
                                    {$txtRemark} {$txtRemarkError}
                                </p>
                            </div>
                        </div>
					</td>

					<td id="sidebar">
                        <div class="box">
                            <div class="heading">
                                <h3>{$lblPractical|ucfirst}</h3>
                            </div>

                            <div class="options">
                                <label for="soundEngineer">{$chkSoundEngineer} {$lblSoundEngineer|ucfirst}</label>
                                {$chkSoundEngineerError}
                            </div>

                            <div class="options">
                                <p>
                                    <label for="hotMeal">{$lblHotMeal|ucfirst}</label>
                                    {$txtHotMeal} {$txtHotMealError}
                                </p>
                            </div>

                            <div class="options">
                                <p>
                                    <label for="veggieMeal">{$lblVeggieMeal|ucfirst}</label>
                                    {$txtVeggieMeal} {$txtVeggieMealError}
                                </p>
                            </div>

                            <div class="options">
                                <p>
                                    <label for="totalCars">{$lblTotalCars|ucfirst}</label>
                                    {$txtTotalCars} {$txtTotalCarsError}
                                </p>
                            </div>
                        </div>

                        <div class="box">
                            <div class="heading">
                                <h3>{$lblFiles|ucfirst}</h3>
                            </div>

                            <div class="options">
                                {option:practical.technicalFilename}
                                    <p class="downloadHolder">
                                        <a href="{$FRONTEND_FILES_URL}/festival/artists/files/technical/{$practical.technicalFilename}" target="_blank">{$lblDownload|ucfirst}</a>
                                        <label for="deleteImage">{$chkDeleteTechnical} {$lblDelete|ucfirst}</label>
                                        {$chkDeleteTechnicalError}
                                    </p>
                                {/option:practical.technicalFilename}
                                <p>
                                    <label for="technicalFile">{$lblTechnicalFile|ucfirst}</label>
                                    {$fileTechnicalFile} {$fileTechnicalFileError}
                                </p>
                            </div>

                            <div class="options">
                              {option:practical.contractFilename}
                                    <p class="downloadHolder">
                                        <a href="{$FRONTEND_FILES_URL}/festival/artists/files/contract/{$practical.contractFilename}" target="_blank">{$lblDownload|ucfirst}</a>
                                        <label for="deleteImage">{$chkDeleteContract} {$lblDelete|ucfirst}</label>
                                        {$chkDeleteContractError}
                                    </p>
                                {/option:practical.contractFilename}
                                <p>
                                    <label for="contractFile">{$lblContractFile|ucfirst}</label>
                                    {$fileContractFile}{$fileContractFileError}
                                </p>
                            </div>
                        </div>
					</td>
				</tr>
			</table>
		</div>

        <div id="tabInfo" class="ui-tabs-hide">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td id="leftColumn">
                        <div class="box">
                            <div class="heading">
                                <h3>{$lblSocial|ucfirst}</h3>
                            </div>
                            <div class="options">
                                <p>
                                    <label for="facebook">{$lblFacebook|ucfirst}</label>
                                    {$txtFacebook} {$txtFacebookError}
                                </p>
                                <p>
                                    <label for="twitter">{$lblTwitter|ucfirst}</label>
                                    {$txtTwitter} {$txtTwitterError}
                                </p>
                                <p>
                                    <label for="youtube">{$lblYoutube|ucfirst}</label>
                                    {$txtYoutube} {$txtYoutubeError}
                                </p>
                                <p>
                                    <label for="instagram">{$lblInstagram|ucfirst}</label>
                                    {$txtInstagram} {$txtInstagramError}
                                </p>
                                <p>
                                    <label for="soundcloud">{$lblSoundcloud|ucfirst}</label>
                                    {$txtSoundcloud} {$txtSoundcloudError}
                                </p>
                                <p>
                                    <label for="website">{$lblWebsite|ucfirst}</label>
                                    {$txtWebsite} {$txtWebsiteError}
                                </p>
                            </div>
                        </div>
                        <div class="box">
                            <div class="heading">
                                <h3>{$lblBio|ucfirst}</h3>
                            </div>
                            <div class="options">
                                <p>
                                    <label for="remark">{$lblBio|ucfirst}</label>
                                    {$txtBio} {$txtBioError}
                                </p>
                            </div>
                        </div>
					</td>
				</tr>
			</table>
		</div>

		{iteration:languages}
			<div id="tab{$languages.language|uppercase}" class="ui-tabs-hide">
				<div>
					<p>
						<label for="activate{$languages.language|ucfirst}" data-language-toggle="{$languages.language|uppercase}" class="inline">{$languages.chkActivate} {$lblActivate|ucfirst}: {$languages.language|uppercase}</label>
						{$languages.chkActivateError}
					</p>
				</div>

				<div data-optional-language="{$languages.language|uppercase}">
					<table border="0" cellspacing="0" cellpadding="0" width="100%">
						<tr>
                            <td id="leftColumn">
                                <div class="box">
                                    <div class="heading">
                                        <h3>{$lblBio|ucfirst} {$languages.language|uppercase}</h3>
                                    </div>
                                    <div class="optionsRTE">
                                        {$languages.txtBio} {$languages.txtBioError}
                                    </div>
                                </div>
                            </td>

							<td id="sidebar">

							</td>
						</tr>
					</table>
				</div>
			</div>
		{/iteration:languages}

        <div id="tabSEO" class="ui-tabs-hide">
            {include:{$BACKEND_CORE_PATH}/Layout/Templates/Seo.tpl}
        </div>
	</div>

	<div class="fullwidthOptions">
        {option:showFestivalDeleteArtist}
            <a href="{$var|geturl:'delete_artist'}&amp;id={$item.id}" data-message-id="confirmDelete" class="askConfirmation linkButton button icon iconDelete">
                <span>{$lblDelete|ucfirst}</span>
            </a>
            <div id="confirmDelete" title="{$lblDelete|ucfirst}?" style="display: none;">
                <p>
                    {$msgConfirmDelete|sprintf:{$item.name}}
                </p>
            </div>
        {/option:showFestivalDeleteArtist}

		<div class="buttonHolderRight">
			<input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="{$lblSaveChanges|ucfirst}" />
		</div>
	</div>
{/form:edit}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}
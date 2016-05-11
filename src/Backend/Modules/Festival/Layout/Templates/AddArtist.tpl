{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
	<h2>{$lblArtist|ucfirst}: {$lblAdd}</h2>
</div>

{form:add}
	<div class="tabs ui-tabs">
		<ul>
			<li class="{option:infoError}ui-state-error{/option:infoError}"><a href="#tabArtist">{$lblArtist|ucfirst}</a></li>
			<li><a href="#tabPractical">{$lblPratical|ucfirst}</a></li>
			<li><a href="#tabInfo">{$lblInfo|ucfirst}</a></li>
			{iteration:languages}<li><a href="#tab{$languages.language|uppercase}">{$languages.language|uppercase}</a></li>{/iteration:languages}
			<li class="floatRight optional-language-tab" style="float:right;"><a href="#tabSEO">{$lblSEO|ucfirst}</a></li>
		</ul>

		<div id="tabArtist" class="ui-tabs-hide">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td id="leftColumnArtist">
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
								<p>
									<label for="coverImage">{$lblArtistImage|ucfirst}</label>
									{$fileCover} {$fileCoverError}
								</p>
							</div>
						</div>
					</td>

					<td id="sidebar">
						<div class="box playDates">
						  <div class="heading">
								<h3>{$lblPractical|ucfirst}</h3>
							</div>
							<div class="options pickDate">
                                <div class="oneLiner">
                                    <p>
                                        <input type="text" value="" name="dates[]" name="" maxlength="10" data-mask="dd/mm/yy" class="inputText generatePicker" data-firstday="1">
                                    </p>
                                    <p>
                                        <label for="publishOnTime">{$lblAt}</label>
                                    </p>
                                    <p>
                                         <input name="times[]" type="text" value="17:00" maxlength="5" data-mask="dd/mm/yy" class="inputText inputTime" data-firstday="1">
                                    </p>
                                    <p>
                                        <label for="publishOnTime">uu:mm</label>
                                    </p>
                                </div>
                                <div class="oneLiner">
                                    <p>
                                        <label>{$lblStage|ucfirst}: </label>
                                        <select name="stages[]" class="select" size="1">
                                            {iteration:stages}
                                                <option value="{$stages.id}">{$stages.name}</option>
                                            {/iteration:stages}
                                        </select>
                                    </p>
                                </div>
                                <div class="oneLiner">
                                    <p>
                                        <label>{$lblCategory|ucfirst}: </label>
                                        <select name="categories[]" class="select" size="1">
                                            {iteration:categories}
                                                <option value="{$categories.id}">{$categories.name}</option>
                                            {/iteration:categories}
                                        </select>
                                    </p>
                                </div>
                                <p class="remove hidden">{$lblRemove}</p>
                            </div>
                            <div class="options copyDate">
                               <p>Add another date</p>
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
											<label for="{$hidden.id}">{$hidden.label|ucfirst}</label>
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
                                    <label for="contactPhone">{$lblContactPhone|ucfirst}
                                    {$txtContactPhone} {$txtContactPhoneError}
                                </p>
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
                                    <label for="totalCars">{$lblVeganMeal|ucfirst}</label>
                                    {$txtVeganMeal} {$txtVeganMealError}
                                </p>
                            </div>
                        </div>

                        <div class="box">
                            <div class="heading">
                                <h3>{$lblFiles|ucfirst}</h3>
                            </div>

                            <div class="options">
                                <p>
                                    <label for="technicalFile">{$lblTechnicalFile|ucfirst}</label>
                                    {$fileTechnicalFile} {$fileTechnicalFileError}
                                </p>
                            </div>

                            <div class="options">
                                <p>
                                    <label for="contractFile">{$lblContractFile|ucfirst}</label>
                                    {$fileContractFile}{$fileContractFileError}
                                </p>
                            </div>
                            <div class="options">
                                <p>
                                    <label for="stageFile">{$lblStageFile|ucfirst}</label>
                                    {$fileStageFile}{$fileStageFileError}
                                </p>
                            </div>
                             <div class="options">
                                <p>
                                    <label for="extraFile">{$lblExtraFile|ucfirst}</label>
                                    {$fileExtraFile}{$fileExtraFileError}
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

		<div class="hidden">
			{$hidUploadFolder}
{*
			<span class="hidden" id="itemId">{$item.id}</span>
*}
		</div>

        <div id="tabSEO" class="ui-tabs-hide">
            {include:{$BACKEND_CORE_PATH}/Layout/Templates/Seo.tpl}
        </div>
	</div>

	<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="addButton" class="inputButton button mainButton" type="submit" name="add" value="{option:addAction}{$lblAddProduct|ucfirst}{/option:addAction}{option:!addAction}{$lblSaveChanges|ucfirst}{/option:!addAction}" />
		</div>
	</div>
{/form:add}

<div id="confirmDelete" title="{$lblDelete|ucfirst}?" style="display: none;">
	<p>
		{$msgConfirmDelete|sprintf:{$title}}
	</p>
</div>

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}
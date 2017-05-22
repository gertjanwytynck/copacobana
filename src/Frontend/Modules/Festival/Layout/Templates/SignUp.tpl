{*
	variables that are available:
	- {$item}: contains data about the artist
*}

<section id="signUpForm">
    <div class="loader-outer hidden">
        <div class="loaderBlock">
            <div class="loader spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
            </div>
        </div>
    </div>
    {option:success}
        <div class="row">
            <div class="col-md-12 successBox">
                <p class="success text-center">{$msgCorrect}</p>
                <p class="text-center">{$msgWatchHere|sprintf:{$link}}</p>
            </div>
        </div>
    {/option:success}
    {option:!success}
    {form:edit}
        <div class="row">
            <div class="col-md-2 imagesLeft">
                <img src="{$THEME_URL}/Core/Layout/images/img-bird-left.png" alt="bird" class="bird1"/>
                <img src="{$THEME_URL}/Core/Layout/images/img-balloon.png" alt="balloon" class="balloon2"/>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <header>
                            <h1>{$item.name}<span class="sub"><br />{$lblSignUpForm|ucfirst} {$settings.year}</span></h1>
                        </header>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 info-box">
                        {iteration:startDates}
                        <div class="dates">
                            <p>{$lblStage|ucfirst}: <span>{$startDates.stage}</span><br />
                            {$lblTime|ucfirst}: <span>{$startDates.date}</span> {$lblAt} <span>{$startDates.time}</span></p>
                        </div>
                        {/iteration:startDates}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 bottom20 info-box">
                        <p>
                            {$msgPracticalInfoText|ucfirst}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 bottom20 info-box">
                        <p>
                            {$msgTerrainText|ucfirst}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 info-box">
                        <div class="dates">
                            <p>
                                {$msgBilling}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                        <div class="box-highlight">
                            <p>{$msgDeadLineWebsite}</p>
                        </div>
                    </div>
                </div>

                {option:error}
                <div class="row box-error">
                    <div class="col-md-12">
                        <p>{$fileTechnicalError}</p>
                        <p>{$fileCoverError}</p>
                        <p>{$fileStageError}</p>
                        <p>{$fileContractError}</p>
                        <p>{$txtContactPhoneError}</p>
                        <p>{$txtContactNameError}</p>
                        <p>{$txtContactEmailError}</p>
                        <p>{$txtContactFirstNameError}</p>
                        <p>{$txtFacebookError}</p>
                        <p>{$txtTwitterError}</p>
                        <p>{$txtYoutubeError}</p>
                        <p>{$txtWebsiteError}</p>
                        <p>{$txtInstagramError}</p>
                        <p>{$txtSoundcloudError}</p>
                    </div>
                </div>
                {/option:error}

                <h2>{$lblContactPerson|ucfirst}
                    <span class="pull-right" data-toggle="tooltip" data-placement="left" title="{$msgContactPerson}"><img src="{$THEME_URL}/Core/Layout/images/icon_information.svg" /></span>
                </h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{option:txtContactFirstNameError} errorArea{/option:txtContactFirstNameError}">
                            {$txtContactFirstName}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{option:txtContactNameError} errorArea{/option:txtContactNameError}">
                            {$txtContactName}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{option:txtContactEmailError} errorArea{/option:txtContactEmailError}">
                            {$txtContactEmail}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{option:txtContactPhoneError} errorArea{/option:txtContactPhoneError}">
                            {$txtContactPhone}
                        </div>
                    </div>
                </div>

                <h2>{$lblWebsiteInfo|ucfirst}</h2>
								<div class="row">
									<div class="col-md-12 info-box">
										<p>
											{$msgWebsiteInfo}
										</p>
									</div>
								</div>

                <h3>{$lblCover|ucfirst}<span class="pull-right" data-toggle="tooltip" data-placement="left" title="{$msgCover}"><img src="{$THEME_URL}/Core/Layout/images/icon_information.svg" /></span></h3>
                <div class="row">
                    <div class="col-md-6">
                        {option:closed}
                            {option:!item.cover}
                                <div class="info-box">
                                    <p>{$msgNoCover}</p>
                                </div>
                            {/option:!item.cover}
                        {/option:closed}
                        {option:item.cover}
                            <div class="info-box uploaded-file">
                                <p>{$lblUploadedFile} <span class="underline">({$item.cover})</span></p>
                            </div>
                            <div class="downloadFile row">
                                <div class="col-md-12 bottom20">
                                    <img src="{$FRONTEND_FILES_URL}/festival/artists/covers/x330/{$item.cover}" />
                                </div>
                                <div class="btn-group col-md-12" data-toggle="buttons">
                                    {option:chkDeleteCover}
                                        <div class="form-group">
                                            <label for="deleteCover" class="btn btn-round">
                                                {$chkDeleteCover}
                                                <span class="circle-border chk">&nbsp;</span>
                                                <span class="lbl-text">{$lblDelete|ucfirst}</span>
                                            </label>
                                        </div>
                                    {/option:chkDeleteCover}
                                </div>
                            </div>
                        {/option:item.cover}
                        {option:fileCover}
                            <div class="form-group upload-group{option:fileCoverError} errorArea{/option:fileCoverError}">
                                {$fileCover}
                                <input type="text" name="" placeholder="{$lblUploadCover|ucfirst}" class="form-control form-upload">
                                <span class="helpTxt">{$msgHelpMaxFileSizeMB|sprintf:{$settings.image_size_limit}}</span>
                                <div class="upload"></div>
                            </div>
                        {/option:fileCover}
                    </div>
                </div>

                <h3 class="">{$lblSocialMedia|ucfirst}<span class="pull-right" data-toggle="tooltip" data-placement="left" title="{$msgSocialUrl}"><img src="{$THEME_URL}/Core/Layout/images/icon_information.svg" /></span></h3>
                <div class="row social-media">
                    <div class="col-md-1 icon-social">
                        <img src="{$THEME_URL}/Core/Layout/images/social_fb.svg" title="facebook" alt="facebook"/>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group{option:txtFacebookError} errorArea{/option:txtFacebookError}">
                            {$txtFacebook}
                            <p class="js-error hidden">{$errUrl}</p>
                        </div>
                    </div>
                    <div class="col-md-1 icon-social">
                        <img src="{$THEME_URL}/Core/Layout/images/social_tw.svg" title="twitter" alt="twitter"/>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group{option:txtTwitterError} errorArea{/option:txtTwitterError}">
                            {$txtTwitter}
                            <p class="js-error hidden">{$errUrl}</p>
                        </div>
                    </div>
                </div>
                <div class="row social-media">
                    <div class="col-md-1 icon-social">
                        <img src="{$THEME_URL}/Core/Layout/images/social_yt.svg" title="youtube" alt="youtube"/>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group{option:txtYoutubeError} errorArea{/option:txtYoutubeError}">
                            {$txtYoutube}
                            <p class="js-error hidden">{$errUrl}</p>
                        </div>
                    </div>
                    <div class="col-md-1 icon-social">
                        <img src="{$THEME_URL}/Core/Layout/images/social_insta.svg" title="instagram" alt="instagram"/>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group{option:txtInstagramError} errorArea{/option:txtInstagramError}">
                            {$txtInstagram}
                            <p class="js-error hidden">{$errUrl}</p>
                        </div>
                    </div>
                </div>
                <div class="row social-media">
                    <div class="col-md-1 icon-social">
                        <img src="{$THEME_URL}/Core/Layout/images/social_so.svg" title="soundcloud" alt="soundcloud"/>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group{option:txtSoundcloudError} errorArea{/option:txtSoundcloudError}">
                            {$txtSoundcloud}
                            <p class="js-error hidden">{$errUrl}</p>
                        </div>
                    </div>
                    <div class="col-md-1 icon-social">
                    <img src="{$THEME_URL}/Core/Layout/images/social_web.svg" title="web" alt="web"/>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group{option:txtWebsiteError} errorArea{/option:txtWebsiteError}">
                            {$txtWebsite}
                            <p class="js-error hidden">{$errUrl}</p>
                        </div>
                    </div>
                </div>

                <h3>{$lblBio|ucfirst}</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{option:txtBioError} errorArea{/option:txtBioError}">
                            {$txtBio} {$txtBioError}
                        </div>
                    </div>
                </div>

                <h2>{$lblPracticalInfo|ucfirst}</h2>
								<div class="row">
									<div class="col-md-12 info-box">
										<p>
											{$msgPracticalInfo}
										</p>
									</div>
								</div>
                <h3 class="top20">{$lblFiles|ucfirst}</h3>
                <div class="row">
                    <div class="col-md-6">
                        {option:!fileContract}
                            {option:!item.practical.0.contractFilename}
                                <div class="info-box">
                                    <p>{$msgNoFileContract}</p>
                                </div>
                            {/option:!item.practical.0.contractFilename}
                        {/option:!fileContract}

                        {option:item.practical.0.contractFilename}
                            <div class="info-box uploaded-file">
                                <p>{$lblUploadedFile} <span class="underline">({$item.practical.0.contractFilename})</span></p>
                            </div>
                            <div class="downloadFile row">
                                <div class="col-md-6">
                                    <a class="btn-download-file" href="{$FRONTEND_FILES_URL}/festival/artists/files/contract/{$item.practical.0.contractFilename}" target="_blank">{$lblDownload|ucfirst}</a>
                                </div>
                                <div class="btn-group col-md-6" data-toggle="buttons">
                                    {option:chkDeleteContract}
                                        <div class="form-group">
                                            <label for="deleteContract" class="btn btn-round">
                                                {$chkDeleteContract}
                                                <span class="circle-border chk">&nbsp;</span>
                                                <span class="lbl-text">{$lblDelete|ucfirst}</span>
                                            </label>
                                        </div>
                                    {/option:chkDeleteContract}
                                </div>
                            </div>
                        {/option:item.practical.0.contractFilename}
                        {option:fileContract}
                            <div class="form-group upload-group{option:fileContractError} errorArea{/option:fileContractError}">
                                {$fileContract}
                                <input type="text" name="" placeholder="{$msgFileContract}" class="form-control form-upload">
                                <span class="helpTxt">{$msgHelpMaxFileSizeMB|sprintf:{$settings.file_size_limit}}</span>
                                <div class="upload"></div>
                            </div>
                        {/option:fileContract}
                    </div>
                    <div class="col-md-6">
                        {option:!fileTechnical}
                            {option:!item.practical.0.technicalFilename}
                                <div class="info-box">
                                    <p>{$msgNoFileTechnical}</p>
                                </div>
                            {/option:!item.practical.0.technicalFilename}
                        {/option:!fileTechnical}

                        {option:item.practical.0.technicalFilename}
                            <div class="info-box uploaded-file">
                                <p>{$lblUploadedFile} <span class="underline">({$item.practical.0.technicalFilename})</span></p>
                            </div>
                            <div class="downloadFile row">
                                <div class="col-md-6">
                                    <a class="btn-download-file" href="{$FRONTEND_FILES_URL}/festival/artists/files/technical/{$item.practical.0.technicalFilename}" target="_blank">{$lblDownload|ucfirst}</a>
                                </div>
                                <div class="btn-group col-md-6" data-toggle="buttons">
                                    {option:chkDeleteTechnical}
                                        <div class="form-group">
                                            <label for="deleteTechnical" class="btn btn-round">
                                                {$chkDeleteTechnical}
                                                <span class="circle-border chk">&nbsp;</span>
                                                <span class="lbl-text">{$lblDelete|ucfirst}</span>
                                            </label>
                                        </div>
                                    {/option:chkDeleteTechnical}
                                </div>
                            </div>
                        {/option:item.practical.0.technicalFilename}
                        {option:fileTechnical}
                            <div class="form-group upload-group{option:fileTechnicalError} errorArea{/option:fileTechnicalError}">
                                {$fileTechnical}
                                <input type="text" name="" placeholder="{$msgFileTechnical}" class="form-control form-upload">
                                <span class="helpTxt">{$msgHelpMaxFileSizeMB|sprintf:{$settings.file_size_limit}}</span>
                                <div class="upload"></div>
                            </div>
                        {/option:fileTechnical}
                    </div>
                </div>

                <h3 class="top20">Stageplan & Extra</h3>
                <div class="row">
                    <div class="col-md-6">
                        {option:!fileStage}
                            {option:!item.practical.0.stageFilename}
                                <div class="info-box">
                                    <p>{$msgNoFileStage}</p>
                                </div>
                            {/option:!item.practical.0.stageFilename}
                        {/option:!fileStage}

                        {option:item.practical.0.stageFilename}
                            <div class="info-box uploaded-file">
                                <p>{$lblUploadedFile}<span class="underline">({$item.practical.0.stageFilename})</span></p>
                            </div>
                            <div class="downloadFile row">
                                <div class="col-md-6">
                                    <a class="btn-download-file" href="{$FRONTEND_FILES_URL}/festival/artists/files/stages/{$item.practical.0.stageFilename}" target="_blank">{$lblDownload|ucfirst}</a>
                                </div>
                                <div class="btn-group col-md-6" data-toggle="buttons">
                                    {option:chkDeleteStage}
                                        <div class="form-group">
                                            <label for="deleteStage" class="btn btn-round">
                                                {$chkDeleteStage}
                                                <span class="circle-border chk">&nbsp;</span>
                                                <span class="lbl-text">{$lblDelete|ucfirst}</span>
                                            </label>
                                        </div>
                                    {/option:chkDeleteStage}
                                </div>
                            </div>
                        {/option:item.practical.0.stageFilename}
                        {option:fileStage}
                            <div class="form-group upload-group{option:fileStageError} errorArea{/option:fileStageError}">
                                {$fileStage}
                                <input type="text" name="" placeholder="{$msgFileStage}" class="form-control form-upload">
                                <span class="helpTxt">{$msgHelpMaxFileSizeMB|sprintf:{$settings.file_size_limit}}</span>
                                <div class="upload"></div>
                            </div>
                        {/option:fileStage}
                    </div>
                     <div class="col-md-6">
                        {option:!fileExtra}
                            {option:!item.practical.0.extraFilename}
                                <div class="info-box">
                                    <p>{$msgNoFileExtra}</p>
                                </div>
                            {/option:!item.practical.0.extraFilename}
                        {/option:!fileExtra}

                        {option:item.practical.0.extraFilename}
                            <div class="info-box uploaded-file">
                                <p>{$lblUploadedFile}<span class="underline">({$item.practical.0.extraFilename})</span></p>
                            </div>
                            <div class="downloadFile row">
                                <div class="col-md-6">

                                    <a class="btn-download-file" href="{$FRONTEND_FILES_URL}/festival/artists/files/extra/{$item.practical.0.extraFilename}" download="{$item.practical.0.extraFilename}">{$lblDownload|ucfirst}</a>
                                </div>
                                <div class="btn-group col-md-6" data-toggle="buttons">
                                    {option:chkDeleteExtra}
                                        <div class="form-group">
                                            <label for="deleteExtra" class="btn btn-round">
                                                {$chkDeleteExtra}
                                                <span class="circle-border chk">&nbsp;</span>
                                                <span class="lbl-text">{$lblDelete|ucfirst}</span>
                                            </label>
                                        </div>
                                    {/option:chkDeleteExtra}
                                </div>
                            </div>
                        {/option:item.practical.0.extraFilename}
                        {option:fileExtra}
                            <div class="form-group upload-group{option:fileExtraError} errorArea{/option:fileExtraError}">
                                {$fileExtra}
                                <input type="text" name="" placeholder="{$msgFileExtra}" class="form-control form-upload">
                                <span class="helpTxt">{$msgHelpMaxFileSizeMB|sprintf:{$settings.file_size_limit}}</span>
                                <div class="upload"></div>
                            </div>
                        {/option:fileExtra}
                    </div>
                </div>
                <h3>Crew <span class="pull-right" data-toggle="tooltip" data-placement="left" title="{$msgBackstage|ucfirst}"><img src="{$THEME_URL}/Core/Layout/images/icon_information.svg" /></h3>
                <div class="row">
                    <div class="col-md-12 backstageGroup">
                        <div class="group">
                            <div class="row firstEl">
                                <div class="col-md-6">
                                    <div class="form-group{option:txtNameBackstageError} errorArea{/option:txtNameBackstageError}">
                                        {$txtNameBackstage} {$txtNameBackstageError}
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {$ddmTypeBackstage} {$ddmTypeBackstageError}
                                    </div>
                                </div>
                                {option:!closed}
                                <div class="col-md-1">
                                    <div class="add addBackstage">
                                        <p>+</p>
                                    </div>
                                </div>
                                {/option:!closed}
                            </div>
                            {option:personsBackstage}
                                {iteration:personsBackstage}
                                    <div class="row extra">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input value="{$personsBackstage.name}" name="extraBackstage[]" maxlength="255" type="text" {option:closed}disabled="true"{/option:closed} class="form-control" placeholder="{$lblFirstName|ucfirst} & {$lblName}">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                {option:!closed}
                                                    <select name="typesBackstage[]" class="select" size="1">
                                                        {iteration:types}
                                                            <option value="{$types.id}" >{$types.name}</option>
                                                        {/iteration:types}
                                                    </select>
                                                {/option:!closed}
                                                {option:closed}
                                                    <select name="typesBackstage[]" disabled="1" class="select" size="1">
                                                        {iteration:types}
                                                        <option value="{$types.id}" >{$types.name}</option>
                                                        {/iteration:types}
                                                    </select>
                                                {/option:closed}
                                            </div>
                                        </div>
                                        {option:!closed}
                                        <div class="col-md-1">
                                            <div class="remove removeBackstage">
                                                <p>-</p>
                                            </div>
                                        </div>
                                        {/option:!closed}
                                    </div>
                                {/iteration:personsBackstage}
                            {/option:personsBackstage}
                            {option:!personsBackstage}
                                <div class="row extra hidden">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input value="" name="extraBackstage[]" maxlength="255" type="text" {option:closed}disabled="true"{/option:closed} class="form-control" placeholder="{$lblFirstName|ucfirst} & {$lblName}">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <select name="typesBackstage[]" class="select" size="1">
                                                {iteration:types}
                                                    <option value="{$types.id}">{$types.name}</option>
                                                {/iteration:types}
                                            </select>
                                        </div>
                                    </div>
                                    {option:!closed}
                                        <div class="col-md-1">
                                            <div class="remove removeBackstage">
                                                <p>-</p>
                                            </div>
                                        </div>
                                    {/option:!closed}
                                </div>
                            {/option:!personsBackstage}
                        </div>
                    </div>
                </div>

                <!-- <h3 class="top30">{$lblSoundEngineerTitle|ucfirst}</h3>
                <div class="row top10 bottom10">
                    <div class="col-md-6">
                        <div class="btn-group " data-toggle="buttons">
                            <div class="form-group" >
                                <label for="soundEngineer" class="btn btn-round {option:soundActive}active{/option:soundActive}">
                                    {$chkSoundEngineer}
                                    <span class="circle-border chk">&nbsp;</span>
                                    <span class="lbl-text">{$lblSoundEngineer|ucfirst}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div> -->

                <h3 class="top30">Maaltijd<span class="pull-right" data-toggle="tooltip" data-placement="left" title="{$msgMeal|ucfirst}"><img src="{$THEME_URL}/Core/Layout/images/icon_information.svg" /></h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group{option:txtHotMealError} errorArea{/option:txtHotMealError}">
                            <label for="hotMeal">{$lblHotMeal|ucfirst}</label>
                            {$txtHotMeal} {$txtHotMealError}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group{option:txtVeggieMealError} errorArea{/option:txtVeggieMealError}">
                            <label for="veggieMeal">{$lblVeggieMeal|ucfirst}</label>
                            {$txtVeggieMeal} {$txtVeggieMealError}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group{option:txtVeganMealError} errorArea{/option:txtVeganMealError}">
                            <label for="veganMeal">{$lblVeganMeal|ucfirst}</label>
                            {$txtVeganMeal} {$txtVeganMealError}
                        </div>
                    </div>
                </div>

                <h3 class="top30">{$lblCars|ucfirst}<span class="pull-right" data-toggle="tooltip" data-placement="left" title="{$msgCars|ucfirst}"><img src="{$THEME_URL}/Core/Layout/images/icon_information.svg" /></h3>
                <div class="row">
                    {iteration:cars}
                     <div class="col-md-3">
                        <div class="form-group">
                            {option:!closed}
                            <input value="{$cars.licencePlate}" name="car[]" maxlength="20" type="text" class="form-control" placeholder="{$lblLicencePlate|ucfirst}">
                            {/option:!closed}
                            {option:closed}
                            <input value="{$cars.licencePlate}" name="car[]" disabled="1" maxlength="20" type="text" class="form-control" placeholder="{$lblLicencePlate|ucfirst}">
                            {/option:closed}

                        </div>
                    </div>
                    {/iteration:cars}
                </div>

                <h3>{$lblRemark|ucfirst}</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{option:txtRemarkError} errorArea{/option:txtRemarkError}">
                            {$txtRemark} {$txtRemarkError}
                        </div>
                    </div>
                </div>

                {option:error}
                <div class="row box-error">
                    <div class="col-md-12">
                        <p>{$fileTechnicalError}</p>
                        <p>{$fileCoverError}</p>
                        <p>{$fileStageError}</p>
                        <p>{$fileContractError}</p>
                        <p>{$txtContactPhoneError}</p>
                        <p>{$txtContactNameError}</p>
                        <p>{$txtContactEmailError}</p>
                        <p>{$txtContactFirstNameError}</p>
                        <p>{$txtFacebookError}</p>
                        <p>{$txtTwitterError}</p>
                        <p>{$txtYoutubeError}</p>
                        <p>{$txtWebsiteError}</p>
                        <p>{$txtInstagramError}</p>
                        <p>{$txtSoundcloudError}</p>
                    </div>
                </div>
                {/option:error}

                {option:!closed}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="btn-submit" type="submit" name="signUp" value="{$lblSend|ucfirst|ucfirst}"/>
                            </div>
                        </div>
                    </div>
                {/option:!closed}
            </div>
            <div class="col-md-2 imagesRight">
                <img src="{$THEME_URL}/Core/Layout/images/img-balloon.png" alt="balloon" class="balloon1"/>
                <img src="{$THEME_URL}/Core/Layout/images/img-butterfly.png" alt="balloon" class="butterfly1"/>
                <img src="{$THEME_URL}/Core/Layout/images/img-bird-right.png" alt="bird" class="bird2"/>
            </div>
        </div>
    {/form:edit}
    {/option:!success}
</section>

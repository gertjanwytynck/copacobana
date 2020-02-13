<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>


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
    <?php
						if(isset($this->variables['success']) && empty($this->variables['success']) === false)
						{
							?>
        <div class="row">
            <div class="col-md-12 successBox">
                <p class="success text-center"><?php if(array_key_exists('msgCorrect', (array) $this->variables)) { echo $this->variables['msgCorrect']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgCorrect')) { echo $this->variables->getMsgCorrect(); } else { ?>{$msgCorrect}<?php } ?></p>
                <p class="text-center"><?php if(array_key_exists('msgWatchHere', (array) $this->variables) && array_key_exists('link', (array) $this->variables)) { echo sprintf($this->variables['msgWatchHere'], $this->variables['link']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLink')) { echo ""; throw new Exception('Variables in modifiers on objects are not supported.');; } else { ?>{$msgWatchHere|sprintf:<?php if(array_key_exists('link', (array) $this->variables)) { echo $this->variables['link']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLink')) { echo $this->variables->getLink(); } else { ?>{$link}<?php } ?>}<?php } ?></p>
            </div>
        </div>
    <?php } ?>
    <?php if(!isset($this->variables['success']) || empty($this->variables['success']) === true): ?>
    <?php
					if(isset($this->forms['edit']))
					{
						?><form action="<?php echo $this->forms['edit']->getAction(); ?>" method="<?php echo $this->forms['edit']->getMethod(); ?>"<?php echo $this->forms['edit']->getParametersHTML(); ?>>
						<?php echo $this->forms['edit']->getField('form')->parse();
						if($this->forms['edit']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['edit']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlentities($this->forms['edit']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
        <div class="row">
            <div class="col-md-2 imagesLeft">
                <img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/img-bird-left.png" alt="bird" class="bird1"/>
                <img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/img-balloon.png" alt="balloon" class="balloon2"/>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <header>
                            <h1><?php if(isset($this->variables['item']) && array_key_exists('name', (array) $this->variables['item'])) { echo $this->variables['item']['name']; } elseif(is_object($this->variables['item']) && method_exists($this->variables['item'], 'getName')) { echo $this->variables['item']->getName(); } else { ?>{$item.name}<?php } ?><span class="sub"><br /><?php if(array_key_exists('lblSignUpForm', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSignUpForm']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblSignUpForm')) { echo SpoonFilter::ucfirst($this->variables->getLblSignUpForm()); } else { ?>{$lblSignUpForm|ucfirst}<?php } ?> <?php if(isset($this->variables['settings']) && array_key_exists('year', (array) $this->variables['settings'])) { echo $this->variables['settings']['year']; } elseif(is_object($this->variables['settings']) && method_exists($this->variables['settings'], 'getYear')) { echo $this->variables['settings']->getYear(); } else { ?>{$settings.year}<?php } ?></span></h1>
                        </header>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 info-box">
                        <?php
						if(!isset($this->variables['startDates']))
						{
							?>{iteration:startDates}<?php
							$this->variables['startDates'] = array();
							$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_1']['fail'] = true;
						}
					$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_1']['iteration'] = $this->variables['startDates'];
				if(isset(${'startDates'})) $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_1']['old'] = ${'startDates'};
				$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_1']['i'] = 1;
				$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_1']['count'] = count($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_1']['iteration']);
				foreach($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_1']['iteration'] as ${'startDates'})
				{
					if(is_array(${'startDates'}))
					{
						if(!isset(${'startDates'}['first']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_1']['i'] == 1) ${'startDates'}['first'] = true;
						if(!isset(${'startDates'}['last']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_1']['i'] == $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_1']['count']) ${'startDates'}['last'] = true;
						if(isset(${'startDates'}['formElements']) && is_array(${'startDates'}['formElements']))
						{
							foreach(${'startDates'}['formElements'] as $name => $object)
							{
								${'startDates'}[$name] = $object->parse();
								${'startDates'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
                        <div class="dates">
                            <p><?php if(array_key_exists('lblStage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblStage']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblStage')) { echo SpoonFilter::ucfirst($this->variables->getLblStage()); } else { ?>{$lblStage|ucfirst}<?php } ?>: <span><?php if(array_key_exists('stage', (array) ${'startDates'})) { echo ${'startDates'}['stage']; } elseif(is_object(${'startDates'}) && method_exists(${'startDates'}, 'getStage')) { echo ${'startDates'}->getStage(); } else { ?>{$startDates->stage}<?php } ?></span><br />
                            <?php if(array_key_exists('lblTime', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTime']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblTime')) { echo SpoonFilter::ucfirst($this->variables->getLblTime()); } else { ?>{$lblTime|ucfirst}<?php } ?>: <span><?php if(array_key_exists('date', (array) ${'startDates'})) { echo ${'startDates'}['date']; } elseif(is_object(${'startDates'}) && method_exists(${'startDates'}, 'getDate')) { echo ${'startDates'}->getDate(); } else { ?>{$startDates->date}<?php } ?></span> <?php if(array_key_exists('lblAt', (array) $this->variables)) { echo $this->variables['lblAt']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblAt')) { echo $this->variables->getLblAt(); } else { ?>{$lblAt}<?php } ?> <span><?php if(array_key_exists('time', (array) ${'startDates'})) { echo ${'startDates'}['time']; } elseif(is_object(${'startDates'}) && method_exists(${'startDates'}, 'getTime')) { echo ${'startDates'}->getTime(); } else { ?>{$startDates->time}<?php } ?></span></p>
                        </div>
                        <?php
					$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_1']['fail']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:startDates}<?php
					}
				if(isset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_1']['old'])) ${'startDates'} = $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_1']['old'];
				else unset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_1']);
				?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 bottom20 info-box">
                        <p>
                            <?php if(array_key_exists('msgPracticalInfoText', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['msgPracticalInfoText']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgPracticalInfoText')) { echo SpoonFilter::ucfirst($this->variables->getMsgPracticalInfoText()); } else { ?>{$msgPracticalInfoText|ucfirst}<?php } ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 bottom20 info-box">
                        <p>
                            <?php if(array_key_exists('msgTerrainText', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['msgTerrainText']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgTerrainText')) { echo SpoonFilter::ucfirst($this->variables->getMsgTerrainText()); } else { ?>{$msgTerrainText|ucfirst}<?php } ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 info-box">
                        <div class="dates">
                            <p>
                                <?php if(array_key_exists('msgBilling', (array) $this->variables)) { echo $this->variables['msgBilling']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgBilling')) { echo $this->variables->getMsgBilling(); } else { ?>{$msgBilling}<?php } ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                        <div class="box-highlight">
                            <p><?php if(array_key_exists('msgDeadLineWebsite', (array) $this->variables)) { echo $this->variables['msgDeadLineWebsite']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgDeadLineWebsite')) { echo $this->variables->getMsgDeadLineWebsite(); } else { ?>{$msgDeadLineWebsite}<?php } ?></p>
                        </div>
                    </div>
                </div>

                <?php
						if(isset($this->variables['error']) && empty($this->variables['error']) === false)
						{
							?>
                <div class="row box-error">
                    <div class="col-md-12">
                        <p><?php if(array_key_exists('fileTechnicalError', (array) $this->variables)) { echo $this->variables['fileTechnicalError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFileTechnicalError')) { echo $this->variables->getFileTechnicalError(); } else { ?>{$fileTechnicalError}<?php } ?></p>
                        <p><?php if(array_key_exists('fileCoverError', (array) $this->variables)) { echo $this->variables['fileCoverError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFileCoverError')) { echo $this->variables->getFileCoverError(); } else { ?>{$fileCoverError}<?php } ?></p>
                        <p><?php if(array_key_exists('fileStageError', (array) $this->variables)) { echo $this->variables['fileStageError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFileStageError')) { echo $this->variables->getFileStageError(); } else { ?>{$fileStageError}<?php } ?></p>
                        <p><?php if(array_key_exists('fileContractError', (array) $this->variables)) { echo $this->variables['fileContractError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFileContractError')) { echo $this->variables->getFileContractError(); } else { ?>{$fileContractError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtContactPhoneError', (array) $this->variables)) { echo $this->variables['txtContactPhoneError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtContactPhoneError')) { echo $this->variables->getTxtContactPhoneError(); } else { ?>{$txtContactPhoneError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtContactNameError', (array) $this->variables)) { echo $this->variables['txtContactNameError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtContactNameError')) { echo $this->variables->getTxtContactNameError(); } else { ?>{$txtContactNameError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtContactEmailError', (array) $this->variables)) { echo $this->variables['txtContactEmailError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtContactEmailError')) { echo $this->variables->getTxtContactEmailError(); } else { ?>{$txtContactEmailError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtContactFirstNameError', (array) $this->variables)) { echo $this->variables['txtContactFirstNameError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtContactFirstNameError')) { echo $this->variables->getTxtContactFirstNameError(); } else { ?>{$txtContactFirstNameError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtFacebookError', (array) $this->variables)) { echo $this->variables['txtFacebookError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtFacebookError')) { echo $this->variables->getTxtFacebookError(); } else { ?>{$txtFacebookError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtTwitterError', (array) $this->variables)) { echo $this->variables['txtTwitterError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtTwitterError')) { echo $this->variables->getTxtTwitterError(); } else { ?>{$txtTwitterError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtYoutubeError', (array) $this->variables)) { echo $this->variables['txtYoutubeError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtYoutubeError')) { echo $this->variables->getTxtYoutubeError(); } else { ?>{$txtYoutubeError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtWebsiteError', (array) $this->variables)) { echo $this->variables['txtWebsiteError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtWebsiteError')) { echo $this->variables->getTxtWebsiteError(); } else { ?>{$txtWebsiteError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtInstagramError', (array) $this->variables)) { echo $this->variables['txtInstagramError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtInstagramError')) { echo $this->variables->getTxtInstagramError(); } else { ?>{$txtInstagramError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtSoundcloudError', (array) $this->variables)) { echo $this->variables['txtSoundcloudError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtSoundcloudError')) { echo $this->variables->getTxtSoundcloudError(); } else { ?>{$txtSoundcloudError}<?php } ?></p>
                    </div>
                </div>
                <?php } ?>

                <h2><?php if(array_key_exists('lblContactPerson', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblContactPerson']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblContactPerson')) { echo SpoonFilter::ucfirst($this->variables->getLblContactPerson()); } else { ?>{$lblContactPerson|ucfirst}<?php } ?>
                    <span class="pull-right" data-toggle="tooltip" data-placement="left" title="<?php if(array_key_exists('msgContactPerson', (array) $this->variables)) { echo $this->variables['msgContactPerson']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgContactPerson')) { echo $this->variables->getMsgContactPerson(); } else { ?>{$msgContactPerson}<?php } ?>"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/icon_information.svg" /></span>
                </h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group<?php
						if(isset($this->variables['txtContactFirstNameError']) && empty($this->variables['txtContactFirstNameError']) === false)
						{
							?> errorArea<?php } ?>">
                            <?php if(array_key_exists('txtContactFirstName', (array) $this->variables)) { echo $this->variables['txtContactFirstName']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtContactFirstName')) { echo $this->variables->getTxtContactFirstName(); } else { ?>{$txtContactFirstName}<?php } ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group<?php
						if(isset($this->variables['txtContactNameError']) && empty($this->variables['txtContactNameError']) === false)
						{
							?> errorArea<?php } ?>">
                            <?php if(array_key_exists('txtContactName', (array) $this->variables)) { echo $this->variables['txtContactName']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtContactName')) { echo $this->variables->getTxtContactName(); } else { ?>{$txtContactName}<?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group<?php
						if(isset($this->variables['txtContactEmailError']) && empty($this->variables['txtContactEmailError']) === false)
						{
							?> errorArea<?php } ?>">
                            <?php if(array_key_exists('txtContactEmail', (array) $this->variables)) { echo $this->variables['txtContactEmail']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtContactEmail')) { echo $this->variables->getTxtContactEmail(); } else { ?>{$txtContactEmail}<?php } ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group<?php
						if(isset($this->variables['txtContactPhoneError']) && empty($this->variables['txtContactPhoneError']) === false)
						{
							?> errorArea<?php } ?>">
                            <?php if(array_key_exists('txtContactPhone', (array) $this->variables)) { echo $this->variables['txtContactPhone']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtContactPhone')) { echo $this->variables->getTxtContactPhone(); } else { ?>{$txtContactPhone}<?php } ?>
                        </div>
                    </div>
                </div>

                <h2><?php if(array_key_exists('lblWebsiteInfo', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblWebsiteInfo']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblWebsiteInfo')) { echo SpoonFilter::ucfirst($this->variables->getLblWebsiteInfo()); } else { ?>{$lblWebsiteInfo|ucfirst}<?php } ?></h2>
								<div class="row">
									<div class="col-md-12 info-box">
										<p>
											<?php if(array_key_exists('msgWebsiteInfo', (array) $this->variables)) { echo $this->variables['msgWebsiteInfo']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgWebsiteInfo')) { echo $this->variables->getMsgWebsiteInfo(); } else { ?>{$msgWebsiteInfo}<?php } ?>
										</p>
									</div>
								</div>

                <h3><?php if(array_key_exists('lblCover', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblCover']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblCover')) { echo SpoonFilter::ucfirst($this->variables->getLblCover()); } else { ?>{$lblCover|ucfirst}<?php } ?><span class="pull-right" data-toggle="tooltip" data-placement="left" title="<?php if(array_key_exists('msgCover', (array) $this->variables)) { echo $this->variables['msgCover']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgCover')) { echo $this->variables->getMsgCover(); } else { ?>{$msgCover}<?php } ?>"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/icon_information.svg" /></span></h3>
                <div class="row">
                    <div class="col-md-6">
                        <?php
						if(isset($this->variables['closed']) && empty($this->variables['closed']) === false)
						{
							?>
                            <?php if(!isset($this->variables['item']['cover']) || empty($this->variables['item']['cover']) === true): ?>
                                <div class="info-box">
                                    <p><?php if(array_key_exists('msgNoCover', (array) $this->variables)) { echo $this->variables['msgNoCover']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgNoCover')) { echo $this->variables->getMsgNoCover(); } else { ?>{$msgNoCover}<?php } ?></p>
                                </div>
                            <?php endif; ?>
                        <?php } ?>
                        <?php
						if(isset($this->variables['item']['cover']) && empty($this->variables['item']['cover']) === false)
						{
							?>
                            <div class="info-box uploaded-file">
                                <p><?php if(array_key_exists('lblUploadedFile', (array) $this->variables)) { echo $this->variables['lblUploadedFile']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblUploadedFile')) { echo $this->variables->getLblUploadedFile(); } else { ?>{$lblUploadedFile}<?php } ?> <span class="underline">(<?php if(isset($this->variables['item']) && array_key_exists('cover', (array) $this->variables['item'])) { echo $this->variables['item']['cover']; } elseif(is_object($this->variables['item']) && method_exists($this->variables['item'], 'getCover')) { echo $this->variables['item']->getCover(); } else { ?>{$item.cover}<?php } ?>)</span></p>
                            </div>
                            <div class="downloadFile row">
                                <div class="col-md-12 bottom20">
                                    <img src="<?php if(array_key_exists('FRONTEND_FILES_URL', (array) $this->variables)) { echo $this->variables['FRONTEND_FILES_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFRONTENDFILESURL')) { echo $this->variables->getFRONTENDFILESURL(); } else { ?>{$FRONTEND_FILES_URL}<?php } ?>/festival/artists/covers/x330/<?php if(isset($this->variables['item']) && array_key_exists('cover', (array) $this->variables['item'])) { echo $this->variables['item']['cover']; } elseif(is_object($this->variables['item']) && method_exists($this->variables['item'], 'getCover')) { echo $this->variables['item']->getCover(); } else { ?>{$item.cover}<?php } ?>" />
                                </div>
                                <div class="btn-group col-md-12" data-toggle="buttons">
                                    <?php
						if(isset($this->variables['chkDeleteCover']) && empty($this->variables['chkDeleteCover']) === false)
						{
							?>
                                        <div class="form-group">
                                            <label for="deleteCover" class="btn btn-round">
                                                <?php if(array_key_exists('chkDeleteCover', (array) $this->variables)) { echo $this->variables['chkDeleteCover']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getChkDeleteCover')) { echo $this->variables->getChkDeleteCover(); } else { ?>{$chkDeleteCover}<?php } ?>
                                                <span class="circle-border chk">&nbsp;</span>
                                                <span class="lbl-text"><?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblDelete')) { echo SpoonFilter::ucfirst($this->variables->getLblDelete()); } else { ?>{$lblDelete|ucfirst}<?php } ?></span>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
						if(isset($this->variables['fileCover']) && empty($this->variables['fileCover']) === false)
						{
							?>
                            <div class="form-group upload-group<?php
						if(isset($this->variables['fileCoverError']) && empty($this->variables['fileCoverError']) === false)
						{
							?> errorArea<?php } ?>">
                                <?php if(array_key_exists('fileCover', (array) $this->variables)) { echo $this->variables['fileCover']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFileCover')) { echo $this->variables->getFileCover(); } else { ?>{$fileCover}<?php } ?>
                                <input type="text" name="" placeholder="<?php if(array_key_exists('lblUploadCover', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblUploadCover']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblUploadCover')) { echo SpoonFilter::ucfirst($this->variables->getLblUploadCover()); } else { ?>{$lblUploadCover|ucfirst}<?php } ?>" class="form-control form-upload">
                                <span class="helpTxt"><?php if(array_key_exists('msgHelpMaxFileSizeMB', (array) $this->variables) && isset($this->variables['settings']) && array_key_exists('image_size_limit', (array) $this->variables['settings'])) { echo sprintf($this->variables['msgHelpMaxFileSizeMB'], $this->variables['settings']['image_size_limit']); } elseif(is_object($this->variables['settings']) && method_exists($this->variables['settings'], 'getImageSizeLimit')) { echo ""; throw new Exception('Variables in modifiers on objects are not supported.');; } else { ?>{$msgHelpMaxFileSizeMB|sprintf:<?php if(isset($this->variables['settings']) && array_key_exists('image_size_limit', (array) $this->variables['settings'])) { echo $this->variables['settings']['image_size_limit']; } elseif(is_object($this->variables['settings']) && method_exists($this->variables['settings'], 'getImageSizeLimit')) { echo $this->variables['settings']->getImageSizeLimit(); } else { ?>{$settings.image_size_limit}<?php } ?>}<?php } ?></span>
                                <div class="upload"></div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <h3 class=""><?php if(array_key_exists('lblSocialMedia', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSocialMedia']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblSocialMedia')) { echo SpoonFilter::ucfirst($this->variables->getLblSocialMedia()); } else { ?>{$lblSocialMedia|ucfirst}<?php } ?><span class="pull-right" data-toggle="tooltip" data-placement="left" title="<?php if(array_key_exists('msgSocialUrl', (array) $this->variables)) { echo $this->variables['msgSocialUrl']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgSocialUrl')) { echo $this->variables->getMsgSocialUrl(); } else { ?>{$msgSocialUrl}<?php } ?>"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/icon_information.svg" /></span></h3>
                <div class="row social-media">
                    <div class="col-md-1 icon-social">
                        <img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/social_fb.svg" title="facebook" alt="facebook"/>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group<?php
						if(isset($this->variables['txtFacebookError']) && empty($this->variables['txtFacebookError']) === false)
						{
							?> errorArea<?php } ?>">
                            <?php if(array_key_exists('txtFacebook', (array) $this->variables)) { echo $this->variables['txtFacebook']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtFacebook')) { echo $this->variables->getTxtFacebook(); } else { ?>{$txtFacebook}<?php } ?>
                            <p class="js-error hidden"><?php if(array_key_exists('errUrl', (array) $this->variables)) { echo $this->variables['errUrl']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getErrUrl')) { echo $this->variables->getErrUrl(); } else { ?>{$errUrl}<?php } ?></p>
                        </div>
                    </div>
                    <div class="col-md-1 icon-social">
                        <img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/social_tw.svg" title="twitter" alt="twitter"/>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group<?php
						if(isset($this->variables['txtTwitterError']) && empty($this->variables['txtTwitterError']) === false)
						{
							?> errorArea<?php } ?>">
                            <?php if(array_key_exists('txtTwitter', (array) $this->variables)) { echo $this->variables['txtTwitter']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtTwitter')) { echo $this->variables->getTxtTwitter(); } else { ?>{$txtTwitter}<?php } ?>
                            <p class="js-error hidden"><?php if(array_key_exists('errUrl', (array) $this->variables)) { echo $this->variables['errUrl']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getErrUrl')) { echo $this->variables->getErrUrl(); } else { ?>{$errUrl}<?php } ?></p>
                        </div>
                    </div>
                </div>
                <div class="row social-media">
                    <div class="col-md-1 icon-social">
                        <img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/social_yt.svg" title="youtube" alt="youtube"/>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group<?php
						if(isset($this->variables['txtYoutubeError']) && empty($this->variables['txtYoutubeError']) === false)
						{
							?> errorArea<?php } ?>">
                            <?php if(array_key_exists('txtYoutube', (array) $this->variables)) { echo $this->variables['txtYoutube']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtYoutube')) { echo $this->variables->getTxtYoutube(); } else { ?>{$txtYoutube}<?php } ?>
                            <p class="js-error hidden"><?php if(array_key_exists('errUrl', (array) $this->variables)) { echo $this->variables['errUrl']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getErrUrl')) { echo $this->variables->getErrUrl(); } else { ?>{$errUrl}<?php } ?></p>
                        </div>
                    </div>
                    <div class="col-md-1 icon-social">
                        <img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/social_insta.svg" title="instagram" alt="instagram"/>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group<?php
						if(isset($this->variables['txtInstagramError']) && empty($this->variables['txtInstagramError']) === false)
						{
							?> errorArea<?php } ?>">
                            <?php if(array_key_exists('txtInstagram', (array) $this->variables)) { echo $this->variables['txtInstagram']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtInstagram')) { echo $this->variables->getTxtInstagram(); } else { ?>{$txtInstagram}<?php } ?>
                            <p class="js-error hidden"><?php if(array_key_exists('errUrl', (array) $this->variables)) { echo $this->variables['errUrl']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getErrUrl')) { echo $this->variables->getErrUrl(); } else { ?>{$errUrl}<?php } ?></p>
                        </div>
                    </div>
                </div>
                <div class="row social-media">
                    <div class="col-md-1 icon-social">
                        <img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/social_so.svg" title="soundcloud" alt="soundcloud"/>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group<?php
						if(isset($this->variables['txtSoundcloudError']) && empty($this->variables['txtSoundcloudError']) === false)
						{
							?> errorArea<?php } ?>">
                            <?php if(array_key_exists('txtSoundcloud', (array) $this->variables)) { echo $this->variables['txtSoundcloud']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtSoundcloud')) { echo $this->variables->getTxtSoundcloud(); } else { ?>{$txtSoundcloud}<?php } ?>
                            <p class="js-error hidden"><?php if(array_key_exists('errUrl', (array) $this->variables)) { echo $this->variables['errUrl']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getErrUrl')) { echo $this->variables->getErrUrl(); } else { ?>{$errUrl}<?php } ?></p>
                        </div>
                    </div>
                    <div class="col-md-1 icon-social">
                    <img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/social_web.svg" title="web" alt="web"/>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group<?php
						if(isset($this->variables['txtWebsiteError']) && empty($this->variables['txtWebsiteError']) === false)
						{
							?> errorArea<?php } ?>">
                            <?php if(array_key_exists('txtWebsite', (array) $this->variables)) { echo $this->variables['txtWebsite']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtWebsite')) { echo $this->variables->getTxtWebsite(); } else { ?>{$txtWebsite}<?php } ?>
                            <p class="js-error hidden"><?php if(array_key_exists('errUrl', (array) $this->variables)) { echo $this->variables['errUrl']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getErrUrl')) { echo $this->variables->getErrUrl(); } else { ?>{$errUrl}<?php } ?></p>
                        </div>
                    </div>
                </div>

                <h3><?php if(array_key_exists('lblBio', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblBio']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblBio')) { echo SpoonFilter::ucfirst($this->variables->getLblBio()); } else { ?>{$lblBio|ucfirst}<?php } ?></h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group<?php
						if(isset($this->variables['txtBioError']) && empty($this->variables['txtBioError']) === false)
						{
							?> errorArea<?php } ?>">
                            <?php if(array_key_exists('txtBio', (array) $this->variables)) { echo $this->variables['txtBio']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtBio')) { echo $this->variables->getTxtBio(); } else { ?>{$txtBio}<?php } ?> <?php if(array_key_exists('txtBioError', (array) $this->variables)) { echo $this->variables['txtBioError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtBioError')) { echo $this->variables->getTxtBioError(); } else { ?>{$txtBioError}<?php } ?>
                        </div>
                    </div>
                </div>

                <h2><?php if(array_key_exists('lblPracticalInfo', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPracticalInfo']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblPracticalInfo')) { echo SpoonFilter::ucfirst($this->variables->getLblPracticalInfo()); } else { ?>{$lblPracticalInfo|ucfirst}<?php } ?></h2>
								<div class="row">
									<div class="col-md-12 info-box">
										<p>
											<?php if(array_key_exists('msgPracticalInfo', (array) $this->variables)) { echo $this->variables['msgPracticalInfo']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgPracticalInfo')) { echo $this->variables->getMsgPracticalInfo(); } else { ?>{$msgPracticalInfo}<?php } ?>
										</p>
									</div>
								</div>
                <h3 class="top20"><?php if(array_key_exists('lblFiles', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFiles']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFiles')) { echo SpoonFilter::ucfirst($this->variables->getLblFiles()); } else { ?>{$lblFiles|ucfirst}<?php } ?></h3>
                <div class="row">
                    <div class="col-md-6">
                        <?php if(!isset($this->variables['fileContract']) || empty($this->variables['fileContract']) === true): ?>
                            <?php if(!isset($this->variables['item']['practical']['0']['contractFilename']) || empty($this->variables['item']['practical']['0']['contractFilename']) === true): ?>
                                <div class="info-box">
                                    <p><?php if(array_key_exists('msgNoFileContract', (array) $this->variables)) { echo $this->variables['msgNoFileContract']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgNoFileContract')) { echo $this->variables->getMsgNoFileContract(); } else { ?>{$msgNoFileContract}<?php } ?></p>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php
						if(isset($this->variables['item']['practical']['0']['contractFilename']) && empty($this->variables['item']['practical']['0']['contractFilename']) === false)
						{
							?>
                            <div class="info-box uploaded-file">
                                <p><?php if(array_key_exists('lblUploadedFile', (array) $this->variables)) { echo $this->variables['lblUploadedFile']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblUploadedFile')) { echo $this->variables->getLblUploadedFile(); } else { ?>{$lblUploadedFile}<?php } ?> <span class="underline">(<?php if(isset($this->variables['item']['practical']['0']) && array_key_exists('contractFilename', (array) $this->variables['item']['practical']['0'])) { echo $this->variables['item']['practical']['0']['contractFilename']; } elseif(is_object($this->variables['item']['practical']['0']) && method_exists($this->variables['item']['practical']['0'], 'getContractFilename')) { echo $this->variables['item']['practical']['0']->getContractFilename(); } else { ?>{$item.practical.0.contractFilename}<?php } ?>)</span></p>
                            </div>
                            <div class="downloadFile row">
                                <div class="col-md-6">
                                    <a class="btn-download-file" href="<?php if(array_key_exists('FRONTEND_FILES_URL', (array) $this->variables)) { echo $this->variables['FRONTEND_FILES_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFRONTENDFILESURL')) { echo $this->variables->getFRONTENDFILESURL(); } else { ?>{$FRONTEND_FILES_URL}<?php } ?>/festival/artists/files/contract/<?php if(isset($this->variables['item']['practical']['0']) && array_key_exists('contractFilename', (array) $this->variables['item']['practical']['0'])) { echo $this->variables['item']['practical']['0']['contractFilename']; } elseif(is_object($this->variables['item']['practical']['0']) && method_exists($this->variables['item']['practical']['0'], 'getContractFilename')) { echo $this->variables['item']['practical']['0']->getContractFilename(); } else { ?>{$item.practical.0.contractFilename}<?php } ?>" target="_blank"><?php if(array_key_exists('lblDownload', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDownload']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblDownload')) { echo SpoonFilter::ucfirst($this->variables->getLblDownload()); } else { ?>{$lblDownload|ucfirst}<?php } ?></a>
                                </div>
                                <div class="btn-group col-md-6" data-toggle="buttons">
                                    <?php
						if(isset($this->variables['chkDeleteContract']) && empty($this->variables['chkDeleteContract']) === false)
						{
							?>
                                        <div class="form-group">
                                            <label for="deleteContract" class="btn btn-round">
                                                <?php if(array_key_exists('chkDeleteContract', (array) $this->variables)) { echo $this->variables['chkDeleteContract']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getChkDeleteContract')) { echo $this->variables->getChkDeleteContract(); } else { ?>{$chkDeleteContract}<?php } ?>
                                                <span class="circle-border chk">&nbsp;</span>
                                                <span class="lbl-text"><?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblDelete')) { echo SpoonFilter::ucfirst($this->variables->getLblDelete()); } else { ?>{$lblDelete|ucfirst}<?php } ?></span>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
						if(isset($this->variables['fileContract']) && empty($this->variables['fileContract']) === false)
						{
							?>
                            <div class="form-group upload-group<?php
						if(isset($this->variables['fileContractError']) && empty($this->variables['fileContractError']) === false)
						{
							?> errorArea<?php } ?>">
                                <?php if(array_key_exists('fileContract', (array) $this->variables)) { echo $this->variables['fileContract']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFileContract')) { echo $this->variables->getFileContract(); } else { ?>{$fileContract}<?php } ?>
                                <input type="text" name="" placeholder="<?php if(array_key_exists('msgFileContract', (array) $this->variables)) { echo $this->variables['msgFileContract']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgFileContract')) { echo $this->variables->getMsgFileContract(); } else { ?>{$msgFileContract}<?php } ?>" class="form-control form-upload">
                                <span class="helpTxt"><?php if(array_key_exists('msgHelpMaxFileSizeMB', (array) $this->variables) && isset($this->variables['settings']) && array_key_exists('file_size_limit', (array) $this->variables['settings'])) { echo sprintf($this->variables['msgHelpMaxFileSizeMB'], $this->variables['settings']['file_size_limit']); } elseif(is_object($this->variables['settings']) && method_exists($this->variables['settings'], 'getFileSizeLimit')) { echo ""; throw new Exception('Variables in modifiers on objects are not supported.');; } else { ?>{$msgHelpMaxFileSizeMB|sprintf:<?php if(isset($this->variables['settings']) && array_key_exists('file_size_limit', (array) $this->variables['settings'])) { echo $this->variables['settings']['file_size_limit']; } elseif(is_object($this->variables['settings']) && method_exists($this->variables['settings'], 'getFileSizeLimit')) { echo $this->variables['settings']->getFileSizeLimit(); } else { ?>{$settings.file_size_limit}<?php } ?>}<?php } ?></span>
                                <div class="upload"></div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <?php if(!isset($this->variables['fileTechnical']) || empty($this->variables['fileTechnical']) === true): ?>
                            <?php if(!isset($this->variables['item']['practical']['0']['technicalFilename']) || empty($this->variables['item']['practical']['0']['technicalFilename']) === true): ?>
                                <div class="info-box">
                                    <p><?php if(array_key_exists('msgNoFileTechnical', (array) $this->variables)) { echo $this->variables['msgNoFileTechnical']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgNoFileTechnical')) { echo $this->variables->getMsgNoFileTechnical(); } else { ?>{$msgNoFileTechnical}<?php } ?></p>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php
						if(isset($this->variables['item']['practical']['0']['technicalFilename']) && empty($this->variables['item']['practical']['0']['technicalFilename']) === false)
						{
							?>
                            <div class="info-box uploaded-file">
                                <p><?php if(array_key_exists('lblUploadedFile', (array) $this->variables)) { echo $this->variables['lblUploadedFile']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblUploadedFile')) { echo $this->variables->getLblUploadedFile(); } else { ?>{$lblUploadedFile}<?php } ?> <span class="underline">(<?php if(isset($this->variables['item']['practical']['0']) && array_key_exists('technicalFilename', (array) $this->variables['item']['practical']['0'])) { echo $this->variables['item']['practical']['0']['technicalFilename']; } elseif(is_object($this->variables['item']['practical']['0']) && method_exists($this->variables['item']['practical']['0'], 'getTechnicalFilename')) { echo $this->variables['item']['practical']['0']->getTechnicalFilename(); } else { ?>{$item.practical.0.technicalFilename}<?php } ?>)</span></p>
                            </div>
                            <div class="downloadFile row">
                                <div class="col-md-6">
                                    <a class="btn-download-file" href="<?php if(array_key_exists('FRONTEND_FILES_URL', (array) $this->variables)) { echo $this->variables['FRONTEND_FILES_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFRONTENDFILESURL')) { echo $this->variables->getFRONTENDFILESURL(); } else { ?>{$FRONTEND_FILES_URL}<?php } ?>/festival/artists/files/technical/<?php if(isset($this->variables['item']['practical']['0']) && array_key_exists('technicalFilename', (array) $this->variables['item']['practical']['0'])) { echo $this->variables['item']['practical']['0']['technicalFilename']; } elseif(is_object($this->variables['item']['practical']['0']) && method_exists($this->variables['item']['practical']['0'], 'getTechnicalFilename')) { echo $this->variables['item']['practical']['0']->getTechnicalFilename(); } else { ?>{$item.practical.0.technicalFilename}<?php } ?>" target="_blank"><?php if(array_key_exists('lblDownload', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDownload']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblDownload')) { echo SpoonFilter::ucfirst($this->variables->getLblDownload()); } else { ?>{$lblDownload|ucfirst}<?php } ?></a>
                                </div>
                                <div class="btn-group col-md-6" data-toggle="buttons">
                                    <?php
						if(isset($this->variables['chkDeleteTechnical']) && empty($this->variables['chkDeleteTechnical']) === false)
						{
							?>
                                        <div class="form-group">
                                            <label for="deleteTechnical" class="btn btn-round">
                                                <?php if(array_key_exists('chkDeleteTechnical', (array) $this->variables)) { echo $this->variables['chkDeleteTechnical']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getChkDeleteTechnical')) { echo $this->variables->getChkDeleteTechnical(); } else { ?>{$chkDeleteTechnical}<?php } ?>
                                                <span class="circle-border chk">&nbsp;</span>
                                                <span class="lbl-text"><?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblDelete')) { echo SpoonFilter::ucfirst($this->variables->getLblDelete()); } else { ?>{$lblDelete|ucfirst}<?php } ?></span>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
						if(isset($this->variables['fileTechnical']) && empty($this->variables['fileTechnical']) === false)
						{
							?>
                            <div class="form-group upload-group<?php
						if(isset($this->variables['fileTechnicalError']) && empty($this->variables['fileTechnicalError']) === false)
						{
							?> errorArea<?php } ?>">
                                <?php if(array_key_exists('fileTechnical', (array) $this->variables)) { echo $this->variables['fileTechnical']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFileTechnical')) { echo $this->variables->getFileTechnical(); } else { ?>{$fileTechnical}<?php } ?>
                                <input type="text" name="" placeholder="<?php if(array_key_exists('msgFileTechnical', (array) $this->variables)) { echo $this->variables['msgFileTechnical']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgFileTechnical')) { echo $this->variables->getMsgFileTechnical(); } else { ?>{$msgFileTechnical}<?php } ?>" class="form-control form-upload">
                                <span class="helpTxt"><?php if(array_key_exists('msgHelpMaxFileSizeMB', (array) $this->variables) && isset($this->variables['settings']) && array_key_exists('file_size_limit', (array) $this->variables['settings'])) { echo sprintf($this->variables['msgHelpMaxFileSizeMB'], $this->variables['settings']['file_size_limit']); } elseif(is_object($this->variables['settings']) && method_exists($this->variables['settings'], 'getFileSizeLimit')) { echo ""; throw new Exception('Variables in modifiers on objects are not supported.');; } else { ?>{$msgHelpMaxFileSizeMB|sprintf:<?php if(isset($this->variables['settings']) && array_key_exists('file_size_limit', (array) $this->variables['settings'])) { echo $this->variables['settings']['file_size_limit']; } elseif(is_object($this->variables['settings']) && method_exists($this->variables['settings'], 'getFileSizeLimit')) { echo $this->variables['settings']->getFileSizeLimit(); } else { ?>{$settings.file_size_limit}<?php } ?>}<?php } ?></span>
                                <div class="upload"></div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <h3 class="top20">Stageplan & Extra</h3>
                <div class="row">
                    <div class="col-md-6">
                        <?php if(!isset($this->variables['fileStage']) || empty($this->variables['fileStage']) === true): ?>
                            <?php if(!isset($this->variables['item']['practical']['0']['stageFilename']) || empty($this->variables['item']['practical']['0']['stageFilename']) === true): ?>
                                <div class="info-box">
                                    <p><?php if(array_key_exists('msgNoFileStage', (array) $this->variables)) { echo $this->variables['msgNoFileStage']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgNoFileStage')) { echo $this->variables->getMsgNoFileStage(); } else { ?>{$msgNoFileStage}<?php } ?></p>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php
						if(isset($this->variables['item']['practical']['0']['stageFilename']) && empty($this->variables['item']['practical']['0']['stageFilename']) === false)
						{
							?>
                            <div class="info-box uploaded-file">
                                <p><?php if(array_key_exists('lblUploadedFile', (array) $this->variables)) { echo $this->variables['lblUploadedFile']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblUploadedFile')) { echo $this->variables->getLblUploadedFile(); } else { ?>{$lblUploadedFile}<?php } ?><span class="underline">(<?php if(isset($this->variables['item']['practical']['0']) && array_key_exists('stageFilename', (array) $this->variables['item']['practical']['0'])) { echo $this->variables['item']['practical']['0']['stageFilename']; } elseif(is_object($this->variables['item']['practical']['0']) && method_exists($this->variables['item']['practical']['0'], 'getStageFilename')) { echo $this->variables['item']['practical']['0']->getStageFilename(); } else { ?>{$item.practical.0.stageFilename}<?php } ?>)</span></p>
                            </div>
                            <div class="downloadFile row">
                                <div class="col-md-6">
                                    <a class="btn-download-file" href="<?php if(array_key_exists('FRONTEND_FILES_URL', (array) $this->variables)) { echo $this->variables['FRONTEND_FILES_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFRONTENDFILESURL')) { echo $this->variables->getFRONTENDFILESURL(); } else { ?>{$FRONTEND_FILES_URL}<?php } ?>/festival/artists/files/stages/<?php if(isset($this->variables['item']['practical']['0']) && array_key_exists('stageFilename', (array) $this->variables['item']['practical']['0'])) { echo $this->variables['item']['practical']['0']['stageFilename']; } elseif(is_object($this->variables['item']['practical']['0']) && method_exists($this->variables['item']['practical']['0'], 'getStageFilename')) { echo $this->variables['item']['practical']['0']->getStageFilename(); } else { ?>{$item.practical.0.stageFilename}<?php } ?>" target="_blank"><?php if(array_key_exists('lblDownload', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDownload']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblDownload')) { echo SpoonFilter::ucfirst($this->variables->getLblDownload()); } else { ?>{$lblDownload|ucfirst}<?php } ?></a>
                                </div>
                                <div class="btn-group col-md-6" data-toggle="buttons">
                                    <?php
						if(isset($this->variables['chkDeleteStage']) && empty($this->variables['chkDeleteStage']) === false)
						{
							?>
                                        <div class="form-group">
                                            <label for="deleteStage" class="btn btn-round">
                                                <?php if(array_key_exists('chkDeleteStage', (array) $this->variables)) { echo $this->variables['chkDeleteStage']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getChkDeleteStage')) { echo $this->variables->getChkDeleteStage(); } else { ?>{$chkDeleteStage}<?php } ?>
                                                <span class="circle-border chk">&nbsp;</span>
                                                <span class="lbl-text"><?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblDelete')) { echo SpoonFilter::ucfirst($this->variables->getLblDelete()); } else { ?>{$lblDelete|ucfirst}<?php } ?></span>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
						if(isset($this->variables['fileStage']) && empty($this->variables['fileStage']) === false)
						{
							?>
                            <div class="form-group upload-group<?php
						if(isset($this->variables['fileStageError']) && empty($this->variables['fileStageError']) === false)
						{
							?> errorArea<?php } ?>">
                                <?php if(array_key_exists('fileStage', (array) $this->variables)) { echo $this->variables['fileStage']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFileStage')) { echo $this->variables->getFileStage(); } else { ?>{$fileStage}<?php } ?>
                                <input type="text" name="" placeholder="<?php if(array_key_exists('msgFileStage', (array) $this->variables)) { echo $this->variables['msgFileStage']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgFileStage')) { echo $this->variables->getMsgFileStage(); } else { ?>{$msgFileStage}<?php } ?>" class="form-control form-upload">
                                <span class="helpTxt"><?php if(array_key_exists('msgHelpMaxFileSizeMB', (array) $this->variables) && isset($this->variables['settings']) && array_key_exists('file_size_limit', (array) $this->variables['settings'])) { echo sprintf($this->variables['msgHelpMaxFileSizeMB'], $this->variables['settings']['file_size_limit']); } elseif(is_object($this->variables['settings']) && method_exists($this->variables['settings'], 'getFileSizeLimit')) { echo ""; throw new Exception('Variables in modifiers on objects are not supported.');; } else { ?>{$msgHelpMaxFileSizeMB|sprintf:<?php if(isset($this->variables['settings']) && array_key_exists('file_size_limit', (array) $this->variables['settings'])) { echo $this->variables['settings']['file_size_limit']; } elseif(is_object($this->variables['settings']) && method_exists($this->variables['settings'], 'getFileSizeLimit')) { echo $this->variables['settings']->getFileSizeLimit(); } else { ?>{$settings.file_size_limit}<?php } ?>}<?php } ?></span>
                                <div class="upload"></div>
                            </div>
                        <?php } ?>
                    </div>
                     <div class="col-md-6">
                        <?php if(!isset($this->variables['fileExtra']) || empty($this->variables['fileExtra']) === true): ?>
                            <?php if(!isset($this->variables['item']['practical']['0']['extraFilename']) || empty($this->variables['item']['practical']['0']['extraFilename']) === true): ?>
                                <div class="info-box">
                                    <p><?php if(array_key_exists('msgNoFileExtra', (array) $this->variables)) { echo $this->variables['msgNoFileExtra']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgNoFileExtra')) { echo $this->variables->getMsgNoFileExtra(); } else { ?>{$msgNoFileExtra}<?php } ?></p>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php
						if(isset($this->variables['item']['practical']['0']['extraFilename']) && empty($this->variables['item']['practical']['0']['extraFilename']) === false)
						{
							?>
                            <div class="info-box uploaded-file">
                                <p><?php if(array_key_exists('lblUploadedFile', (array) $this->variables)) { echo $this->variables['lblUploadedFile']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblUploadedFile')) { echo $this->variables->getLblUploadedFile(); } else { ?>{$lblUploadedFile}<?php } ?><span class="underline">(<?php if(isset($this->variables['item']['practical']['0']) && array_key_exists('extraFilename', (array) $this->variables['item']['practical']['0'])) { echo $this->variables['item']['practical']['0']['extraFilename']; } elseif(is_object($this->variables['item']['practical']['0']) && method_exists($this->variables['item']['practical']['0'], 'getExtraFilename')) { echo $this->variables['item']['practical']['0']->getExtraFilename(); } else { ?>{$item.practical.0.extraFilename}<?php } ?>)</span></p>
                            </div>
                            <div class="downloadFile row">
                                <div class="col-md-6">

                                    <a class="btn-download-file" href="<?php if(array_key_exists('FRONTEND_FILES_URL', (array) $this->variables)) { echo $this->variables['FRONTEND_FILES_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFRONTENDFILESURL')) { echo $this->variables->getFRONTENDFILESURL(); } else { ?>{$FRONTEND_FILES_URL}<?php } ?>/festival/artists/files/extra/<?php if(isset($this->variables['item']['practical']['0']) && array_key_exists('extraFilename', (array) $this->variables['item']['practical']['0'])) { echo $this->variables['item']['practical']['0']['extraFilename']; } elseif(is_object($this->variables['item']['practical']['0']) && method_exists($this->variables['item']['practical']['0'], 'getExtraFilename')) { echo $this->variables['item']['practical']['0']->getExtraFilename(); } else { ?>{$item.practical.0.extraFilename}<?php } ?>" download="<?php if(isset($this->variables['item']['practical']['0']) && array_key_exists('extraFilename', (array) $this->variables['item']['practical']['0'])) { echo $this->variables['item']['practical']['0']['extraFilename']; } elseif(is_object($this->variables['item']['practical']['0']) && method_exists($this->variables['item']['practical']['0'], 'getExtraFilename')) { echo $this->variables['item']['practical']['0']->getExtraFilename(); } else { ?>{$item.practical.0.extraFilename}<?php } ?>"><?php if(array_key_exists('lblDownload', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDownload']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblDownload')) { echo SpoonFilter::ucfirst($this->variables->getLblDownload()); } else { ?>{$lblDownload|ucfirst}<?php } ?></a>
                                </div>
                                <div class="btn-group col-md-6" data-toggle="buttons">
                                    <?php
						if(isset($this->variables['chkDeleteExtra']) && empty($this->variables['chkDeleteExtra']) === false)
						{
							?>
                                        <div class="form-group">
                                            <label for="deleteExtra" class="btn btn-round">
                                                <?php if(array_key_exists('chkDeleteExtra', (array) $this->variables)) { echo $this->variables['chkDeleteExtra']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getChkDeleteExtra')) { echo $this->variables->getChkDeleteExtra(); } else { ?>{$chkDeleteExtra}<?php } ?>
                                                <span class="circle-border chk">&nbsp;</span>
                                                <span class="lbl-text"><?php if(array_key_exists('lblDelete', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDelete']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblDelete')) { echo SpoonFilter::ucfirst($this->variables->getLblDelete()); } else { ?>{$lblDelete|ucfirst}<?php } ?></span>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
						if(isset($this->variables['fileExtra']) && empty($this->variables['fileExtra']) === false)
						{
							?>
                            <div class="form-group upload-group<?php
						if(isset($this->variables['fileExtraError']) && empty($this->variables['fileExtraError']) === false)
						{
							?> errorArea<?php } ?>">
                                <?php if(array_key_exists('fileExtra', (array) $this->variables)) { echo $this->variables['fileExtra']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFileExtra')) { echo $this->variables->getFileExtra(); } else { ?>{$fileExtra}<?php } ?>
                                <input type="text" name="" placeholder="<?php if(array_key_exists('msgFileExtra', (array) $this->variables)) { echo $this->variables['msgFileExtra']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgFileExtra')) { echo $this->variables->getMsgFileExtra(); } else { ?>{$msgFileExtra}<?php } ?>" class="form-control form-upload">
                                <span class="helpTxt"><?php if(array_key_exists('msgHelpMaxFileSizeMB', (array) $this->variables) && isset($this->variables['settings']) && array_key_exists('file_size_limit', (array) $this->variables['settings'])) { echo sprintf($this->variables['msgHelpMaxFileSizeMB'], $this->variables['settings']['file_size_limit']); } elseif(is_object($this->variables['settings']) && method_exists($this->variables['settings'], 'getFileSizeLimit')) { echo ""; throw new Exception('Variables in modifiers on objects are not supported.');; } else { ?>{$msgHelpMaxFileSizeMB|sprintf:<?php if(isset($this->variables['settings']) && array_key_exists('file_size_limit', (array) $this->variables['settings'])) { echo $this->variables['settings']['file_size_limit']; } elseif(is_object($this->variables['settings']) && method_exists($this->variables['settings'], 'getFileSizeLimit')) { echo $this->variables['settings']->getFileSizeLimit(); } else { ?>{$settings.file_size_limit}<?php } ?>}<?php } ?></span>
                                <div class="upload"></div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <h3>Crew <span class="pull-right" data-toggle="tooltip" data-placement="left" title="<?php if(array_key_exists('msgBackstage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['msgBackstage']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgBackstage')) { echo SpoonFilter::ucfirst($this->variables->getMsgBackstage()); } else { ?>{$msgBackstage|ucfirst}<?php } ?>"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/icon_information.svg" /></h3>
                <div class="row">
                    <div class="col-md-12 backstageGroup">
                        <div class="group">
                            <div class="row firstEl">
                                <div class="col-md-6">
                                    <div class="form-group<?php
						if(isset($this->variables['txtNameBackstageError']) && empty($this->variables['txtNameBackstageError']) === false)
						{
							?> errorArea<?php } ?>">
                                        <?php if(array_key_exists('txtNameBackstage', (array) $this->variables)) { echo $this->variables['txtNameBackstage']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtNameBackstage')) { echo $this->variables->getTxtNameBackstage(); } else { ?>{$txtNameBackstage}<?php } ?> <?php if(array_key_exists('txtNameBackstageError', (array) $this->variables)) { echo $this->variables['txtNameBackstageError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtNameBackstageError')) { echo $this->variables->getTxtNameBackstageError(); } else { ?>{$txtNameBackstageError}<?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <?php if(array_key_exists('ddmTypeBackstage', (array) $this->variables)) { echo $this->variables['ddmTypeBackstage']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getDdmTypeBackstage')) { echo $this->variables->getDdmTypeBackstage(); } else { ?>{$ddmTypeBackstage}<?php } ?> <?php if(array_key_exists('ddmTypeBackstageError', (array) $this->variables)) { echo $this->variables['ddmTypeBackstageError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getDdmTypeBackstageError')) { echo $this->variables->getDdmTypeBackstageError(); } else { ?>{$ddmTypeBackstageError}<?php } ?>
                                    </div>
                                </div>
                                <?php if(!isset($this->variables['closed']) || empty($this->variables['closed']) === true): ?>
                                <div class="col-md-1">
                                    <div class="add addBackstage">
                                        <p>+</p>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php
						if(isset($this->variables['personsBackstage']) && empty($this->variables['personsBackstage']) === false)
						{
							?>
                                <?php
						if(!isset($this->variables['personsBackstage']))
						{
							?>{iteration:personsBackstage}<?php
							$this->variables['personsBackstage'] = array();
							$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_2']['fail'] = true;
						}
					$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_2']['iteration'] = $this->variables['personsBackstage'];
				if(isset(${'personsBackstage'})) $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_2']['old'] = ${'personsBackstage'};
				$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_2']['i'] = 1;
				$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_2']['count'] = count($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_2']['iteration']);
				foreach($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_2']['iteration'] as ${'personsBackstage'})
				{
					if(is_array(${'personsBackstage'}))
					{
						if(!isset(${'personsBackstage'}['first']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_2']['i'] == 1) ${'personsBackstage'}['first'] = true;
						if(!isset(${'personsBackstage'}['last']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_2']['i'] == $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_2']['count']) ${'personsBackstage'}['last'] = true;
						if(isset(${'personsBackstage'}['formElements']) && is_array(${'personsBackstage'}['formElements']))
						{
							foreach(${'personsBackstage'}['formElements'] as $name => $object)
							{
								${'personsBackstage'}[$name] = $object->parse();
								${'personsBackstage'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
                                    <div class="row extra">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input value="<?php if(array_key_exists('name', (array) ${'personsBackstage'})) { echo ${'personsBackstage'}['name']; } elseif(is_object(${'personsBackstage'}) && method_exists(${'personsBackstage'}, 'getName')) { echo ${'personsBackstage'}->getName(); } else { ?>{$personsBackstage->name}<?php } ?>" name="extraBackstage[]" maxlength="255" type="text" <?php
						if(isset($this->variables['closed']) && empty($this->variables['closed']) === false)
						{
							?>disabled="true"<?php } ?> class="form-control" placeholder="<?php if(array_key_exists('lblFirstName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFirstName']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFirstName')) { echo SpoonFilter::ucfirst($this->variables->getLblFirstName()); } else { ?>{$lblFirstName|ucfirst}<?php } ?> & <?php if(array_key_exists('lblName', (array) $this->variables)) { echo $this->variables['lblName']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblName')) { echo $this->variables->getLblName(); } else { ?>{$lblName}<?php } ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <?php if(!isset($this->variables['closed']) || empty($this->variables['closed']) === true): ?>
                                                    <select name="typesBackstage[]" class="select" size="1">
                                                        <?php
						if(!isset($this->variables['types']))
						{
							?>{iteration:types}<?php
							$this->variables['types'] = array();
							$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_6']['fail'] = true;
						}
					$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_6']['iteration'] = $this->variables['types'];
				if(isset(${'types'})) $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_6']['old'] = ${'types'};
				$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_6']['i'] = 1;
				$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_6']['count'] = count($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_6']['iteration']);
				foreach($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_6']['iteration'] as ${'types'})
				{
					if(is_array(${'types'}))
					{
						if(!isset(${'types'}['first']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_6']['i'] == 1) ${'types'}['first'] = true;
						if(!isset(${'types'}['last']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_6']['i'] == $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_6']['count']) ${'types'}['last'] = true;
						if(isset(${'types'}['formElements']) && is_array(${'types'}['formElements']))
						{
							foreach(${'types'}['formElements'] as $name => $object)
							{
								${'types'}[$name] = $object->parse();
								${'types'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
                                                            <option value="<?php if(array_key_exists('id', (array) ${'types'})) { echo ${'types'}['id']; } elseif(is_object(${'types'}) && method_exists(${'types'}, 'getId')) { echo ${'types'}->getId(); } else { ?>{$types->id}<?php } ?>" ><?php if(array_key_exists('name', (array) ${'types'})) { echo ${'types'}['name']; } elseif(is_object(${'types'}) && method_exists(${'types'}, 'getName')) { echo ${'types'}->getName(); } else { ?>{$types->name}<?php } ?></option>
                                                        <?php
					$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_6']['i']++;
				}
					if(isset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_6']['fail']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_6']['fail'] == true)
					{
						?>{/iteration:types}<?php
					}
				if(isset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_6']['old'])) ${'types'} = $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_6']['old'];
				else unset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_6']);
				?>
                                                    </select>
                                                <?php endif; ?>
                                                <?php
						if(isset($this->variables['closed']) && empty($this->variables['closed']) === false)
						{
							?>
                                                    <select name="typesBackstage[]" disabled="1" class="select" size="1">
                                                        <?php
						if(!isset($this->variables['types']))
						{
							?>{iteration:types}<?php
							$this->variables['types'] = array();
							$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_5']['fail'] = true;
						}
					$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_5']['iteration'] = $this->variables['types'];
				if(isset(${'types'})) $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_5']['old'] = ${'types'};
				$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_5']['i'] = 1;
				$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_5']['count'] = count($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_5']['iteration']);
				foreach($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_5']['iteration'] as ${'types'})
				{
					if(is_array(${'types'}))
					{
						if(!isset(${'types'}['first']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_5']['i'] == 1) ${'types'}['first'] = true;
						if(!isset(${'types'}['last']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_5']['i'] == $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_5']['count']) ${'types'}['last'] = true;
						if(isset(${'types'}['formElements']) && is_array(${'types'}['formElements']))
						{
							foreach(${'types'}['formElements'] as $name => $object)
							{
								${'types'}[$name] = $object->parse();
								${'types'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
                                                        <option value="<?php if(array_key_exists('id', (array) ${'types'})) { echo ${'types'}['id']; } elseif(is_object(${'types'}) && method_exists(${'types'}, 'getId')) { echo ${'types'}->getId(); } else { ?>{$types->id}<?php } ?>" ><?php if(array_key_exists('name', (array) ${'types'})) { echo ${'types'}['name']; } elseif(is_object(${'types'}) && method_exists(${'types'}, 'getName')) { echo ${'types'}->getName(); } else { ?>{$types->name}<?php } ?></option>
                                                        <?php
					$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_5']['i']++;
				}
					if(isset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_5']['fail']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_5']['fail'] == true)
					{
						?>{/iteration:types}<?php
					}
				if(isset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_5']['old'])) ${'types'} = $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_5']['old'];
				else unset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_5']);
				?>
                                                    </select>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php if(!isset($this->variables['closed']) || empty($this->variables['closed']) === true): ?>
                                        <div class="col-md-1">
                                            <div class="remove removeBackstage">
                                                <p>-</p>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                <?php
					$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_2']['i']++;
				}
					if(isset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_2']['fail']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_2']['fail'] == true)
					{
						?>{/iteration:personsBackstage}<?php
					}
				if(isset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_2']['old'])) ${'personsBackstage'} = $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_2']['old'];
				else unset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_2']);
				?>
                            <?php } ?>
                            <?php if(!isset($this->variables['personsBackstage']) || empty($this->variables['personsBackstage']) === true): ?>
                                <div class="row extra hidden">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input value="" name="extraBackstage[]" maxlength="255" type="text" <?php
						if(isset($this->variables['closed']) && empty($this->variables['closed']) === false)
						{
							?>disabled="true"<?php } ?> class="form-control" placeholder="<?php if(array_key_exists('lblFirstName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFirstName']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblFirstName')) { echo SpoonFilter::ucfirst($this->variables->getLblFirstName()); } else { ?>{$lblFirstName|ucfirst}<?php } ?> & <?php if(array_key_exists('lblName', (array) $this->variables)) { echo $this->variables['lblName']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblName')) { echo $this->variables->getLblName(); } else { ?>{$lblName}<?php } ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <select name="typesBackstage[]" class="select" size="1">
                                                <?php
						if(!isset($this->variables['types']))
						{
							?>{iteration:types}<?php
							$this->variables['types'] = array();
							$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_3']['fail'] = true;
						}
					$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_3']['iteration'] = $this->variables['types'];
				if(isset(${'types'})) $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_3']['old'] = ${'types'};
				$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_3']['i'] = 1;
				$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_3']['count'] = count($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_3']['iteration']);
				foreach($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_3']['iteration'] as ${'types'})
				{
					if(is_array(${'types'}))
					{
						if(!isset(${'types'}['first']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_3']['i'] == 1) ${'types'}['first'] = true;
						if(!isset(${'types'}['last']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_3']['i'] == $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_3']['count']) ${'types'}['last'] = true;
						if(isset(${'types'}['formElements']) && is_array(${'types'}['formElements']))
						{
							foreach(${'types'}['formElements'] as $name => $object)
							{
								${'types'}[$name] = $object->parse();
								${'types'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
                                                    <option value="<?php if(array_key_exists('id', (array) ${'types'})) { echo ${'types'}['id']; } elseif(is_object(${'types'}) && method_exists(${'types'}, 'getId')) { echo ${'types'}->getId(); } else { ?>{$types->id}<?php } ?>"><?php if(array_key_exists('name', (array) ${'types'})) { echo ${'types'}['name']; } elseif(is_object(${'types'}) && method_exists(${'types'}, 'getName')) { echo ${'types'}->getName(); } else { ?>{$types->name}<?php } ?></option>
                                                <?php
					$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_3']['i']++;
				}
					if(isset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_3']['fail']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_3']['fail'] == true)
					{
						?>{/iteration:types}<?php
					}
				if(isset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_3']['old'])) ${'types'} = $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_3']['old'];
				else unset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_3']);
				?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if(!isset($this->variables['closed']) || empty($this->variables['closed']) === true): ?>
                                        <div class="col-md-1">
                                            <div class="remove removeBackstage">
                                                <p>-</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- <h3 class="top30"><?php if(array_key_exists('lblSoundEngineerTitle', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSoundEngineerTitle']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblSoundEngineerTitle')) { echo SpoonFilter::ucfirst($this->variables->getLblSoundEngineerTitle()); } else { ?>{$lblSoundEngineerTitle|ucfirst}<?php } ?></h3>
                <div class="row top10 bottom10">
                    <div class="col-md-6">
                        <div class="btn-group " data-toggle="buttons">
                            <div class="form-group" >
                                <label for="soundEngineer" class="btn btn-round <?php
						if(isset($this->variables['soundActive']) && empty($this->variables['soundActive']) === false)
						{
							?>active<?php } ?>">
                                    <?php if(array_key_exists('chkSoundEngineer', (array) $this->variables)) { echo $this->variables['chkSoundEngineer']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getChkSoundEngineer')) { echo $this->variables->getChkSoundEngineer(); } else { ?>{$chkSoundEngineer}<?php } ?>
                                    <span class="circle-border chk">&nbsp;</span>
                                    <span class="lbl-text"><?php if(array_key_exists('lblSoundEngineer', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSoundEngineer']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblSoundEngineer')) { echo SpoonFilter::ucfirst($this->variables->getLblSoundEngineer()); } else { ?>{$lblSoundEngineer|ucfirst}<?php } ?></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div> -->

                <h3 class="top30">Maaltijd<span class="pull-right" data-toggle="tooltip" data-placement="left" title="<?php if(array_key_exists('msgMeal', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['msgMeal']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgMeal')) { echo SpoonFilter::ucfirst($this->variables->getMsgMeal()); } else { ?>{$msgMeal|ucfirst}<?php } ?>"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/icon_information.svg" /></h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group<?php
						if(isset($this->variables['txtHotMealError']) && empty($this->variables['txtHotMealError']) === false)
						{
							?> errorArea<?php } ?>">
                            <label for="hotMeal"><?php if(array_key_exists('lblHotMeal', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblHotMeal']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblHotMeal')) { echo SpoonFilter::ucfirst($this->variables->getLblHotMeal()); } else { ?>{$lblHotMeal|ucfirst}<?php } ?></label>
                            <?php if(array_key_exists('txtHotMeal', (array) $this->variables)) { echo $this->variables['txtHotMeal']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtHotMeal')) { echo $this->variables->getTxtHotMeal(); } else { ?>{$txtHotMeal}<?php } ?> <?php if(array_key_exists('txtHotMealError', (array) $this->variables)) { echo $this->variables['txtHotMealError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtHotMealError')) { echo $this->variables->getTxtHotMealError(); } else { ?>{$txtHotMealError}<?php } ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group<?php
						if(isset($this->variables['txtVeggieMealError']) && empty($this->variables['txtVeggieMealError']) === false)
						{
							?> errorArea<?php } ?>">
                            <label for="veggieMeal"><?php if(array_key_exists('lblVeggieMeal', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblVeggieMeal']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblVeggieMeal')) { echo SpoonFilter::ucfirst($this->variables->getLblVeggieMeal()); } else { ?>{$lblVeggieMeal|ucfirst}<?php } ?></label>
                            <?php if(array_key_exists('txtVeggieMeal', (array) $this->variables)) { echo $this->variables['txtVeggieMeal']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtVeggieMeal')) { echo $this->variables->getTxtVeggieMeal(); } else { ?>{$txtVeggieMeal}<?php } ?> <?php if(array_key_exists('txtVeggieMealError', (array) $this->variables)) { echo $this->variables['txtVeggieMealError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtVeggieMealError')) { echo $this->variables->getTxtVeggieMealError(); } else { ?>{$txtVeggieMealError}<?php } ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group<?php
						if(isset($this->variables['txtVeganMealError']) && empty($this->variables['txtVeganMealError']) === false)
						{
							?> errorArea<?php } ?>">
                            <label for="veganMeal"><?php if(array_key_exists('lblVeganMeal', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblVeganMeal']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblVeganMeal')) { echo SpoonFilter::ucfirst($this->variables->getLblVeganMeal()); } else { ?>{$lblVeganMeal|ucfirst}<?php } ?></label>
                            <?php if(array_key_exists('txtVeganMeal', (array) $this->variables)) { echo $this->variables['txtVeganMeal']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtVeganMeal')) { echo $this->variables->getTxtVeganMeal(); } else { ?>{$txtVeganMeal}<?php } ?> <?php if(array_key_exists('txtVeganMealError', (array) $this->variables)) { echo $this->variables['txtVeganMealError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtVeganMealError')) { echo $this->variables->getTxtVeganMealError(); } else { ?>{$txtVeganMealError}<?php } ?>
                        </div>
                    </div>
                </div>

                <h3 class="top30"><?php if(array_key_exists('lblCars', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblCars']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblCars')) { echo SpoonFilter::ucfirst($this->variables->getLblCars()); } else { ?>{$lblCars|ucfirst}<?php } ?><span class="pull-right" data-toggle="tooltip" data-placement="left" title="<?php if(array_key_exists('msgCars', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['msgCars']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getMsgCars')) { echo SpoonFilter::ucfirst($this->variables->getMsgCars()); } else { ?>{$msgCars|ucfirst}<?php } ?>"><img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/icon_information.svg" /></h3>
                <div class="row">
                    <?php
						if(!isset($this->variables['cars']))
						{
							?>{iteration:cars}<?php
							$this->variables['cars'] = array();
							$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_4']['fail'] = true;
						}
					$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_4']['iteration'] = $this->variables['cars'];
				if(isset(${'cars'})) $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_4']['old'] = ${'cars'};
				$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_4']['i'] = 1;
				$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_4']['count'] = count($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_4']['iteration']);
				foreach($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_4']['iteration'] as ${'cars'})
				{
					if(is_array(${'cars'}))
					{
						if(!isset(${'cars'}['first']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_4']['i'] == 1) ${'cars'}['first'] = true;
						if(!isset(${'cars'}['last']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_4']['i'] == $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_4']['count']) ${'cars'}['last'] = true;
						if(isset(${'cars'}['formElements']) && is_array(${'cars'}['formElements']))
						{
							foreach(${'cars'}['formElements'] as $name => $object)
							{
								${'cars'}[$name] = $object->parse();
								${'cars'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
							}
						}
					}?>
                     <div class="col-md-3">
                        <div class="form-group">
                            <?php if(!isset($this->variables['closed']) || empty($this->variables['closed']) === true): ?>
                            <input value="<?php if(array_key_exists('licencePlate', (array) ${'cars'})) { echo ${'cars'}['licencePlate']; } elseif(is_object(${'cars'}) && method_exists(${'cars'}, 'getLicencePlate')) { echo ${'cars'}->getLicencePlate(); } else { ?>{$cars->licencePlate}<?php } ?>" name="car[]" maxlength="20" type="text" class="form-control" placeholder="<?php if(array_key_exists('lblLicencePlate', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLicencePlate']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblLicencePlate')) { echo SpoonFilter::ucfirst($this->variables->getLblLicencePlate()); } else { ?>{$lblLicencePlate|ucfirst}<?php } ?>">
                            <?php endif; ?>
                            <?php
						if(isset($this->variables['closed']) && empty($this->variables['closed']) === false)
						{
							?>
                            <input value="<?php if(array_key_exists('licencePlate', (array) ${'cars'})) { echo ${'cars'}['licencePlate']; } elseif(is_object(${'cars'}) && method_exists(${'cars'}, 'getLicencePlate')) { echo ${'cars'}->getLicencePlate(); } else { ?>{$cars->licencePlate}<?php } ?>" name="car[]" disabled="1" maxlength="20" type="text" class="form-control" placeholder="<?php if(array_key_exists('lblLicencePlate', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLicencePlate']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblLicencePlate')) { echo SpoonFilter::ucfirst($this->variables->getLblLicencePlate()); } else { ?>{$lblLicencePlate|ucfirst}<?php } ?>">
                            <?php } ?>

                        </div>
                    </div>
                    <?php
					$this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_4']['i']++;
				}
					if(isset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_4']['fail']) && $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_4']['fail'] == true)
					{
						?>{/iteration:cars}<?php
					}
				if(isset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_4']['old'])) ${'cars'} = $this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_4']['old'];
				else unset($this->iterations['1c8807e9bbaacb71b1905ac371665bd4_SignUp.tpl.php_4']);
				?>
                </div>

                <h3><?php if(array_key_exists('lblRemark', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRemark']); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblRemark')) { echo SpoonFilter::ucfirst($this->variables->getLblRemark()); } else { ?>{$lblRemark|ucfirst}<?php } ?></h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group<?php
						if(isset($this->variables['txtRemarkError']) && empty($this->variables['txtRemarkError']) === false)
						{
							?> errorArea<?php } ?>">
                            <?php if(array_key_exists('txtRemark', (array) $this->variables)) { echo $this->variables['txtRemark']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtRemark')) { echo $this->variables->getTxtRemark(); } else { ?>{$txtRemark}<?php } ?> <?php if(array_key_exists('txtRemarkError', (array) $this->variables)) { echo $this->variables['txtRemarkError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtRemarkError')) { echo $this->variables->getTxtRemarkError(); } else { ?>{$txtRemarkError}<?php } ?>
                        </div>
                    </div>
                </div>

                <?php
						if(isset($this->variables['error']) && empty($this->variables['error']) === false)
						{
							?>
                <div class="row box-error">
                    <div class="col-md-12">
                        <p><?php if(array_key_exists('fileTechnicalError', (array) $this->variables)) { echo $this->variables['fileTechnicalError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFileTechnicalError')) { echo $this->variables->getFileTechnicalError(); } else { ?>{$fileTechnicalError}<?php } ?></p>
                        <p><?php if(array_key_exists('fileCoverError', (array) $this->variables)) { echo $this->variables['fileCoverError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFileCoverError')) { echo $this->variables->getFileCoverError(); } else { ?>{$fileCoverError}<?php } ?></p>
                        <p><?php if(array_key_exists('fileStageError', (array) $this->variables)) { echo $this->variables['fileStageError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFileStageError')) { echo $this->variables->getFileStageError(); } else { ?>{$fileStageError}<?php } ?></p>
                        <p><?php if(array_key_exists('fileContractError', (array) $this->variables)) { echo $this->variables['fileContractError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getFileContractError')) { echo $this->variables->getFileContractError(); } else { ?>{$fileContractError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtContactPhoneError', (array) $this->variables)) { echo $this->variables['txtContactPhoneError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtContactPhoneError')) { echo $this->variables->getTxtContactPhoneError(); } else { ?>{$txtContactPhoneError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtContactNameError', (array) $this->variables)) { echo $this->variables['txtContactNameError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtContactNameError')) { echo $this->variables->getTxtContactNameError(); } else { ?>{$txtContactNameError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtContactEmailError', (array) $this->variables)) { echo $this->variables['txtContactEmailError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtContactEmailError')) { echo $this->variables->getTxtContactEmailError(); } else { ?>{$txtContactEmailError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtContactFirstNameError', (array) $this->variables)) { echo $this->variables['txtContactFirstNameError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtContactFirstNameError')) { echo $this->variables->getTxtContactFirstNameError(); } else { ?>{$txtContactFirstNameError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtFacebookError', (array) $this->variables)) { echo $this->variables['txtFacebookError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtFacebookError')) { echo $this->variables->getTxtFacebookError(); } else { ?>{$txtFacebookError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtTwitterError', (array) $this->variables)) { echo $this->variables['txtTwitterError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtTwitterError')) { echo $this->variables->getTxtTwitterError(); } else { ?>{$txtTwitterError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtYoutubeError', (array) $this->variables)) { echo $this->variables['txtYoutubeError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtYoutubeError')) { echo $this->variables->getTxtYoutubeError(); } else { ?>{$txtYoutubeError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtWebsiteError', (array) $this->variables)) { echo $this->variables['txtWebsiteError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtWebsiteError')) { echo $this->variables->getTxtWebsiteError(); } else { ?>{$txtWebsiteError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtInstagramError', (array) $this->variables)) { echo $this->variables['txtInstagramError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtInstagramError')) { echo $this->variables->getTxtInstagramError(); } else { ?>{$txtInstagramError}<?php } ?></p>
                        <p><?php if(array_key_exists('txtSoundcloudError', (array) $this->variables)) { echo $this->variables['txtSoundcloudError']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTxtSoundcloudError')) { echo $this->variables->getTxtSoundcloudError(); } else { ?>{$txtSoundcloudError}<?php } ?></p>
                    </div>
                </div>
                <?php } ?>

                <?php if(!isset($this->variables['closed']) || empty($this->variables['closed']) === true): ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="btn-submit" type="submit" name="signUp" value="<?php if(array_key_exists('lblSend', (array) $this->variables)) { echo SpoonFilter::ucfirst(SpoonFilter::ucfirst($this->variables['lblSend'])); } elseif(is_object($this->variables) && method_exists($this->variables, 'getLblSend')) { echo SpoonFilter::ucfirst($this->variables->getLblSend()); } else { ?>{$lblSend|ucfirst|ucfirst}<?php } ?>"/>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-2 imagesRight">
                <img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/img-balloon.png" alt="balloon" class="balloon1"/>
                <img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/img-butterfly.png" alt="balloon" class="butterfly1"/>
                <img src="<?php if(array_key_exists('THEME_URL', (array) $this->variables)) { echo $this->variables['THEME_URL']; } elseif(is_object($this->variables) && method_exists($this->variables, 'getTHEMEURL')) { echo $this->variables->getTHEMEURL(); } else { ?>{$THEME_URL}<?php } ?>/Core/Layout/images/img-bird-right.png" alt="bird" class="bird2"/>
            </div>
        </div>
    </form>
				<?php } ?>
    <?php endif; ?>
</section>

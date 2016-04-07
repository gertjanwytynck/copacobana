/**
 * Interaction for the news module
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
jsBackend.news =
{
	init: function ()
	{
		jsBackend.news.optionalMultilanguage.init();
		jsBackend.news.images.init();
		jsBackend.news.settings.init();
	},

	optionalMultilanguage:
	{
		init: function()
		{
			jsBackend.news.optionalMultilanguage.views.init();
			jsBackend.news.optionalMultilanguage.tags.init();
		},
		views:
		{
			init: function ()
			{
				$('.optional-language').hide();
				$('.optional-seo-language').hide();

				$('.optional-language-tab').find('.toggle-optional-language input[type="checkbox"]').unbind('click').bind('click', function(){
					jsBackend.news.optionalMultilanguage.views.toggle(this);
				}).each(function(k,v){
					jsBackend.news.optionalMultilanguage.views.toggle(v);
				});
			},
			toggle: function(el)
			{
				var language = $(el).parent().data('language');

				if ($(el).prop('checked')) {
					$('.optional-seo-' + language).show();
					$(el).parents('.optional-language-tab').find('.optional-language').show();
				} else {
					$('.optional-seo-' + language).hide();
					$(el).parents('.optional-language-tab').find('.optional-language').hide();
				}
			}
		},
		tags:
		{
			init: function()
			{
				var $tagBoxIconOnly = $('#sidebar input.tagOptionalLanguageBox');
				var $tagBoxWithLabel = $('#leftColumn input.tagOptionalLanguageBox, #tabTags input.tagOptionalLanguageBox');

				if($tagBoxIconOnly.length > 0){
					$tagBoxIconOnly.each(function(){
						var language = $(this).data('language');

						$(this).unbind().removeData().tagBox({
							emptyMessage: jsBackend.locale.msg('NoTags'),
							errorMessage: jsBackend.locale.err('AddTagBeforeSubmitting'),
							addLabel: utils.string.ucfirst(jsBackend.locale.lbl('Add')),
							removeLabel: utils.string.ucfirst(jsBackend.locale.lbl('DeleteThisTag')),
							params: { fork: { module: 'Tags', action: 'Autocomplete', language: language } }
						});
					});
				}

				if($tagBoxWithLabel.length > 0) {
					$tagBoxWithLabel.each(function(){
						var language = $(this).data('language');

						$(this).unbind().removeData().tagBox({
							emptyMessage: jsBackend.locale.msg('NoTags'),
							errorMessage: jsBackend.locale.err('AddTagBeforeSubmitting'),
							addLabel: utils.string.ucfirst(jsBackend.locale.lbl('Add')),
							removeLabel: utils.string.ucfirst(jsBackend.locale.lbl('DeleteThisTag')),
							params: { fork: { module: 'Tags', action: 'Autocomplete', language: language } },
							showIconOnly: false
						});
					});
				}
			}
		}
	},

	images:
	{
		init: function()
		{
			if (jsBackend.current.action == 'Images') {
				jsBackend.news.images.uploadify();
				jsBackend.news.images.listeners.init();

				$(".fancybox").fancybox();
			}
		},
		listeners: {
			init: function()
			{
				// upload button
				$('#uploadImages').on('click', function(evt) {
					evt.preventDefault();
					$('#imageUpload').uploadifyUpload();
				});

				// create dialogs
				jsBackend.news.images.editImageDialog();
				jsBackend.news.images.deleteImageDialog();

				// edit dialog listener
				$('.showDialogForm').on('click', function(evt)
				{
					// prevent default
					evt.preventDefault();

					// get id
					$dialogBox = $('#'+ $(this).attr('data-message-id'));

					// bind
					if($dialogBox.length > 0)
					{
						// set target
						$dialogBox.attr('data-message-id', $(this).attr('href'));
						$dialogBox.attr('data-article-id', $('#articleId').val());
						$dialogBox.attr('data-title', $(this).attr('data-title'));
						$dialogBox.attr('data-hidden', $(this).attr('data-hidden'));
						$dialogBox.attr('data-image-id', $(this).attr('data-image-id'));

						// open dialog
						$dialogBox.dialog('open');
					}
				});

				// delete dialog listener
				$('#imagesDatagridContainer a.deleteImage').bind('click', function(evt)
				{
					// prevent default
					evt.preventDefault();

					// open dialog
					$('#confirmDeleteImage' + $(this).attr('data-image-id')).dialog('open');
				});
			}
		},
		editImageDialog: function() {
			var $showDialogForm = $('.showDialogForm');

			$showDialogForm.each(function() {
				// get id
				var id = $(this).attr('data-message-id');
				var url = $(this).attr('href');

				if(id != '' && url != '') {
					// initialize
					$('#'+ id).dialog({
						autoOpen: false,
						draggable: false,
						resizable: false,
						modal: true,
						width: 320,
						buttons:[
							{
								text: utils.string.ucfirst(jsBackend.locale.lbl('Save')),
								click: function()
								{
									sendEditImage($(this));
								}
							},
							{
								text: utils.string.ucfirst(jsBackend.locale.lbl('Cancel')),
								click: function()
								{
									$(this).dialog('close');
								}
							}
						],
						open: function(){
							populateFields($(this));
						}
					});
				}
			});

			function populateFields($this) {
				var title = $this.attr('data-title');
				var hidden = $this.attr('data-hidden');

				$('#imageTitle').val(title);

				if (hidden) {
					$('#imageVisible').removeAttr('checked');
				} else {
					$('#imageVisible').attr('checked', true);
				}
			}
			function sendEditImage($this) {
				var articleId = $('#articleId').val();
				var imageId = $this.attr('data-image-id');

				// json encode data
				var data = $('#editFormImage form').serializeObject();

				// make ajax call
				$.ajax({
					data:
					{
						fork: { action: 'EditImage' },
						imageId: imageId,
						articleId: articleId,
						data: data
					},
					success : function(data, textStatus)
					{
						if(data.code == 200){
							// close dialog
							$this.dialog('close');

							// there are results
							if(data.data.dataGrid)
							{
								// parse dataGrid
								$('#imagesDatagridContainer').html(data.data.dataGrid);

								// reinit drag and drop handle
								jsBackend.tableSequenceByDragAndDrop.init();
							}

							// no results
							else $('imagesDatagridContainer').html('').append(data.data.message);

							// reinitialize the listeners
							jsBackend.news.images.listeners.init();

							// show message
							jsBackend.messages.add('success', data.message);
						}

						// not a success so show a message
						else jsBackend.messages.add('error', jsBackend.locale.err('ImageNotFound'));
					},
					error : function(XMLHttpRequest, textStatus, errorThrown)
					{
						// show message
						jsBackend.messages.add('error', jsBackend.locale.err('ImageNotFound'));
					}
				});
			}
		},
		deleteImageDialog: function () {
			// initialize
			$('#imagesDatagridContainer a.deleteImage').each(function() {
				var imageId = $(this).attr('data-image-id');

				// already exists
				if($('#confirmDeleteImage' + imageId).length > 0) return;

				// create confirm div
				$('#news').append(
					'<div id="confirmDeleteImage' + imageId + '" title="' + jsBackend.helpers.ucfirst(jsBackend.locale.lbl('DeleteImage')) + '?" data-image-id="' + imageId + '" style="display: none;">' +
						'<p>' + jsBackend.helpers.ucfirst(jsBackend.locale.msg('ConfirmDeleteImage')) + '</p>' +
					'</div>'
				);

				// initialize
				$('#confirmDeleteImage' + imageId).dialog({
					autoOpen: false,
					draggable: false,
					resizable: false,
					modal: true,
					buttons: [
						{
							text: utils.string.ucfirst(jsBackend.locale.lbl('OK')),
							click: function()
							{
								var imageId = $(this).attr('data-image-id');
								var articleId = $('#articleId').val();
								var parentRow = $('#imagesDatagridContainer').find("[data-id='" + imageId + "']");

								// close dialog
								$(this).dialog('close');

								// make ajax call
								$.ajax({
									data:
									{
										fork: { action: 'DeleteImage' },
										imageId: imageId,
										articleId: articleId
									},
									success: function(data, textStatus)
									{
										// success, update the dataGrid
										if(data.code == 200)
										{
											// remove row
											parentRow.remove();

											// redo odd-even
											var table = $('table#dataGridImages');
											table.find('tr').removeClass('odd').removeClass('even');
											table.find('tr:even').addClass('even');
											table.find('tr:odd').addClass('odd');

											// show message
											jsBackend.messages.add('success', data.message);

											// if there are no records -> show message
											if($('#imagesDatagridContainer tr').length == 1) $('#imagesDatagridContainer').html('').append(jsBackend.locale.get('msg', 'NoImages', 'News'));
										}

										// not a succes so show a message
										else jsBackend.messages.add('error', jsBackend.locale.err('DeleteImageFailed'));

										// alert the user
										if(data.code != 200 && jsBackend.debug) alert(data.message);
									},
									error: function(XMLHttpRequest, textStatus, errorThrown)
									{
										// show message
										jsBackend.messages.add('error', jsBackend.locale.err('DeleteImageFailed'));

										// alert the user
										if(jsBackend.debug) alert(textStatus);
									}
								});
							}
						},
						{
							text: utils.string.ucfirst(jsBackend.locale.lbl('Cancel')),
							click: function()
							{
								$(this).dialog('close');
							}
						}
					],
					open: function(evt)
					{
						// set focus on first button
						if($(this).next().find('button').length > 0) $(this).next().find('button')[0].focus();
					}
				});
			});
		},
		uploadify: function()
		{
			var modulePath = '/src/Backend/Modules/' + jsBackend.current.module;
			var imageSizeLimit = $('#imageSizeLimit').val() * 1000 * 1000;

			$('#imageUpload').uploadify({
				'uploader' : modulePath + '/Js/uploadify.swf',
				'script' : modulePath + '/Engine/Uploadify.php',
				'cancelImg' : modulePath + '/Layout/images/cancel.png',
				'buttonImg' : modulePath + '/Layout/images/select_images_' + jsBackend.data.get('interface_language') + '.png',
				'fileDesc' : ' .png, .jpg, .jpeg, .gif',
				'fileExt' : '*.png;*.jpg;*.jpeg;*.gif',
				'rollover' : true,
				'multi' : true,
				'sizeLimit' : imageSizeLimit,
				'width' : '200',
				'onComplete' : function(event, ID, fileObj, response, data)
				{
					// vars we will need
					var articleId = $('#articleId').val();
					var filename = fileObj['name'];

					// make ajax call
					$.ajax({
						data: {
							fork: { action: 'AddImage' },
							articleId: articleId,
							filename: filename,
							filePath: response
						},
						success: function(data, textStatus)
						{
							// not a succes so revert the changes
							if(data.code == 200) {
								// there are results
								if(data.data.dataGrid) {
									// parse dataGrid
									$('#imagesDatagridContainer').html(data.data.dataGrid);

									// reinit the listeners
									jsBackend.news.images.listeners.init();

									// reinit drag and drop handle
									jsBackend.tableSequenceByDragAndDrop.init();

									// reinit fancybox
									//$(".fancybox").fancybox();
								}

								// no results
								else $('#imagesDatagridContainer').html('').append(data.data.message);

								// show message
								jsBackend.messages.add('success', data.message);
							}

							// show message
							else jsBackend.messages.add('error', jsBackend.locale.err('AddImageFailed'));

							// alert the user
							if(data.code != 200 && jsBackend.debug) alert(data.message);
						},
						error: function(XMLHttpRequest, textStatus)
						{
							// show message
							jsBackend.messages.add('error', jsBackend.locale.err('AddImageFailed'));

							// alert the user
							if(jsBackend.debug) alert(textStatus);
						}
					});
				}
			});
		}
	},

	settings:
	{
		init: function()
		{
			if (jsBackend.current.action == 'Settings') {
				// bind the listeners
				jsBackend.news.settings.listeners();

				// set initial states
				jsBackend.news.settings.toggleCoverImageSettings();
			}
		},
		listeners: function ()
		{
			$('#coverImageEnabled').change(function(){
				jsBackend.news.settings.toggleCoverImageSettings();
			});
		},
		toggleCoverImageSettings: function() {
			var $coverImageEnabled = $('#coverImageEnabled');
			var $coverImageSettings = $('#coverImageSettings');

			if ($coverImageEnabled.prop('checked')) {
				$coverImageSettings.show();
			} else {
				$coverImageSettings.hide();
			}
		}
	}
};

// used to serialize a form in to json
jQuery.fn.serializeObject = function() {
	var arrayData, objectData;
	arrayData = this.serializeArray();
	objectData = {};

	$.each(arrayData, function() {
		var value;

		if (this.value != null) {
			value = this.value;
		} else {
			value = '';
		}

		if (objectData[this.name] != null) {
			if (!objectData[this.name].push) {
				objectData[this.name] = [objectData[this.name]];
			}

			objectData[this.name].push(value);
		} else {
			objectData[this.name] = value;
		}
	});

	return objectData;
};

jsBackend.helpers = {
	ucfirst: function(str)
	{
		return str.charAt(0).toUpperCase() + str.slice(1);
	}
};

$(jsBackend.news.init);
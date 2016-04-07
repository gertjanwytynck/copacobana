/**
 * Multi language interactions
 *
 * @author Mathias Dewelde <mathias@studiorauw.be>
 */
jsBackend.multiLanguage =
{
	init: function ()
	{
		jsBackend.multiLanguage.views.init();
		jsBackend.multiLanguage.tags.init();
	},

	views:
	{
		init: function ()
		{
			$('.optional-language').hide();
			$('.optional-seo-language').hide();

			$('.optional-language-tab').find('.toggle-optional-language input[type="checkbox"]').unbind('click').bind('click', function(){
				jsBackend.multiLanguage.views.toggle(this);
			}).each(function(k,v){
				jsBackend.multiLanguage.views.toggle(v);
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
};

$(jsBackend.multiLanguage.init);
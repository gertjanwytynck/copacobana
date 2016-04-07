/**
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
jsBackend.festival =
{
	// init, something like a constructor
	init: function()
	{
		if($('#name').length > 0) $('#name').doMeta();

		if(jsBackend.current.action == 'AddArtist' || jsBackend.current.action == 'EditArtist')
		{
            jsBackend.festival.optionalMultilanguage.init();

            $('#backstage').keyValueBox({
                emptyMessage: jsBackend.locale.msg('PersonsBackstage'),
                errorMessage: jsBackend.locale.err('AddPersonBackstageBeforeSubmitting'),
                addLabel: utils.string.ucfirst(jsBackend.locale.lbl('Add')),
                editLabel: utils.string.ucfirst(jsBackend.locale.lbl('Edit')),
                editLink: '{$var|geturl:"edit"}&amp;id={id}#tabLinks',
                removeLabel: utils.string.ucfirst(jsBackend.locale.lbl('Delete')),
                params:
                {
                    fork: { action: 'Autocomplete' },
                    language: jsBackend.current.language,
                    id: $('#festivalId').val(),
                    type: 'personsBackstage'
                }
            });

			$('#onstage').keyValueBox({
				emptyMessage: jsBackend.locale.msg('PersonsOnstage'),
				errorMessage: jsBackend.locale.err('AddPersonOnstageBeforeSubmitting'),
				addLabel: utils.string.ucfirst(jsBackend.locale.lbl('Add')),
				editLabel: utils.string.ucfirst(jsBackend.locale.lbl('Edit')),
				editLink: '{$var|geturl:"edit"}&amp;id={id}#tabLinks',
				removeLabel: utils.string.ucfirst(jsBackend.locale.lbl('Delete')),
				params:
				{
					fork: { action: 'Autocomplete' },
					language: jsBackend.current.language,
					id: $('#festivalId').val(),
					type: 'personsOnstage'
				}
			});

			$('#genres').keyValueBox({
                emptyMessage: jsBackend.locale.msg('NoGenres'),
                errorMessage: jsBackend.locale.err('AddGenreFestivalBeforeSubmitting'),
                addLabel: utils.string.ucfirst(jsBackend.locale.lbl('Add')),
                removeLabel: utils.string.ucfirst(jsBackend.locale.lbl('Delete')),
				params: { fork: { module: 'Festival', action: 'Autocomplete' } }

			});
		}

	}
};

jsBackend.festival.productBeforeSubmit =
{
    init: function ()
    {
        $('#edit').on('submit', function() {
            if ($('#multiProducts').prop('checked')) {
                var error = false;


                // multi product
                $('.priceField').each(function(){
                    $(this).val($(this).val().toString().replace(/\,/g, '.'));
                    $(this).css('border-color', '#888 #BABABA #BABABA #CDCDCD');

                    // validate
                    var valid = /^\d{0,4}(\.\d{0,2})?$/.test($(this).val());
                    if (!valid){
                        $(this).css('border-color', 'red');
                        $('#tabBtnSubproducts').addClass('ui-state-error');
                        error = true;
                    }
                });

                if (!error) return true;

            } else {
                // single product
                var $price = $('#subproductPrice');
                $price.val($price.val().toString().replace(/\,/g, '.'));

                // validate
                var valid = /^\d{0,4}(\.\d{0,2})?$/.test($price.val());
                if (valid){
                    // proceed submit
                    return true;
                } else {
                    $price.css('border-color', 'red');
                    $('#tabBtnSubproducts').addClass('ui-state-error');
                }
            }

            return false;
        });
    }
};

jsBackend.festival.optionalMultilanguage =
{
    init: function () {
        // set initial state
        $('[data-language-toggle]').find('input[type="checkbox"]').each(function(){
            jsBackend.festival.optionalMultilanguage.toggle(this);
        });

        // set listener
        $('[data-language-toggle]').find('input[type="checkbox"]').bind('click', function(){
           jsBackend.festival.optionalMultilanguage.toggle(this);
        });
    },
    toggle: function(el){
        var language = $(el).parent().data('language-toggle');

        if($(el).prop('checked')){
            $('[data-optional-language="' + language + '"]').show();
            $(el).parent().parent().addClass('pageTitle');
            $('[data-at-least-one-language]').show();
        }else{
            $('[data-optional-language="' + language + '"]').hide();
            $(el).parent().parent().removeClass('pageTitle');

            if ($('[data-language-toggle] input[type="checkbox"]:checked').length == 0) {
                $('[data-at-least-one-language]').hide();
            }
        }
    }
}


jQuery.extend({
    // used to compare array's
    compare: function (arrayA, arrayB) {
        if (arrayA.length != arrayB.length) { return false; }
        // sort modifies original array
        // (which are passed by reference to our method!)
        // so clone the arrays before sorting
        var a = jQuery.extend(true, [], arrayA);
        var b = jQuery.extend(true, [], arrayB);
        a.sort();
        b.sort();
        for (var i = 0, l = a.length; i < l; i++) {
            if (a[i] !== b[i]) {
                return false;
            }
        }
        return true;
    }
});

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

$(jsBackend.festival.init);
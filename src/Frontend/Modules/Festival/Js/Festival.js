/**
 * Interaction for the festival module
 *
 * @author Gertjan Wytynck <gertjan@studiorauw.be>
 */
jsFrontend.festival =
{
	init: function () {
		jsFrontend.festival.addButtons();
		jsFrontend.festival.checkUrl();
		jsFrontend.festival.filtering();
		jsFrontend.festival.signUpValidation();

		//var backstage = jsFrontend.data.get('Festival.backstage');
	    var selectTypes = document.querySelectorAll("select[name='typesBackstage[]']");

	    $('.grid').masonry({
	      itemSelector: '.grid-item'
	    });

	   	$('img.svg').each(function(){
	      var $img = $(this);
	      var imgID = $img.attr('id');
	      var imgClass = $img.attr('class');
	      var imgURL = $img.attr('src');

	  		$.get(imgURL, function(data) {
	          	// Get the SVG tag, ignore the rest
	          	var $svg = $(data).find('svg');

	          	// Add replaced image's ID to the new SVG
	          	if(typeof imgID !== 'undefined') {
	              	$svg = $svg.attr('id', imgID);
	          	}

	          	// Add replaced image's classes to the new SVG
	          	if(typeof imgClass !== 'undefined') {
	              	$svg = $svg.attr('class', imgClass+' replaced-svg');
	          	}

	          	// Remove any invalid XML tags as per http://validator.w3.org
	          	$svg = $svg.removeAttr('xmlns:a');

	          	// Replace image with new SVG
	          	$img.replaceWith($svg);
	      	}, 'xml');

		});

		// init grid
		if ( $(window).width() > 550) {
			if ($('#og-grid').length) {
				$(function() {
					Grid.init();
				});
			}
		}

        // set stages
        var backstage = jsFrontend.data.get('Festival.backstage')
        if (backstage != "undefined") {
            for (i = 0; i < selectTypes.length; i++) {
    	      	for(j = 0; j < selectTypes[i].options.length; j++){

    	      		if (backstage.length > 1) {
    	    		 	if(selectTypes[i].options[j].value == backstage[i+1]['type'] ){
    		          		selectTypes[i].options[j].selected = true;
    		        	}
    	      		}
    	    	}
    	    }

            tinymce.init({
                selector: 'textarea',
                height: 300,
                menubar: false,
                plugins: [
                    'link'
                ],
                toolbar: 'undo redo  | bold italic | link',
            });
        }
	},

	filtering: function () {
		$('.btn-action').click(function(e){
			var el = $(this);
			var day = el.parent().attr('id');

			$.each($('.' +day), function(i,v){
				el.hasClass('closed') ? $(v).removeClass('hidden') : $(v).addClass('hidden');
			});

			el.hasClass('closed') ? el.removeClass('closed') : el.addClass('closed');
			el.hasClass('closed') ? el.find('.less').text('+') : el.find('.less').text('-');
			el.hasClass('closed') ? el.find('.text-less').text('klap open') : el.find('.text-less').text('klap dicht');

		});
	},

	checkUrl: function() {
		$(".social-media input").blur(function() {
			var input = $(this);
			var val = input.val();
			if (val && !val.match(/^http([s]?):\/\/.*/)) {
				$(this).next().removeClass('hidden');
			} else {
				$(this).next().addClass('hidden');
			}
		});
	},

	addButtons: function() {
		jsFrontend.festival.removeButtons();

		$('.addBackstage').click(function(e) {
			var last = ($('.backstageGroup .group .extra').last());
			var newItem = last.clone();
			$(newItem).find('input').removeAttr('value');

			$(last).hasClass('hidden') ? $(last).removeClass('hidden') : $('.backstageGroup .group').append(newItem);
			jsFrontend.festival.removeButtons();
		})
	},

	removeButtons: function() {
		$('.removeBackstage').click(function(e) {
			if ( $(this).parent().parent().prev().hasClass('firstEl')) {
				$(this).parent().parent().addClass('hidden');
				$(this).parent().parent().find('input').removeAttr('value');
			} else {
				 $(this).parent().parent().remove();
			}
		});
	},

	signUpValidation: function () {
		// error url
		$('input[type=file]').change(function(){
			$(this).next().attr('placeholder', $(this).val().split('\\').pop());
		});

		// only numbers regex
		$('.numeric').on('input', function (event) {
			this.value = this.value.replace(/[^0-9]/g, '');
		});
	}
}

$(jsFrontend.festival.init);

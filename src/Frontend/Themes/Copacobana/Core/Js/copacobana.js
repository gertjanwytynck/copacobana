jsFrontend.copacobana = {
	init: function () {
		jsFrontend.copacobana.listeners();
		jsFrontend.copacobana.mappie();

        $(".scroll-down").click(function (){
           $('html, body').animate({
               scrollTop: 450
           }, 650);
       });
        if(window.location.pathname != "/nl" && window.location.pathname != "/en" && window.location.pathname != "/fr" && $(window).width() > 767) {

            $('.sub-nav').fadeTo(250, 1, function() {
                $.session.set("sub-nav", true);
            });

        } else if ($(window).width() > 767){
            $('.sub-nav').css('opacity', '0')
            $.session.set("sub-nav", false);
        }

        if ($(location).prop('pathname').split('/')[1] == "nl") {
            $('.lang-nl-active').css('text-decoration', 'underline');
            $('.practical-info-href-fix').attr('href', "/nl/praktisch")
        }

        if ($(location).prop('pathname').split('/')[1] == "en") {
            $('.lang-en-active').css('text-decoration', 'underline');
            $('.practical-info-href-fix').attr('href', "/en/practical-info")
        }

        if ($(location).prop('pathname').split('/')[1] == "fr") {
            $('.lang-fr-active').css('text-decoration', 'underline');
            $('.practical-info-href-fix').attr('href', "/fr/pratique")
        }


		// lazy loading
		$.extend($.lazyLoadXT, {
			edgeY:  0,
			srcAttr: 'data-src'
		});

		// parallax effect
		var moduleHero = $('.copacobana');
        if ($(window).height() <= 900) {
            var height = $(window).height();
            moduleHero.height(height);

            // fix cover height
            $(window).resize(function() {
                var height = $(window).height();
                moduleHero.height(height);
            });
        } else {
            moduleHero.height(900);
        }

		// tooltip
	 	$('[data-toggle="tooltip"]').tooltip()

 		// Artist sub menu fix
 	 	var lastIndexUrl = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
		$('.sub-nav-artists li').each(function(){
			$(this).find('a').removeClass('active-sub')

        	if ((lastIndexUrl === 'vrijdag' || lastIndexUrl === 'friday' || lastIndexUrl === 'vendredi') && $(this).hasClass('friday')) {
        		$(this).find('a').addClass('active-sub')
        	}

        	if ((lastIndexUrl === 'zaterdag' || lastIndexUrl === 'saturday' || lastIndexUrl === 'samedi') && $(this).hasClass('saturday')) {
        		$(this).find('a').addClass('active-sub')
        	}

        	if ((lastIndexUrl === 'zondag' || lastIndexUrl === 'sunday' || lastIndexUrl === 'dimanche') && $(this).hasClass('sunday')) {
        		$(this).find('a').addClass('active-sub')
        	}

        	if (lastIndexUrl === 'line-up' && $(this).hasClass('line-up')) {
        		$(this).find('a').addClass('active-sub')
        	}


        	if ((lastIndexUrl === 'artiesten' || lastIndexUrl === 'artists' || lastIndexUrl === 'artistes') && $(this).hasClass('all')) {
        		$(this).find('a').addClass('active-sub')
        	}
        })

		$('.btn-submit').click(function() {
			if ($('#contactFirstName').val() != '' && $('#contactName').val() != '' && $('#contactEmail').val() != '' && $('#contactPhone').val() != '' ) {
				$('.loader-outer').removeClass('hidden');
			} else {
				$('.loader-outer').addClass('hidden');
			}
		});
	},

    mappie: function() {
        if ($('#map').length) {
            var copaLocation = [3.7587856, 51.0596485];
            mapboxgl.accessToken = 'pk.eyJ1IjoiZ2VydGphbnd5dHluY2siLCJhIjoiY2owd29oemdiMDAwMzJycGd0dnRrejNyOSJ9.4EuSbSdrpxUlVeaE0O1fMA';
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v9',
                center: copaLocation,
                zoom: 15
            });

            map.scrollZoom.disable();
            map.addControl(new mapboxgl.NavigationControl());

            var popup = new mapboxgl.Popup({offset: 25})
                .setText('Copacobana Festival. Rozebroekenslag, 9040 Sint-Amandsberg');

            var el = document.createElement('div');
            el.id = 'marker';

            new mapboxgl.Marker(el, {offset:[-25, -25]})
                .setLngLat(copaLocation)
                .setPopup(popup)
                .addTo(map);
        }

    },

	listeners: function () {
		// Menu
		$('.hamburger').click(function(){
            $('#nav-icon').toggleClass('open');

            if ($('#nav-icon').hasClass('open')) {
                $('.sub-nav').fadeTo(250, 1, function() {
                    $.session.set("sub-nav", true);
                });
            } else {
                $('.sub-nav').fadeTo(250, 0, function() {
                    $.session.set("sub-nav", false);
                });
            }
		});

        $('a.target-burger').click(function(e){
            $('.sub-nav, a.target-burger').toggleClass('toggled');
        });

		// Artist Menu
		var active = false;
		$.each($('.sub-nav li'), function(key, value){
			if ($(value).hasClass('active')) {
				$('.menu-open').prop('checked', true);
				active = true;
			};
		});

		if ( ! active ) {
			$('.default').css('padding-top', '100px');
			$('.content').css('padding-top', '100px');
		}

		// hovers
		var src = $('.twitter').find('img').attr('src');
		$('.twitter').hover(
			function () {
				$(this).find('img').attr('src', src.substr(0, src.lastIndexOf('/')) + '/twitter-hover.svg');
			},
			function () {
				$(this).find('img').attr('src', src.substr(0, src.lastIndexOf('/')) + '/twitter.svg');
			}
		);

		var src = $('.instagram').find('img').attr('src');
		$('.instagram').hover(
			function () {
				$(this).find('img').attr('src', src.substr(0, src.lastIndexOf('/')) + '/instagram-hover.svg');
			},
			function () {
				$(this).find('img').attr('src', src.substr(0, src.lastIndexOf('/')) + '/instagram.svg');
			}
		);


		var src = $('.facebook').find('img').attr('src');
		$('.facebook').hover(
			function () {
				$(this).find('img').attr('src', src.substr(0, src.lastIndexOf('/')) + '/facebook-hover.svg');
			},
			function () {
				$(this).find('img').attr('src', src.substr(0, src.lastIndexOf('/')) + '/facebook.svg');
			}
		);
	},
};

$(jsFrontend.copacobana.init());

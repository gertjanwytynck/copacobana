jsFrontend.copacobana = {
	init: function () {
		jsFrontend.copacobana.listeners();
		jsFrontend.copacobana.mappie();


        if(window.location.pathname != "/nl" && $(window).width() > 767) {
            if ($.session.get("sub-nav")) {
                $('.sub-nav').fadeTo(250, 1, function() {
                    $.session.set("sub-nav", true);
                });
            }
        } else if ($(window).width() > 767){
            $('.sub-nav').css('opacity', '0')
            $.session.set("sub-nav", false);
        }


		// lazy loading
		$.extend($.lazyLoadXT, {
			edgeY:  0,
			srcAttr: 'data-src'
		});

		// parallax effect
		var moduleHero = $('.copacobana');
        if ($(window).height() <= 1100) {
            var height = $(window).height() * 0.85;
            moduleHero.height(height);

            // fix cover height
            $(window).resize(function() {
                var height = $(window).height() * 0.85;
                moduleHero.height(height);
            });
        } else {
            moduleHero.height(1100);
        }

		// tooltip
	 	$('[data-toggle="tooltip"]').tooltip()

 		// Artist sub menu fix
 	 	var lastIndexUrl = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);

		$('.sub-nav-artists li').each(function(){
			$(this).find('a').removeClass('active-sub')
        	if (lastIndexUrl === 'vrijdag' && $(this).hasClass('friday')) {
        		$(this).find('a').addClass('active-sub')
        	}

        	if (lastIndexUrl === 'zaterdag' && $(this).hasClass('saturday')) {
        		$(this).find('a').addClass('active-sub')
        	}

        	if (lastIndexUrl === 'zondag' && $(this).hasClass('sunday')) {
        		$(this).find('a').addClass('active-sub')
        	}

        	if (lastIndexUrl === 'line-up' && $(this).hasClass('line-up')) {
        		$(this).find('a').addClass('active-sub')
        	}

        	if (lastIndexUrl === 'artiesten' && $(this).hasClass('all')) {
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

jsFrontend.copacobana = {
	init: function () {
		jsFrontend.copacobana.listeners();
		jsFrontend.copacobana.mappie();

		// lazy loading
		$.extend($.lazyLoadXT, {
			edgeY:  0,
			srcAttr: 'data-src'
		});

		// parallax effect
		var moduleHero = $('.copacobana');
		var height = $(window).height() * 0.70;
		moduleHero.height(height);

		// fix cover height
		$(window).resize(function() {
			var height = $(window).height() * 0.70;
			moduleHero.height(height);
		});

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

		// height for newsitem
		var height = 0;
		$.each($('.news .item .news-content'), function(key, value) {
			if ($(value).height() > height) {
				height = $(value).height() + 10;
			}
		});

		$.each($('.news .item .news-content'), function(key, value) {
			$(value).css('height', height);
		});

		$('.btn-submit').click(function() {
			if ($('#contactFirstName').val() != '' && $('#contactName').val() != '' && $('#contactEmail').val() != '' && $('#contactPhone').val() != '' ) {
				$('.loader-outer').removeClass('hidden');
			} else {
				$('.loader-outer').addClass('hidden');
			}

		});
	},

	listeners: function () {
		// menu
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

		// carousel
		$('ol.carousel-widget-indicators  li').on("click",function(){
			$('ol.carousel-widget-indicators li.active').removeClass("active");
			$(this).addClass("active");
		});
		$('#carousel-widget').carousel();

		//hovers
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

	mappie: function () {
		if( $('#mappie').length ) {
			// inits
			var belgium = jsFrontend.data.get('Location.items_1[0]');
			var zoom = jsFrontend.data.get('Location.settings_1.zoom_level');
			var height = jsFrontend.data.get('Location.settings_1.height');

			// map config
			$('#mappie').css('max-height', height);
			$('#mappie').css('height', height);

			// options
			var styles =
				[
					{
						"featureType": "administrative",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"lightness": 33
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "all",
						"stylers": [
							{
								"color": "#f9efd6"
							}
						]
					},
					{
						"featureType": "poi.park",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#ece9d5"
							}
						]
					},
					{
						"featureType": "poi.park",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "on"
							},
						]
					},
					{
						"featureType": "road",
						"elementType": "all",
						"stylers": [
							{
								"lightness": 20
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#f4bf3f"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#efd084"
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#f0e2bf"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#acbcc9"
							}
						]
					}
				]
			var options = {
				mapTypeControlOptions: {
					mapTypeIds: ['Styled']
				},
				center: new google.maps.LatLng(belgium.lat, belgium.lng),
				zoom: parseInt(zoom),
				disableDefaultUI: true,
				//draggable: false,
				scrollwheel: false,
				mapTypeId: 'Styled'
			};

			// marker
			var markerBe = new google.maps.Marker({
				position: new google.maps.LatLng(belgium.lat, belgium.lng),
				title: belgium.title,
				locationId: belgium.id
			});


			var currentMark;
			var infoWindowBe = new google.maps.InfoWindow({
				content: '<h3>'+ belgium.title + '</h3>' + belgium.street + ' ' + belgium.number  + '<br />' + belgium.zip + ' ' + belgium.city
			});

			google.maps.event.addListener(markerBe, 'click', function () {
				infoWindowBe.open(map, this);
				currentMark = this;

			});
			google.maps.event.addListener(markerBe, 'closeclick', function () {
				currentMark.setMap(null); //removes the marker
				// then, remove the infowindows name from the array
			});


			var div = document.getElementById('mappie');
			var map = new google.maps.Map(div, options);
			var styledMapType = new google.maps.StyledMapType(styles, {name: 'Styled'});
			map.mapTypes.set('Styled', styledMapType);
			markerBe.setMap(map);
		}

	}
};

$(jsFrontend.copacobana.init());
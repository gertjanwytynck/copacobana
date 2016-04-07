/**
 * Interaction for the news module
 *
 * @author Gertjan Wytynck <gertjan@studiorauw.be>
 */
jsFrontend.news =
{
	init: function () {
		jsFrontend.news.images.init();
	},

	images: {
		init: function () {
			if ( $('.image-box').length ) {
				$('.image-box li').fancybox({padding: 3});
			}
		}
	}
}

$(jsFrontend.news.init);
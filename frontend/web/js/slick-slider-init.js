$(document).ready(function() {
	$('.news-slider').slick({
		// dots: true,
		infinite: false,
		speed: 500,
		fade: true,
		cssEase: 'linear',
		prevArrow: '<p class="news-slider__nav news-slider__nav--prev"><i class="fa fa-angle-left fa-3x" aria-hidden="true"></p></i>',
		nextArrow: '<p class="news-slider__nav news-slider__nav--next"><i class="fa fa-angle-right fa-3x" aria-hidden="true"></p></i>'
	});
	$('.news-detail__popup-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
		}
	});

});
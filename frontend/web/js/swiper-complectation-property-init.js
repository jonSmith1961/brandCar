$( document ).ready(function() {
	var swiper = new Swiper('.model-props', {
		autoHeight: true,
		slidesPerView: 1,
		// spaceBetween: 0,
		// preventClicks: false,
		// preventClicksPropcomponyion: false,
		pagination: {
			el: '.model-props__pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.model-props__arrow_next',
			prevEl: '.model-props__arrow_prev',
		},
		// breakpoints: {
		//   768: {
		//     slidesPerView: 2,
		//   },
		//   450: {
		//     slidesPerView: 1,
		//   },
		// }
	});

	var swiper2 = new Swiper('.model-props2', {
		slidesPerView: 1,
		spaceBetween: 10,
		autoHeight: true,
// loop: true,
		breakpoints: {
			1270: {
				slidesPerView: 2,
				spaceBetween: 10
			},
			650: {
				slidesPerView: 1
			}
		},
		navigation: {
			nextEl: '.model-props__navigation .main-actions-button-next',
			prevEl: '.model-props__navigation .main-actions-button-prev',
		},
		scrollbar: {
			el: '.main-actions-scrollbar',
			dragSize: 75,
			// hide: true,
		},
	});
});

$(document).ready(function(){
	var swiper3 = new Swiper('.models-gallery', {
		slidesPerView: 3,
		spaceBetween: 0,
		preventClicks: false,
		preventClicksPropcomponyion: false,
		pagination: {
			el: '.models-gallery__pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.models-gallery__navigation .swiper-button-next',
			prevEl: 'models-gallery__navigation .swiper-button-prev',
		},
		breakpoints: {
			768: {
				slidesPerView: 2,
			},
			450: {
				slidesPerView: 1,
			},
		}
	});
	// if (swiper.el.classList.contains('models-gallery_shadowed'))
	// 	swiper.params.spaceBetween = 10;


	$('.models-gallery__gallery').magnificPopup({
		delegate: 'a.popup-init',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
	});
});

$(document).ready(function(){
	var galleryTop = new Swiper('.gallery-top', {
		autoplay: {
			delay: 5000,
		},
		loop:true,
		spaceBetween: 10,
		pagination: {
			el: '.swiper-pagination',
		},
		navigation: {
			nextEl: '.main-slider-button-next',
			prevEl: '.main-slider-button-prev',
		},
	});

	var galleryThumbs = new Swiper('.gallery-thumbs', {
		centeredSlides: true,
		slidesPerView: 'auto',
		slideToClickedSlide: true,
	});
	// galleryTop.controller.control = galleryThumbs;
	// galleryThumbs.controller.control = galleryTop;


	galleryTop.on('slideChange', function () {
		console.log("view index: " + this.realIndex)
		galleryThumbs.slideTo(this.realIndex)
	});
	galleryThumbs.on('slideChange', function () {
		console.log("thumb index: " + this.realIndex)
		galleryTop.slideTo(this.realIndex + 1)
	});

	galleryTop.on('slideChange', function () {
		// galleryThumbs.slideTo(0,400,false);
		// galleryThumbs.activeIndex = galleryTop.activeIndex;
		var activeSlide = galleryTop.activeIndex;
		var slidesCount = galleryTop.slides.length - 2;
		if(activeSlide > slidesCount){
			activeSlide = 1;
		}
		if(activeSlide == 0){
			activeSlide = slidesCount;
		}
		if (activeSlide < 10) {
			activeSlide = '0'+activeSlide;
		}

		$('.main-slider__number').text(activeSlide);
		$('.main-slider__gallery-thumbs-wrapper').css('transform', 'translate3d(0px, 0px, 0px)');

	});




	$('.main-slider__nav-block').on('click', function(){
		$('.main-slider__gallery-thumbs').toggleClass('main-slider__gallery-thumbs_visible');
		$('.main-slider__icon-arrow').toggleClass('main-slider__icon-arrow_active');
		$('.main-slider__gallery-thumbs-wrapper').css('transform', 'translate3d(0px, 0px, 0px)');
	});

});

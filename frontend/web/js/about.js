$(document).ready(function(){
	var swiper = new Swiper('.gallery-container', {
		autoHeight: true,
		pagination: {
			el: '.swiper-pagination',
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});

	$('.image-popup-no-margins').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});

	$('ul.about-tabs__caption').on('click', 'li:not(.active)', function() {
		$(this)
			.addClass('active').siblings().removeClass('active')
			.closest('div.about-tabs').find('div.about-tabs__content').removeClass('active').eq($(this).index()).addClass('active');
	});



	$('.history-nav__item').on('click', function(e){
		var indexItem = $(this).index() + 1,
			indexPrev = $(this).index(),
			indexNext = $(this).index() + 2,
			parent = $('.about-tabs__content.active');
		textPrev = parent.find('.history-nav__item:nth-of-type(' + indexPrev + ')').text(),
			textNext = parent.find('.history-nav__item:nth-of-type(' + indexNext + ')').text(),
			prevBtn = parent.find('.history-bottom-nav__btn_prev'),
			nextBtn = parent.find('.history-bottom-nav__btn_next'),
			lenght = parent.find('.history-nav__item').length,

			parent.find('.history-nav__item').removeClass('history-nav__item_active');
		$(this).addClass('history-nav__item_active');
		parent.find('.history-content__block').removeClass('history-content__block_active');
		parent.find('.history-content__block:nth-of-type(' + indexItem + ')').addClass('history-content__block_active');

		prevBtn.data('number', indexPrev);
		nextBtn.data('number', indexNext);
		if(parent.hasClass('about-tabs__content_world')){
			nextBtn.find('.history-bottom-nav__text').text(textNext+'-e');
			textPrev == '1916' ? prevBtn.find('.history-bottom-nav__text').text(textPrev) : prevBtn.find('.history-bottom-nav__text').text(textPrev+'-e');
		} else {
			nextBtn.find('.history-bottom-nav__text').text(textNext);
			prevBtn.find('.history-bottom-nav__text').text(textPrev);
		}

		// if(textPrev == '1916') {
		//   prevBtn.find('.history-bottom-nav__text').text(textPrev);
		// } else {
		//   prevBtn.find('.history-bottom-nav__text').text(textPrev+'-e');
		// }

		if(indexNext > lenght) {
			nextBtn.addClass('history-bottom-nav__btn_hidden');
		} else {
			nextBtn.removeClass('history-bottom-nav__btn_hidden');
		}
		if(indexPrev == 0) {
			prevBtn.addClass('history-bottom-nav__btn_hidden');
		} else {
			prevBtn.removeClass('history-bottom-nav__btn_hidden');
		}
	})

	$('.history-bottom-nav__btn').on('click', function(e){
		var indexItem = $(this).data('number'),
			indexPrev = indexItem - 1,
			indexNext = indexItem + 1,
			parent = $('.about-tabs__content.active');
		textPrev = parent.find('.history-nav__item:nth-of-type(' + indexPrev + ')').text(),
			textNext = parent.find('.history-nav__item:nth-of-type(' + indexNext + ')').text(),
			lenght = parent.find('.history-nav__item').length,
			prevBtn = parent.find('.history-bottom-nav__btn_prev'),
			nextBtn = parent.find('.history-bottom-nav__btn_next');

		parent.find('.history-nav__item').removeClass('history-nav__item_active');
		parent.find('.history-nav__item:nth-of-type(' + indexItem + ')').addClass('history-nav__item_active');

		parent.find('.history-content__block').removeClass('history-content__block_active');
		parent.find('.history-content__block:nth-of-type(' + indexItem + ')').addClass('history-content__block_active');

		prevBtn.data('number', indexPrev);
		nextBtn.data('number', indexNext);
		if(parent.hasClass('about-tabs__content_world')){
			textPrev == '1916' ? prevBtn.find('.history-bottom-nav__text').text(textPrev) : prevBtn.find('.history-bottom-nav__text').text(textPrev+'-e');
			nextBtn.find('.history-bottom-nav__text').text(textNext+'-e');
		} else {
			nextBtn.find('.history-bottom-nav__text').text(textNext);
			prevBtn.find('.history-bottom-nav__text').text(textPrev);
		}

		if(indexNext > lenght) {
			nextBtn.addClass('history-bottom-nav__btn_hidden');
		} else {
			nextBtn.removeClass('history-bottom-nav__btn_hidden');
		}
		if(indexPrev == 0) {
			prevBtn.addClass('history-bottom-nav__btn_hidden');
		} else {
			prevBtn.removeClass('history-bottom-nav__btn_hidden');
		}


	});



});

$(document).ready(function(){
	$('.company-menu__wrap').on('click', function() {
		$(this).toggleClass('active');
		$('.company-menu__toggle').toggleClass('active');
		$('.company-menu__list').toggleClass('visible');
	});
});

$(document).ready(function(){
	var swiper = new Swiper('.gallery-container', {
		autoHeight: true,
		pagination: {
			el: '.swiper-pagination',
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});

	$('.image-popup-no-margins').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});

	$('ul.about-tabs__caption').on('click', 'li:not(.active)', function() {
		$(this)
			.addClass('active').siblings().removeClass('active')
			.closest('div.about-tabs').find('div.about-tabs__content').removeClass('active').eq($(this).index()).addClass('active');
	});



	$('.history-nav__item').on('click', function(e){
		var indexItem = $(this).index() + 1,
			indexPrev = $(this).index(),
			indexNext = $(this).index() + 2,
			parent = $('.about-tabs__content.active');
		textPrev = parent.find('.history-nav__item:nth-of-type(' + indexPrev + ')').text(),
			textNext = parent.find('.history-nav__item:nth-of-type(' + indexNext + ')').text(),
			prevBtn = parent.find('.history-bottom-nav__btn_prev'),
			nextBtn = parent.find('.history-bottom-nav__btn_next'),
			lenght = parent.find('.history-nav__item').length,

			parent.find('.history-nav__item').removeClass('history-nav__item_active');
		$(this).addClass('history-nav__item_active');
		parent.find('.history-content__block').removeClass('history-content__block_active');
		parent.find('.history-content__block:nth-of-type(' + indexItem + ')').addClass('history-content__block_active');

		prevBtn.data('number', indexPrev);
		nextBtn.data('number', indexNext);
		if(parent.hasClass('about-tabs__content_world')){
			nextBtn.find('.history-bottom-nav__text').text(textNext+'-e');
			textPrev == '1916' ? prevBtn.find('.history-bottom-nav__text').text(textPrev) : prevBtn.find('.history-bottom-nav__text').text(textPrev+'-e');
		} else {
			nextBtn.find('.history-bottom-nav__text').text(textNext);
			prevBtn.find('.history-bottom-nav__text').text(textPrev);
		}

		// if(textPrev == '1916') {
		//   prevBtn.find('.history-bottom-nav__text').text(textPrev);
		// } else {
		//   prevBtn.find('.history-bottom-nav__text').text(textPrev+'-e');
		// }

		if(indexNext > lenght) {
			nextBtn.addClass('history-bottom-nav__btn_hidden');
		} else {
			nextBtn.removeClass('history-bottom-nav__btn_hidden');
		}
		if(indexPrev == 0) {
			prevBtn.addClass('history-bottom-nav__btn_hidden');
		} else {
			prevBtn.removeClass('history-bottom-nav__btn_hidden');
		}
	})

	$('.history-bottom-nav__btn').on('click', function(e){
		var indexItem = $(this).data('number'),
			indexPrev = indexItem - 1,
			indexNext = indexItem + 1,
			parent = $('.about-tabs__content.active');
		textPrev = parent.find('.history-nav__item:nth-of-type(' + indexPrev + ')').text(),
			textNext = parent.find('.history-nav__item:nth-of-type(' + indexNext + ')').text(),
			lenght = parent.find('.history-nav__item').length,
			prevBtn = parent.find('.history-bottom-nav__btn_prev'),
			nextBtn = parent.find('.history-bottom-nav__btn_next');

		parent.find('.history-nav__item').removeClass('history-nav__item_active');
		parent.find('.history-nav__item:nth-of-type(' + indexItem + ')').addClass('history-nav__item_active');

		parent.find('.history-content__block').removeClass('history-content__block_active');
		parent.find('.history-content__block:nth-of-type(' + indexItem + ')').addClass('history-content__block_active');

		prevBtn.data('number', indexPrev);
		nextBtn.data('number', indexNext);
		if(parent.hasClass('about-tabs__content_world')){
			textPrev == '1916' ? prevBtn.find('.history-bottom-nav__text').text(textPrev) : prevBtn.find('.history-bottom-nav__text').text(textPrev+'-e');
			nextBtn.find('.history-bottom-nav__text').text(textNext+'-e');
		} else {
			nextBtn.find('.history-bottom-nav__text').text(textNext);
			prevBtn.find('.history-bottom-nav__text').text(textPrev);
		}

		if(indexNext > lenght) {
			nextBtn.addClass('history-bottom-nav__btn_hidden');
		} else {
			nextBtn.removeClass('history-bottom-nav__btn_hidden');
		}
		if(indexPrev == 0) {
			prevBtn.addClass('history-bottom-nav__btn_hidden');
		} else {
			prevBtn.removeClass('history-bottom-nav__btn_hidden');
		}


	});



});


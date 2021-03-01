//главная страница
$( document ).ready(function() {
	var swiper = new Swiper('.main-actions-container', {
		slidesPerView: 3,
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
			nextEl: '.main-actions-button-next',
			prevEl: '.main-actions-button-prev',
		},
		scrollbar: {
			el: '.main-actions-scrollbar',
			dragSize: 75,
			// hide: true,
		},
	});
	});
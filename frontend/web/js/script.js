<!-- $(document).ready(function(){ -->
  function togg_not(k){
  $("#not"+k).fadeToggle(500);
}
<!-- }); -->

// Прокрутка наверх
window.onscroll = function() {
  var scrollArrow = document.querySelector(".scroll-to-top");

  if (window.pageYOffset >= document.body.scrollHeight / 2) {
    scrollArrow.classList.add("scroll-to-top_active");
  } else {
    scrollArrow.classList.remove("scroll-to-top_active");
  }
};

$('.model-detail__anchor').on('click', function(e){
  e.preventDefault();
  var destID = $(this).attr('rel');
  var destElem = document.getElementById(destID);
  destElem.scrollIntoView({block: "start", behavior: "smooth"});
});

document.querySelector(".scroll-to-top svg").onclick = function() {
  $('body, html').animate({scrollTop:0},1000);return false;
};


$(document).ready(function() {
  $('.news-list__item').hover(function() {
    $(this).removeClass('js-faded').addClass('js-active')
    $(this).siblings().removeClass('js-active').addClass('js-faded')
  },function() {
    $('.news-list__item').removeClass('js-faded').removeClass('js-active');
  });
});

$(document).ready(function() {

  $( ".modal__order-form" ).click(function(){
    $( ".overlay-white" ).show();
    $( ".order-form" ).show();
  });
  $( ".order-form__close-buttom" ).click(function(){
    $( ".overlay-white" ).hide();
    $( ".order-form" ).hide();
  });
  $( ".modal-form-success .button__close" ).click(function(){
    $( ".overlay-white" ).hide();
    $( ".modal-form-success" ).hide();
  });
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


$(document).ready(function() {
  // $('.dropdown-menu > li').hover(function(){
  //   $(this).addClass('active');  
  // },
  // function() { 
  //   $(this).removeClass('active');  
  // });
  $('.dropdown-menu > li').on('click', function () {   
    $(this).toggleClass('active');
    if ($('.dropdown-menu > li').not($(this)).hasClass('active')) {
      $('.dropdown-menu > li').not($(this)).removeClass('active');
    }    
  });
  $('.dropdown-menu > li > a').on('click', function(e) {
    if($(this).attr('href') == '/models/') {
      e.preventDefault();
    } 
  });
  $('.mob-opener').on('click', function(){
    $(this).toggleClass('active');
    if ( $('.mob-opener').not($(this)).hasClass('active')) {  
        $('.mob-opener').not($(this)).removeClass('active');
    }
  });
  $('.mob-dropdown__opener').on('click', function(){
    $(this).toggleClass('active');
    $('.mob-dropdown__opener').not($(this)).removeClass('active');
  });
  });

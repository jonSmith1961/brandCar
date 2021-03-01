(function($) {
    $(function() {
        $(document).ready(function() {


            // Фича для сброса параметров фильтра админки.
            var filters = $('.filters');
            $('input', filters).wrap('<div class="xs-clear-filter"></div>').after('<div class="xs-clear glyphicon glyphicon-remove"></div>');

            $('input', filters).each(function () {
                if ($(this).val() !== '') {
                    $(this).next().addClass('on');
                } else {
                    $(this).next().removeClass('on');
                }
            });

            $('.xs-clear-filter .xs-clear', filters).on('click', function(){
                $(this).prev().val('').change();
            });

            $('.selectpicker').selectpicker();


        });

	    $(window).scroll(function() {
		    if($(this).scrollTop() != 0) {
			    $('.scroll_top').fadeIn();
		    } else {
			    $('.scroll_top').fadeOut();
		    }
	    });

	    $(document).on("click", ".scroll_top", function(e) {
		    e.preventDefault();
		    $('body, html').animate({scrollTop: 0}, 200);
	    });
        // === Sidebar navigation === //

        $('.submenu > a').click(function(e)
        {
            e.preventDefault();
            var submenu = $(this).siblings('ul');
            var li = $(this).parents('li');
            var submenus = $('#sidebar li.submenu ul');
            var submenus_parents = $('#sidebar li.submenu');
            if(li.hasClass('open'))
            {
                if(($(window).width() > 768) || ($(window).width() < 479)) {
                    submenu.slideUp();
                } else {
                    submenu.fadeOut(250);
                }
                li.removeClass('open');
            } else
            {
                if(($(window).width() > 768) || ($(window).width() < 479)) {
                    submenus.slideUp();
                    submenu.slideDown();
                } else {
                    submenus.fadeOut(250);
                    submenu.fadeIn(250);
                }
                submenus_parents.removeClass('open');
                li.addClass('open');
            }
        });

        var ul = $('#sidebar > ul');

        $('#sidebar > a').click(function(e)
        {
            e.preventDefault();
            var sidebar = $('#sidebar');
            if(sidebar.hasClass('open'))
            {
                sidebar.removeClass('open');
                ul.slideUp(250);
            } else
            {
                sidebar.addClass('open');
                ul.slideDown(250);
            }
        });
        $('.js-title-special-block').on('click', function (e) {
            e.preventDefault();
            $(this).parent().next().toggleClass('active');
        });
    });


    var evementId;
    var evementCodeId;

    $("#news-title").keyup(function() {
        console.log('keyUp');
	    evementId = 'news-title';
	    evementCodeId = 'news-alias';
        translit();
    });

    $("#specials-title").keyup(function() {
        console.log('keyUp');
	    evementId = 'specials-title';
	    evementCodeId = 'specials-alias';
        translit();
    });

    $("#contentblock-name").keyup(function() {
        console.log('keyUp');
	    evementId = 'contentblock-name';
	    evementCodeId = 'contentblock-code';
        translit();
    });

    function translit() {
   console.log('translit');
    var str = document.getElementById(evementId).value;
	var space = '-';
	var link = '';
	var transl = {
		'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh',
		'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
		'о': 'o', 'п': 'p', 'р': 'r','с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h',
		'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh','ъ': space,
		'ы': 'y', 'ь': space, 'э': 'e', 'ю': 'yu', 'я': 'ya'
	}
if (str != '')
	str = str.toLowerCase();

	for (var i = 0; i < str.length; i++){
		if (/[а-яё]/.test(str.charAt(i))){ // заменяем символы на русском
			link += transl[str.charAt(i)];
		} else if (/[a-z0-9]/.test(str.charAt(i))){ // символы на анг. оставляем как есть
			link += str.charAt(i);
		} else {
			if (link.slice(-1) !== space) link += space; // прочие символы заменяем на space
		}
	}

	document.getElementById(evementCodeId).value = link;
}

})(jQuery);


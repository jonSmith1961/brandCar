$(document).ready(function() {

  $('.order-form__type-input').focusin(function () {
    $(this).parent().next().hide();
  });
  $('.order-form__type-input').focusout(function () {
    if ($(this).val() == '') {
      $(this).parent().next().show();
    }
  });

  $('.order-form__type-input_drop_down').focusin(function () {
    $(this).parent().next().hide();
  });
  $('.order-form__type-input_drop_down').focusout(function () {
    if ($(this).val() == '') {
      $(this).parent().next().show();
    }
  });

  $('.order-form__type-input-textarea').focusin(function () {
    $(this).parent().next().hide();
  });
  $('.order-form__type-input-textarea').focusout(function () {
    if ($(this).val() == '') {
      $(this).parent().next().show();
    }
  });



  $('.order-form__label').click(function(){
    $(this).parent().hide();
    $(this).parent().prev().focus();
  });

  $('.order-form__label.drop-down').click(function(){
    $(this).parent().hide();
    $(this).parent().prev().focus();
  });

  $('.order-form__label_textarea').click(function(){
    // $(this).parent().hide();
    // $(this).parent().prev().focus();
  });

  // Маска телефона
  $(".order-form__phone").mask("+79999999999");

  $(".button__close").on("click", function() {
    $(".feedback__success").hide();
    $(".overlay-white").hide();
    // location.reload();
    document.getElementById("conference-form").reset();
  });

  $(".conference-form__type-check_conference").click(function() {
    if ($(this).attr("checked") === "checked") {
      $(".conference-form__type-check_conference")
        .not($(this))
        .attr("disabled", true);
      $(".conference-form__type-check_conference")
        .not($(this))
        .next()
        .addClass("conference-form__type-check_conference_disabled");
    } else {
      $(".conference-form__type-check_conference").attr("disabled", false);
      $(".conference-form__type-check_conference")
        .next()
        .removeClass("conference-form__type-check_conference_disabled");
    }
  });

  // Проверка на ввод данных
  $(
    ".order-form__item input, .order-form__item textarea"
  ).change(function() {
    if ($(this).val().length !== 0) {
      $(this)
        .parents(".order-form__item")
        .find(".js-required")
        .remove();
    }
  });

  $("#conference-form").on("submit", function(e) {
    e.preventDefault();

    var form = document.querySelector("#conference-form");
    var formData = new FormData(form);

    if($(".order-form__type-check").prop('checked')){
        $(".conference-form__label a").removeClass('conference-form__label-error');
      } else {
        $(".conference-form__label a").addClass('conference-form__label-error');

      }

    $(".js-required").remove();

    // $.ajax({
    //   url: "/contacts/feedback/",
    //   type: "POST",
    //   dataType: "json",
    //   data: formData,
    //   processData: false,
    //   contentType: false,
    //
    //   success: function(data) {
    //     var form = $(".conference-form");
    //     console.log(data);
    //
    //     if (data["error"]) {
    //       var errors = data["error"];
    //       $.each(data["error"], function(index, value) {
    //         var errSpan = document.createElement("span");
    //         var selectParent = form
    //           .find('[name="required[' + index + ']"]')
    //           .parents(".order-form__item");
    //         console.log(selectParent);
    //
    //         if (form.find('[name="required[' + index + ']"]').length >= 1) {
    //           errSpan.classList.add("js-required");
    //           errSpan.innerHTML = value;
    //           selectParent.append(errSpan);
    //         }
    //       });
    //     } else {
    //       $(".order-form__item")
    //         .children(".js-required")
    //         .remove();
    //       $(".feedback__success").show();
    //       $( ".overlay-white" ).show();
    //
    //     }
    //   },
    //
    //   error: function() {
    //     console.log("error");
    //   }
    // });
  });
});

$(document).ready(function(){
  function filter_data(weight)
  {
    // $.ajax({
    //   url:"/models-test/fetch_data.php",
    //   method:"POST",
    //   data:{weight:"111"},
    //   success:function(data){
    //     // $('.filter_data').html(data);
    //     console.log('111');
    //   }
    // });
    let url = "/models/fetch_data.php";
    var formData = new FormData();
    formData.append('weight', weight);
    formData.append('section', $('.models-filter__section').val());
    // fetch(url,
    //   {
    //     method: 'POST',
    //     body: formData ,
    //   })
    //   .then(response => {
    //     return response.text();
    //   })
    //   .then(function(html) {
    //
    //
    //     var parser = new DOMParser();
    //     var doc = parser.parseFromString(html, "text/html");
    //
    //     $('#models__fetch-content').fadeOut(200, function() {
    //        $(this).empty(200).fadeIn(200).html(doc.querySelector("body").innerHTML);
    //     });
    //     var filter = document.getElementById("models__fetch-content");
    //     filter.scrollIntoView({block: "start", behavior: "smooth"});
    // });
  }


  $('body').on('change', ".models-filter__select", function(e) {
    var currentWeight = $(this).val();
    // filter_data(currentWeight);

    var destination = $('.weight-'+currentWeight).first();
    // $('.weight-'+currentWeight).first().focus();

    // Prevent href=“#” link from changing the URL hash (optional)
    e.preventDefault();

    // Animate scroll to destination
    $('html, body').animate({
      scrollTop: $(destination).offset().top-80
    }, 500);

    return false;


  });

});

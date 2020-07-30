$(document).ready(function () {
  $(window).scroll(function () {
    if ($(document).scrollTop() > 50) {
      $(".navbar").addClass("change");
    } else {
      $(".navbar").removeClass("change");
    }
  });
});

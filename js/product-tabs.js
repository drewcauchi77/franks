$(".tab-header").click(function() {
  var tab_id = $(this).data("tab");

  $(".tab-header").removeClass("active-tab");
  $(".product-tab").removeClass("active-tab");
  $('.tab-header[data-tab="' + tab_id + '"]').addClass("active-tab");
  $('.product-tab[data-tab="' + tab_id + '"]').addClass("active-tab");

  console.log(tab_id);
});

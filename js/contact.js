$('.button-text').on('click', function () {
    $(".show-map").removeClass("active");
    $('.location').removeClass('active');
    $(this).closest('.location').addClass('active');
    var location = $(this).closest('.location');
    var imageurl = $(location).data('shop_img2');
    $("html, body").animate({ scrollTop: "0" });
    $(".inner-shop-slider").css('background-image', "url('" + imageurl + "')");
});
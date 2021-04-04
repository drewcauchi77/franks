
$(window).scroll(function () {
    var scroll_pos = $(this).scrollTop();
    if (scroll_pos > 0) {
        $('header').addClass("sticky-header");
    } else {
        $('header').removeClass("sticky-header");
    }
})

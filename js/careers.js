$('.vacancy-info').click(function () {
    var index = $(this).data('index');
    $('.vacancy-details').fadeOut();
    $('.vacancy-details[data-index="' + index + '"]').fadeIn();
});
